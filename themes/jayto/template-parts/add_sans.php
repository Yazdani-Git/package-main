<?php
/* Template Name:Add Sans */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
if ( ! is_user_logged_in() ) {
	exit; // Exit if accessed directly.
}
get_header( 'single' );
$user_role = jayto_get_current_user_role();
$user_role = '';

$rol = jayto_get_current_user_role();
if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
} else {
	$user_role = 'guest';
}
global $post;
$pid                   = $_GET['ri'];
$tour_enable           = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster = get_option( 'allow_add_tour_hoster' );
$last_room             = get_post_meta( $pid, 'room_count', true );
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
                        </div>
                    </div>
                </div>
            </div>

		<?php }
		?>


        <div class="prb_content">
            <div class="mh_head_back">
                <p class="acount_ht fz16 fw700 ">  سانس ها (<?php  echo get_the_title($_GET['ri']) ?>)</p>

                <div class="room_pbox tnx">
                    <div class="view_avsans">
						<?php
						$pid      = $_GET['ri'];
						$sans     = get_post_meta( $pid, 'tour_sans', true );
						$sans     = get_post_meta( $pid, 'tour_sans', true );
						$time_now = jdate( 'Y-m-d', time(), '', '', 'en' );
						foreach ( $sans as $key => $row ) {
							if ( $key >= $time_now ) { ?>
                                <div class="sans_item">
                                    <p class="sidate"> <?php echo $key ?></p>
                                    <div class="siitmd">
										<?php
										foreach ( $row as $k => $item ) {
											$type = 'عمومی';
											if ( $item['reserve_type'] == 'private' ) {
												$type = 'خصوصی';
											}


											?>
                                            <span class="sitime"><?php echo $k ?> - رزرو شده :  <?php echo $item['reserve'] ?>  نفر&nbsp; <span> &nbsp;نوع سانس : <?php echo $type ?></span> <span class="dashicons dashicons-trash del_sans_by" data-time="<?php echo $k ?>" data-pid="<?php echo $pid ?>">  </span>
										<?php }
										?>
                                    </div>
                                </div>
							<?php }
							?>

						<?php }
						?>

                    </div>
                    <div class="room_item_box_prbox">
                        <p>
                        <div class="added_aj_sans d_flex"></div>
                        <div id="each_day_price">

                            <label class="mr5 mbt10">افزودن سانس </label>

                            <div class="sans_box">
                                <input type="text" value="" class="sans" autocomplete="off" placeholder="برای مشاهده تاریخ کلیک کنید.">
                                <date-picker value="" type="datetime" multiple display-format="jYYYY-jMM-jDD/HH:mm" format="jYYYY-jMM-jDD" custom-input=".sans"></date-picker>
								<?php

								if ( wp_is_mobile() ) {
									echo '<span class="add_sans_submit_mobile">ذخیره</span>';
								} else {
									echo '<span class="add_sans_submit">ذخیره</span>';
								}
								?>
                            </div>
                        </div>
                        </p>
                        <p>
                    </div>

                    <script>
                        let app55 = new Vue({
                            el: '.sans_box',
                            data: {
                                dates: '',
                            },
                            components: {
                                DatePicker: VuePersianDatetimePicker
                            }
                        });
                        jQuery('.add_sans_submit').on('click', function (e) {
                            let sans = jQuery('.sans').val()
                            jQuery.ajax({
                                url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                type: "POST",
                                data: {action: "set_sans", 'sans': sans, 'pid': <?php echo $pid ?>  },
                                beforeSend: function () {
                                    jQuery('.add_sans_submit').text('درحال ذخیره سازی')
                                },
                                success: function (f) {
                                    let result = jQuery.parseJSON(f)
                                    let data = result.split('/')

                                    jQuery('.added_aj_sans').append('<div class="sans_item d_flex alignc"><span class="sidate">' + data[0] + '</span>=> <div class="siitmd"><span class="sitime">' + data[1] + ' </span> </div></div>')
                                    jQuery('.add_sans_submit').text('ذخیره')
                                }
                            })
                        })
                        jQuery('.add_sans_submit_mobile').on('click', function (e) {
                            let sans = jQuery('.sans').val()
                            jQuery.ajax({
                                url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                                type: "POST",
                                data: {action: "set_sans_mobile", 'sans': sans, 'pid': <?php echo $pid ?>  },
                                beforeSend: function () {
                                    jQuery('.add_sans_submit_mobile').text('درحال ذخیره سازی')
                                },
                                success: function (f) {
                                    let result = jQuery.parseJSON(f)
                                    let data = result.split('/')

                                    jQuery('.added_aj_sans').append('<div class="sans_item d_flex alignc"><span class="sidate">' + data[0] + '</span>=> <div class="siitmd"><span class="sitime">' + data[1] + ' </span> </div></div>')
                                    jQuery('.add_sans_submit_mobile').text('ذخیره')
                                }
                            })
                        })
                    </script>
                </div>

            </div>
        </div>

    </div>


<?php
get_footer();