<?php
$oid = $_POST[ 'oid' ];
global $wpdb;
$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_orders WHERE  id= {$oid} ORDER BY id DESC ", object );
$hot_id = $result->res_id;

switch ( $result->order_status ) {

    case  1:
    $order_status = 'در انتظار تایید';
    break;
    case  10:
    $order_status = 'پرداخت شده';
    break;
    case 5:
    $order_status = 'لغو شده سیستمی';
    break;
    case 4:
    $order_status = 'درانتظار پرداخت';
    break;
    case 2:
    $order_status = 'تایید شده';
    break;
    case 3:
    $order_status = 'ردشده از طرف میزبان';
    break;
    case 6:
    $order_status = 'لغوشده';
    break;
    case 7:
    $order_status = 'رهاشده';
    break;
    case 11:
    $order_status = 'رزرو شده (نقدی)';
    break;
    case 12:
    $order_status = 'در انتظار تایید پرداخت';
    break;

}
?>
<div class='aot_box width_100'>
    <span class='alert_box_close'><i class='dashicons dashicons-no-alt'></i></span>
    <?php
if ( $result ) {
    $wallet = get_user_meta( '1', 'jayto-wallet', true );
    $orst = intval( $result->order_status );
    $ost_data = 0;
    if ( $orst == 1 ) {
        $ost_data = 1;
    } elseif ( $orst == 12 ) {
        $ost_data = 12;
    }
    ?>
    <div class='aop_rw'>
        <p>وضعیت سفارش : <?php  echo $order_status ?></p>
        <?php

    ?>
        <div class='admin_rw'>
            <?php

    if ( $result->order_status == 1 ) {
        ?>
            <span class='request_ret' data-oid="<?php echo $oid ?> " data-os='3' data-pt='res'>رد</span>
            <span class='request_accp' data-oid="<?php echo $oid ?>" data-os='4' data-rost="<?php echo $ost_data ?>"
                data-pt='res'>تایید</span>
            <?php } elseif ( $result->order_status == 11 || $result->order_status == 12 ) {
            ?>

            <span class='cart_ret' data-oid="<?php echo $oid ?> " data-pt='res'>رد</span>
            <span class='cart_accp' data-oid="<?php echo $oid ?>" data-rost="<?php echo $ost_data ?>"
                data-pt='res'>تایید</span>
            <?php	}
            ?>
        </div>

    </div>
    <hr>
    <?php
            if ( $result->cart_img || $result->cart_digit ) {
                ?>
    <div class='admrw_rec_box'>
        <span>4 رقم آخر شماره کارت :<?php  echo $result->cart_digit?></span>
        <a target='_blank' href="<?php  echo $result->cart_img?>">
            <img src="<?php  echo $result->cart_img?>">
        </a>
    </div>
    <?php  }
                ?>

    <?php  } else {
                    ?>
    <div class='aop_rw'>
        <p>وضعیت سفارش : <?php  echo $order_status ?></p>
        <div class='admin_rw'>
            <span class='adm_ret' data-oid="<?php echo $oid ?>" data-pt='res'>رد</span>
            <span class='adm_accp' data-oid="<?php echo $oid ?>" data-pt='res'>تایید</span>
        </div>
    </div>
    <?php }

                    ?>

</div>