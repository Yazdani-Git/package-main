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
$bank_rinfo=get_option('bareqinf');
$am       = $_POST['up_wallet_amount'];
$cb=get_template_directory_uri() . "/payment/zarinpal/Verification-order.php";
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$cb=get_template_directory_uri() . "/payment/zarinpal/Verification-order.php?pt=hotel";
}
$data     = array(
	"merchant_id"  => $bank_rinfo['merchent_id'],
	"amount"       => $am ,
	"callback_url" =>  $cb,
	'currency'=>'IRT',
	"description"  => "تراکنش رزرو",
	"metadata"     => [ "email" => "info@email.com", "mobile" => "09121234567" ],
);
$jsonData = json_encode( $data );
$ch       = curl_init( 'https://api.zarinpal.com/pg/v4/payment/request.json' );
curl_setopt( $ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v1' );
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $jsonData );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
	'Content-Type: application/json',
	'Content-Length: ' . strlen( $jsonData )
) );

$result = curl_exec( $ch );
$err    = curl_error( $ch );
$result = json_decode( $result, true, JSON_PRETTY_PRINT );
curl_close( $ch );

if ( $err ) { ?>

    <div class="pay_err_box">
		<?php
		echo $err.": خطا" ;
		?>
    </div>
	<?php


} else {
	if ( empty( $result['errors'] ) ) {

		if ( $result['data']['code'] == 100 ) {
			$user       = wp_get_current_user();
			$user_id    = $user->ID;
			$table_name = $wpdb->prefix . 'jayto_transaction';
			$wpdb->insert( $table_name, array(

				'Authority'        => $result['data']['authority'],
				'refid'            => '',
				'user_id'          => $user_id,
				'pay_date'         => time(),
				'pay_status'       => 0,
				'amount'           => $am ,
				'orderid'          => $order_id,
				'passenger_name'   => $pass_name,
				'passenger_famili' => $pass_famili,
				'passenger_phone'  => $pass_phone,


			), array(
				'%s',
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

			header( 'Location:https://www.zarinpal.com/pg/StartPay/' . $result['data']["authority"] );
		}
	} else {
		?>
        <div class="pay_err_box">
            <span><?php echo $result['errors']['message'] ?></span>
        </div>
		<?php

	}
}

?>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/solid.js" integrity="sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l" crossorigin="anonymous"></script>
<script defer src="https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js" integrity="sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c" crossorigin="anonymous"></script>

<style>
    body, html {
        font-family: IRANYekan;
    }

    .profile_button.active > .profile_drop {
        opacity: 1;
        visibility: visible;
        transform: scaley(1);
        z-index: 999;
        font-size: 12px;
    }

    .svg-inline--fa {

        font-size: 11px;

    }

    .pay_err_box {
        display: flex;
        flex-direction: column;
        gap: 13px;
        background: white;
        width: 702px;
        height: 266px;
        box-shadow: 0 0 15px 4px rgb(0 0 0 / 10%);
        justify-content: center;
        border-radius: 8px;
        margin: 30px auto;
        position: relative;
        font-family: IRANYekan;
        bottom: 0;
        right: 0;
        left: 0;
        text-align: center;
    }

    .pay_err_box a {
        width: 200px;
        margin: 0 auto;
        height: 34px;
        border: none;
        border-radius: 7px;
        font-family: 'IRANYEKAN';
        cursor: pointer;
    }

    .peb_link a {
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        justify-content: center;
        width: 200px;
        font-size: 12px;
        height: 44px;
        color: black;
        font-family: 'IRANYekan';
        box-shadow: 0 0 18px 3px rgb(0 0 0 / 10%);
        cursor: pointer;
        margin: 0 10px;
    }

    .peb_link a:hover {
        border-radius: 7px;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 200px;
        font-size: 12px;
        height: 44px;
        color: black;
        font-family: 'IRANYekan';
        box-shadow: 0 0 18px 3px rgb(0 0 0 / 10%);
        cursor: pointer;
        margin: 0 10px;
    }

    .peb_link {
        display: flex;
        align-items: center;
        justify-content: center;
        margin-bottom: 20px;
    }

    .pay_err_box img {
        width: 35px;
        margin: 0 auto;
    }
</style>