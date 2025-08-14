<?php
// print_r($result);
$res = get_post($result->hot_id);
 $res_miz_info = get_user_meta($res->post_author);
 $res_mih_info = get_user_meta( $result->user_id );
$hotel_room_info = get_post_meta( $result->hot_id, 'rooms_info', true );
$res_meta = get_post_meta( $result->hot_id, '_all_res_meta', false );
$pay_order = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_transaction WHERE  orderid= {$result->id} ORDER BY id DESC ", object );
$status = '';
if ($pay_order->passenger_name){
	$passenger_name = $pay_order->passenger_name;
}else{
	$passenger_name = $res_mih_info['first_name'][0];

}
if ($pay_order->passenger_famili){
	$passenger_famili = $pay_order->passenger_famili;
}else{
	$passenger_famili =  $res_mih_info['last_name'][0];;

}
if ($pay_order->passenger_phone){
	$passenger_phone = $pay_order->passenger_phone;
}else{
	$passenger_phone = $res_mih_info['nickname'][0];
}

switch ($result->order_status) {

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
		$order_status = 'پرداخت نقدی';
		break;
}

?>
<div class="osc_mih ">
	<span class="alert_box_close"><i class="dashicons dashicons-no-alt"></i></span>
	<div>
		<p>میزبان : <span><?php  echo $res_miz_info['first_name'][0] ?></span></p>
		<p>   <span>اقامتگاه : <?php echo $res->post_title ?> ( <?php  echo $hotel_room_info[$result->room_id]['room_name']; ?> ) </span></p>
		<span>آدرس اقامتگاه : <?php echo $res_meta[0]['res_address']?></span>&nbsp;&nbsp;&nbsp;
		<span>تلفن میزبان : <?php  echo $res_miz_info['nickname'][0] ?></span>
	</div>
	<span class="line_dash_90"></span>
	<div>
        <p>مهمان : <span><?php  echo $passenger_name ?></span>-<span><?php  echo $passenger_famili ?></span></p>
        <span class="margin_lr20">تلفن مهمان : <?php  echo $passenger_phone ?> </span>

	</div>
	<span class="line_dash_90"></span>
	<div>
        <?php
      $adult = $result->adult_number;
      $child = $result->child_number;
     $pass_num =$adult + $child;
        ?>
		<p>مشخصات رزرو</p>
		<span class="margin_lr20">تاریخ ورود : <?php echo $result->check_in ?></span>&nbsp;<span class="margin_lr20">تاریخ خروج : <?php echo $result-> check_out ?></span>&nbsp;<span>تعداد نفرات: <?php  echo $pass_num ?>&nbsp;نفر</span>
		<p>

            <span>مبلغ سفارش: <?php
                if ($result->discount_price){
                   echo $result->discount_price;
                }else{
	                echo $result->price;
                }

                ?></span>&nbsp;   <span class="margin_lr20"> وضعیت سفارش : <?php  echo $order_status ?></span>

        </p>

	</div>
</div>
