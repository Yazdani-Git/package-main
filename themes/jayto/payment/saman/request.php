<?php
require_once( dirname( __DIR__, 5 ) . '/wp-load.php' );
$url        = home_url() . '/wallet/';
$am         = $_POST['up_wallet_amount'];
$user_id    = get_current_user_id();
$bank_rinfo = get_option( 'bareqinf' );

// اطلاعات درگاه بانک سامان
$merchantId  = $bank_rinfo['merchent_id'];
$apiKey      = $merchantId;
$amount      = $am * 10; // مبلغ به ریال
$ResNum     = time();
$callbackUrl = get_template_directory_uri() . "/payment/saman/Verification.php";

// اطلاعات تراکنش

$data = [
	"action"      => "token",
	"TerminalId"  => $merchantId,
	"Amount"      => $amount,
	"ResNum"      => $ResNum,
	"RedirectUrl" => $callbackUrl,
	"CellNumber"  => "9120000000",
];


$ch = curl_init( "https://sep.shaparak.ir/OnlinePG/OnlinePG" );  // آدرس API بانک سامان
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $data ) );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, [ "Content-Type: application/json" ] );

$response = curl_exec( $ch );
curl_close( $ch );

$result = json_decode( $response, true );

// بررسی نتیجه درخواست
if ( $result && isset( $result['token'] )  && $result['status'] == 1) {
	$token = $result['token'];

	$user       = wp_get_current_user();
	$user_id    = $user->ID;
	$table_name = $wpdb->prefix . 'jayto_transaction';
	$wpdb->insert( $table_name, array(

		'Authority'        => $ResNum,
		'user_id'          => $user_id,
		'pay_date'         => time(),
		'pay_status'       => 0,
		'amount'           => $am ,
		'orderid'          => $RefNum ,
		'transaction_desc'  =>'افزایش اعتبار کیف پول' ,


	), array(
		'%s',
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',


	) );
	header( "Location: https://sep.shaparak.ir/OnlinePG/SendToken?token=" . $token ); // هدایت به درگاه
	exit;
} else {
	echo "خطا در دریافت توکن پرداخت: " . ( $result['error'] ?? "نامشخص" );
}
?>

