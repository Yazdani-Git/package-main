<?php
//print_r($result);
$res = get_post($result->tour_id);
$res_miz_info = get_user_meta($res->post_author);
$res_mih_info = get_user_meta($result->user_id);
$res_meta = get_post_meta( $result->tour_id, 'all_tour_meta', false );

$status = '';

switch ($result->order_status) {
	case 0:
		$status = 'ثبت درخواست';
		break;
	case 1:
		$status = 'در انتظار تایید';
		break;
	case 2:
		$status = 'درانتظار پرداخت';
		break;
	case 3:
		$status = 'پرداخت شده';
		break;
	case 4:
		$status = 'لغوشده';
		break;


}
?>
<div class="osc_mih ">

	<span class="alert_box_close"><i class="dashicons dashicons-no-alt"></i></span>
	<div>
		<p>میزبان : <span><?php  echo $res_miz_info['first_name'][0] ?></span></p>
		<p>   <span>تور : <?php echo $res->post_title ?></span></p>
		<span>آدرس  : <?php echo $res_meta[0]['tour_place_opt']?></span>&nbsp;&nbsp;&nbsp;
        <?php
        if ($eghamat->title){ ?>
            <p><span>اقامت در  : <?php echo $eghamat->title?></span>&nbsp;&nbsp;&nbsp;</p>
      <?php  }
        ?>
		<span>تلفن میزبان : <?php  echo $res_miz_info['user_mobile'][0] ?></span>
	</div>
	<span class="line_dash_90"></span>
	<div>
		<p>مهمان : <span><?php  echo $res_mih_info['first_name'][0] ?></span></p>
		<span class="margin_lr20">تلفن مهمان : <?php  echo $res_mih_info['user_mobile'][0] ?></span>

	</div>
	<span class="line_dash_90"></span>
	<div>
		<p>مشخصات رزرو</p>
		<span class="margin_lr20">تاریخ  رزرو : <?php echo $result->tour_date ?>  سانس :<?php echo $result->sans ?></span>&nbsp;<span class="margin_lr20">تاریخ خروج : <?php echo $result-> check_out ?></span>&nbsp;<span>تعداد نفرات: <?php  echo $result->pepole_number?>&nbsp;نفر</span>
		<p>   <span>مبلغ سفارش: <?php echo number_format($result->price) ?> تومان </span>&nbsp;   <span class="margin_lr20"> وضعیت سفارش : <?php  echo $status?></span> </p>

	</div>
</div>
