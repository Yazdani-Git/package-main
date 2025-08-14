<?php
/* Template Name:User Notes */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header( 'single' );
$rol= jayto_get_current_user_role();
$tour_enable = get_option( 'allow_add_theme_tour' );
$allow_add_tour_hoster         = get_option( 'allow_add_tour_hoster' );
$show_bhost=get_option('b_host');
if (in_array('host',$rol) or in_array('administrator',$rol)){
	$user_role='host';
}
$user_id = get_current_user_id();
$notes = get_user_meta($user_id,'user_note',true);


?>

	<div class="profile_box">
		<?php
		if (!wp_is_mobile()){ ?>
			<div class="prb_menu">
				<div class="prb_menu_body">
					<div class="prb_menu_section">
					<span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz11 fw500 col_gray2">لیست سفرها و درخواست ها</span>
                            <a href="<?php echo home_url(); ?>/trips" class="fz10 fw300 col_gray mbt10 ">سفرهای من</a>
                              <?php
                              if ($tour_enable){ ?>
	                              <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های من</a>
                              <?php }
                              ?>
	                        <?php
	                        if ($user_role == 'host'){?>
		                        <a href="<?php echo home_url(); ?>/host_request" class="fz10 fw300 col_gray mbt10 ">  درخواست ها</a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">  درخواست های رزرو تور</a>
	                        <?php  }
	                        ?>

                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
						<?php
						if ($user_role == 'host'){?>
							<span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz11 fw500 col_gray2 ">اقامت گاه های من</span>
                            <a href="<?php echo home_url(); ?>/my-host" class="fz10 fw300 col_gray mbt10 ">لیست اقامتگاه </a>
                            <a href="<?php echo home_url(); ?>/add-host" class="fz10 fw300 col_gray mbt10 ">ثبت اقامتگاه  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
							<span class="prb_menu_item ">
                        <span class="prb_icon"><i class=" fas fa-hotel"></i></span>
                        <div class="prb_menu_container active">
                            <span class="fz11 fw500 col_gray2 ">هتل های من</span>
                            <a href="<?php echo home_url(); ?>/my-hotel" class="fz10 fw300 col_gray mbt10 ">لیست هتل ها </a>
                            <a href="<?php echo home_url(); ?>/add_hotel" class="fz10 fw300 col_gray mbt10 ">ثبت هتل  </a>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>
						<?php  }
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
								<span class="fz11 fw500 col_gray2">موردعلاقه ها</span>
								<span class="fz10 fw300 col_gray mbt10">لیست اقامتگاه های مرد علاعق</span>

							</div>
						</a>
					</div>
                    <span class="line_dash mbt10"></span>
					<?php
					if ($user_role != 'host'){?>
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
						<p class="fz10 fw300 col_gray mbt10">حساب کاربری</p>
						<a href="<?php echo home_url(); ?>/account" class="prb_menu_item ">
							<span class="prb_icon"><i class="fa fa-user-alt"></i></span>
							<div class="prb_menu_container">
								<span class="fz11 fw500 col_gray2">اطلاعات حساب کاربری</span>
								<span class="fz10 fw300 col_gray mbt10">مشاهده و ویرایش حساب کاربری</span>
								<span class="line_dash mbt10"></span>
							</div>

						</a>
						<a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item">

							<span class="prb_icon"><i class="fa fa-file-text "></i></span>
							<div class="prb_menu_container">
								<span class="fz11 fw500 col_gray2">تراکنش های من</span>
								<span class="fz10 fw300 col_gray mbt10">مشاهده زمان و تاریخ تراکنش ها</span>
								<span class="line_dash mbt10"></span>
							</div>
						</a>
						<a href="<?php echo home_url() ?>/password" class="prb_menu_item ">
							<span class="prb_icon"><i class="fa fa-key"></i></span>
							<div class="prb_menu_container">
								<span class="fz11 fw500 col_gray2">رمز عبور</span>
								<span class="fz10 fw300 col_gray mbt10">تنظیم و تغییر رمز عبور</span>
								<span class="line_dash mbt10"></span>
							</div>
						</a>
						<div class="prb_menu_section">
							<p class="fz10 fw300 col_gray mbt10">اعتبار</p>
							<a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item ">
								<span class="prb_icon"><i class="fas fa-wallet"></i></span>
								<div class="prb_menu_container">
									<span class="fz11 fw500 col_gray2">کیف پول</span>
									<span class="fz10 fw300 col_gray mbt10">موجودی،افزایش اعتبار</span>

								</div>
							</a>
							<a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
								<span class="prb_icon"><i class="fas fa-ban"></i></span>
								<div class="prb_menu_container">
									<span class="fz11 fw500 col_gray2">مسدود شده ها</span>
								</div>
							</a>
							<a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
								<span class="prb_icon"><i class="fas fa-credit-card"></i></span>
								<div class="prb_menu_container">
									<span class="fz11 fw500 col_gray2">درخواست وجه</span>


								</div>
							</a>
							<a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
								<span class="prb_icon"><i class="fas fa-credit-card"></i></span>
								<div class="prb_menu_container">
									<span class="fz11 fw500 col_gray2">لیست درخواست وجه</span>


								</div>
							</a>
							<a href='<?php echo home_url(); ?>/user note' class='prb_menu_item active'>
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
		<?php  }
		?>



		<div class="prb_content">
			<p>لیست پیام ها</p>
			<?php
			foreach ($notes as $row){ ?>

				<div class="user_each_note">
                    <p class="fz14"><?php  echo $row ?></p>
                </div>
			<?php }
			?>


		</div>

	</div>

<?php
get_footer();