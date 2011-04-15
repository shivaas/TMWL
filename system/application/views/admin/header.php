      <div id="header">
        <div id="logo">
          <a href="#">epic thanks</a>
        </div>
        <div id ="top_navigation">
          <ul>
            <li <?php if($this->router->method == 'home') echo'class="active"';?>><a href="<?php echo site_url(). 'admin/home';?>">HOME</a></li>
            <li <?php if($this->router->method == 'blogroll') echo'class="active"';?>><a href="<?php echo site_url() . 'admin/blogroll';?>">BLOGROLL</a></li>
            <li <?php if($this->router->method == 'donations') echo'class="active"';?>><a href="<?php echo site_url() . 'admin/donations';?>">DONATIONS</a></li>
          </ul>  
          <div id="twitter_facebook">
          <?php if(Users::user()):?>
            	Logged in as: <a href="http://www.<?php echo Users::user()->oauth_provider . '.com/' . Users::user()->username;?>"><?php echo $this->session->userdata('username');?></a>
            	<img src="<?php echo Users::user()->profile_avatar; ?>" alt="profile_pic" width="30px"/>
            	<a href="<?php echo site_url() . 'user/logout';?>">Logout</a>
            <?php endif; ?>
          </div>  
        </div>
        <div id="header_text">
          <p>a global celebration of gratitude and giving that honors inspirational changemaker who created hope in our world</p>
        </div>  
      </div>