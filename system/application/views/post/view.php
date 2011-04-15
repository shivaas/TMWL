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
<?php 
	print_r($post);
	$post_content = json_decode($post['post_content'], true);
?>
  <div id="post_section">
		<div id="left-col" class="column">
			<img src="<?php echo base_url();?>images/created-for.png" />
			<p class="createdFor" id=""><?php echo $post_content['created_for'];?></p>
			<p><img src="http://www.tomamawithlove.org/wp-content/uploads/2010/05/mama-1131-100x100.jpg"  height="100" /></p>
			<img src="<?php echo base_url();?>images/created-by.png" />
			<p class="createdBy" id=""><?php echo $post_content['created_by'];?></p>
			<p><img src="http://www.tomamawithlove.org/wp-content/uploads/2010/05/creator-1131-100x100.jpg" height="100" /></p>
			<?php if($post_content['excerpt']):?>
				<p class="createdText"><?php echo $post_content['excerpt']; ?></p>
			<?php endif;?>
			
		</div>
		
		<div id="center-col" class="column">
			<div id="tabs">
				<ul id="tabsnav">
					<?php if(count($media['images']) >0):?>
						<li class="timages"><a href="#tab-images">Images</a></li>
					<?php endif;?>
					<?php if(count($media['videos']) >0):?>
						<li class="tvideos"><a href="#tab-images">Videos</a></li>
					<?php endif;?>
					<?php if($post_content['excerpt']):?>
						<li class="twords"><a href="#tab-images">Words</a></li>
					<?php endif;?>
					<li>
						<iframe src="http://www.facebook.com/plugins/like.php?href=http%3A%2F%2Fwww.tomamawithlove.org%2Fheartspaces%2F1131&amp;layout=button_count&amp;show_faces=false&amp;width=100&amp;action=like&amp;font=tahoma&amp;colorscheme=light" scrolling="no" frameborder="0" allowTransparency="true" style="border:none; overflow:hidden; width:80px; height:20px; margin:7px 0 0 20px;"></iframe>
					</li>
				</ul>
				<?php if(count($media['images']) >0):?>	
					<div id="tab-images">
						<ul id="heartspace-photos" class="heartspace-visuals jcarousel-skin-ie7">
							<?php foreach($media['images'] as $photo) : ?>
	
								<li><a href="<?= $photo['url']; ?>" class="oembed"></a></li>
	
							<?php endforeach; ?>
						</ul>
					</div>
				<?php endif;?>
				<?php if(count($media['videos']) >0):?>	
					<div id="tab-videos">
						<ul id="heartspace-videos" class="heartspace-visuals">
							<?php $findme   = '=';						$findma   = '&';										$pose = strpos($videos[0], $findme);								$posa = strpos($videos[0], $findma);							 if ($posa===false) { $posa = strlen($videos[0]); }						$rest = substr($videos[0], $pose+1, $posa);?>						
							<li>
								<br/>
								<object width="425" height="344"><param name="movie" value="http://www.youtube.com/v/<?= $rest; ?>&hl=en_US&fs=1&rel=0"></param><param name="allowFullScreen" value="true"></param><param name="allowscriptaccess" value="always"></param><embed src="http://www.youtube.com/v/<?= $rest; ?>&hl=en_US&fs=1&rel=0" type="application/x-shockwave-flash" allowscriptaccess="always" allowfullscreen="true" width="425" height="344"></embed></object>
							</li>
						</ul>
						<div class="clear">&nbsp;</div>
					</div>
				<?php endif;?>
				<?php if($post_content['excerpt']):?>
					<div id="tab-words" style="overflow:auto"><?php echo $post_content['excerpt']; ?></div>
				<?php endif;?>
			</div>
		</div>
		
		<div id="right-col" class="column">

			<p class="totalAmount">$<?php echo $total_donation; ?></p>

			<img src="<?php echo base_url() . 'images/has-been-donated.png'; ?>" />

			<br /><br />

			<a href="https://tomamawithlove.org/donate/checkout-add-funds.php?id=<?php echo $post_id; ?>"><img src="<?php echo base_url() . 'images/add-funds-button.png'; ?>" hover="<?php echo base_url() . 'images/add-funds-button-hover.png'; ?>" class="hover" /></a>

			<a href="#tag-the-wall"><img src="<?php echo base_url() . 'images/tag-the-wall-button.png'; ?>" hover="<?php echo base_url() . 'images/tag-the-wall-button-hover.png'; ?>" class="hover" /></a>

			<a href="/create-heartspace"><img src="<?php echo base_url() . 'images/create-a-heartspace-button.png'; ?>" hover="<?php echo base_url() . 'images/create-a-heartspace-button-hover.png'; ?>" class="hover" /></a>

			<div id="share">
				<table>
				<tr>
					<td><a href="http://twitter.com/home?status=best%20mother's%20day%20gift%20ever.%20any%20mom%20would%20love%20this:+<?php echo current_url(); ?>+%23ToMamaWithLove" target="_blank"><img src="<?php echo base_url() . 'images/icon-twitter.png'; ?>" /></a>
					&nbsp;
					<a href="http://www.facebook.com/sharer.php?u=<?echo $post_id; ?>&t=best%20mother's%20day%20gift%20ever.%20any%20mom%20would%20love%20this."><img src="<?php echo base_url() . 'images/icon-facebook.png'; ?>" /></a>
					&nbsp;
					<a href="mailto:ENTER_EMAIL_ADDRESS?subject=a%20mother's%20day%20site%20you've%20got%20to%20see&body=Just%20found%20this%20great%20Mother's%20Day%20site%20at%20<?php echo current_url(); ?>.%20Thought%20it might%20make%20a%20perfect%20Mother's%20Day%20gift%20for%20someone%20you%20know%20;)"><img src="<?php echo base_url() . 'images/icon-mail.png'; ?>" /></a>
					&nbsp;
					<img src="http://www.tomamawithlove.org/wp-content/uploads/2010/05/badge-tiny.png" id="blog-embed" />
				</tr>
				</table>
			</div>
				<img src="<?php echo base_url() . 'images/Search-button.png'; ?>"  id="search-button" />
				<img src="<?php echo base_url() . 'images/search-for-a-mama.png'; ?>" id="search-text" />
				<div id="heartspace-search-form">
					<img src="<?php echo base_url() . 'images/enter-mamas-name.jpg'; ?>" /><br /><br />
					<form id="heartspace-search-query">
						<input type="text" name="heartspace-input" id="heartspace-input" /> 
						<img src="<?php echo base_url() . 'images/Search-button.png'; ?>" id="heartspace-query" />
					</form>
					<div id="heartspace-search-results"></div>
				</div>
				<div class="clear"></div>
		</div>
		
  </div>
	  <div class="clear">&nbsp;</div>
	  <div id="disqus_thread"></div>
		<script type="text/javascript">
		var disqus_developer = 1;
		var disqus_shortname = 'tomamawithlove';
		var disqus_url = '<?php echo base_url() . 'post/view/' . $post_id;?>';
		  var disqus_identifier = <?php echo $post_id;?>; //[Optional but recommended: Define a unique identifier (e.g. post id or slug) for this thread] 
		  (function() {
		   var dsq = document.createElement('script'); dsq.type = 'text/javascript'; dsq.async = true;
		   dsq.src = 'http://epicthanks.disqus.com/embed.js';
		   (document.getElementsByTagName('head')[0] || document.getElementsByTagName('body')[0]).appendChild(dsq);
		  })();
		</script>
		<noscript>Please enable JavaScript to view the <a href="http://disqus.com/?ref_noscript=epicthanks">comments powered by Disqus.</a></noscript>
		<a href="http://disqus.com" class="dsq-brlink">blog comments powered by <span class="logo-disqus">Disqus</span></a>
			  
</div>