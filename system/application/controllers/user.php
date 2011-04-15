<?php
Class User extends Controller{
	
	
	function login(){
		//$data['content'] = 'login';
		$this->load->view('login');
	}
	
	
	/**
	 * 
	 * Method to initiate twitter login for the website. This redirect the user to the twitter oauth page, and if app already has permission, sends it back to twitter_callback
	 * @author shivaas
	 */
	function twitter_login(){
		$twitteroauth = new Twitteroauth();
		$twitteroauth->createNewRequest('juegijb82OHpDxviFtkq5w', 'BcLl9IQo3mPuoixPySzEHBCUFv1GMgYnYKKawJwpc8');
		
		// Requesting authentication tokens, the parameter is the URL we will be redirected to
		$request_token = $twitteroauth->getRequestToken(site_url() . 'user/twitter_callback');
//		var_dump($request_token);

		// Saving them into the session
		$_SESSION['oauth_token'] = $request_token['oauth_token'];
		$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
		
		$this->session->set_userdata('oauth_token',$request_token['oauth_token']); 
		$this->session->set_userdata('oauth_token_secret',$request_token['oauth_token_secret']);
		
		// If everything goes well..
		if($twitteroauth->http_code==200){
		    // Let's generate the URL and redirect
		    $url = $twitteroauth->getAuthorizeURL($request_token['oauth_token']);
		    redirect($url);
		} else {
		    // It's a bad idea to kill the script, but we've got to know when there's an error.
		    die('Something wrong happened.');
		}
				
	}
	
	/**
	 * 
	 * Callback method for twitter to return to once the user has given access.
	 * @author shivaas
	 */
	function twitter_callback(){
		if($this->input->get('oauth_verifier') && $this->session->userdata('oauth_token') && $this->session->userdata('oauth_token_secret')){
		    // We've got everything we need
		    // TwitterOAuth instance, with two new parameters we got in twitter_login.php
		    $twitteroauth = new Twitteroauth();
			$twitteroauth->createNewRequest('juegijb82OHpDxviFtkq5w', 'BcLl9IQo3mPuoixPySzEHBCUFv1GMgYnYKKawJwpc8',$this->session->userdata('oauth_token'), $this->session->userdata('oauth_token_secret'));
			
			// Let's request the access token
			$access_token = $twitteroauth->getAccessToken($_GET['oauth_verifier']);
			// Save it in a session var
			$this->session->set_userdata('access_token',$access_token);
			// Let's get the user's info
			$user_info = $twitteroauth->get('account/verify_credentials');
//			$pic = $twitteroauth->get($user_info->id . '/users/profile_image',array('screen_name' => $user_info->screen_name . '.json', 'size'=>'bigger'));
//			print_r($pic);
//			return;
			// Print user's info
			//print_r($user_info);
			
			if(isset($user_info->error)){
			    // Something's wrong, go back to square 1
			    redirect('user/twitter_login');
			} else {
			    
			    $user = Users::find_by_id($user_info->id, 'twitter');
			
			    if(!$user){
			    	// If not, let's add it to the database
			    	
			    	$u = new Users();
			    	$u->oauth_provider = 'twitter';
			    	$u->username = $user_info->screen_name;
			    	$u->oauth_uid =  $user_info->id;
			    	$u->oauth_token = $access_token['oauth_token'];
			    	$u->oauth_secret = $access_token['oauth_token_secret'];
			    	$u->profile_avatar = $user_info->profile_image_url;
			    	$u->save();

			    }else{
			    	$user->oauth_token = $access_token['oauth_token'];
			    	$user->oauth_secret = $access_token['oauth_token_secret'];
			    	$user->profile_avatar = $user_info->profile_image_url;
			    	$user->save();
			    }
			    
			    Users::login($user_info->id,'twitter');
			    if($this->session->userdata('return_url')){					
		    		redirect($this->session->userdata('return_url'));
		    		$this->session->unset_userdata('return_url');
			    }
		    	else
		    		redirect('/');
			}
		} else {
		    // Something's missing, go back to square 1
//		    echo $this->input->get('oauth_verifier') . '<br>';
//		    echo $this->session->userdata('oauth_token') . '<br>';
//		    echo $this->session->userdata('oauth_token_secret') . '<br>';
//		    echo " something is wrong";
			redirect('user/twitter_login');
		}
				
	}
	
	
	function facebook_login(){
		# Creating the facebook object
		$facebook = new Facebook(array(
		    'appId'  => '164948536873380',
		    'secret' => '5a05021a43704c1b2ac3c6dbb633a724',
		    'cookie' => true
		));
		
		# Let's see if we have an active session
		$session = $facebook->getSession();
		
		if(!empty($session)) {
		    # Active session, let's try getting the user id (getUser()) and user info (api->('/me'))
		    try{
		        $uid = $facebook->getUser();
		        $param  =   array(
				   'method'  => 'users.getinfo',
				   'uids'       => $uid,
				   'fields'     => 'uid, username, name, profile_url, pic_big',
				   'callback'  => ''
				);
				$user = $facebook->api($param);
//        		var_dump($user);
		    } catch (Exception $e){
		    	$url = $facebook->getLoginUrl(array(  
					     'req_perms' => 'user_about_me,email,status_update,publish_stream,user_photos',
					     'next' =>  site_url()  . 'user/facebook_login',
					     'cancel' => site_url()
					 ));
		    	redirect($url);
		    }
		
		    if(!empty($user)){
		        # User info ok? Let's print it (Here we will be adding the login and registering routines)
		        //print_r($user);
		        $db_user = Users::find_by_id($user[0]['uid'], 'facebook');
		        
		        $s = $this->input->get('session');
        		$access_token = json_decode($s);
//        		print_r($access_token);
//        		echo '<br>access token: ' . $facebook->getAccessToken() . '<br>';
        		
		        if(!$db_user){
			    	// If not, let's add it to the database
			    	
			    	$u = new Users();
			    	$u->oauth_provider = 'facebook';
			    	if($user[0]['username'])
			    		$u->username = $user[0]['username'];
		    		else
		    			$u->username = $user[0]['name'];
		    			
			    	$u->oauth_uid =  $user[0]['uid'];
			    	$u->oauth_token = $facebook->getAccessToken();
			    	//$u->oauth_secret = $access_token->secret;
			    	$u->profile_avatar = $user[0]['pic_big'];
			    	$u->save();

			    }else{
			    	$db_user->oauth_token = $facebook->getAccessToken();
//			    	$db_user->oauth_secret = $access_token->secret;
			    	$db_user->save();
			    }
			    
			    Users::login($user[0]['uid'], 'facebook');					
		    	if($this->session->userdata('return_url')){					
		    		redirect($this->session->userdata('return_url'));
		    		$this->session->unset_userdata('return_url');
			    }
		    	else
		    		redirect('/');
		    	
		    } else {
		        # For testing purposes, if there was an error, let's kill the script
		        die("There was an error.");
		    }
		} else {
		    # There's no active session, let's generate one
		    $url = $facebook->getLoginUrl(array(  
					     'req_perms' => 'user_about_me,email,status_update,publish_stream,user_photos',
					     'next' =>  site_url()  . 'user/facebook_login',
					     'cancel' => site_url()
					 ));
		    redirect($url);
		}
	}
	
	/**
	 * Method to logout a user. Basically destroys session vars and user object.
	 * @author shivaas
	 */	
	function logout(){
		Users::logout();
		redirect('/');
	}
}