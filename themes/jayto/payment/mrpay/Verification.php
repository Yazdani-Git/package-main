<?php

require_once( dirname( __DIR__, 5 ) . '/wp-load.php' );
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

define( 'APIKEY', $bank_rinfo['merchent_id'] );
$transid = $_POST['transid'];
global $wpdb;
$table_name1       = $wpdb->prefix . 'jayto_transaction';
$transact = $wpdb->get_row(
	$wpdb->prepare(
		"SELECT * FROM {$table_name1} WHERE Authority = %s",
		$transid
	),
	ARRAY_A
);

 $am1=$transact['amount'];
$data = [
	'pin'     => APIKEY,
	'amount'  => $am1,
	'transid' => $_POST['transid']
];

$data = json_encode( $data );
$ch   = curl_init( 'https://panel.aqayepardakht.ir/api/v2/verify' );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLINFO_HEADER_OUT, true );
curl_setopt( $ch, CURLOPT_POST, true );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $data );

curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen( $data )
	)
);
$result = curl_exec( $ch );
curl_close( $ch );
$result = json_decode( $result );
if ( $result->code == "1" ) {

	global $wpdb;

	$table_name = $wpdb->prefix . 'jayto_transaction';
	$check_pay  = $wpdb->get_row(
		$wpdb->prepare(
			"SELECT * FROM {$table_name} WHERE Authority = %s",
			$transid
		)
	);
    $user_id=$check_pay->user_id;
	if ( $check_pay->pay_status == 0 ) {
		$wpdb->update( $table_name, array(
			'refid'            => $transid,
			'pay_status'       => 1,
			'transaction_desc' => 'افزایش اعتبار کیف پول',
		), array( 'Authority' => $transid ), array(
			'%d',
			'%d',
			'%s',
		), array( '%s' ) );

		$old_wallet = get_user_meta( $user_id, 'jayto-wallet' );
		$new_wallet = '';
		if ( $old_wallet ) {
			$new_wallet = intval( $old_wallet[0] ) + $am1;
		} else {
			$new_wallet = $am1;
		}
		update_user_meta( $user_id, 'jayto-wallet', $new_wallet );
		$url = home_url() . '/wallet/'; ?>
        <div class="peb_link" style="flex-direction: column;line-height: 70px">
              <span class="tgfg">کیف پول شما با موفقیت شارژ شد</span>
            <a href="<?php echo $url; ?>">بازگشت به کیف پول</a>
        </div>

	<?php } }else {
	?>
    <div class="pay_err_box">
        <span>خطایی در تراکنش رخ داده است.کد خطا</span>


    </div>
	<?php
}

