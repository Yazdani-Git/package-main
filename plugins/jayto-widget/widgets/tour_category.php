<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_category extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_cat_slider';
	}

	public function get_title() {
		return 'اسلایدر دسته بندی تور';
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
		$this->start_controls_section(
			'tqsli_section_content',
			[
				'label' => esc_html__( 'عنوان ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'tqsli_header_title',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'hjtslsli_qslider_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjtslsli_qslider_title_typography',
				'selector' => '{{WRAPPER}} .swiper_header h2',
			]
		);

		$this->add_control(
			'hjtslsli_cat_name1_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_cat_name1_color_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_cat_name1_color_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper_header h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hjtslsli_cat_name1_color_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper_header h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'hjtslsli_qslider_item_style',
			[
				'label' => __( 'آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'hjtslsli_qslider_item-border',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_item_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-slide' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hjtslsli_qslider_item_shadow',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jtsl_qslider_desc_link_title_one_style',
			[
				'label' => __( 'عنوان اقامتگاه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjtslsli_qslider_desc_link_title_one_typography',
				'selector' => '{{WRAPPER}} .n_span',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_desc_link_title_one_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_desc_link_title_one_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_desc_link_title_one_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .n_span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_desc_link_title_one_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .n_span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'hjtslsli_qslider_city_style',
			[
				'label' => __( 'نام شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjtslsli_qslider_city_typography',
				'selector' => '{{WRAPPER}} .scn',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_city_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_city_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_city_dot',
			[
				'label'     => esc_html__( 'رنگ جداکننده', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dot_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_city_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .scn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_city_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .scn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'hjtslsli_qslider_price_style',
			[
				'label' => __( 'قیمت', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjtslsli_qslider_price_typography',
				'selector' => '{{WRAPPER}}  .ho_spri span',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_price_color',
			[
				'label'     => esc_html__( 'رنگ', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ho_spri span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_price_dis_color',
			[
				'label'     => esc_html__( 'رنگ قیمت تخفیف', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ho_spri span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_price_dis_size',
			[
				'label'      => esc_html__( 'اندازه فونت قیمت تخفیف', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 13,
				],
				'selectors'  => [
					'{{WRAPPER}} .dis_span' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);
		$this->add_control(
			'hjtslsli_qslider_price_percent_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه بالت تخفیف', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dis_percent' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'hjtslsli_qslider_img_style',
			[
				'label' => __( 'تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'hjtslsli_qslider_img_border',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hjtslsli_qslider_img_shadow',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_img_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .qslider_image2' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_img_padd',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .qslider_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'hjtslsli_qslider_img_filters',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'hjtslsli_qslider_navi_style',
			[
				'label' => __( 'فلش ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'border',
				'selector' => '{{WRAPPER}} .sqbp ,{{WRAPPER}} .sqbn ',
			]
		);
		$this->add_control(
			'hjtslsli_qslider_navi_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .sqbp,{{WRAPPER}} .sqbn ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_navi_color',
			[
				'label'     => esc_html__( 'رنگ فلش ها', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjtslsli_qslider_navigap',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors'  => [
					'{{WRAPPER}} .swiper-but-box ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	public function g_terms( $taxonomy, $post_type ) {
		$terms = get_terms( array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'post_type'  => $post_type
		) );

		return $terms;
	}

	protected function render() {
		$values     = $this->get_settings_for_display();
		$head_title = $values['tqsli_header_title'];
		$cats       = get_terms( array(
			'taxonomy'   => 'tour_category',
			'hide_empty' => false,
			'post_type'  => 'tour'
		) );
		?>

        <div class="swiper-container ">

            <div class="swiper_arrow_box">
                <div class="swiper_header">
                    <h2><?php echo $head_title ?></h2>

                </div>
                <div class="swiper-but-box">
                    <div class=" sqbp swiper_que_but_prev"><span class="fa fa-chevron-right"></span></div>
                    <div class="sqbn swiper_que_but_next"><span class="fa fa-chevron-left"></div>
                </div>
            </div>
            <div class="swiper query_slider">

                <div class="swiper-wrapper">

					<?php

					foreach ( $cats as $row ) {


						$image = get_term_meta( $row->term_id, 'term_image', true );;
						$alt_text = get_post_meta( $row->term_id, '_wp_attachment_image_alt', true );
						$all_meta = get_post_meta( $row->ID );

						?>
                        <div class="swiper-slide">
                            <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                <section class="section slider-section bor11">
                                    <div class="container slider-column">
                                        <div class="swiper swiper-slider query_slider2">

                                            <div class="swiper-wrapper">


												<?php
												if ( ! wp_is_mobile() ) { ?>

                                                    <img class="swiper-slide qslider_image2" src="<?php echo $image; ?>" alt="<?php echo $alt_text ?>">

												<?php } ?>

                                            </div>
                                            <div class="item_name">

                                                <span class="n_span ml_10"><?php echo $row->name ?></span>

                                            </div>


                                        </div>
                                    </div>
                                    <script>
                                        var swiper2 = new Swiper(".query_slider2", {

                                            navigation: {
                                                nextEl: '.swiper_quee_but_next',
                                                prevEl: '.swiper_quee_but_prev',
                                            },
                                            breakpoints: {

                                                300: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },

                                                750: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },

                                                1200: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },
                                                1400: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },
                                                1500: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },
                                                1920: {
                                                    slidesPerView: 1,
                                                    spaceBetween: 0,
                                                },
                                            }
                                        });
                                    </script>
                                </section>


                            </a>
                        </div>
					<?php }
					?>


                </div>

            </div>
        </div>
        <script>
            var swiper = new Swiper(".query_slider", {
                slidesPerView: 4.5,
                spaceBetween: 30,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper_que_but_next',
                    prevEl: '.swiper_que_but_prev',
                },
                breakpoints: {

                    300: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },
                    400: {
                        slidesPerView: 1.2,
                        spaceBetween: 10,
                    },

                    750: {
                        slidesPerView: 4.5,
                        spaceBetween: 10,
                    },

                    1200: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                    1400: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                    1500: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },
                    1920: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },
                }
            });


        </script>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_category() );

