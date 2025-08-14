<?php
/* Template Name:Experiiences Trips */
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
$show_bhost=get_option('b_host');
?>

    <div class="profile_box">
		<?php
		if ( ! wp_is_mobile() ) {


			?>
            <div class="prb_menu">
                <div class="prb_menu_body">
                    <div class="prb_menu_section">

                   <span class="prb_menu_item active">
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
							$allow_add_hotel = get_option( 'allow_add_hotel' );
							?>
                            <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fas fa-hotel"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw700 col_gray2 ">اقامت گاه های من</span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 ">لیست اقامتگاه </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 ">ثبت اقامتگاه  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<?php
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
                                <span class="fz12 fw700 col_gray2">موردعلاقه ها</span>
                                <span class="fz11 fw300 col_gray mbt10">لیست اقامتگاه های مورد علاقه</span>

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
                            <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item">
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
            <div class="prb_content">
                <p class="acount_ht fz16 fw700 ">تجربه های من</p>

				<?php
				$orders = get_user_experience_trips( $user_role );

				if ( ! $orders ){
				?>
                <div class="no_item">
                    <span>هنوز هیچ تجربه ای ثبت نکرده اید.</span>
                    <img src="<?php echo get_template_directory_uri() ?>/images/no-tour.png" alt="">

					<?php } else {
						foreach ( $orders as $order ) {


							$order_alert  = '';
							$order_status = $order->order_status;
							switch ( $order_status ) {
								case 1:
									$order_alert = 'در انتظار تایید ';
									break;
								case 2:
									$order_alert = 'در انتظار پرداخت';
									break;
								case 3:
									$order_alert = 'پرداخت شده';
									break;
								case 4:
									$order_alert = 'لغو شده';
									break;

							}
							$res_info     = get_post( $order->res_id );
					 		$timer_pay    = calc_reserve_timer( $order->start_timer );
							$outhor_image = get_user_meta( $res_info->post_author, 'user_profile_imsge' );
							$image        = get_the_post_thumbnail_url( $res_info->ID, 'small' );
							global $wpdb;
							$table_name   = $wpdb->prefix . 'tour_reserve_request';
							$created_date = date( 'Y m d H:i:s' );
							$expire_date  = date( 'd-m-Y H:i:s', strtotime( "+20 min" ) );
							$guest_info   = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE orderid = {$order->id}", OBJECT );
						$author_id    = get_post_field( 'post_author', $order->res_id );
							$hoster_meta  = get_user_meta( $author_id );
							$eghamat = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}tour_variable WHERE  id= {$order->var_id} ORDER BY id DESC ", object );

                           if ($order -> order_status == 2){?>
                               <style>
                                   .trip_pay{
                                       pointer-events:auto
                                   }
                               </style>
                         <?php  }
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
                                                    <span class="rqpc_title mbt10"><?php echo $res_info->post_title ?> - <span class="fz11">اقامت در(<?php  echo $eghamat->title ?>)</span></span>

                                                    <div class="fl_div">
                                                        <span class="fw300 fz13">تعداد مهمان</span>
                                                        <span class="fz13">
                                                            <?php

                                                            if ($order->request_type == 'private_shutter'){
                                                                echo 'سانس دربست';
                                                            }else{
	                                                            echo $order->passenger_number .'&nbsp;نفر';
                                                            }
                                                            ?>


                                                            </span>
                                                    </div>
                                                    <div class="tritl_b">

                                                        <div class="trib_date">
                                                            <span class="fw300 fz13">تاریخ اقامت</span>
                                                            <span class="fz13 mbt10"><?php echo $order->tour_date ?></span>
                                                            <span class="fw300 fz13">ساعت شروع سانس</span>
                                                            <span class="fz13 mbt10"><?php echo $order->sans ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tribot">
											<?php
											if ( $user_role == 'host' && $order->order_status == 3 ) {

												?>
                                                <div class="trib_date">
                                                    <span class="fw300 mbt10 fz13">مشخصات مهمان</span>
                                                    <span class="mbt10 fz13">&nbsp;نام : <?php echo $guest_info->passenger_name ?></span>
                                                    <span class="mbt10 fz13"> &nbsp;  نام خانوادگی : <?php echo $guest_info->passenger_famili ?></span>
                                                    <span class="mbt10 fz13"> &nbsp; موبایل : <?php echo $guest_info->passenger_phone ?></span>
                                                </div>
											<?php } else {
                                                   if($order->order_status == 10){ ?>
												  <div class="trib_date">
                                                    <span class="fw300 mbt10 fz13">مشخصات میزبان</span>
                                                    <span class="mbt10 fz13">&nbsp;نام : <?php echo $hoster_meta['first_name'][0] ?></span>
                                                    <span class="mbt10 fz13"> &nbsp;  نام خانوادگی : <?php echo $hoster_meta['last_name'][0] ?></span>
                                                    <span class="mbt10 fz13"> &nbsp; موبایل : <?php echo $hoster_meta['user_mobile'][0] ?></span>
                                                </div>

                                                <?php   }
												?>

											<?php }
											?>

                                        </div>
                                    </div>
                                    <div class="tri_left">
										<?php
										$map_btn_name = 'user_mapv_btn';

										if ( $order->order_status == 3 ) { ?>
                                            <div class="adition_toption">
                                                <i class="fa fa-bars"></i>
                                                <div class="adito_drop">

                                                    <span class="<?php echo $map_btn_name ?>" data-request="0" data-ri43659="<?php echo $order->tour_id + 100; ?>">مشاهده نقشه</span>
                                                </div>
                                            </div>
										<?php }
										?>

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
                                                <span class="fw300 fz13">میزبان</span>
                                                <span class="fw700 fz13"><?php the_author_meta( 'first_name', $res_info->post_author ); ?>&nbsp;<?php the_author_meta( 'last_name', $res_info->post_author ); ?></span>

                                            </div>
                                        </div>
                                        <div class="thb_price">
                                            <span>  مبلغ کل :</span>
                                            <span class="fw700 fz16">&nbsp;<?php echo number_format( $order->price ) ?> تومان</span>
                                        </div>

										<?php if ( $timer_pay > 0 && $order_status == 2 ) { ?>
                                                <div class="trppb">
                                                <a class="trip_pay" href='<?php echo home_url() ?>/request?res_id=<?php echo $order->res_id ?>&tiod=<?php  echo $order->id ; ?> '>در انتظار پرداخت
                                                    &nbsp;<span class="resend_timer_elm"></span></a>
                                                </div>
                                            <script>
                                                jQuery('.resend_timer_elm').backward_timer({
                                                    seconds: <?php echo $timer_pay?>
                                                    , format: ' m% : s%  ',
                                                    on_exhausted: function ($timer_pay) {
                                                        jQuery('.trppb a').remove()
                                                        jQuery('.trppb').html('<div class="trb_pay_but pay_dis"> <span>لغو شده</span> &nbsp; </div>')


                                                        jQuery.ajax({
                                                            url: ajax_data.adju,
                                                            type: "POST",
                                                            data: {action: "change_tur_status", 'os': 4,'oi': <?php  echo $order->id ?> },
                                                            beforeSend: function () {


                                                            },
                                                            success: function (data) {

                                                            }

                                                        })
                                                    }
                                                })
                                                jQuery('.resend_timer_elm').backward_timer('start')
                                            </script>
										<?php }  elseif ( $order_status == 3 ) { ?>
                                            <div class="trb_pay_s10 ">
                                                <span>پرداخت شده</span> &nbsp;
                                            </div>
										<?php }elseif ($order_status == 4){ ?>
                                            <div class="trb_pay_but pay_dis"> <span>لغو شده</span> &nbsp; </div>
									<?php	}elseif ($order_status == 1){ ?>
                                            <div class="trb_pay_but pay_dis"> <span>درانتظار تایید</span> &nbsp; </div>
										<?php	}?>

                                    </div>


                                </div>

                            </div>

						<?php }
					}


					?>
                </div>
            </div>
            <div class="user_cansel_trip_box">
                <span class="cansel_trip_box_close"><i class="dashicons dashicons-no-alt"></i></span>
            </div>
		<?php } elseif ( wp_is_mobile() ) { ?>


			<?php
			$user_id = apply_filters( 'determine_current_user', false );
			wp_set_current_user( $user_id );
			if ( $user_id ) {
				?>

                <div class="prb_content">

                    <div class="mh_head_back">
                        <p class="acount_ht fz16 fw700 ">سفر های من</p>
                        <a href="<?php echo home_url() ?>/macount"><i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i> </a>


                    </div>

					<?php

					$orders = get_user_experience_trips( $user_role );

					if ( ! $orders ){
					?>
                    <div class="no_item">
                        <span>هنوز هیچ تجربه ای ثبت نکرده اید.</span>
                        <img src="<?php echo get_template_directory_uri() ?>/images/no-tour.png" alt="">

						<?php } else {
							foreach ( $orders as $order ) {

								$order_alert  = '';
								$order_status = $order->order_status;
								switch ( $order_status ) {
									case 0:
										$order_alert = 'در انتظار تایید ';
										break;
									case 2:
										$order_alert = 'در انتظار پرداخت';
										break;
									case 3:
										$order_alert = 'پرداخت شده';
										break;
									case 4:
										$order_alert = 'لغو شده';
										break;


								}
								$res_info = get_post( $order->res_id );

								$timer_pay    = calc_reserve_timer( $order->start_timer );
								$outhor_image = get_user_meta( $res_info->post_author, 'user_profile_imsge' );
								$alt_date     = change_date_to_alt( $order->check_in, $order->check_out );
								$night        = DateDifference( $order->check_in, $order->check_out );
								$image        = get_the_post_thumbnail_url( $res_info->ID, 'small' );
								global $wpdb;
								$table_name   = $wpdb->prefix . 'jayto_transaction';
								$created_date = date( 'Y m d H:i:s' );

								$expire_date = date( 'd-m-Y H:i:s', strtotime( "+2 min" ) );

								$guest_info = $wpdb->get_row( "SELECT * FROM {$table_name} WHERE orderid = {$order->id}", OBJECT );
//								$eghamat = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}tour_variable WHERE  id= {$result->var_id} ORDER BY id DESC ", object );
								?>
                                <div class="prb_content_body">

                                    <div class="trips_item">
                                        <div class="tri_right">

                                            <div class="tritop">
                                                <div class="trit_right">
                                                    <img src="<?php echo $image ?>" alt="">
                                                </div>
                                                <div class="trit_left">
                                                    <div class="tritl_t ">
                                                        <span class="rqpc_title"><?php echo $res_info->post_title ?></span>
                                                        <div class="fl_div">
                                                            <span class="fw300 fz13">تعداد مهمان</span>
                                                            <span class="fz13">
                                                                      <?php
                                                                      if ($order->request_type == 'private_shutter '){
	                                                                      echo 'سانس دربست';
                                                                      }else{
	                                                                      echo $order->passenger_number;
                                                                      }
                                                                      ?>
                                                                &nbsp;نفر</span>
                                                        </div>
                                                        <div class="tritl_b">

                                                            <div class="trib_date">
                                                                <span class="fw300 fz13">تاریخ اقامت</span>
                                                                <span class="fz13"><?php echo $alt_date['check_in'] ?> تا <?php echo $alt_date['checkout'] ?> (&nbsp<?php echo $night ?>شب)</span>
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
                                                        <span class="fw700 mbt10 fz14">مشخصات میزبان</span>
                                                        <span class="mbt10 fz13">&nbsp;نام : <?php echo $guest_info->passenger_name ?></span>
                                                        <span class="mbt10 fz13"> &nbsp;  نام خانوادگی : <?php echo $guest_info->passenger_famili ?></span>
                                                        <span class="mbt10 fz13"> &nbsp; موبایل : <?php echo $guest_info->passenger_phone ?></span>
                                                    </div>
												<?php }
												?>

                                            </div>
                                        </div>
                                        <div class="tri_left">
											<?php

											$map_btn_name = 'user_mapv_btn';
											if ( $order->hotel == 1 ) {
												$map_btn_name = 'user_hmapv_btn';
											}

											?>

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
                                                    <span class="fw700 fz14">میزبان</span>
                                                    <span class="fw700 fz13"><?php the_author_meta( 'first_name', $res_info->post_author ); ?>&nbsp;<?php the_author_meta( 'last_name', $res_info->post_author ); ?></span>

                                                </div>
                                            </div>
                                            <div class="thb_price mr13">
                                                <span>  مبلغ کل :</span>
                                                <span class="fw700 fz16">&nbsp;<?php echo number_format( $order->price ) ?> تومان</span>
                                            </div>

	                                        <?php if ( $timer_pay > 0 && $order_status == 2 ) { ?>
                                                <div class="trppb">
                                                    <a class="trip_pay" href='<?php echo home_url() ?>/request?res_id=<?php echo $order->res_id ?>&tiod=<?php  echo $order->id ; ?> '>در انتظار پرداخت
                                                        &nbsp;<span class="resend_timer_elm"></span></a>
                                                </div>
                                                <script>
                                                    jQuery('.resend_timer_elm').backward_timer({
                                                        seconds: <?php echo $timer_pay?>
                                                        , format: ' m% : s%  ',
                                                        on_exhausted: function ($timer_pay) {
                                                            jQuery('.trppb a').remove()
                                                            jQuery('.trppb').html('<div class="trb_pay_but pay_dis"> <span>لغو شده</span> &nbsp; </div>')


                                                            jQuery.ajax({
                                                                url: ajax_data.adju,
                                                                type: "POST",
                                                                data: {action: "change_tur_status", 'os': 4,'oi': <?php  echo $order->id ?> },
                                                                beforeSend: function () {


                                                                },
                                                                success: function (data) {

                                                                }

                                                            })
                                                        }
                                                    })
                                                    jQuery('.resend_timer_elm').backward_timer('start')
                                                </script>
	                                        <?php }  elseif ( $order_status == 3 ) { ?>
                                                <div class="trb_pay_s10 ">
                                                    <span>پرداخت شده</span> &nbsp;
                                                </div>
	                                        <?php }elseif ($order_status == 4){ ?>
                                                <div class="trb_pay_but pay_dis"> <span>لغو شده</span> &nbsp; </div>
	                                        <?php	}elseif ($order_status == 1){ ?>
                                                <div class="trb_pay_but pay_dis"> <span>درانتظار تایید</span> &nbsp; </div>
	                                        <?php	}?>

                                        </div>


                                    </div>

                                </div>

							<?php }
						}


						?>
                    </div>
                </div>
                <div class="user_cansel_trip_box">
                    <span class="cansel_trip_box_close"><i class="dashicons dashicons-no-alt"></i></span>
                </div>
			<?php } else { ?>
                <style>
                    #login_box {

                        opacity: 1;
                        visibility: visible;

                    }
                </style>
			<?php }
			?>


		<?php }
		?>


    </div>
<?php

get_footer();