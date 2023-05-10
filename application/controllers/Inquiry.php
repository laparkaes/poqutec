<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Inquiry extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		$this->load->model('general_model','gm');
		$this->load->library('my_func');
		$this->nav_active = "inquiry";
		$this->js_init = "inquiry.js";
	}
	/*
		$inquiries = $this->gm->filter("inquiry", ["company_id" => $company->id], null, null, "registed_at", "desc");
		foreach($inquiries as $item){
			//do something later
		}
		*/
		
	
	public function index(){}
	
	public function list(){
		$page = $this->input->get("page"); if (!$page) $page = 1;
		$filter_url = [
			"page" => $page,
			"category" => $this->input->get("category"),
			"keyword" => $this->input->get("keyword")
		];
		
		$f_where = $f_like = [];
		if ($filter_url["category"]) $f_where["category_id"] = $filter_url["category"];
		if ($filter_url["keyword"]) $f_like["product"] = $filter_url["keyword"];
		
		$categories_arr = [];
		$categories = $this->gm->all("category", "category", "asc");
		foreach($categories as $item) $categories_arr[$item->id] = $item->category;
		
		$view = [
			"filter_url" => $filter_url,
			"page" => $page,
			"pages" => $this->my_func->set_page($page, $this->gm->counter("product", $f_where, $f_like)),
			"categories" => $categories,
			"categories_arr" => $categories_arr,
			"products" => $this->gm->filter("product", $f_where, $f_like, null, "updated_at", "desc", 25, ($page-1)*25),
			"main" => "product/list",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $view);
	}
	
	public function new(){
		$buyer_id = $this->input->get("buyer_id");
		if (!$buyer_id) redirect("/inquiry/list");
		
		$company = $this->gm->id("company", $buyer_id);
		$company->type = $this->gm->id("type", $company->type_id)->type;
		$company->country = $this->gm->id("country", $company->country_id)->country;
		
		$people = $this->gm->filter("person",["company_id" => $company->id], null, null, "name", "asc");
		foreach($people as $item) $item->position = $this->gm->id("position", $item->position_id)->position;
		
		$data = [
			"company" => $company,
			"people" => $people,
			"incoterms" => $this->gm->all("incoterm", "incoterm_short", "asc"),
			"categories" => $this->gm->all("category", "category", "asc"),
			"main" => "inquiry/new",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$type = "error"; $msg = null; $move_to = null;
		$company_id = $this->input->post("company_id");
		$people = $this->input->post("people");
		$incoterm = $this->input->post("incoterm");
		$port = $this->input->post("port");
		$prods = $this->input->post("prods");
			
		if ($people){
			if ($incoterm){
				if ($prods){
					$now = date('Y-m-d H:i:s', time());
					$inq = [
						"company_id" => $company_id,
						"person_ids" => implode(",",$people),
						"incoterm_ids" => implode(",",$incoterm),
						"port" => $port,
						"updated_at" => $now,
						"registed_at" => $now,
					];
					
					$inquiry_id = $this->gm->insert("inquiry", $inq);
					if ($inquiry_id){
						$aux = [];
						foreach($prods as $item){
							$item["inquiry_id"] = $inquiry_id;
							$aux[] = $item;
						}
						
						if($this->gm->insert_multi("inquiry_product", $aux)){
							$type = "success";
							$msg = "Inquiry has been registered.";
							$move_to = base_url()."inquiry/detail/".$inquiry_id;
						}else $msg = "An error occurred. Please try again.";
					}else $msg = "An error occurred. Please try again.";
				}else $msg = "Choose at least one product.";
			}else $msg = "Choose at least one incoterm.";
		}else $msg = "Choose at least one person in charge.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
	
	public function detail($id){
		$inquiry = $this->gm->id("inquiry", $id);
		
		$incoterms = $aux_incoterms = [];
		$incoterm_ids = explode(",", $inquiry->incoterm_ids);
		foreach($incoterm_ids as $item){
			$incoterm = $this->gm->id("incoterm", $item);
			$incoterms[] = $incoterm;
			$aux_incoterms[] = $incoterm->incoterm_short;
		}
		$inquiry->incoterms = implode(", ", $aux_incoterms);
		
		$company = $this->gm->id("company", $inquiry->company_id);
		$company->country = $this->gm->id("country", $company->country_id)->country;
		$company->type = $this->gm->id("type", $company->type_id)->type;
		
		$products = $this->gm->filter("inquiry_product", ["inquiry_id" => $inquiry->id]);
		foreach($products as $item){
			$product = $this->gm->id("product", $item->product_id);
			$product->category = $this->gm->id("category", $product->category_id);
			$item->product = $product;
		}
		
		$f_in = [["field" => "id", "values" => explode(",", $inquiry->person_ids)]];
		$people = $this->gm->filter("person", null, null, $f_in, "name", "asc");
		foreach($people as $item) $item->position = $this->gm->id("position", $item->position_id)->position;
		
		$data = [
			"inquiry" => $inquiry,
			"company" => $company,
			"people" => $people,
			"products" => $products,
			"incoterms" => $incoterms,
			"payment" => [],
			"payment_terms" => $this->gm->all("payment_term", "payment_term", "asc"),
			"main" => "inquiry/detail",
			"init" => $this->js_init,
		];
		
		$this->load->view('layout', $data);
	}
	
	public function payment_term_save(){
		$data = $this->input->post();
		$data["updated_at"] = date('Y-m-d H:i:s', time());
		if ($this->gm->update("inquiry", $data["id"], $data)){
			$type = "success";
			$msg = "Payment term has been saved.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
			
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function freight_insurance_save(){
		$data = $this->input->post();
		$data["updated_at"] = date('Y-m-d H:i:s', time());
		if ($this->gm->update("inquiry", $data["id"], $data)){
			$type = "success";
			$msg = "Freight & insurance cost has been saved.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
			
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function load_price_history(){
		$inq_prod = $this->gm->id("inquiry_product", $this->input->post("inq_prod_id"));
		$inquiry = $this->gm->id("inquiry", $inq_prod->inquiry_id);
		$inquiries = $this->gm->filter("inquiry", ["company_id" => $inquiry->company_id], null, null, "registed_at", "desc", 0, 10);
		
		$products = [];
		$f_w = ["product_id" => $inq_prod->product_id];
		foreach($inquiries as $item){
			$f_w["inquiry_id"] = $item->id;
			$inq_product = $this->gm->filter("inquiry_product", $f_w, null, null);
			foreach($inq_product as $p){
				if ($inquiry->id != $p->inquiry_id){
					$p->unit_price = number_format($p->unit_price, 2);
					$p->registed_at = date("Y-m-d", strtotime($item->registed_at));
					$products[] = $p;	
				}
			}
		}
		
		$product = $this->gm->id("product", $inq_prod->product_id);
		$product->price = number_format($product->price, 2);
		
		
		header('Content-Type: application/json');
		echo json_encode(["product" => $product, "products" => $products]);
	}
	
	public function update_price(){
		if ($this->gm->update_multi("inquiry_product", $this->input->post("prod"), "id")){
			$type = "success";
			$msg = "Price has been updated.";
		}else{
			$type = "error";
			$msg = "You must enter a different price to save.";
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	////////////////////////////
	public function update(){
		$data = $this->input->post();
		$data["updated_at"] = date('Y-m-d H:i:s', time());
		if ($this->gm->update("product", $data["id"], $data)){
			$type = "success";
			$msg = "The product has been updated.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function add_inc_product(){
		$type = "error"; $msg = null;
		$data = $this->input->post();
		$f_data = $data; unset($f_data["qty"]);
		
		if (!$this->gm->filter("product_include", $f_data)){
			if ($this->gm->insert("product_include", $data)){
				$msg = "The product has been added to the list.";
				$type = "success";
			}else $msg = "Internal error. Please try again.";
		}else $msg = "The product already exists in the list of included products.";
		
		$products = $this->gm->filter("product_include", ["parent_id" => $data["parent_id"]]);
		foreach($products as $item) $item->product = $this->gm->id("product", $item->product_id)->product;
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "products" => $products]);
	}
	
	public function delete_inc_product(){
		$inc_product = $this->gm->id("product_include", $this->input->post("id"));
		if ($this->gm->delete("product_include", ["id" => $inc_product->id])){
			$type = "success";
			$msg = "The product has been deleted.";
		}else{
			$type = "success";
			$msg = "An error occurred. Try again.";
		}
		
		$products = $this->gm->filter("product_include", ["parent_id" => $inc_product->parent_id]);
		foreach($products as $item) $item->product = $this->gm->id("product", $item->product_id)->product;
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "products" => $products]);
	}
}
