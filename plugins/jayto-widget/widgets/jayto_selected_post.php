<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_selected_post extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_selected_post';
	}

	public function get_title() {
		return 'مطالب منتخب';
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
			'jt_last_post_img-style',
			[
				'label' => __( 'استایل تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_last_post_img_border',
				'selector' => '{{WRAPPER}} .lpsitem_img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_last_post_img_shadow',
				'selector' => '{{WRAPPER}} .lpsitem_img',
			]
		);
		$this->add_control(
			'jt_last_post_img_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_img_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_img_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jt_last_post_img_filters',
				'selector' => '{{WRAPPER}} .lpsitem_img img',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_last_post_title-style',
			[
				'label' => __( 'استایل عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_last_post_title_typography',
				'selector' => '{{WRAPPER}} .lpsitem_desc a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'jt_last_post_title_text_shadow',
				'selector' => '{{WRAPPER}} .lpsitem_desc a',
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_desc a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_desc a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_last_post_desc-style',
			[
				'label' => __( 'استایل توضیحات ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_last_post_desc_typography',
				'selector' => '{{WRAPPER}} .lpsitem_desc p',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'jt_last_post_desc_text_shadow',
				'selector' => '{{WRAPPER}} .lpsitem_desc p',
			]
		);
		$this->add_control(
			'jt_last_post_desc_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_desc_margin',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpsitem_desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();


	}

	protected function render() {
		$args = array(
			'numberposts' => -1,
			'post_type'   => 'post',
			'tag' => 'selected'
		);

		$tile_post = get_posts( $args );
		?>
		<div class="blog_selected_box">
			<?php
			foreach ( $tile_post as $post ) {
				$image_url = get_the_post_thumbnail_url($post->ID, 'full');
				?>
				<div class="lps_item">
					<div class="lpsitem_img">
						<img src="<?php echo $image_url ?>" alt="">
					</div>
					<div class="lpsitem_desc">
						<a href="<?php echo get_the_permalink($post->ID)?>">
							<?php echo $post->post_title?>
						</a>
						<p><?php echo get_the_excerpt($post->ID) ?></p>
					</div>


				</div>

			<?php }
			?>
		</div>
		<?php
	}
	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_selected_post() );

