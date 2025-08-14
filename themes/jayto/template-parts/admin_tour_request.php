<script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
<script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
<?php
global $wpdb;
$all_results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}tour_reserve_request  ORDER BY id DESC ", object );
$ti          = get_option( 'pay_time' );

$result1 = array();
$result2 = array();
$result3 = array();
$result4 = array();


foreach ( $all_results as $key => $row ) {

	if ( $row->order_status == 1 ) {
		$result1[ $key ] = $row;
	}

	if ( $row->order_status == 2 ) {
		$result2[ $key ] = $row;
	}
	if ( $row->order_status == 3 ) {
		$result3[ $key ] = $row;
	}
	if ( $row->order_status == 4 ) {
		$result4[ $key ] = $row;
	}

}
?>

<div class="rq_box">
    <div class="rb_header">
        <span class="adm_button bgcol_dark tou_ord active " data-os="1">در انتظارتایید <span class="tbullet"><?php echo sizeof( $result1 ) ?></span></span>
        <span class="adm_button bgcol_dark tou_ord" data-os="2">در انتظار پرداخت <span class="tbullet"><?php echo sizeof( $result2 ) ?></span></span>
        <span class="adm_button bgcol_dark tou_ord" data-os="3">پرداخت شده<span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
        <span class="adm_button bgcol_dark tou_ord" data-os="4">لغو شده <span class="tbullet"><?php echo sizeof( $result4 ) ?></span></span>
    </div>

    <div class="rq_body">
        <table class="rqb_table">
			<?php
			if ( $all_results and $result1 ) {

				?>

                <thead>
                <tr>
                    <th class="w5p">ردیف</th>
                    <th class="w10p">شماره سفارش</th>
                    <th>نام تجربه</th>
                    <th class="w5p">وضعیت سفارش</th>
                    <th class="w5p">نوع درخواست</th>
                    <th class="w5p"> مبلغ سفارش (تومان)</th>
                    <th class="w5p">مشاهده</th>
                    <th class="w5p">ثبت سانس</th>
                    <th class="w5p">تغییر وضعیت</th>

                </tr>
                </thead>
			<?Php }
			?>

            <tbody>
			<?php
			$i = 1;
			foreach ( $all_results as $row ) {
				$post         = get_post( $row->tour_id );
				$order_status = '';
				switch ( $row->order_status ) {

					case 1:
						$order_status = 'در انتظار تایید';
						break;
					case 2:
						$order_status = 'درانتظارپرداخت';
						break;
					case 3:
						$order_status = 'پرداخت شده';
						break;
					case 4:
						$order_status = 'لغو شده';
						break;

				}
				?>
				<?php
				if ( $result1 ) {
					$rtype = '';
					if ( $row->request_type == 'general' ) {
						$rtype = 'سانس عمومی';
					} elseif ( $row->request_type == 'private' ) {
						$rtype = 'سانس خصوصی';
					}elseif ( $row->request_type == 'private_shutter' ) {
						$rtype = 'سانس دربست';
					}

					?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row->id ?></td>
                        <td class="w20p"><?php echo $post->post_title ?></td>
                        <td class="w10p"><?php echo $order_status ?></td>
                        <td class="w10p"><?php echo $rtype ?></td>

                        <td class="w10p"><?php echo number_format( $row->price ) ?></td>
                        <td class="w10p"><span class="order_tedit_bot" data-oitrm="<?php echo $row->id ?>">مشاهده مشخصات</span></td>
                        <?php
                        if ($row->request_type == 'private'){ ?>
                            <td class="w10p"><span class="admin_addSans_bot" data-oitrm="<?php echo $row->id ?>">تعیین سانس</span></td>

                       <?php }else{
                            echo '<td></td>';
                        }
                        ?>

                        <td class="w10p"><span class="change_tos" data-oitrm="<?php echo $row->id ?>">تغییر وضعیت</span></td>
						<?php
						if ( $row->request_type == 'private' ) {
							$rand = rand( 25500, 5687452 )
							?>
                            <?php
                            if ($order_status == 1){ ?>

                        <?php    }
                            ?>

						<?php }
						?>

                    </tr>
					<?php $i ++;


				}
			}

			?>

            </tbody>
        </table>
    </div>

</div>
<div class="order_show_comp"></div>
<div class="chords_form">

</div>