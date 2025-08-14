<?php
global $post;
$pid  = $post->ID;
$meta = get_post_meta( $pid, 'all_hotel_meta', true );
$code     = $post->ID + 1000;
if ( $meta[0]['posid'] != '' ) {
	$code = $meta[0]['posid'];
}
?>
<div class="rooms_item_box">

    <label>#شناسه </label>
    <input type="text" name="posid" value="<?php echo $code; ?>"/>
</div>
<div class="rooms_item_box">



    <label>نوع رزرو</label>
    <select name="hotel_type">
        <option value="0" <?php if ( $meta['type'] == 0 )
			echo 'selected' ?> >قطعی
        </option>
        <option value="1" <?php if ( $meta['type'] == 1 )
			echo 'selected' ?>>نیاز به تایید
        </option>
    </select>

</div>
<div class="rooms_item_box">
    <label>تعداد ستاره ها</label>
    <select name="hotel_stars">

        <option value="1" <?php if ( $meta['stars'] == 1 )
			echo 'selected' ?>>1
        </option>
        <option value="2" <?php if ( $meta['stars'] == 2 )
			echo 'selected' ?>>2
        </option>
        <option value="3" <?php if ( $meta['stars'] == 3 )
			echo 'selected' ?>>3
        </option>
        <option value="4" <?php if ( $meta['stars'] == 4 )
			echo 'selected' ?>>4
        </option>
        <option value="5" <?php if ( $meta['stars'] == 5 )
			echo 'selected' ?>>5
        </option>

    </select>
</div>
<div class="rooms_item_box">
    <label>ساعت ورود</label>
    <select name="in_clock">
		<?php
		for ( $i = 1; $i <= 24; $i += 0.5 ) {
			?>
            <option value="<?php echo $i ?>" <?php if ( $meta['in_clock'] == $i )
				echo 'selected' ?> ><?php echo $i ?> </option>
		<?php }
		?>


    </select>
</div>
<div class="rooms_item_box">
    <label>ساعت خروج</label>
    <select name="out_clock">
		<?php
		for ( $i = 1; $i <= 24; $i += 0.5 ) {
			?>
            <option value="<?php echo $i ?>"<?php if ( $meta['out_clock'] == $i )
				echo 'selected' ?> ><?php echo $i ?> </option>
		<?php }
		?>



    </select>
</div>
<div class="rooms_item_box">
    <label>برای کودکان چند سال به بالا تخت کامل درنظر گرفته میشود؟</label>
    <select name="child_bed_need">
		<?php
		for ( $i = 1; $i <= 12; $i ++ ) {
			?>
            <option value="<?php echo $i ?>"<?php if ( $meta['child_bed_need'] == $i )
				echo 'selected' ?> ><?php echo $i ?> </option>
		<?php }
		?>



    </select>

</div>

<div class="rooms_item_box">
    <link rel="stylesheet" href="<?Php   echo  get_template_directory_uri().'/css/leaflet.css';   ?>" />
    <script src="<?Php   echo  get_template_directory_uri().'/js/leaflet.js';   ?>" ></script>

</div>
<div class="rooms_item_box">
    <label>آدرس هتل</label>
<input  type="text" style="width: 100%;margin-bottom: 20px;text-align: right" name="hotel_address" value="<?php  echo $meta['address']?>" class="input_temp hotel_name_inp" autocomplete="off" >
</div>
<div class="rooms_item_box">
    <label>تلفن هتل</label>
<input  type="text" style="width: 100%;margin-bottom: 20px;text-align: right" name="hotel_phone" value="<?php  echo $meta['phone']?>" class="input_temp hotel_name_inp" autocomplete="off" >
</div>
<div class="rooms_item_box">
    <label>نام هتلدار</label>
<input  type="text" style="width: 100%;margin-bottom: 20px;text-align: right" name="hotelier_name" value="<?php  echo $meta['hotelier_name']?>" class="input_temp hotel_name_inp" autocomplete="off" >
</div>
<div class="rooms_item_box">
    <label>توضیحات تکمیلی (برای ادمین)</label>
<input  type="text" style="width: 100%;margin-bottom: 20px;text-align: right" name="hotelier_additional" value="<?php  echo $meta['hotelier_additional']?>" class="input_temp hotel_name_inp" autocomplete="off" >
</div>
    <hr>
    <p class="fw300 fz12 mt_10">موقعیت مکانی دقیق اقامتگاه را روی نقشه مشخص نمایید..</p>
	<?php
	$lat = $meta['map_point_lat'];
	$lng = $meta['map_point_lng'];
	if ( ! $lat ) {
		$lat = 35.7009;
	}
	if ( ! $lng ) {
		$lng = 51.3912;
	}
	?>
    <div id="map_insert_hotel">
    </div>
    <style>
        #map_insert_hotel {
            height: 300px;
            border-radius: 12px;
            margin: 20px 0
        }
    </style>
    	 <script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script> 
    <script>
        var greenIcon = L.icon({
            iconUrl: '<?php echo get_template_directory_uri(); ?>/images//pointssv.svg',
            shadowUrl: 'leaf-shadow.png',
            iconSize: [90, 90], // size of the icon
            shadowSize: [50, 64], // size of the shadow
            iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
            shadowAnchor: [4, 62],  // the same for the shadow
            popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor


        });
        let map = L.map('map_insert_hotel').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '',
        }).addTo(map);
        map.addControl(L.control.search({ position: 'topright' }));
        let marker;
        marker = new L.marker([<?php  echo $lat?>, <?php  echo $lng?>], {draggable: 'true'}).addTo(map);
        marker.on('dragend', function (e) {
            var latlng = marker.getLatLng();
            jQuery('.map_point_lat').val(latlng.lat)
            jQuery('.map_point_lng').val(latlng.lng)
        });
    </script>
    <input type="hidden" name="map_point_lat" class="map_point_lat " checked <?php if ( $lat ) { ?>  value="<?php echo $lat ?>"  <?php } ?> >
    <input type="hidden" name="map_point_lng" class="map_point_lng" <?php if ( $lat ) { ?>  value="<?php echo $lng ?>"  <?php } ?>>


