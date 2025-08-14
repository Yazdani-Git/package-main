
<div class="rb_header">
    <div class="rb_header">
        <span class="adm_button bgcol_dark adm_ord  " data-os="1">در انتظارتایید <span class="tbullet"><?php echo sizeof( $result1 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="4">در انتظار پرداخت  <span class="tbullet"><?php echo sizeof( $result4 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="12">در انتظار تایید پرداخت  <span class="tbullet"><?php echo sizeof( $result12 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="10">پرداخت شده <span class="tbullet"><?php echo sizeof( $result10 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="11">رزروشده(پرداخت نقدی) <span class="tbullet"><?php echo sizeof( $result11 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="3">رد شده از طرف میزبان <span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="7">رها شده <span class="tbullet"><?php echo sizeof( $result7 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="6">لغو شده <span class="tbullet"><?php echo sizeof( $result6 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord" data-os="5"> <span class="tbullet"><?php echo sizeof( $result5 ) ?></span>لغو شده سیستمی</span>
    </div>
</div>
<div class="rq_body">
	<table class="rqb_table">
		<thead>
<?Php
if ($results){?>
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
    <th class="w5p">مبلغ سفارش (تومان)</th>
    <th class="w5p">مشاهده</th>
</tr>
        </thead>
<?Php }

?>
		<tbody>
		<?php
		$i = 1;
		foreach ( $results as $row ) {

			$post = get_post( $row->res_id );
$order_status = '';
switch ($row->order_status) {

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
		$order_status = 'رزرو شده(نقدی)';
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
				<td class="w20p"><?php  echo $order_status?>
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
				<td class="w10p"><?php
				if($row->discount_price && $row->discount_price > 0 ){
					echo number_format($row->discount_price);
				 }else{
					echo number_format($row->price);
				 }
				 
				
				
				
				?></td>
                <td class="w10p"><span class="order_edit_bot" data-oitrm="<?php echo $row->id ?>">مشاهده مشخصات</span></td>

			</tr>
			<?php $i ++;
		}

		?>

		</tbody>
	</table>
</div>
