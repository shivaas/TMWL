<?php

class Home extends Controller {

	function Welcome()
	{
		parent::Controller();	
	}
	
	function test(){
		$this->load->helper('file');
		$data = 'testing file write';
		
	}
	
	function getTwitterMob(){
		$this->load->helper('file');
		$file = './twitter_list.txt';
		$data = read_file($file);
		return json_decode($data,true);
	}
	
	function getTwitterList($listUser='EpicChange',$listName='X')
	{
		$this->load->helper('file');
		$file = './twitter_list.txt';
		
		$max_pages = 50; // 20 users per page 
		
		$url = 'http://api.twitter.com/1/'.$listUser.'/'.$listName.'/members.json';
		
		// Check code: Check disk cache first and return if recent enough
		
		/*
		$path_to_cache_dir = $_SERVER['DOCUMENT_ROOT'].'/test/system/cache';
		$path_to_cache_file = $path_to_cache_dir.'/twitterlist_'.md5($url).'.json';
		if(file_exists($path_to_cache_file) && filemtime($path_to_cache_file) > strtotime("-60 minutes")){
			return json_decode(file_get_contents($path_to_cache_file), true);
		}
		*/
		$info = get_file_info($file, array('date'));
		
		if($info){
			$file_day = date('d', $info['date']);
//			echo $file_day . '<br>';
			$current_day = date('d');
//			echo $current_day  . '<br>';
			if(($current_day - $file_day) >= 1){
				//echo $url; http://api.twitter.com/1/EpicChange/X/members.json
				$json = get_file($url);
				if($json == false) 
					return false;
				$list = json_decode($json, true);
				$users = $list['users'];
				$page = 1; 
				while(isset($list['next_cursor_str']) && $list['next_cursor_str'] != '0'){
					$page++;
					$url_cursor = 'http://api.twitter.com/1/'.$listUser.'/'.$listName.'/members.json?cursor='.$list['next_cursor_str'];
					//echo $url.'<br />';
					$json = get_file($url_cursor);
					$list = json_decode($json, true);
					$users = array_merge($users, $list['users']);
					if($page > $max_pages) break; 
				}
				if (!write_file($file, json_encode($users,true)))
				{
				     echo 'Unable to write the file';
				}
				return $users;
			}else{
				$data = read_file($file);
				//echo '<br>count = ' . count(json_decode($data)) .'<br>' ;
				//print_r(json_decode($data));
//				echo "read twitter list from file";
				return json_decode($data,true);
			}
		}else{
			$json = get_file($url);
				if($json == false) 
					return false;
				$list = json_decode($json, true);
				$users = $list['users'];
				$page = 1; 
				while(isset($list['next_cursor_str']) && $list['next_cursor_str'] != '0'){
					$page++;
					$url_cursor = 'http://api.twitter.com/1/'.$listUser.'/'.$listName.'/members.json?cursor='.$list['next_cursor_str'];
					//echo $url.'<br />';
					$json = get_file($url_cursor);
					$list = json_decode($json, true);
					$users = array_merge($users, $list['users']);
					if($page > $max_pages) break; 
				}
				if (!write_file($file, json_encode($users,true)))
				{
				     echo 'Unable to write the file';
				}
				return $users;
		}
	}

	function get_file($url){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_POST, 1);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); // ask for results to be returned
		// Send to remote and return data to caller.
		$result = curl_exec($ch);
		curl_close($ch);
		return $result;
	}
					
	function index()
	{
		
		/*
		if(Users::user()) // check if user is logged in or not. just a test
			print_r(Users::user()->toArray(true));
 		*/
		$this->load->library('rssfeed');
		
		$donations = Donations::get_all_donations();
		$total = 0;
		$donation_count = count($donations);
		foreach($donations as $d){
			$total += $d['donation_amount'];
		}
		
		$listMembers = $this->getTwitterMob();
//		print_r($listMembers);
		shuffle($listMembers);
		//echo count($listMembers);
		$data['listMembers'] = $listMembers;
		
//		$data['parade'] = GratitudeParade::get_parade();
		$data['blogs'] = Blogroll::get_all_blogs(3);
		$data['donation_amount'] = $total;
		$data['donation_count'] = $donation_count;
		$data['content'] = 'home';
		$this->load->view('template', $data);
	}
	
	/**
	 * 
	 * Method to generate Doctrine models from the tables in the specified database.
	 * @author shivaas
	 */
	function generate_models() {	
		try {
			Doctrine::generateModelsFromDb('db_models', array('default'), array('generateTableClasses' => 'false'));
		} catch (Exception $e) {
	    	echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
	}
	
	function blog_love(){
		$data['blogs'] = Blogroll::get_all_blogs();
		$data['content'] = 'blog_love';
		$this->load->view('template', $data);
	}	

}

/* End of file welcome.php */
/* Location: ./system/application/controllers/welcome.php */