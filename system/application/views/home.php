<script type="text/javascript">
$(function(){
   $('#dialog').dialog({
	    closeOnEscape : true,
	    draggable : false,
	    modal : true,
	    resizable : false,
	    width : 600,
	    title : 'What is the Global Gratitude Parade?',
	    position : ['center', 100],
	    show : 'fade',
	    autoOpen: false,
	    hide : 'fade',
	    buttons : {
			'Close' : function(){
				$(this).dialog('close');
			}
		}
	});

	$('#what-block').click(function(e){
		e.preventDefault();
		$('#dialog').dialog('open');
	});

  var max_chars = 140;
  updateChars($('#share_msg'), max_chars);
  
  $('#share_msg').keyup(function(){
    	updateChars($('#share_msg'), max_chars);
	});
  
  $('#tw-share').click(function(e){
  	e.preventDefault();
	var msg = $('#share_msg').val();
	href = "http://twitter.com/home?status="  + encodeURIComponent(msg);
	window.open(href, 'Share your gratitude',"status=1,height=400,width=900");
  });
	
});

var updateChars = function(targetDiv, max){
	var str = targetDiv.val();
    var len = str.length;
	if(len > max){
        str = str.substring(0,max);
        targetDiv.val(str);
    }
    len = str.length;
    $('#char-count').html(max - len);
};
</script>
<div
	id="heartspace" class="container_12">
<div id="mainheartspace" class="grid_9"><br />
</div>
<!--mainheartspace-->

<div id="sideheartspace" class="grid_3">
<ul id="tmwlmamas">
	<li><img src="<?php echo base_url()?>images/m/mama_lucy.png"></li>
	<li><img src="<?php echo base_url()?>images/m/maggie_doyne.png"></li>
	<li><img src="<?php echo base_url()?>images/m/suraya_pakzad.png"></li>
	<li><img src="<?php echo base_url()?>images/m/renu_shah_bagaria.png"></li>
</ul>
</div>
<!--sideheartspace-->

<div id="heartspacesearch" class="mamasearch"></div>
<!--heartspacesearch--> <br class="clear" />
</div>
<!--heartspace-->

<div id="tmwl"
	class="container_16">
<div id="sidebar1" class="grid_4">
<ul id="info">
	<li class="moreinfo"><img src="<?php echo base_url();?>images/more_info.png" alt="more info" /></li>
	<li class="about_mamas"><img src="<?php echo base_url();?>images/about_the_mamas.png"
		alt="about the mamas" /></li>
	<li class="epic_change"><img src="<?php echo base_url();?>images/about_epic_change.png"
		alt="about epic change" /></li>
</ul>
</div>
<!--sidebar1-->

<div id="main" class="grid_8">
<div class="instructions">
<h2><img src="<?php echo base_url();?>images/instructions.gif" alt="Instructions" /></h2>
<div class="wrapper">
<ul class="left">
	<li>1. Create a heartspace for a mom you love by giving $20 or more in
	her honor. Click here to start 2. Show your love by personalizing your
	heartspace with poems, photos, videos and artwork. 3. Send a link to
	the heartspace you've created. 4. Your mother's day present just
	changed the world.</li>
</ul>
</div>
</div>
<!--instructions-->

<div class="twitter">
	<h2><img src="<?php echo base_url();?>images/twitter.gif" alt="twitter" /></h2>
	<div class="wrapper">
		<div class="twittershare">
			<div style="height:15px;width:100%;display:block;">
		      <p class="limit" id="tw_limit" style="text-align:right;margin:0 29px 0 0;"><span id="char-count">140</span> characters</p>
		    </div>
			<textarea id="share_msg" name="share_msg">I love my mama and her strength and optimism inspires me every day. Show a mama you love her today: www.tomamawithlove.org #tomamawithlove</textarea>
			<Br/><a href="#" id="tw-share">Post this to Twitter</a>
		</div>
		<div class="tweets">
			<div id="twitterFeed"></div>
		</div>
	</div>
</div>
<!--twitter-->

<div class="blog grid_4 alpha">
<h2><img src="<?php echo base_url();?>images/blog.gif" alt="blog" /></h2>
	<ul>
		<?php foreach($blogs as $blog): ?>
			<li>
				<a target="_blank" href="<?php echo $blog['url'];?>"><?php echo $blog['content_title'];?></a><br>
				<span class="rssdesc"><?php echo shorten($blog['content'],20); ?></span>
			</li>					
		<?php endforeach;?>
	</ul>
	<p id="see_more_blog"><a href="<?php echo site_url() . 'home/blog_love';?>">See more...</a></p>
</div>

<div class="partners grid_4 omega">
<h2><img src="<?php echo base_url();?>images/partners.gif" alt="partners" /></h2>
<ul>
	<li>Partners</li>
</ul>
</div>
<br class="clear" />
</div>
<!--main-->

<div id="sidebar2" class="grid_4">
<div class="video"></div>

<div class="facebook">
<h2><img src="<?php echo base_url();?>images/facebook.gif" alt="facebook" /></h2>
<div class="fbplugin"><img src="<?php echo base_url();?>fb.gif" /></div>
</div>

<div class="team">
<h2><img src="<?php echo base_url();?>images/team.gif" alt="team" /></h2>
	<p style="margin-top:10px;font-size:16px;text-align:center;" id="volunteer">100% volunteer-powered</p>
	<div id="volunteers">
		<ul>
			<li><p><a target="_blank" href="http://www.twitter.com/lulutikololo"><img src="<?php echo site_url();?>/images/lulu.jpg" /></a></p><span>Creative</span></li>
			<li><p><a target="_blank" href="http://www.twitter.com/megharastogi"><img src="<?php echo site_url();?>/images/megha.jpg" /></a></p><span>Developer</span></li>
			<li><p><a target="_blank" href="http://www.twitter.com/shivaas"><img src="<?php echo site_url();?>/images/shivaas.jpg" /></a></p><span>Code Ninja</span></li>
			<li><p><a target="_blank" href="http://www.twitter.com/sanjspatel"><img src="<?php echo site_url();?>/images/sanjay.jpg" /></a></p><span>Cat Herder</span></li>
			<li><p><a target="_blank" href="http://www.twitter.com/StaceyMonk"><img src="<?php echo site_url();?>/images/tweeter_avatar.jpg" /></a></p><span>Founder</span></li>
			<li><p><a target="_blank" href="http://www.twitter.com/weareasilia"><img src="<?php echo site_url();?>/images/asilia.jpg" /></a></p><span>Designer</span></li>
		</ul>	 
	</div>	
	<p style="font-size:16px;padding:0 0 0 25px;margin-top:5px">Social media mob</p>
	<ul id="social_mob">
		<li>
		<?php $count = 1; foreach($listMembers as $member): 
				if(!in_array(strtolower($member['screen_name']),array('sanjspatel','shivaas','lulukitololo','staceymonk','mamalucy'))):
		?>
			<a target="_blank" href="http://twitter.com/<?php echo htmlspecialchars($member['screen_name']); ?>"><img src="<?php echo $member['profile_image_url']; ?>" alt="<?php echo htmlspecialchars($member['name']); ?>" width="45px" height="45px"/></a>
			<?php if($count%3 == 0) echo '</li><li>'; ?>
		<?php $count++; endif; endforeach; ?>
		</li>
	</ul>
</div>

</div>
<!--sidebar2--> <br class="clear" />
</div>
<!--tmwlinfo-->
