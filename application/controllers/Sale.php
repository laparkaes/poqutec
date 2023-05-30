<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sale extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		
		if (!$this->session->userdata('username')) redirect("/");
		$this->load->model('general_model','gm');
		$this->load->library('my_func');
		$this->nav_active = "sale";
		$this->js_init = "sale.js";
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
			
			$f_w_in[] = ["field" => "buyer_id", "values" => $buyer_ids];
		}
		
		$sales = $this->gm->filter("sale", $f_w, $f_l, $f_w_in, "updated_at", "desc", 25, ($page-1)*25);
		foreach($sales as $item){
			$inquiry = $this->gm->id("inquiry", $item->inquiry_id);
			$buyer = $this->gm->id("company", $inquiry->company_id);
			$country = $this->gm->id("country", $buyer->country_id);
		
			$item->buyer = $buyer->company;
			$item->country = $country->country;
			
			if ($item->etd) $item->etd = date("Y-m-d", strtotime($item->etd)); else $item->etd = "-";
			if ($item->eta) $item->eta = date("Y-m-d", strtotime($item->eta)); else $item->eta = "-";
		}
		
		$view = [
			"filter_url" => $filter_url,
			"page" => $page,
			"pages" => $this->my_func->set_page($page, $this->gm->counter("sale", $f_w, $f_l, $f_w_in)),
			"sales" => $sales,
			"main" => "sale/list",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $view);
	}
	
	public function detail($id){
		$sale = $this->gm->id("sale", $id);
		
		//inquiry data set
		$inquiry = $this->gm->id("inquiry", $sale->inquiry_id);
		
		$f_inq = ["field" => "id"];
		$inquiry->incoterm = $this->gm->id("incoterm", $inquiry->incoterm_id)->incoterm_short;
		$inquiry->payment_term = $this->gm->id("payment_term", $inquiry->payment_term_id)->payment_term;
		$inquiry->products = $this->gm->filter("inquiry_product", ["inquiry_id" => $inquiry->id]);
		
		$inq_prod_qty = [];
		foreach($inquiry->products as $item){
			$prod = $this->gm->id("product", $item->product_id);
			$cat = $this->gm->id("category", $prod->category_id);
			$item->product = $prod->product;
			$item->category = $cat->category;
			$inq_prod_qty[$item->product_id] = $item->qty;
		}
		
		//buyer data set
		$buyer = $this->gm->id("company", $inquiry->company_id);
		$f_inq["values"] = explode(",", $inquiry->person_ids);
		$buyer->people = $this->gm->filter("person", null, null, [$f_inq]);
		foreach($buyer->people as $item) if ($item->position_id) $item->position = $this->gm->id("position", $item->position_id)->position; else $item->position = null;
		$buyer->country = $this->gm->id("country", $buyer->country_id)->country;
		$buyer->type = $this->gm->id("type", $buyer->type_id)->type;
		
		$packed_products = [];
		$packages = $this->gm->filter("sale_package", ["sale_id" => $sale->id]);
		foreach($packages as $item){
			$prods = $this->gm->filter("sale_package_product", ["package_id" => $item->id]);
			foreach($prods as $pr){
				$prod_aux = $this->gm->id("product", $pr->product_id);
				$cat_aux = $this->gm->id("category", $prod_aux->category_id);
				$pr->category = $cat_aux->category;
				$pr->product = $prod_aux->product;
				
				if (array_key_exists($prod_aux->id, $packed_products)) $packed_products[$prod_aux->id] += $pr->qty;
				else $packed_products[$prod_aux->id] = $pr->qty;
			}
			$item->products = $prods;
		}
		
		$data = [
			"inquiry" => $inquiry,
			"sale" => $sale,
			"buyer" => $buyer,
			"packages" => $packages,
			"packed_products" => $packed_products,
			"main" => "sale/detail",
			"init" => $this->js_init,
		];
		
		$this->load->view('layout', $data);
	}
	
	public function save_sale_data(){
		$data = $this->input->post();
		$data["updated_at"] = date('Y-m-d H:i:s', time());
		
		if (!$data["etd"]) $data["etd"] = null;
		if (!$data["eta"]) $data["eta"] = null;
		if (!$data["bl_awb"]) $data["bl_awb"] = null;
		
		if ($this->gm->update("sale", $data["id"], $data)){
			$type = "success";
			$msg = "Sale data has been saved.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
			
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function add_package(){
		$type = "error"; $msg = null;
		$pack = $this->input->post("pack");
		$products = $this->input->post("products");
		
		foreach($products as $i => $item) if ($item["qty"] <= 0) unset($products[$i]);
		if ($products){
			$pack_id = $this->gm->insert("sale_package", $pack);
			foreach($products as $item){
				$item["package_id"] = $pack_id;
				$this->gm->insert("sale_package_product", $item);
			}
			
			$type = "success";
			$msg = "Package has been added.";
		}else $msg = "You must choose at least one product to create a package.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function delete_package(){
		$pack_id = $this->input->post("id");
		if ($this->gm->delete("sale_package", ["id" => $pack_id])){
			$this->gm->delete("sale_package_product", ["package_id" => $pack_id]);
			
			$type = "success";
			$msg = "Package has been deleted.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
}
