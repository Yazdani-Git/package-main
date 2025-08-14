<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_reserve_request extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_reserve_request';
	}

	public function get_title() {
		return 'درخواست رزرو تور';
	}

	public function get_script_depends() {
		return [ 'jayto_script' ];
	}

	public function get_icon() {
		return 'dashicons dashicons-embed-generic';
	}

	public function get_categories() {
		return [ 'jayto' ];
	}


	protected function register_controls() {

		$this->style_tab();
	}

	private function style_tab() {


	}

	protected function render() {
		if ( ! isset ( $_GET['action'] ) ) {
			$tour_id = get_the_ID();
		} else {
			$tour_id = create_post_id();
		}
		global $post;
		$author_id = $post->post_author;
		$in_date   = '';
		$out_date  = '';
		$cap       = '';
		if ( isset( $_GET['in_date'] ) ) {
			$in_date = $_GET['in_date'];
		}
		if ( isset( $_GET['out_date'] ) ) {
			$out_date = $_GET['out_date'];
		}
		if ( isset( $_GET['cap'] ) ) {
			$cap = $_GET['cap'];
		}

		$all_sans = get_tour_sans( $tour_id );

		$tour_sans = [];
		$date_now  = jdate( 'Y-m-d', time(), '', '', 'en' );
		foreach ( $all_sans as $k => $san ) {
			if ( $k >= $date_now ) {
				$tour_sans[ $k ] = $san;
			}
		}
		$tour_meta = get_post_meta( $tour_id, 'all_tour_meta', true );

		?>

        <div class="reserve_request_box ">
			<?php
			if ( wp_is_mobile() ) { ?>
                <span class="cancel_req_close"><i class="fa fa-close"></i></span>
			<?php }
			?>
            <p class="fz12 fw300"> قیمت :</p>
            <p class="fz 14 mbt20"><?php echo number_format( $tour_meta['tour_price'] ) ?> تومان / <span class="fz13 fw400">هر نفر</span></p>

            <div class="reserve_tour_box">

				<?php
				if ( $tour_sans ) {
					echo "<p>سانس ها</p>";
					$i = 1;

					foreach ( $tour_sans as $ke => $row ) {
						if ( $i <= 2 ) {
							$ndate = change_date_month_word( $ke );

							foreach ( $row as $key => $sans ) {
								if ( $sans['request_type'] == 'general' ) {
									$mod_cap = $tour_meta['tour_capacity'] - $sans['reserve'];
									if ( $sans['reserve'] <= $tour_meta['tour_capacity'] ) { ?>

                                        <div class="avtou_itm" data-tif="<?php echo $tour_id . '~' . $ke . '~' . $key ?>">

                                            <span class="fz13 fw700">  <i class="fa-thin fa-calendar-day"></i> <?php echo $ndate ?>  </span>
                                            <div class="d_flex">
                                                <div class="avti_col">
                                                    <span class="fz12 fw300">ساعت شروع <?php echo $key ?></span>
                                                    <span class="fz12 fw300">ظرفیت باقیمانده <?php echo $mod_cap ?> نفر</span>
                                                </div>
                                                <div class="d_flex alignc">

                                                    <a href="<?php echo home_url() ?>/tour_reserve?poid=<?php echo get_the_ID() ?>&&data=<?php echo $ke . '~' . $key ?>" class="sans_select_but ">انتخاب</a>


                                                </div>
                                            </div>
                                        </div>
									<?php }
                                }

							}
						}


						$i ++;
					}
					if ( $i > 2 ) {
						echo '<span class="all_sans_but">مشاهده همه سانس ها</span>';
					}
					?>

                    <a class="csans_req_but" href="<?php echo home_url() ?>/tour_reserve?poid=<?php echo get_the_ID() ?>&rt=pri">درخواست سانس اختصاصی</a>


					<?php

				} else { ?>
                    <img src="<?php echo get_template_directory_uri() ?>/images/custom_sans_img.svg" alt="">
                    <p class="width100 text-r mbt20 fz14 fw700">درخواست سانس اختصاصی</p>
                    <p class="width100 text_j mbt20 fz12 fw300">متاسفانه سانس‌های موجود این تجربه پر است، اما شما شانس این را دارید که درخواست ثبت یک سانس اختصاصی را در روز و ساعت دلخواهتان بدهید. تیم پشتیبانی جهت هماهنگی، با شما تماس خواهد گرفت.</p>
					<?php
					if ( is_user_logged_in() ) {
						?>
                        <a class="csans_req_but" href="<?php echo home_url() ?>/tour_reserve?poid=<?php echo get_the_ID() ?>&rt=pri">درخواست سانس اختصاصی</a>
					<?php } else { ?>

                        <span class="csans_req_but non_log_submit">درخواست سانس اختصاصی</span>

					<?php }
					?>
				<?php }
				?>
                <div class="all_sans_box">
                    <div class="all_sans_head">
                        <i class="fa fa-close asanclo"></i>
                    </div>
                    <div class="all_sans_body">
						<?Php
						foreach ( $tour_sans as $ke => $row ) {

							$ndate = change_date_month_word( $ke );

							foreach ( $row as $key => $sans ) {
								if ( $sans['request_type'] == 'general' ) {

									$mod_cap = $tour_meta['tour_capacity'] - $sans['reserve'];
									if ( $sans['reserve'] <= $tour_meta['tour_capacity'] && $sans['request_type'] != 'private' ) { ?>
                                        <div class="avtou_itm" data-tif="<?php echo $tour_id . '~' . $ke . '~' . $key ?>">
                                            <span class="fz13 fw700">  <i class="fa-thin fa-calendar-day"></i> <?php echo $ndate ?>  </span>
                                            <div class="d_flex">
                                                <div class="avti_col">
                                                    <span class="fz12 fw300">ساعت شروع <?php echo $key ?></span>
                                                    <span class="fz12 fw300">ظرفیت باقیمانده <?php echo $mod_cap ?> نفر</span>
                                                </div>
                                                <div class="d_flex alignc">
                                                    <a href="<?php echo home_url() ?>/tour_reserve?poid=<?php echo get_the_ID() ?>&&data=<?php echo $ke . '~' . $key ?>" class="sans_select_but ">انتخاب</a>
                                                </div>
                                            </div>
                                        </div>
									<?php }
								}

							}
						}


						?>
                    </div>
                </div>


            </div>


        </div>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_reserve_request() );

