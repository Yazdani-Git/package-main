<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';

require_once( get_template_directory() . '/lib/nusoap.php' );
get_header('empty');
$user_id = $_GET['auth']-66166944587;


if ( $_POST['ResCode'] == '0' ) {
	//--پرداخت در بانک باموفقیت بوده


	$client    = new nusoap_client( 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl' );
	$namespace = 'http://interfaces.core.sw.bps.com/';

	$bank_rinfo=get_option('bareqinf');
	$terminalId		= $bank_rinfo['merchent_id'];					// Terminal ID
	$userName		= $bank_rinfo['bank_user_name'];					// Username
	$userPassword	= $bank_rinfo['bank_pass'];	             // Password
	$orderId      = $_POST['SaleOrderId'];        // Order ID

	$verifySaleOrderId     = $_POST['SaleOrderId'];
	$verifySaleReferenceId = $_POST['SaleReferenceId'];

	$parameters = array(
		'terminalId'      => $terminalId,
		'userName'        => $userName,
		'userPassword'    => $userPassword,
		'orderId'         => $orderId,
		'saleOrderId'     => $verifySaleOrderId,
		'saleReferenceId' => $verifySaleReferenceId
	);
	// Call the SOAP method
	$result = $client->call( 'bpVerifyRequest', $parameters, $namespace );
	define( 'oid', $_POST['SaleOrderId'] );
	define( 'RefIdoid', $_POST['RefId'] );
	define( 'amount', $_POST['FinalAmount'] );
	define( 'refrence', $_POST['SaleReferenceId'] );
	if ( $result == 0 ) {

		global $wpdb;


		global $wpdb;

		$refi       = RefIdoid;

		$table_name = $wpdb->prefix . 'jayto_transaction';
		$amu        = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE refid = '{$refi}' ", ARRAY_A );

		$wpdb->update( $table_name, array(

			'pay_status'       => 1,
			'Authority'       => refrence,
			'transaction_desc' => 'افزایش اعتبار کیف پول',
		), array( 'refid' => RefIdoid ), array(
			'%d',
			'%d',
			'%s',
		), array( '%s' ) );
		$old_wallet = get_user_meta( $user_id, 'jayto-wallet' );
		$new_wallet = '';
		if ( $old_wallet ) {
			$new_wallet = intval( $old_wallet[0] ) + amount/10;
		} else {
			$new_wallet = amount/10;
		}
		update_user_meta( $user_id, 'jayto-wallet', $new_wallet );
		$url = home_url() . '/wallet/';

		?>
        <div class="pay_err_box">

            <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
            <span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo amount/10;?> تومان  با موفقیت شارژ شد.</span>

            <div class="peb_link">
                <a href="<?php echo $url ?>">بازگشت به کیف پول.</a>
            </div>
        </div>

		<?php
	}
} else {
	//-- پرداخت با خطا همراه بوده

	echo 'Error : ' . $_POST['ResCode'];
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
<?php
get_footer('empty');