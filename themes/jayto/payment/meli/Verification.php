<?php

require_once( dirname(__DIR__, 5). '/wp-load.php' );
require_once( dirname(__DIR__, 5).'/wp-blog-header.php');
$url = home_url() . '/wallet/';

get_header( 'empty' );
$bank_rinfo = get_option( 'bareqinf' );
define( 'APIKEY', $bank_rinfo['merchent_id'] );
define( 'TerminalId', $bank_rinfo['terminal_id'] );
define( 'TerminalKey', $bank_rinfo['terminal_kye'] );
$key        = TerminalKey;

 $OrderId=$_POST["OrderId"];
 $Token=$_POST["Token"];
 $ResCode=$_POST["ResCode"];
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
		require_once 'triple.php';
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

if($ResCode==0)
{

	$verifyData = array('Token'=>$Token,'SignData'=>openssl_encrypt_pkcs7($Token,$key));

	 $str_data = json_encode($verifyData);
	$res=curl_webservice('https://sadad.shaparak.ir/VPG/api/v0/Advice/Verify',$str_data);
	 $arrres=json_decode($res);

}

if($arrres->ResCode!=-1 && $ResCode==0)
{

	//Save $arrres->RetrivalRefNo,$arrres->SystemTraceNo,$arrres->OrderId to DataBase
//	echo "شماره سفارش:".$OrderId."<br>"."شماره پیگیری : ".$arrres->SystemTraceNo."<br>"."شماره مرجع:".

	echo $user_id = $_GET['dd']-634669;

	global $wpdb;

	$table_name = $wpdb->prefix . 'jayto_transaction';
	$check_pay  = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT * FROM {$table_name} WHERE refid = %s",$Token
		)
	);
	if ( $check_pay->pay_status == 0 ) {
		$wpdb->update( $table_name, array(
			'refid'            => $Token,
			'pay_status'       => 1,
			'transaction_desc' => 'افزایش اعتبار کیف پول',
		), array( 'refid' => $Token ), array(
			'%d',
			'%d',
			'%s',
		), array( '%s' ) );

		$old_wallet = get_user_meta( $user_id, 'jayto-wallet' );
		$new_wallet = '';
		if ( $old_wallet ) {
			$new_wallet = intval( $old_wallet[0] ) + $check_pay->amount;
		} else {
			$new_wallet = $check_pay->amount;
		}
		update_user_meta( $user_id, 'jayto-wallet', $new_wallet );
		$url = home_url() . '/wallet/';

		?>
		<div class="pay_err_box">
			<img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
			<span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo $check_pay->amount ; ?> تومان  با موفقیت شارژ شد.</span>
			<span>شماره پیگیری تراکنش <?php echo $arrres->SystemTraceNo ?></span>

			<div class="peb_link">
				<a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
			</div>
		</div>
		<?php
	}



}
else
	echo "تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.";
?>