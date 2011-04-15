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
  <div id="post_section">
		<div id="left-col" class="column">
			<img src="http://www.tomamawithlove.org/wp-content/themes/2mamawithlove/assets/created-for.png" />
			<p class="createdFor" id="">Elena</p>
			<p><img src="http://www.tomamawithlove.org/wp-content/uploads/2010/05/mama-1131-100x100.jpg"  height="100" /></p>
			<img src="http://www.tomamawithlove.org/wp-content/themes/2mamawithlove/assets/created-by.png" />
			<p class="createdBy" id="">ksiddall</p>
			<p><img src="http://www.tomamawithlove.org/wp-content/uploads/2010/05/creator-1131-100x100.jpg" height="100" /></p>
			<p class="createdText">You raised me to be a part of things like this.</p>
		</div>
		
		<div id="center-col" class="column">
			<div id="tabs">
				<ul id="tabsnav">
					<li class="timages"><a href="#tab-images">Images</a></li>
					<li><iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tomamawithlove.org%2Fheartspaces%2F1131&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=tahoma&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:80px; height:20px; margin:7px 0 0 20px;"></iframe></li>
				</ul>	
				<div id="tab-images">
					<ul id="heartspace-photos" class="heartspace-visuals jcarousel-skin-ie7">
						<li><a href="http://www.flickr.com/photos/kirasiddall/4581672825/?edited=1" class="oembed"></a></li>
					</ul>
				</div>
			</div>
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