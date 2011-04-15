<div class="page_content" id="view_card">
  <div id="view_card_title">
    view card
  </div>
  	<?php foreach($cards as $postcard):?>
	<div id="postcard_section">
		<div id="postcard_preview">
			<?php echo $postcard['post_content'];?>
		</div>
		<div class="sharing_options" style="border:none;">
		    <p style="margin:8px 0;font-size:18px;">Share this note</p>
		   	<div id="share_card_on">
		   		<div style="margin:5px;float:left;clear:none">
					<a href="http://twitter.com/share" class="twitter-share-button" data-url="<?php echo site_url() . 'card/' . $postcard['post_id'];?>" data-count="vertical" data-counturl="<?php echo site_url() . 'card/' . $postcard['post_id'];?>" data-text="check out this heartfelt thank you postcard from the #EpicThanks site. happy #tweetsgiving indeed :) pls RT">Tweet</a>
				</div>
				<div style="margin:5px;float:left;clear:none">
		  	  		<a name="fb_share" type="box_count" href="<?php echo site_url() . 'card/' . $postcard['post_id'];?>"></a> 
		  	  	</div> 
		  	  	<br/>&nbsp;
	    	  </div>
	    	  <br/>&nbsp;<br/>
	  	  	<fb:like href="<?php echo site_url() . 'card/' . $postcard['post_id'];?>" show_faces="true" width="300" font="lucida grande"></fb:like>
	  	  	<br/>&nbsp;<br/>
	  	  	<a href="<?php echo site_url() . 'card/' . $postcard['post_id'];?>" class="comment-count">View Comments</a>
		  </div>
	  </div>
	<div class="clear">&nbsp;</div>
	<Br/>
	<?php endforeach;?>
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<script src="http://static.ak.fbcdn.net/connect.php/js/FB.Share" type="text/javascript"></script>
  <div class="clear">&nbsp;</div>
  
  <p id="pagination" align="center">
	<?php
		if($page != 1)
			echo '<a href="'.base_url().'postcard/cards/'.($page-1).'" style="padding:5px">&laquo; new</a>';
	
		$i=1;
		while(($i-1)*$limit < $total_posts) {
			if($i != $page) {
				echo '<a href="'.base_url().'postcard/cards/'.$i.'" style="padding:5px;">'.$i.'</a>';
			} else {
				echo '<span style="padding:5px;">'.$i.'</span>';
			}
			$i++;
		}
		
		if($page*$limit < $total_posts) {
			echo '<a href="'.base_url().'postcard/cards/'.($page+1).'" style="padding:5px">older &raquo;</a>';
		}	 
	?>
	</p>			  
</div>