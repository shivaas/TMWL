<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<html xmlns:og="http://opengraphprotocol.org/schema/" xmlns:fb="http://www.facebook.com/2008/fbml">

<head profile="http://gmpg.org/xfn/11">
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>Epic Thanks Admin</title>
	<meta name="description" content="A global celebration of gratitude and giving that honors inspirational changemaker who created hope in our world" />
	<link rel="Epic Thanks icon" href="<?php echo site_url();?>images/favicon.ico" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/reset.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/styles.css" media="screen" />
	<link rel="stylesheet" href="<?php echo site_url();?>css/jquery.css" media="screen" />
	
	<script src="<?php echo site_url(); ?>js/jquery.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery-ui.js" type="text/javascript"></script>
	<script src="<?php echo site_url(); ?>js/jquery.juitter.js" type="text/javascript"></script>
	
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
			$('.notification').live('click',function(){
				$(this).fadeOut();
			});
		});
	</script>
</head>
<body>
	
  <div id="wrapper">
<?php if($this->session->flashdata('notification')) { ?>
	<div class="notification ui-state-highlight" style="color:#000066;">
		<span class="ui-icon ui-icon-info">&nbsp;</span>&nbsp;<?php echo $this->session->flashdata('notification'); ?>
	</div>
<?php } ?>		
<?php if($this->session->flashdata('error')) { ?>
	<div class="notification ui-state-error" style="color:#aa0000;">
		<span class="ui-icon ui-icon-info">&nbsp;</span>&nbsp;<?php echo $this->session->flashdata('error'); ?>
	</div>
<?php } ?>
<?php 
$this->load->view('admin/header');
$this->load->view($content);
$this->load->view('admin/footer'); 
?>
	</div>
</body>
</html>