<?php
/* Template Name:Send_Request */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header( 'single' );

 $res_id = $_GET['res_id'];
$post   = get_post( $res_id );
$metas  = get_post_meta( $res_id );
if (isset($_GET['tiod'])){
    $order = get_experiens_by_id($_GET['tiod']);
	$images_meta  = $postData = get_post_meta( $res_id, 'gallery_data' );
	$images       = $images_meta[0]['image_url'];
	$img_url      = wp_get_attachment_image_src( get_post_thumbnail_id( $res_id ), array( 'thumbnail' ), true );
//	$user         = wp_get_current_user();
	$user_id      = get_current_user_id();
	$oid          = '';
		require 'send_tour_confirm_temp.php';

}else{
	$all_res_info = $metas['_all_res_meta'][0];
	$all_res_info = unserialize( $all_res_info );
	$res_type     = $all_res_info['reserve_type'];
	$images_meta  = $postData = get_post_meta( $res_id, 'gallery_data' );
	$images       = $images_meta[0]['image_url'];
	$img_url      = wp_get_attachment_image_src( get_post_thumbnail_id( $res_id ), array( 'thumbnail' ), true );
	$user         = wp_get_current_user();
	$user_id      = $user->ID;
	$ndate = new DateTime();
	$now_date = $ndate->format('Y/m/d');
	$discount_ifo = $all_res_info['discount'];
	$in_discount = 'false';
	$discount = 0;

	if ($discount_ifo){
		$start_date_jalali = $discount_ifo['start_date '];
		$end_date_jalali = $discount_ifo['end_date'];
		$start_array = explode('/',$start_date_jalali);
		$end_array =explode('/',$end_date_jalali);
		$end_date = jmktime( '23' , '0' , '0' , $end_array[1] , $end_array[2] , $end_array[0] , '' , '' );;
		$start_date =jmktime( '23' , '0' , '0' , $start_array[1] , $start_array[2] , $start_array[0] , '' , '' );
		$start_date = date('Y/m/d',$start_date);
		$end_date = date('Y/m/d',$end_date);
		if ($now_date >= $start_date && $now_date <= $end_date   ){
			$in_discount = 'true';
		}
	}

	$prices       = calc_order_price( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'] );
	$pri      = calc_order_price( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'] );

	if ($in_discount == 'true'){
	 	$prices =filter_var( $prices['total_price'], FILTER_SANITIZE_NUMBER_INT );
		 $dis_price = ($prices * $discount_ifo['perscent_discount']) / 100;
         $discount = $prices-$dis_price;
	}else{
		$prices =filter_var( $prices['total_price'], FILTER_SANITIZE_NUMBER_INT );
		$discount =0;
	}
	$order_check  = order_exist_check( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'], $user_id );
	$oid          = '';
	$res_link=get_the_permalink($res_id);
if($order_check){
	$ck='ok';
}else{
	$ck='nok';
}

	if ( $res_type == 0 ) {
		$active       = 'active';
		require 'send_order_confirm_temp.php';
	} else {
		require 'send_order_need_temp.php';
		$active       = 'deactive';

	}
}

?>

<?php

get_footer();