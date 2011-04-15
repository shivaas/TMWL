<?php 

$total = 0;
$donation_count = count($donations);
$types = array('postcard' => 0, 'homepage_donation'=>0);
foreach($donations as $d){
	$total += $d['donation_amount'];
	$types[$d['type']]++;
}

$donation_amount = $total;
$donation_count = $donation_count;
		
?>

<div class="page_content">
<br/>
  <div id="our_story">
    <h3>Donation Statistics</h3>
    <br><br>
    <p><strong>Number of donors: </strong><?php echo $donation_count?></p><br/>
    <p>Total Amount Collected: <?php echo $donation_amount?></p><br/>
    <p>Donations from Home page: <?php echo $types['homepage_donation']?></p><br/>
    <p>Donations from Postcard designs: <?php echo $types['postcard']?></p><br/>
  </div>
  
</div>  