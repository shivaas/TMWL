<div class="page_content">
<br/>
  <div id="our_story">
  <?php //echo $this->session->userdata('amount');
      if($this->session->userdata('amount') >= PARADE_CUTOFF):
      	if($added_to_parade):
    ?>
		    <div style="margin:0 auto;display:block;width:80%;">
		    <?php if($this->session->flashdata('anon_donation')):?>
		    	<h3>Don't worry, we won't tell a soul...</h3>
		    	<p>but you should know how grateful we are for your beautiful, quiet act of generosity. May your kindness be paid back to you a thousand-fold.</p>
		    <?php else:?>
		      <h3>Welcome to our global gratitude parade!</h3>
		      <p>You're in! Check out your grateful face on the front page of <a href="<?php echo site_url();?>">www.EpicThanks.org</a></p><br/>
		      <p>Thanks again for bringing your grateful heart to the party.</p>
		    <?php endif;?>
		    </div>
      	<?php else:?>
	    <div style="margin:0 auto;display:block;width:80%;">
	      	<h3>You're invited to join our global gratitude parade!</h3>
	      	Because you're so generous and we're so grateful, we'd like you to appear in the global gratitude parade on the front page of this site.<br/>
			Login via twitter or facebook so we can add your beautiful face to the parade.
			<Br/>
	      <div class="clear"></div>
	      <div style="margin:5px;float:left;clear:both;margin-left:70px">
				<a href="<?php echo site_url() . 'user/twitter_login'; ?>"><img src="<?php echo site_url() . 'images/sign-in-with-twitter-l.png'; ?>" alt="twitter login" /></a>
			</div>
			<div style="margin:5px;float:left;clear:none;">
				<a href="<?php echo site_url() . 'user/facebook_login'; ?>"><img src="<?php echo site_url() . 'images/fb_login-button.png'; ?>" alt="facebook login" /></a>
			</div>
			<div style="clear:both;width:100%; margin:5px auto;">
				Keep me anonymous: if you're parade phobic or are the beautiful kind of soul that prefers to keep their kindness &amp; generosity anonymous, <a href="<?php echo site_url() . 'payment/thankyou?type=gratitude_parade'; ?>">click here.</a>
			</div>
			  <?php $this->session->set_userdata('return_url', 'payment/thankyou?type=gratitude_parade');?>
      </div>
      <?php endif;?>
      <div id="about_content">
	      <h3>Thank you</h3>
	      <p>
	        Thank you for your contribution to Epic Thanks! 
	      </p>
	      <div class="clear"></div>
  	  </div>
  	<?php endif;?>  
</div>  