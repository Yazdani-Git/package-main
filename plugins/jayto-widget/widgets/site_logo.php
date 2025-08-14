<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class site_logo extends \Elementor\Widget_Base {
	public function get_name() {
		return 'site-logo';
	}

	public function get_title() {
		return 'لگوی سایت';
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

	public function get_site_logo(  ) {
		$custom_logo_id = get_theme_mod( 'custom_logo' );
		$image          = wp_get_attachment_image_src( $custom_logo_id, 'small' );
		$site_link=home_url();
		echo "<a href='$site_link'><img class='site_log' src='{$image[0]}' ></a>";
	}

	protected function register_controls() {

		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'content_section',
			[
				'label' => esc_html__( 'Content', 'Vitrin-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'vit-logo-width',
			[
				'label'      => esc_html__( 'عرض لوگو', 'Vitrin-Plugin' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],
					'%'  => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default'    => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors'  => [
					'{{WRAPPER}} .site_log' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();



	}

	protected function render() {
		$this->get_site_logo();

		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new site_logo() );

