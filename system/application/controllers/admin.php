<?php
class Admin extends Controller {
	
	var $admins = array('shivaas', 'sanjspatel','megharastogi');
	
	function __construct(){
		parent::Controller();
	}
	
	function index(){
		$this->checkPermissions();
		redirect('admin/home');
	}
	
	function checkPermissions(){
		if(!Users::user()){
			$this->session->set_flashdata('notification', 'Please login to access admin area.');
			redirect('admin/login');
		}else if(!in_array(Users::user()->username, $this->admins)){
			show_error('Not allowed to access admin area', 401);
		}
	}
	
	function login(){
		$data['content'] = 'admin/login';
		$this->load->view('admin/admin_template', $data);
	}
	
	function home(){
		$this->checkPermissions();
		$data['donations'] = Donations::get_all_donations();
		$data['content'] = 'admin/donations';
		$this->load->view('admin/admin_template', $data);
	}
	
	function blogroll($do = false){
		$this->checkPermissions();
		if($do)
			return $this->_add_blog();
		
		$data['blogs'] = Blogroll::get_all_blogs(); 
		$data['content'] = 'admin/blogroll';
		$this->load->view('admin/admin_template', $data);
	}
	
	function _add_blog(){
		try{
			$b = new Blogroll();
			$b->url = $this->input->get('url');
			$b->content_title = $this->input->get('content_title');
			$b->content = $this->input->get('content');
			$b->written_on = date('Y-m-d',strtotime($this->input->get('written_on')));
			$b->added_by = Users::user()->user_id;
			$b->save();
			echo "Blog added to the blog roll!";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	function blogroll_delete($blog_id){
		$this->checkPermissions();
		if(Blogroll::delete_blog($blog_id)){
			$this->session->set_flashdata('notification', 'Blog post deleted from the roll! Are you happy now?');
		}else{
			$this->session->set_flashdata('error', 'There was an error in deleting! Go get me some food.');
		}
		redirect('admin/blogroll');
	}
	
	function donations(){
		$this->checkPermissions();
		$data['donations'] = Donations::get_all_donations();
		$data['content'] = 'admin/donations';
		$this->load->view('admin/admin_template', $data);
	}
	
	
	function delete_note($note = null){
		$this->checkPermissions();
		if($note){
		if(Users::user()){
			$q = Doctrine_Query::CREATE()
					->delete('PostDonationRel p')
					->where('p.post_id = ?', $note)
					->execute();
			echo $q . ' records deleted from PostDonationRel<br><br/>';
			
			$q = Doctrine_Query::CREATE()
					->delete('Posts p')
					->where('p.post_id = ?', $note)
					->execute();
			echo $q . ' records deleted from Posts<br>';
			
		}else
			redirect('admin/index');
		}else{
			echo "<br>No note specified! focus please.";
		}
	}
	
	function twitter_list(){
		$this->checkPermissions();
		$q = Doctrine_Query::CREATE()
				->select('pd.post_id, p.post_id, u.oauth_provider, u.username')
				->from('PostDonationRel pd, pd.Posts p, p.Users u')
				->where('u.oauth_provider = ?', 'twitter')
				->execute(array(), Doctrine_core::HYDRATE_ARRAY);
		echo "List of people who donated and created a card from Twitter.<br/>";
		echo "Found " . count($q) . ' records.<br/>';
		echo '<pre>';
		print_r($q);
		echo '</pre>';
	}
	
	function twitter_list2(){
		$this->checkPermissions();
		$q = Doctrine_Query::CREATE()
				->select('p.post_id, u.oauth_provider, u.username')
				->from('Posts p, p.Users u')
				->where('u.oauth_provider = ?', 'twitter')
				->execute(array(), Doctrine_core::HYDRATE_ARRAY);
				
		echo "List of people who created a card from Twitter.<br/>";
		echo "Found " . count($q) . ' records.<br/>';
		echo '<pre>';
		print_r($q);
		echo '</pre>';
	}
}