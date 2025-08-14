<?php
/* Template Name:My Host */
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
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
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
        if ($tour_enable){ ?>
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
                            <span class="prb_menu_item active">
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

                        <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item">
                            <span class="prb_icon"><i class="fa fa-heart"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">موردعلاقه ها</span>
                                <span class="fz11 fw300 col_gray mbt10">لیست اقامتگاه های مرد علاعق</span>

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
                                    <span class="fz11 fw300 col_gray mbt10">همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد کنید.</span>

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
                <p class="acount_ht fz16 fw700 ">اقامت گاه های من</p>
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
				'post_type'      => 'residence',
				'posts_per_page' => '-1',
				'post_status'    => array(
					 'any',

				),
			);
			$residence = get_posts( $args );


			?>
			<?php
			if ( $residence ) {
				foreach ( $residence as $row ) {

					$image = get_the_post_thumbnail_url( $row->ID, 'small' );
					$meta  = get_post_meta( $row->ID, '_all_res_meta', 'true' );
					$fail_note = get_post_meta($row->ID, 'my_featured_post_field', true);

					?>
                    <div class="prb_content_body">
                        <div class="trips_item">
                            <div class="tri_right">
                                <div class="tritop">
                                    <div class="trit_right">
                                        <img src="<?php echo $image ?>" alt="">
                                    </div>
                                    <div class="trit_left">
                                        <div class="tritl_t">
                                            <span class="rqpc_title"><?php echo $row->post_title ?></span>
											<?php
											if ( $meta['res_address'] ) {
												?>
                                                <div class="fl_div" style="display:flex;flex-direction: row; align-items: center;">
                                                    <i class="fa fa-map-marker "></i>
                                                    <span class="fw300 mr10"><?php echo $meta['res_address'] ?></span>

                                                </div>
											<?php }
											?>
                                            <div class="mbt15"><span class="mr10 fw300 fz13">قیمت روز های عادی</span><span class="mr10 ml_10 fw300 fz13"><?php echo number_format( $meta['price'] ) ?>&nbsp; تومان</span></div>
                                            <div><span class="mr10 fw300 fz13">قیمت پایان هفته</span><span class="mr10 ml_10 fw300 fz13"><?php echo number_format( $meta['end_week_price'] ) ?>&nbsp; تومان</span></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tribot">
	                                <?php
	                                if ($row->post_status ==  'failed'){ ?>
                                        <i class="fa-regular fa-circle-bolt"></i>&nbsp;<span>دلایل رد اقامتگاه </span>
                                        <div class="not_boxe">

                                            <p><?php  echo $fail_note?></p>
                                        </div>
	                                <?php  }
	                                ?>

                                </div>
                            </div>

                            <div class="tri_left_v ">
                                <?php
                                $ps = $row->post_status;
                                if ($ps == 'failed'){
                                    $ps = 'رد شده';
                                }elseif ($ps == 'publish'){
	                                $ps = 'تایید شده';

                                }elseif ($ps == 'pending'){
	                                $ps = 'در انتظار بازبینی';
                                }elseif ($ps == 'draft'){
	                                $ps = 'پیش نویس';
                                }
                                ?>
                                <div class="lvnot">
                                    <span class="res_sts_ti">&nbsp;&nbsp;وضعیت اقامتگاه :</span><span class="res_sts">&nbsp;<?php echo $ps ?></span>


                                </div>
                                <a href="<?php echo home_url() . '/host-edit?ri=' . $row->ID; ?>"> <span class="host_edit_btn"><i class="fa fa-edit ml_10 col_blue"></i>ویرایش</span></a>


                            </div>


                        </div>

                    </div>
				<?php }
			} else { ?>
                <div class="no_item">
                    <span>هنوز اقامتگاهی ثبت نکرده اید.</span>
                    <img src="<?php echo get_template_directory_uri() ?>/images/no_home.png" alt="">
                </div>
			<?php }

			?>
        </div>
    </div>

<?php
get_footer();