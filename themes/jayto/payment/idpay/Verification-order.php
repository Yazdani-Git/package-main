<?php
require_once( dirname(__DIR__, 5). '/wp-load.php' );
$url = home_url() . '/wallet/';
get_header( 'empty' );

$order_id    = '';
$pass_name   = '';
$pass_famili = '';
$pass_phone  = '';
if ( isset( $_POST[ 'dataoi' ] ) ) {
    $order_id = $_POST[ 'dataoi' ];
}
if ( isset( $_POST[ 'psi_name' ] ) ) {
    $pass_name = $_POST[ 'psi_name' ];
}
if ( isset( $_POST[ 'psi_lastname' ] ) ) {
    $pass_famili = $_POST[ 'psi_lastname' ];
}
if ( isset( $_POST[ 'psi_phone' ] ) ) {
    $pass_phone = $_POST[ 'psi_phone' ];
}
$bank_rinfo = get_option( 'bareqinf' );
$am         = $_POST[ 'up_wallet_amount' ];
define( 'URL_CALLBACK', 'http://idpay-payment.local/callback.php' );
define( 'URL_PAYMENT', 'https://api.idpay.ir/v1.1/payment' );
define( 'URL_INQUIRY', 'https://api.idpay.ir/v1.1/payment/inquiry' );
define( 'URL_VERIFY', 'https://api.idpay.ir/v1.1/payment/verify' );
define( 'APIKEY', $bank_rinfo[ 'merchent_id' ] );
define( 'SANDBOX', 0 );

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'POST' ) {
    $response = $_POST;
}

if ( $_SERVER[ 'REQUEST_METHOD' ] === 'GET' ) {
    $response = $_GET;
}

if ( empty( $response[ 'status' ] ) ||
empty( $response[ 'id' ] ) ||
empty( $response[ 'track_id' ] ) ||
empty( $response[ 'order_id' ] ) ) {

    return false;
}

if ( $response[ 'status' ] != 10 ) {

    ?>
    <div class = 'pay_err_box'>
    <span>خطایی در تراکنش رخ داده است.کد خطا<?php echo $response[ 'status' ]  ?></span>

    <div class = 'peb_link'>

    <a href = '<?php echo home_url(); ?>'>بازگشت به صفحه اصلی</a>
    </div>
    </div>

    <?php

}

// if $response[ 'id' ] was not in the database return FALSE

$inquiry = idpay_payment_get_inquiry( $response );

if ( $inquiry ) {
    $verify = idpay_payment_verify( $response );
}

/**
* @param array $response
*
* @return bool
*/

function idpay_payment_get_inquiry( $response ) {

    $header = array(
        'Content-Type: application/json',
        'X-API-KEY:' . APIKEY,
        'X-SANDBOX:' . SANDBOX,
    );

    $params = array(
        'id'       => $response[ 'id' ],
        'order_id' => $response[ 'order_id' ],
    );

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, URL_INQUIRY );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    $result = curl_exec( $ch );
    curl_close( $ch );

    $result = json_decode( $result );

    if ( empty( $result ) ||
    empty( $result->status ) ) {

        print 'Exception message:';
        print '<pre>';
        print_r( $result );
        print '</pre>';

        return false;
    }

    if ( $result->status == 10 ) {

        return true;

    }

    return false;
}

/**
* @param array $response
*
* @return bool
*/

function idpay_payment_verify( $response ) {

    $header = array(
        'Content-Type: application/json',
        'X-API-KEY:' . APIKEY,
        'X-SANDBOX:' . SANDBOX,
    );

    $params = array(
        'id'       => $response[ 'id' ],
        'order_id' => $response[ 'order_id' ],
    );

    $ch = curl_init();
    curl_setopt( $ch, CURLOPT_URL, URL_VERIFY );
    curl_setopt( $ch, CURLOPT_HTTPHEADER, $header );
    curl_setopt( $ch, CURLOPT_POSTFIELDS, json_encode( $params ) );
    curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );

    $result = curl_exec( $ch );
    curl_close( $ch );

    $result = json_decode( $result );

    if ( empty( $result ) ||
    empty( $result->status ) ) {

        //		print 'Exception message:';
        //		print '<pre>';
        //		print_r( $result );
        //		print '</pre>';
        //
        //		return false;
    }
    if ( $result->status == 100 ) {
        global $wpdb;

        $table_name       = $wpdb->prefix . 'jayto_transaction';
        $table_order_name = $wpdb->prefix . 'jayto_orders';
        if ( isset( $_GET[ 'pt' ] ) ) {
            if ( $_GET[ 'pt' ] == 'hotel' ) {
                $table_order_name = $wpdb->prefix . 'jayto_hotel_orders';

            }
        }
        if ( isset( $_GET[ 'pt' ] ) ) {
            if ( $_GET[ 'pt' ] == 'experiences' ) {
                $table_order_name = $wpdb->prefix . 'tour_reserve_request';
            }
        }

        $check_pay = $wpdb->get_row(
            $wpdb->prepare(
                "SELECT * FROM {$table_name} WHERE Authority = %s",
                $result->id
            )
        );
        if ( $check_pay->pay_status == 0 ) {
            $wpdb->update( $table_name, array(
                'refid'            => $result->track_id,
                'pay_status'       => 1,
                'transaction_desc' => 'واریز بابت رزرو',
            ), array( 'Authority' => $result->id ), array(

                '%d',
                '%d',
                '%s',
            ), array( '%s' ) );
            $order_table = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE Authority = '{$result->id}'", ARRAY_A );
            $pt          = $_GET[ 'pt' ];
            if ( $pt != 'experiences' ) {

                $wpdb->update( $table_order_name, array(
                    'order_status' => 10,

                ), array( 'id' => $order_table[ 'orderid' ] ), array(
                    '%d',

                ), array( '%d' ) );
                $or_id      = $order_table[ 'orderid' ];
                $hoster_id  = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );
                $hp         = get_option( 'hoster_percent' );
                $old_wallet = get_user_meta( $hoster_id[ 'author_id' ], 'jayto-wallet', true );
                $new_wallet = $old_wallet + ( $order_table[ 'amount' ] * $hp ) / 100;
                update_user_meta( $hoster_id[ 'author_id' ], 'jayto-wallet', $new_wallet );

                $wpdb->update( $table_order_name, array(
                    'host_share' => ( ( $order_table[ 'amount' ] ) * $hp ) / 100,
                ), array( 'id' => $or_id ), array(
                    '%d',

                ), array( '%d' ) );

                if ( $_GET[ 'pt' ] == 'hotel' ) {
                    $tour_post   = get_post( $hoster_id[ 'hot_id' ] );
                    $tour_name   = $tour_post->post_title;
                    $guest_info  = get_user_by( 'id', $order_table[ 'user_id' ] );
                    $host_info   = get_user_by( 'id', $order_table[ 'author_id' ] );
                    $gust_mobile = $guest_info->user_login;
                    $host_mobile = $host_info->user_login;
                    $tour_date   = $hoster_id[ 'check_in' ];
                    $smstrta     = ' '.$tour_name.';'.$tour_date.' ';
                    if (sms_hotel_reserve_to_admin){
	                    send_sms_func( $smstrta, sms_hotel_reserve_to_admin, modir_phone );
                    }
                    if (sms_hotel_reserve_to_host){
	                    send_sms_func( $smstrta, sms_hotel_reserve_to_host, $host_mobile );
                    }
                    if (sms_hotel_reserve_to_host){
	                    send_sms_func( $smstrta, sms_hotel_reserve_to_guest, $gust_mobile );
                    }



                } else {
                    $tour_post   = get_post( $hoster_id[ 'res_id' ] );
                    $tour_name   = $tour_post->post_title;
                    $guest_info  = get_user_by( 'id', $hoster_id[ 'user_id' ] );
                    $host_info   = get_user_by( 'id', $hoster_id[ 'author_id' ] );
                    $gust_mobile = $guest_info->user_login;
                    $host_mobile = $host_info->user_login;
                    $tour_date   = $hoster_id[ 'check_in' ];

                    $smstrta     = ' '.$tour_name.';'.$tour_date.' ';
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

                ), array( 'id' => $order_table[ 'orderid' ] ), array(
                    '%d',

                ), array( '%d' ) );
                $or_id     = $order_table[ 'orderid' ];
                $hoster_id = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );

                $hp         = get_option( 'hoster_percent' );
                $author_id  = get_post_field( 'post_author', $hoster_id[ 'tour_id' ] );
                $old_wallet = get_user_meta( $author_id, 'jayto-wallet', true );
                $new_wallet = $old_wallet + ( $order_table[ 'amount' ] * $hp ) / 100;
                update_user_meta( $author_id, 'jayto-wallet', $new_wallet );
                $wpdb->update( $table_order_name, array(
                    'host_share' => ( ( $order_table[ 'amount' ] ) * $hp ) / 100,
                ), array( 'id' => $or_id ), array(
                    '%d',

                ), array( '%d' ) );
                $tour_post   = get_post( $hoster_id[ 'tour_id' ] );
                $tour_name   = $tour_post->post_title;
                $tour_aouthor = get_post_field( 'post_author', $hoster_id[ 'tour_id' ] );
                $guest_info  = get_user_by( 'id', $hoster_id[ 'user_id' ] );
                $host_info   = get_user_by( 'id', $tour_aouthor );

                $gust_mobile = $guest_info->user_login;
                $host_mobile = $host_info->user_login;
                $tour_date   = $hoster_id[ 'tour_date' ];
                $smstrta     = ' '.$tour_name.';'.$tour_date.' ';
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
            $old_sans                                            = get_post_meta( $hoster_id[ 'tour_id' ], 'tour_sans', true );
            $date_key                                            = $hoster_id[ 'tour_date' ];
            $sans_key                                            = $hoster_id[ 'sans' ];
            $old_reserve                                         = $old_sans[ $date_key ][ $sans_key ][ 'reserve' ];
            $old_sans[ $date_key ][ $sans_key ][ 'reserve' ]       = $old_reserve + $hoster_id[ 'pepole_number' ];
            $old_sans[ $date_key ][ $sans_key ][ 'reserve_ids' ][] = $hoster_id[ 'user_id' ];
            update_post_meta( $hoster_id[ 'tour_id' ], 'tour_sans', $old_sans );

            $url = home_url() . '/experiences/';

            ?>
            <div class = 'pay_err_box'>
            <img src = '<?php echo get_template_directory_uri() ?>/images/ok-icon.png' alt = ''>
            <span>پرداخت شما با موفقیت انجام شد.</span>
            <span>شناسه درخواست بانکی : <?php echo $result->track_id ?></span>
            <span>مبلغ تراکنش : <?php echo number_format( $result->amount ) ?>&nbsp;
            تومان</span>

            <div class = 'peb_link'>
            <a href = "<?php echo $url ?>">رفتن به تجربه های من</a>
            <a href = '<?php echo home_url(); ?>'>بازگشت به صفحه اصلی</a>
            </div>
            </div>

            <?php
        } else {
            $url = home_url() . '/trips/';
            ?>
            <div class = 'pay_err_box'>

            <span>این تراکنش قبلا انجام شده.</span>

            <div class = 'peb_link'>
            <a href = "<?php echo $url ?>">رفتن به سفرهای من</a>
            <a href = '<?php echo home_url(); ?>'>بازگشت به صفحه اصلی</a>
            </div>
            </div>
            <?php }

        }
    }

    /**
    * @param int $status
    *
    * @return string
    */

    function idpay_payment_get_message( $status ) {

        switch ( $status ) {
            case 1:
            return 'پرداخت انجام نشده است';

            case 2:
            return 'پرداخت ناموفق بوده است';

            case 3:
            return 'خطا رخ داده است';

            case 10:
            return 'در انتظار تایید پرداخت';

            case 100:
            return 'پرداخت تایید شده است';

            case 101:
            return 'پرداخت قبلاً تایید شده است';

            default:
            return 'خطایی در تراکنش رخ داده است.';
        }
    }