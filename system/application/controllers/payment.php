<?php
class Payment extends Controller {
	
	// If set to true SANDBOX is being used, else FALSE live credentials
	var $sandbox = false;
	var $domain = "http://tomamawithlove.org";	
	
	/**
	 * Method to process new payment request.
	 * @author shivaas
	 */
	function new_payment(){
		// Create new PayPal object
		$paypal_config = array('Sandbox' => $this->sandbox);
		$paypal = new PayPal($paypal_config);
		
		$this->output->enable_profiler(TRUE);
		
		####[ SESSION AND CONSTANT VARIABLES ]############################
		$amount = $this->input->post('amount');
		
		if($this->input->post('give_epic')){
			$amount = $amount + $amount*0.10;
		}
//		echo $amount;
//		return;
		
		$session_data = array(
								'amount' => '',
								'item_name' => '',
								'currency' =>'',
								'postcard_id' =>'',
								'payment_source' =>'',
								'invoice' =>'',
								'personname' =>'',
								'email' => ''
							);
		
		$this->session->unset_userdata($session_data);
		$postcard_id = $this->input->post('postcard_id');
		
		$session_data = array(
								'amount' => $amount,
								'item_name' => $this->input->post('item_name'),
								'currency' =>$this->input->post('currencyCodeType'),
								'postcard_id' =>$postcard_id,
								'payment_source' =>$this->input->post('payment_type'),
								'invoice' => $postcard_id . '-' . rand(99999,9999999),
								'personname' =>'',
								'email' => ''
							);
							
		$this->session->set_userdata($session_data);
		/*
		$this->session->set_userdata('amount', $amount);
		$this->session->set_userdata('item_name', $this->input->post('item_name'));
		$this->session->set_userdata('currency', $this->input->post('currencyCodeType'));
		$this->session->set_userdata('personname','');
		$this->session->set_userdata('email', '');
		$this->session->set_userdata('postcard_id', $this->input->post('postcard_id'));
		$this->session->set_userdata('payment_source', $this->input->post('payment_type')); 
		$this->session->set_userdata('invoice', $this->input->post('postcard_id') .'-' . rand());
		*/ 
		
		####[ SET EXPRESS CHECKOUT SETTINGS ]#############################
		
		$SECFields 		= array(
							  'returnurl' 			=> site_url() . 'payment/complete/'. $postcard_id,						// Required.  URL to which the customer will be returned after returning from PayPal.  2048 char max.
							  'cancelurl' 			=> site_url(), 							// Required.  URL to which the customer will be returned if they cancel payment on PayPal's site
							  'noshipping' 			=> '0', 						// The value 1 indiciates that on the PayPal pages, no shipping address fields should be displayed.  Maybe 1 or 0.
							  'allownote' 			=> '1', 							// The value 1 indiciates that the customer may enter a note to the merchant on the PayPal page during checkout. Must be 1 or 0 
							  'hdrimg' 				=> '', 							// URL for the image displayed as the header during checkout.  Max size of 750x90.  Should be stored on an https:// server 
							  'skipdetails' 		=> '1', 						// It's used to specify whether you want to skip the GetExpressCheckoutDetails part of checkout or not.  See PayPal docs for more info.
							  'paymentaction' 		=> 'Sale', 						// How you want to obtain payment.  Sale, Authorization, Order
							  'pagestyle'			=> 'Epic_Thanks'
						  		);
		if(isset($_POST['pay_option'])){
			if( $_POST['pay_option'] == 2)
			{
				// for credit card payments
				$SECFields['landingpage'] = 'Billing';
				$SECFields['solutiontype'] = 'Sole';
			}else {
				// for paying via paypal account
				$SECFields['landingpage'] = 'Login';
			}
		}
		$OrderItems 	= array();		
		
		$Item	 		= array(
							  'l_name' 				=> $this->session->userdata('item_name'), 							// Item Name.  127 char max.
							  'l_amt' 				=> $this->session->userdata('amount'), 							// Cost of individual item.
							  'l_number' 			=> $this->session->userdata('postcard_id'), 							// Item Number.  127 char max.
							  'l_qty' 				=> '1', 						// Item quantity.  Must be any positive integer.  
							  'l_itemweightvalue' 	=> '', 					// The weight value of the item.
							  'l_itemweightunit' 	=> '' 					// The weight unit of the item.
								);
		
		array_push($OrderItems, $Item);
		
		$PaymentDetails = array(
							  'amt' 				=> $this->session->userdata('amount'), 							// Required. Total amount of the order, including shipping, handling, and tax.
							  'itemamt'				=> '', 
							  'maxamt' 				=> $this->session->userdata('amount')+100,
							  'shippingamt' 		=> '', 
							  'currencycode' 		=> $this->session->userdata('currency'), 					// A three-character currency code.  Default is USD.
							  'desc' 				=> 'Epic Thanks Web Order', 							// Description of items on the order.  127 char max.
							  'invnum' 				=> strtotime(time()), 						// Your own invoice or tracking number.  127 char max.
								);
		
		$SECData 		= array(
							  'SECFields' 			=> $SECFields, 
							  'PaymentDetails' 		=> $PaymentDetails, 
							  'OrderItems' 			=> $OrderItems
						 		);
		
		
		####[ CALL SET EXPRESS CHECKOUT ]################################
		$this->session->set_userdata('PayPalResult',$paypal -> SetExpressCheckout($SECData));
		
		$paypalresult = $this->session->userdata('PayPalResult');
		//var_dump($paypalresult);
		
		$this->session->set_userdata('paypal_errors', $paypalresult['ERRORS']);
		$this->session->set_userdata('Token',isset($paypalresult['TOKEN']) ? $paypalresult['TOKEN'] : '');
		
		####[ REDIRECT DEPENDING ON RESPONSE ]###########################
		
		#echo "<pre>";
		#print_r($_SESSION);
		#exit;
		
		if(strtolower($paypalresult['ACK']) != 'success')
		{
			//header('Location: error.php');
			redirect('payment/error?type=1&ack=' . $paypalresult['ACK']);
			exit();
		}
		else
		{	
			header('Location: ' . $paypalresult['REDIRECTURL']);
			exit();
		}
	}
	
	function error(){
		// Create new PayPal object
		$paypal_config = array('Sandbox' => $this->sandbox);
		$paypal = new PayPal($paypal_config);
		echo $paypal->DisplayErrors($this->session->userdata('paypal_errors'));
		
	}
	
	function complete($postcard_id = null){
	
		// Create new PayPal object
		$paypal_config = array('Sandbox' => $this->sandbox);
		$paypal = new PayPal($paypal_config);
		
		#####[ CALL GET EXPRESS CHECKOUT DETAILS ]###########################
		
		#echo "<pre>";
		#print_r($_SESSION);
		#echo "</pre>";
		#exit;
		
		$GECDResult = $paypal -> GetExpressCheckoutDetails($this->session->userdata('Token'));
		$this->session->set_userdata('paypal_errors', $GECDResult['ERRORS']);
		if(strtolower($GECDResult['ACK']) != 'success' && strtolower($GECDResult['ACK']) != 'successwithwarning')
		{
			redirect('payment/error');
			exit();
		}
		
		#####[ SET EXPRESS CHECKOUT ]#######################################
		
		// DoExpressCheckout
		$DECPFields = array(
							'token' => $this->session->userdata('Token'), 								// Required.  A timestamped token, the value of which was returned by a previous SetExpressCheckout call.
							'paymentaction' => 'Sale', 						// Required.  How you want to obtain payment.  Values can be: Authorization, Order, Sale.  Auth indiciates that the payment is a basic auth subject to settlement with Auth and Capture.  Order indiciates that this payment is an order auth subject to settlement with Auth & Capture.  Sale indiciates that this is a final sale for which you are requesting payment.
							'payerid' => isset($GECDResult['PAYERID']) ? $GECDResult['PAYERID'] : '', 							// Required.  Unique PayPal customer id of the payer.  Returned by GetExpressCheckoutDetails, or if you used SKIPDETAILS it's returned in the URL back to your RETURNURL.
							'payerid' => isset($GECDResult['PAYERID']) ? $GECDResult['PAYERID'] : '',
							'returnfmfdetails' => '1' 					// Flag to indiciate whether you want the results returned by Fraud Management Filters or not.  1 or 0.
						);
								
		$PaymentDetails = array(
								'amt' => $this->session->userdata('amount'), 							// Required. Total amount of the order, including shipping, handling, and tax.
								'currencycode' => $this->session->userdata('currency'), 					// A three-character currency code.  Default is USD.
								'itemamt' => '', 						// Required if you specify itemized L_AMT fields. Sum of cost of all items in this order.  
								'shippingamt' => '', 					// Total shipping costs for this order.  If you specify SHIPPINGAMT you mut also specify a value for ITEMAMT.
								'handlingamt' => '', 					// Total handling costs for this order.  If you specify HANDLINGAMT you mut also specify a value for ITEMAMT.
								'taxamt' => '', 						// Required if you specify itemized L_TAXAMT fields.  Sum of all tax items in this order. 
								'desc' => 'Epic Thanks, 501(c)(3)  Epic Change', 							// Description of items on the order.  127 char max.
								'custom' => $this->session->userdata('postcard_id'), 						// Free-form field for your own use.  256 char max.
								'invnum' => $this->session->userdata('invoice'), 						// Your own invoice or tracking number.  127 char max.
								//'notifyurl' => site_url() ."/payment/ipn" 						// URL for receiving Instant Payment Notifications
								);
		
		$OrderItems = array();
		
		$Item		 = array(
						'l_name' => $this->session->userdata('item_name'), 						// Item name. 127 char max.
						'l_amt' => $this->session->userdata('amount'), 						// Cost of item.
						'l_number' => $this->session->userdata('postcard_id'), 						// Item number.  127 char max.
						'l_qty' => '1' 						// Item qty on order.  Any positive integer.
						);
						
		array_push($OrderItems, $Item);
		
		$DECPData = array(
						  'DECPFields' => $DECPFields, 
						  'PaymentDetails' => $PaymentDetails,
						  'OrderItems' => $OrderItems
						  );
		
		#####[ CALL DO EXPRESS CHECKOUT PAYMENT ]#############################
		
		$DECPResult = $paypal -> DoExpressCheckoutPayment($DECPData);
		$this->session->set_userdata('paypal_errors', $DECPResult['ERRORS']);
		
		#####[ REDIRECT DEPENDING ON RESPONSE ]###############################
		
		if(strtolower($DECPResult['ACK']) != 'success' && strtolower($DECPResult['ACK']) != 'successwithwarning')
		{
			redirect('payment/error?type=2');
			exit();
		}
		
		/*
		$_SESSION['PayerEmailAddress'] = isset($GECDResult['EMAIL']) ? $GECDResult['EMAIL'] : '';
		$_SESSION['FirstName'] = isset($GECDResult['FIRSTNAME']) ? $GECDResult['FIRSTNAME'] : '';
		$_SESSION['LastName'] = isset($GECDResult['LASTNAME']) ? $GECDResult['LASTNAME'] : '';
		$_SESSION['Street'] = isset($GECDResult['SHIPTOSTREET']) ? $GECDResult['SHIPTOSTREET'] : '';
		$_SESSION['City'] = isset($GECDResult['SHIPTOCITY']) ? $GECDResult['SHIPTOCITY'] : '';
		$_SESSION['State'] = isset($GECDResult['SHIPTOSTATE']) ? $GECDResult['SHIPTOSTATE'] : '';
		$_SESSION['Zip'] = isset($GECDResult['SHIPTOZIP']) ? $GECDResult['SHIPTOZIP'] : '';
		$_SESSION['Country'] = isset($GECDResult['SHIPTOCOUNTRYNAME']) ? $GECDResult['SHIPTOCOUNTRYNAME'] : '';
		$_SESSION['transaction_id'] = isset($DECPResult['TRANSACTIONID']) ? $DECPResult['TRANSACTIONID'] : '';
		$_SESSION['CustomerNotes'] = isset($DECPResult['NOTE']) ? $DECPResult['NOTE'] : '';
		$_SESSION['PaymentStatus'] = isset($DECPResult['PAYMENTSTATUS']) ? $DECPResult['PAYMENTSTATUS'] : '';
		$_SESSION['PendingReason'] = isset($DECPResult['PENDINGREASON']) ? $DECPResult['PENDINGREASON'] : '';
		$_SESSION['payment_type'] = isset($DECPResult['PAYMENTTYPE']) ? $DECPResult['PAYMENTTYPE'] : '';
		
		*/
		
		#echo "<pre>";
		#print_r($_SESSION);
		#echo "</pre>";
		#exit;
		
		// Everything went fine, so redirect to completed page.
		$type = $this->session->userdata('payment_source');
		$d = new Donations();
		$d->donation_amount = $this->session->userdata('amount');
		$d->type = $type;
		$d->save();
		$session_data = array(
								'donor_name' => $GECDResult['FIRSTNAME'] . ' ' . $GECDResult['LASTNAME'],
								'donation_id' => $d->donation_id
							);
		$this->session->set_userdata($session_data);
		
		if( $type == 'postcard'){
			$r = new PostDonationRel();
			$r->post_id = $postcard_id;
			$r->donation_id = $d->donation_id;
			$r->save();
			if($this->session->userdata('amount') >= PARADE_CUTOFF){
				$g = new GratitudeParade();
				$g->donation_id = $d->donation_id;
				$g->name = Users::user()->username;
				$g->image_url = Users::user()->profile_avatar;
				$g->url = 'http://www.' . Users::user()->oauth_provider . '.com/' . Users::user()->username;
				$g->save();
				$this->session->set_flashdata('added_to_parade', true);
			}
			$this->session->set_flashdata('added_to_parade', false);
			redirect('postcard/send/' . $postcard_id . '/'. md5($postcard_id));
		}
		else 
			redirect('payment/thankyou');
	}
	
	function thankyou(){
		
		if(!$this->session->userdata('donation_id'))
			show_error('You are not allowed to access this page', 501);
		
		//$this->session->set_userdata('amount', PARADE_CUTOFF);
		
		if($this->input->get('type') && $this->session->userdata('amount') >= PARADE_CUTOFF){
			$data['added_to_parade'] = true;
			$d = new GratitudeParade();
			$d->donation_id = $this->session->userdata('donation_id');
			if(Users::user()){
				$d->name = Users::user()->username;
				$d->image_url = Users::user()->profile_avatar;
				$d->url = 'http://www.' . Users::user()->oauth_provider . '.com/' . Users::user()->username; 
			}else
			{
				$d->name = 'Anonymous'; //$this->session->userdata('donor_name');
				$d->image_url = site_url() . 'images/postcards/avatar_placeholder.jpg';
				$this->session->set_flashdata('anon_donation',true);
			}
			$d->save();
			$session_data = array(
								'donor_name' => '',
								'donation_id' => ''
							);
			//$this->session->unset_userdata($session_data);
			
		}else if($this->session->userdata('amount') >= PARADE_CUTOFF){
			$data['added_to_parade'] = false;
		}
		
		$data['content'] = 'statics/thankyou';
		$this->load->view('template', $data);
	}
}