<?php
require_once( dirname( __DIR__, 5 ) . '/wp-load.php' );
$url = home_url() . '/wallet/';

require_once( get_template_directory() . '/lib/nusoap.php' );
get_header( 'empty' );
$user_id = $_GET['auth'] - 66166944587;


echo '<br>';
if ( $_POST['ResCode'] == 0 ) {
	//--پرداخت در بانک باموفقیت بوده


	$client       = new nusoap_client( 'https://bpm.shaparak.ir/pgwchannel/services/pgw?wsdl' );
	$namespace    = 'http://interfaces.core.sw.bps.com/';
	$bank_rinfo   = get_option( 'bareqinf' );
	$terminalId   = $bank_rinfo['merchent_id'];                    // Terminal ID
	$userName     = $bank_rinfo['bank_user_name'];                    // Username
	$userPassword = $bank_rinfo['bank_pass'];                   // Password
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
		$table_name       = $wpdb->prefix . 'jayto_transaction';
		$table_order_name = $wpdb->prefix . 'jayto_orders';
		if ( isset( $_GET['pt'] ) ) {
			if ( $_GET['pt'] == 'hotel' ) {
				$table_order_name = $wpdb->prefix . 'jayto_hotel_orders';

			}
		}
		if ( isset( $_GET['pt'] ) ) {
			if ( $_GET['pt'] == 'experiences' ) {
				$table_order_name = $wpdb->prefix . 'tour_reserve_request';
			}
		}
		$check_pay = $wpdb->get_row(
			$wpdb->prepare(
				"SELECT * FROM {$table_name} WHERE Authority = %s",
				RefIdoid
			)
		);
		if ( $check_pay->pay_status == 0 ) {
			$wpdb->update( $table_name, array(
				'refid'            => RefIdoid,
				'pay_status'       => 1,
				'transaction_desc' => 'واریز بابت رزرو',
			), array( 'Authority' => RefIdoid ), array(

				'%d',
				'%d',
				'%s',
			), array( '%s' ) );
			$order_table = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE Authority = '{$check_pay->Authority}'", ARRAY_A );
			$pt          = $_GET['pt'];
			if ( $pt != 'experiences' ) {

				$wpdb->update( $table_order_name, array(
					'order_status' => 10,

				), array( 'id' => oid ), array(
					'%d',

				), array( '%d' ) );
				$or_id     = oid;
				$hoster_id = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );
				if ( $hoster_id['discount_price'] != 0 ) {
					$hoster_id['price'] = $hoster_id['discount_price'];
				}
				$hp         = get_option( 'hoster_percent' );
				$old_wallet = get_user_meta( $hoster_id['author_id'], 'jayto-wallet', true );
				$new_wallet = $old_wallet + ( $hoster_id['price'] * $hp ) / 100;
				update_user_meta( $hoster_id['author_id'], 'jayto-wallet', $new_wallet );

				$wpdb->update( $table_order_name, array(
					'host_share' => ( ( $hoster_id['price'] ) * $hp ) / 100,
				), array( 'id' => $or_id ), array(
					'%d',

				), array( '%d' ) );
				if ( $_GET['pt'] == 'hotel' ) {
					$tour_post   = get_post( $hoster_id['hot_id'] );
					$tour_name   = $tour_post->post_title;
					$guest_info  = get_user_by( 'id', $order_table['user_id'] );
					$host_info   = get_user_by( 'id', $order_table['author_id'] );
					$gust_mobile = $guest_info->user_login;
					$host_mobile = $host_info->user_login;
					$tour_date   = $hoster_id['check_in'];
					$smstrta     = ' ' . $tour_name . ';' . $tour_date . ' ';
					if ( sms_hotel_reserve_to_admin ) {
						send_sms_func( $smstrta, sms_hotel_reserve_to_admin, modir_phone );
					}
					if ( sms_hotel_reserve_to_admin ) {
						send_sms_func( $smstrta, sms_hotel_reserve_to_host, $host_mobile );
					}

					if ( sms_hotel_reserve_to_guest ) {
						send_sms_func( $smstrta, sms_hotel_reserve_to_guest, $gust_mobile );
					}


				} else {
					$tour_post   = get_post( $hoster_id['res_id'] );
					$tour_name   = $tour_post->post_title;
					$guest_info  = get_user_by( 'id', $hoster_id['user_id'] );
					$host_info   = get_user_by( 'id', $hoster_id['author_id'] );
					$gust_mobile = $guest_info->user_login;
					$host_mobile = $host_info->user_login;
					$tour_date   = $hoster_id['check_in'];

					$smstrta = ' ' . $tour_name . ';' . $tour_date . ' ';
					if ( sms_host_reserve_to_admin ) {
						send_sms_func( $smstrta, sms_host_reserve_to_admin, modir_phone );
					}
					if ( sms_host_reserve_to_host ) {
						send_sms_func( $smstrta, sms_host_reserve_to_host, $host_mobile );
					}
					if ( sms_host_reserve_to_Guest ) {
						send_sms_func( $smstrta, sms_host_reserve_to_Guest, $gust_mobile );
					}


				}

			} elseif ( $pt == 'experiences' ) {
				$wpdb->update( $table_order_name, array(
					'order_status' => 3,

				), array( 'id' => $order_table['orderid'] ), array(
					'%d',

				), array( '%d' ) );
				$or_id     = oid;
				$hoster_id = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );

				$hp         = get_option( 'hoster_percent' );
				$author_id  = get_post_field( 'post_author', $hoster_id['tour_id'] );
				$old_wallet = get_user_meta( $author_id, 'jayto-wallet', true );
				$new_wallet = $old_wallet + ( $order_table['amount'] * $hp ) / 100;
				update_user_meta( $author_id, 'jayto-wallet', $new_wallet );
				$wpdb->update( $table_order_name, array(
					'host_share' => ( ( $order_table['amount'] ) * $hp ) / 100,
				), array( 'id' => $or_id ), array(
					'%d',

				), array( '%d' ) );
				$tour_post    = get_post( $hoster_id['tour_id'] );
				$tour_name    = $tour_post->post_title;
				$tour_aouthor = get_post_field( 'post_author', $hoster_id['tour_id'] );
				$guest_info   = get_user_by( 'id', $hoster_id['user_id'] );
				$host_info    = get_user_by( 'id', $tour_aouthor );

				$gust_mobile = $guest_info->user_login;
				$host_mobile = $host_info->user_login;
				$tour_date   = $hoster_id['tour_date'];
				$smstrta     = ' ' . $tour_name . ';' . $tour_date . ' ';
				if ( sms_tour_reserve_to_admin ) {
					send_sms_func( $smstrta, sms_tour_reserve_to_admin, modir_phone );
				}
				if ( sms_tour_reserve_to_host ) {
					send_sms_func( $smstrta, sms_tour_reserve_to_host, $host_mobile );
				}
				if ( sms_tour_reserve_to_guest ) {
					send_sms_func( $smstrta, sms_tour_reserve_to_guest, $gust_mobile );
				}


			}
			$old_sans                                            = get_post_meta( $hoster_id['tour_id'], 'tour_sans', true );
			$date_key                                            = $hoster_id['tour_date'];
			$sans_key                                            = $hoster_id['sans'];
			$old_reserve                                         = $old_sans[ $date_key ][ $sans_key ]['reserve'];
			$old_sans[ $date_key ][ $sans_key ]['reserve']       = $old_reserve + $hoster_id['pepole_number'];
			$old_sans[ $date_key ][ $sans_key ]['reserve_ids'][] = $hoster_id['user_id'];
			update_post_meta( $hoster_id['tour_id'], 'tour_sans', $old_sans );

			$url = home_url() . '/experiences/';

			?>
            <div class="pay_err_box">
                <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
                <span>پرداخت شما با موفقیت انجام شد.</span>
                <span>شناسه درخواست بانکی : <?php echo refrence ?></span>
                <span>مبلغ تراکنش : <?php echo number_format( amount/10 ) ?>&nbsp;تومان</span>

                <div class="peb_link">
                    <a href="<?php echo $url ?>">رفتن به تجربه های من</a>
                    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
                </div>
            </div>


			<?php
		} else {
			$url = home_url() . '/trips/';

			?>


            <div class="pay_err_box">
                <img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
                <span>پرداخت شما با موفقیت انجام شد.</span>
                <span>شناسه درخواست بانکی : <?php echo refrence ?></span>
                <span>مبلغ تراکنش : <?php echo number_format( amount/10 ) ?>&nbsp;تومان</span>

                <div class="peb_link">
                    <a href="<?php echo $url ?>">رفتن به سفرهای من</a>
                    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
                </div>
            </div>

			<?php
		}
	} else {
		//-- در درخواست واریز وجه مشکل به وجود آمد. درخواست بازگشت وجه داده شود.

		echo 'Error : ' . $result;

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
get_footer( 'empty' );