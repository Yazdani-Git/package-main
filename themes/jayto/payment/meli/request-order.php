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
define( 'APIKEY', $bank_rinfo['merchent_id'] );
define( 'TerminalId', $bank_rinfo['terminal_id'] );
define( 'TerminalKey', $bank_rinfo['terminal_kye'] );
$Amount     = $_POST['up_wallet_amount'] * 10;
$key        = TerminalKey;
$MerchantId = APIKEY;
$TerminalId = TerminalId;
$OrderId    = time();
$uuid=get_current_user_id()+634669;

$CallBack=get_template_directory_uri() . "/payment/meli/Verification-order.php?dd=$uuid";
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$CallBack=get_template_directory_uri() . "/payment/meli/Verification-order.php?pt=hotel&&dd=$uuid";
}
if (isset($_GET['pt']) && $_GET['pt'] == 'experiences'){
	$CallBack=get_template_directory_uri() . "/payment/meli/Verification-order.php?pt=experiences&&dd=$uuid";
}
require_once 'triple.php';
function openssl_encrypt_pkcs7( $key, $data ) {
	$encData = openssl_encrypt( $data, 'des-ede3', $key, 0 );

	return $encData;
}


function sadad_encrypt( $data, $key ) {
	$key = base64_decode( $key );
	if ( function_exists( 'openssl_encrypt' ) ) {
		return openssl_encrypt_pkcs7( $key, $data );
	} elseif ( function_exists( 'mcrypt_encrypt' ) ) {
		return mcrypt_encrypt_pkcs7( $data, $key );
	} else {
		require_once 'TripleDES.php';
		$cipher = new triple();

		return $cipher->letsEncrypt( $key, $data );
	}

}


if ( ! function_exists( 'curl_webservice' ) ) {
	function curl_webservice( $url, $data = false ) {
		$curl = curl_init( $url );
		curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, "POST" );
		curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
		curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
		curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
		curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen( $data ) ) );
		$result = curl_exec( $curl );
		curl_close( $curl );

		return $result;
	}
}

$LocalDateTime = date( "m/d/Y g:i:s a" );
$SignData = sadad_encrypt( "$TerminalId;$OrderId;$Amount", "$key" );
$data = array(
	'TerminalId'    => $TerminalId,
	'MerchantId'    => $MerchantId,
	'Amount'        => $Amount,
	'SignData'      => $SignData,
	'ReturnUrl'     => $CallBack,
	'LocalDateTime' => $LocalDateTime,
	'OrderId'       => $OrderId
);


$str_data = json_encode( $data );
$res      = curl_webservice( 'https://sadad.shaparak.ir/VPG/api/v0/Request/PaymentRequest', $str_data );
$arrres   = json_decode( $res );

if ( $arrres->ResCode == 0 ) {
	$Token = $arrres->Token;
	$url   = "https://sadad.shaparak.ir/VPG/Purchase?Token=$Token";
	global $wpdb;


	$table_name = $wpdb->prefix . 'jayto_transaction';
	$user       = wp_get_current_user();
	$user_id    = $user->ID;
	$wpdb->insert( $table_name, array(


		'refid'      => $Token,
		'user_id'    => $user_id,
		'pay_date'   => time(),
		'pay_status' => 0,
		'amount'     => $Amount/10,
		'orderid'    => $order_id,
		'passenger_name'    => $pass_name,
		'passenger_famili'    => $pass_famili,
		'passenger_phone'    => $pass_phone,

	), array(

		'%s',
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',
		'%s',
		'%s',


	) );
	header( "Location:$url" );
} else {
	die( $arrres->Description );
}
?>