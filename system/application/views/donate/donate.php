<div id="payment-instructions">
<img alt="thanks for adding funds in honor of this mama!" src="http://tomamawithlove.org/wp-content/themes/2mamawithlove/assets/give-in-honor-header.jpg">
<!--BEGIN INSTRUCTIONS-->
<p>When you give in honor of a Mama you love, you'll be investing in the vision of local grassroots changemaker, primary school founder &amp; Epic Change fellow Mama Lucy Kamptoni, who dreams of building a children's home in Arusha, Tanzania.  Epic Change is a 501(c)(3) US nonprofit.</p>

<p><strong>To get started, select the amount and currency you'd prefer to give &amp; click the "give" button</strong>.  Once you've completed your PayPal transaction, your name will appear and be listed on the mama's heartspace under the "in her honor" section.</p>

<p>Thanks for choosing to contribute to a mama you love by making a gift that will change the world!</p>
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
          <?php if(isset($post_id)):?>
          	<input type="hidden" name="postcard_id" value="<?php echo $post_id; ?>" />
          <?php endif;?>
           <input type="hidden" name="payment_type" value="heartspace" />
          <input type="hidden" name="item_name" value="ToMamaWithLove.org Contribution" />
        </form>
</div>