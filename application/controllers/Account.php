<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Account extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		$this->load->model('general_model','gm');
		$this->load->library('my_func');
		$this->nav_active = "account";
		$this->js_init = "account.js";
	}
	
	public function index(){}
	
	public function list(){
		$page = $this->input->get("page"); if (!$page) $page = 1;
		$filter_url = [
			"page" => $page,
			"keyword" => $this->input->get("keyword")
		];
		
		$f_where = $f_like = $f_where_in = [];
		if ($filter_url["keyword"]){
			$f_like["name"] = $filter_url["name"];
			$f_like["mobile"] = $filter_url["mobile"];
			$f_like["email"] = $filter_url["email"];
		}
		
		$accounts = $this->gm->filter("account", $f_where, $f_like, $f_where_in, "registed_at", "desc", 25, ($page-1)*25);
		foreach($accounts as $item){
			if ($item->person_id){
				$item->person = $this->gm->id("person", $item->person_id);
				if ($item->person->position_id) $item->person->position = $this->gm->id("position", $item->person->position_id)->position; else $item->person->position = "";
			}else{
				$item->person = $this->gm->structure("person");
				$item->person->position = "";
			}
		}
		
		$view = [
			"filter_url" => $filter_url,
			"page" => $page,
			"pages" => $this->my_func->set_page($page, $this->gm->counter("account", $f_where, $f_like, $f_where_in)),
			"accounts" => $accounts,
			"main" => "account/list",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $view);
	}
	
	public function new(){
		$data = [
			"main" => "account/new",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function register(){
		$type = "error"; $msg = $move_to = null;
		
		$a = $this->input->post("a");
		$p = $this->input->post("p");
		
		if (!$this->gm->filter("account", ["username" => $a["username"]])){
			if ($a["password"] === $a["password_confirm"]){
				$now = date('Y-m-d H:i:s', time());
				
				if ($p["position"]){
					$position = $this->gm->filter("position", null, ["position" => $p["position"]]);
					if ($position) $p["position_id"] = $position[0]->id;
					else $p["position_id"] = $this->gm->insert("position", ["position" => $p["position"]]);
					unset($p["position"]);	
				}
				
				$p["email"] = $a["username"];
				$p["registed_at"] = $now;
				
				unset($a["password_confirm"]);
				$a["password"] = password_hash($a["password"], PASSWORD_BCRYPT);
				$a["person_id"] = $this->gm->insert("person", $p);
				$a["registed_at"] = $now;
				
				$account_id = $this->gm->insert("account", $a);
				if ($account_id){
					$msg = "Account has been created.";
					$type = "success";
					$move_to = base_url()."account/detail/".$account_id;
				}else $msg = "An error occurred. Try again.";
			}else $msg = "Enter password confirm correctly.";
		}else $msg = "Username already exists.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
	
	public function detail($id){
		$account = $this->gm->id("account", $id);
		$person = $this->gm->id("person", $account->person_id);
		if (!$person) $person = $this->gm->structure("person");
		if ($person->position_id) $person->position = $this->gm->id("position", $person->position_id)->position;
		else $person->position = "";
		
		$data = [
			"account" => $account,
			"person" => $person,
			"main" => "account/detail",
			"init" => $this->js_init
		];
		
		$this->load->view('layout', $data);
	}
	
	public function update(){
		$type = "error"; $msg = null;
		
		$a = $this->input->post("a");
		$p = $this->input->post("p");
		
		if ($a["password"] === $a["password_confirm"]){
			if ($p["position"]){
				$position = $this->gm->filter("position", null, ["position" => $p["position"]]);
				if ($position) $p["position_id"] = $position[0]->id;
				else $p["position_id"] = $this->gm->insert("position", ["position" => $p["position"]]);
				unset($p["position"]);	
			}
			
			if ($p["id"]){
				$this->gm->update("person", $p["id"], $p);
				$person_id = $p["id"];
			}else $person_id = $this->gm->insert("person", $p);
			
			if ($person_id){
				$this->gm->update("account", $a["id"], ["person_id" => $person_id]);
				
				$type ="success";
				$msg = "Account has been updated.";
				
				if ($a["password"]){
					unset($a["password_confirm"]);
					$a["password"] = password_hash($a["password"], PASSWORD_BCRYPT);
					$this->gm->update("account", $a["id"], $a);
				}
			}else $msg = "An error occurred. Try again.";
		}else $msg = "Enter password confirm correctly.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
}
