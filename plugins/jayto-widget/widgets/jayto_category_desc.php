<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_category_desc extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_category_desc';
	}

	public function get_title() {
		return 'توضیحات دسته بندی';
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
			'jayto_cat_description_style',
			[
				'label' => esc_html__( 'استایل', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jcat_desc',
				'selector' => '{{WRAPPER}} .category_description',
			]
		);
		$this->add_control(
			'jcat_color',
			[
				'label' => esc_html__( 'رنگ', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .category_description' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jcat_border',
				'selector' => '{{WRAPPER}} .category_description',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jcat_shadow',
				'selector' => '{{WRAPPER}} .category_description',
			]
		);
		$this->add_control(
			'jcat_radius',
			[
				'label' => esc_html__( 'انحنای کادر', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],

				'selectors' => [
					'{{WRAPPER}} .category_description' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jcat_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px' ],

				'selectors' => [
					'{{WRAPPER}} .category_description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
	}

	protected function render() {

		$post_id = '';
		$get     = $_GET;
		$action  = $get['action'];
		if ( $action == 'elementor' ) {
			$args    = array(
				'post_type'      => 'post',
				'posts_per_page' => 1,
				'orderby'        => 'post_date',
				'order'          => 'DESC',
			);
			$post    = get_posts( $args );
			$post_id = 0;
			foreach ( $post as $row ) {
				$post_id = $row->ID;
			}
		} else {
			$post_id = get_the_ID();
		}


		$desc = category_description();
		?>
		<h3 class="category_description"><?php echo $desc; ?></h3>

		<?php


		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_category_desc() );

