<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class contact_support extends \Elementor\Widget_Base {
	public function get_name() {
		return 'contact_support';
	}

	public function get_title() {
		return 'تماس با پشتیبانی';
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
			'cs_img_body',
			[
				'label' => __( 'تصویر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]

		);
		$this->add_control(
			'cs_image',
			[
				'label'   => esc_html__( 'انتخاب تصویر', 'textdomain' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'cs_title_body',
			[
				'label' => __( ' عنوان', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]

		);
		$this->add_control(
			'cs_title_input',
			[
				'label'       => esc_html__( 'عنوان', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__( 'به کمک نیاز دارید', 'textdomain' ),
				'placeholder' => esc_html__( 'عنوان را اینجا بنویسید', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'cs_desc_body',
			[
				'label' => __( ' توضیح', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]

		);
		$this->add_control(
			'cs__description',
			[
				'label'       => esc_html__( 'متن توضیح', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXTAREA,
				'rows'        => 10,
				'default'     => esc_html__( 'کارشناسان جایتو از ساعت 7 صبح الی 7 شب آماده پاسخگویی به سوالات شما هستند.', 'textdomain' ),
				'placeholder' => esc_html__( 'توضیحات را اینجا وارد کنید.', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'cs_call_style',
			[
				'label' => __( 'شماره تماس پشتیبانی', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]


		);
		$this->add_control(
			'cs_call_number',
			[
				'label' => esc_html__( 'شماره تلفن', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( '0912-021', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'cs_img_style',
			[
				'label' => __( 'تصویر', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]


		);

		$this->add_control(
			'cs_img_width',
			[
				'label'      => esc_html__( 'عرض تصویر', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 300,
						'step' => 1,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 7,
				],
				'selectors'  => [
					'{{WRAPPER}} .cs_image' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'cs_title_style',
			[
				'label' => __( 'عنوان', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]


		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cs_title_typography',
				'selector' => '{{WRAPPER}} .cs_header_title',
			]
		);
		$this->add_control(
			'cs_title_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs_header_title' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cs_title_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cs_header_title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cs_title_align',
			[
				'label'     => esc_html__( 'تراز متن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'چپ', 'textdomain' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'وسط', 'textdomain' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'راست', 'textdomain' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .cs_header_title' => 'text-align: {{VALUE}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'cs_desc_style',
			[
				'label' => __( 'توضیح', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]


		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'cs_desc_typography',
				'selector' => '{{WRAPPER}} .cs_header_desc',
			]
		);
		$this->add_control(
			'cs_desc_color',
			[
				'label'     => esc_html__( 'رنگ توضیح', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs_header_desc' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cs_desc_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cs_header_desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cs_desc_align',
			[
				'label'     => esc_html__( 'تراز متن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::CHOOSE,
				'options'   => [
					'left'   => [
						'title' => esc_html__( 'چپ', 'textdomain' ),
						'icon'  => 'eicon-text-align-left',
					],
					'center' => [
						'title' => esc_html__( 'وسط', 'textdomain' ),
						'icon'  => 'eicon-text-align-center',
					],
					'right'  => [
						'title' => esc_html__( 'راست', 'textdomain' ),
						'icon'  => 'eicon-text-align-right',
					],
				],
				'default'   => 'center',
				'toggle'    => true,
				'selectors' => [
					'{{WRAPPER}} .cs_header_desc' => 'text-align: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'cs_but_style',
			[
				'label' => __( 'دکمه تماس', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]


		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cs_but_typography',
				'selector' => '{{WRAPPER}} .cs_but',
			]
		);
		$this->add_control(
			'cs_but_text_color',
			[
				'label' => esc_html__( 'رنگ متن' , 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs_but' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cs_but_bg_color',
			[
				'label' => esc_html__( 'رنگ دکمه' , 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cs_but' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cs_but_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cs_but' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'cs_but_shadow',
				'selector' => '{{WRAPPER}} .cs_but',
			]
		);

		$this->add_control(
			'cs_but_margin',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cs_but' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();

	}

	protected function render() {
		$settings = $this->get_settings_for_display();
		$title    = $settings['cs_title_input'];
		$desc     = $settings['cs__description'];
		$call     = $settings['cs_call_number'];
		?>
        <div class="mh_head_back">
			<?php
			if ( wp_is_mobile() ) { ?>
                <a href="<?php echo home_url() ?>/macount"> <i class="fa-thin fa-arrow-alt-right fa-2x bactoac"></i></a>

			<?php }
			?>
            </a>
        </div>
        <div class="cs_header">

            <img class="cs_image" src="<?php echo $settings['cs_image']['url'] ?>" alt="">

                <p class="cs_header_title width100"><?php echo $title ?></p>


            <span class="cs_header_desc width100"><?php echo $desc ?></span>

            <a href="tel:<?php echo $call?>" class="cs_but"> تماس با پشتیبانی</a>
        </div>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new contact_support() );

