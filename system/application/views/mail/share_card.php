<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
  <title>epic thanks</title>
  <style>
    #epic_thanks a{
      background:url('<?php echo site_url();?>images/epic_thanks.jpg') no-repeat left top;
      float:left;
      text-indent:-99999px;
      height:88px;
      width:210px;
    }
     #epic_thanks a:hover{
       background:url('<?php echo site_url();?>images/epic_thanks_hover.jpg') no-repeat left top;
       
     }
  </style>
</head>
<body>
<div style = "width:500px;height:600px;background-color:#cee06e;padding:10px">
  <div id="logo" style="border-bottom:1px solid #E7F0B7;margin:0 0 10px 0;">
    <a href="#" style="text-decoration:none;border:none;">
      <img src="<?php echo site_url();?>images/logo.png" alt="epic thanks" style="border:none;"/>
    </a>  
  </div>    
  <div id="blue_block" style="background-color:#65c8c6;overflow:hidden;display:block;">  
    <div id="view_card" style="float:left;font-family:Georgia; font-size:14px;color:#123242; width:100%;padding:0px 10px;">
      <p style="margin-top:15px;">
        <?php if(strlen($message)>0): echo '<strong>'. $message . '</strong>'; else: ?>
        	Epic Thanks is a massive outpouring of gratitude from across the globe. I found a card I knew you'd love. You can check it out at:
        <?php endif;?>
      </p>
      <p style="text-align:center;margin:0 auto;margin-top:15px">
        <a href="<?php echo $url;?>" style="text-decoration:none;border:none;"><img src="<?php echo site_url();?>images/view_card.jpg"  alt="view card" style="border:none;"/></a>
      </p>  
    </div>  
  </div>  
  <div id="text" style="padding:0 10px;font-family:Georgia; font-size:14px;color:#123242;margin-top:15px">
    <p>
      Epic Thanks is a global event in which participants share their thanks online, and give in honor of all we have to be grateful for. Our combined gifts of gratitude will be invested in the dreams of <a href="<?php echo site_url() ?>/changemakers" style="color:#123242;">inspirational changemakers</a> who create hope in our world.
    </p>
    <p style="margin-top:15px">  
      You can check out thank you notes from around the globe &amp; send your own at <a href="http://www.EpicThanks.org" style="color:#123242;">http://www.EpicThanks.org</a>
    </p>  
  </div>
  <br/>&nbsp;
  <br/>&nbsp;  
  <p style="text-align:center;">
    <img src="<?php echo site_url();?>images/footer.jpg"  alt="footer" style="border:none;"/>
  </p>  
  </div>
</body>
</html>  