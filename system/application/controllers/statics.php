<?php
class Statics extends Controller{

	function changemakers($person = 'subhash'){
		
		if($person == 'mama-lucy')
			$data['content'] = 'statics/mama-lucy';
		else if($person == 'mike-halley')
			$data['content'] = 'statics/mike-halley';
		else
			$data['content'] = 'statics/changemakers';
			
		$this->load->view('template', $data);
	}
	
	function about(){
		$data['content'] = 'statics/about';
		$this->load->view('template', $data);
	}
	
}