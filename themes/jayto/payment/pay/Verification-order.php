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
$api = $bank_rinfo['merchent_id'];;
$token   = $_GET['token'];
$result  = json_decode( verify( $api, $token ) );
$user_id = get_current_user_id();

if ( isset( $result->status ) ) {
	if ( $result->status == 1 ) {
		global $wpdb;
		$table_name       = $wpdb->prefix . 'jayto_transaction';
		$table_order_name = $wpdb->prefix . 'jayto_orders';
		$trans_id         = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE Authority = '{$result->transId}'", ARRAY_A );
		if ( $trans_id['pay_status'] == 0 ) {
			$wpdb->update( $table_name, array(
				'Authority'        => $result->transId,
				'pay_status'       => 1,
				'transaction_desc' => 'واریز بابت رزرو',
			), array( 'refid' => $_GET['token'] ), array(

				'%d',
				'%d',
				'%s',
			), array( '%s' ) );
			$order_table = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE Authority = '{$result->transId}'", ARRAY_A );

			$wpdb->update( $table_order_name, array(
				'order_status' => 10,

			), array( 'id' => $order_table['orderid'] ), array(
				'%d',

			), array( '%d' ) );
			$or_id      = $order_table['orderid'];
			$hoster_id  = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );
			if ( $hoster_id['discount_price'] != 0){
				$hoster_id['price'] = $hoster_id['discount_price'];
			}
            $hp         = get_option( 'hoster_percent' );
			$old_wallet = get_user_meta( $hoster_id['author_id'], 'jayto-wallet', true );
			$new_wallet = $old_wallet + ( $hoster_id[ 'author_id' ] * $hp ) / 100;
			update_user_meta( $hoster_id['author_id'], 'jayto-wallet', $new_wallet );

			$wpdb->update( $table_order_name, array(
				'host_share' => ( ( $hoster_id[ 'author_id' ] / 10 ) * $hp ) / 100,
			), array( 'id' => $or_id ), array(
				'%d',

			), array( '%d' ) );
			$url = home_url() . '/trips/';


			?>


            <div class="pay_err_box">
                <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
                <span>پرداخت شما با موفقیت انجام شد.</span>
                <span>شناسه درخواست بانکی : <?php echo $result->transId ?></span>
                <span>مبلغ تراکنش : <?php echo number_format( $result->amount / 10 ) ?>&nbsp;تومان</span>

                <div class="peb_link">
                    <a href="<?php echo $url ?>">رفتن به سفرهای من</a>
                    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
                </div>
            </div>

		<?php } else { $url = home_url() . '/trips/'; ?>
            <div class="pay_err_box">

                <span>این درخواست قبلا انجام شده.</span>


                <div class="peb_link">
                    <a href="<?php echo $url ?>">رفتن به سفرهای من</a>
                    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
                </div>
            </div>
		<?php } ?>


	<?php } else {
		echo "<h1>تراکنش با خطا مواجه شد</h1>";
	}
} else {
	if ( $_GET['status'] == 0 ) {
		echo "<h1>تراکنش با خطا مواجه شد</h1>";
	}
}