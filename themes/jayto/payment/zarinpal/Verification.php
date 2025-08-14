<?php
require_once( dirname( __DIR__, 5 ). '/wp-load.php' );
$url = home_url() . '/wallet/';
get_header( 'empty' );

$Authority = $_GET[ 'Authority' ];
$user_id   = get_current_user_id();
$bank_rinfo = get_option( 'bareqinf' );
global $wpdb;
$results_table = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_transaction WHERE  Authority = '{$Authority}'  ", ARRAY_A );
$data          = array( 'merchant_id' => $bank_rinfo[ 'merchent_id' ], 'authority' => $Authority, 'amount' => $results_table[ 'amount' ] );
$jsonData      = json_encode( $data );
$ch            = curl_init( 'https://api.zarinpal.com/pg/v4/payment/verify.json' );
curl_setopt( $ch, CURLOPT_USERAGENT, 'ZarinPal Rest Api v4' );
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $jsonData );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json',
    'Content-Length: ' . strlen( $jsonData )
) );

$result = curl_exec( $ch );
curl_close( $ch );
$result = json_decode( $result, true );

if ( $err ) {
    echo 'cURL Error #:' . $err;
} else {
    if ( $result[ 'data' ][ 'code' ] == 100 ) {
        global $wpdb;

        $table_name = $wpdb->prefix . 'jayto_transaction';
        $wpdb->update( $table_name, array(
            'refid'            => $result[ 'data' ][ 'ref_id' ],
            'pay_status'       => 1,
            'transaction_desc' => 'افزایش اعتبار کیف پول',
        ), array( 'Authority' => $Authority ), array(
            '%d',
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

        ?>
        <div class = 'pay_err_box'>
        <img src = '<?php echo get_template_directory_uri() ?>/images/ok-icon.png' alt = ''>
        <span>کیف پول شما به مبلغ کیف پول شما با به مقدار <?php echo $results_table[ 'amount' ];
        ?> تومان  با موفقیت شارژ شد.</span>
        <span>شماره پیگیری تراکنش <?php  echo $result[ 'data' ][ 'ref_id' ]?></span>

        <div class = 'peb_link'>
        <a href = "<?php echo $url ?>">بازگشت به کیف پول.</a>
        </div>
        </div>

        <?php

    } else {

        ?>


        <div class = 'pay_err_box'>
        <span>خطایی در تراکنش رخ داده است.کد خطا<?php echo $result[ 'errors' ][ 'message' ] ?></span>

        <div class = 'peb_link'>

        <a href = '<?php echo home_url(); ?>'>بازگشت به صفحه اصلی</a>
        </div>
        </div>
        <?php
    }
}

?>
<script defer src = 'https://use.fontawesome.com/releases/v5.0.8/js/solid.js' integrity = 'sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l' crossorigin = 'anonymous'></script>
<script defer src = 'https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js' integrity = 'sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c' crossorigin = 'anonymous'></script>

<style>
body, html {
    font-family: IRANYekan;
}

.profile_button.active > .profile_drop {
    opacity: 1;
    visibility: visible;
    transform: scaley( 1 );
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
    box-shadow: 0 0 15px 4px rgb( 0 0 0 / 10% );
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
    box-shadow: 0 0 18px 3px rgb( 0 0 0 / 10% );
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
    box-shadow: 0 0 18px 3px rgb( 0 0 0 / 10% );
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