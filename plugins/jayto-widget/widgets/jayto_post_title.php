<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_post_title extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_post_title';
	}

	public function get_title() {
		return 'عنوان مطلب';
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
			'post_title_style_section',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jayto_post_title_typography',
				'selector' => '{{WRAPPER}} .post_title',
			]
		);
		$this->add_control(
			'jayto_post_title_color',
			[
				'label' => esc_html__( 'رنگ متن', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();

	}

	protected function render() {

		$post_id = '';
		$get     = $_GET;
		$action  = $get['action'];
		if ( $action=='elementor' ) {
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


		 $title = get_the_title( $post_id );
		?>
		<h1 class="post_title"><?php echo $title ;?></h1>
	
		<?php


		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_post_title() );

