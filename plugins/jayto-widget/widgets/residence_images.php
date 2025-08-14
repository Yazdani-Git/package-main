<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class residence_images extends Widget_Base {
	public function get_name() {
		return 'residence_image_gallery';
	}

	public function get_title() {
		return 'گالری تصاویر اقامتگاه';
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
		$this->start_controls_section(
			'jt_res_img-style',
			[
				'label' => __( 'استایل تصاویر کوچک ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_res_img_border',
				'selector' => '{{WRAPPER}} .gallery_small_image img',
			]
		);
		$this->add_control(
			'jt_res_img_radius',
			[
				'label'      => esc_html__( 'انتحنای کادر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .gallery_small_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_res_small_img_shadow',
				'selector' => '{{WRAPPER}} .gallery_small_image img',
			]
		);
		$this->add_control(
			'jt_res_img_radius_hover',
			[
				'label'      => esc_html__( ' انحنای کادر هاور', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .gallery_small_image img:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_large_img-style',
			[
				'label' => __( 'استایل تصاویر بزرگ ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_res_large_img_border',
				'selector' => '{{WRAPPER}} .gallery_big_image img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_res_large_img_shadow',
				'selector' => '{{WRAPPER}} .gallery_big_image img',
			]
		);
		$this->add_control(
			'jt_res_large_img_radius',
			[
				'label'      => esc_html__( 'انتحنای کادر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .gallery_big_image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_large_img_hover',
			[
				'label'      => esc_html__( ' انحنای کادر هاور', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .gallery_big_image:hover' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_all_view-style',
			[
				'label' => __( 'دکمه مشاهده همه ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_all_view_typography',
				'selector' => '{{WRAPPER}} .all_image_but',
			]
		);
		$this->add_control(
			'jt_res_all_view_text_color',
			[
				'label'     => esc_html__( 'رنگ متن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .all_image_but' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_all_view_back_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .all_image_but' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_res_all_view_border',
				'selector' => '{{WRAPPER}} .all_image_but',
			]
		);

		$this->add_control(
			'jt_res_all_view_left',
			[
				'label'      => esc_html__( 'فاصله از چپ', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 36,
				],
				'selectors'  => [
					'{{WRAPPER}} .all_image_but' => 'left: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_all_view_bottom',
			[
				'label'      => esc_html__( 'فاصله از پایین', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 36,
				],
				'selectors'  => [
					'{{WRAPPER}} .all_image_but' => 'bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);
	}

	protected function render() {
		$images = [];
		global $post;
		if ( ! isset ( $_GET['action'] ) ) {
			$residence_id = get_the_ID();
			$user_id      = get_current_user_id();
		} else {
			$residence_id = create_post_id();
			$user_id      = '';
		}

		$author_id   = $post->post_author;
		$images_meta = $postData = get_post_meta( $residence_id, 'gallery_data' );

		$images     = $images_meta[0]['image_url'];
		$images     = array_reverse( $images );
		$img        = wp_get_attachment_image_src( get_post_thumbnail_id( $residence_id ), array( '1024', '1024' ), true );
		$four_image = [];

		for ( $i = 0; $i <= 3; $i ++ ) {
			$four_image[] = $images[ $i ];

		}
		if ( ! wp_is_mobile() ) { ?>
            <div class="gallery_box">

                <div class="gallery_big_image">
                    <img src="<?php echo $img[0]; ?>" alt="<?php echo $post->post_title ?>">
                </div>
                <div class="gallery_small_image ">
					<?php
					if ( $four_image ) {
						foreach ( $four_image as $item ) {

							?>
                            <img src="<?php echo $item; ?>" alt="<?php echo $post->post_title ?>">
						<?php }
					}
					?>
                    <span class="all_image_but"><?php echo _e( 'مشاهده تمام تصاویر', 'jayto' ) ?></span>
                </div>
            </div>
            <div class="swiper-box">
                <div class="swb_header">
                    <div class="box_close">
                        <span class="bc_close_icon box_cshadow"><i class="fa fa-close"></i></span>

                        <div class="fz15 col_gray2">
                            <h3><?php echo get_the_title( $residence_id ) ?></h3>
                            <!--                            <span><span>&nbspبه میزبانی &nbsp</span>--><?php //the_author_meta( 'user_name', $author_id ) ?><!--</span>-->
                        </div>
                    </div>


                </div>
                <div style="--swiper-navigation-color: #858585;--swiper-navigation-size:16; --swiper-pagination-color: #858585" class="swiper mySwiper2">
                    <div class="swiper-wrapper ">
						<?php
						if ( $four_image ) {
							foreach ( $images as $item ) {

								?>
                                <div class="swiper-slide full_slide">
                                    <img class="box_cshadow  gallery_auto" src="<?php echo $item ?>" alt="<?php echo $post->post_title ?>"/>
                                </div>
							<?php }
						}
						?>


                    </div>
                    <div class="swiper-button-next"></div>
                    <div class="swiper-button-prev"></div>
                </div>
                <div class="swiper mySwiper mb50">
                    <div class="swiper-wrapper">

						<?php
						if ( $four_image ) {
							foreach ( $images as $item ) {

								?>
                                <div class="swiper-slide c ">
                                    <img src="<?php echo $item ?>" alt="<?php echo $post->post_title ?>"/>
                                </div>
							<?php }
						}
						?>
                    </div>
                </div>
            </div>
            <script>
                var swiper = new Swiper(".mySwiper", {
                    // loop: true,
                    spaceBetween: 10,
                    slidesPerView: 7.5,
                    freeMode: true,
                    loop: true,
                    watchSlidesProgress: true,
                });
                var swiper2 = new Swiper(".mySwiper2", {
                    loop: true,
                    spaceBetween: 10,
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    thumbs: {
                        swiper: swiper,
                    },
                });
            </script>
		<?php } else {
			if ( ! isset ( $_GET['action'] ) ) {
				$residence_id = get_the_ID();
			} else {
				$residence_id = create_post_id();
			}
			if ( ! isset ( $_GET['action'] ) ) {
				$user_id = get_current_user_id();
			} else {
				$user_id = '';
			}

			$uird = $residence_id . '-' . $user_id;

			?>
            <div class="sli_full_image">
                <div class="sli_f_header">
                    <span class="sli_close box_cshadow"><i class="fa fa-close"></i></span>
                    <div class="sli_title">
                        <h3><?php echo $post->post_title ?></h3>
                    </div>

                </div>
                <div class="gallery_sli_body">
                    <div class="swiper mySwiper3">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide ">
                                <img src="<?php echo $img[0] ?>" alt="">
                            </div>
				            <?php

				            foreach ( $images as $slide ) {
					            ?>
                                <div class="swiper-slide">
                                    <img src="<?php echo $slide ?>" alt="">
                                </div>

				            <?php }
				            ?>


                        </div>
                        <div  class="swiper mySwiper4">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide ">
                                    <img src="<?php echo $img[0] ?>" alt="">
                                </div>
			                    <?php

			                    foreach ( $images as $slide ) {
				                    ?>
                                    <div class="swiper-slide">
                                        <img src="<?php echo $slide ?>" alt="">
                                    </div>

			                    <?php }
			                    ?>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
            <div class="mob_slider">
                <div class="mob_sing_fav">
                    <a href="<?php echo home_url() ?>"> <span> <i class="fa fa-chevron-right"></i></span></a>
					<?php
					if ( is_user_logged_in() ) {
						?>
                        <span class="add_to_favorite" data-uird="<?php echo $uird ?>"><i class="fas fa-heart"></i></span>

					<?php } else {
						?>
                        <span class="login_but"><i class="fas fa-heart"></i></span>

					<?php }
					?>

                </div>
                <div class="swiper mySwiper">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide ">
                            <img src="<?php echo $img[0] ?>" alt="">
                        </div>
						<?php

						foreach ( $images as $slide ) {
							?>
                            <div class="swiper-slide">
                                <img class="mgtouch" src="<?php echo $slide ?>" alt="">
                            </div>

						<?php }
						?>


                    </div>
                    <div class="swiper-pagination"></div>
                </div>
            </div>
            <script>
                var swiper = new Swiper(".mySwiper", {
                    pagination: {
                        el: ".swiper-pagination",
                    },
                });
                var swiper4 = new Swiper(".mySwiper4", {
                    // loop: true,
                    spaceBetween: 10,
                    slidesPerView: 4,
                    freeMode: true,
                    loop: true,
                    watchSlidesProgress: true,
                });
            </script>
            <script>
                var swiper3 = new Swiper(".mySwiper3", {
                    pagination: {
                        el: ".swiper-pagination3",
                    },
                    thumbs: {
                        swiper: swiper4,
                    },
                });
            </script>

		<?php }
		?>

		<?php


	}

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new residence_images() );

