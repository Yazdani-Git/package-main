<?php
global $wpdb;
$all_results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}jayto_orders  ORDER BY id DESC ", object );


$ti       = get_option( 'pay_time' );
$result1  = array();
$result2  = array();
$result3  = array();
$result4  = array();
$result5  = array();
$result6  = array();
$result7  = array();
$result10 = array();
$result11 = array();
$result12 = array();

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
	if ( $row->order_status == 5 ) {
		$result5[ $key ] = $row;
	}
	if ( $row->order_status == 6 ) {
		$result6[ $key ] = $row;
	}
	if ( $row->order_status == 7 ) {
		$result7[ $key ] = $row;
	}
	if ( $row->order_status == 10 ) {
		$result10[ $key ] = $row;
	}
	if ( $row->order_status == 11 ) {
		$result11[ $key ] = $row;
	}
	if ( $row->order_status == 12 ) {
		$result12[ $key ] = $row;
	}
}
?>
<div class="rq_box">

    <div class="rb_header">
        <span class="adm_button bgcol_dark adm_ord active " data-os="1">در انتظارتایید <span class="tbullet"><?php echo sizeof( $result1 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="4">در انتظار پرداخت  <span class="tbullet"><?php echo sizeof( $result4 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="12">در انتظار تایید پرداخت  <span class="tbullet"><?php echo sizeof( $result12 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="10">پرداخت شده <span class="tbullet"><?php echo sizeof( $result10 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="11">رزروشده(پرداخت نقدی) <span class="tbullet"><?php echo sizeof( $result11 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="3">رد شده از طرف میزبان <span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="7">رها شده <span class="tbullet"><?php echo sizeof( $result7 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="6">لغو شده <span class="tbullet"><?php echo sizeof( $result6 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="5"> <span class="tbullet"><?php echo sizeof( $result5 ) ?></span>لغو شده سیستمی</span>
    </div>

    <div class="rq_body">
        <table class="rqb_table">
			<?php
			if ( $all_results ) {
				?>

                <thead>
                <tr>
                    <th class="w5p">ردیف</th>
                    <th class="w10p">شماره سفارش</th>
                    <th>نام اقامتگاه</th>
                    <th class="w5p">وضعیت سفارش</th>
	                <?php
	                if (sizeof( $result1) > 0||sizeof( $result10 ) > 0 ||sizeof( $result12 ) > 0 ||sizeof( $result1 ) > 0||sizeof( $result4 ) > 0){ ?>
                        <th class="w20p">عملیات</th>
	                <?php  }
	                ?>
                    <th class="w5p"> مبلغ سفارش (تومان)</th>
                    <th class="w5p">مشاهده</th>
                </tr>
                </thead>
			<?Php }
			?>

            <tbody>
			<?php
			$i = 1;
			foreach ( $all_results as $row ) {

				$post = get_post( $row->res_id );

				$order_status = '';
				switch ($row->order_status) {

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
					case 1:
						$order_status = 'درانتظار تایید';
						break;
					case 11:
						$order_status = 'رزرو شده( نقدی)';
						break;
					case 12:
						$order_status = 'در انتظار تایید پرداخت';
						break;
				}


				?>

                <tr>
                    <td><?php echo $i ?></td>
                    <td><?php echo $row->id ?></td>
                    <td class="w20p"><?php echo $post->post_title ?></td>
                    <td class="w20p"><?php echo $order_status ?>
	                    <?php
	                    if ($row->pay_type == 'cart'){
		                    echo '(کارت به کارت)';
	                    }
	                    ?>
                    </td>
                    <td class="w10p">
                        <div class="admin_rw">
                            <span class="hadm_operation" data-oid="<?php  echo $row->id ?> " data-res="res">عملیات</span>
                        </div>

                    </td>
	                <?php

	                if ($row->discount_price){ ?>
                        <td class="w10p"><del><?php echo number_format($row->price) ?></del><span><?php echo number_format($row->discount_price) ?></span></td>
	                <?php }else{?>
                        <td class="w10p"><?php echo number_format($row->price) ?></td>
	                <?php  }
	                ?>
                    <td class="w10p"><span class="order_edit_bot" data-oitrm="<?php echo $row->id ?>" >مشاهده مشخصات</span></td>

                </tr>
				<?php $i ++;
			}

			?>

            </tbody>
        </table>
    </div>

</div>
<div class="order_show_comp">

</div>