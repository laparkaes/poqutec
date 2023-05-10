<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		//$this->load->model('general_model','general');
		$this->nav_active = "dashboard";
		$this->js_init = "dashboard.js";
	}
	
	public function index(){
		$view = [
			"main" => "dashboard/index",
			"init" => $this->js_init,
		];
		
		$this->load->view('layout', $view);
	}
	
	public function test(){
		
	}
}
