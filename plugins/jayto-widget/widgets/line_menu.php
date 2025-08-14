<?php


use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class line_menu extends Widget_Base {
	public function get_name() {
		return 'line-menu';
	}

	public function get_title() {
		return 'منوی خطی';
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
		$menus = wp_get_nav_menus();
		$items = array();
		foreach ( $menus as $menu ) {
			$items[ $menu->name ] = $menu->name;
		}

		$this->start_controls_section(
			'lineMenu_section',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'lineMenu_select',
			[
				'label'   => esc_html__( 'انتخاب منوی خطی', 'plugin-name' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'options' => $items,
			]
		);

		$this->end_controls_section();


		$this->style_tab();
	}

	private function style_tab() {

		$this->start_controls_section(
			'linMenu_StyleSection',
			[
				'label' => esc_html__( 'Content', 'plugin-name' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'linMenu_BgColor',
			[
				'label' => esc_html__( 'رنگ پس زمینه', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu_hover_BgColor',
			[
				'label' => esc_html__( ' رنگ پس زمینه زیرمنو', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li >ul' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu_titleColor',
			[
				'label' => esc_html__( 'رنگ متن آیتم', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu_titleColor_hover',
			[
				'label' => esc_html__( 'رنگ  هاور متن آیتم', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu_iconColor',
			[
				'label' => esc_html__( 'رنگ آیکن', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu_iconColor:hover',
			[
				'label' => esc_html__( 'رنگ هاورآیکن', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li:hover:before' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'linMenu-margin',
			[
				'label' => esc_html__( 'فاصله آیتم ها', 'plugin-name' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .line_menu ul li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$setting  = $this->get_settings_for_display();
		$ars_name = $setting['lineMenu_select'];

		wp_nav_menu( array(
			'menu'            => $ars_name,
			'container_class' => 'line_menu'
		) );

		
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new line_menu() );


?>

