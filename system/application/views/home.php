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
<div class="page_content">
	<div id="first_block">

		<div id="big_tweet">
 			<div id="home_postcard_preview">
 			</div>
		</div>
		<div id="share_greatful">
		    <div style="height:15px;width:100%;display:block;">
		      <p class="limit" id="tw_limit" style="text-align:right;margin:0 29px 0 0;"><span id="char-count">140</span> characters</p>
		    </div>
		     <form action="<?php echo site_url(); ?>postcard/design" method="post">
			    <div class="form"> 
			        <textarea id="share_msg" name="share_msg">[insert what your grateful heart holds here]. Share your grateful heart at www.epicthanks.org #epicthanks #tweetsgiving</textarea>
			     </div>
		        <div class='form'>     
			          <div id="share_on">
			            <span>
			            <a href="#" id="tw-share">Post this to Twitter</a>
			            </span>
			            <span><a href="#" style="margin:4px 0 0 0;" id="fb-share">Post this to Facebook</a></span>
			          </div>
			          <div id="share">
			            <input type="submit" name="share" value="share" id="share_button"/>
			          </div>
		        </div>
		      </form>
        </div>  	
			<div id="give_greatful">
			  <p class="form" style="font-size:10px;clear:both;">
			  	Contributions will be invested in <a href="<?php echo site_url() .'statics/changemakers';?>">these remarkable changemakers</a>. Give $100+ to be included in our honorary global gratitude parade below.
			  </p>	 
				<form action="<?php echo site_url() . 'payment/new_payment';?>" method="post">
					<div class='form'>
						Amount: <select name="amount">
							<option value="10.00">$10.00</option>
							<option value="20.00">$20.00</option>
							<option value="25.00" selected="selected">$25.00</option>
							<option value="50.00">$50.00</option>
							<option value="100.00">$100.00</option>
							<option value="250.00">$250.00</option>
							<option value="500.00">$500.00</option>
							<option value="1,000">$1,000.00</option>
							<option value="2,500.00">$2,500.00</option>
							<option value="5000.00">$5,000.00</option>
						</select>

						Currency: <select name="currencyCodeType">
							<option value="USD">USD</option>
							<option value="GBP">
								GBP
							</option>
							<option value="EUR">
								EUR
							</option>
							<option value="JPY">
								JPY
							</option>
							<option value="CAD">
								CAD
							</option>
							<option value="AUD">
								AUD
							</option>
						</select>
					</div>
					<div class='form'>			
						Pay Using:&nbsp;&nbsp;
						<input name="pay_option" type="radio" value="2" checked="checked" /> Credit Card
						<input name="pay_option" type="radio" value="1" /> Paypal
					</div>	
					<div class="form">
						<div class="paypal_img" style="font-size:12px">
							<input type="checkbox" name="give_epic" value="yes" checked="checked"/> 
							Add 10% to my gift to support the work of <a href="http://www.epicchange.org/" target="_blank" style="text-decoration:underline;color:#123242;">Epic Change.</a>
						</div>
						
						<input type="submit" name="give" value="give" id="submit_give"/>
					</div> 
					<input type="hidden" name="postcard_id" value="<?php echo rand();?>" />
					<input type="hidden" name="payment_type" value="homepage_donation" /> 
					<input type="hidden" name="item_name" value="Epic Thanks Donation" />
				</form>
			</div>
		</div>	
		<div id="second_block">
			<div id="greatful_soles">
				<p id="investment"><?php echo $donation_count;?></p>
				<p id="collection">$<?php echo number_format(ceil($donation_amount) + COLLECTIONS);?></p>
				<p id="changemaker">3</p> 
				<p id="meet_them"><a href="<?php echo site_url() . 'statics/changemakers'?>">meet them</a></p>
			</div>	
		</div>
		<div id="global_parade">
			<div id="global_g_parade">global gratitude parade</div>
			<p id="what_this"><a href="#" id="what-block">(What is this?)</a></p>
			<ul id="mycarousel2" class="jcarousel-skin-tango">
		      	<?php foreach($parade as $p):?>
		        <li>
		        <?php 
		        	if($p->url)
		        		echo '<a href="'. $p->url . '" target="_blank"><img height="73px" width="73px" src="'. $p->image_url . '"/></a>';
		        	else
		        		echo '<img src="'. $p->image_url . '"/>';
		        ?>
		          <p style="font-size:11px;width:100%;text-align:center;"><?php echo $p->name;?></p>
		        </li>
		        <?php endforeach;?>
		      </ul>
		</div>		
		<div id="love_block">
			<div id="facebook_love" class="love_blocks">
				<p class="fb_love">
					<fb:activity site="www.epicthanks.org" font="lucida grande" border_color="#fff" recommendations="false" height="350" width="200" border_color="#fffff" header="false"></fb:activity>
				</p>
			</div>
			<div id="twitter_love" class="love_blocks"> 
				<div id="twitterFeed"></div>
			</div>
			<div id="blog_love" class="love_blocks">
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

			<div id="we_love" class="love_blocks love_blocks_last">
				<p style="font-size:16px;text-align:center;" id="volunteer">100% volunteer-powered</p>
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
	</div>
<div id="dialog" style="display:none">
	<p>The grateful souls pictured here have generously contributed $100 or more in celebration of Epic Thanks.</p>
	<br/>
	<p>Feeling grateful? Just give $100 (or more) and you'll appear here too.</p>
</div>