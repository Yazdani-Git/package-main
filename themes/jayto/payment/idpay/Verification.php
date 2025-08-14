<?php

require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';

get_header( 'empty' );
$order_id    = '';
$pass_name   = '';
$pass_famili = '';
$pass_phone  = '';
if ( isset( $_POST['dataoi'] ) ) {
	$order_id = $_POST['dataoi'];
}


$bank_rinfo = get_option( 'bareqinf' );
$am         = $_POST['up_wallet_amount'];
define( 'URL_CALLBACK', 'http://idpay-payment.local/callback.php' );
define( 'URL_PAYMENT', 'https://api.idpay.ir/v1.1/payment' );
define( 'URL_INQUIRY', 'https://api.idpay.ir/v1.1/payment/inquiry' );
define( 'URL_VERIFY', 'https://api.idpay.ir/v1.1/payment/verify' );
define( 'APIKEY', $bank_rinfo['merchent_id'] );
define( 'SANDBOX', 0 );

if ( $_SERVER['REQUEST_METHOD'] === 'POST' ) {
	$response = $_POST;
}

if ( $_SERVER['REQUEST_METHOD'] === 'GET' ) {
	$response = $_GET;
}

if ( empty( $response['status'] ) ||
     empty( $response['id'] ) ||
     empty( $response['track_id'] ) ||
     empty( $response['order_id'] ) ) {

	return false;
}




// if $response['id'] was not in the database return FALSE

$inquiry = idpay_payment_get_inquiry( $response );

if ( $inquiry ) {
	$verify = idpay_payment_verify( $response );
}


/**
 * @param array $response
 *
 * @return bool
 */
function idpay_payment_get_inquiry( $response ) {

	$header = array(
		'Content-Type: application/json',
		'X-API-KEY:' . APIKEY,
		'X-SANDBOX:' . SANDBOX,
	);

	$params = array(
		'id'       => $response['id'],
		'order_id' => $response['order_id'],
	);

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, URL_INQUIRY );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	$result = curl_exec( $ch );
	curl_close( $ch );

	$result = json_decode( $result );

	if ( empty( $result ) ||
	     empty( $result->status ) ) {

//		print 'Exception message:';
//		print '<pre>';
//		print_r( $result );
//		print '</pre>';

		return false;
	}

	if ( $result->status == 10 ) {

		return true;

	}

//	print idpay_payment_get_message( $result->status );
if ( $response['status'] != 10 ) {

	?>
       <div class="pay_err_box">
                <span>خطایی در تراکنش رخ داده است.کد خطا<?php echo $response['status']  ?></span>
        

                <div class="peb_link">
                   
                    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
                </div>
            </div>

<?php

}
	return false;
}


/**
 * @param array $response
 *
 * @return bool
 */
function idpay_payment_verify( $response ) {

	$header = array(
		'Content-Type: application/json',
		'X-API-KEY:' . APIKEY,
		'X-SANDBOX:' . SANDBOX,
	);

	$params = array(
		'id'       => $response['id'],
		'order_id' => $response['order_id'],
	);

	$ch = curl_init();
	curl_setopt( $ch, CURLOPT_URL, URL_VERIFY );
	curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
	curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
	curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

	$result = curl_exec( $ch );
	curl_close( $ch );

	$result = json_decode( $result );

	if ( empty( $result ) ||
	     empty( $result->status ) ) {

//		print 'Exception message:';
//		print '<pre>';
//		print_r( $result );
//		print '</pre>';

		return false;
	}
	if ( $result->status == 100 ) {

		$user_id = $_GET['auth']-66166944587;
			global $wpdb;

			$table_name = $wpdb->prefix . 'jayto_transaction';
		$check_pay  = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE Authority = %s",
				$result->id
			)
		);
		if ( $check_pay->pay_status == 0 ) {
			$wpdb->update( $table_name, array(
				'refid'            => $result->track_id,
				'pay_status'       => 1,
				'transaction_desc' => 'افزایش اعتبار کیف پول',
			), array( 'Authority' => $result->id ), array(
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
			$url = home_url() . '/wallet/';

			?>
            <div class="pay_err_box">
                <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
                <span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo $result->amount ; ?> تومان  با موفقیت شارژ شد.</span>
                <span>شماره پیگیری تراکنش <?php echo $result->track_id?></span>

                <div class="peb_link">
                    <a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
                </div>
            </div>
			<?php
		}else{$url = home_url() . '/wallet/'; ?>
            <div class="pay_err_box">

                <span>این تراکنش قبلا انجام شده</span>


                <div class="peb_link">
                    <a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
                </div>
            </div>
	<?php }


	}
}

/**
 * @param int $status
 *
 * @return string
 */
function idpay_payment_get_message( $status ) {

	switch ( $status ) {
		case 1:
			return 'پرداخت انجام نشده است';

		case 2:
			return 'پرداخت ناموفق بوده است';

		case 3:
			return 'خطا رخ داده است';

		case 10:
			return 'در انتظار تایید پرداخت';

		case 100:
			return 'پرداخت تایید شده است';

		case 101:
			return 'پرداخت قبلاً تایید شده است';

		default:
		return 'خطایی در تراکنش رخ داده است.';
	}
}