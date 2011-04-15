<script type="text/javascript">
jQuery(document).ready(function() {
  jQuery('#mycarousel2').jcarousel();
});
</script>
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
	var msg = $('#share_msg').val();
	href = "http://twitter.com/home?status="  + encodeURIComponent(msg);
	window.open(href, 'Share your gratitude',"status=1,height=400,width=900");
  });
	 
  $('#fb-share').click(function(e){
		e.preventDefault();
		var msg = $('#share_msg').val();
	    var href = "<?php echo site_url() . 'share/';?>";
		href += "fb_share?msg="  + encodeURIComponent(msg);
		window.open(href, 'Share your gratitude',"status=1,height=400,width=900");
		return;
  });

  try{
	  var the_timeout = 0;
		$.ajax({
		    dataType: "json", 
		    url: '<?php echo site_url() . 'postcard/json'?>',
		    success: function(data) {
				var count = 0;
			    var cards = new Array();
			    var currentIndex = 0;
			    $.each(data, function(index, card) {
			        cards[count] = card.post_content;
//					console.log(card.post_content);
			        //$('#home_postcard_preview').append('<div id="' + count + '" style="display:none">' + card.post_content + '</div'); 
			        count++;
			    });

				//the_timeout = setInterval('rotateCards()', 5000);
			    
			    rotateCards = function (){
			    	$('#home_postcard_preview').hide();
			        $('#home_postcard_preview').html(cards[currentIndex]);
			        $('#home_postcard_preview').fadeIn('fast');
			
			        the_timeout = setTimeout("rotateCards();", 5000);
			        if(currentIndex < count)
			        	currentIndex = currentIndex + 1;
			        else
			        	currentIndex = 0;
			    };

			    rotateCards();
		        
		    }   
		   });
	}catch(err){
//			alert(err);
	}
		
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
	<li><img src="i/m/mama_lucy.png"></li>
	<li><img src="i/m/maggie_doyne.png"></li>
	<li><img src="i/m/suraya_pakzad.png"></li>
	<li><img src="i/m/renu_shah_bagaria.png"></li>
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
	<li class="moreinfo"><img src="i/more_info.png" alt="more info" /></li>
	<li class="about_mamas"><img src="i/about_the_mamas.png"
		alt="about the mamas" /></li>
	<li class="epic_change"><img src="i/about_epic_change.png"
		alt="about epic change" /></li>
</ul>
</div>
<!--sidebar1-->

<div id="main" class="grid_8">
<div class="instructions">
<h2><img src="i/instructions.gif" alt="Instructions" /></h2>
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
<h2><img src="i/twitter.gif" alt="twitter" /></h2>
<div class="wrapper">
<div class="twittershare"></div>
<div class="tweets">
<dl>
	<dt><img></dt>
	<dd>I love my mama and her strength and optimism inspires me every day.
	Show a mama you love her today: www.tomamawithlove.org #tomamawithlove</dd>
</dl>
</div>
</div>
</div>
<!--twitter-->

<div class="blog grid_4 alpha">
<h2><img src="i/blog.gif" alt="blog" /></h2>
<ul>
	<li>Blog here</li>
</ul>
</div>

<div class="partners grid_4 omega">
<h2><img src="i/partners.gif" alt="partners" /></h2>
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
<h2><img src="i/facebook.gif" alt="facebook" /></h2>
<div class="fbplugin"><img src="i/fb.gif" /></div>
</div>

<div class="team">
<h2><img src="i/team.gif" alt="team" /></h2>
<ul>
	<li>Team here</li>
</ul>
</div>

</div>
<!--sidebar2--> <br class="clear" />
</div>
<!--tmwlinfo-->
