


<div class="rb_header">
<span class="adm_button bgcol_dark adm_ord_hot <?php if($os==1)echo 'active'  ?> " data-os="1">در انتظارتایید <span class="tbullet"><?php echo sizeof( $result2 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==4)echo 'active'  ?>" data-os="4">در انتظار پرداخت <span class="tbullet"><?php echo sizeof( $result4) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==12)echo 'active'  ?>" data-os="12">در انتظار تایید پرداخت <span class="tbullet"><?php echo sizeof( $result12 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==11)echo 'active'  ?>" data-os="11">رزرو شده پرداخت نقدی <span class="tbullet"><?php echo sizeof( $result11 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==10)echo 'active'  ?>" data-os="10">پرداخت شده <span class="tbullet"><?php echo sizeof( $result10 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==3)echo 'active'  ?>" data-os="3">رد شده از طرف میزبان <span class="tbullet"><?php echo sizeof( $result3 ) ?></span></span>
        <span class="adm_button bgcol_dark adm_ord_hot <?php if($os==5)echo 'active'  ?>" data-os="5"> <span class="tbullet"><?php echo sizeof( $result5 ) ?></span>لغو شده سیستمی</span>
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
    <th class="w20p">وضعیت سفارش</th>
	<?php
	if (sizeof( $result2 ) > 0||sizeof( $result12 ) > 0||sizeof( $result10 ) > 0){ ?>
        <th class="w10p">عملیات</th>
	<?php  }
	?>
    <th class="w10p">مبلغ سفارش (تومان)</th>
    <th class="w5p">مشاهده</th>
    <th class="w5p">اطلاعات هتل</th>
</tr>
        </thead>
<?Php }

?>
		<tbody>
		<?php
		$i = 1;
		foreach ( $results as $row ) {

			$post = get_post( $row->hot_id );
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

	case 3:
		$order_status = 'ردشده از طرف میزبان';
		break;
	case 11:
		$order_status = 'رزرو شده پرداخت نقدی';
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
				<td class="w10p"><?php  echo $order_status?>
                <?php if ($row->pay_type == 'cart'){
                    echo '(کارت به کارت)';
					}?>
                </td>
                <?php
                if($result2 || $result12 || $result10){ ?>
                    <td class="w10p">
                        <div class="admin_rw">
                            <span class="hadm_operation" data-oid="<?php  echo $row->id ?>">عملیات</span>
                        </div>

                    </td>
               <?php }
                ?>
                <?php
                if ($row->discount_price){ ?>
                    <td class="w10p"><del><?php echo number_format($row->price) ?></del><span><?php echo number_format($row->discount_price) ?></span></td>
               <?php }else{?>
                    <td class="w10p"><?php echo number_format($row->price) ?></td>
              <?php  }
                ?>

                <td class="w10p"><span class="hot_order_edit_bot" data-oitrm="<?php echo $row->id ?>"> مشخصات</span></td>
                <td class="w10p"><span class="hot_show_info" data-oitrm="<?php echo $row->id ?>">مشاهده </span></td>

			</tr>
			<?php $i ++;
		}

		?>

		</tbody>
	</table>
</div>
