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
	
	public function index(){}
	
	public function list(){
		$page = $this->input->get("page"); if (!$page) $page = 1;
		$filter_url = [
			"page" => $page,
			"buyer" => $this->input->get("buyer")
		];
		
		$f_w = $f_l = $f_w_in = [];
		if ($filter_url["buyer"]){
			$buyer_ids = [];
			$buyers = $this->gm->filter("company", null, ["company" => $filter_url["buyer"]]);
			foreach($buyers as $item) $buyer_ids[] = $item->id;
			if (!$buyer_ids) $buyer_ids = [-1];
			
			$f_w_in[] = ["field" => "company_id", "values" => $buyer_ids];
		}
		
		$inquiries = $this->gm->filter("inquiry", $f_w, $f_l, $f_w_in, "updated_at", "desc", 25, ($page-1)*25);
		foreach($inquiries as $item){
			$buyer = $this->gm->id("company", $item->company_id);
			$country = $this->gm->id("country", $buyer->country_id);
			$sale = $this->gm->filter("sale", ["inquiry_id" => $item->id]);
		
			$item->buyer = $buyer->company;
			$item->country = $country->country;
			$item->item_qty = $this->gm->counter("inquiry_product", ["inquiry_id" => $item->id]);
			if ($sale) $item->sale = "success"; else $item->sale = "warning";
		}
		
		$view = [
			"filter_url" => $filter_url,
			"page" => $page,
			"pages" => $this->my_func->set_page($page, $this->gm->counter("inquiry", $f_w, $f_l, $f_w_in)),
			"inquiries" => $inquiries,
			"main" => "inquiry/list",
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
		
		$incoterms = [];
		$incoterm_ids = explode(",", $inquiry->incoterm_ids);
		foreach($incoterm_ids as $item) $incoterms[] = $this->gm->id("incoterm", $item);
		$inquiry->incoterms = $incoterms;
		
		$company = $this->gm->id("company", $inquiry->company_id);
		$company->country = $this->gm->id("country", $company->country_id)->country;
		$company->type = $this->gm->id("type", $company->type_id)->type;
		
		$products = $this->gm->filter("inquiry_product", ["inquiry_id" => $inquiry->id]);
		foreach($products as $item){
			$product = $this->gm->id("product", $item->product_id);
			$product->category = $this->gm->id("category", $product->category_id);
			if (!$item->unit_price) $item->unit_price = $product->price;
			$item->product = $product;
		}
		
		$f_in = [["field" => "id", "values" => explode(",", $inquiry->person_ids)]];
		$people = $this->gm->filter("person", null, null, $f_in, "name", "asc");
		foreach($people as $item) if ($item->position_id) $item->position = $this->gm->id("position", $item->position_id)->position; else $item->position = "";
		
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
	
	public function update_inquiry(){
		$data = $this->input->post();
		$data["updated_at"] = date('Y-m-d H:i:s', time());
		if ($this->gm->update("inquiry", $data["id"], $data)){
			$type = "success";
			$msg = "Inquiry has been updated.";
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
		$inquiries = $this->gm->filter("inquiry", ["company_id" => $inquiry->company_id], null, null, "registed_at", "desc");
		
		$products = [];
		$f_w = ["product_id" => $inq_prod->product_id];
		foreach($inquiries as $item){
			$f_w["inquiry_id"] = $item->id;
			$inq_product = $this->gm->filter("inquiry_product", $f_w, null, null, null, null, 0, 10);
			foreach($inq_product as $p){
				if ($inquiry->id != $p->inquiry_id){
					$p->unit_price = number_format($p->unit_price, 2);
					$p->registed_at = date("Y-m-d", strtotime($item->registed_at));
					$products[] = $p;	
				}
			}
			usort($inq_product, function($a, $b) { return (strtotime($a->registed_at) - strtotime($b->registed_at));});
		}
		
		$product = $this->gm->id("product", $inq_prod->product_id);
		$product->price = number_format($product->price, 2);
		
		
		header('Content-Type: application/json');
		echo json_encode(["product" => $product, "products" => $products]);
	}
	
	public function update_price(){
		$type = "success";
		$msg = "Price has been updated.";
		$this->gm->update_multi("inquiry_product", $this->input->post("prod"), "id");
		
		//update sale record if it exists
		$inquiry_id = $this->input->post("inquiry_id");
		$sale = $this->gm->filter("sale", ["inquiry_id" => $inquiry_id]);
		if ($sale){
			$sale = $sale[0];
			$products = $this->gm->filter("inquiry_product", ["inquiry_id" => $inquiry_id]);
			
			$amount = 0;
			foreach($products as $item) $amount += $item->unit_price * $item->qty;
			
			$this->gm->update("sale", $sale->id, ["amount" => $amount, "updated_at" => date('Y-m-d H:i:s', time())]);
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function confirm_sale(){
		$type = "error"; $msg = ""; $move_to = null;
		
		$inquiry = $this->gm->id("inquiry", $this->input->post("id"));
		$products = $this->gm->filter("inquiry_product", ["inquiry_id" => $inquiry->id], null, null, "unit_price", "desc");
		
		$msg = "";
		if (!$inquiry->payment_term_id) $msg = $msg."<br/>- Select a payment term.";
		if (!$inquiry->incoterm_id) $msg = $msg."<br/>- Select a incoterm.";
		foreach($products as $item){
			if (!$item->unit_price) $msg = $msg."<br/>- Save product price.";
			break;
		}
		
		if (!$msg){
			//create or update sale record
			$amount = 0;
			foreach($products as $item) $amount += $item->unit_price * $item->qty;
			
			$sale_data = [
				"amount" => $amount,
				"buyer_id" => $inquiry->buyer_id,
				"inquiry_id" => $inquiry->id,
				"updated_at" => date('Y-m-d H:i:s', time()),
			];
			
			$sale = $this->gm->filter("sale", ["inquiry_id" => $inquiry->id]);
			if ($sale){
				$sale = $sale[0];
				$this->gm->update("sale", $sale->id, $sale_data);
				$sale_id = $sale->id;
			}else{
				$sale_data["registed_at"] = date('Y-m-d H:i:s', time());
				$sale_id = $this->gm->insert("sale", $sale_data);
			}
			
			if ($sale_id){
				$type = "success";
				$msg = "New sale has been registered";
				$move_to = base_url()."sale/detail/".$sale_id;
			}else $msg = "Internal error. Please try again.";
		}else $msg = "An error occurred.".$msg;
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
}
