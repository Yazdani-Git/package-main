<?php
/* Template Name:Host_Request */
if ( ! defined( 'ABSPATH' ) ) {
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
                            if ( $user_role == 'host' ) {
	                            ?>
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 ">  درخواست ها</a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
                            <?php }
                            ?>
	                        <?php
	                        if ($tour_enable){ ?>
                                <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های من</a>
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
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'ثبت اقامتگاه', 'jayto' ) ?></a>
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
                                <span class="fz12 fw700 col_gray2"><?php echo _e( 'موردعلاقه ها', 'jayto' ) ?></span>
                                <span class="fz11 fw300 col_gray mbt10"><?php echo _e( 'لیست اقامتگاه های مورد علاقه', 'jayto' ) ?></span>

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
                            <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item">
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
                <p class="acount_ht fz16 fw700 "><?php echo _e( 'درخواست های رزرو :', 'jayto' ) ?></p>
				<?php
				if ( wp_is_mobile() ) { ?>
                    <a href="<?php echo home_url() ?>/macount"><i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i> </a>

				<?php }
				?>
            </div>
			<?php
			$orders = get_host_requests();

			if ( ! $orders ) {
				?>
                <div class="no_item">
                    <span><?php echo _e( 'هنوز هیچ درخواستی ندارید. :', 'jayto' ) ?></span>
                    <img src="<?php echo get_template_directory_uri() ?>/images/anempty-transaction-transparent.png" alt="">
                </div>
			<?php } else {
				foreach ( $orders as $order ) {


					$order_alert  = '';
					$order_status = $order->order_status;
					switch ( $order_status ) {
						case 0:
							$order_alert = 'ثبت درخواست ';
							break;
						case 1:
							$order_alert = 'تایید میزبان';
							break;
						case 2:
							$order_alert = 'پایان زمان پرداخت';
							break;
						case 3:
							$order_alert = 'در انتظار پرداخت';
							break;

						case 4:
							$order_alert = 'رد شده از ظرف پشتیبانی';
							break;

						case 10:
							$order_alert = 'پرداخت شده';
							break;

					}
					if ( $order_status != 4 ) {
						$timer_pay = calc_reserve_timer( $order->start_timer );
					}

					$res_info = get_post( $order->res_id );

					$outhor_image = get_user_meta( $res_info->post_author, 'user_profile_imsge' );
					$alt_date     = change_date_to_alt( $order->check_in, $order->check_out );
					$night        = DateDifference( $order->check_in, $order->check_out );
					$image        = get_the_post_thumbnail_url( $res_info->ID, 'small' );
					$gust         = get_user_meta( $order->user_id );
					global $wpdb;
					$table_name = $wpdb->prefix . 'jayto_transaction';
					$guest_info = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE orderid = {$order->id}", OBJECT );


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
                                            <span class="rqpc_title"><?php echo $res_info->post_title ?></span>
                                            <div class="fl_div">
                                                <span class="fw300"><?php echo _e( 'تعداد مهمان. :', 'jayto' ) ?></span>
                                                <span> <?php echo $order->passenger_number ?> &nbsp;<?php echo _e( 'نفر', 'jayto' ) ?></span>
                                            </div>
                                            <div class="tritl_b">

                                                <div class="trib_date">
                                                    <span class="fw300"><?php echo _e( 'تاریخ اقامت', 'jayto' ) ?></span>
                                                    <span><?php echo $alt_date['check_in'] ?> <?php echo _e( 'تا', 'jayto' ) ?> <?php echo $alt_date['checkout'] ?> (&nbsp<?php echo $night ?><?php echo _e( 'شب', 'jayto' ) ?>)</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="tribot">
									<?php
									if ( $user_role == 'host' && $order->order_status == 10 ) {
										?>
                                        <div class="trib_date">
                                            <span class="fw300 mbt10"><?php echo _e( 'مشخصات مهمان', 'jayto' ) ?></span>
                                            <span class="mbt10">&nbsp;<?php echo _e( 'نام', 'jayto' ) ?> : <?php echo $guest_info->passenger_name ?></span>
                                            <span class="mbt10"> &nbsp;  <?php echo _e( 'نام خانوادگی', 'jayto' ) ?> : <?php echo $guest_info->passenger_famili ?></span>
                                            <span class="mbt10"> &nbsp; <?php echo _e( 'موبایل', 'jayto' ) ?> : <?php echo $guest_info->passenger_phone ?></span>
                                        </div>
									<?php }
									?>

                                </div>
                            </div>
                            <div class="tri_left">


                                <div class="thb_imag">
									<?php
									if ( $outhor_image[0] ) {
										?>
                                        <img src="<?php echo $outhor_image[0] ?>" alt="">
									<?php } else {
										?>
                                        <img src="<?php echo get_template_directory_uri() . '/images/user-profile.png' ?>" alt="">
									<?php }
									?>
                                    <div class="thb_imag_title">
                                        <span class="fw300">مهمان</span>
                                        <span class="fw700"><?php echo $gust['first_name'][0] ?>&nbsp; <?php echo $gust['last_name'][0] ?></span>
                                    </div>
                                </div>
                                <div class="thb_price">
                                    <span>  مبلغ کل :</span>
                                    <span class="fw700 fz16">&nbsp;<?php echo number_format( $order->price ) ?> تومان</span>
                                </div>

								<?php if ( $timer_pay > 0 && $order_status == 4 ) { ?>
                                    <div class="trppb">
                                        <a class="trip_pay" href="<?php echo home_url() ?>/request/?res_id=<?php echo $order->res_id ?>&check_in=<?php echo $order->check_in ?>&checkout=<?php echo $order->check_out ?>&pas_num=<?php echo $order->passenger_number ?>">در انتظار پرداخت &nbsp;<span
                                                    class="resend_timer_elm"></span></a>

                                    </div>

                                    <script>
                                        jQuery('.resend_timer_elm').backward_timer({
                                            seconds: <?php echo $timer_pay?>
                                            , format: ' m% : s%  ',
                                            on_exhausted: function ($timer_pay) {
                                                jQuery('.trppb a').remove()
                                                jQuery('.trppb').html('<div class="trb_pay_but pay_dis"> <span><?php echo _e( 'رد شده از طرف سیستم', 'jayto' ) ?></span> &nbsp; </div>')


                                            }
                                        })
                                        jQuery('.resend_timer_elm').backward_timer('start')
                                    </script>
								<?php } elseif ( $order_status == 5 ) { ?>
                                    <div class="trb_pay_but">
                                        <span class="pay_dis"><?php echo _e( 'رد شده از طرف سیستم', 'jayto' ) ?></span> &nbsp;

                                    </div>
								<?php }elseif ( $order_status == 1 ) {


								?>
                                    <div class="trb_wait_but">

                                        <div class="trppb">
                                            <div class="request_act_box">

                                                <input type="hidden" class="oi_h" data-oi="<?php echo $order->id + 100 ?>">
                                                <span class="btn_accept_request <?php if ( $order->hotel == 1 )
													echo 'hpt' ?>"><?php echo _e( 'تایید', 'jayto' ) ?></span>
                                                <span class="btn_cancel_request <?php if ( $order->hotel == 1 )
													echo 'hpt' ?>"><?php echo _e( 'رد', 'jayto' ) ?></span>
                                            </div>
                                            <div class="trb_pay_s10">
                                                <span><?php echo _e( 'در انتظار تایید شما', 'jayto' ) ?></span> &nbsp;
                                            </div>
                                        </div>
										<?php
										if ( $timer_pay > 0 ) {
											?>
                                            <script>
                                                jQuery('.wait_timer_elm').backward_timer({
                                                    seconds: <?php echo $timer_pay?>
                                                    , format: ' m% : s%  ',
                                                    on_exhausted: function ($timer_pay) {
                                                        jQuery('.trb_wait_but a').remove()
                                                        jQuery('.trb_wait_but').html('<div class="trb_pay_but pay_dis"> <span><?php echo _e( 'رد شده از طرف سیستم', 'jayto' ) ?></span> &nbsp; </div>')


                                                    }
                                                })
                                                jQuery('.wait_timer_elm').backward_timer('start')
                                            </script>
										<?php }
										?>
                                    </div>


								<?php } elseif ( $order_status == 10 ) { ?>
                                    <div class="trb_pay_s10">
                                        <span><?php echo _e( 'پرداخت شده', 'jayto' ) ?></span> &nbsp;
                                    </div>
								<?php }elseif ( $order_status == 3 ) { ?>
                                    <div class="trb_pay_s10 bg_red">
                                        <span><?php echo _e( 'رد شده از طرف میزبان', 'jayto' ) ?></span> &nbsp;
                                    </div>
								<?php }elseif ( $order_status == 4 ) { ?>
                                    <div class="trb_pay_s10">
                                        <span><?php echo _e( 'در انتظار پرداخت', 'jayto' ) ?></span> &nbsp;
                                    </div>
								<?php }elseif ( $order_status == 6 ) { ?>
                                    <span class="mr13"><?php echo _e( 'مبلغ مسترد شده :', 'jayto' ) ?> &nbsp;<?php echo number_format( $order->cancel_price ) ?> تومان</span>
                                    <span class="mr13 disf"><?php echo _e( 'لغو شده در تاریخ :', 'jayto' ) ?> &nbsp;<span><?php echo $order->cancel_date ?></span></span>
                                    <div class="trb_pay_s10 bg_red">
                                        <span><?php echo _e( 'لغو شده از طرف مهمان :', 'jayto' ) ?></span> &nbsp;
                                    </div>
								<?php }elseif ( $order_status == 12 ) {
                                    $ptt='res';
                                    if ($order->hotel == 1) {
                                        $ptt = 'hotel';
                                    }

                                    ?>
                                    <div class="trppb">
                                        <div class="request_act_box">

<!--                                          -->
                                        </div>
                                        <div class="trb_pay_s10">
                                            <span><?php echo _e( 'در انتظار تایید پرداخت', 'jayto' ) ?></span> &nbsp;
                                        </div>
                                    </div>
								<?php } ?>

                            </div>


                        </div>

                    </div>
				<?php }
			} ?>

        </div>
    </div>
    <div class="user_cansel_trip_box">
        <span class="cansel_trip_box_close"><i class="dashicons dashicons-no-alt"></i></span>
    </div>
<?php

get_footer();