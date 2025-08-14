<?php
$city      = get_terms( array(
	'taxonomy'   => 'city',
	'hide_empty' => false,
) );
global $post,$wpdb;
$pid = $post->ID;
$tmeta = 	get_post_meta( $pid, 'all_tour_meta', true);
$var     = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}tour_variable WHERE  tid= {$pid}  ", object );
?>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
<script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
<div class="rooms_item_box">
    <label>مختصری درباره خود بنویسید</label>
    <textarea class="about_me width100" name="about_me"  ><?php echo $tmeta['about_me'] ?></textarea>
</div>
<div class="rooms_item_box">
    <label>جای تجربه</label>
    <input class="width100" type="text"  name="tour_place_opt" value="<?php echo  $tmeta['tour_place_opt']  ?>"  placeholder="جای تجربه را وارد کنید مثلا گیلان روستای بیشه">
</div>

<div class="rooms_item_box">
    <label>چالش فیزیکی</label>
    <select name="Physical_challenge">
		    <option value="کم" <?php if ($tmeta['Physical_challenge'] == 'کم' ) echo "selected" ?> >کم </option>
		    <option value="متوسط" <?php if ($tmeta['Physical_challenge'] == 'متوسط' ) echo "selected" ?> >متوسط </option>
		    <option value="زیاد" <?php if ($tmeta['Physical_challenge'] == 'زیاد' ) echo "selected" ?> >زیاد </option>
    </select>
</div>
<div class="rooms_item_box">
    <label>مناسب برای</label>
    <select name="age_need" >
		    <option value="همه سنین" <?php if ($tmeta['age_need'] == 'همه سنین' ) echo "selected" ?> >همه سنین </option>
		    <option value="18 سال به بالا"  <?php if ($tmeta['age_need'] == '18 سال به بالا' ) echo "selected" ?>>افراد بالای 18 سال </option>

    </select>
</div>
<div class="rooms_item_box">
    <label> مدت تجربه (ساعت / روز)</label>
    <select name="tour_time">
	    <?php
for ($i=1;$i<24 ;$i++){?>
	<option value="<?php echo $i?>" <?php if ($tmeta['tour_time'] == $i) echo "selected" ?>><?php  echo $i?> </option>
<?php }
	    ?>

	    <option value="one_day"  <?php if ($tmeta['tour_time'] == 'one_day') echo "selected" ?> >یک روز</option>
	    <option value="tow_day"  <?php if ($tmeta['tour_time'] == 'tow_day') echo "selected" ?>>دو روز </option>
	    <option value="three_day"  <?php if ($tmeta['tour_time'] == 'three_day') echo "selected" ?>>سه روز </option>
	    <option value="four_day" <?php if ($tmeta['tour_time'] == 'four_day') echo "selected" ?>> چهار روز </option>
	    <option value="five_day" <?php if ($tmeta['tour_time'] == 'five_day') echo "selected" ?>>  پنچ روز </option>
	    <option value="six_day" <?php if ($tmeta['tour_time'] == 'six_day') echo "selected" ?>>  شش روز </option>
	    <option value="seven_day" <?php if ($tmeta['tour_time'] == 'seven_day') echo "selected" ?>> یک هفته </option>


    </select>
</div>
<div class="rooms_item_box">
    <label>  حد اکثر ظرفیت هر سانس  (نفر)</label>
    <select name="tour_capacity">
	    <?php
for ($i=1;$i<100 ;$i++){?>
	<option value="<?php echo $i?>"  <?php if ($tmeta['tour_capacity'] == $i) echo "selected" ?>><?php  echo $i?> </option>
<?php }
	    ?>
    </select>
</div>
<div class="rooms_item_box">
    <label>قیمت برای هر نفر (تومان)</label>
    <input type="number" name="tour_price" class="tour_shutter_price" value="<?php echo $tmeta['tour_price'] ?>" >
</div>
<div class="rooms_item_box">
    <label>قیمت تور دربست (تومان)</label>
    <input type="number" name="tour_shutter_price" class="tour_shutter" value="<?php echo $tmeta['tour_shutter_price'] ?>" >
</div>
<div class="rooms_item_box_add">
    <div class="rotba">
        <span>افزودن اقامتگاه برای تور</span>
        <span class="dashicons dashicons-insert add_aditionam_icon" data-tid="<?php  echo $pid?>"></span>

    </div>

   <hr>
    <div class="adiitional_inline_box">
        <?php
        foreach ($var as $row){

            ?>
           <div class="mbt15 adiibt">
               <label>نام اقامتگاه :</label>
               <input type="text" name="add_tour_exp" class="add_tour_exp" value="<?php  echo $row->title?>">
               <label>قیمت (تومان) :</label>
               <input type="number" name="tour_var_price" class="add_tour_exp_price" value="<?php  echo $row->price?>" >
               <label>پیش فرض :</label>
               <input type="checkbox" name="tour_base" class="tour_base" <?php  if($row->base == 1)echo 'checked'?> >
               <span class="dashicons dashicons-update aib_update" data-id="<?php echo $row->id ?>"></span>
              <span class="dashicons dashicons-trash aib_delete" data-id="<?php echo $row->id ?>" ></span>

           </div>
      <?php  }
        ?>
    </div>
    <div class="adiitional_add_box">


    </div>
</div>

<div class="rooms_item_box">
    <label>  لوازمی که حتما باید همراه آورده شود.آیتم ها را با خط فاصله جدا کنید</label>
<textarea class="necessary_supplies" name="necessary_supplies" ><?php echo $tmeta['necessary_supplies'] ?></textarea>
</div>
<div class="rooms_item_box">
    <label>    لوازمی که پیشنهاد میشود  همراه آورده شود .آیتم ها را با خط فاصله جدا کنید</label>
<textarea class="proposal_supplies" name="proposal_supplies" ><?php echo $tmeta['proposal_supplies'] ?></textarea>
</div>
<div class="rooms_item_box">
    <label> آدرس :</label>
    <input type="text" class="text_before" name="tour_address" placeholder="آدرس یا محل قرار را وارد نمایید "  value="<?php echo $tmeta['tour_address'] ?>">
</div>
<div class="rooms_item_box">
    <label>   عنوان قبل از نقشه</label>
<input type="text" class="text_before" name="text_before" placeholder="با هم حوالی لاهیجان قرار می‌گذاریم. "  value="<?php echo $tmeta['text_before'] ?>">
</div>
<p class="fw700 fz16">موقعیت مکانی</p>
<p class="fw300 fz12 mt_10"><?php  echo $tmeta['text_before']?>لوکیشن دقیق بعد از ثبت نام براتون ارسال می‌شه.</p>
<?php
$lat = $tmeta['map_point_lat'];
$lng = $tmeta['map_point_lng'];
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
<script>
    let map = L.map('map_insert_hotel').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
    L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {
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
</div>

