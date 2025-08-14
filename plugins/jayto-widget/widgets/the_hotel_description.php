<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class the_hotel_description extends \Elementor\Widget_Base {
	public function get_name() {
		return 'hotel_description';
	}

	public function get_title() {
		return 'مشخصات هتل';
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
		$meta      = get_post_meta( $post->ID, 'all_hotel_meta', false );
		$all_meta  = get_user_meta( $author_id );

		$all_tools  = get_terms( array(
			'taxonomy'   => 'hotel_tools',
			'hide_empty' => false,
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

        </div>


        <div class="residence_option_box  ">
            <div class="hotel_box_description mb30">
                <h2 class="fz16 mbt15">درباره <?php echo $post->post_title ?></h2>
                <p class="fz13 fw300 mbt15 col75"><?php echo $post->post_content; ?></p>

            </div>
            <div class="mb30">
                <span class="fz14 fw700 cpoint mor_content">بیشتر</span> <i class=" mor_content_ico fa-regular fa-chevron-down"></i>
            </div>
            <hr class="mbt15">
			<?php

			if ( $meta[0]['type'] == '0' ) {
				?>
                <div class="res_type">
                    <h4 class="fz16 fw500 col_gray2"><?php echo _e( 'رزرو آنی و قطعی', 'jayto' ) ?></h4>
                    <p class="fz13 fw300 col_gray"><?php echo _e( 'برای رزرو نهایی این اقامتگاه نیازی به تایید از سمت میزبان نخواهید داشت و رزرو شما قطعی خواهد بود.', 'jayto' ) ?></p>
                </div>
			<?php } else { ?>
                <div class="res_type">
                    <h4><?php echo _e( 'رزرو نیاز به تایید میزبان', 'jayto' ) ?></h4>
                    <p class="fz13 fw300 col_gray">برای رزرو نهایی این اقامتگاه نیاز به تایید از سمت میزبان خواهید داشت .</p>
                </div>
			<?php }
			?>
			<?php
			if ( in_array( 'صبحانه', $tools_arry ) ) {
				?>

                <h5 class="fz16 fw500 "><?php echo _e( 'همراه صبحانه', 'jayto' ) ?></h5>
                <p class="fz13 fw300 col_gray"><?php echo _e( 'رزرو شما در این اقامتگاه به همراه صبحانه خواهد بود', 'jayto' ) ?></p>
			<?php }
			?>

        </div>
        <span class="line margin_tb40"></span>
        <div class="all_tools_box">
            <h5 class="w100 fz16 fw500"><?php echo _e( ' امکانات هتل', 'jayto' ) ?></h5>
			<?php
			foreach ( $all_tools as $row ) {
				$tools_image = get_term_meta( $row->term_id, 'term_image', true );

				?>
                <div class="tb_item  <?php if ( ! in_array( $row->name, $tools_arry ) ) {
					echo 'op5';
				} ?>">

                        <span class=" fz15 &nbsp;  <?php if ( ! in_array( $row->name, $tools_arry ) ) {
	                        echo 'line_tr';
                        } ?>"><?php echo $row->name; ?></span>
                    <img src="<?php echo $tools_image; ?>">
                </div>
			<?php }
			?>
        </div>
        <span class="line margin_tb40"></span>
        <div class="room_cbox">
            <span>اتاق های قابل رزرو</span>
            <div class="not_post_found">

                <div class="dfcc">

                    <img src="<?php echo get_template_directory_uri() ?>/images/images.png" alt="">
                    <span>جهت مشاهده اتاق های قابل رزرو محدوده تاریخ مورد نظر را انتخاب نمایید.</span>
                </div>
            </div>
        </div>

        <span class="line margin_tb40"></span>
        <p class="fw700 fz16 mapti"><?php echo _e( 'موقعیت مکانی: ', 'jayto' ) ?></p>
        <p class="fw300 fz12 mt_10 mapde"><?php echo _e( 'موقعیت مکانی دقیق اقامتگاه پس از رزرو کامل در پنل کاربری در دسترس خواهد بود.: ', 'jayto' ) ?></p>
        <div id="map">


        </div>

        <style>
            #map {
                height: 300px;
                border-radius: 12px;
                margin: 20px 0
            }

            .leaflet-pane img {
                opacity: .9;
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
                iconSize: [90, 90],
                iconAnchor: [22, 94],
                shadowAnchor: [20, 62],
                popupAnchor: [-3, -76]
            });
            let map = L.map('map').setView([<?php echo $lat ?> , <?php echo $lng ?>], 14);

            L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {
                maxZoom: 15,
			    attribution: '',
                icon: homeMarker,
				// minZoom:15
            }).addTo(map);
			map.dragging.disable();
            L.marker([<?php echo $lat ?> , <?php echo $lng ?>], {icon: homeMarker}).addTo(map);
        </script>

		<?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new the_hotel_description() );

