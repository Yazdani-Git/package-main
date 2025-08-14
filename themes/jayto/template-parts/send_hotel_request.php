<?php
/* Template Name:Send Hotel Request */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header( 'single' );
$hotel_id    = $_GET['hoi'];
$post        = get_post( $hotel_id );
$metas       = get_post_meta( $hotel_id );
$metas       = get_post_meta( $hotel_id, 'all_hotel_meta', true );
$hotel_rooms = get_post_meta( $hotel_id, 'rooms_info', true );
$this_room   = $hotel_rooms[ $_GET['roid'] ];

$reserve_type = $metas['type'];
$image_thumb  = get_the_post_thumbnail( $hotel_id );
$beet_date    = get_beetween_date(change_slash_to_dash($_GET['check_in']) ,change_slash_to_dash($_GET['check_out'])  );
//$user         = wp_get_current_user();
$user_id      = get_current_user_id();
if(intval($user_id) == 0){
	exit;
}

if ( $reserve_type == 0 ) {
	$order_check = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['adult_num'], $_GET['child'], $user_id, '4' );

} elseif ( $reserve_type == 1 ) {

	$order_check = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['adult_num'], $_GET['child'], $user_id, '1' );
	if ( !$order_check ) {
		$order_check = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['adult_num'], $_GET['child'], $user_id, '4' );
	}
}


$res_link     = get_the_permalink( $hotel_id );
$ndate        = new DateTime();
$now_date     = $ndate->format( 'Y/m/d' );
$discount_ifo = $this_room['discount'];
$in_discount  = 'false';
$discount     = 0;

if ($discount_ifo){
	$start_date_jalali = $discount_ifo['start_date '];
	$end_date_jalali   = $discount_ifo['end_date'];
	$start_array       = explode( '/', $start_date_jalali );
	$end_array         = explode( '/', $end_date_jalali );
	$end_date          = jmktime( '23', '0', '0', $end_array[1], $end_array[2], $end_array[0], '', '' );;
	$start_date = jmktime( '23', '0', '0', $start_array[1], $start_array[2], $start_array[0], '', '' );
	$start_date = date( 'Y/m/d', $start_date );
	$end_date   = date( 'Y/m/d', $end_date );
	if ( $now_date >= $start_date && $now_date <= $end_date ) {
		$in_discount = 'true';
	}
}

if ( $reserve_type == 0 ) {
	$active = 'active';
	require 'send_hotel_conform.php';
} elseif ( $reserve_type == 1 ) {
	require 'send_hotel_need_temp.php';
	$active = 'deactive';

}
?>

<?php

get_footer();