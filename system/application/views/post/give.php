<div class="page_content">
  <div id ="create_note">
    Create a thank you note
  </div>
  <div id="give_card" class="postcard_block">
    <div id="payment" style="width: 80%;">
      <p class="form">
      Give in honor of whatever you're grateful for. Contributions will be invested in <a href="<?php echo site_url() .'statics/changemakers';?>">these remarkable changemakers</a>. 
      <br/><i>Give $100+ to be added to our honorary global gratitude parade.</i>
      </p>
      <br/>
      <form action="<?php echo site_url() . 'payment/new_payment'; ?>" method="post">
        <div class='form'>
          Amount: 
           <select name="amount">
              <option value="10.00" selected="selected">$10.00</option>
              <option value="20.00">$20.00</option>
              <option value="25.00">$25.00</option>
              <option value="50.00">$50.00</option>
              <option value="100.00">$100.00</option>
              <option value="250.00">$250.00</option>
              <option value="500.00">$500.00</option>
              <option value="1,000">$1,000.00</option>
              <option value="2,500.00">$2,500.00</option>
              <option value="5000.00">$5,000.00</option>
            </select>
			&nbsp;&nbsp;
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
            Pay Using:
            <input name="pay_option" type="radio" value="2" checked="checked" /> Credit Card
            <input name="pay_option" type="radio" value="1" /> Paypal
          </div>  
          <div class="form">
            	<input type="checkbox" name="give_epic" value="yes" checked="checked"/> Add 10% to my gift to support the work of <a href="http://www.epicchange.org/" target="_blank">Epic Change</a><br/>
            	<div class="paypal_img">
	              <a href="#" onclick=
	              "javascript:window.open('https://www.paypal.com/us/cgi-bin/webscr?cmd=xpt/Marketing/popup/OLCWhatIsPayPal-outside','olcwhatispaypal','toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=400, height=350');"><img src="https://www.paypal.com/en_US/i/logo/paypal_logo.gif"
	              alt="Acceptance Mark" width="117" height="27" border="0" /></a>
            	</div>
            <div class="clear">
            </div>
            <div id="">
            	<input type="submit" name="give" value="give" id="submit_give"/>
            </div>
          </div>  
          <br/>
          <br/>
          <input type="hidden" name="postcard_id" value="<?php echo $postcard['post_id']; ?>" />
          <input type="hidden" name="payment_type" value="postcard" /> 
          <input type="hidden" name="item_name" value="Epic Thanks Postcard" />
        </form>
           <div id="skip_n_back">
              <p>
                we're hoping you'll contribute in honor of whatever you're thankful for, and in gratitude for changemakers across the globe who work tirelessly to create hope in our world. but maybe you've already paid for 15 thank you notes because it's so much fun to share your grateful heart with people you love. or maybe right now your pockets are lined with more gratitude than gold. if you choose to skip this step, just pinky swear you've already contributed or will contribute the next time you've got $10 to spare. we trust ya ;) <a href="<?php echo site_url() . 'postcard/send/' . $postcard['post_id'];?>">skip this step & send my card</a>
              </p>  
              <!-- <p id="back_give"><a href="#">back</a></p>
                    <p id="skip_it"><a href="<#?php echo site_url() . 'postcard/send/' . $postcard['post_id'];?>">Skip it</a></p> -->
            </div>
      </div>  
    </div>
</div>    