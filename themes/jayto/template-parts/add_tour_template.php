<?php
/* Template Name:Add Tour Template */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$user_role = '';
$rol       = jayto_get_current_user_role();
$tour_enable = get_option( 'allow_add_theme_tour' );
$show_bhost=get_option('b_host');
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
if ( in_array( 'host', $rol ) ) {
	$user_role = 'host';
}

get_header( 'single' );
//$urer             = get_currentuserinfo();
$user_id = get_current_user_id();

$loyer = get_terms( array(
	'taxonomy'   => 'loyer',
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
                                   if ($tour_enable){ ?>
                                       <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های من</a>
                                   <?php }
                                   ?>
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
							<span class="prb_menu_item active">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 "><?php echo _e( 'اقامت گاه های من', 'jayto' ) ?></span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'لیست تجربه', 'jayto' ) ?> </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 ">
 </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<?php
							$allow_add_hotel = get_option( 'allow_add_hotel' );
							if ( $allow_add_hotel == 1 ) { ?>
								<span class="prb_menu_item ">
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
							<?php
							if ($allow_add_tour_hoster == 1){ ?>
                                <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-tree"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 ">تجربه های من</span>
                            <a href="<?php echo home_url(); ?>/my-experiences" class="fz11 fw300 col_gray mbt10 ">لیست تجربه ها </a>
                            <a href="<?php echo home_url(); ?>/add_experiences" class="fz11 fw300 col_gray mbt10 ">ثبت تجربه  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<?php    }
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
								<span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'لیست تجربه های مرد علاقه', 'jayto' ) ?></span>

							</div>
						</a>
					</div>
					<?php
					if ( $user_role != 'host' ) {
						?>
						<div class="prb_menu_section">
							<?php
							if ( $show_bhost == 1 || $show_bhost == '' ) {
								?>
                                <p class='fz10 fw300 col_gray mbt10'><?php echo _e( 'میزبانی اقامتگاه', 'jayto' ) ?></p>
                                <a href='#' class='prb_menu_item cr-host'>
                                    <span class='prb_icon'><i class='fa fa-exchange '></i></span>
                                    <div class='prb_menu_container'>
                                        <span class='fz12 fw700 col_gray2'><?php echo _e( 'میزبان شوید', 'jayto' ) ?></span>
                                        <span

                                                class='fz10 fw300 col_gray mbt10'><?php echo _e( 'همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد کنید.', 'jayto' ) ?></span>

                                    </div>
                                </a>   <p class='fz10 fw300 col_gray mbt10'><?php echo _e( 'میزبانی اقامتگاه', 'jayto' ) ?></p>
                                <a href='#' class='prb_menu_item cr-host'>
                                    <span class='prb_icon'><i class='fa fa-exchange '></i></span>
                                    <div class='prb_menu_container'>
                                        <span class='fz12 fw700 col_gray2'><?php echo _e( 'میزبان شوید', 'jayto' ) ?></span>
                                        <span

                                                class='fz10 fw300 col_gray mbt10'><?php echo _e( 'همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد کنید.', 'jayto' ) ?></span>

                                    </div>
                                </a>
							<?php }
							?>
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
						</div>
					</div>
				</div>
			</div>
		<?php }
		?>


		<div class="prb_content">
			<div class="mh_head_back">
				<p class="fw700 fz15">ثبت تجربه</p>
				<?php
				if ( wp_is_mobile() ) { ?>
					<a href="<?php echo home_url() ?>/macount"> <i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i></a>

				<?php }
				?>
			</div>

			<div class="input_add_h">
				<span class="ip_title ">نام تجربه</span>
				<input type="text" style="text-align: right;width: 97%;margin-bottom: 10px;" value="" class="input_temp host_name_inp" autocomplete="off" placeholder="نام تجربه">
			</div>
			<div class="input_add_h">
				<span class="ip_title">توضیحات تجربه</span>
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


				?>
			</div>

            <p>

            <div class="up_feauture_imgage_box">

                <div class="hdiv"><span class="mt_20 fz16">تصویر اصلی تجربه.</span></div>

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


            </p>
            <p>
            <div class="up_feauture_imgage_box">
                <div class="hdiv"><span class="mt_20 fz16">گالری تصاویر تجربه.</span></div>
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

            </p>
            <div class="input_add_h">
                <span class="ip_title">ویژگی های تجربه</span>

                <div class='inside' xmlns="http://www.w3.org/1999/html">
                    <p>
                        <label>جای تجربه</label>
                        <input class="width100" type="text" name="tour_place_opt"  placeholder="جای تجربه را وارد کنید مثلا گیلان روستای بیشه">
                    </p>
                    <p>
                        <label>چالش فیزیکی</label>
                        <select name="Physical_challenge">
                            <option value="کم" > کم </option>
                            <option value="متوسط"  >متوسط </option>

                            <option value="زیاد" >زیاد</option>
                        </select>
                    </p>
                    <p>
                        <label>مناسب برای</label>
                        <select name="age_need">
                            <option value="همه سنین" > همه سنین </option>
                            <option value="18 سال به بالا" >18 سال به بالا  </option>

                        </select>
                    </p>
                    <p>
                        <label> مدت تجربه (ساعت / روز)</label>
                        <select name="tour_time">
							<?php
							for ( $i = 1; $i < 24; $i ++ ) {
								?>
                                <option value="<?php echo $i ?>" <?php if ( $tmeta['tour_time'] == $i )
									echo "selected" ?>><?php echo $i ?> </option>
							<?php }
							?>

                            <option value="one_day" <?php if ( $tmeta['tour_time'] == 'one_day' )
								echo "selected" ?> >یک روز
                            </option>
                            <option value="tow_day" <?php if ( $tmeta['tour_time'] == 'tow_day' )
								echo "selected" ?>>دو روز
                            </option>
                            <option value="three_day" <?php if ( $tmeta['tour_time'] == 'three_day' )
								echo "selected" ?>>سه روز
                            </option>
                            <option value="four_day" <?php if ( $tmeta['tour_time'] == 'four_day' )
								echo "selected" ?>چهار> روز
                            </option>


                        </select>
                    </p>
                    <p>
                        <label>  حد اکثر ظرفیت هر سانس  (نفر)</label>
                        <select name="tour_capacity">
			                <?php
			                for ($i=1;$i<24 ;$i++){?>
                                <option value="<?php echo $i?>"  <?php if ($tmeta['tour_capacity'] == $i) echo "selected" ?>><?php  echo $i?> </option>
			                <?php }
			                ?>
                        </select>
                    </p>
                    <p>
                        <label>قیمت برای هر نفر (تومان)</label>
                        <input type="number" name="tour_price" class="tour_price">
                    </p>

                    <p>
                        <label>قیمت تور دربست (تومان)</label>
                        <input type="number" name="tour_shutter_price" class="tour_shutter" value="<?php echo $tmeta['tour_shutter_price'] ?>" >
                    </p>
                    <p >
                        <label> لوازمی که حتما باید همراه آورده شود.آیتم ها را با خط فاصله جدا کنید</label>
                        <textarea class="necessary_supplies w80p"   name="necessary_supplies"><?php echo $tmeta['necessary_supplies'] ?></textarea>
                    </p>
                    <p >
                        <label> لوازمی که پیشنهاد میشود همراه آورده شود .آیتم ها را با خط فاصله جدا کنید</label>
                        <textarea class="proposal_supplies w80p"  name="proposal_supplies"><?php echo $tmeta['proposal_supplies'] ?></textarea>
                    </p>

                    <p>
                        <label> آدرس :</label>
                        <input type="text" class="w80p text_before"  name="tour_address" placeholder="آدرس یا محل قرار را وارد نمایید " value="<?php echo $tmeta['tour_address'] ?>">
                    </p>
                    <p>
                        <label> عنوان قبل از نقشه</label>
                        <input type="text" class= "w80p text_before"   name="text_before" placeholder="با هم حوالی لاهیجان قرار می‌گذاریم. " value="<?php echo $tmeta['text_before'] ?>">
                    </p>
                    <p class="fw700 fz16">موقعیت مکانی</p>
                    <p class="fw300 fz12 mt_10"><?php  echo $tmeta['text_before']?>لوکیشن دقیق بعد از ثبت نام براتون ارسال می‌شه.</p>
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
							<li id="city-234" class="eadf"><label class="selectit fw700 fz13 city_pb"><input value="<?php echo $term->term_id ?>" type="checkbox" name="tax_input[city][]" id="in-city-<?php echo $term->term_id ?>"><?php echo $term->name ?> </label></li>
							<?php
							$terms_child = get_terms( array(
								'taxonomy'   => 'city',
								'parent'     => $term->term_id,
								'hide_empty' => false,
							) );
							echo '<ul>';
							foreach ( $terms_child as $child ) {
								?>


								<li id="city-<?php echo $child->term_id ?>"><label class="selectit mbchild"><input value="<?php echo $child->term_id ?>" type="checkbox" name="tax_input[city][]" id="in-city-<?php echo $child->term_id ?>"> <?php echo $child->name ?></label></li>
							<?php }
							echo '</ul>';
							?>

						<?php }
					}
					?>

				</div>


			</div>

			<div class="input_add_h">
				<span class="ip_title">نوع تجربه</span>
				<div class="term_drop_flex">

					<?php
					$terms_cat = get_terms( array(
						'taxonomy'   => 'tour_category',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'tour',
					) );

					if ( ! is_wp_error( $terms_cat ) && ! empty( $terms_cat ) ) {
						foreach ( $terms_cat as $term ) {
							?>
							<?php
							$terms_cat_child = get_terms( array(
								'taxonomy'   => 'tour_category',
								'parent'     => $term->term_id,
								'hide_empty' => false,
								'post_type'  => 'tour',
							) );
							?>

							<?php
							if ( $terms_cat_child ) {
								if ( $terms_cat_child ) {
									foreach ( $terms_cat_child as $child ) {

										?>
										<div class="city_item">
											<div id="category-<?php echo $child->term_id ?>" class="citbox">
												<?php
										 	$cat_image = get_term_meta( $child->term_id, 'term_ico', true );
												?>
												<img src="<?php echo $cat_image ?>" alt="">
												<label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[categories][]" id="in-city-<?php echo $child->term_id ?>">
												</label>
											</div>

											<span><?php echo $child->name ?></span>
										</div>

									<?php }
								} else {
									foreach ( $terms_cat as $child ) {

										?>
										<div class="city_item">
											<div id="category-<?php echo $child->term_id ?>" class="citbox">
												<?php
												$cat_image = get_term_meta( $child->term_id, 'term_ico', true );
												?>
												<img src="<?php echo $cat_image ?>" alt="">
												<label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[categories][]" id="in-city-<?php echo $child->term_id ?>">
												</label>
											</div>

											<span><?php echo $child->name ?></span>
										</div>

									<?php }
								}
							}


							?>

						<?php }
					}
					if (!$terms_cat_child){
						foreach (
							$terms_cat

							as $child
						) {
							?>

							<div class="city_item">
								<div id="category-<?php echo $child->term_id ?>" class="citbox">
									<?php
									$cat_image = get_term_meta( $child->term_id, 'term_image', true );
									?>
									<img src="<?php echo $cat_image ?>" alt="">
									<label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[categories][]" id="in-city-<?php echo $child->term_id ?>">
									</label>
								</div>

								<span><?php echo $child->name ?></span>
							</div>


						<?php }
					}
					?>

				</div>

			</div>

			<div class="input_add_h">
				<span class="ip_title"> منطقه تجربه</span>

				<div class="term_drop_flex">
					<?php
					$terms_region = get_terms( array(
						'taxonomy'   => 'region',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'residence',
					) );
					if ( ! is_wp_error( $terms_region ) && ! empty( $terms_region ) ) {
						foreach ( $terms_region as $term ) {

							?>
							<div class="city_item">
								<div id="city-<?php echo $term->term_id ?>" class="citbox">
									<?php
									$cat_image = get_term_meta( $term->term_id, 'term_image', true );
									?>
									<img src="<?php echo $cat_image ?>" alt="">
									<label class="selectit cb_chile "> <input value="<?php echo $term->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[region][]" id="in-city-<?php echo $term->term_id ?>">
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
				<span class="ip_title">امکانات تجربه</span>

				<div class="term_drop_flex">
					<?php
					$terms_tools = get_terms( array(
						'taxonomy'   => 'tour_tools',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'tour',
					) );
					if ( ! is_wp_error( $terms_cat ) && ! empty( $terms_cat ) ) {
						foreach ( $terms_tools as $term ) {

							?>
							<div class="city_item">
								<div id="city-<?php echo $term->term_id ?>" class="citbox">
									<?php
									$tools_image = get_term_meta( $term->term_id, 'term_image', true );
									?>
									<img style="width: 35px;height: 35px;border-radius: 7px;object-fit: cover;" src="<?php echo $tools_image ?>" alt="">
									<label class="selectit cb_chile "> <input value="<?php echo $term->term_id ?>" type="checkbox" class="inpcheck" name="tax_input[tools][]" id="in-city-<?php echo $term->term_id ?>">
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
				<span class="ip_title ">آدرس تجربه</span>

				<input type="text" style="width: 96%;margin-bottom: 20px;text-align: right" name="res_address" value="" class="input_temp host_name_inp" autocomplete="off">
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


			<span id="tour_insert_post_btn">ذخیره</span>
		</div>


	</div>

<?php
get_footer();