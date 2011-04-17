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
    <meta property="og:site_name" content="ToMamaWithLove"/>
    <meta property="og:image" content="<?php echo site_url() . 'images/small_logo.jpg';?>"/>
    <?php if($this->router->class== "postcard"):?>
    	<meta property="og:description" content=""/>
    <?php endif;?>
	<title>ToMamaWithLove - 2011</title>
	
	<meta name="description" content="" />
	
	<meta name="tweetmeme-title" content="#ToMamaWithLove Tweetmeme title here" />
	<link rel="ToMamaWithLove icon" href="<?php echo site_url();?>images/favicon.png" />
	<?php if(isset($fb_title)): ?><meta property="og:title" content="<?php echo $fb_title ?>"/><?php endif; ?>
	<link rel="stylesheet" href="<?php echo site_url();?>css/reset.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/style.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/960.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/jquery.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/jquery-ui-1.8.custom.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/structure.css" media="screen" />
	
	<script src="<?php echo site_url(); ?>js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.juitter.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.oembed.min.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.jcarousel.pack.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.timer.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/doc-load.js" type="text/javascript"></script>
	
	<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>
	<script src="http://platform.twitter.com/widgets.js" type="text/javascript"></script>
	
	<script type="text/javascript">
		$(function(){
			
			$.Juitter.start({
				searchType:"searchWord", // needed, you can use "searchWord", "fromUser", "toUser"
				searchObject:"tomamawithlove",
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

<?php 
	$this->load->view('header');
	echo '<div id="page">';
	$this->load->view($content);
	echo '</div>';
	$this->load->view('footer'); 
?>
	
</body>
</html>