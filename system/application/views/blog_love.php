<div class="page_content">
  <div id="our_story" class="blog_love">
  <br/>
    <h3>Blogs covering Epic Thanks</h3>
    
    <div id="about_content">
      
      <?php //echo $this->rssfeed->RSS_Display('http://feeds.feedburner.com/EpicChange?format=xml',3)?>
      	<ul>
	      	<?php foreach($blogs as $blog): ?>
	      	<li>
	      		<a href="<?php echo $blog['url'];?>"><?php echo $blog['content_title'];?></a><br>
	      		<span class="rssdesc"><?php echo shorten($blog['content'],100); ?></span>
	      		<br/>
	      		<br/>
      		</li>	      	
	      	<?php endforeach;?>
      	</ul>
    </div>  
  </div>  
</div>  