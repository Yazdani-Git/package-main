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
 $am         = $_POST['up_wallet_amount'];
define( 'APIKEY', $bank_rinfo['merchent_id'] );
$cb=get_template_directory_uri() . "/payment/mrpay/Verification-order.php";
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$cb=get_template_directory_uri() . "/payment/mrpay/Verification-order.php?pt=hotel";
}
if (isset($_GET['pt']) && $_GET['pt'] == 'experiences'){
	$cb=get_template_directory_uri() . "/payment/mrpay/Verification-order.php?pt=experiences";
}


$data = [
	'pin'    => APIKEY,
	'amount'    => $am,
	'callback' =>  $cb,
	'card_number' => '',
	'mobile' =>  $pass_phone,
	'email' => 'test@test.com',
	'invoice_id' => $order_id,
	'description' => ''
];

$data = json_encode($data);
$ch = curl_init('https://panel.aqayepardakht.ir/api/v2/create');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLINFO_HEADER_OUT, true);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data);

curl_setopt($ch, CURLOPT_HTTPHEADER, array(
		'Content-Type: application/json',
		'Content-Length: ' . strlen($data))
);
$result = curl_exec($ch);
curl_close($ch);
$result = json_decode($result);

if ($result->status == "success") {
	global $wpdb;
	$table_name = $wpdb->prefix . 'jayto_transaction';
	$user       = wp_get_current_user();
	$user_id    = $user->ID;
	$wpdb->insert( $table_name, array(
		'Authority'      => $result->transid,
		'user_id'    => $user_id,
		'pay_date'   => time(),
		'pay_status' => 0,
		'amount'     => $am,
		'orderid'    => $order_id,
		'passenger_name'    => $pass_name,
		'passenger_famili'    => $pass_famili,
		'passenger_phone'    => $pass_phone,

	), array(
		'%s',
		'%s',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',
		'%s',
		'%s',



	) );
	header('Location: https://panel.aqayepardakht.ir/startpay/' . $result->transid);
} else {
	echo "خطا";
}

