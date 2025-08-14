<?php
$hotel = get_post_meta($result->hot_id,'all_hotel_meta',true);

?>
<div class="osc_mih ">
	<span class="alert_box_close"><i class="dashicons dashicons-no-alt"></i></span>
	<div>
		<p>آدرس هتل : <span><?php  echo $hotel['address'] ?></span></p>

	</div>
	<span class="line_dash_90"></span>
	<div>
		<p>نام هتلدار : <span><?php  echo $hotel['hotelier_name'] ?></span></p>

	</div>
	<span class="line_dash_90"></span>
	<div>
		<p>تلفن هتل : <span><?php  echo $hotel['phone'] ?></span></p>

	</div>
	<span class="line_dash_90"></span>
	<div>
		<p>توضیحات تکمیلی : <span><?php  echo $hotel['hotelier_additional'] ?></span></p>

	</div>
	<span class="line_dash_90"></span>

</div>
