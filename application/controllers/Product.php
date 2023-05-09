<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		$this->load->model('general_model','gm');
		$this->load->library('my_func');
		$this->nav_active = "product";
		$this->js_init = "product.js";
	}
	
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
		$data = [
			"categories" => $this->gm->all("category", "category", "asc"),
			"main" => "product/new",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$type = "error"; $msg = null; $move_to = null;
		
		$p = $this->input->post("p");
		$p_inc = $this->input->post("p_inc");
		
		$p["registed_at"] = $p["updated_at"] = date('Y-m-d H:i:s', time());
		
		if (!$this->gm->filter("product", ["product" => $p["product"], "category_id" => $p["category_id"]])){
			$product_id = $this->gm->insert("product", $p);
			if ($product_id){
				if ($p_inc){
					$aux = [];
					foreach($p_inc as $item) 
						$aux[] = ["parent_id" => $product_id, "product_id" => $item["product_id"], "qty" => $item["qty"]];
					
					if ($this->gm->insert_multi("product_include", $aux));
				}
				
				$type = "success";
				$msg = "The product has been registered.";
				$move_to = base_url()."product/detail/".$product_id;
			}else $msg = "An error occurred. Try again.";
		}else $msg = "This product already exists.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
	
	public function load_products(){
		header('Content-Type: application/json');
		echo json_encode(["products" => $this->gm->filter("product", $this->input->post(), null, null, "product", "asc")]);
	}
	
	public function detail($id){
		$inc_products = $this->gm->filter("product_include", ["parent_id" => $id]);
		foreach($inc_products as $item) $item->product = $this->gm->id("product", $item->product_id)->product;
		
		$data = [
			"inc_products" => $inc_products,
			"product" => $this->gm->id("product", $id),
			"categories" => $this->gm->all("category", "category", "asc"),
			"main" => "product/detail",
			"init" => $this->js_init,
		];
		
		$this->load->view('layout', $data);
	}
	
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
