<?php
/* Template Name:Blocked Wallet */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'single' );
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
$show_bhost=get_option('b_host');
$user_role = '';

$rol = jayto_get_current_user_role();
if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
} else {
	$user_role = 'guest';
}
$orders = get_user_orders( $user_role );
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
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'درخواست ها', 'jayto' ) ?></a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
                            <?php }
                            ?>

                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
                        <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container ">
                            <span class="fz12 fw700 col_gray2"><?php echo _e( 'اقامت گاه های من', 'jayto' ) ?></span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'لیست اقامتگاه', 'jayto' ) ?> </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10"><?php echo _e( 'ثبت اقامتگاه', 'jayto' ) ?> </a>
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
                                <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'لیست اقامتگاه های مورد علاقه', 'jayto' ) ?></span>

                            </div>
                        </a>
                    </div>
                    <span class="line_dash mbt10"></span>
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

	                        <?php }
	                        ?>
                        </div>
                        <span class="line_dash mbt10"></span>
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
                        <a href="<?php echo home_url() ?>/password" class="prb_menu_item ">
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
                            <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item active">
                                <span class="prb_icon"><i class="fas fa-ban"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2"><?php echo _e( 'مسدود شده ها', 'jayto' ) ?></span>
                                    <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'مشاهده اعتبار مسدود شده', 'jayto' ) ?></span>
                                </div>
                            </a>
                            <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                                <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                                <div class="prb_menu_container">
                                    <span class="fz12 fw700 col_gray2"><?php echo _e( 'درخواست وجه', 'jayto' ) ?></span>
                                    <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'درخواست وجه از کیف پول به حساب بانکی', 'jayto' ) ?> </span>


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
                <p class="acount_ht fz16 fw700 ">موجودی مسدود شده</p>

				<?php
				if ( wp_is_mobile() ) { ?>
                    <a href="<?php echo home_url() ?>/macount"> <i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i></a>

				<?php }
				?>
            </div>


			<?php
			if ( $orders ) {
				$time_now = time();
				foreach ( $orders as $row ) {
					$checkout_array = explode( '-', $row->check_out );

					$checkout_time = jmktime( 0, 0, 0, $checkout_array[1], $checkout_array[2], $checkout_array[0], '', '' );
					if ( $checkout_time > $time_now && $row->order_status == 10 ) { ?>

                        <div class="blocked_item ">
                            <p>مبلغ مسدودی <?php echo number_format( $row->host_share ) ?>&nbsp;تومان</p>
                            <p>بابت رزرو به شماره <?php echo $row->id; ?></p>
                            <p class="disf"> تاریخ رفع مسدودی :&nbsp<span><?php echo $row->check_out ?></span></p>
                        </div>
					<?php }
				}
			} else { ?>
                <div class="no_item">
                    <span>موجودی مسدود شده ای ندارید.</span>
                    <img src="<?php echo get_template_directory_uri() ?>/images/blocked-wallet1.png" alt="">
                </div>
			<?php }
			?>

        </div>

    </div>

<?php


get_footer();