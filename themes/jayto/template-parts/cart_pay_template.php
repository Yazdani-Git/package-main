<?php
/* Template Name:cartTemplate */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
ob_start();
get_header('single');
 $oid = $_POST['dataoi'];
$post_type = 'residance';
if (isset($_GET['pt'] ) && $_GET['pt'] == 'hotel'){
	$post_type = 'hotel';
}
if (isset($_POST['fname'])){
	$fname = $_POST['fname'];
	$lname = $_POST['lname'];
	$phone = $_POST['phone'];
}else{
	$fname = '';
	$lname = '';
	$phone = '';
}
update_order_pay_type($oid,$post_type,'cart',4);
$cart_number =get_option( 'cart_number' );
$order = get_order_by_id($oid);

//if ($post_type == 'residance'){
//	$all_res_info  = get_post_meta( $order->res_id,'_all_res_meta',true );
//	$ndate = new DateTime();
//	$now_date = $ndate->format('Y/m/d');
//	$discount_ifo = $all_res_info['discount'];
//	$in_discount = 'false';
//	$discount = 0;
//	$start_date_jalali = $discount_ifo['start_date '];
//	$end_date_jalali = $discount_ifo['end_date'];
//	$start_array = explode('/',$start_date_jalali);
//	$end_array =explode('/',$end_date_jalali);
//	$end_date = jmktime( '23' , '0' , '0' , $end_array[1] , $end_array[2] , $end_array[0] , '' , '' );;
//	$start_date =jmktime( '23' , '0' , '0' , $start_array[1] , $start_array[2] , $start_array[0] , '' , '' );
//	$start_date = date('Y/m/d',$start_date);
//	$end_date = date('Y/m/d',$end_date);
//	if ($now_date >= $start_date && $now_date <= $end_date   ){
//		$in_discount = 'true';
//	}
//    if ($in_discount == 'true'){
//        $dis_price = ($order->price * $discount_ifo['perscent_discount']) / 100;
//    global $wpdb;
//	$table_name_order  = $wpdb->prefix . 'jayto_orders';
//	$wpdb->update( $table_name_order, array(
//		'discount_price' => $dis_price,
//		'price' => $order->price - $dis_price,
//
//	), array( 'id' => $oid ), array(
//		'%d',
//		'%d',
//
//
//	), array( '%d' ) );
//}
//$price=$order->price - $dis_price;
////  echo $discount_ifo['perscent_discount'];
//
//}
if ($post_type == 'hotel'){
	$order = get_hotel_order_by_id($oid);

}
$post_title=get_the_title($order->res_id);
if ($post_type == 'hotel'){
	$post_title=get_the_title($order->hot_id);
}
$price= $order->price;
if ($order->discount_price !=0  ){
	$price = $order->discount_price;
}



?>
	<div class="cpay_box">
        <input type="hidden" name="dataoi" class="dataoi" value="<?php echo $oid ?>">
        <input type="hidden" name="pass_fname" class="pass_fname" value="<?php echo $fname ?>">
        <input type="hidden" name="pass_lname" class="pass_lname" value="<?php echo $lname ?>">
        <input type="hidden" name="pass_phone" class="pass_phone" value="<?php echo $phone ?>">
		<p class="capay_p">درخواست رزور شما برای  <?php  echo $post_title ?> تاریخ :<span class="d_inf"><?php  echo $order->check_in?></span> تا <span class="d_inf"><?php  echo $order->check_out?></span> ثبت شد.نوع پرداخت شما بصورت کارت به کارت میباشد. جهت نهایی شدن رزرو مبلغ <?php echo $price ?> تومان را به شماره کارت زیر واریز کرده و رسید آنرا در محل مورد نظر آپلود نمایید و 4رقم آخر شماره کارت خود را وارد نمایید.</p>
	<span class="capay_cn"><?php echo $cart_number ?></span>
        <div class="cpay-upload_box">
      <div class="cpay-upload_r">
          <span class="fz13">چهار شماره آخر کارت</span>
          <input type="number"  oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" maxlength="4" class="cdigit">
      </div>
            <div class="cpay-upload_l">
                <div class="up_feauture_imgage_box">
                    <input type="hidden" value="<?php  echo $oid?>" class="hoid">
                    <form class="thumbnailUpload" enctype="multipart/form-data">

                        <div class="thumbnail_form-group">

                            <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                            <input type="file" id="Receipt_upload" name="Receipt_upload" accept="image/*"/>
                            <input type="hidden" class="attach_url">
                        </div>
                    </form>
                    <div class="imageReceipt_show"></div>
                </div>


            </div>

        </div>
	<div class="Receipt_send_box">
        <span class="Receipt_send_btn" data-pt="<?php echo $post_type ?>">ارسال</span>
    </div>
	</div>

<?php
get_footer();


