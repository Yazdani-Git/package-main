<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class get_residence_title extends \Elementor\Widget_Base {
	public function get_name() {
		return 'residence_title';
	}

	public function get_title() {
		return 'نام اقامتگاه';
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
			'jt_qslider_sh_style_sing',
			[
				'label' => __( 'شناسه', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_qslider_sh_bg_color_sing',
			[
				'label' => esc_html__( 'پس زمینه شناسه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_sin' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_sh_color_sing',
			[
				'label' => esc_html__( ' رنگ شناسه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_sin' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
	}

	protected function render() {

		if ( ! isset ( $_GET['action'] )  ) {

	            $residence_id = get_the_ID();

		} else {
			$residence_id = create_post_id();
		}

       $codeod = get_post_meta($residence_id,'codeid',true)

		?>
		<div class="d_flex dflex_colum gap30 alignc">
        <h1 class="single-title"><?php  echo get_the_title($residence_id)?></h1>
	   
        <span class="mr10 code_sin" > شناسه :  <?php  echo $codeod ?></span>
	    </div>                    
		<?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new get_residence_title() );

