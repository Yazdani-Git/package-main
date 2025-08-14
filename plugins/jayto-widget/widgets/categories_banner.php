<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class categories_banner extends \Elementor\Widget_Base {
	public function get_name() {
		return 'category_banner';
	}

	public function get_title() {
		return 'بنر دسته بندی ها';
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
			'jt_cat_ban_title_content',
			[
				'label' => esc_html__( 'عنوان ', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'jt_cat_ban_title',
			[
				'label'       => esc_html__( 'عنوان اسلایدر', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
        $this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'jt_cat_ban_style',
			[
				'label' => __( 'استایل عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_cat_ban_title_typography',
				'selector' => '{{WRAPPER}} .bantit',
			]
		);
		$this->add_control(
			'jt_cat_ban_title_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bantit' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_cat_ban_title_border',
				'selector' => '{{WRAPPER}} .bantit',
			]
		);
		$this->add_control(
			'jt_cat_ban_title_bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .bantit' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_title_margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .bantit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_title_padding',
			[
				'label'      => esc_html__( 'فاصله دخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .bantit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_title_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .bantit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_cat_ban_items_section',
			[
				'label' => esc_html__( 'استایل آیتم ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_cat_ban_items_border',
				'selector' => '{{WRAPPER}} .category_banner',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_cat_ban_items_shadow',
				'selector' => '{{WRAPPER}} .category_banner',
			]
		);
		$this->add_control(
			'jt_cat_ban_items_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .category_banner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_margin',
			[
				'label'      => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .category_banner' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_bg__color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category_banner' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_name_options',
			[
				'label'     => esc_html__( 'نام دسته بندی', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_cat_ban_items_name_typography',
				'selector' => '{{WRAPPER}} .category_banner a',
			]
		);
		$this->add_control(
			'jt_cat_ban_items_name_color',
			[
				'label'     => esc_html__( 'Text Color', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category_banner a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_name_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .category_banner a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_icon_width',
			[
				'label'      => esc_html__( 'اندازه آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 22,
				],
				'selectors'  => [
					'{{WRAPPER}} .category_banner a img' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_items_icon_margin',
			[
				'label'      => esc_html__( 'فاصله آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .category_banner a img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_cat_ban_arrow_section',
			[
				'label' => esc_html__( 'استایل فلش ها', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_cat_ban_arrow_border',
				'selector' => '{{WRAPPER}} .sqbp ,{{WRAPPER}} .sqbn  ',
			]
		);
		$this->add_control(
			'jt_cat_ban_arrow_radius',
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
			'jt_cat_ban_arrow_color',
			[
				'label' => esc_html__( 'رنگ فلش ها', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_cat_ban_arrow_margin',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
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

	protected function render() {
		$values = $this->get_settings_for_display();

		$head_title  = $values['jt_cat_ban_title'];
		$args = array(

			'post_type' => 'residence',
			'taxonomy'  => 'categories',


		);


		$the_query = get_terms( $args );
//        print_r($the_query);
		$rand = rand( 10, 1000000 );

		?>

        <div class="swiper-container ">

            <div class="swiper_arrow_box">
                <div class="swiper_header">
                    <p class="fz16 fw700 bantit"><?php echo $head_title ?></p>
                </div>
                <div class="swiper-but-box">
                    <div class=" sqbp swiper_que_but_prev<?php echo $rand ?>"><span class="fa fa-chevron-right"></span></div>
                    <div class="sqbn swiper_que_but_next<?php echo $rand ?>"><span class="fa fa-chevron-left"></div>
                </div>
            </div>
          <div class="">
		  <div class="swiper query_slider<?php echo $rand ?>">

<div class="swiper-wrapper">

	<?php

	foreach ( $the_query as $row ) {

		$image = get_term_meta( $row->term_id, 'term_ico', true );

		?>
		<div class="swiper-slide category_banner">
			<a href="<?php echo get_term_link( $row->term_id ) ?>">
				<img src="<?php echo $image ?>" alt="">
				<?php

				echo $row->name;
				?>

			</a>
		</div>
	<?php }
	?>


</div>

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
                        slidesPerView: 1.6,
                        spaceBetween: 10,
                    },

                    750: {
                        slidesPerView: 4.2,
                        spaceBetween: 10,
                    },

                    1200: {
                        slidesPerView: 4.2,
                        spaceBetween: 30,
                    },
                    1400: {
                        slidesPerView: 4.2,
                        spaceBetween: 30,
                    },
                    1500: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                    1920: {
                        slidesPerView: 4.5,
                        spaceBetween: 30,
                    },
                }
            });
        </script>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new categories_banner() );

