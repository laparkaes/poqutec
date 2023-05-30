<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct(){
		parent::__construct();
		date_default_timezone_set('Asia/Seoul');
		
		if (!$this->session->userdata('username')) redirect("/");
		$this->load->model('general_model','gm');
		$this->nav_active = "dashboard";
		$this->js_init = "dashboard.js";
	}
	
	public function index(){
		$sales = $this->gm->all("sale", "registed_at", "desc", 5, 0);
		foreach($sales as $item){
			$inquiry = $this->gm->id("inquiry", $item->inquiry_id);
			$buyer = $this->gm->id("company", $item->buyer_id);
			
			$item->country = $this->gm->id("country", $buyer->country_id)->country;
			$item->buyer = $buyer->company;
			if ($inquiry->incoterm_id) $item->incoterm = $this->gm->id("incoterm", $inquiry->incoterm_id)->incoterm_short;
			else $item->incoterm = null;
			if ($inquiry->payment_term_id) $item->payment_term = $this->gm->id("payment_term", $inquiry->payment_term_id)->payment_term; else $item->payment_term = null;
		}
		
		$buyers = $this->gm->all("company", "updated_at", "desc", 5, 0);
		foreach($buyers as $item){
			if (!$item->updated_at) $item->updated_at = $item->registed_at;
			$item->country = $this->gm->id("country", $item->country_id)->country;
		}
		
		$inquiries = $this->gm->all("inquiry", "updated_at", "desc", 5, 0);
		foreach($inquiries as $item){
			if (!$item->updated_at) $item->updated_at = $item->registed_at;
			$company = $this->gm->id("company", $item->company_id);
			$item->company = $company->company;
			$item->country = $this->gm->id("country", $company->country_id)->country;
		}
		
		$view = [
			"sales" => $sales,
			"buyers" => $buyers,
			"inquiries" => $inquiries,
			"main" => "dashboard/index",
			"init" => $this->js_init,
		];
		
		$this->load->view('layout', $view);
	}
	
	public function test(){
		
	}
}
