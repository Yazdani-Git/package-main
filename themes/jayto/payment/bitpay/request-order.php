<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
include_once("sender.php");
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
$am         = $_POST['up_wallet_amount']*10;
define('APIKEY', $bank_rinfo['merchent_id']);
$url = 'https://bitpay.ir/payment/gateway-send';
$api = APIKEY;
$amount = $am;

$cb=get_template_directory_uri() . "/payment/bitpay/Verification-order.php";
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$cb=get_template_directory_uri() . "/payment/bitpay/Verification-order.php?pt=hotel";
}
if (isset($_GET['pt']) && $_GET['pt'] == 'experiences'){
	$cb=get_template_directory_uri() . "/payment/bitpay/Verification-order.php?pt=experiences";
}
$redirect = $cb;
$name = $pass_name;//ekhtiari
$email = '';//ekhtiari
$description = 'واریز بابت رزرو';//ekhtiari
$factorId = $order_id;//ekhtiari
$result = send($url,$api,$amount,$redirect,$factorId,$name,$email,$description);
if($result > 0 && is_numeric($result))
{
		global $wpdb;
		$am         = $_POST['up_wallet_amount'];
		$table_name = $wpdb->prefix . 'jayto_transaction';
		$user       = wp_get_current_user();
		$user_id    = $user->ID;
		$wpdb->insert( $table_name, array(
			'Authority'      => '',
			'user_id'    => $user_id,
			'pay_date'   => time(),
			'pay_status' => 0,
			'amount'     => $amount/10,
			'orderid'    => $order_id,
			'passenger_name'    => $pass_name,
			'passenger_famili'    => $pass_famili,
			'passenger_phone'    => $pass_phone,




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


	$go = "https://bitpay.ir/payment/gateway-$result-get";
	header("Location: $go");
	}

