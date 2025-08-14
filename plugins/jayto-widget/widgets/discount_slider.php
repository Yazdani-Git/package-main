<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class discount_slider extends \Elementor\Widget_Base {
	public function get_name() {
		return 'discount_slider';
	}

	public function get_title() {
		return 'اسلایدر اقامتگاه تخفیف دار';
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
			'qs_section_content',
			[
				'label' => esc_html__( 'عنوان ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'qs_header_title',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'qs_header_desc',
			[
				'label'       => esc_html__( 'توضیح', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'توضیح  را وارد کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'show_each_slide',
			[
				'label' => esc_html__( 'نمایش اسلایدر هر اسلاید', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__( 'نمایش', 'textdomain' ),
				'label_off' => esc_html__( 'مخفی', 'textdomain' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'qs_content_section',
			[
				'label' => __( 'کوئری دسته بندی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$category = get_terms( array(
			'taxonomy'   => 'categories',
			'hide_empty' => false,
			'post_type'  => 'residence'
		) );

		$items = array();
		foreach ( $category as $cat ) {
			$items[ $cat->slug ] = $cat->name;
		}

		$this->add_control(
			'rqs_shows_id',
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
			'qs_SliderQueryCat',
			[

				'label'   => esc_html__( 'انتخاب دسته بندی', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $items
			]
		);
		$this->add_control(
			'qs_CatQueryList',
			[
				'label'       => __( 'انتخاب دسته بندی', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater->get_controls(),
				'title_field' => '{{{qs_SliderQueryCat}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'qs_city_content_section',
			[
				'label' => __( 'کوئری شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$cites       = get_terms( array(
			'taxonomy'   => 'city',
			'hide_empty' => false,
			'post_type'  => 'residence'
		) );
		$cites_array = [];
		foreach ( $cites as $row ) {
			$cites_array[ $row->slug ] = $row->name;
		}

		$repeater_city = new \Elementor\Repeater();
		$repeater_city->add_control(
			'qs_SliderQueryCity',
			[

				'label'   => esc_html__( 'انتخاب شهر', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $cites_array
			]
		);
		$this->add_control(
			'qs_CitesQueryList',
			[
				'label'       => __( 'انتخاب شهر', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_city->get_controls(),
				'title_field' => '{{{qs_SliderQueryCity}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'qs_region_content_section',
			[
				'label' => __( 'کوئری منطقه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$region = get_terms( array(
			'taxonomy'   => 'region',
			'hide_empty' => false,
			'post_type'  => 'residence'
		) );

		$region_array = [];
		foreach ( $region as $row ) {
			$region_array[ $row->slug ] = $row->name;
		}

		$repeater_region = new \Elementor\Repeater();
		$repeater_region->add_control(
			'qs_SliderQueryRegion',
			[

				'label'   => esc_html__( 'انتخاب منطقه', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $region_array
			]
		);
		$this->add_control(
			'qs_RegionQueryList',
			[
				'label'       => __( 'انتخاب منطقه', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_region->get_controls(),
				'title_field' => '{{{qs_SliderQueryRegion}}}',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'qs_tools_content_section',
			[
				'label' => __( 'کوئری امکانات', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$tools = get_terms( array(
			'taxonomy'   => 'tools',
			'hide_empty' => false,
			'post_type'  => 'residence'
		) );

		$tools_array = [];
		foreach ( $tools as $row ) {
			$tools_array[ $row->slug ] = $row->name;
		}

		$repeater_tools = new \Elementor\Repeater();
		$repeater_tools->add_control(
			'qs_SliderQueryTools',
			[

				'label'   => esc_html__( 'انتخاب امکانات', 'Vitrin-Plugin' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $tools_array
			]
		);
		$this->add_control(
			'qs_ToolsQueryList',
			[
				'label'       => __( 'انتخاب امکانات', 'haula-Plugin' ),
				'type'        => \Elementor\Controls_Manager::REPEATER,
				'fields'      => $repeater_tools->get_controls(),
				'title_field' => '{{{qs_SliderQueryTools}}}',
			]
		);


		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'jt_qslider_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_qslider_title_typography',
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
			'jt_qslider_desc_style',
			[
				'label' => __( 'متن عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_qslider_desc_typography',
				'selector' => '{{WRAPPER}} .swiper_header h5',
			]
		);

		$this->add_control(
			'jt_qslider_desc_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_desc_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .swiper_header h5:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_desc_margin',
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
			'jt_qslider_item_style',
			[
				'label' => __( 'آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_qslider_item-border',
				'selector' => '{{WRAPPER}} .swiper-slide',
			]
		);
		$this->add_control(
			'jt_qslider_item_radius',
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
				'name'     => 'jt_qslider_item_shadow',
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
				'name'     => 'jt_qslider_desc_link_title_one_typography',
				'selector' => '{{WRAPPER}} .n_span',
			]
		);
		$this->add_control(
			'jt_qslider_desc_link_title_one_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_desc_link_title_one_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_desc_link_title_one_margin',
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
			'jt_qslider_desc_link_title_one_padding',
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
			'jt_qslider_city_style',
			[
				'label' => __( 'نام شهر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_qslider_city_typography',
				'selector' => '{{WRAPPER}} .scn',
			]
		);
		$this->add_control(
			'jt_qslider_city_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_city_hover',
			[
				'label'     => esc_html__( 'رنگ هاورعنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .scn:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_city_dot',
			[
				'label'     => esc_html__( 'رنگ جداکننده', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .dot_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_city_margin',
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
			'jt_qslider_city_padding',
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
			'jt_qslider_price_style',
			[
				'label' => __( 'قیمت', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_qslider_price_typography',
				'selector' => '{{WRAPPER}} .item_price .p_span',
			]
		);
		$this->add_control(
			'jt_qslider_price_color',
			[
				'label'     => esc_html__( 'رنگ', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_price .p_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_price_dis_color',
			[
				'label'     => esc_html__( 'رنگ قیمت تخفیف', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .item_price .dis_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_price_dis_size',
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
			'jt_qslider_price_percent_color',
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
			'jt_qslider_img_style',
			[
				'label' => __( 'تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_qslider_img_border',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_qslider_img_shadow',
				'selector' => '{{WRAPPER}} .qslider_image',
			]
		);
		$this->add_control(
			'jt_qslider_img_radius',
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
			'jt_qslider_img_padd',
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
				'name'     => 'jt_qslider_img_filters',
				'selector' => '{{WRAPPER}} .city_fav_image',
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'jt_qslider_navi_style',
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
			'jt_qslider_navi_radius',
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
			'jt_qslider_navi_color',
			[
				'label'     => esc_html__( 'رنگ فلش ها', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_navigap',
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
			'jt_qslider_bage_style',
			[
				'label' => __( 'بج رزرو آنی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_qslider_bage_bgcolor',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_bage_color',
			[
				'label'     => esc_html__( 'رنگ متن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_bage_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_qslider_bage_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_qslider_bage_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_qslider_bage_border',
				'selector' => '{{WRAPPER}} .hia_bag',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_qslider_bage_box_shadow',
				'selector' => '{{WRAPPER}} .hia_bag',
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'jt_qslider_sh_style',
			[
				'label' => __( 'شناسه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_qslider_sh_bg_color',
			[
				'label' => esc_html__( 'پس زمینه شناسه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_sh_color',
			[
				'label' => esc_html__( ' رنگ شناسه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'color: {{VALUE}}',
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

		$head_title  = $values['qs_header_title'];
		$show_id  = $values['rqs_shows_id'];
		$head_desc   = $values['qs_header_desc'];
		$CatQuery    = $values['qs_CatQueryList'];
		$cityQuery   = $values['qs_CitesQueryList'];
		$regionQuery = $values['qs_RegionQueryList'];
		$toolsQuery  = $values['qs_ToolsQueryList'];
		$slide_sh  = $values['show_each_slide'];
		$t_query     = [];
		if ( $CatQuery != '' || $cityQuery != '' || $regionQuery != '' ) {

			$t_query['relation'] = 'AND';

			if ( $cityQuery[0]['qs_SliderQueryCity'] != '' ) {

				$city_array = [];
				foreach ( $cityQuery as $city ) {

					$city_array[] = $city['qs_SliderQueryCity'];
				}

				$end_city_array = [ 'taxonomy' => 'city', 'field' => 'slug', 'terms' => $city_array ];
				$t_query[]      = $end_city_array;
			}

			if ( $regionQuery[0]['qs_SliderQueryRegion'] != '' ) {

				$region_array = [];
				foreach ( $regionQuery as $region ) {

					$region_array[] = $region['qs_SliderQueryRegion'];
				}

				$end_region_array = [ 'taxonomy' => 'region', 'field' => 'slug', 'terms' => $region_array ];
				$t_query[]        = $end_region_array;
			}
			if ( $CatQuery[0]['qs_SliderQueryCat'] != '' ) {
				$cat_array = [];

				foreach ( $CatQuery as $cat ) {

					$cat_array[] = $cat['qs_SliderQueryCat'];
				}

				$end_cat_array = [ 'taxonomy' => 'categories', 'field' => 'slug', 'terms' => $cat_array ];
				$t_query[]     = $end_cat_array;
			}

			if ( $toolsQuery[0]['qs_SliderQueryTools'] != '' ) {
				$tools_array = [];

				foreach ( $toolsQuery as $tools ) {

					$tools_array[] = $tools['qs_SliderQueryTools'];
				}

				$end_tools_array = [ 'taxonomy' => 'tools', 'field' => 'slug', 'terms' => $tools_array ];
				$t_query[]       = $end_tools_array;
			}

		}


		$args = array(
			'numberposts' => - 1,
			'post_type'   => 'residence',
			
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
						$item_city = get_the_terms( $row->ID, 'city' );
						$image     = wp_get_attachment_image_src( get_post_thumbnail_id( $row->ID ),'full', true );
						$alt_text  = get_post_meta( $row->ID, '_wp_attachment_image_alt', true );
						$all_meta  = get_post_meta( $row->ID );
						$meta      = unserialize( $all_meta['_all_res_meta'][0] );
						$amu       = unserialize( $all_meta['gallery_data'][0] );
						$gall = get_post_galleries_images( $row->ID);
                       
						$codeid =get_post_meta($row->ID,'codeid',true);
						$room_number = $meta['number_room'];
						if ( $room_number > 0 ) {
							$room_numbers = $room_number . '&nbspاطاق';
						} else {
							$room_numbers = 'بدون اطاق';
						}
						$amu['image_url'][] = $image[0];

						$amu_r              = array_reverse( $amu['image_url'] );
                        $discount = $meta['discount'];
                    
                        $targetDate = $discount['end_date'];

// تبدیل تاریخ شمسی به معادل timestamp
list($year, $month, $day) = explode('/', $targetDate);
$targetTimestamp = jmktime(0, 0, 0, $month, $day, $year);

// تاریخ امروز به timestamp
$todayTimestamp = jmktime(0, 0, 0, jdate('n'), jdate('j'), jdate('Y'));
$dis_allow = 'no';
if ($todayTimestamp >= $targetTimestamp) {
   $dis_allow = $dis_allow;
} else {
    $dis_allow = 'yes';
}


                        if($discount && $dis_allow =='yes' ){ ?>
 <div class="swiper-slide">
                            <a href="<?php echo get_the_permalink( $row->ID ) ?>">
                                <section class="section slider-section bor11">
                                    <div class="container slider-column">
                                        <div class="swiper swiper-slider query_slider2-<?php echo $rand2 ?>">

                                            <div class="swiper-wrapper">
                                                <img class="qslider_image2" src="<?php echo $image[0]; ?>">

												<?php
												if (!wp_is_mobile() and $slide_sh == 'yes'){
													foreach ( $amu_r as $image_url ) {

														?>
                                                        <img class="swiper-slide qslider_image2" src="<?php echo $image_url; ?>" alt="<?php echo $row->post_title ?>">
													<?php } ?>
												<?php } ?>

                                            </div>
											<?php
											if(!wp_is_mobile() && $slide_sh == 'yes'){?>
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

                                    <span class="n_span ml_10"><?php echo $row->post_title ?></span>

									<?php
									if ($show_id == 'yes'){ ?>
                                        <span class="code_st"> شناسه :  <?php  echo $codeid ?></span>
										<?php

										if ( $meta['reserve_type'] == 0 ) {
											?>
                                            <span class="hia_bag"> <i class="fa-solid fa-bolt"></i>رزرو آنی</span>
										<?php } ?>
									<?php     }
									?>
                                </div>

								<?php
								$no_city = sizeof( $item_city );
								$i       = 1;
								foreach ( $item_city as $item ) {
									?>
                                    <div>
                                    <span class="scn mbt15"><?php echo $item->name; ?><?php
	                                    if ( $i < $no_city )
		                                    echo '-'
	                                    ?></span>
                                    </div>
									<?php $i ++;
								}
								?>
                                <div class="percent_box">
									<?php
									if ($meta['discount']['perscent_discount'] != 0 or $meta['discount']['perscent_discount'] != ''){?>

                                        <span class="dis_span"><?php echo number_format( $meta['discount']['perscent_discount'] ) ?>  &nbsp;درصد تخفیف &nbsp;</span>

									<?php }

									?>
                                </div>
                                <div class="item_price">
									<?php

									if ( $meta['discount']['perscent_discount'] != 0 or $meta['discount']['perscent_discount'] != '' ) {
										$price_dis = $meta['price'] * $meta['discount']['perscent_discount'] /100;
										?>


                                        <div class="">
                                            <del class="p_span col_light fz12"><?php echo number_format( $meta['price'] ) ?></del>   <span class="p_span "><?php echo number_format( $meta['price'] - $price_dis ) ?></span><span class="currency"> تومان / هرشب </span>

                                        </div>
									<?php } else {
										?>
                                        <div class="">
                                            <span class="p_span"><?php echo number_format( $meta['price'] ) ?></span><span class="currency"> تومان / هرشب </span>
                                        </div>
									<?php }
									?>



                                </div>


                            </a>
                        </div>
                       <?php }
						?>
                       
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

\Elementor\Plugin::instance()->widgets_manager->register( new discount_slider() );