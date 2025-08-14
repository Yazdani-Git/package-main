<?php

require_once( dirname( __DIR__, 5 ) . '/wp-load.php' );
$url = home_url() . '/wallet/';

get_header( 'empty' );
$order_id    = '';
$pass_name   = '';
$pass_famili = '';
$pass_phone  = '';
if ( isset( $_POST[ 'dataoi' ] ) ) {
    $order_id = $_POST[ 'dataoi' ];
}
$bank_rinfo = get_option( 'bareqinf' );
define( 'APIKEY', $bank_rinfo[ 'merchent_id' ] );
define( 'TerminalId', $bank_rinfo[ 'terminal_id' ] );
define( 'TerminalKey', $bank_rinfo[ 'terminal_kye' ] );
$key        = TerminalKey;

$OrderId = $_POST[ 'OrderId' ];
$Token   = $_POST[ 'Token' ];
$ResCode = $_POST[ 'ResCode' ];

function openssl_encrypt_pkcs7( $key, $data ) {
    $encData = openssl_encrypt( $data, 'des-ede3', $key, 0 );

    return $encData;
}

function sadad_encrypt( $data, $key ) {
    $key = base64_decode( $key );
    if ( function_exists( 'openssl_encrypt' ) ) {
        return openssl_encrypt_pkcs7( $key, $data );
    } elseif ( function_exists( 'mcrypt_encrypt' ) ) {
        return mcrypt_encrypt_pkcs7( $data, $key );
    } else {
        require_once 'triple.php';
        $cipher = new triple();

        return $cipher->letsEncrypt( $key, $data );
    }

}

if ( ! function_exists( 'curl_webservice' ) ) {
    function curl_webservice( $url, $data = false ) {
        $curl = curl_init( $url );
        curl_setopt( $curl, CURLOPT_CUSTOMREQUEST, 'POST' );
        curl_setopt( $curl, CURLOPT_POSTFIELDS, $data );
        curl_setopt( $curl, CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $curl, CURLOPT_HTTPHEADER, array( 'Content-Type: application/json', 'Content-Length: ' . strlen( $data ) ) );
        $result = curl_exec( $curl );
        curl_close( $curl );

        return $result;
    }
}

if ( $ResCode == 0 ) {

    $verifyData = array( 'Token' => $Token, 'SignData' => openssl_encrypt_pkcs7( $Token, $key ) );
    $str_data   = json_encode( $verifyData );
    $res        = curl_webservice( 'https://sadad.shaparak.ir/VPG/api/v0/Advice/Verify', $str_data );
    $arrres     = json_decode( $res );
}

if ( $arrres->ResCode != - 1 && $ResCode == 0 ) {

    $table_name = $wpdb->prefix . 'jayto_transaction';
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
            "SELECT * FROM {$table_name} WHERE refid = %s", $Token
        )
    );
    if ( $check_pay->pay_status == 0 ) {
        ?>
        <div class = 'pay_err_box'>
        <img src = '<?php echo get_template_directory_uri() ?>/images/ok-icon.png' alt = ''>
        <span>پرداخت شما با موفقیت انجام شد.</span>
        <span>شناسه درخواست بانکی : <?php echo $arrres->SystemTraceNo ?></span>
        <span>مبلغ تراکنش : <?php echo number_format( $check_pay->amount ) ?>&nbsp;
        تومان</span>

        <div class = 'peb_link'>
        <a href = "<?php echo $url ?>">رفتن به تجربه های من</a>
        <a href = '<?php echo home_url(); ?>'>بازگشت به صفحه اصلی</a>
        </div>
        </div>

        <?php
        $wpdb->update( $table_name, array(
            'pay_status'       => 1,
            'transaction_desc' => 'واریز بابت رزرو',
        ), array( 'refid' => $Token ), array(
            '%d',
            '%s',
        ), array( '%s' ) );
	    $order_table = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE refid = '{$Token}'", ARRAY_A );
        $pt = $_GET[ 'pt' ];
        if ( $pt != 'experiences' ) {

            $wpdb->update( $table_order_name, array(
                'order_status' => 10,

            ), array( 'id' => $order_table[ 'orderid' ] ), array(
                '%d',

            ), array( '%d' ) );
            $or_id     = $order_table[ 'orderid' ];
            $hoster_id = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );

            if ( $hoster_id[ 'discount_price' ] != 0 ) {
                $hoster_id[ 'price' ] = $hoster_id[ 'discount_price' ];
            }

            $hp = get_option( 'hoster_percent' );

            $old_wallet = get_user_meta( $hoster_id[ 'author_id' ], 'jayto-wallet', true );
            $new_wallet = $old_wallet + ( $hoster_id[ 'price' ] * $hp ) / 100;
            update_user_meta( $hoster_id[ 'author_id' ], 'jayto-wallet', $new_wallet );
            $wpdb->update( $table_order_name, array(
                'host_share' => ( ( $hoster_id[ 'price' ] * $hp ) ) / 100,
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
                $smstrta     = ' ' . $tour_name . ';' . $tour_date . ' ';
                if ( sms_hotel_reserve_to_admin ) {
                    send_sms_func( $smstrta, sms_hotel_reserve_to_admin, modir_phone );
                }
                if ( sms_hotel_reserve_to_host ) {
                    send_sms_func( $smstrta, sms_hotel_reserve_to_host, $host_mobile );
                }
                if ( sms_hotel_reserve_to_guest ) {
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
                $txt     = ' ' . $tour_name . ';' . $tour_date . ' ';

                if ( sms_host_reserve_to_admin ) {
                    send_sms_func($txt, sms_host_reserve_to_admin, modir_phone );
                }
                if ( sms_host_reserve_to_host ) {
                    send_sms_func( $txt, sms_host_reserve_to_host, $host_mobile );
                }
                if ( sms_host_reserve_to_Guest ) {
                    send_sms_func( $txt, sms_host_reserve_to_Guest, $gust_mobile );
                }

            }
        } elseif ( $pt == 'experiences' ) {
            $wpdb->update( $table_order_name, array(
                'order_status' => 3,

            ), array( 'id' => $order_table[ 'orderid' ] ), array(
                '%d' ), array( '%d' ) );
                $or_id     = $order_table[ 'orderid' ];
                $hoster_id = $wpdb->get_row( "SELECT * FROM {$table_order_name} WHERE id = '{$or_id }'", ARRAY_A );

                $hp         = get_option( 'hoster_percent' );
                $author_id  = get_post_field( 'post_author', $hoster_id[ 'tour_id' ] );
                $old_wallet = get_user_meta( $author_id, 'jayto-wallet', true );
                $new_wallet = $old_wallet + ( $order_table[ 'price' ] * $hp ) / 100;
                update_user_meta( $author_id, 'jayto-wallet', $new_wallet );
                $wpdb->update( $table_order_name, array(
                    'host_share' => ( ( $order_table[ 'price' ] ) * $hp ) / 100,
                ), array( 'id' => $or_id ), array(
                    '%d',

                ), array( '%d' ) );
                $tour_post    = get_post( $hoster_id[ 'tour_id' ] );
                $tour_name    = $tour_post->post_title;
                $tour_aouthor = get_post_field( 'post_author', $hoster_id[ 'tour_id' ] );
                $guest_info   = get_user_by( 'id', $hoster_id[ 'user_id' ] );
                $host_info    = get_user_by( 'id', $tour_aouthor );

                $gust_mobile = $guest_info->user_login;
                $host_mobile = $host_info->user_login;
                $tour_date   = $hoster_id[ 'tour_date' ];
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
            $old_sans                                            = get_post_meta( $hoster_id[ 'tour_id' ], 'tour_sans', true );
            $date_key                                            = $hoster_id[ 'tour_date' ];
            $sans_key                                            = $hoster_id[ 'sans' ];
            $old_reserve                                         = $old_sans[ $date_key ][ $sans_key ][ 'reserve' ];
            $old_sans[ $date_key ][ $sans_key ][ 'reserve' ]       = $old_reserve + $hoster_id[ 'pepole_number' ];
            $old_sans[ $date_key ][ $sans_key ][ 'reserve_ids' ][] = $hoster_id[ 'user_id' ];
            update_post_meta( $hoster_id[ 'tour_id' ], 'tour_sans', $old_sans );

            $url = home_url() . '/experiences/';

            ?>

            <?php } else {

                echo 'تراکنش نا موفق بود در صورت کسر مبلغ از حساب شما حداکثر پس از 72 ساعت مبلغ به حسابتان برمی گردد.';
            }
        }
        ?>