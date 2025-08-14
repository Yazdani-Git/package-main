<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
$order_id    = '';
$pass_name   = '';
$pass_famili = '';
$pass_phone  = '';
if ( isset( $_POST['dataoi'] ) ) {
	$order_id = $_POST['dataoi'];
}
if ( isset( $_POST['psi_name'] ) ) {
	$pass_name = $_POST['psi_name'];
}
if ( isset( $_POST['psi_lastname'] ) ) {
	$pass_famili = $_POST['psi_lastname'];
}
if ( isset( $_POST['psi_phone'] ) ) {
	$pass_phone = $_POST['psi_phone'];
}
$bank_rinfo = get_option( 'bareqinf' );
 $am         = $_POST['up_wallet_amount'];
define( 'URL_CALLBACK', 'http://idpay-payment.local/callback.php' );
define( 'URL_PAYMENT', 'https://api.idpay.ir/v1.1/payment' );
define( 'URL_INQUIRY', 'https://api.idpay.ir/v1.1/payment/inquiry' );
define( 'URL_VERIFY', 'https://api.idpay.ir/v1.1/payment/verify' );
define( 'APIKEY', $bank_rinfo['merchent_id'] );
define( 'SANDBOX', 0);
$cb=get_template_directory_uri() . "/payment/idpay/Verification-order.php";
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$cb=get_template_directory_uri() . "/payment/idpay/Verification-order.php?pt=hotel";
}
if (isset($_GET['pt']) && $_GET['pt'] == 'experiences'){
	$cb=get_template_directory_uri() . "/payment/idpay/Verification-order.php?pt=experiences";
}
$params = array(
	'order_id' => $order_id,
	'amount'   => $am,
	'phone'    => '',
	'name'     => '',
	'desc'     => '',
	'passenger_name'     => $pass_name,
	'passenger_famili'     => $pass_famili,
	'passenger_phone'     => $pass_phone,
	'callback' => $cb
);


idpay_payment_create( $params );


/**
 * @param array $params
 *
 * @return bool
 */

function idpay_payment_create( $params ) {
	$header = array(
		'Content-Type: application/json',
		'X-API-KEY:' . APIKEY,
		'X-SANDBOX:' . SANDBOX,
	);

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, URL_PAYMENT );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	$result = curl_exec( $ch );
	curl_close( $ch );

	$result = json_decode( $result );

	if ( empty( $result ) || empty( $result->link ) ) {

		print 'Exception message:';
		print '<pre>';
		print_r($result);
		print '</pre>';

		return false;
	}
	if ( ! empty( $result ) ) {
		global $wpdb;

		$am         = $_POST['up_wallet_amount'];
		$table_name = $wpdb->prefix . 'jayto_transaction';
		$user       = wp_get_current_user();
		$user_id    = $user->ID;
		$wpdb->insert( $table_name, array(
			'Authority'      => $result->id,
			'user_id'    => $user_id,
			'pay_date'   => time(),
			'pay_status' => 0,
			'amount'     => $params['amount'],
			'orderid'    => $params['order_id'],
			'passenger_name'    => $params['passenger_name'],
			'passenger_famili'    => $params['passenger_famili'],
			'passenger_phone'    => $params['passenger_phone'],
		), array(
			'%s',
			'%s',
			'%d',
			'%d',
			'%d',
			'%d',
			'%s',
			'%s',
			'%s',
		) );
	}
	//.Redirect to payment form
	header( 'Location:' . $result->link );
}