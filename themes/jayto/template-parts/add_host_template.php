<?php
/* Template Name:Add Host */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$user_role = '';
$rol       = jayto_get_current_user_role();

if ( in_array( 'host', $rol ) ) {
	$user_role = 'host';
}
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
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
                            <?php if ( $user_role == 'host' ) {   ?>
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 ">  <?php echo _e( 'درخواست ها', 'jayto' ) ?></a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
                            <?php }   ?>

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
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'لیست اقامتگاه', 'jayto' ) ?> </a>
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
                <p class="fw700 fz15">ثبت اقامتگاه</p>
				<?php
				if ( wp_is_mobile() ) { ?>
                    <a href="<?php echo home_url() ?>/macount"> <i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i></a>

				<?php }
				?>
            </div>

            <div class="input_add_h">
                <span class="ip_title ">نام اقامتگاه</span>
                <input type="text" style="text-align: right;width: 97%;margin-bottom: 10px;" value="" class="input_temp host_name_inp" autocomplete="off" placeholder="نام اقامتگاه">
            </div>
            <div class="input_add_h">
                <span class="ip_title">توضیحات اقامتگاه</span>
				<?php
				$content            = "";
				$custom_editor_id   = "add_hd";
				$custom_editor_name = "add_host_description";
				$args               = array(
					'media_buttons' => false, // This setting removes the media button.
					'textarea_name' => $custom_editor_name, // Set custom name.
					'textarea_rows' => get_option( 'default_post_edit_rows', 10 ), //Determine the number of rows.
					'quicktags'     => false, // Remove view as HTML button.
				);
				wp_editor( $content, $custom_editor_id, $args );
				$loyer = get_terms( array(
					'taxonomy'   => 'loyer',
					'hide_empty' => false,
				) );

				?>
            </div>

            <div class="input_add_h">
                <span class="ip_title">ویژگی های اقامتگاه</span>

                <div class='inside' xmlns="http://www.w3.org/1999/html">
                    <p>
                        <label>متراژ زیربنا (متر) </label>
                        <input type="text" name="The_area_of_meter" value="10"/>
                    </p>
                    <p>
                        <label>متراژ کل بنا (متر) </label>
                        <input type="text" name="total_area_of_building_meter" value="10"/>
                    </p>
                    <p>
                        <label>نوع اقامتگاه </label>

                        <select name="residence_type" class="w12em" id="residence_type">
                            <option value="shutter_type" selected>دربست
                            </option>
                            <option value="shared_type">اشتراکی</option>
                        </select>
                    </p>
                    <p>
                        <label>نوع رزرو </label>
                        <select name="reserve_type" class="w12em" id="reserve_type">
                            <option value="0" selected>قطعی
                            </option>
                            <option value="1">نیاز به تایید</option>
                        </select>
                    </p>
                    <p>
                        <label>انتخاب قوانین لغو </label>

                        <select name="cancel_type" class="w12em" id="cancel_type">
                            <option value="easy" selected>آسان</option>
                            <option value="medium">متوسط</option>
                            <option value="hard">سخت</option>
                        </select>
                        <span class="btn_view_low">مشاهده قوانین لغو</span>
                    <div class="view_low_box">
                        <div class="cbc_box">
                            <span class="cancel_box_close_form"><i class="fa fa-close"></i></span>
                        </div>
						<?php

						require get_template_directory() . '/template-parts/view_host_low_template.php';
						?>


                    </div>


                    <div class="pm_box">
                        <label>ظرفیت پایه (نفر) </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="base_capacity" value="1"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>حداکثرظرفیت(ظرفیت پایه + نفر اضافه) </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="total_capacity" value="1"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>تعداد اتاق ها </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="number_room" value="1"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>تعداد تخت های یک نفره </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="Single_bed" value="1"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>تعداد تخت های دو نفره </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="double_bed" value="0"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>تعداد رختخواب سنتی(تشک) </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="mattress" value="0"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>حمام </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="Bathroom" value="0"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>سرویس بهداشتی ایرانی </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="iranian_toilet" value="1"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>


                    <div class="pm_box">
                        <label>سرویس بهداشتی فرنگی </label>
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="sitting_toilet" value="0"/>
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>

                    <p>
                        <label> قیمت (هر شب) برای روزهای عادی (تومان)</label>

                        <input type="number" name="price" value=""/>
                        <span class="res_inp_note">این قیمت برای تمامی روزهای عادی تقویم شما به مدت 60 روز اعمال خواهد شد. </span>
                    </p>
                    <p>
                        <label> قیمت برای روزهای آخر هفته (تومان)</label>
                        <input type="number" name="end_week_price" value=""/>
                        <span class="res_inp_note">این قیمت برای تمامی روزهای آخر هفته تقویم شما به مدت 60 روز اعمال خواهد شد. </span>
                    </p>


                    <p>
                        <label> قیمت برای نفرات اضافی (هرنفر تومان)</label>
                        <input type="number" name="extra_person" value=""/>
                    </p>
                    <p>
                        <label>ساعت ورود</label>
                        <select name="in_clock" class="w12em">

							<?php
							for ( $i = 1; $i <= 24; $i ++ ) { ?>

                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php }
							?>

                        </select>
                    </p>
                    <p>
                        <label>ساعت خروج</label>
                        <select name="out_clock" class="w12em">
							<?php
							for ( $i = 1; $i <= 24; $i ++ ) { ?>

                                <option value="<?php echo $i ?>"><?php echo $i ?></option>
							<?php }
							?>


                        </select>
                    </p>

                    <p>

                    <div class="up_feauture_imgage_box">

                        <div class="hdiv"><span class="mt_20 fz16">تصویر اصلی اقامتگاه.</span></div>

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
                        <div class="hdiv"><span class="mt_20 fz16">گالری تصاویر اقامتگاه.</span></div>
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


                    <input type="hidden" name="map_point_lat" class="map_point_lat">
                    <input type="hidden" name="map_point_lng" class="map_point_lng">
                </div>


            </div>

 
    <div class="input_add_h">
    <span class="ip_title">انتخاب شهر/استان</span>

    <input type="text" id="city-search-box" placeholder="نام شهر یا استان را وارد کنید..." class="search-input">

    <div class="term_drop">
        <ul id="city-list">
            <?php
            $terms = get_terms(array(
                'taxonomy'   => 'city',
                'parent'     => '0',
                'hide_empty' => false,
            ));
            if (!is_wp_error($terms) && !empty($terms)) {
                foreach ($terms as $term) { ?>
                    <li id="city-<?php echo $term->term_id ?>" class="eadf parent-term">
                        <label class="selectit fw700 fz13 city_pb">
                            <input value="<?php echo $term->term_id ?>" type="checkbox" name="tax_input[city][]" id="in-city-<?php echo $term->term_id ?>">
                            <?php echo $term->name ?>
                        </label>

                        <ul class="child-terms">
                            <?php
                            $terms_child = get_terms(array(
                                'taxonomy'   => 'city',
                                'parent'     => $term->term_id,
                                'hide_empty' => false,
                            ));
                            foreach ($terms_child as $child) { ?>
                                <li id="city-<?php echo $child->term_id ?>" class="child-term">
                                    <label class="selectit mbchild">
                                        <input value="<?php echo $child->term_id ?>" type="checkbox" name="tax_input[city][]" id="in-city-<?php echo $child->term_id ?>">
                                        <?php echo $child->name ?>
                                    </label>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                <?php }
            }
            ?>
        </ul>
    </div>
   </div>


            <div class="input_add_h">
                <span class="ip_title">نوع اقامتگاه</span>
                <div class="term_drop_flex">

					<?php
					$terms_cat = get_terms( array(
						'taxonomy'   => 'categories',
						'parent'     => '0',
						'hide_empty' => false,
						'post_type'  => 'residence',
					) );
					if ( ! is_wp_error( $terms_cat ) && ! empty( $terms_cat ) ) {
						foreach ( $terms_cat as $term ) {
							?>
							<?php
							$terms_cat_child = get_terms( array(
								'taxonomy'   => 'categories',
								'parent'     => $term->term_id,
								'hide_empty' => false,
								'post_type'  => 'residence',
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
												$cat_image = get_term_meta( $child->term_id, 'term_image', true );
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
                <span class="ip_title"> منطقه اقامتگاه</span>

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
                <span class="ip_title">امکانات اقامتگاه</span>

                <div class="term_drop_flex">
					<?php
					$terms_tools = get_terms( array(
						'taxonomy'   => 'tools',
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
              <script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
            <div class="input_add_h">
                <span class="ip_title ">آدرس اقامتگاه</span>

                <input type="text" style="width: 96%;margin-bottom: 20px;text-align: right" name="res_address" value="" class="input_temp host_name_inp" autocomplete="off">
            </div>

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
                        iconUrl: 'marker-icon.png',
                        shadowUrl: 'leaf-shadow.png',
                        iconSize: [38, 95], // size of the icon
                        shadowSize: [50, 64], // size of the shadow
                        iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                        shadowAnchor: [4, 62],  // the same for the shadow
                        popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor


                    });
                    let map = L.map('add_host_map').setView([<?php  echo $lat?>, <?php  echo $lng?>], 15);
                    L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {

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
                            <input type="checkbox" name="od_loyer[]" value="<?php echo $row->term_id; ?>"/>
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
                <div class="hdiv"><span class="mt_20 fz16">سند ملک یا قبض برق یا مجوز گردشگری اقامتگاه را بارگذاری نمایید.</span></div>
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

            <span id="host_insert_post_btn">ذخیره</span>
        </div>


    </div>

<?php
get_footer();