<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class get_all_tour extends \Elementor\Widget_Base {
	public function get_name() {
		return 'get_tour_post';
	}

	public function get_title() {
		return 'تمام تورها';
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
			'altg_section_content',
			[
				'label' => esc_html__( 'عنوان ', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'altg_title_typography',
				'selector' => '{{WRAPPER}} .n_span',
			]
		);
		$this->add_control(
			'altg_title_color',
			[
				'label' => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'altg_title_Margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'altg_title_Padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'altg_cit_section_content',
			[
				'label' => esc_html__( 'شهر ', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'altg_city_typography',
				'selector' => '{{WRAPPER}} .plcopt',
			]
		);
		$this->add_control(
			'altg_city_color',
			[
				'label' => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .plcopt' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'altg_city_Margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .plcopt' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'altg_city_Padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .n_span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'altg_price_section_content',
			[
				'label' => esc_html__( 'قیمت ', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'altg_price_typography',
				'selector' => '{{WRAPPER}} .ho_spri span ',
			]
		);
		$this->add_control(
			'altg_price_color',
			[
				'label' => esc_html__( 'رنگ قیمت', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ho_spri span ' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'altg_price_Margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ho_spri span ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'altg_price_Padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .ho_spri span ' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}


	protected function render() {
		$args  = array(
			'numberposts' => '-1',
			'post_type'   => 'tour'
		);
		$tours = get_posts( $args );

		?>

        <div class="d_flex gap20 flex_wrap altou">
			<?php

			foreach ( $tours as $item ) {
				$item_city = get_the_terms( $item, 'city' );

				$image    = wp_get_attachment_image_src( get_post_thumbnail_id( $item->ID ), array( 300, 166 ), true );
				$alt_text = get_post_meta( $item->ID, '_wp_attachment_image_alt', true );
				$all_meta = get_post_meta( $item->ID );
				$tmeta    = get_post_meta( $item->ID, 'all_tour_meta', true );


				?>
                <a href="<?php echo get_the_permalink( $item->ID ) ?>" class="width23p justc_center">
                    <div class="">
                        <div>
                            <img class=" bor7 adafsf" src="<?php echo $image[0]; ?>" alt="<?php echo $item->post_title ?>">
                        </div>
                        <div class="item_name">
                            <span class="n_span ml_10"><?php echo $item->post_title ?></span>
                        </div>
                        <span class="width100 fz13 mr5 plcopt"><?php echo $tmeta['tour_place_opt'] ?></span>
                        <span class="scn mbt15"><?php echo $item->name; ?></span>
                        <div class="ho_spri width100 d_flex mbt10">
                            <span class="fz11 col_gray mr5">&nbsp;  قیمت / هر نفر :    &nbsp;<?php echo number_format( $tmeta['tour_price'] ) ?>&nbsp;تومان</span>
                        </div>
                    </div>
                </a>
			<?php }
			?>


        </div>
		<?php
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new get_all_tour() );

