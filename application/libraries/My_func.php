<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/* My validations */
class My_func{
	
	public function __construct(){
		$this->CI = &get_instance();
		//$this->CI->lang->load("validation", "spanish");
		//$this->CI->load->model('general_model','general');
	}
	
	public function set_page($page, $qty){
		$pages = [];
		if ($qty){
			$last = floor($qty / 50); if ($qty % 50) $last++;
			if (3 < $page) $pages[] = [1, "First"];
			if (3 < $page) $pages[] = [$page-3, "..."];
			if (2 < $page) $pages[] = [$page-2, $page-2];
			if (1 < $page) $pages[] = [$page-1, $page-1];
			$pages[] = [$page, $page];
			if ($page+1 <= $last) $pages[] = [$page+1, $page+1];
			if ($page+2 <= $last) $pages[] = [$page+2, $page+2];
			if ($page+3 <= $last) $pages[] = [$page+3, "..."];
			if ($page+3 <= $last) $pages[] = [$last, "Last"];
		}
		echo $last;
		return $pages;
	}
	
}