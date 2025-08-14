<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tile_blog extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tile-blog';
	}

	public function get_title() {
		return 'شبکه مطالب';
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
			'jt_tile_cat-style',
			[
				'label' => __( 'استایل آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .tp_item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_tile_cat_item_shadow',
				'selector' => '{{WRAPPER}} .tp_item',
			]
		);
		$this->add_control(
			'jt_tile_cat_item_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_tile_cat_item_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tp_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_tile_pic-style',
			[
				'label' => __( 'استایل تصاویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_tile_pic_effect_color',
			[
				'label' => esc_html__( 'رنگ افکت', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .border_overlay' => 'border-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_tile_pic_effect_radius',
			[
				'label' => esc_html__( ' انحنای افکت', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .border_overlay' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_tile_pic_effect_shadow',
				'selector' => '{{WRAPPER}} .border_overlay',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jt_tile_pic_effect_filters',
				'selector' => '{{WRAPPER}} .tp_item img',
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_tile_title-style',
			[
				'label' => __( 'استایل عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_tile_title_typography',
				'selector' => '{{WRAPPER}} .tp_overlay a h2',
			]
		);
	}

	protected function render() {
		$args = array(
			'numberposts' => 4,
			'post_type'   => 'post',
			'orderby' => 'rand'
		);

		$tile_post = get_posts( $args );
		?>
        <div class="blog_tile_box">
			<?php
			foreach ( $tile_post as $post ) {
		 	$image_url = get_the_post_thumbnail_url($post->ID, 'full');
				?>
                <div class="tp_item">
                    <img src="<?php echo $image_url ?>" alt="">
                    <div class="tp_overlay">
                        <a href="<?php echo get_the_permalink($post->ID)  ?>"> <h2> <?php   echo $post->post_title?></h2></a>

                    </div>
                    <div class="border_overlay"></div>

                </div>
			<?php }
			?>
        </div>
		<?php
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tile_blog() );

