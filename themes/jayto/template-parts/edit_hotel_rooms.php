<?php
/* Template Name:Edit Rooms */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! is_user_logged_in() ) {
	exit; // Exit if accessed directly.
}
get_header( 'single' );
$user_role             = jayto_get_current_user_role();
$user_role             = '';
$tour_enable           = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster = get_option( 'allow_add_tour_hoster' );
$rol                   = jayto_get_current_user_role();
if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
} else {
	$user_role = 'guest';
}
global $post;
$pid       = $_GET['ri'];
$last_room = get_post_meta( $pid, 'room_count', true );
if ( $last_room == '' ) {
	$last_room = 1;
} else {
	$last_room = $last_room + 1;
}

update_post_meta( $pid, 'room_count', $last_room );
$rinfo = get_post_meta( $pid, 'rooms_info', true );

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
                            <span class="fz12 fw700 col_gray2">لیست سفرها و درخواست ها</span>
                            <a href="<?php echo home_url(); ?>/trips" class="fz11 fw300 col_gray mbt10 ">سفرهای من</a>
                             <?php
                             if ( $tour_enable ) { ?>
                                 <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های من</a>
                             <?php }
                             ?>

	                        <?php
	                        if ( $user_role == 'host' ) {
		                        ?>
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 ">  درخواست ها</a>
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
                            <span class="fz12 fw700 col_gray2 ">اقامت گاه های من</span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 ">لیست اقامتگاه </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 ">ثبت اقامتگاه  </a>
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
							<?php
							if ( $allow_add_tour_hoster == 1 ) { ?>
                                <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-tree"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 ">تجربه های من</span>
                            <a href="<?php echo home_url(); ?>/my-experiences" class="fz11 fw300 col_gray mbt10 ">لیست تجربه ها </a>
                            <a href="<?php echo home_url(); ?>/add_experiences" class="fz11 fw300 col_gray mbt10 ">ثبت تجربه  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<?php }
							?>
						<?php }
						?>

                        <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item">
                            <span class="prb_icon"><i class="fa fa-heart"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">موردعلاقه ها</span>
                                <span class="fz11 fw300 col_gray mbt10">لیست اقامتگاه های مورد علاعق</span>

                            </div>
                        </a>
                    </div>
					<?php
					if ( $user_role != 'host' ) {
						?>
                        <div class="prb_menu_section">
                            <p class="fz11 fw300 col_gray mbt10">میزبانی اقامتگاه</p>
                            <a href="#" class="prb_menu_item">
                                <span class="prb_icon"><i class="fa fa-exchange "></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2">میزبان شوید</span>
                                    <span class="fz11 fw300 col_gray mbt10">همین حالا هتل خود را ثبت کرده و کسب درآمد کنید.</span>

                                </div>
                            </a>
                        </div>
					<?php }
					?>
                    <div class="prb_menu_section">
                        <p class="fz11 fw300 col_gray mbt10">حساب کاربری</p>
                        <a href="<?php echo home_url(); ?>/account" class="prb_menu_item ">
                            <span class="prb_icon"><i class="fa fa-user-alt"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">اطلاعات حساب کاربری</span>
                                <span class="fz11 fw300 col_gray mbt10">مشاهده و ویرایش حساب کاربری</span>
                                <span class="line_dash mbt10"></span>
                            </div>

                        </a>
                        <a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item">

                            <span class="prb_icon"><i class="fa fa-file-text "></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">تراکنش های من</span>
                                <span class="fz11 fw300 col_gray mbt10">مشاهده زمان و تاریخ تراکنش ها</span>
                                <span class="line_dash mbt10"></span>
                            </div>
                        </a>
                        <a href="<?php echo home_url() ?>/password" class="prb_menu_item">
                            <span class="prb_icon"><i class="fa fa-key"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">رمز عبور</span>
                                <span class="fz11 fw300 col_gray mbt10">تنظیم و تغییر رمز عبور</span>
                                <span class="line_dash mbt10"></span>
                            </div>
                        </a>
                        <div class="prb_menu_section">
                            <p class="fz11 fw300 col_gray mbt10">اعتبار</p>
                            <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item ">
                                <span class="prb_icon"><i class="fas fa-wallet"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2">کیف پول</span>
                                    <span class="fz11 fw300 col_gray mbt10">موجودی،افزایش اعتبار</span>

                                </div>
                            </a>
                            <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
                                <span class="prb_icon"><i class="fas fa-ban"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2">مسدود شده ها</span>
                                </div>
                            </a>
                            <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                                <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2">درخواست وجه</span>


                                </div>
                            </a>
                            <a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
                                <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2">لیست درخواست وجه</span>


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
                <p class="acount_ht fz16 fw700 ">اتاق ها</p>
				<?php
				if ( wp_is_mobile() ) { ?>
                    <a href="<?php echo home_url() ?>/macount"><i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i> </a>

				<?php }
				?>
            </div>


			<?php
			$orders    = get_user_orders( $user_role );
			$args      = array(
				'author'         => $current_user->ID,
				'orderby'        => 'id',
				'order'          => 'ASC',
				'post_type'      => 'hotel',
				'posts_per_page' => '-1',
				'post_status'    => array(
					'any',

				),
			);
			$residence = get_posts( $args );


			?>

            <div class="room_pbox">

                <div class="room_item_box_prbox">
					<?php
					if ( $rinfo ) {
					foreach ($rinfo as $ky => $row 	) {
						$mk    = 'hotel_calender' . $ky;
						$dates = get_post_meta( $pid, $mk, true );
						$tips_number      = $row['room_tip_number'];
						if (intval($tips_number) == '')
							$tips_number = 1;
						?>


                        <div class="rooms_inner " data-rnum="<?php echo $ky ?> ">
                            <div class="del_room " data-info="<?php echo $ky ?>-<?php echo $pid ?>">
                                <span class="dashicons dashicons-trash del_is"></span>
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14">نام اطاق</label>
                                <input type="text" class="room_inp input_htemp room_name" name="room_name" style="width: 66%" value="<?php echo $row['room_name'] ?>">
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14">تعداد این تیپ اتاق </label>
                                <input type="number" class="room_inp input_htemp r_tips_number" name="r_short_desc" style="width: 66%" value="<?php echo $tips_number ?>">
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14">توضیح کوتاه درمورداتاق </label>
                                <input type="text" class="room_inp input_htemp r_short_desc" name="r_short_desc" style="width: 66%">
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14">تعداد تخت </label>
                                <input type="number" class="room_inp input_htemp room_on_bed" name="room_on_bed" value="<?php echo $row['bed_count'] ?>">
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz13">تعداد تخت یک نفره</label>
                                <select type="number" class="room_inp room_single_bed input_htemp" name="room_single_bed">
                                    <option value="0" <?php if ( $row['room_single_bed'] == 0 )
										echo 'selected' ?> >0
                                    </option>
                                    <option value="1" <?php if ( $row['room_single_bed'] == 1 )
										echo 'selected' ?> >1
                                    </option>
                                    <option value="2" <?php if ( $row['room_single_bed'] == 2 )
										echo 'selected' ?> >2
                                    </option>
                                    <option value="3"<?php if ( $row['room_single_bed'] == 3 )
										echo 'selected' ?> >3
                                    </option>
                                    <option value="4"<?php if ( $row['room_single_bed'] == 4 )
										echo 'selected' ?> >4
                                    </option>
                                </select>
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz13">تعداد تخت دو نفره</label>
                                <select type="number" class="room_inp room_Double_bed input_htemp" name="room_Double_bed">
                                    <option value="0"<?php if ( $row['room_Double_bed'] == 0 )
										echo 'selected' ?> >0
                                    </option>
                                    <option value="1"<?php if ( $row['room_Double_bed'] == 1 )
										echo 'selected' ?> >1
                                    </option>
                                    <option value="2"<?php if ( $row['room_Double_bed'] == 2 )
										echo 'selected' ?> >2
                                    </option>
                                    <option value="3"<?php if ( $row['room_Double_bed'] == 3 )
										echo 'selected' ?> >3
                                    </option>
                                    <option value="4"<?php if ( $row['room_Double_bed'] == 4 )
										echo 'selected' ?> >4
                                    </option>
                                </select>
                            </div>

                            <div class="rooms_item_box">
                                <label class="fz14">صبحانه</label>
                                <input type="checkbox" class="room_inp room_breackfast " name="room_breackfast" <?php if ( $row['room_breackfast'] == 'on' ) {
									echo 'checked';
								} ?>>
                                <label class="fz14">نهار</label>
                                <input type="checkbox" class="room_inp room_lunch" name="room_lunch" <?php if ( $row['room_lunch'] == 'on' ) {
									echo 'checked';
								} ?>>
                                <label class="fz14">شام</label>
                                <input type="checkbox" class="room_inp room_Dinner" name="room_Dinner" <?php if ( $row['room_Dinner'] == 'on' ) {
									echo 'checked';
								} ?>>
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14">قیمت برای روزهای عادی (تومان)</label>
                                <input type="number" class="room_inp input_htemp room_normal_price" name="room_normal_price" value="<?php echo $row['room_normal_price'] ?>">
                            </div>
                            <div class="rooms_item_box">
                                <label class="fz14"> قیمت برای روزهای آخر هفته (تومان)</label>
                                <input type="number" class="room_inp input_htemp  room_endWeek_price" name="room_endWeek_price" value="<?php echo $row['room_endWeek_price'] ?>">
                            </div>
                            <div class="rooms_item_box">
                                <div class="room_each_day_price<?php echo $ky ?> mbt10 ">
                                    <label class="fz14 rdpwcs">قیمت روزانه روی تقویم</label>
                                    <input type="text" value="" class=" input_htemp room_eday_date<?php echo $ky ?>" autocomplete="off">

                                    <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_eday_date<?php echo $ky ?>"></date-picker>
                                    <label class="fz14">قیمت (تومان) &nbsp;<input type="number" class=" input_htemp room_edate_prices<?php echo $ky ?>" name="room_edate_prices<?php echo $ky ?>"></label>
                                    <span class=" rscs rodp_submit<?php echo $ky ?>">ذخیره</span>
                                </div>
                            </div>
                            <div class="rooms_item_box">
                                <div class="room_dis_days<?php echo $ky ?> mbt10 rrds">
                                    <label class="fz14 rdpwcs">غیر فعال کردن تاریخ</label>
                                    <input type="text" value="" class=" input_htemp room_dis_date<?php echo $ky ?>" autocomplete="off">

                                    <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_dis_date<?php echo $ky ?>"></date-picker>
                                    <span class=" rscs roddis_submit<?php echo $ky ?>">ذخیره</span>
                                </div>
                            </div>

                            <div class="rooms_item_box">
                                <div class="room_rev_days<?php echo $ky ?> mbt10 rrds">
                                    <label class="fz14 rdpwcs"> فعال کردن تاریخ</label>
                                    <input type="text" value="" class="input_htemp room_rev_date<?php echo $ky ?>" autocomplete="off">

                                    <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_rev_date<?php echo $ky ?>"></date-picker>
                                    <span class=" rscs rorevd_submit<?php echo $ky ?>">ذخیره</span>
                                </div>
                            </div>
                            <div class="hos_rooms_img fz14"><span>تصاویر اتاق</span></div>
                            <div class="uploadersContainer">
                                <div class="uploader padd10">
                                    <input type="file" class="file_input mr12" accept="image/*" multiple>
                                    <button class="upload_button_host">آپلود</button>
                                    <div class="imageContainer">
										<?php

										if ( count( $row['urls'] ) > 0 ) {

											foreach ( $row['urls'] as $url ) { ?>
                                                <div class="imageC_box">
                                                    <img src="<?php echo home_url() . '/wp-content/uploads/' . $url ?>">
                                                    <span class="room_gall_close dashicons dashicons-no-alt"></span>
                                                </div>
											<?php }
										}
										?>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <script>
                            let app<?php echo $ky?> = new Vue({
                                el: '.room_each_day_price<?php echo $ky?>',
                                data: {
                                    dates: '',

                                },

                                components: {
                                    DatePicker: VuePersianDatetimePicker
                                }
                            });
                            let app1<?php echo $ky?> = new Vue({
                                el: '.room_dis_days<?php echo $ky?>',
                                data: {
                                    dates: '',

                                },

                                components: {
                                    DatePicker: VuePersianDatetimePicker
                                }
                            });
                            let app2<?php echo $ky?> = new Vue({
                                el: '.room_rev_days<?php echo $ky?>',
                                data: {
                                    dates: '',

                                },

                                components: {
                                    DatePicker: VuePersianDatetimePicker
                                }
                            });
                            jQuery('.rodp_submit<?php echo $ky?>').on('click', function (e) {
                                var $this = jQuery(this);
                                var parents = $this.parents('.room_each_day_price<?php echo $ky?>')
                                let dates = parents.find('.room_eday_date<?php echo $ky?>').val();
                                let price = parents.find('.room_edate_prices<?php echo $ky?>').val();
                                jQuery.ajax({
                                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                    type: "POST",
                                    data: {action: "set_room_dprice", 'dates': dates, 'price': price, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                                    beforeSend: function () {
                                        jQuery('.rodp_submit<?php echo $ky?>').text('در حال ذخیره سازی')
                                    },
                                    success: function (f) {
                                        jQuery('.rodp_submit<?php echo $ky?>').text('ذخیره')
                                    }
                                })
                            })
                            jQuery('.roddis_submit<?php echo $ky?>').on('click', function (e) {
                                var $this = jQuery(this);
                                var parents = $this.parents('.room_dis_days<?php echo $ky?>')
                                let dates = parents.find('.room_dis_date<?php echo $ky?>').val();


                                jQuery.ajax({
                                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                    type: "POST",
                                    data: {action: "custom_radd_room_reserve", 'dates': dates, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                                    beforeSend: function () {
                                        $this.text('در حال ذخیره سازی')
                                    },
                                    success: function (f) {
                                        $this.text('ذخیره')
                                    }
                                })
                            })
                            jQuery('.rorevd_submit<?php echo $ky?>').on('click', function (e) {
                                var $this = jQuery(this);
                                var parents = $this.parents('.room_rev_days<?php echo $ky?>')
                                let dates = parents.find('.room_rev_date<?php echo $ky?>').val();


                                jQuery.ajax({
                                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                    type: "POST",
                                    data: {action: "custom_rev_room_reserve", 'dates': dates, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                                    beforeSend: function () {
                                        $this.text('در حال ذخیره سازی')
                                    },
                                    success: function (f) {
                                        $this.text('ذخیره')
                                    }
                                })
                            })
                        </script>
					<?php }
					?>

                </div>
                <div class="room_price_not"><span>با ذخیره سازی قیمت برای 60 روز روی تقویم هتل اعمال میشود</span></div>

                <div class="savadd_box">
                    <span class="hadd_room " data-pid="<?php echo $pid ?>">افزودن اتاق</span>
                    <span class="hsave_room " data-pid="<?php echo $pid ?>">ذخیره</span>
                </div>


				<?php
				} else { ?>
                <div class="no_item">
                    <span>هنوز اتاقی ثبت نکرده اید.</span>
                    <img src="<?php echo get_template_directory_uri() ?>/images/Room-PNG-Pic.png" alt="">
                </div>
            </div>
            <div class="savadd_box">
                <span class="hadd_room " data-pid="<?php echo $pid ?>">افزودن اتاق</span>
                <span class="hsave_room " data-pid="<?php echo $pid ?>">ذخیره</span>
            </div>

			<?php }

			?>
        </div>
    </div>
    </div>

<?php
get_footer();