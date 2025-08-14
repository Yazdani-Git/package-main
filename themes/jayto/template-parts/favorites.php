<?php
/* Template Name:User Favorites */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'single' );
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
$show_bhost=get_option('b_host');
$rol = jayto_get_current_user_role();
if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
	$user_role = 'host';
}

$current_user = get_current_user_id();
$favo_id      = get_user_meta( $current_user, 'user_favorite', true );
$favo_ids     = unserialize( $favo_id );

if ( $favo_ids ) {
	$args = array(
		'numberposts' => - 1,
		'post_type'   => 'residence',
		'post__in'    => $favo_ids,
	);
	$fav  = get_posts( $args );
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
                            <span class="fz11 fw500 col_gray2"><?php echo _e( 'لیست سفرها و درخواست ها', 'jayto' ) ?></span>
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
						<?php
						if ( $user_role == 'host' ) {
							?>
                            <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz12 fw500 col_gray2 "><?php echo _e( 'اقامت گاه های من', 'jayto' ) ?></span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'لیست اقامتگاه', 'jayto' ) ?> </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 "><?php echo _e( 'ثبت اقامتگاه', 'jayto' ) ?>  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<?php
							$allow_add_hotel = get_option( 'allow_add_hotel' );
							if ( $allow_add_hotel == 1 ) { ?>
                                <span class="prb_menu_item ">
                        <span class="prb_icon"><i class=" fas fa-hotel"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz11 fw500 col_gray2 ">هتل های من</span>
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
                        <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item active">
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
            <div class="prb_content">
                <p class="acount_ht fz16 fw700 "><?php echo _e( 'موردعلاقه ها', 'jayto' ) ?></p>

				<?php
				if ( $fav ) { ?>
                    <div class="favorite_box">
						<?php
						foreach ( $fav as $row ) {
							$item_city = $term = get_term( $row->ID, 'city' );
							$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'medium' );
							$all_meta  = get_post_meta( $row->ID );
							$meta      = unserialize( $all_meta['_all_res_meta'][0] );
							$res_id    = $row->ID;
							$uird      = $res_id . '-' . intval( $current_user );
							?>
                            <div class="favo_item">

								<?php
								$room_number = $meta['number_room'];
								if ( $room_number > 0 ) {
									$room_numbers = $room_number . '&nbspاطاق';
								} else {
									$room_numbers = 'بدون اطاق';
								}
								?>


                                <span class="remove_favorite" data-uird="<?php echo $uird ?>"><i class="fa fa-trash-alt"></i></span>
                                <img class="qslider_image" src="<?php echo $image[0]; ?>">
                                <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                    <div class="item_name">
                                        <span class="n_span ml_10"><?php echo $row->post_title ?></span>

                                    </div>
                                    <span class="scn"><?php echo $item_city->name; ?></span>
                                    <span class="scn"><span class="dot_span fa fa-circle"></span><?php echo $room_numbers; ?></span>
                                    <div class="item_name">
										<?php

										if ( $meta['off_price'] != 0 or $meta['off_price'] != '' ) {
											?>

                                            <del class="dis_span"><?php echo number_format( $meta['off_price'] ) ?></del>

										<?php }
										?>

                                        <span class="p_span"><?php echo number_format( $meta['price'] ) ?></span><span class="currency"> تومان / هرشب </span>

                                    </div>
									<?php
									if ( $meta['off_price'] != 0 && $meta['off_price'] != '' ) {
										$dis_percent = round( 100 - ( $meta['off_price'] / $meta['price'] * 100 ), 0 );
										?>
                                        <span class="dis_percent"><?php echo $dis_percent ?><?php echo _e( 'درصد تخفیف', 'jayto' ) ?></span>
										<?php
									}
									?>

                                </a>

                            </div>
						<?php }
						?>
                    </div>
				<?php } else { ?>
                    <div class="no_item">
                        <span><?php echo _e( 'موردی در لیست شما نیست .', 'jayto' ) ?></span>
                        <img src="<?php echo get_template_directory_uri() ?>/images/favorites-folder.png" alt="">
                    </div>
				<?php }
				?>

            </div>
		<?php } elseif ( wp_is_mobile() ) {


			if ( $current_user ) {
				?>

                <div class="prb_content">
                    <div class="mh_head_back">
                        <p class="acount_ht fz16 fw700 "><?php echo _e( 'موردعلاقه ها', 'jayto' ) ?></p>
                        <a href="<?php echo home_url() ?>/macount"><i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i></a>

                    </div>


					<?php
					if ( $fav ) { ?>
                        <div class="favorite_box">
							<?php
							foreach ( $fav as $row ) {
								$item_city = $term = get_term( $row->ID, 'city' );
								$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'medium' );
								$all_meta  = get_post_meta( $row->ID );
								$meta      = unserialize( $all_meta['_all_res_meta'][0] );
								$res_id    = $row->ID;
								$uird      = $res_id . '-' . intval( $current_user );
								?>
                                <div class="favo_item">

									<?php
									$room_number = $meta['number_room'];
									if ( $room_number > 0 ) {
										$room_numbers = $room_number . '&nbspاطاق';
									} else {
										$room_numbers = 'بدون اطاق';
									}
									?>


                                    <span class="remove_favorite" data-uird="<?php echo $uird ?>"><i class="fa fa-trash-alt"></i></span>
                                    <img class="qslider_image" src="<?php echo $image[0]; ?>">
                                    <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                        <div class="item_name">
                                            <span class="n_span ml_10"><?php echo $row->post_title ?></span>

                                        </div>
                                        <span class="scn"><?php echo $item_city->name; ?></span>
                                        <span class="scn"><span class="dot_span fa fa-circle"></span><?php echo $room_numbers; ?></span>
                                        <div class="item_name">
											<?php

											if ( $meta['off_price'] != 0 or $meta['off_price'] != '' ) {
												?>

                                                <del class="dis_span"><?php echo number_format( $meta['off_price'] ) ?></del>

											<?php }
											?>

                                            <span class="p_span"><?php echo number_format( $meta['price'] ) ?></span><span class="currency"> تومان / هرشب </span>

                                        </div>
										<?php
										if ( $meta['off_price'] != 0 && $meta['off_price'] != '' ) {
											$dis_percent = round( 100 - ( $meta['off_price'] / $meta['price'] * 100 ), 0 );
											?>
                                            <span class="dis_percent"><?php echo $dis_percent ?><?php echo _e( 'درصد تخفیف .', 'jayto' ) ?></span>
											<?php
										}
										?>

                                    </a>

                                </div>
							<?php }
							?>
                        </div>
					<?php } else { ?>
                        <div class="no_item">
                            <span><?php echo _e( 'موردی در لیست شما نیست. .', 'jayto' ) ?></span>
                            <img src="<?php echo get_template_directory_uri() ?>/images/favorites-folder.png" alt="">
                        </div>
					<?php }
					?>

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