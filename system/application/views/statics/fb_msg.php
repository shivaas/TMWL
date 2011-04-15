<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<meta property="og:title" content="Epic Thanks <?php if(isset($postcard)) echo 'Postcard #'.$postcard['post_id']; ?>"/> 
	<meta property="fb:admins" content="511814930"/>
	<meta property="og:type" content="cause"/>
	<meta property="og:app_id" content="164948536873380"/>
	<meta property="og:url" content="<?php echo current_url();?>"/>
    <meta property="og:site_name" content="Epic Thanks"/>
    <meta property="og:image" content="<?php echo site_url() . 'images/small_logo.jpg';?>"/>
    
	<title>Epic Thanks - TweetsGiving 2010</title>
	<meta name="description" content="A global celebration of gratitude and giving that honors inspirational changemaker who created hope in our world" />
	<meta name="tweetmeme-title" content="#EpicThanks tweetmeme-title here" />
	<link rel="Epic Thanks icon" href="<?php echo site_url();?>images/favicon.ico" />
	<?php if(isset($fb_title)): ?><meta property="og:title" content="<?php echo $fb_title ?>"/><?php endif; ?>
	<link rel="stylesheet" href="<?php echo site_url();?>css/reset.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/styles.css" media="screen" />		
</head>
<body>
	
  <div id="wrapper">
<div class="page_content">
<br/>
  <div id="our_story">
    <div id="about_content">
    <br/>&nbsp;
      <p>
        Your message was posted successfully as your facebook status update! 
      </p>
      <div class="clear"></div>
      <br/>&nbsp;
    </div>  
  </div>  
</div>
<?php 
$this->load->view('footer'); 
?>
	</div>
</body>
</html>  