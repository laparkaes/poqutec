<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Auth extends CI_Controller {
	
	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		$this->load->model('general_model','gm');
	}

	public function index(){
		if ($this->session->userdata('username')) redirect("/dashboard");
		$this->load->view('auth');
	}
	
	public function login(){
		$type = "error"; $msg = null;
		$data = $this->input->post();
		
		$account = $this->gm->filter("account", ["username" => $data["username"]]);
		if ($account){
			if (!password_verify($account[0]->password, $data["password"])){
				$this->session->set_userdata('username', $account[0]->username);
				
				$type = "success";
				$msg = "Welcome!!";
			}else $msg = "Password error.";
		}else $msg = "Unregistered user.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function first_account(){
		$type = "error"; $msg = null;
		
		if (!$this->gm->all("account", null, null, null, 1, 0)){
			$data["username"] = $this->input->post("username");
			$data["password"] = password_hash("123456", PASSWORD_BCRYPT);
			if ($this->gm->insert("account", $data)){
				$type = "success";
				$msg = "Account has been created. Please login.";
			}else $msg = "An error occurred. Try again.";
		}else $msg = "There is an account in the system.";
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg]);
	}
	
	public function logout(){
		$type = "success"; $msg = "Goodbye !!!"; $move_to = base_url()."auth";
		
		$this->session->sess_destroy();
		
		header('Content-Type: application/json');
		echo json_encode(["type" => $type, "msg" => $msg, "move_to" => $move_to]);
	}
}
