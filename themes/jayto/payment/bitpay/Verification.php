<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
$bank_rinfo=get_option('bareqinf');
define('APIKEY', $bank_rinfo['merchent_id']);
get_header( 'empty' );
include_once("sender.php");
$url = 'https://bitpay.ir/payment/gateway-result-second';
$api = APIKEY;
$trans_id = $_GET['trans_id'];
$id_get = $_GET['id_get'];
$user       = wp_get_current_user();
$user_id    = $user->ID;

$result = get($url,$api,$trans_id,$id_get);

$parseDecode = json_decode($result);
//echo $parseDecode->factorId;
if($parseDecode->status == 1)
{
	//true

	//mablagh ersali
	$amount= $parseDecode->amount;

	//factore ersali (ekhtiari)
	$factor= $parseDecode->factorId;

	//shomare kart pardakht konanade
	$cart_number =  $parseDecode->cardNum;
	//	global $wpdb;



global $wpdb;
$table_name = $wpdb->prefix . 'jayto_transaction';
	$order = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE orderid = {$factor}", OBJECT );

	$wpdb->update( $table_name, array(
		'refid'            => $trans_id,
		'pay_status'       => 1,
		'transaction_desc' => 'افزایش اعتبار کیف پول',
        'Authority'=>$id_get,
	), array( 'orderid' => $factor ), array(
		'%d',
		'%d',
		'%s',
		'%d',
	), array( '%d' ) );
	$old_wallet = get_user_meta( $order->user_id, 'jayto-wallet' );
	$new_wallet = '';
	if ( $old_wallet ) {
		$new_wallet = intval( $old_wallet[0] ) +$amount/10;
	} else {
		$new_wallet = $amount/10;
	}
	update_user_meta( $order->user_id, 'jayto-wallet', $new_wallet );
	$url = home_url() . '/wallet/';

	?>
	<div class="pay_err_box">
		<img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
		<span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo $amount/10 ; ?> تومان  با موفقیت شارژ شد.</span>
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
<?php
}
get_footer();
