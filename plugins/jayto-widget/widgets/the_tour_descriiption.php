<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class the_tour_descriiption extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_description';
	}

	public function get_title() {
		return 'مشخصات تور';
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
			$residence_id = get_the_ID();
		} else {
			$residence_id = create_post_id();
		}
		global $post;
		if ( ! isset ( $_GET['action'] ) ) {
			$post_id = $post->ID;
		} else {
			$post_id = create_post_id();
		}
		$author_id = $post->post_author;
		$meta      = get_post_meta( $post->ID, 'all_tour_meta', true );
		$all_meta  = get_user_meta( $author_id );

		$all_tools  = get_terms( array(
			'taxonomy'   => 'tour_tools',
			'hide_empty' => true,
		) );
		$tools      = get_the_terms( $residence_id, 'hotel_tools' );
		$tools_arry = [];
		foreach ( $tools as $row ) {
			$tools_arry[] = $row->name;
		}
		$outhor_image = get_user_meta( $author_id, 'user_profile_imsge' );
		$lat          = $meta[0]['map_point_lat'];
		$lng          = $meta[0]['map_point_lng'];
		if ( ! $lat ) {
			$lat = 35.7009;
		}
		if ( ! $lng ) {
			$lng = 51.3912;
		}


		?>

        <div class="residence_option_box ">
            <div class="rob_name">
				<?php
				if ( $outhor_image[0] ) {
					?>
                    <img src="<?php echo $outhor_image[0] ?>" class="host_prifile_image" alt="<?php echo $post->post_title ?>">
				<?php } else {
					$p_image = get_template_directory_uri() . '/images/user-profile.png';
					?>
                    <img src="<?php echo $p_image ?>" class="host_prifile_image" alt="<?php echo $post->post_title ?>">
					<?php
				}
				?>

                <span class="fz15"><?php echo _e( 'به میزبانی', 'jayto' ) ?>  &nbsp;</span>
                <span class="fz15"><?php echo $all_meta['first_name'][0] ?></span>
                &nbsp;<span class="fz15"><?php echo $all_meta['last_name'][0] ?></span>
            </div>
        </div>
        <div class="residence_option_box ">
            <div class="experience-host-quote">
                <i class="fa fa-quote-right col_gray"></i>
                <p class="fz12 fw300 col_gray2">

              <?php

              echo $meta['about_me']?>
                </p>
            </div>
        </div>
        <div class="residence_option_box ">
            <div class="options_tour">
                <div class="opt_item">
                    <img src="<?php echo get_template_directory_uri() ?>/images/جای تجربه.png" alt="">
                    <div class="opt_ojh">
                        <p class="fz11 fw300 col_gray">جای تجربه</p>
                        <p class="fz13 fw500"><?php echo $meta['tour_place_opt'] ?></p>
                    </div>
                </div>
                <div class="opt_item">
                    <img src="<?php echo get_template_directory_uri() ?>/images/چالش فیزیکی.png" alt="">
                    <div class="opt_ojh">
                        <p class="fz11 fw300 col_gray">چالش فیزیکی</p>
                        <p class="fz13 fw500"><?php echo $meta['Physical_challenge'] ?></p>
                    </div>
                </div>
                <div class="opt_item">
                    <img src="<?php echo get_template_directory_uri() ?>/images/مناسب برای.png" alt="">
                    <div class="opt_ojh">
                        <p class="fz11 fw300 col_gray">مناسب برای</p>
                        <p class="fz13 fw500"><?php echo $meta['age_need'] ?></p>
                    </div>
                </div>
                <div class="opt_item">
                    <img src="<?php echo get_template_directory_uri() ?>/images/مدت تجربه.png" alt="">
                    <div class="opt_ojh">
                        <p class="fz11 fw300 col_gray">مدت تجربه</p>
                        <p class="fz13 fw500"><?php echo $meta['tour_time'] ?> ساعت</p>
                    </div>
                </div>
                <div class="opt_item">
                    <img src="<?php echo get_template_directory_uri() ?>/images/ظرفیت هر سانس.png" alt="">
                    <div class="opt_ojh">
                        <p class="fz11 fw300 col_gray">ظرفیت هر سانس</p>
                        <p class="fz13 fw500"><?php echo $meta['tour_capacity'] ?>نفر</p>
                    </div>
                </div>
            </div>
        </div>
        <span class="line margin_tb40"></span>
        <div class="residence_option_box  ">
			<?php

			if ( ! isset ( $_GET['action'] ) ) {
				if ( $post->post_content != '' ) {
					$query   = get_post( get_the_ID() );
					$content = apply_filters( 'the_content', $query->post_content );
					?>
                    <div class="hotel_box_description mb30">
                        <p class="fz15  fw700 mbt15">داستان این تجربه</p>

                        <div class="rob_box_description">
                            <p class="fz15 col_gray2"><?php echo $content; ?></p>

                        </div>
                    </div>
				<?php }
			} ?>
            <div class="mb30">
                <span class="fz14 fw700 cpoint mor_content">بیشتر</span> <i class=" mor_content_ico fa-regular fa-chevron-down"></i>
            </div>
        </div>
        <span class="line margin_tb40"></span>
        <p class="fw700 fz16 mapti"><?php echo _e( 'نقطه شروع اینجاست! ', 'jayto' ) ?></p>
        <p class="fw300 fz12 mt_10 mapde"><?php echo $meta['text_before'] ?><?php echo _e( 'موقعیت مکانی دقیق اقامتگاه پس از رزرو کامل در پنل کاربری در دسترس خواهد بود.: ', 'jayto' ) ?></p>
        <div id="map">
        </div>
        <style>
            #map {
                height: 300px;
                border-radius: 12px;
                margin: 20px 0
            }

            .leaflet-pane img {
                opacity: .7;
            }
        </style>
		<?php


		$lat = $meta[0]['map_point_lat'];
		$lng = $meta[0]['map_point_lng'];
		if ( ! $lat ) {
			$lat = 35.7009;
		}
		if ( ! $lng ) {
			$lng = 51.3912;
		}
		?>
        <script>
            var homeMarker = L.icon({
                iconUrl: '<?php echo get_template_directory_uri(); ?>/images//pointssv.svg',
                iconSize: [100, 100],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            });
            let map = L.map('map').setView([<?php echo $lat ?> , <?php echo $lng ?>], 14);
    
            L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {
                maxZoom: 15,
                attribution: '',
                icon: homeMarker,

            }).addTo(map);
            map.dragging.disable();
            L.marker([<?php echo $lat ?> , <?php echo $lng ?>], {icon: homeMarker}).addTo(map);
        </script>
        <span class="line margin_tb40"></span>
        <div class="all_tools_box">
            <span class="w100 fz14 fw500"><?php echo _e( ' این تجربه شامل', 'jayto' ) ?></span>
			<?php
			foreach ( $all_tools as $row ) {
				$tools_image = get_term_meta( $row->term_id, 'term_image', true );

				?>
                <div class="tbtu_item  ">
                    <span class=" fz15 &nbsp;  "><?php echo $row->name; ?></span>
                    <img src="<?php echo $tools_image; ?>">
                </div>
			<?php }
			?>
        </div>
        <span class="line margin_tb40"></span>
        <div class="tour_need_box">
            <div class="tour_nxin">
              <p class="mr13">لازم است همراه بیاورید : </p>
                <?php
                $needTo= $meta['necessary_supplies'] ;
                $needToArray = explode('-',$needTo);
                foreach ( $needToArray as $item ) { ?>
                    <p class="fz11 mr13 mbt10"><i class="fa fa-circle fz5 ml_10 "></i><?php  echo $item?></p>
             <?php   }
                ?>
            </div>
            <div class="tour_nxin">
               <p class="mr13">پیشنهاد میکنیم همراه بیاورید : </p>
	            <?php
	            $proposalTo= $meta['proposal_supplies'] ;
	            $proposalToArray = explode('-',$proposalTo);
	            foreach ( $proposalToArray as $item ) { ?>
                    <p class="fz11 mr13 mbt10"><i class="fa fa-circle fz5 ml_10 "></i><?php  echo $item?></p>
	            <?php   }
	            ?>
            </div>
        </div>
		<?php

	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new the_tour_descriiption() );

