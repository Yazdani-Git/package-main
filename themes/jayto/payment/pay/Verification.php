<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';

get_header( 'empty' );
$bank_rinfo = get_option( 'bareqinf' );
function send( $api, $amount, $redirect, $mobile = null, $factorNumber = null, $description = null ) {
	return curl_post( 'https://pay.ir/pg/send', [
		'api'          => $api,
		'amount'       => $amount,
		'redirect'     => $redirect,
		'mobile'       => $mobile,
		'factorNumber' => $factorNumber,
		'description'  => $description,
	] );
}

function verify( $api, $token ) {
	return curl_post( 'https://pay.ir/pg/verify', [
		'api'   => $api,
		'token' => $token,
	] );
}

function curl_post( $url, $params ) {
	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, $url );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, false );
	curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, [
		'Content-Type: application/json',
	] );
	$res = curl_exec( $ch );
	curl_close( $ch );

	return $res;
}

//=====================================
$api     = $bank_rinfo['merchent_id'];
$token   = $_GET['token'];
$result  = json_decode( verify( $api, $token ) );
$user_id = get_current_user_id();
?>


<?php
if ( isset( $result->status ) ) {
	if ( $result->status == 1 ) {

		global $wpdb;
		$table_name = $wpdb->prefix . 'jayto_transaction';

		$check_pay  = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE refid = %s",
				$token
			)
		);

		if ( $check_pay->pay_status == 0 ) {

			$wpdb->update( $table_name, array(
				'Authority'        => $result->transId,
				'pay_status'       => 1,
				'transaction_desc' => 'افزایش اعتبار کیف پول',
			), array( 'refid' => $token ), array(

				'%d',
				'%d',
				'%s',
			), array( '%s' ) );
			$old_wallet = get_user_meta( $user_id, 'jayto-wallet' );
			$new_wallet = '';
			if ( $old_wallet ) {
				$new_wallet = intval( $old_wallet[0] ) + $result->amount;
			} else {
				$new_wallet = $result->amount;
			}
			update_user_meta( $user_id, 'jayto-wallet', $new_wallet );


			?>
            <div class="pay_err_box">

                <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
                <span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo $result->amount / 10; ?> تومان  با موفقیت شارژ شد.</span>

                <div class="peb_link">

                    <a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
                </div>
            </div>

			<?php
		}else{?>
            <div class="pay_err_box">

                <span>این تراکنش قبلا انجام شده</span>

                <div class="peb_link">

                    <a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
                </div>
            </div>
		<?php }
		?>


	<?php } else {
		echo "<h1>تراکنش با خطا مواجه شد</h1>";
	}
} else {
	if ( $_GET['status'] == 0 ) {
		echo "<h1>تراکنش با خطا مواجه شد</h1>";
	}
}