<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class favorite_dist_slider extends \Elementor\Widget_Base {
	public function get_name() {
		return 'favorite_dist_slider';
	}

	public function get_title() {
		return 'اسلایدر مقصد های محبوب';
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
			'section_content',
			[
				'label' => esc_html__( 'عنوان ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'fd_header_title',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'fd_header_desc',
			[
				'label'       => esc_html__( 'توضیح', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'توضیح  را وارد کنید', 'textdomain' ),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'ow_content_section',
			[
				'label' => __( 'کوئری', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$category = get_terms( array(
			'taxonomy'   => 'city',
			'hide_empty' => false,
			'post_type'  => 'residence'
		) );

		$items = array();
		foreach ( $category as $cat ) {
			$items[ $cat->slug ] = $cat->name;
		}

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'ow_SliderQueryCat',
			[

				'label'   => esc_html__( 'انتخاب شهرها', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $items
			]
		);
		$this->add_control(
			'ow_CatQueryList',
			[
				'label'       => __( 'انتخاب شهر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{ow_SliderQueryCat}}}',
			]
		);


		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'jt_fav_dist_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_fav_dist_title_typography',
				'selector' => '{{WRAPPER}} .swiper_header h2',
			]
		);

		$this->add_control(
			'jt_cat_name1_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jjt_cat_name1_color_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_cat_name1_color_margin',
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
			'jt_cat_name1_color_padding',
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
			'jt_fav_dist_desc_style',
			[
				'label' => __( 'متن زیر عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_fav_dist_desc_typography',
				'selector' => '{{WRAPPER}} .swiper_header h5',
			]
		);

		$this->add_control(
			'jt_fav_dist_desc_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper_header h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper_header h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_fav_dist_item_style',
			[
				'label' => __( 'آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_fav_dist_item-border',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->add_control(
			'jt_fav_dist_item_radius',
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
				'name'     => 'jt_fav_dist_item_shadow',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_fav_dist_desc_link_title_one_style',
			[
				'label' => __( 'متن لینک اول', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_fav_dist_desc_link_title_one_typography',
				'selector' => '{{WRAPPER}} .city_fav_name span:first-child',
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_one_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .city_fav_name span:first-child' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_one_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .city_fav_name span:first-child:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_one_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .city_fav_name span:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_one_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .city_fav_name span:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_fav_dist_desc_link_title_tow_style',
			[
				'label' => __( 'متن لینک دوم', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_fav_dist_desc_link_title_tow__typography',
				'selector' => '{{WRAPPER}} .fc_parent',
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_tow__color',
			[
				'label' => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fc_parent' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_tow__hover',
			[
				'label' => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .fc_parent:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_tow__margin',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .fc_parent' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_desc_link_title_tow__padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .fc_parent' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_fav_dist_img_style',
			[
				'label' => __( 'تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_fav_dist_img_border',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_fav_dist_img_shadow',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);
		$this->add_control(
			'jt_fav_dist_img_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .city_fav_image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jt_fav_dist_img_filters',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_fav_dist_navi_style',
			[
				'label' => __( 'فلش ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_fav_dist_navi_border',
				'selector' => '{{WRAPPER}} .swiper-but-next ,{{WRAPPER}} .swiper-but-prev ',
			]
		);
		$this->add_control(
			'jt_fav_dist_navi_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .swiper-but-next ,{{WRAPPER}} .swiper-but-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_fav_dist_navi_color',
			[
				'label' => esc_html__( 'رنگ فلش ها', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper-but-next > span,{{WRAPPER}} .swiper-but-prev > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_navi_gap',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
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
		$values        = $this->get_settings_for_display();
		$head_title    = $values['fd_header_title'];
		$head_desc     = $values['fd_header_desc'];
		$selected_city = $values['ow_CatQueryList'];
		$city_array    = array();

		if ( $selected_city[0]['ow_SliderQueryCat'] != '' ) {
			foreach ( $selected_city as $cat ) {

				$city_array[] = $cat['ow_SliderQueryCat'];
			}
		}
		/** @var TYPE_NAME $al_city */
		$al_city = $this->g_terms( 'city', 'residence' );

		/** @var TYPE_NAME $new_city */
		$new_city = array();
		foreach ( $al_city as $row ) {

			if ( in_array( $row->slug, $city_array ) ) {
				$new_city[] = $row;
			}
		}

		?>


        <div class="swiper_arrow_box">
            <div class="swiper_header">
                <h2><?php echo $head_title ?></h2>
                <h5><?php echo $head_desc ?></h5>
            </div>
            <div class="swiper-but-box">
                <div class="swiper-but-prev"><span class="fa fa-chevron-right"></span></div>
                <div class="swiper-but-next"><span class="fa fa-chevron-left"></div>
            </div>
        </div>
        <div class="swiper mySwiper">

            <div class="swiper-wrapper">
				<?php
				foreach ( $new_city as $item ) {
					$parent           = get_term_by( "id", $item->parent, "city" );
					$image            = get_term_meta( $item->term_id, 'term_image', true );
					$parent_term_link = get_term_link( $item->term_id, 'city' )

					?>
                    <div class="swiper-slide">
                        <a href="<?php echo $parent_term_link; ?>">
                            <img class="city_fav_image" src="<?php echo $image ?>" alt="<?php echo $item->name ?>">
                            <div class="city_fav_name">
                                <span><?php echo $item->name ?></span><span class="fc_parent"><?php if ( $parent->name != '' )
										echo ' ، ' . $parent->name ?></span>
                            </div>
                        </a>
                    </div>
				<?php }
				?>


            </div>

        </div>
        <script>
            var swiper = new Swiper(".mySwiper", {
                slidesPerView: 6.5,
                spaceBetween: 30,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper-but-next',
                    prevEl: '.swiper-but-prev',
                },
                breakpoints: {
                    500: {
                        slidesPerView: 3.1,
                        spaceBetween: 10,
                    },
                    300: {
                        slidesPerView: 2.5,
                        spaceBetween: 10,
                    },
                    400: {
                        slidesPerView: 2.5,
                        spaceBetween: 10,
                    },
                    480: {
                        slidesPerView: 3.1,
                        spaceBetween: 10,
                    },
                    900: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },
                    1200: {
                        slidesPerView: 5.5,
                        spaceBetween: 30,
                    },

                    1400: {
                        slidesPerView: 5.5,
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


\Elementor\Plugin::instance()->widgets_manager->register( new favorite_dist_slider() );

