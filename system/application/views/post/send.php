<script type="text/javascript">
$(function(){
	var diagOpts = {
			closeOnEscape : true,
			draggable : false,
			modal : true,
			resizable : false,
			autoOpen: false,
			width : 300,
			title : 'Thank you!',
			position : ['center'],
			show : 'fade',
			hide : 'fade',
			buttons : {
				'Close' : function(){
					$('#dialog').dialog('close');
					$('#mail_dialog').dialog('close');
				}
			}
		};
	$('#dialog').dialog(diagOpts)
	
	  $('#mail_dialog').dialog({
	    closeOnEscape : true,
	    draggable : false,
	    modal : true,
	    resizable : false,
	    width : 500,
	    title : 'Send your thanks via email',
	    position : ['center', 100],
	    show : 'fade',
	    autoOpen: false,
	    hide : 'fade',
	    buttons : {
	      'Close' : function(){
	        $('#mail_dialog').dialog('close');
	      }
	    }
	  });

	  $('#share_email').click(function(e){
		e.preventDefault();
		$('#mail_dialog').dialog('open');
	  });

	  $('#send_mail').click(function(e){
			e.preventDefault();
			if(validateContactForm()){
				var full_name = $('form#email_form input[name=full_name]').val();
				var to_email = $('form#email_form input[name=to_email]').val();
				var from_email = $('form#email_form input[name=from_email]').val();
				var content = $('textarea#message').val();
				var link = '<?php echo site_url() . 'card/' . $postcard['post_id']; ?>';
				
				$('#form_status').html('Processing request... <img src="<?php echo site_url(); ?>images/ui-anim_basic_16x16.gif" alt="...working!"/>');
				$('#dialog').dialog('open');
				$.ajax({
					url: "<?php echo site_url() . 'share/email_share/send'?>",
					data: "name=" + encodeURI(full_name) + "&to_email=" + encodeURI(to_email) + "&from_email=" + encodeURI(from_email)  + "&message=" + encodeURI(content) + "&link=" + encodeURI(link),
					success: function(data){
									$('#form_status').hide().html(data).slideDown('slow');
								}
					});
			}
		});
});

var validateContactForm = function(){
	var to_email = $('form#email_form input[name=to_email]').val();
	var from_email = $('form#email_form input[name=from_email]').val();
	var content = $('textarea#message').val();
	var name = $('form#email_form input[name=full_name]').val();;
	var reg = /^([A-Za-z0-9_\-\.])+\@([A-Za-z0-9_\-\.])+\.([A-Za-z]{2,4})$/;
	
	if(name.length < 1){
		alert('Please enter a valid name.');
		$('form#email_form input[name=full_name]').focus();
		return false;
	}
	if(from_email.length <1){
		alert('Please enter a valid email address.');
		$('form#email_form input[name=from_email]').focus();
		return false;
	}
	if(reg.test(from_email) == false) {
		alert('Invalid Email Address. Please enter a valid email address.');
		$('form#email_form input[name=from_email]').focus();
		return false;
	}
	
	if(to_email.length <1){
		alert('Please enter a valid email address.');
		$('form#email_form input[name=to_email]').focus();
		return false;
	}
	
	if(reg.test(to_email) == false) {
		alert('Invalid Email Address. Please enter a valid email address.');
		$('form#email_form input[name=to_email]').focus();
		return false;
	}
	
	
    if(content.length <1){
		alert('Please enter a message.');
		$('form#email_form input[name=message]').focus();
		return false;
	}
	
	return true;
};

</script>

<?php //$added_to_parade = true; 
if($added_to_parade):?>
<script type="text/javascript">
$(function(){
	$('#parade_modal').dialog({
		 closeOnEscape : true,
		    draggable : false,
		    modal : true,
		    resizable : false,
		    width : 500,
		    title : 'Welcome to our global gratitude parade! ',
		    position : ['center', 100],
		    show : 'fade',
		    autoOpen: true,
		    hide : 'fade',
		    buttons : {
		      'Close' : function(){
		        $(this).dialog('close');
		      }
		    }
	});
});
</script>
<div id="parade_modal" style="display:none">
	<p>Because you're so generous and we're so grateful, we've added you to our global gratitude parade.</p><br/>&nbsp;<br/>
    <p>Check yourself out on the front page of <a href="<?php echo site_url();?>">www.EpicThanks.org</a></p>
</div>
<?php elseif($this->session->userdata('donation_id')):?>
<script type="text/javascript">
$(function(){
	$('#parade_modal').dialog({
		 closeOnEscape : true,
		    draggable : false,
		    modal : true,
		    resizable : false,
		    width : 500,
		    title : 'Thank you!',
		    position : ['center', 100],
		    show : 'fade',
		    autoOpen: true,
		    hide : 'fade',
		    buttons : {
		      'Close' : function(){
		        $(this).dialog('close');
		      }
		    }
	});
});
</script>
<div id="thanks_modal" style="display:none">
	<p>Your grateful gift has been processed. Now, unleash your grateful heart on the world. Share your masterpiece on twitter, facebook &amp; email to spread your gratitude across the globe.</p>
</div>
<?php endif;?>
<div id="dialog">
	<div id="form_status"></div>
</div>

<div class="page_content">
  <div id ="create_note">
    Create a note
  </div>
  <div id="send_card" class="postcard_block">
    <div class="select_card">Share your thank you note with the world!</div>
    
      <div id="postcard_preview">
        <?php echo $postcard['post_content'];?>
      </div>
	  <div class="sharing_options">
		  	<div id="share_card_on">
		      <p style="margin:8px 0;font-size:18px;">Share this note</p>
	  	   	<div id="share_card_on">
	  	   		<div id="twitter_icon">
	    	      <a target="_blank" class="custom-tweet-button" href="http://twitter.com/share?url=<?php echo site_url() . 'card/' . $postcard['post_id'];?>&text=have%20u%20added%20your%20thank%20u%20note%20to%20the%20global%20outpouring%20of%20gratitude%2C%20generosity%20%26%20goodness%20%40%20%23EpicThanks%3F%20here's%20mine%3A">Tweet</a>&nbsp;&nbsp;
				</div>
	    	  	<a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . 'card/' . $postcard['post_id'];?>"><img src="<?php echo site_url();?>images/facebook.jpg"></a>&nbsp;&nbsp;
	    	    <a href="#email" id="share_email"><img src="<?php echo site_url();?>images/share_email.jpg"></a>
	      	  </div>
	    	  	<div id="post_card_link">Note link:<br/> <?php echo site_url() . 'card/' . $postcard['post_id'];?></div>
	    	  	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like show_faces="true" width="300" font="lucida grande"></fb:like>
		  	</div>
	  		<div>
  	  			<a href="<?php echo site_url() . 'card/' .$postcard['post_id'] ?>" id="next_button">Finish</a>
    		</div>
		</div>
	</div>
</div>
<div id="mail_dialog" style="display:none;">
	<p>"Silent gratitude isn't much use to anyone." ~G.B. Stern </p>
	<p>Share what's in your grateful heart with someone you love.</p>
	<form id="email_form" action="#">
		<fieldset>
			<label for="first_name">Your name:</label><br/>
			<input type="text" name="full_name" />
		</fieldset>
		<fieldset>
			<label for="first_name">Your email:</label><br/>
			<input type="text" name="from_email" />
		</fieldset>
		<fieldset>
			<label for="first_name">Send to:</label><br/>
			<input type="text" name="to_email" />
		</fieldset>
		<fieldset>
			<label for="first_name">Note:</label><br/>
			<textarea rows="5" cols="30" name="message" id="message"></textarea>
		</fieldset>
		<fieldset>
			<em>Note: all fields are required.</em><br/><br/>
			<input type="submit" value="Send Mail" id="send_mail"/>
		</fieldset>
	</form>
</div>