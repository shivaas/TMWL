      <div id="header">
        <div id="logo">
          <a href="<?php echo site_url();?>">epic thanks</a>
        </div>
        <div id ="top_navigation">
          <ul>
            <li <?php if($this->router->class == 'home') echo'class="active"';?>><a href="<?php echo site_url();?>">HOME</a></li>
            <li <?php if($this->router->method == 'cards') echo'class="active"';?>><a href="<?php echo site_url() . 'postcard/cards/';?>">CARDS</a></li>
            <li <?php if($this->router->method == 'changemakers') echo'class="active"';?>><a href="<?php echo site_url() . 'statics/changemakers';?>">CHANGEMAKERS</a></li>
            <li <?php if($this->router->method == 'about') echo'class="active"';?>><a href="<?php echo site_url() . 'statics/about';?>">ABOUT</a></li>
          </ul>  
          <div id="twitter_facebook">
          <?php /* if(Users::user()):?>
            	Logged in as: <a href="http://www.<?php echo Users::user()->oauth_provider . '.com/' . Users::user()->username;?>"><?php echo $this->session->userdata('username');?></a>
            	<img src="<?php echo Users::user()->profile_avatar; ?>" alt="profile_pic" width="30px"/>
            	<a href="<?php echo site_url() . 'user/logout';?>">Logout</a>
            <?php else:?>
            	<a href="<?php echo site_url() . 'user/twitter_login'; ?>"><img src="<?php echo site_url() . 'images/sign-in-with-twitter-l.png'; ?>" alt="twitter login" /></a>
            	<a href="<?php echo site_url() . 'user/facebook_login'; ?>"><img src="<?php echo site_url() . 'images/fb_login-button.png'; ?>" alt="facebook login" /></a>
            <?php endif; */ ?>
            <?php if($this->router->class != 'postcard'):?>
            	<fb:like show_faces="true" width="300" font="lucida grande"></fb:like>
            	<div class="clear"></div>
				<div class="tweetmeme_button">
				  <a href="http://twitter.com/share?url=<?php echo site_url();?>" class="twitter-share-button" data-url="<?php echo site_url();?>" data-counturl="<?php echo site_url();?>" data-text="happy #tweetsgiving! what r u grateful 4? watch #epicthanks & generosity pour in from across the globe & add urs @ ">Tweet</a>
				</div>
            <?php endif;?>
          </div>  
        </div>
        <div id="header_text">
          <p>a global celebration of gratitude and giving that honors inspirational changemaker who created hope in our world</p>
          <a href="<?php echo site_url() . 'postcard/design'; ?>">create a thank you note</a>
        </div>  
      </div>