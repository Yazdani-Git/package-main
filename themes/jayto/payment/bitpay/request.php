<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
include_once("sender.php");
if ( isset( $_POST['psi_name'] ) ) {
	$pass_name = $_POST['psi_name'];
}
if ( isset( $_POST['psi_lastname'] ) ) {
	$pass_famili = $_POST['psi_lastname'];
}
if ( isset( $_POST['psi_phone'] ) ) {
	$pass_phone = $_POST['psi_phone'];
}

$user       = wp_get_current_user();
$user_id    = $user->ID;
$bank_rinfo=get_option('bareqinf');
define('APIKEY', $bank_rinfo['merchent_id']);
 $am       = $_POST['up_wallet_amount']*10;

$url = 'https://bitpay.ir/payment/gateway-send';
$api = APIKEY;
 $amount = $am;
$redirect = get_template_directory_uri() . "/payment/bitpay/Verification.php";
$name = $pass_name;//ekhtiari
$email = '';//ekhtiari
$description = '';//ekhtiari
$factorId = time();//ekhtiari


$result = send($url,$api,$amount,$redirect,$factorId,$name,$email,$description);
print_r($result);

if($result > 0 && is_numeric($result))
{
	global $wpdb;


	$table_name = $wpdb->prefix . 'jayto_transaction';

	$wpdb->insert( $table_name, array(

		'user_id'    => $user_id,
		'pay_date'   => time(),
		'pay_status' => 0,
		'amount'     =>  $amount/10,
		'orderid'     =>$factorId,




	), array(

		'%d',
		'%d',
		'%d',
		'%d',
		'%d',


	) );
	$go = "https://bitpay.ir/payment/gateway-$result-get";
	header("Location: $go");
}
?>
