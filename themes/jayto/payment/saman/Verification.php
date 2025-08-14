<?php
require_once( dirname(__DIR__, 5) . '/wp-load.php' );

$url = home_url() . '/wallet/';
get_header('empty');
 $ResNum = $_POST['ResNum'] ?? '';  // شماره پیگیری تراکنش
$RefNum = $_POST['RefNum'] ?? '';  // شماره پیگیری تراکنش
$MID = $_POST['MID'] ?? '';  // شماره سفارش
$trackingCode = $_POST['TRACENO'] ?? '';  // شماره رهگیری بانک (اختیاری)
global $wpdb;
$results_table = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_transaction WHERE  Authority = '{$ResNum}'  ", ARRAY_A );
$user_id =$results_table['user_id'];
$bank_rinfo  = get_option('bareqinf');
$merchantId  = $bank_rinfo['merchent_id'];
if (empty($RefNum) || empty($ResNum)) {
	echo "خطا: اطلاعات تراکنش ناقص است.";
	exit;
}

if (empty($RefNum) || $RefNum == $results_table['refid']) {
	echo "خطا : این تراکنش قبلا انجام شده";
	exit;
}

// تنظیم اطلاعات مورد نیاز برای درخواست تأیید
$data = [
	"RefNum" =>$RefNum ,
	"TerminalNumber"     =>$MID,

];

// ارسال درخواست به بانک برای تأیید تراکنش
$ch = curl_init("https://sep.shaparak.ir/verifyTxnRandomSessionkey/ipg/VerifyTransaction");  // آدرس تأییدیه تراکنش
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
$response = curl_exec($ch);  // دریافت پاسخ بانک
curl_close($ch);
$result = json_decode($response, true);  // تبدیل پاسخ JSON به آرایه PHP
if ( $result['Success'] == 1) {


	$table_name = $wpdb->prefix . 'jayto_transaction';
	$wpdb->update( $table_name, array(
		'refid'            => $result['TransactionDetail'][ 'RefNum' ],
		'pay_status'       => 1,
		'transaction_desc' => 'افزایش اعتبار کیف پول',
	), array( 'Authority' => $ResNum ), array(
		'%s',
		'%d',
		'%s',
	), array( '%s' ) );
	$old_wallet = get_user_meta( $user_id, 'jayto-wallet' );
	$new_wallet = '';
	if ( $old_wallet ) {
		$new_wallet = intval( $old_wallet[ 0 ] ) + $results_table[ 'amount' ];
	} else {
		$new_wallet = $results_table[ 'amount' ];
	}
	update_user_meta( $user_id, 'jayto-wallet', $new_wallet );
	$url = home_url() . '/wallet/';
    $trace=$result['TransactionDetail'][ 'Trace' ];
	?>
    <div class = 'pay_err_box'>
        <img src = '<?php echo get_template_directory_uri() ?>/images/ok-icon.png' alt = ''>
        <span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo esc_html($results_table[ 'amount' ]);
			?> تومان  با موفقیت شارژ شد.</span>
        <span>شماره پیگیری تراکنش <?php  echo esc_html($trackingCode)?></span>

        <div class = 'peb_link'>
            <a href = "<?php echo $url ?>">بازگشت به کیف پول.</a>
        </div>
    </div>
        <?php
    } else {
        echo '<div class="pay_err_box"><span>خطا در تأیید پرداخت: ' . ($result['errorMessage'] ?? 'مشکلی پیش آمده است') . '</span></div>';
    }


?>
