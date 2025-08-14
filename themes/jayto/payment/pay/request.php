<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
$bank_rinfo=get_option('bareqinf');
$am       = $_POST['up_wallet_amount']*10;
$user_id = get_current_user_id();
$send_ui=$user_id+66166944587;
function send($api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null) {
	return curl_post('https://pay.ir/pg/send', [
		'api'          => $api,
		'amount'       => $amount,
		'redirect'     => $redirect,
		'mobile'       => $mobile,
		'factorNumber' => $factorNumber,
		'description'  => $description,
	]);
}

function verify($api, $token) {
	return curl_post('https://pay.ir/pg/verify', [
		'api' 	=> $api,
		'token' => $token,
	]);
}

function curl_post($url, $params)
{
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
	]);
	$res = curl_exec($ch);
	curl_close($ch);

	return $res;
}
//===============================================
$api = $bank_rinfo['merchent_id'];
$amount = $am*10;
$mobile = "";
$factorNumber = "";
$description = "افزایش موجودی کیف پول";
$redirect = get_template_directory_uri() . "/payment/pay/Verification.php";
$result = send($api, $am, $redirect, $mobile, $factorNumber, $description);
$result = json_decode($result);

if($result->status == 1) {

	$go = "https://pay.ir/pg/$result->token";
	global $wpdb;


	$table_name = $wpdb->prefix . 'jayto_transaction';
	$user       = wp_get_current_user();
	$user_id    = $user->ID;
	$wpdb->insert( $table_name, array(
		'refid'      => $result->token,
		'user_id'    => $user_id,
		'pay_date'   => time(),
		'pay_status' => 0,
		'amount'     => $am,
		'orderid'     =>'',
		'transaction_desc'     =>$description,

	), array(

		'%s',
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',




	) );
	header("Location: $go");
} else {
	echo $result->errorMessage;
}