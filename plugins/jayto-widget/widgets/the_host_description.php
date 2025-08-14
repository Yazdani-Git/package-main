<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class the_host_description extends \Elementor\Widget_Base {
	public function get_name() {
		return 'residence_description';
	}

	public function get_title() {
		return 'مشخصات میزبان';
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
			'jt_res_content_section',
			[
				'label' => esc_html__( 'محتوا', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'jt_res_about_title',
			[
				'label'       => esc_html__( 'عنوان درباره اقامتگاه', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید.', 'textdomain' ),
			]
		);
		$this->add_control(
			'jt_res_tools_title',
			[
				'label'       => esc_html__( 'عنوان امکانات اقامتگاه', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید.', 'textdomain' ),
			]
		);

		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'jt_res_info-style',
			[
				'label' => __( 'تصویر میزبان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_res_info_image_width',
			[
				'label'      => esc_html__( 'عرض تصویر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .host_prifile_image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_image_height',
			[
				'label'      => esc_html__( 'ارتفاع تصویر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 55,
				],
				'selectors'  => [
					'{{WRAPPER}} .host_prifile_image' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_image_radius',
			[
				'label'      => esc_html__( 'انحنای تصویر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 50,
				],
				'selectors'  => [
					'{{WRAPPER}} .host_prifile_image' => 'border-radius: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_res_info_image_border',
				'selector' => '{{WRAPPER}} .host_prifile_image',
			]
		);
		$this->add_control(
			'jt_res_info_image_margin',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .host_prifile_image' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_image_padding',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .host_prifile_image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_info_hostman_name',
			[
				'label' => __( 'نام میزبان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_hostman_name_typography',
				'selector' => '{{WRAPPER}} .rob_name span',
			]
		);
		$this->add_control(
			'jt_res_info_hostman_name_color',
			[
				'label'     => esc_html__( 'رنگ نام میزبان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_name span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_hostman_name_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_name span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_info_restype-style',
			[
				'label' => __( 'نوع رزرو', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_restype_typography',
				'selector' => '{{WRAPPER}} .res_type h4',
			]
		);
		$this->add_control(
			'jt_res_info_restype_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .res_type h4' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_restype_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .res_type h4' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_restype_desc_typography',
				'selector' => '{{WRAPPER}} .res_type p',
			]
		);
		$this->add_control(
			'jt_res_info_restype_desc_color',
			[
				'label'     => esc_html__( 'رنگ توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .res_type p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_info_Property-style',
			[
				'label' => __( 'ویژگی های اقامتگاه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_Property_typography',
				'selector' => '{{WRAPPER}} .rob_box_desc p',
			]
		);
		$this->add_control(
			'jt_res_info_Property_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_Property_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'important_note',
			[
				'label' => esc_html__( 'ویژگی ها', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_DProperty_typography',
				'selector' => '{{WRAPPER}} .rob_box_desc span',
			]
		);
		$this->add_control(
			'jt_res_info_DProperty_color',
			[
				'label'     => esc_html__( 'رنگ ویژگی', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_DProperty_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی ویژگی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_info_Poss-style',
			[
				'label' => __( 'امکانات اقامتگاه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_Poss_typography',
				'selector' => '{{WRAPPER}} .all_tools_box h5',
			]
		);
		$this->add_control(
			'jt_res_info_Poss_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .all_tools_box h5' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_Poss_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .all_tools_box h5' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_Poss_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .all_tools_box h5' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_Poss_BgColor',
			[
				'label'     => esc_html__( 'پس زمینه عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .all_tools_box h5' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_Poss_radius',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .all_tools_box h5' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_PossDesc_options',
			[
				'label'     => esc_html__( 'آیتم ها', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			'hr2',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_PossDesc_typography',
				'selector' => '{{WRAPPER}} .tb_item span',
			]
		);
		$this->add_control(
			'jt_res_info_PossDesc_color',
			[
				'label'     => esc_html__( 'رنگ متن آیتم', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .tb_item span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_PossDesc_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی متن آیتم', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .tb_item span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_PossIcon_width',
			[
				'label'      => esc_html__( 'اندازه آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 100,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 35,
				],
				'selectors'  => [
					'{{WRAPPER}} .tb_item img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_add_People-style',
			[
				'label' => __( 'نفر اضافه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_add_People_typography',
				'selector' => '{{WRAPPER}} .rob_box_desc p:nth-child(1)',
			]
		);
		$this->add_control(
			'jt_res_add_PeopleTitle_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(1)' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_PeopleTitle_bgcolor',
			[
				'label'     => esc_html__( 'پس زمینه عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(1)' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_PeopleTitle_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(1)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'jt_res_add_PeopleTitle_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(1)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_PeopleTitle_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(1)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_PeopleTitle_note',
			[
				'label' => esc_html__( 'توضیح', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_add_People_desc_typography',
				'selector' => '{{WRAPPER}} .rob_box_desc p:nth-child(2)',
			]
		);
		$this->add_control(
			'jt_res_add_People_desc_color',
			[
				'label'     => esc_html__( 'رنگ توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(2)' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_People_desc_bgcolor',
			[
				'label'     => esc_html__( 'پس زمینه توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(2)' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_People_desc_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(2)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_People_desc_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(2)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'jt_res_add_People_desc_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(2)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopledesc_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_pricec_note',
			[
				'label' => esc_html__( 'توضیح قیمت', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_add_Peopled_pricec_typography',
				'selector' => '{{WRAPPER}} .rob_box_desc p:nth-child(3)',
			]
		);
		$this->add_control(
			'jjt_res_add_Peopled_pricec_color',
			[
				'label'     => esc_html__( 'رنگ توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(3)' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_pricec_bgcolor',
			[
				'label'     => esc_html__( 'پس زمینه توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(3)' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_pricec_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(3)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_pricec_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(3)' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'jt_res_add_Peopled_pricec_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_desc p:nth-child(3)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_PeopleIcon_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_icon_note',
			[
				'label' => esc_html__( 'آیکن', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_control(
			'jt_res_add_Peopled_icon_color',
			[
				'label'     => esc_html__( 'رنگ آیکن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .rob_box_img i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_icon_size',
			[
				'label'      => esc_html__( 'اندازه فونت', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 40,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_img i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_add_Peopled_icon_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .rob_box_img i' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_res_info_mapTitle-style',
			[
				'label' => __( 'نقشه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_res_info_mapTitle_typography',
				'selector' => '{{WRAPPER}} .mapti',
			]
		);
		$this->add_control(
			'jt_res_info_mapTitle_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mapti' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapTitle_bgcolor',
			[
				'label'     => esc_html__( 'رنگ پس زمینه عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mapti' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapTitle_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .mapti' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapTitle_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی عنوان', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .mapti' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_note',
			[
				'label' => esc_html__( 'توضیح نقشه', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_color',
			[
				'label'     => esc_html__( 'رنگ توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mapde' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_bgcolor',
			[
				'label'     => esc_html__( 'رنگ پس زمینه توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .mapde' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی توضیح', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .mapde' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_padding',
			[
				'label'      => esc_html__( 'فاصله داخلی توضیح', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .mapde' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_res_info_mapDesc_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .mapde' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function render() {

		if ( ! isset ( $_GET['action'] ) ) {
			$residence_id = get_the_ID();
		} else {
			$residence_id = create_post_id();
		}
		$show_map=get_option('show_map_single');
		global $post;
		if ( ! isset ( $_GET['action'] ) ) {
			$post_id = $post->ID;
		} else {
			$post_id = create_post_id();
		}
		$author_id  = $post->post_author;
		$meta       = get_post_meta( $post_id, '_all_res_meta', false );
		$all_meta   = get_user_meta( $author_id );
		$res_type   = $meta[0]['reserve_type'];
		$all_tools  = get_terms( array(
			'taxonomy'   => 'tools',
			'hide_empty' => false,
		) );
		$tools      = get_the_terms( $residence_id, 'tools' );
		$tools_arry = [];
		foreach ( $tools as $row ) {
			$tools_arry[] = $row->name;
		}
		$outhor_image = get_user_meta( $author_id, 'user_profile_imsge' );
		$meta         = get_post_meta( $post->ID, '_all_res_meta', false );
		$lat          = $meta[0]['map_point_lat'];
		$lng          = $meta[0]['map_point_lng'];
		if ( ! $lat ) {
			$lat = 35.7009;
		}
		if ( ! $lng ) {
			$lng = 51.3912;
		}
		$settings = $this->get_settings_for_display();
        $res_about = $settings['jt_res_about_title'];
        $res_tools = $settings['jt_res_tools_title'];
        if ($res_about == ''){
            $res_about = 'مشخصات اقامتگاه';
        }
        if ($res_tools == ''){
            $res_tools = 'امکانات اقامتگاه';
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
        <span class="line margin_tb40"></span>

        <div class="residence_option_box ">
			<?php
			if ( $res_type == '0' ) {
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
        <div class="residence_option_box ">
            <div class="rob_box">

                <div class="rob_box_img">
                    <img src="<?php echo get_template_directory_uri() ?>/images/about_residenc.png" alt="">
                </div>
                <div class="rob_box_desc">
                    <p class="fz16 fw500"><?php echo $res_about ?></p>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['The_area_of_meter'] ?><?php echo _e( ' متر زیربنا', 'jayto' ) ?></span><span class="dot_span fa fa-circle"></span>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['total_area_of_building_meter'] ?><?php echo _e( ' متر کل بنا', 'jayto' ) ?></span><span class="dot_span fa fa-circle"></span>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['number_room'] ?> اتاق</span>
                </div>
            </div>
            <div class="rob_box">
                <div class="rob_box_img">
                    <img src="<?php echo get_template_directory_uri() ?>/images/capacity.png" alt="">
                </div>

                <div class="rob_box_desc">
                    <p class="fz16 fw500">ظرفیت</p>
                    <span class="fz13 fw400 col_gray">ظرفیت <?php echo $meta[0]['total_capacity'] ?><?php echo _e( ' نفر', 'jayto' ) ?></span><span
                            class="fz13 fw400 col_gray">(<?php echo $meta[0]['base_capacity'] ?>&nbsp;<?php echo _e( ' نفر پایه', 'jayto' ) ?> &nbsp;+&nbsp;<?php echo $meta[0]['total_capacity'] - $meta[0]['base_capacity'] ?> نفر اضافه)&nbsp;</span>
                </div>
            </div>
            <div class="rob_box">
                <div class="rob_box_img">
                    <img src="<?php echo get_template_directory_uri() ?>/images/bed set.png" alt="">
                </div>
                <div class="rob_box_desc">
                    <p class="fz16 fw500"><?php echo _e( 'سرویس های خواب. ', 'jayto' ) ?></p>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['double_bed'] ?><?php echo _e( ' تخت دو نفره', 'jayto' ) ?></span><span class="dot_span fa fa-circle"></span>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['Single_bed'] ?><?php echo _e( ' تخت یک نفره', 'jayto' ) ?></span><span class="dot_span fa fa-circle"></span>
                    <span class="fz13 fw400 col_gray"><?php echo $meta[0]['mattress'] ?><?php echo _e( ' رختخواب سنتی', 'jayto' ) ?></span>
                </div>
            </div>
            <div class="rob_box">
                <div class="rob_box_img">
                    <img src="<?php echo get_template_directory_uri() ?>/images/toilets.png" alt="">
                </div>
                <div class="rob_box_desc">
                    <p class="fz16 fw500"><?php echo _e( ' سرویس های بهداشتی', 'jayto' ) ?></p>
					<?php
					$iranian_toilet = 'سرویس بهداشتی ایرانی ندارد';
					$sitting_toilet = 'سرویس بهداشتی فرنگی ندارد';
					if ( $meta[0]['iranian_toilet'] > 0 ) {
						$iranian_toilet = $meta[0]['iranian_toilet'] . '&nbspسرویس بهداشتی ایرانی';
					}
					if ( $meta[0]['sitting_toilet'] > 0 ) {
						$sitting_toilet = $meta[0]['sitting_toilet'] . '&nbspسرویس بهداشتی فرنگی';
					}
					?>
                    <span class="fz12 fw400 col_gray"><?php echo _e( $iranian_toilet, 'jayto' ) ?> </span><span class="dot_span fa fa-circle"></span>
                    <span class="fz12 fw400 col_gray"><?php echo _e( $sitting_toilet, 'jayto' ) ?></span><span class="dot_span fa fa-circle"></span>
                    <span class="fz12 fw400 col_gray"><?php echo $meta[0]['Bathroom'] ?> &nbspحمام</span>
                </div>
            </div>
			<?php

			if ( ! isset ( $_GET['action'] ) ) {
				if ( $post->post_content != '' ) {
					$query   = get_post( get_the_ID() );
					$content = apply_filters( 'the_content', $query->post_content );
					?>
                    <span class="line margin_tb40"></span>
                    <div class="rob_box_description">
                        <p class="fz15 col_gray2"><?php echo $content; ?></p>

                    </div>
				<?php }
			}

			?>

            <span class="line margin_tb40"></span>
            <div class="all_tools_box">
                <h5 class="w100 fz16 fw500"><?php echo _e( $res_tools, 'jayto' ) ?></h5>
				<?php
                $disable_option = get_option('disable_res_tools');
                if ($disable_option == 1){
	                foreach ( $all_tools as $row ) {
		                $tools_image = get_term_meta( $row->term_id, 'term_image', true );
		                ?>
                        <?php
                        if (in_array( $row->name, $tools_arry )){ ?>
                            <div class="tb_item  ">

                        <span class=" fz15 &nbsp;  >"><?php echo $row->name; ?></span>
                                <img src="<?php echo $tools_image; ?>">
                            </div>
                     <?php   }
                        ?>

	                <?php }
                }else{
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
                }

				?>
            </div>
        </div>
        <span class="line margin_tb40"></span>
        <div class="rob_box">
            <div class="rob_box_img">

                <i class="fa-regular fa-user-plus fa-2x"></i>
            </div>
            <div class="rob_box_desc">
                <p class="fz16 fw500"><?php echo _e( 'نفر اضافه', 'jayto' ) ?></p>
                <p class="fz13 col_gray fw400"><?php echo _e( 'هزینه‌ای که برای نفرات بیش از استاندارد (سرویس خواب و …) به مبلغ رزرو اضافه می‌شود.', 'jayto' ) ?></p>
                <p class="fz15 col_gray fw400"><?php echo _e( 'قیمت هر نفر اضافه به ازای هر شب: ', 'jayto' ) ?><span class="fz15 fw500 col_gray2"><?php echo $meta[0]['extra_person'] ?>&nbsp; <?php echo _e( 'هزار تومان', 'jayto' ) ?></span>&nbsp;<?php echo _e( 'میباشد.', 'jayto' ) ?></p>
            </div>
        </div>
		<?php
if($show_map == 1){ ?>
  <span class="line margin_tb40"></span>
        <p class="fw700 fz16 mapti"><?php echo _e( 'موقعیت مکانی: ', 'jayto' ) ?></p>
        <p class="fw300 fz12 mt_10 mapde"><?php echo _e( 'موقعیت مکانی دقیق اقامتگاه پس از رزرو کامل در پنل کاربری در دسترس خواهد بود.: ', 'jayto' ) ?></p>
        <div id="map">


        </div>
<?php }
		?>
      

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

        <script>
            var homeMarker = L.icon({
                iconUrl: '<?php echo get_template_directory_uri(); ?>/images/pointssv.svg',
                iconSize: [90, 90],
                iconAnchor: [22, 94],
                shadowAnchor: [4, 62],
                popupAnchor: [-3, -76]
            });

            let map = L.map('map').setView([<?php echo $lat ?> , <?php echo $lng ?>], 14);

            L.tileLayer('https://vt.parsimap.com/comapi.svc/tile/parsimap/{x}/{y}/{z}.jpg?token=ee9e06b3-dcaa-4a45-a60c-21ae72dca0bb', {
                maxZoom: 15,
                attribution: '',
                icon: homeMarker,
                // minZoom: 15
            }).addTo(map);
            map.dragging.disable();
            L.marker([<?php echo $lat ?> , <?php echo $lng ?>], {icon: homeMarker}).addTo(map);
        </script>

		<?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new the_host_description() );

