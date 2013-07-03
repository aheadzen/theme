<?php
/*
Plugin Name: Payments
Plugin URI: http://www.ask-oracle.com
Description: Payments API
Author: Arpit Tambi
Version: 0.1
Author URI: http://www.ask-oracle.com
*/

@require_once ABSPATH . WPINC . '/class-snoopy.php';

define( 'PAYPAL_URL', 'http://www.paypal.com/cgi-bin/webscr' );
define( 'PAYPAL_SANDBOX_URL', 'http://www.sandbox.paypal.com/cgi-bin/webscr' );

function getProductFromCode( $code )
{
	$products = array();

	$products['MR'] = array();
	$products['MR']['payment_page_text'] = 'Your Payment for Marriage Report was successful. Please continue to see your marriage report.';
	$products['MR']['name'] = 'Ask-Oracle.com\'s Marriage Report';
	$products['MR']['url'] = 'when-marry/';

	$products['FR'] = array();
	$products['FR']['payment_page_text'] = 'Your Payment for Future Predictions Report was successful. Please continue to see your future report.';
	$products['FR']['name'] = 'Ask-Oracle.com\'s Future Predictions Report';
	$products['FR']['url'] = 'birth-chart/future/';

	return $products[$code];

}

function paypal_PDT()
{
	$snoopy = new Snoopy();
	$current_user = wp_get_current_user();
	$user_id = $current_user->ID;
	$profileuser = get_userdata($user_id);
	
	$user_email = $current_user->user_email;
	$user_display_name = $current_user->display_name;

	$postData = array();

	/* set some values */
	$postData['tx'] = $_GET['tx'];
	$postData['cmd'] = '_notify-synch';
	$postData['at'] = 'bSW19HrBP8gdEFLavpvXazs_1ImU37zQXAIOqZVtnUCkWw5rAUJQdXwqE3i';
//	$postData['at'] = 'TCmkR5-coN0OqSvsUE0Elr_WDMFvKPxDwZePamOLik9cxCdo1qbVhmIQPY8';

	/* submit the data and get the result */
	$oo = $snoopy->submit( PAYPAL_URL , $postData);

	$lines = explode("\n", $snoopy->results);
	$keyarray = array();
	if (strcmp($lines[0], "SUCCESS") == 0)
	{
		for ($i=1; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$keyarray[urldecode($key)] = urldecode($val);
		}

		$item_number = $keyarray['item_number'];

		$item_info = getProductFromCode( $item_number );

		echo '<p>' . $item_info['payment_page_text'] . '</p>';

		if( isset( $profileuser->payment ) )
		{
			$payment = unserialize( $profileuser->payment );
			$payment[$item_number] = array();
		} else
			$payment = array( $item_number => array() );
		
		$payment[$item_number]['status'] = 'PAID';
		$payment[$item_number]['charge'] = $keyarray['mc_gross'];

		$email_subject = 'Payment Received - ' . $item_info['name'];
		update_usermeta( $user_id, 'payment', serialize( $payment ) );
	}
	else
	{ 
		echo "<p>Payment Error. We are working on this issue and will get back to you soon.</p>";
		$email_subject = 'Payment Failed - ' . $item_info['name'];
	}
	echo '<div class="message notification promptText"><a href="' . get_linkTO( $item_info['url'] ) . '">Continue &raquo;</a></div>';
	$message = sprintf(__('User ID: %s'), $user_id) . "\r\n";
	$message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";
	$message .= sprintf(__('Name: %s'), $user_display_name) . "\r\n";
	$message .= sprintf(__('Paypal Output: %s'), $snoopy->results) . "\r\n";
	@wp_mail(get_option('admin_email'), $email_subject, $message);

}

function paypal_IPN()
{
	$snoopy = new Snoopy();

	if( empty( $_POST ) )
		return ;

	$paypalData = $_POST;
	$paypalData['cmd'] = '_notify-validate';

	$user_id = (int)$paypalData['custom'];
	$profileuser = get_userdata($user_id);
	$user_email = $profileuser->user_email;
	$user_display_name = $profileuser->display_name;

	$item_number = $keyarray['item_number'];
	$item_info = getProductFromCode( $item_number );
	
	$email_subject = 'IPN - Payment Received - ' . $item_info['name'];

	/* submit the data and get the result */
	$oo = $snoopy->submit(PAYPAL_URL, $paypalData);

	$lines = explode("\n", $snoopy->results);
	$keyarray = array();
	if (strcmp($lines[0], "VERIFIED") == 0) {
			for ($i=1; $i<count($lines);$i++){
			list($key,$val) = explode("=", $lines[$i]);
			$keyarray[urldecode($key)] = urldecode($val);
		}

		if( isset( $profileuser->payment ) )
		{
			$payment = unserialize( $profileuser->payment );
			$payment[$item_number] = array();
		} else
			$payment = array( $item_number => array() );

		$payment[$item_number]['status'] = 'PAID';
		$payment[$item_number]['charge'] = $paypalData['mc_gross'];
		update_usermeta( $user_id, 'payment', serialize( $payment ) );
	} else $email_subject = 'IPN NOT VERIFIED';
	
	$message = sprintf(__('User ID: %s'), $user_id) . "\r\n";
	$message .= sprintf(__('E-mail: %s'), $user_email) . "\r\n";
	$message .= sprintf(__('Name: %s'), $user_display_name) . "\r\n";
	$message .= sprintf(__('Paypal POST: %s'), serialize( $paypalData ) ) . "\r\n";

	@wp_mail(get_option('admin_email'), $email_subject, $message);
}


?>