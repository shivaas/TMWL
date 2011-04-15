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
	    title : 'Email this card to a friend ',
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
					url: "<?php echo site_url() . 'share/email_share/postcard'?>",
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
<div id="dialog">
	<div id="form_status"></div>
</div>
<div id="mail_dialog" style="display:none;">
	<p>Enter the info below to share this card via email.</p>
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
			<textarea rows="5" cols="30" name="message" id="message">Epic Thanks is a massive outpouring of gratitude from across the globe. I found a card I knew you'd love.</textarea>
		</fieldset>
		<fieldset>
			<em>Note: all fields are required.</em><br/><br/>
			<input type="submit" value="Send Mail" id="send_mail"/>
		</fieldset>
	</form>
</div>
<div class="page_content" id="view_card">
<br/>
  <div id="postcard_section">
	<div id="postcard_preview">
		<?php echo $postcard['post_content'];?>
	</div>
	<div class="sharing_options">
	    <p style="margin:8px 0;font-size:18px;">Share this note</p>
	   	<div id="share_card_on">
			<div id="twitter_icon">
    	      <a target="_blank" class="custom-tweet-button" href="http://twitter.com/share?url=<?php echo site_url() . 'card/' . $postcard['post_id'];?>&text=check%20out%20this%20heartfelt%20thank%20you%20postcard%20from%20the%20%23EpicThanks%20site.%20happy%20%23tweetsgiving%20indeed%20%3A)%20pls%20RT">Tweet</a>&nbsp;&nbsp;
			</div>
  	  		<a href="http://www.facebook.com/sharer.php?u=<?php echo site_url() . 'card/' . $postcard['post_id'];?>"><img src="<?php echo site_url();?>images/facebook.jpg"></a>&nbsp;&nbsp;
  	    	<a href="#email" id="share_email"><img src="<?php echo site_url();?>images/share_email.jpg"></a>
    	  </div>	
  	  	<div id="post_card_link">Postcard link:<br/> <?php echo site_url() . 'card/' . $postcard['post_id'];?></div>
  	  	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script><fb:like show_faces="true" width="300" font="lucida grande"></fb:like>
	  </div>
  </div>
	  <div class="clear">&nbsp;</div>
	  <div id="disqus_thread"></div>
		<script type="text/javascript">
		var disqus_developer = 1;
		var disqus_shortname = 'epicthanks';
		  var disqus_identifier = <?php echo $postcard['post_id'];?>; //[Optional but recommended: Define a unique identifier (e.g. post id or slug) for this thread] 
		  (function() {
		   var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		   dsq.src = 'http://epicthanks.disqus.com/embed.js';
		   (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		  })();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=epicthanks">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
			  
</div>