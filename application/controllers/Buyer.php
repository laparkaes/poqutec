<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Buyer extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		$this->load->model('general_model','gm');
		$this->load->library('my_func');
		$this->nav_active = "buyer";
		$this->js_init = "buyer.js";
	}
	
	public function index(){
		
	}
	
	public function list(){
		$page = $this->input->get("page"); if (!$page) $page = 1;
		$filter = [];
		
		$countries_arr = [];
		$countries = $this->gm->all("country", "country", "asc");
		foreach($countries as $item) $countries_arr[$item->id] = $item->country;
		
		$types_arr = [];
		$types = $this->gm->all("type", "type", "asc");
		foreach($types as $item) $types_arr[$item->id] = $item->type;
		
		$view = [
			"page" => $page,
			"pages" => $this->my_func->set_page($page, $this->gm->counter("company", $filter)),
			"countries_arr" => $countries_arr,
			"types_arr" => $types_arr,
			"buyers" => $this->gm->filter("company", $filter, "registed_at", "desc", $page*50, ($page-1)*50),
			"main" => "buyer/list",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $view);
	}
	
	public function new(){
		$data = [
			"countries" => $this->gm->all("country", "country", "asc"),
			"types" => $this->gm->all("type", "type", "asc"),
			"main" => "buyer/new",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$data = $this->input->post();
		$data["registed_at"] = date('Y-m-d H:i:s', time());
		
		$buyer_id = $this->gm->insert("company", $data);
		if ($buyer_id){
			$type = "success";
			$msg = "The buyer has been registered.";
			$move_to = base_url()."buyer/detail/".$buyer_id;
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
			$move_to = null;
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
	
	public function detail($id){
		$position_arr = [];
		$position_rec = $this->gm->all("position");
		foreach($position_rec as $item) $position_arr[$item->id] = $item->position;
		
		$data = [
			"position_arr" => $position_arr,
			"people" => $this->gm->filter("person", ["company_id" => $id],"name", "asc"),
			"buyer" => $this->gm->id("company", $id),
			"countries" => $this->gm->all("country", "country", "asc"),
			"types" => $this->gm->all("type", "type", "asc"),
			"main" => "buyer/detail",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function update(){
		$data = $this->input->post();
		if ($this->gm->update("company", $data["id"], $data)){
			$type = "success";
			$msg = "The buyer has been updated.";
		}else{
			$type = "error";
			$msg = "An error occurred. Try again.";
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function person_register(){
		$type = "error";
		$data = $this->input->post();
		
		if ($data["name"]){
			if (!$this->gm->filter("person", ["name" => $data["name"], "company_id" => $data["company_id"]])){
				//position work
				if ($data["position"]){
					$position = $this->gm->filter("position", ["position" => $data["position"]]);
					if ($position) $data["position_id"] = $position[0]->id;
					else $data["position_id"] = $this->gm->insert("position", ["position" => $data["position"]]);	
				}
				unset($data["position"]);
				
				$data["registed_at"] = date('Y-m-d H:i:s', time());
				if ($this->gm->insert("person", $data)){
					$type = "success";
					$msg = "The person has been registered.";
				}else $msg = "An error occurred. Try again.";
			}else $msg = "This person already exists.";
		}else $msg = "Person's name is required.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function person_delete(){
		if ($this->gm->delete("person", ["id" => $this->input->post("id")])){
			$type = "success";
			$msg = "The person has been deleted.";
		}else{
			$type = "success";
			$msg = "An error occurred. Try again.";
		}
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function load_people(){
		$people = $this->gm->filter("person", $this->input->post(),"name", "asc");
		foreach($people as $item){
			if ($item->position_id) $item->position = $this->gm->id("position", $item->position_id)->position;
			else $item->position = "";
		}
		
		header('Content-Type: application/json');
		echo json_encode($people);
	}
	
	function randomString($characters, $length = 20) {
		
		$randomString = '';
		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, strlen($characters) - 1)];
		}
		return $randomString;
	}
		
	public function generate($qty){
		$alf_n = 'abcdefghijklmnopqrstuvwxyz';
		$alf = 'abcdefghijklmnopqrstuvwxyz          ';
		$num = '1234567890-';
		
		$countries = $this->gm->all("country", "country", "asc");
		$types = $this->gm->all("type", "type", "asc");
		
		$buyers = [];
		if ($qty) for($i = 0; $i < $qty; $i++){
			$buyers[] = [
				"company" => $this->randomString($alf, 40),
				"country_id" => $countries[array_rand($countries)]->id,
				"type_id" => $types[array_rand($types)]->id,
				"main_email" => $this->randomString($alf_n, 5)."@".$this->randomString($alf_n, 7)."com",
				"tel" => $this->randomString($num, 8),
				"web" => "www.".$this->randomString($alf_n, 10).".com",
				"registed_at" => date('Y-m-d H:i:s', time())
			];
		}
		$this->gm->insert_multi("company", $buyers);
	}
}
