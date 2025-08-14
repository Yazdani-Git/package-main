<div class="rb_header">

	<span class="adm_button bgcol_dark tou_ord <?php  if ($os == 1) echo 'active'?>" data-os="1">در انتظار تایید<span class="tbullet"><?php echo sizeof( $result1 ) ?></span></span>
	<span class="adm_button bgcol_dark tou_ord <?php  if ($os == 2) echo 'active'?>" data-os="2"> در انتظار پرداخت  <span class="tbullet"><?php echo sizeof( $result2 ) ?> </span></span>
	<span class="adm_button bgcol_dark tou_ord <?php  if ($os == 3) echo 'active'?>" data-os="3"> پرداخت شده <span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
	<span class="adm_button bgcol_dark tou_ord <?php  if ($os == 4) echo 'active'?>" data-os="4">لغوشده<span class="tbullet"><?php echo sizeof( $result4 ) ?></span></span>
</div>
<div class="rq_body">
	<table class="rqb_table">
		<thead>
		<?Php
		if ($results){?>
		<tr>
			<th class="w5p">ردیف</th>
			<th class="w10p">شماره سفارش</th>
			<th>نام تجربه</th>
			<th class="w5p">وضعیت سفارش</th>
			<th class="w5p">مبلغ سفارش (تومان)</th>
			<th class="w5p">مشاهده مشخصات </th>
		</tr>
		</thead>
		<?Php }

		?>
		<tbody>
		<?php
		$i = 1;
		foreach ( $results as $row ) {

			$post = get_post( $row->tour_id );
			$order_status = '';
			switch ($row->order_status) {

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
					$order_status ='لغو شده';
					break;

			}


			?>

			<tr>
				<td><?php echo $i ?></td>
				<td><?php echo $row->id ?></td>
				<td class="w20p"><?php echo $post->post_title ?></td>
				<td class="w10p"><?php  echo $order_status?></td>
				<td class="w10p"><?php echo number_format($row->price) ?></td>
				<td class="w10p"><span class="order_tedit_bot" data-oitrm="<?php echo $row->id ?>">مشاهده مشخصات</span></td>
                <td class="w10p"><span class="change_tos" data-oitrm="<?php echo $row->id ?>">تغییر وضعیت</span></td>

			</tr>
			<?php $i ++;
		}

		?>

		</tbody>
	</table>
</div>