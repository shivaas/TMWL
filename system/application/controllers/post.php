<?php
class Post extends Controller {
	
	function index(){
		redirect('postcard/view');
	}
	
	function upload(){
//		$this->output->enable_profiler(TRUE);
		if(!Users::user()){
			$this->session->set_flashdata('error', 'Your session has expired. Please sign in again to continue creating your card.');
			redirect('postcard/design');
			//show_error('You are not authorizes to perform this action!', 501);
			//return;
		}
		
		if($this->input->post('postcard_img')){
			$myFile = realpath(APPPATH . '../../images/uploads') . '/'.$this->input->post('postcard_img');
			if (file_exists($myFile)) {
				if(!unlink($myFile)){
					show_error('You are not authorizes to perform this action!', 501);
					return;
				}
			}
		}
		
		$gallery_path = realpath(APPPATH . '../../images/uploads');
		$gallery_path_url = base_url().'images/uploads';

		$config = array(
			'allowed_types' => 'jpg|jpeg|gif|png',
			'upload_path' => $gallery_path,
			'encrypt_name' => true,
			'remove_spaces' =>true,
			'max_size' => 1024,
			'max_width' =>800,
			'max_height' =>600
		);
		try{
			$this->load->library('upload', $config);
			if(!$this->upload->do_upload()){
				//$error = array('error' => $this->upload->display_errors());
				//print_r($this->upload->display_errors());
				$this->session->set_flashdata('error', $this->upload->display_errors('',''));
	//			redirect('operator/print_template');
	//			return false;
				redirect('postcard/design');
			}
			$image_data = $this->upload->data();	//fetch upload data from client side
			//echo $image_data['file_name'];
			
			/*
			$config = array(
				'source_image' => $image_data['full_path'],
				'new_image' => $gallery_path . '/thumbs',
				'maintain_ration' => true,
				'height' => 100
			);
			
			$this->load->library('image_lib', $config);
			$this->image_lib->resize();
			*/
			
//			$this->session->set_flashdata('notification', 'Logo was uploaded succesfully');
//			redirect('operator/logo');
			//$this->session->set_flashdata('img_file', $image_data['file_name']);
			$session_data = array(
								'post_id' => '',
								'img_file' => '',
								'theme_id' => '',
								'use_twitter' => '',
								'postcard_state' => ''
								);
								
			$this->session->unset_userdata($session_data);
		
			if($this->input->post('post_id'))
				$d = Doctrine_Core::getTable('Posts')->find($this->input->post('post_id'));
			else
				$d = new Posts();
				
			$d->post_author = Users::user()->user_id;
			$d->post_content = $this->input->post('postcard_html');
			$d->post_status = "draft";
			$d->post_name = "Postcard";
			$d->save();
			
			$session_data = array(
								'post_id' => $d->post_id,
								'img_file' => $image_data['file_name'],
								'theme_id' => $this->input->post('theme_id'),
								'use_twitter' => $this->input->post('use_twitter'),
								'postcard_state' => $d->post_content
								);
			
			$this->session->set_userdata($session_data);
			$this->session->set_flashdata('notification', 'The image was uploaded succesfully');
			redirect('postcard/design');
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	function cards($page = 1){
		$data['page'] = $page;
		$data['limit'] = 10; //number of logs per page
		$data['total_posts'] = Posts::get_num_cards();
		$data['cards'] = Posts::get_all_cards(($data['page']-1)*$data['limit'],$data['limit']);
		
		$data['content'] = 'postcard/list';
		$this->load->view('template', $data);
	}
	
	function view($post_id = null){
		if($post_id == null){
			// pick a random postcard to display
			$haystack = Posts::get_post_ids();
			$post_id = array_rand($haystack);
			redirect('card/' . $post_id);
		}
		
		$post = Posts::get_post_by_id($post_id);
		
		$post = array(
				'post_status' => 'published',
				'post_author' => 4,
				'post_title' => 'Testing post title',
				'post_content' => json_encode(array('created_for'=> 'Shalini', 'created_by' => 'Shivaas', 'excerpt' => 'Testing words'))
		);
		
		if($post['post_status'] != 'published'){
			show_404();
		}
		
		$data['post'] = $post;
		$data['content'] = 'post/view';
		$this->load->view('template', $data);
	}

	
	function design($do = FALSE){
//		$this->output->enable_profiler(TRUE);
		
		if($this->input->post('share_msg'))
			$this->session->set_userdata('share_msg', $this->input->post('share_msg'));
		
		if($do){
			return $this->_save_design();
		}
		
		$data['content'] = 'postcard/design';
		$this->load->view('template', $data);
	}
	
	function _save_design(){
//		$this->output->enable_profiler(TRUE);
		
		if(!Users::user()){
			redirect('postcard/design');
		}
		
		if($this->input->post('post_id'))
			$d = Doctrine_Core::getTable('Posts')->find($this->input->post('post_id'));
		else{
			$d = new Posts();
			$d->post_author = Users::user()->user_id;
		}
		
		if($this->input->post('postcard_html'))
			$d->post_content = $this->input->post('postcard_html');
		else {
			$this->session->set_flashdata('error', 'Oops! There was an error in saving your note. Could you please try again?');
			redirect('postcard/design');
		}
		$d->post_status = "published";
		$d->post_name = "Postcard";
		$d->save();
		
		redirect('postcard/give/'. $d->post_id);
	}

	function give($postcard_id = null){
		if($postcard_id == null)
			redirect('/postcard/design');
		
		$postcard = Posts::get_post_by_id($postcard_id);
		$data['postcard'] = $postcard;
		$data['content'] = 'postcard/give';
		$this->load->view('template', $data);
	}
	
	function send($postcard_id = null, $id_hash = null ){
		$session_data = array(
								'post_id' => '',
								'img_file' => '',
								'theme_id' => '',
								'use_twitter' => '',
								'postcard_state' => ''
								);
								
		$this->session->unset_userdata($session_data);
		
		if($postcard_id == null)
			redirect('/postcard/design');
		
		$data['added_to_parade'] = $this->session->flashdata('added_to_parade');
		$postcard = Posts::get_post_by_id($postcard_id);
		$data['postcard'] = $postcard;
		$data['content'] = 'postcard/send';
		$this->load->view('template', $data);
	}
	
	function share_email(){
		$this->load->library('email');
		try{
			$name = urldecode($this->input->get('name'));
			$to_email = urldecode($this->input->get('to_email'));
			$from_email = urldecode($this->input->get('from_email'));
			$message = urldecode($this->input->get('message')); 
			$link = urldecode($this->input->get('link'));
			
			$content = $message .
						'<br/><br/><a href="'.$link.'">View your card </a> 
						
						<br/><br/>This note was created in celebration of Epic Thanks, a global event in which participants like me share thanks with those we love, and give in honor of all we have to be grateful for.  Our combined gifts of gratitude will be invested in the dreams of inspirational changemakers who create hope in our world.
						<br/><br/>
						You can check out thank you notes from around the globe, and create your own at www.EpicThanks.org.
						<br/><br>
						I am so very grateful for you.';
			
//			$subject = "Thank you";
//			$headers = "From: $name <$from_email> \n" . "MIME-Version: 1.0\n" . "Content-type: text/html; charset=iso-8859-1";
		//	echo $content;
			
//			mail($to_email,$subject,$message,$headers);
			
			$this->email->from($from_email, $name);
			$this->email->to($to_email);
			$this->email->subject('Thank you');
			$this->email->message($content);
			
			if(!$this->email->send()) {
				echo $this->email->print_debugger();
				return;
			}
			
			echo "Your message has been sent.";
		}catch(Exception $e){
			echo $e->getMessage();
		}
	}
	
	function json(){
		$req_cards = Posts::get_posts(3,array(1,2,3));
		$other_cards = Posts::get_posts(4);
		$cards = array_merge($req_cards, $other_cards);		
		echo json_encode($cards);
	}
}
