<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class hotel_query_slider extends \Elementor\Widget_Base {
	public function get_name() {
		return 'hotel_query_slider';
	}

	public function get_title() {
		return 'کوئری اسلایدر هتل';
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
			'hqs_section_content',
			[
				'label' => esc_html__( 'عنوان ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'hqs_header_title',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'hqs_header_desc',
			[
				'label'       => esc_html__( 'توضیح', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'توضیح  را وارد کنید', 'textdomain' ),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'hqs_content_section',
			[
				'label' => __( 'کوئری دسته بندی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$category = get_terms( array(
			'taxonomy'   => 'hotel_category',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );

		$items = array();
		foreach ( $category as $cat ) {
			$items[ $cat->slug ] = $cat->name;
		}
		$this->add_control(
			'hqs_shows_id',
			[
				'label'        => esc_html__( 'نمایش شناسه', 'Vitrin-Plugin' ),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'نمایش', 'Vitrin-Plugin' ),
				'label_off'    => esc_html__( 'مخفی', 'Vitrin-Plugin' ),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);

		$repeater = new \Elementor\Repeater();
		$repeater->add_control(
			'hqs_SliderQueryCat',
			[

				'label'   => esc_html__( 'انتخاب دسته بندی', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $items
			]
		);
		$this->add_control(
			'hqs_CatQueryList',
			[
				'label'       => __( 'انتخاب دسته بندی', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{hqs_SliderQueryCat}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'hqs_city_content_section',
			[
				'label' => __( 'کوئری شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$cites       = get_terms( array(
			'taxonomy'   => 'city',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );
		$cites_array = [];
		foreach ( $cites as $row ) {
			$cites_array[ $row->slug ] = $row->name;
		}

		$repeater_city = new \Elementor\Repeater();
		$repeater_city->add_control(
			'hqs_SliderQueryCity',
			[

				'label'   => esc_html__( 'انتخاب شهر', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $cites_array
			]
		);
		$this->add_control(
			'hqs_CitesQueryList',
			[
				'label'       => __( 'انتخاب شهر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_city->get_controls(),
				'title_field' => '{{{hqs_SliderQueryCity}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'hqs_region_content_section',
			[
				'label' => __( 'کوئری منطقه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$region = get_terms( array(
			'taxonomy'   => 'region',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );

		$region_array = [];
		foreach ( $region as $row ) {
			$region_array[ $row->slug ] = $row->name;
		}

		$repeater_region = new \Elementor\Repeater();
		$repeater_region->add_control(
			'hqs_SliderQueryRegion',
			[

				'label'   => esc_html__( 'انتخاب منطقه', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $region_array
			]
		);
		$this->add_control(
			'hqs_RegionQueryList',
			[
				'label'       => __( 'انتخاب منطقه', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_region->get_controls(),
				'title_field' => '{{{hqs_SliderQueryRegion}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'hqs_tools_content_section',
			[
				'label' => __( 'کوئری امکانات', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$tools = get_terms( array(
			'taxonomy'   => 'hotel_tools',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );

		$tools_array = [];
		foreach ( $tools as $row ) {
			$tools_array[ $row->slug ] = $row->name;
		}

		$repeater_tools = new \Elementor\Repeater();
		$repeater_tools->add_control(
			'hqs_SliderQueryTools',
			[

				'label'   => esc_html__( 'انتخاب امکانات', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $tools_array
			]
		);
		$this->add_control(
			'hqs_ToolsQueryList',
			[
				'label'       => __( 'انتخاب امکانات', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_tools->get_controls(),
				'title_field' => '{{{hqs_SliderQueryTools}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'hqs_selected_content_section',
			[
				'label' => __( 'کوئری منتخب مدیر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$selected = get_terms( array(
			'taxonomy'   => 'admin_hotel_selection',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );

		$selected_array = [];
		foreach ( $selected as $row ) {
			$selected_array[ $row->slug ] = $row->name;
		}

		$repeater_selected = new \Elementor\Repeater();
		$repeater_selected->add_control(
			'hqs_SliderQuery_selected',
			[

				'label'   => esc_html__( 'انتخاب مدیر', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $selected_array
			]
		);
		$this->add_control(
			'hqs_selected_QueryList',
			[
				'label'       => __( 'انتخاب مدیر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_selected->get_controls(),
				'title_field' => '{{{hqs_SliderQuery_selected}}}',
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
			'hjt_qslider_desc_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_desc_typography',
				'selector' => '{{WRAPPER}} .swiper_header h5',
			]
		);

		$this->add_control(
			'hjt_qslider_desc_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_desc_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_desc_margin',
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
			'jt_qslider_desc_padding',
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
				'selector' => '{{WRAPPER}} .item_price .p_span',
			]
		);
		$this->add_control(
			'hjt_qslider_price_color',
			[
				'label'     => esc_html__( 'رنگ', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_price .p_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_price_dis_color',
			[
				'label'     => esc_html__( 'رنگ قیمت تخفیف', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_price .dis_span' => 'color: {{VALUE}}',
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
		$this->start_controls_section(
			'hjt_qslider_sh_style',
			[
				'label' => __( 'شناسه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'hjt_qslider_sh_bg_color',
			[
				'label'     => esc_html__( 'پس زمینه شناسه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_sh_color',
			[
				'label'     => esc_html__( ' رنگ شناسه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'hjt_qslider_bag_style',
			[
				'label' => __( 'بج رزرو آنی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'hjt_qslider_bag_typography',
				'selector' => '{{WRAPPER}} .hia_bag',
			]
		);


		$this->add_control(
			'hjt_qslider_bag_bg_color',
			[
				'label'     => esc_html__( 'پس زمینه شناسه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag ' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'hjt_qslider_bag_color',
			[
				'label'     => esc_html__( ' رنگ شناسه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag ' => 'color: {{VALUE}}',
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

		$head_title    = $values['hqs_header_title'];
		$show_id       = $values['hqs_shows_id'];
		$head_desc     = $values['hqs_header_desc'];
		$CatQuery      = $values['hqs_CatQueryList'];
		$cityQuery     = $values['hqs_CitesQueryList'];
		$regionQuery   = $values['hqs_RegionQueryList'];
		$toolsQuery    = $values['hqs_ToolsQueryList'];
		$selectedQuery = $values['hqs_selected_QueryList'];

		$t_query = [];
		$additional_queries = []; // آرایه‌ای برای نگهداری کوئری‌های اضافی

		if ($CatQuery != '' || $cityQuery != '' || $regionQuery != '' || $selectedQuery != '' || $toolsQuery != '') {

			$t_query['relation'] = 'AND';

			if ($cityQuery[0]['hqs_SliderQueryCity'] != '') {
				$city_array = [];
				foreach ($cityQuery as $city) {
					$city_array[] = $city['hqs_SliderQueryCity'];
				}
				$additional_queries[] = ['taxonomy' => 'city', 'field' => 'slug', 'terms' => $city_array];
			}

			if ($selectedQuery[0]['hqs_SliderQuery_selected'] != '') {
				$select_array = [];
				foreach ($selectedQuery as $select) {
					$select_array[] = $select['hqs_SliderQuery_selected'];
				}
				$additional_queries[] = ['taxonomy' => 'admin_hotel_selection', 'field' => 'slug', 'terms' => $select_array];
			}

			if ($regionQuery[0]['hqs_SliderQueryRegion'] != '') {
				$region_array = [];
				foreach ($regionQuery as $region) {
					$region_array[] = $region['hqs_SliderQueryRegion'];
				}
				$additional_queries[] = ['taxonomy' => 'region', 'field' => 'slug', 'terms' => $region_array];
			}

			if ($CatQuery[0]['hqs_SliderQueryCat'] != '') {
				$cat_array = [];
				foreach ($CatQuery as $cat) {
					$cat_array[] = $cat['hqs_SliderQueryCat'];
				}
				$additional_queries[] = ['taxonomy' => 'hotel_category', 'field' => 'slug', 'terms' => $cat_array];
			}

			if ($toolsQuery[0]['hqs_SliderQueryTools'] != '') {
				$tools_array = [];
				foreach ($toolsQuery as $tools) {
					$tools_array[] = $tools['hqs_SliderQueryTools'];
				}
				$additional_queries[] = ['taxonomy' => 'hotel_tools', 'field' => 'slug', 'terms' => $tools_array];
			}

			// افزودن کوئری‌های اضافی به $t_query
			if (!empty($additional_queries)) {
				$t_query[] = $additional_queries;
			}
		}

		$args = array(
			'numberposts' => -1,
			'post_type' => 'hotel',
			'tax_query' => $t_query
		);

		$the_query = new WP_Query($args);
		$rand      = rand( 10, 1000000 );
		$rand2     = rand( 10, 1000000 );

		?>
        <div class="swiper-container ">

            <div class="swiper_arrow_box">
                <div class="swiper_header">
                    <h2><?php echo $head_title ?></h2>
                    <h5><?php echo $head_desc ?></h5>
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
						$item_city   = get_the_terms( $row->ID, 'city' );

						$image       = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ), 'full', true );
						$alt_text    = get_post_meta( $row->ID, '_wp_attachment_image_alt', true );
						$all_meta    = get_post_meta( $row->ID );
						$hotel_rooms = get_post_meta( $row->ID, 'rooms_info', true );

						$all_room_price = [];
						$dis_percents   = [];

						$date_now = jdate('Y/m/d');

						foreach ( $hotel_rooms as $rooms ) {

							if ( $rooms['discount'] ) {

								$dis_percents[] = $rooms['discount']['perscent_discount'];
							}
						}

						$max_dis_percent = max( $dis_percents );
						foreach ( $hotel_rooms as $room ) {
							$all_room_price[] = $room['room_normal_price'];
						}
						$min_price = min( $all_room_price );
						$amu       = unserialize( $all_meta['gallery_data'][0] );

						$hotel_meta = unserialize( $all_meta['all_hotel_meta'][0] );
						$codeid     = get_post_meta( $row->ID, 'codeid', true );
//						$room_number = $meta['number_room'];
//						if ( $room_number > 0 ) {
//							$room_numbers = $room_number . '&nbspاطاق';
//						} else {
//							$room_numbers = 'بدون اطاق';
//						}
						$amu['image_url'][] = $image[0];
						$amu_r              = array_reverse( $amu['image_url'] );

						?>
                        <div class="swiper-slide">
                            <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                <section class="section slider-section slide2_width bor11">
                                    <div class="container slider-column">
                                        <div class="swiper swiper-slider query_slider2-<?php echo $rand2 ?>">

                                            <div class="swiper-wrapper">
                                                <img class="qslider_image2" src="<?php echo $image[0]; ?>">

												<?php
												if (!wp_is_mobile() ){
													foreach ( $amu_r as $image_url ) {

														?>
                                                        <img class="swiper-slide qslider_image2" src="<?php echo $image_url; ?>" alt="<?php echo $row->post_title ?>">
													<?php } ?>
												<?php } ?>

                                            </div>
											<?php
											if(!wp_is_mobile() ){?>
                                                <div class="swiper-pagination"></div>
                                                <div class="sqsbnp">
                                                    <div class="swiper_quee_but_next<?php echo $rand2 ?> sqbp2"><span class="fa fa-chevron-circle-right"></div>
                                                    <div class="swiper_quee_but_prev<?php echo $rand2 ?> sqbp2"><span class="fa fa-chevron-circle-left"></div>
                                                </div>
											<?php }  ?>
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
		                            <?php

		                            if ( $show_id == 'yes' ) { ?>
                                        <span class="code_st"> شناسه :  <?php echo $codeid ?></span>
		                            <?php }
		                            ?>

                                    <span class="n_span ml_10"><?php echo $row->post_title ?></span>
                                    <span class="fz11 col_gray">(<?php echo $hotel_meta['stars'] ?> ستاره)</span>
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
                                <div class="percent_box ">
		                            <?php
		                            if ( $max_dis_percent ) {
			                            ?>

                                        <span class="dis_span mr10 mb10">تا <?php echo number_format( $max_dis_percent ) ?>  &nbsp;درصد تخفیف &nbsp;</span>

		                            <?php }

		                            ?>
                                </div>
                                <div class="ho_spri width100 d_flex mbt10 padd10">
                                    <span class="fz11 col_gray">شروع قیمت از : <?php echo number_format( $min_price ) ?> تومان / هر شب</span>
                                </div>
	                            <?php
	                            if ( $hotel_meta['type'] == 0 ) {
		                            ?>
                                    <div class="hotel_item_act d_flex width100 padd10">

                                        <span class="hia_bag "> <i class="fa-solid fa-bolt"></i>رزرو آنی</span>
                                    </div>
	                            <?php }
	                            ?>


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
                freeMode: true,
                navigation: {
                    nextEl: '.swiper_que_but_next<?php  echo $rand?>',
                    prevEl: '.swiper_que_but_prev<?php  echo $rand?>',
                },
                breakpoints: {

                    300: {
                        slidesPerView: 1,
                        spaceBetween: 10,
                    },
                    400: {
                        slidesPerView: 1,
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


\Elementor\Plugin::instance()->widgets_manager->register( new hotel_query_slider() );

