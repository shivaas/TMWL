<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	
	<meta property="og:title" content="Epic Thanks <?php if(isset($postcard)) echo 'Thank you note #'.$postcard['post_id']; ?>"/> 
	<meta property="fb:admins" content="511814930"/>
	<meta property="og:type" content="cause"/>
	<meta property="og:app_id" content="164948536873380"/>
	<meta property="og:url" content="<?php echo current_url();?>"/>
    <meta property="og:site_name" content="Epic Thanks"/>
    <meta property="og:image" content="<?php echo site_url() . 'images/small_logo.jpg';?>"/>
    <?php if($this->router->class== "postcard"):?>
    	<meta property="og:description" content="A global celebration of gratitude and giving that honors inspirational changemakers who create hope in our world. Have you added your thank you note to the global outpouring of gratitude, generosity & goodness at Epic Thanks? Here's mine."/>
    <?php endif;?>
	<title>Epic Thanks - TweetsGiving 2010</title>
	
	<meta name="description" content="A global celebration of gratitude and giving that honors inspirational changemakers who created hope in our world" />
	
	<meta name="tweetmeme-title" content="#EpicThanks tweetmeme-title here" />
	<link rel="Epic Thanks icon" href="<?php echo site_url();?>images/favicon.ico" />
	<?php if(isset($fb_title)): ?><meta property="og:title" content="<?php echo $fb_title ?>"/><?php endif; ?>
	<link rel="stylesheet" href="<?php echo site_url();?>css/reset.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/styles.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/jquery.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/skin.css" media="screen" />
	
	<script src="<?php echo site_url(); ?>js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.juitter.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.jcarousel.min.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/toolkit.js" type="text/javascript"></script>
	
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function(){
			
			$.Juitter.start({
				searchType:"searchWord", // needed, you can use "searchWord", "fromUser", "toUser"
				searchObject:"epicthanks",
				live:"live-15", // the number after "live-" indicates the time in seconds to wait before request the Twitter API for updates.
				placeHolder:"twitterFeed", // Set a place holder DIV which will receive the list of tweets example <div id="juitterContainer"></div>
				loadMSG: "Loading messages...",
				total: 3, // number of tweets to be show - max 100
				readMore: "Read it on Twitter", // read more message to be show after the tweet content
				nameUser:"image", // insert "image" to show avatar of "text" to show the name of the user that sent the tweet 
				openExternalLinks:"newWindow" // here you can choose how to open link to external websites, "newWindow" or "sameWindow"
			});

			$('.widget_title').hide();
			$('.twitterRule').hide();
		});
	</script>
	<script type="text/javascript">
		var disqus_shortname = 'epicthanks';
		(function () {
		  var s = document.createElement('script'); s.async = true;
		  s.src = 'http://disqus.com/forums/epicthanks/count.js';
		  (document.getElementsByTagName('HEAD')[0] || document.getElementsByTagName('BODY')[0]).appendChild(s);
		}());
	</script>
			
</head>
<body>
	
  <div id="wrapper">
<?php 
$this->load->view('header');
$this->load->view($content);
$this->load->view('footer'); 
?>
	</div>
</body>
</html>