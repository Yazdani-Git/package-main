<?php
/* Template Name:Add Hotel */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$user_role = '';
$rol       = jayto_get_current_user_role();

if ( in_array( 'host', $rol ) ) {
	$user_role = 'host';
}

get_header( 'single' );
//$urer             = get_currentuserinfo();
$user_id = get_current_user_id();

$loyer = get_terms( array(
	'taxonomy'   => 'hotel_loyer',
	'hide_empty' => false,
) );
$rol   = jayto_get_current_user_role();

if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
}
?>

    <div class="profile_box">
<?php
if ( ! wp_is_mobile() ) { ?>
    <div class="prb_menu">
        <div class="prb_menu_body">
            <div class="prb_menu_section">
                 <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'لیست سفرها و درخواست ها', 'jayto' ) ?></span>
                            <a href="<?php echo home_url(); ?>/trips" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'سفرهای من', 'jayto' ) ?></a>
                            <?php
                            if ( $user_role == 'host' ) {
	                            ?>
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 ">  <?php echo _e( 'درخواست ها', 'jayto' ) ?></a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
                            <?php }
                            ?>

                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>

				<?php
				if ( $user_role == 'host' ) {
					?>
                    <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 "><?php echo _e( 'اقامت گاه های من', 'jayto' ) ?></span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'لیست اقامتگاه', 'jayto' ) ?> </a>
                                                        <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10"><?php echo _e( 'ثبت اقامتگاه', 'jayto' ) ?> </a>


                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
					<?php
					$allow_add_hotel = get_option( 'allow_add_hotel' );
					if ( $allow_add_hotel == 1 ) { ?>
                        <span class="prb_menu_item active">
                        <span class="prb_icon"><i class=" fas fa-hotel"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 ">هتل های من</span>
                            <a href="<?php echo home_url(); ?>/my-hotel" class="fz11 fw300 col_gray mbt10 ">لیست هتل ها </a>
                            <a href="<?php echo home_url(); ?>/add_hotel" class="fz11 fw300 col_gray mbt10 ">ثبت هتل  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
					<?php }
					?>

				<?php }
				?>
        <?php
                  if ( $user_role == 'host' ) { ?>
                <span class="prb_menu_item ">
                    <span class="prb_icon"><i class="fas fa-comment"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'نظرات و تیکت ها', 'jayto' ) ?></span>
                        <a href="<?php echo home_url(); ?>/host_comment" class="fz10 fw300 col_gray mbt10 ">
                            <?php echo _e( 'نظرات', 'jayto' ) ?></a>
                        <a href="<?php echo home_url(); ?>/user_ticket" class="fz10 fw300 col_gray mbt10 ">
                            <?php echo _e( 'تیکت پشتیبانی', 'jayto' ) ?></a>
                        <span class="line_dash mbt10"></span>
                    </div>
                </span>
                <?php } ?>
                <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item">
                    <span class="prb_icon"><i class="fa fa-heart"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'موردعلاقه ها', 'jayto' ) ?></span>
                        <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'لیست اقامتگاه های مرد علاقه', 'jayto' ) ?></span>

                    </div>
                </a>
            </div>
			<?php
			if ( $user_role != 'host' ) {
				?>
                <div class="prb_menu_section">
                    <p class="fz11 fw300 col_gray mbt10"><?php echo _e( 'میزبانی اقامتگاه', 'jayto' ) ?></p>
                    <a href="#" class="prb_menu_item">
                        <span class="prb_icon"><i class="fa fa-exchange "></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'میزبان شوید', 'jayto' ) ?></span>
                            <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد کنید.', 'jayto' ) ?></span>

                        </div>
                    </a>
                </div>
			<?php }
			?>
            <div class="prb_menu_section">
                <p class="fz11 fw300 col_gray mbt10"><?php echo _e( 'حساب کاربری', 'jayto' ) ?></p>
                <a href="<?php echo home_url(); ?>/account" class="prb_menu_item ">
                    <span class="prb_icon"><i class="fa fa-user-alt"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'اطلاعات حساب کاربری', 'jayto' ) ?></span>
                        <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'مشاهده و ویرایش حساب کاربری', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>

                </a>
                <a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item">

                    <span class="prb_icon"><i class="fa fa-file-text "></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'تراکنش های من', 'jayto' ) ?></span>
                        <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'مشاهده زمان و تاریخ تراکنش ها', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <a href="<?php echo home_url() ?>/password" class="prb_menu_item">
                    <span class="prb_icon"><i class="fa fa-key"></i></span>
                    <div class="prb_menu_container">
                        <span class="fz12 fw700 col_gray2"><?php echo _e( 'رمز عبور', 'jayto' ) ?></span>
                        <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'تنظیم و تغییر رمز عبور', 'jayto' ) ?></span>
                        <span class="line_dash mbt10"></span>
                    </div>
                </a>
                <div class="prb_menu_section">
                    <p class="fz11 fw300 col_gray mbt10"><?php echo _e( 'اعتبار', 'jayto' ) ?></p>
                    <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-wallet"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'کیف پول', 'jayto' ) ?></span>
                            <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'موجودی،افزایش اعتبار', 'jayto' ) ?></span>

                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-ban"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'مسدود شده ها', 'jayto' ) ?></span>
                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'درخواست وجه', 'jayto' ) ?></span>


                        </div>
                    </a>
                    <a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'لیست درخواست وجه', 'jayto' ) ?></span>


                        </div>
                    </a>
                    <a href='<?php echo home_url(); ?>/user note' class='prb_menu_item '>
                        <span class='prb_icon'><i class="fa-solid fa-envelope"></i></span>
                        <div class='prb_menu_container'>
                            <span class='fz12 fw700 col_gray2'><?php echo _e( 'پیام ها', 'jayto' ) ?></span>
                            <span

                                    class='fz10 fw300 col_gray mbt10'><?php echo _e( 'مشاهده پیام های مدیریتی', 'jayto' ) ?></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
<?php }
?>


    <div class="prb_content">
        <div class="mh_head_back">
            <p class="fw700 fz15">ثبت هتل</p>
			<?php
			if ( wp_is_mobile() ) { ?>
                <a href="<?php echo home_url() ?>/macount"> <i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i></a>

			<?php }
			?>
        </div>

        <div class="input_add_h">
            <span class="ip_title ">نام هتل</span>
            <input type="text" style="text-align: right;width: 97%;margin-bottom: 10px;" value="" class="input_temp hotel_name_inp" autocomplete="off" placeholder="نام هتل">
        </div>
        <div class="input_add_h">
            <span class="ip_title">توضیحات هتل</span>
			<?php
			$content            = "";
			$custom_editor_id   = "add_hot";
			$custom_editor_name = "add_hotel_description";
			$args               = array(
				'media_buttons' => false, // This setting removes the media button.
				'textarea_name' => $custom_editor_name, // Set custom name.
				'textarea_rows' => get_option( 'default_post_edit_rows', 10 ), //Determine the number of rows.
				'quicktags'     => false, // Remove view as HTML button.
			);
			wp_editor( $content, $custom_editor_id, $args );
			$loyer = get_terms( array(
				'taxonomy'   => 'hotel_loyer',
				'hide_empty' => false,
			) );

			?>
        </div>

        <div class="up_feauture_imgage_box">

            <div class="hdiv"><span class="mt_20 fz16">تصویر اصلی هتل.</span></div>

            <form class="thumbnailUpload" enctype="multipart/form-data">

                <div class="thumbnail_form-group">

                    <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                    <input type="file" id="file" accept="image/*"/>
                    <input type="hidden" class="attach_url">
                </div>
            </form>
            <div class="img_box_show">
                <div class="rorp_not">
                    <span class="rorp_notic"></span>
                </div>
            </div>

        </div>


            <div class="up_feauture_imgage_box">
                <div class="hdiv"><span class="mt_20 fz16">گالری تصاویر هتل.</span></div>
                <form class="thumbnailUpload" enctype="multipart/form-data">

                    <div class="thumbnail_form-group">

                        <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                        <input type="file" multiple id="files" name="files[]" enctype="multipart/form-data" accept="image/*"/>
                        <input type="hidden" class="attach_url">
                    </div>
                </form>
                <div class="img_box_show_gall">

                    <div class="gup_not">
                        <span class="gup_notic"></span>
                    </div>
                </div>

            </div>



            <div class="input_add_h">
                <span class="ip_title">ویژگی های اقامتگاه</span>
                <div class="rooms_item_box">
                    <label class="fz12">نوع رزرو</label>
                    <select name="hotel_reserve_type">
                        <option value="0" <?php if ( $meta['type'] == 0 )
				            echo 'selected' ?> >قطعی
                        </option>
                        <option value="1" <?php if ( $meta['type'] == 1 )
				            echo 'selected' ?>>نیاز به تایید
                        </option>
                    </select>
                </div>
                <div class="rooms_item_box">
                    <label class="fz12">تعداد ستاره ها</label>
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
                    <label class="fz12">ساعت ورود</label>
                    <select name="in_clock">
			            <?php
			            for ( $i = 1; $i <= 24; $i ++ ) {
				            ?>
                            <option value="<?php echo $i ?>" <?php if ( $meta['in_clock'] == $i )
					            echo 'selected' ?> ><?php echo $i ?> </option>
			            <?php }
			            ?>


                    </select>
                </div>
                <div class="rooms_item_box">
                    <label class="fz12">ساعت خروج</label>
                    <select name="out_clock" class="fz12">
			            <?php
			            for ( $i = 1; $i <= 24; $i ++ ) {
				            ?>
                            <option value="<?php echo $i ?>"<?php if ( $meta['out_clock'] == $i )
					            echo 'selected' ?> ><?php echo $i ?> </option>
			            <?php }
			            ?>



                    </select>
                </div>
                <div class="rooms_item_box">
                    <label class="fz12">برای کودکان چند سال به بالا تخت کامل درنظر گرفته میشود؟</label>
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


            </div>

            <div class="input_add_h">
                <span class="ip_title">انتخاب شهر/ استان</span>

                <div class="term_drop">
					<?php
					$terms = get_terms( array(
						'taxonomy'   => 'city',
						'parent'     => '0',
						'hide_empty' => false,
					) );
					if ( ! is_wp_error( $terms ) && ! empty( $terms ) ) {

						foreach ( $terms as $term ) {

							?>
                            <li id="city-234" class="eadf"><label class="selectit fw700 fz13 city_pb"><input value="<?php echo $term->term_id ?>" type="checkbox" name="tax_input[city_hotel][]" id="in-city-<?php echo $term->term_id ?>"><?php echo $term->name ?> </label></li>
							<?php
							$terms_child = get_terms( array(
								'taxonomy'   => 'city',
								'parent'     => $term->term_id,
								'hide_empty' => false,
							) );
							echo '<ul>';
							foreach ( $terms_child as $child ) {
								?>


                                <li id="city-<?php echo $child->term_id ?>"><label class="selectit mbchild"><input value="<?php echo $child->term_id ?>" type="checkbox" name="tax_input[city_hotel][]" id="in-city-<?php echo $child->term_id ?>"> <?php echo $child->name ?></label></li>
							<?php }
							echo '</ul>';
							?>

						<?php }
					}
					?>

                </div>


            </div>

            <div class="input_add_h">
                <span class="ip_title">نوع هتل</span>
                <div class="term_drop_flex">

					<?php
					$terms_cat = get_terms( array(
						'taxonomy'   => 'hotel_category',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'residence',
					) );
					if ( ! is_wp_error( $terms_cat ) && ! empty( $terms_cat ) ) {
						foreach (
							$terms_cat

							as $term
						) {
							?>
							<?php
							$terms_cat_child = get_terms( array(
								'taxonomy'   => 'hotel_category',
								'parent'     => $term->term_id,
								'hide_empty' => false,
								'post_type'  => 'hotel',
							) );
							?>

							<?php
							foreach ( $terms_cat_child as $child ) {

								?>
                                <div class="city_item">
                                    <div id="category-<?php echo $child->term_id ?>" class="citbox">
										<?php
										$cat_image = get_term_meta( $child->term_id, 'term_image', true );
										?>
                                        <img src="<?php echo $cat_image ?>" alt="">
                                        <label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[hotel_category][]" id="in-city-<?php echo $child->term_id ?>">
                                        </label>
                                    </div>

                                    <span><?php echo $child->name ?></span>
                                </div>

							<?php }

							?>

						<?php }
					}
					?>
                </div>

            </div>


            <div class="input_add_h">
                <span class="ip_title">امکانات اقامتگاه</span>

                <div class="term_drop_flex">
					<?php
					$terms_tools = get_terms( array(
						'taxonomy'   => 'hotel_tools',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'residence',
					) );
					if ( ! is_wp_error( $terms_cat ) && ! empty( $terms_cat ) ) {
						foreach ( $terms_tools as $term ) {

							?>
                            <div class="city_item">
                                <div id="city-<?php echo $term->term_id ?>" class="citbox">
									<?php
									$tools_image = get_term_meta( $term->term_id, 'term_image', true );
									?>
                                    <img style="width: 35px;height: 35px;border-radius: 7px;object-fit: none;" src="<?php echo $tools_image ?>" alt="">
                                    <label class="selectit cb_chile "> <input value="<?php echo $term->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[hotel_tools][]" id="in-city-<?php echo $term->term_id ?>">
                                    </label>
                                </div>

                                <span><?php echo $term->name ?></span>
                            </div>


						<?php }
					}
					?>

                </div>


            </div>
            <div class="input_add_h">
                <span class="ip_title ">آدرس اقامتگاه</span>

                <input type="text" style="width: 96%;margin-bottom: 20px;text-align: right" name="hotel_name_inp" value="" class="input_temp hotel_name_inp" autocomplete="off">
            </div>
            <!--            <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin=""/>-->
            <!--            <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js" integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>-->
             <script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
            <div class="input_add_h">
                <span class="ip_title ">نقشه اقامتگاه</span>
                <div id="add_host_map">
                </div>
                <style>
                    #add_host_map {
                        height: 300px;
                        border-radius: 12px;
                        margin: 20px 0;
                        width: 96%;
                    }
                </style>

                <script>
					<?php
	         $bsmlat =get_option( 'bsmlat' );
             $bsmlang =get_option( 'bsmlang' );
             $lat = $bsmlat;
              $lng = $bsmlang;
             if ( ! $lat ) {
             $lat = 35.7009;
             }
             if ( ! $lng ) {
                $lng = 51.3912;
              }

					?>
                    var greenIcon = L.icon({
                        iconUrl: '<?php echo get_template_directory_uri(); ?>/images//pointssv.svg',
                        shadowUrl: 'leaf-shadow.png',
                        iconSize: [90, 90], // size of the icon
                        shadowSize: [50, 64], // size of the shadow
                        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62],  // the same for the shadow
                        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor


                    });
                    let map = L.map('add_host_map').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
                    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {

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
                <input type="hidden" name="map_point_lat" class="map_point_lat">
                <input type="hidden" name="map_point_lng" class="map_point_lng">
            </div>
            <div class="input_add_h">
                <span class="ip_title ">قوانین اقامتگاه</span>
                <div class="other_plans">
					<?php
					foreach ( $loyer as $row ) {

						?>
                        <div class="od_box">
                            <input type="checkbox" name="tax_input[od_loyer][]" value="<?php echo $row->term_id; ?>"/>
                            </label><?php echo $row->name; ?> <label>
                        </div>
					<?php }
					?>
                </div>


            </div>


            <div class="up_feauture_imgage_box">
                <div class="hdiv"><span class="mt_20 fz16"> تصویر کارت ملی خود را آپلود نمایید (شما باید مالک یا نماینده قانونی ملک باشید).</span></div>
                <form class="thumbnailUpload" enctype="multipart/form-data">

                    <div class="thumbnail_form-group">

                        <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                        <input type="file" id="melli_file" accept="image/*"/>
                        <input type="hidden" class="attach_url">
                    </div>
                </form>
                <div class="img_meli_show">

                </div>

            </div>
            <div class="up_feauture_imgage_box">
                <div class="hdiv"><span class="mt_20 fz16">تصویر مجوز های هتل را بارگذاری نمایید.</span></div>
                <form class="thumbnailUpload" enctype="multipart/form-data">

                    <div class="thumbnail_form-group">

                        <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                        <input type="file" multiple id="madarek_files" name="files[]" enctype="multipart/form-data" accept="image/*"/>
                        <input type="hidden" class="attach_url">
                    </div>
                </form>
                <div class="madarek_box_show_gall">

                </div>

            </div>

            <span id="hotel_insert_post_btn">ذخیره</span>

        </div>


    </div>

<?php
get_footer();