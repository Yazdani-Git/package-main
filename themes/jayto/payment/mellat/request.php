<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
require_once( get_template_directory() . '/lib/nusoap.php' );
$am       = $_POST['up_wallet_amount'];
$user_id   = get_current_user_id();
$bank_rinfo=get_option('bareqinf');
$terminalId		= $bank_rinfo['merchent_id'];					// Terminal ID
$userName		= $bank_rinfo['bank_user_name'];					// Username
$userPassword	= $bank_rinfo['bank_pass'];						// Password
$orderId		= time();						// Order ID
$amount 		= $am *10;						// Price / Rial
$localDate		= date('Ymd');					// Date
$localTime		= date('Gis');					// Time
$additionalData	= '';
$send_ui=$user_id+66166944587;
$callBackUrl	= get_template_directory_uri()."/payment/mellat/Verification.php?auth=".$send_ui ;	// Callback URL
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
		echo "Error : ". $err;
		exit;
	}
	else
	{
		$res 		= explode (',',$result);

		$ResCode 	= $res[0];
		if ($ResCode == "0")
		{


			$table_name = $wpdb->prefix . 'jayto_transaction';
			$wpdb->insert( $table_name, array(


				'refid'      => $res[1],
				'user_id'    => $user_id,
				'pay_date'   => time(),
				'pay_status' => 0,
				'amount'     => $am*10,
				'orderid'     => $orderId,



			), array(
				'%s',
				'%s',
				'%d',
				'%d',
				'%d',
				'%d',


			) );
			//-- انتقال به درگاه پرداخت
			echo '<form name="myform" action="https://bpm.shaparak.ir/pgwchannel/startpay.mellat" method="POST">
					<input type="hidden" id="RefId" name="RefId" value="'. $res[1] .'">
					
				</form>
				<script type="text/javascript">window.onload = formSubmit; function formSubmit() { document.forms[0].submit(); }</script>';
			exit;
		}
		else
		{
//			//-- نمایش خطا
//			echo "Error : ". $result;
//			exit;
		}
	}
}
?>