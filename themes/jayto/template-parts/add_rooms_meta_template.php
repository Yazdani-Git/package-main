<?php
 $pid =$_POST['pid'];
  $new_last_room  = get_post_meta( $pid, 'room_count', true );
if ($new_last_room == ''){
	$new_last_room =1;
}else{
	$new_last_room = $new_last_room +1;
}
update_post_meta( $pid, 'room_count', $new_last_room  );

?>

<div class="rooms_inner " data-rnum="<?php echo $new_last_room  ?> ">
    <div class="del_room " data-info="<?php echo $ky .'-'.$pid ?>">
        <i class="fa fa-trash del_i" ></i>
    </div>
	<div class="rooms_item_box" >
		<label class="fz14">نام اتاق</label>
		<input type="text" class="room_inp input_htemp room_name" name="room_name" style="width: 66%">
	</div>

	<div class="rooms_item_box" >
		<label class="fz14">توضیح کوتاه درمورداتاق </label>
		<input type="text" class="room_inp input_htemp r_short_desc" name="r_short_desc" style="width: 66%"  >
	</div>
	<div class="rooms_item_box">
		<label class="fz14">تعداد تخت </label>
		<input type="number" class="room_inp input_htemp room_on_bed" name="room_on_bed">
	</div>
	<div class="rooms_item_box">
                <label>تعداد تخت یک نفره</label>
                <select type="number" class="room_inp room_single_bed" name="room_single_bed" >
				<option value="0" <?php  if($row['room_single_bed'] == 0) echo 'selected' ?> >0 </option>
				<option value="1" <?php  if($row['room_single_bed'] == 1) echo 'selected' ?> >1 </option>
                 <option value="2" <?php if($row['room_single_bed'] == 2) echo 'selected' ?> >2</option>
                 <option value="3"<?php if($row['room_single_bed'] == 3) echo 'selected' ?> >3</option>
                 <option value="4"<?php if($row['room_single_bed'] == 4) echo 'selected' ?> >4</option>
            </select>
            </div>
            <div class="rooms_item_box">
                <label>تعداد تخت دو نفره</label>
                <select type="number" class="room_inp room_Double_bed" name="room_Double_bed" >
				<option value="0"<?php  if($row['room_Double_bed'] == 0) echo 'selected' ?> >0 </option>
				<option value="1"<?php  if($row['room_Double_bed'] == 1) echo 'selected' ?> >1 </option>
                 <option value="2"<?php  if($row['room_Double_bed'] == 2) echo 'selected' ?> >2 </option>
                 <option value="3"<?php  if($row['room_Double_bed'] == 3) echo 'selected' ?> >3 </option>
                 <option value="4"<?php  if($row['room_Double_bed'] == 4) echo 'selected' ?> >4</option>
            </select>
            </div>
	<div class="rooms_item_box">
		<label class="fz14">صبحانه</label>
		<input type="checkbox" class="room_inp input_htemp room_breackfast" name="room_breackfast">
		<label class="fz14">نهار</label>
		<input type="checkbox" class="room_inp input_htemp room_lunch" name="room_lunch">
		<label class="fz14">شام</label>
		<input type="checkbox" class="room_inp input_htemp room_Dinner" name="room_Dinner">
	</div>
	<div class="rooms_item_box">
		<label class="fz14">قیمت برای روزهای عادی (تومان)</label>
		<input type="number" class="room_inp input_htemp room_normal_price" name="room_normal_price" >
	</div>
	<div class="rooms_item_box">
		<label class="fz14">قیمت برای روزهای آخر هفته (تومان)</label>
		<input type="number" class="room_inp input_htemp room_endWeek_price" name="room_endWeek_price" >
	</div>




</div>
<?php

if (is_admin()){
    echo "<hr>";
}