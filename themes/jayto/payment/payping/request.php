<?php

require_once( dirname( __DIR__, 5 ) . '/wp-load.php' );

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
$bank_rinfo = get_option( 'bareqinf' );
define( 'APIKEY', $bank_rinfo['merchent_id'] );
$amount  =intval( $_POST['up_wallet_amount'] * 10);


/* clientRefId: در صورت استفاده در حالت غیر دمو بهتر است شماره فاکتور در نظر گرفته شود. */
if( isset( $_POST['clientRefId'] ) ){
	$clientRefId = $_POST['clientRefId'];
}else{
	$clientRefId = time();
}

/* payerIdentity: شماره موبایل باشد، در غیر اینصورت ایمیل استفاده شود. */
if( $pass_phone){
	$payerIdentity = $pass_phone;
}elseif( isset( $_POST['clientRefId'] ) ){
	$payerIdentity = $_POST['clientRefId'];
}else{
	$payerIdentity = time();
}

if( isset( $_POST['Description']) ){
	$desc = $_POST['Description'];
}else{
	$desc = '';
}

/* توکن دریافتی از سایت payping.ir | بجای Token توکن خود را قرار دهید. */
$TokenCode = APIKEY;

/* آدرس صفحه برگشت کاربر بعد از صفحه پرداخت | بجای domain.com آدرس سایت خود را قرار دهید. */
$returnUrl = get_template_directory_uri() . "/payment/payping/Verification.php";

$data = array(
	'clientRefId'   => $clientRefId,
	'payerIdentity' => $payerIdentity,
	'Amount'        => $amount,
	'Description'   => $desc,
	'returnUrl'     => $returnUrl
);

try{
	$curl = curl_init();
	curl_setopt_array($curl, array(
			CURLOPT_URL => "https://api.payping.ir/v2/pay",
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING => "",
			CURLOPT_MAXREDIRS => 10,
			CURLOPT_TIMEOUT => 45,
			CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST => "POST",
			CURLOPT_POSTFIELDS => json_encode($data),
			CURLOPT_HTTPHEADER => array(
				"accept: application/json",
				"authorization: Bearer " . $TokenCode,
				"cache-control: no-cache",
				"content-type: application/json"
			),
		)
	);
	$response = curl_exec( $curl );


	$header = curl_getinfo( $curl );
	$err = curl_error( $curl );
	curl_close( $curl );

	if( $err ){
		$msg = 'کد خطا: CURL#' . $err;
		$erro = 'در اتصال به درگاه مشکلی پیش آمد.';
		return false;
	}else{
		if( $header['http_code'] == 200 ){
			$response = json_decode( $response, true );
			if( isset( $response ) and $response != '' ){
				$response = $response['code'];
				global $wpdb;


				$table_name = $wpdb->prefix . 'jayto_transaction';

				$wpdb->insert( $table_name, array(

					'user_id'    => $user_id,
					'pay_date'   => time(),
					'pay_status' => 0,
					'amount'     =>  $amount/10,
					'orderid'     =>$clientRefId,

				), array(

					'%d',
					'%d',
					'%d',
					'%d',
					'%d',


				) );
				/* ارسال به درگاه پرداخت با استفاده از کد ارجاع */
				$GoToIPG = 'https://api.payping.ir/v2/pay/gotoipg/' . $response;
				header( 'Location: ' . $GoToIPG );
			}else{
				$msg = 'تراکنش ناموفق بود - شرح خطا: عدم وجود کد ارجاع';
			}
		}elseif($header['http_code'] == 400){
			$msg = 'تراکنش ناموفق بود، شرح خطا: ' . $response;
		}else{
			$msg = 'تراکنش ناموفق بود، شرح خطا: ' . $header['http_code'];
		}
	}
}catch(Exception $e){
	$msg = 'تراکنش ناموفق بود، شرح خطا سمت برنامه شما: ' . $e->getMessage();
}
