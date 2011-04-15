<?php
class Share extends Controller {
	
	function fb_share(){
		$msg = $this->input->get('msg');
		
		$facebook = new Facebook(array(
		    'appId'  => '164948536873380',
		    'secret' => '5a05021a43704c1b2ac3c6dbb633a724',
		    'cookie' => true
		));
		
		# Let's see if we have an active session
		$session = $facebook->getSession();
//		var_dump($session);
		if(!empty($session)) {
			try{
				$user = $facebook->api('/me/feed', 'post', array('message'=> urldecode($msg), 'cb' =>site_url()  . 'share/fb_share?msg=' . urlencode($msg)));
				 if(!empty($user)){
			     	$this->load->view('statics/fb_msg');
			     	return;
			     }
			     
		    } catch (Exception $e){
		    	$url = $facebook->getLoginUrl(array(
					     'req_perms' => 'user_about_me,email,status_update,publish_stream,user_photos',
					     'next' =>  site_url()  . 'share/fb_share?msg=' . urlencode($msg),
					     'cancel' => site_url()
					 ));
		    	redirect($url);
		    }
		}else {
		    $url = $facebook->getLoginUrl(array(
					     'req_perms' => 'user_about_me,email,status_update,publish_stream,user_photos',
					     'next' =>  site_url()  . 'share/fb_share?msg=' . urlencode($msg),
					     'cancel' => site_url()
					 ));
		    redirect($url);
		}
	}
	
	function tw_share(){
		redirect('http://www.twitter.com/home?status=' . urlencode($this->input->get('msg')));
	}
	
	function email_share($from = null){
		if($from == null){
			redirect('/');
		}
		try{
			if($from == 'send'){
				$template = 'mail/send_card';
				$subject = 'Thank you';
			}else if($from == 'postcard'){
				$subject = 'Check out Epic Thanks';
				$template = 'mail/share_card';
			}
			
			$data['url'] = urldecode($this->input->get('link'));
			$data['message'] = urldecode($this->input->get('message'));
			$name = urldecode($this->input->get('name'));
			$to_email = urldecode($this->input->get('to_email'));
			$from_email = urldecode($this->input->get('from_email'));
				
			$this->email->clear();
			$this->email->from($from_email, $name);
			$this->email->to($to_email);
			//$this->email->cc('shivaas@gmail.com');
			$this->email->subject($subject);
			$email = $this->load->view($template, $data, TRUE);  
			$this->email->message($email);
			
			if(!$this->email->send()) {
				echo "Oops! There was an error in sending your email at this time. Please try again in a bit!";
				//show_error($this->email->print_debugger(), 500);
				return;
			}else{
				echo "Your message has been sent.";
				return;
			}
		}catch(Exception $e){
			echo "Oops! There was an error in sending your email at this time. Please try again in a bit!";
		}
	}
}