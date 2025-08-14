<?php
//print_r($hotel_rooms);

?>
<div class="dis_item">
    <div class="">
        <span class="alert_hbox_close"><i class="dashicons dashicons-no-alt"></i></span>
    </div>

	<table class="width_100">
		<thead>
		<tr>

			<th>نام اتاق</th>
			<th>تاریخ شروع تخفیف</th>
			<th>تاریخ پایان تخفیف</th>
			<th>درصد تخفیف</th>
			<th>عملیات</th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ($hotel_rooms as $key=>$row){

		?>

		<tr>

			<td>
				<div class="red_dname">
					<span><?php echo  $row['room_name'] ?></span>
				</div>
			</td>
			<td>
				<div class="red_dname">
				<input type="text"  value="<?php echo $row['discount']['start_date ']?>" class="start_date inp_style" autocomplete="off" placeholder="1402/05/01">
                </div>
	       </td>
	<td>
		<div class="red_dname">
		<input type="text"  value="<?php echo $row['discount']['end_date']?>" class="end_date inp_style" autocomplete="off" placeholder="1402/05/02">

	</td>
		</div>

	<td>
		<div class="red_dname">
			<input type="number" value="<?php echo $row['discount']['perscent_discount']?>" class="inp_style perscent_discount" placeholder="عدد تخفیف به درصد ">
		</div>
	</td>
	<td>
		<span class="submit_room_discount" data-hid="<?php echo $hid ?>" data-rid="<?php echo $key ?>">ثبت تخفیف</span>
	</td>

	</tr>

<?php   }
?>
</tbody>
</table>

</div>
