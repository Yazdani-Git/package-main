<?php
if ( isset( $_POST['hoster_percent'] ) ) {
	$pay_types = [];
	if ( isset( $_POST['bank_pay'] ) ) {
		$pay_types[] = $_POST['bank_pay'];
	}
	if ( isset( $_POST['cart_pay'] ) ) {
		$pay_types[] = $_POST['cart_pay'];
	}
	if ( isset( $_POST['cash_pay'] ) ) {
		$pay_types[] = $_POST['cash_pay'];
	}
    
	update_option( 'pays_type', $pay_types );
	update_option( 'hoster_percent', $_POST['hoster_percent'] );
	update_option( 'resend_one_code_time', $_POST['resend_one_code_time'] );
	update_option( 'answer_request_time', $_POST['answer_request_time'] );
	update_option( 'pay_time', $_POST['pay_time'] );
	update_option( 'allow_add_hotel', $_POST['allow_add_hotel'] );
	update_option( 'hotel_enable', $_POST['hotel_enable'] );
	update_option( 'change_search_fsh', $_POST['change_search_fsh'] );
	update_option( 'allow_add_theme_tour', $_POST['allow_add_theme_tour'] );
	update_option( 'allow_add_tour_hoster', $_POST['allow_add_tour_hoster'] );
	update_option( 'child_select_view', $_POST['child_select_view'] );
	update_option( 'bsmlat', $_POST['map_point_lat'] );
	update_option( 'bsmlang', $_POST['map_point_lng'] );
	update_option( 'cart_number', $_POST['opt_cart_number'] );
	update_option( 'hide_archive_title', $_POST['hide_archive_title'] );
	update_option( 'disable_res_tools', $_POST['disable_res_tools'] );
	update_option( 'single_edit', $_POST['single_edit'] );
	update_option( 'low_view_text', $_POST['low_view_text'] );
	update_option( 'low_view_link_text', $_POST['low_view_link_text'] );
	update_option( 'low_view_link', $_POST['low_view_link'] );
	update_option( 'require_inp_host_insert', $_POST['require_inp_host_insert'] );
    update_option( 'show_map_single', $_POST['show_map_single'] );
    update_option( 'show_low_single', $_POST['show_low_single'] );
    update_option( 'b_host', $_POST['b_host'] );
    update_option( 'update_date_days', $_POST['update_date_days'] );
}


$pay_type              = get_option( 'pays_type' );
$hoster_percent        = get_option( 'hoster_percent' );
$resend_one_code_time  = get_option( 'resend_one_code_time' );
$answer_request_time   = get_option( 'answer_request_time' );
$pay_time              = get_option( 'pay_time' );
$allow_add_hotel       = get_option( 'allow_add_hotel' );
$hotel_enable          = get_option( 'hotel_enable' );
$change_search_fsh     = get_option( 'change_search_fsh' );
$allow_add_theme_tour  = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster = get_option( 'allow_add_tour_hoster' );
$child_select_view     = get_option( 'child_select_view' );
$hide_archive_title    = get_option( 'hide_archive_title' );
$single_edit           = get_option( 'single_edit' );
$bsmlat                = get_option( 'bsmlat' );
$bsmlang               = get_option( 'bsmlang' );
$cart_number           = get_option( 'cart_number' );
$disable_res_tools     = get_option( 'disable_res_tools' );
$low_view_text    = get_option( 'low_view_text' );
$low_view_link_text     = get_option( 'low_view_link_text' );
$low_view_link     = get_option( 'low_view_link' );
$require_inp_host_insert     = get_option( 'require_inp_host_insert' );
$show_map_single     = get_option( 'show_map_single' );
$show_low_single     = get_option( 'show_low_single' );
$update_date_days     = get_option( 'update_date_days' );
$b_host     = get_option( 'b_host' );
?>

    <form action="#" method="post">

        <div class="option_box">
            <label><span class="opt_lable">نوع پرداخت</span>
                <input type="checkbox" class="bank_pay" name="bank_pay" value="bank_pay" <?php if ( in_array( 'bank_pay', $pay_type ) ) {
					echo 'checked="checked" ';
				} ?> >
                <span>درگاه بانکی</span>
                <input type="checkbox" class="cart_pay" name="cart_pay" value="cart_pay" <?php if ( in_array( 'cart_pay', $pay_type ) ) {
					echo 'checked="checked" ';
				} ?>>
                <span>کارت به کارت</span>
                <input type="checkbox" class="cash_pay" name="cash_pay" value="cash_pay" <?php if ( in_array( 'cash_pay', $pay_type ) ) {
					echo 'checked="checked" ';
				} ?>>
                <span>پرداخت نقدی</span>


            </label>
            <label for="allow_add_hotel"><span class="opt_lable">شماره کارت (کارت به کارت)</span>
                <input type="number" class="opt_cart_number" name="opt_cart_number" value="<?php echo $cart_number ?>">

            </label>
            <label for="allow_add_hotel"><span class="opt_lable">  فعال بودن هتل در قالب</span>
                <select type="number" name="hotel_enable">
                    <option value="1" <?php if ( $hotel_enable == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $hotel_enable == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label for="allow_add_hotel"><span class="opt_lable">  فعال بودن تعریف هتل برای میزبان</span>
                <select type="number" name="allow_add_hotel">
                    <option value="1" <?php if ( $allow_add_hotel == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $allow_add_hotel == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            </label>
            <label for="child_select_view"><span class="opt_lable">  غیر فعال کردن نمایش تعداد خردسال در رزرو هتل</span>
                <select type="number" name="child_select_view">
                    <option value="1" <?php if ( $child_select_view == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $child_select_view == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label for="allow_add_theme_tour"><span class="opt_lable">  فعال بودن تور در قالب</span>
                <select type="number" name="allow_add_theme_tour">
                    <option value="1" <?php if ( $allow_add_theme_tour == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $allow_add_theme_tour == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label for="allow_add_theme_tour"><span class="opt_lable">  غیر فعال کردن امکانات غیر فعال اقامتگاه</span>
                <select type="number" name="disable_res_tools">
                    <option value="1" <?php if ( $disable_res_tools == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $disable_res_tools == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label for="allow_add_tour_hoster"><span class="opt_lable">  فعال بودن درج تور برای میزبان</span>
                <select type="number" name="allow_add_tour_hoster">
                    <option value="1" <?php if ( $allow_add_tour_hoster == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $allow_add_tour_hoster == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label>
                <span class="opt_lable">  تغییر باکس جستجو برای هتل تک</span>
                <select type="number" name="change_search_fsh">
                    <option value="0" <?php if ( $change_search_fsh == 0 )
						echo 'selected' ?> >خیر
                    </option>
                    <option value="1" <?php if ( $change_search_fsh == 1 )
						echo 'selected' ?>>بله
                    </option>

                </select>

            </label>
            <label for="allow_add_hotel"><span class="opt_lable">  فعال بودن هتل در قالب</span>
                <select type="number" name="hotel_enable">
                    <option value="1" <?php if ( $hotel_enable == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $hotel_enable == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>   <label for="show_map_single"><span class="opt_lable">  نمایش نقشه در برگه اقامتگاه</span>
                <select type="number" name="show_map_single">
                    <?php
                    
                    if ( $show_map_single == ''  ){
                        $showmap = 1;
                    }else{
                        $showmap=$show_map_single;
                    }
                    ?>
                    <option value="1" <?php if ( $showmap == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $showmap == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>
            
                 <label for="show_low_single"><span class="opt_lable">  نمایش مقررات لغو اقامتگاه</span>
                <select type="number" name="show_low_single">
                    <?php
                    
                    if ( $show_low_single == ''  ){
                        $showlow = 1;
                    }else{
                        $showlow=$show_low_single;
                    }
                    ?>
                    <option value="1" <?php if (  $showlow == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if (  $showlow == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>
            </label>
            <label for="b_host"><span class="opt_lable">فعال بودن گزینه میزبان شوید</span>
                <select type="number" name="b_host">
                    <?php

                    if ( $b_host == ''  ){
                        $be_host = 1;
                    }else{
                        $be_host=$b_host;
                    }
                    ?>
                    <option value="1" <?php if ($be_host == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $be_host == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select></label>  
                <label for="b_host"><span class="opt_lable"> تعداد روز فعال سازی تاریخ تقویم</span>
                <input type="number" name="update_date_days" value="<?php echo $update_date_days ?>"><span class="mr10"> روز</span>
            </label>  
            <label for="easy_one_day_before_recive"><span class="opt_lable"> درصد پرداختی به میزبان</span>
                <input type="number" name="hoster_percent" value="<?php echo $hoster_percent ?>"><span class="mr10"> درصد</span>
            </label>

            <label for="easy_one_day_before_recive"><span class="opt_lable">  زمان ارسال مجدد کد یکبار مصرف </span>
                <input type="number" name="resend_one_code_time" value="<?php echo $resend_one_code_time ?>"><span class="mr10"> ثانیه</span>
            </label>
            <label for="easy_one_day_before_recive"><span class="opt_lable"> زمان تایید درخواست توسط میزبان</span>
                <input type="number" name="answer_request_time" value="<?php echo $answer_request_time ?>"><span class="mr10"> ثانیه</span>
            </label>
            <label for="easy_one_day_before_recive"><span class="opt_lable"> زمان پرداخت مبلغ رزرو</span>
                <input type="number" name="pay_time" value="<?php echo $pay_time ?>"><span class="mr10"> ثانیه</span>
            </label>
            <label for="child_select_view"><span class="opt_lable">  ویرایشگر صفحه اقامتگاه</span>
                <select type="number" name="single_edit">
                    <option value="1" <?php if ( $single_edit == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $single_edit == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>
            <label for="require_inp_host_insert"><span class="opt_lable">الزامی کردن فیلدهای ثبت اقامتگاه</span>
                <select type="number" name="require_inp_host_insert">
                    <option value="1" <?php if ( $require_inp_host_insert == 1 )
						echo 'selected' ?>>بله
                    </option>
                    <option value="0" <?php if ( $require_inp_host_insert == 0 )
						echo 'selected' ?>>خیر
                    </option>
                </select>

            </label>

            <label for="low_view_text"><span class="opt_lable">  متن شرایط و مقررت ثبت نام</span>
                <input type="text" name="low_view_text" class="w400px" value="<?php  echo $low_view_text ?>">

            </label>
            <label for="low_view_link_text"><span class="opt_lable">  متن لینک شرایط و مقررات</span>
                <input type="text" name="low_view_link_text" class="w400px" value="<?php  echo $low_view_link_text ?>">

            </label>
            <label for="low_view_link"><span class="opt_lable">   لینک برگه شرایط و مقررات</span>
                <input type="text" name="low_view_link" class="w400px" value="<?php  echo $low_view_link ?>">

            </label>
        </div>
        <hr>
        <p class="fw300 fz12 mt_10">موقعیت مکانی پیش فرض نقشه های را روی نقشه مشخص نمایید..</p>
		<?php
		$lat = $bsmlat;
		$lng = $bsmlang;
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
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
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
            L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {
                maxZoom: 19,
                attribution: '',
            }).addTo(map);
            // map.addControl(L.control.search({ position: 'topright' }));
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

        <button type="submit" name="cancel_reserve_submit" class="cancel_reserve_submit">ذخیره</button>

        </div>

    </form>
<?php


