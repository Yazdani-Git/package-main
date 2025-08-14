<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';

$order_id    = '';
$pass_name   = '';
$pass_famili = '';
$pass_phone  = '';


if ( isset( $_POST['psi_name'] ) ) {
	$pass_name = $_POST['psi_name'];
}
if ( isset( $_POST['psi_lastname'] ) ) {
	$pass_famili = $_POST['psi_lastname'];
}
if ( isset( $_POST['psi_phone'] ) ) {
	$pass_phone = $_POST['psi_phone'];
}

$bank_rinfo=get_option('bareqinf');
$am       = $_POST['up_wallet_amount'];
define('URL_CALLBACK', 'http://idpay-payment.local/callback.php');
define('URL_PAYMENT', 'https://api.idpay.ir/v1.1/payment');
define('URL_INQUIRY', 'https://api.idpay.ir/v1.1/payment/inquiry');
define('URL_VERIFY', 'https://api.idpay.ir/v1.1/payment/verify');
define('APIKEY', $bank_rinfo['merchent_id']);
define('SANDBOX',0);
$user_id = get_current_user_id();
$send_ui=$user_id+66166944587;
$params = array(
	'order_id' => time(),
	'amount' => $am ,
	'phone' => '',
	'name' => '',
	'desc' => '',
	'pass_name' => $pass_name,
	'pass_famili' => $pass_famili,
	'pass_phone' => $pass_phone,
	'callback' =>  get_template_directory_uri() . "/payment/idpay/Verification.php?auth=".$send_ui
);

idpay_payment_create($params);

function idpay_payment_create($params) {
	$header = array(
		'Content-Type: application/json',
		'X-API-KEY:' . APIKEY,
		'X-SANDBOX:' . SANDBOX,
	);

	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, URL_PAYMENT);
	curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);

	$result = curl_exec($ch);
	curl_close($ch);

	$result = json_decode($result);

	if (empty($result) || empty($result->link)) {

		print 'Exception message:';
		print '<pre>';
		print_r($result);
		print '</pre>';

		return FALSE;
	}

	if (! empty( $result ) ){
		global $wpdb;

		$am       = $_POST['up_wallet_amount'];
		$table_name = $wpdb->prefix . 'jayto_transaction';
		$user       = wp_get_current_user();
		$user_id    = $user->ID;
		$wpdb->insert( $table_name, array(


			'refid'      => $result->track_id,
			'Authority'      => $result->id,
			'user_id'    => $user_id,
			'pay_date'   => time(),
			'pay_status' => 0,
			'amount'     => $params['amount'],
			'orderid'     =>$params['order_id'],




		), array(

			'%s',
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%d',


		) );
	}

	//.Redirect to payment form
	header('Location:' . $result->link);
}