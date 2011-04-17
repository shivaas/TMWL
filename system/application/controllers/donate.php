<?php
class Donate extends Controller { 
	
	function __construct(){
		parent::Controller();
		
	}
	
	function index(){
		$data['content'] = 'donate/donate';
		$this->load->view('template', $data);
	}
	
	function add_funds($post_id = null){
		
		$data['post_id'] = $post_id;
		$data['content'] = 'donate/donate';
		$this->load->view('template', $data);
	}
	
}