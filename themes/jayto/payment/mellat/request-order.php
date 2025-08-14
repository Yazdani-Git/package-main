<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
define( 'WP_USE_THEMES', true );
require_once( get_template_directory() . '/lib/nusoap.php' );
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

$am       = $_POST['up_wallet_amount'];
$user_id   = get_current_user_id();
$bank_rinfo=get_option('bareqinf');

$terminalId		= $bank_rinfo['merchent_id'];					// Terminal ID
$userName		= $bank_rinfo['bank_user_name'];					// Username
$userPassword	= $bank_rinfo['bank_pass'];					// Password
$orderId		= $order_id;						// Order ID
$amount 		= $am*10 ;						// Price / Rial
$localDate		= date('Ymd');					// Date
$localTime		= date('Gis');					// Time
$additionalData	= '';
$send_ui=$user_id+66166944587;
$callBackUrl	= get_template_directory_uri()."/payment/mellat/verification-order.php?auth=".$send_ui ;	// Callback URL
if (isset($_GET['pt']) && $_GET['pt'] == 'hotel'){
	$callBackUrl=get_template_directory_uri() . "/payment/mellat/verification-order.php?pt=hotel&auth=".$send_ui;
}
$payerId		=$user_id ;

//-- تبدیل اطلاعات به آرایه برای ارسال به بانک
$parameters = array(
	'terminalId' 		=> $terminalId,
	'userName' 			=> $userName,
	'userPassword' 		=> $userPassword,
	'orderId' 			=> $orderId,
	'amount' 			=> $amount,
	'localDate' 		=> $localDate,
	'localTime' 		=> $localTime,
	'additionalData' 	=> $additionalData,
	'callBackUrl' 		=> $callBackUrl,
	'payerId' 			=> $payerId);

$client = new nusoap_client('https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl');
$namespace='http://interfaces.core.sw.bps.com/';
$result 	= $client->call('bpPayRequest', $parameters, $namespace);
//-- بررسی وجود خطا
if ($client->fault)
{
	//-- نمایش خطا
	echo "There was a problem connecting to Bank";
	exit;
}
else
{
	$err = $client->getError();
	if ($err)
	{
		//-- نمایش خطا
//		echo "خطا : ". $err;
//		exit;
	}
	else
	{
		$res 		= explode (',',$result);

		$ResCode 	= $res[0];
		if ($ResCode == "0")
		{

			$table_name = $wpdb->prefix . 'jayto_transaction';
			$wpdb->insert( $table_name, array(

				'Authority'        => $res[1],
				'refid'            => $res[1],
				'user_id'          => $user_id,
				'pay_date'         => time(),
				'pay_status'       => 0,
				'amount'           => $am * 10,
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
			//-- انتقال به درگاه پرداخت
			echo '<form name="myform" action="https://bpm.shaparak.ir/pgwchannel/startpay.mellat" method="POST">
					<input type="hidden" id="RefId" name="RefId" value="'. $res[1] .'">
					
				</form>
				<script type="text/javascript">window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>';
			exit;
		}
		else
		{?>
            <div class="pay_err_box">

				<?php
				//				switch ($result){
				//					case 32;
				//					echo 'خطای تست';
				//					break;
				//				}
//				echo "خطا : ". $result;
				?>
            </div>

		<?php }
	}
}
?>
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
        margin: auto auto;
        position: absolute;
        font-family: IRANYekan;
        bottom: 0;
        right: 0;
        left: 0;
        top: 0;
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
