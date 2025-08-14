<?php
$oid = $_POST[ 'oid' ];
global $wpdb;
$result = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_hotel_orders WHERE  id= {$oid} ORDER BY id DESC ", object );

$hot_id = $result->hot_id;
$room_id = $result->room_id;
$hotel_rooms = get_post_meta( $hot_id, 'rooms_info', true );
$reseveed_room = get_post_meta( $hot_id, 'hotel_reserves' . $room_id, true );

$reserved_room = [];
foreach ( $hotel_rooms as $key=>$row ) {

    if ( $key == $room_id ) {
        $reserved_room = $row;
    }
}
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

    case 3:
    $order_status = 'ردشده از طرف میزبان';
    break;
    case 11:
    $order_status = 'رزرو شده (نقدی)';
    break;
    case 12:
    $order_status = 'درانتظار تایید پرداخت';
    break;

}

?>
<div class='aot_box width_100'>
    <span class='alert_box_close'><i class='dashicons dashicons-no-alt'></i></span>
    <div class='aop_rw'>
        <?php

?>
        <p>وضعیت سفارش : <?php  echo $order_status ?></p>

        <div class='admin_rw'>
            <?php
if ( $result->order_status == 1 ) {
    ?>
            <span class='request_ret' data-os='3' data-oid="<?php echo $oid ?> " data-pt='hotel'>رد</span>
            <span class='request_accp' data-os='4' data-oid="<?php echo $oid ?>" <?php if ( $result->order_status == 12 ) {
        echo 'data-os="12" ';
    }
    ?> data-pt='hotel'>تایید</span>
            <?php } elseif ( $result->order_status == 11 || $result->order_status == 12 ) {
        ?>
            <span class='cart_ret' data-oid="<?php echo $oid ?> " data-pt='hotel'>رد</span>
            <span class='cart_accp' data-oid="<?php echo $oid ?>" data-rost="<?php echo $result->order_status ?>"
                data-pt='hotel'>تایید</span>
            <?php  }
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

    <div class='aop_room_reorder'>
        <p>تغییر اتاق رزرو شده</p>
        <div class='chrs_box '>
            ( <?php  echo $reserved_room[ 'room_name' ];
            ?> )
            <span>تغییر کند به :</span>
            <select name='change_res_room' id='change_res_room'>
                <?php
            foreach ( $hotel_rooms as $key=>$room ) {
                ?>
                <option value="<?php echo $key ?>"><?php echo $room[ 'room_name' ] ?></option>
                <?php  }

                ?>

            </select>
            <span class='chrr_btn' data-oid="<?php echo $oid ?>">اعمال تغییر</span>
        </div>
    </div>

</div>