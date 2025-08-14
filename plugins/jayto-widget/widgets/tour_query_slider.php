<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_query_slider extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_query_slider';
	}

	public function get_title() {
		return 'کوئری اسلایدر تور';
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
			'tqs_section_content',
			[
				'label' => esc_html__( 'عنوان ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'tqs_header_title',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'tqs_content_section',
			[
				'label' => __( 'کوئری دسته بندی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$category = get_terms( array(
			'taxonomy'   => 'tour_category',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );

		$items = array();
		foreach ( $category as $cat ) {
			$items[ $cat->slug ] = $cat->name;
		}


		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'tqs_SliderQueryCat',
			[

				'label'   => esc_html__( 'انتخاب دسته بندی', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $items
			]
		);
		$this->add_control(
			'tqs_CatQueryList',
			[
				'label'       => __( 'انتخاب دسته بندی', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{tqs_SliderQueryCat}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'tqs_city_content_section',
			[
				'label' => __( 'کوئری شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$cites       = get_terms( array(
			'taxonomy'   => 'city',
			'hide_empty' => false,
			'post_type'  => 'tour'
		) );
		$cites_array = [];
		foreach ( $cites as $row ) {
			$cites_array[ $row->slug ] = $row->name;
		}

		$repeater_city = new \Elementor\Repeater();
		$repeater_city->add_control(
			'tqs_SliderQueryCity',
			[

				'label'   => esc_html__( 'انتخاب شهر', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $cites_array
			]
		);
		$this->add_control(
			'tqs_CitesQueryList',
			[
				'label'       => __( 'انتخاب شهر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_city->get_controls(),
				'title_field' => '{{{tqs_SliderQueryCity}}}',
			]
		);


		$this->end_controls_section();
		$repeater_region = new \Elementor\Repeater();

		$this->start_controls_section(
			'tqs_tools_content_section',
			[
				'label' => __( 'کوئری امکانات', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$tools = get_terms( array(
			'taxonomy'   => 'tour_tools',
			'hide_empty' => false,
			'post_type'  => 'tour'
		) );

		$tools_array = [];
		foreach ( $tools as $row ) {
			$tools_array[ $row->slug ] = $row->name;
		}

		$repeater_tools = new \Elementor\Repeater();
		$repeater_tools->add_control(
			'tqs_SliderQueryTools',
			[

				'label'   => esc_html__( 'انتخاب امکانات', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $tools_array
			]
		);
		$this->add_control(
			'tqs_ToolsQueryList',
			[
				'label'       => __( 'انتخاب امکانات', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_tools->get_controls(),
				'title_field' => '{{{tqs_SliderQueryTools}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'tqs_selected_content_section',
			[
				'label' => __( 'کوئری منتخب مدیر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$selected = get_terms( array(
			'taxonomy'   => 'admin_tour_selection',
			'hide_empty' => false,
			'post_type'  => 'tour'
		) );

		$selected_array = [];
		foreach ( $selected as $row ) {
			$selected_array[ $row->slug ] = $row->name;
		}

		$repeater_selected = new \Elementor\Repeater();
		$repeater_selected->add_control(
			'tqs_SliderQuery_selected',
			[

				'label'   => esc_html__( 'انتخاب مدیر', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $selected_array
			]
		);
		$this->add_control(
			'tqs_selected_QueryList',
			[
				'label'       => __( 'انتخاب مدیر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_selected->get_controls(),
				'title_field' => '{{{tqs_SliderQuery_selected}}}',
			]
		);


		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'hjt_qslider_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_title_typography',
				'selector' => '{{WRAPPER}} .swiper_header h2',
			]
		);

		$this->add_control(
			'hjt_cat_name1_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_cat_name1_color_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h2:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_cat_name1_color_margin',
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
			'hjt_cat_name1_color_padding',
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
			'hjt_qslider_item_style',
			[
				'label' => __( 'آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'hjt_qslider_item-border',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->add_control(
			'hjt_qslider_item_radius',
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
				'name'     => 'hjt_qslider_item_shadow',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_qslider_desc_link_title_one_style',
			[
				'label' => __( 'عنوان اقامتگاه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_desc_link_title_one_typography',
				'selector' => '{{WRAPPER}} .n_span',
			]
		);
		$this->add_control(
			'hjt_qslider_desc_link_title_one_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_desc_link_title_one_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_desc_link_title_one_margin',
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
			'hjt_qslider_desc_link_title_one_padding',
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
			'hjt_qslider_city_style',
			[
				'label' => __( 'نام شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_city_typography',
				'selector' => '{{WRAPPER}} .scn',
			]
		);
		$this->add_control(
			'hjt_qslider_city_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_city_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_city_dot',
			[
				'label'     => esc_html__( 'رنگ جداکننده', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dot_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_city_margin',
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
			'hjt_qslider_city_padding',
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
			'hjt_qslider_price_style',
			[
				'label' => __( 'قیمت', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_price_typography',
				'selector' => '{{WRAPPER}}  .ho_spri span',
			]
		);
		$this->add_control(
			'hjt_qslider_price_color',
			[
				'label'     => esc_html__( 'رنگ', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ho_spri span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_price_dis_color',
			[
				'label'     => esc_html__( 'رنگ قیمت تخفیف', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ho_spri span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_price_dis_size',
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
			'hjt_qslider_price_percent_color',
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
			'hjt_qslider_img_style',
			[
				'label' => __( 'تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'hjt_qslider_img_border',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'hjt_qslider_img_shadow',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_control(
			'hjt_qslider_img_radius',
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
			'hjt_qslider_img_padd',
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
				'name'     => 'hjt_qslider_img_filters',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'hjt_qslider_navi_style',
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
			'hjt_qslider_navi_radius',
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
			'hjt_qslider_navi_color',
			[
				'label'     => esc_html__( 'رنگ فلش ها', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_navigap',
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
		$values = $this->get_settings_for_display();

		$head_title    = $values['tqs_header_title'];
		$CatQuery      = $values['tqs_CatQueryList'];
		$cityQuery     = $values['tqs_CitesQueryList'];
		$toolsQuery    = $values['tqs_ToolsQueryList'];
		$selectedQuery = $values['tqs_selected_QueryList'];

		$t_query = [];
		if ( $CatQuery != '' || $cityQuery != '' || $selectedQuery != '' ) {

			$t_query['relation'] = 'AND';

			if ( $cityQuery[0]['tqs_SliderQueryCity'] != '' ) {

				$city_array = [];
				foreach ( $cityQuery as $city ) {

					$city_array[] = $city['tqs_SliderQueryCity'];
				}

				$end_city_array = [ 'taxonomy' => 'city', 'field' => 'slug', 'terms' => $city_array ];
				$t_query[]      = $end_city_array;
			}

			if ( $selectedQuery[0]['tqs_SliderQuery_selected'] != '' ) {

				$select_array = [];
				foreach ( $selectedQuery as $select ) {

					$select_array[] = $select['tqs_SliderQuery_selected'];
				}

				$end_selected_array = [ 'taxonomy' => 'admin_hotel_selection', 'field' => 'slug', 'terms' => $select_array ];
				$t_query[]          = $end_selected_array;
			}


			if ( $CatQuery[0]['tqs_SliderQueryCat'] != '' ) {
				$cat_array = [];

				foreach ( $CatQuery as $cat ) {

					$cat_array[] = $cat['tqs_SliderQueryCat'];
				}

				$end_cat_array = [ 'taxonomy' => 'tour_category', 'field' => 'slug', 'terms' => $cat_array ];
				$t_query[]     = $end_cat_array;
			}

			if ( $toolsQuery[0]['tqs_SliderQueryTools'] != '' ) {
				$tools_array = [];

				foreach ( $toolsQuery as $tools ) {

					$tools_array[] = $tools['tqs_SliderQueryTools'];
				}

				$end_tools_array = [ 'taxonomy' => 'tour_tools', 'field' => 'slug', 'terms' => $tools_array ];
				$t_query[]       = $end_tools_array;
			}

		}


		$args = array(
			'numberposts' => - 1,
			'post_type'   => 'tour',
			'orderby'     => 'rand',
			'tax_query'   => $t_query
		);


		$the_query = new WP_Query( $args );
		$rand      = rand( 10, 1000000 );
		$rand2     = rand( 10, 1000000 );

		?>

        <div class="swiper-container ">

            <div class="swiper_arrow_box">
                <div class="swiper_header">
                    <h2><?php echo $head_title ?></h2>

                </div>
                <div class="swiper-but-box">
                    <div class=" sqbp swiper_que_but_prev<?php echo $rand ?>"><span class="fa fa-chevron-right"></span></div>
                    <div class="sqbn swiper_que_but_next<?php echo $rand ?>"><span class="fa fa-chevron-left"></div>
                </div>
            </div>
            <div class="swiper query_slider<?php echo $rand ?>">

                <div class="swiper-wrapper">

					<?php

					foreach ( $the_query->posts as $row ) {

						$item_city          = get_the_terms( $row->ID, 'city' );
						$image              = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'full', true );
						$alt_text           = get_post_meta( $row->ID, '_wp_attachment_image_alt', true );
						$all_meta           = get_post_meta( $row->ID );
						$tmeta              = get_post_meta( $row->ID, 'all_tour_meta', true );
						$amu['image_url'][] = $image[0];
						$amu_r              = array_reverse( $amu['image_url'] )
						?>
                        <div class="swiper-slide">
                            <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                <section class="section slider-section slide2_width bor11">
                                    <div class="container slider-column">
                                        <div class="swiper swiper-slider query_slider2-<?php echo $rand2 ?>">

                                            <div class="swiper-wrapper">

												<?php
												if ( ! wp_is_mobile() ) { ?>
                                                <img class="swiper-slide qslider_image2" src="<?php echo $image[0]; ?>" alt="<?php echo $row->post_title ?>">

												<?php
												foreach ( $amu_r as $image_url ) { ?>
                                                    <img class="swiper-slide qslider_image2" src="<?php echo $image_url; ?>" alt="<?php echo $row->post_title ?>">
												<?php } ?>


                                            </div>
                                            <div class="swiper-pagination"></div>
                                            <div class="sqsbnp">
                                                <div class="swiper_quee_but_next<?php echo $rand2 ?> sqbp2"><span class="fa fa-chevron-circle-right fz25"></div>
                                                <div class="swiper_quee_but_prev<?php echo $rand2 ?> sqbp2"><span class="fa fa-chevron-circle-left fz25"></div>
                                            </div>
											<?php } else { ?>
                                                <img class="swiper-slide qslider_image2" src="<?php echo $image[0]; ?>" alt="<?php echo $row->post_title ?>">

											<?php } ?>

                                        </div>
                                    </div>
                                    <script>
                                        var swiper2 = new Swiper(".query_slider2-<?php  echo $rand2?>", {

                                            pagination: {
                                                el: ".swiper-pagination",
                                                dynamicBullets: true,
                                                clickable: true
                                            },
                                            navigation: {
                                                nextEl: '.swiper_quee_but_next<?php  echo $rand2?>',
                                                prevEl: '.swiper_quee_but_prev<?php  echo $rand2?>',
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

                                <div class="item_name">

                                    <span class="n_span ml_10"><?php echo $row->post_title ?></span>

                                </div>

								<?php
								$no_city = sizeof( $item_city );
								$i       = 1;
								foreach ( $item_city as $item ) {
									?>
                                    <span class="scn mbt15"><?php echo $item->name; ?><?php
										if ( $i < $no_city )
											echo '-'
										?></span>
									<?php $i ++;
								}
								?>

                                <div class="ho_spri width100 d_flex mbt10">
                                    <span class="fz11 col_gray">&nbsp;  قیمت / هر نفر :    &nbsp; <?php echo number_format( $tmeta['tour_price'] ) ?>&nbsp;تومان</span>
                                </div>

                            </a>
                        </div>
					<?php }
					?>


                </div>

            </div>
        </div>
        <script>
            var swiper = new Swiper(".query_slider<?php  echo $rand?>", {
                slidesPerView: 4.5,
                spaceBetween: 30,
                loop:true,
                freeMode: true,
                navigation: {
                    nextEl: '.swiper_que_but_next<?php  echo $rand?>',
                    prevEl: '.swiper_que_but_prev<?php  echo $rand?>',
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


\Elementor\Plugin::instance()->widgets_manager->register( new tour_query_slider() );

