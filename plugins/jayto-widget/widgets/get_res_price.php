<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class get_res_price extends \Elementor\Widget_Base {
	public function get_name() {
		return 'get_res_price';
	}

	public function get_title() {
		return 'قیمت اقامتگاه';
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

	}



	protected function render() {
		$meta          = get_post_meta( get_the_ID(), '_all_res_meta', true );

	?>
		<span class="mob_sdt fz14">قیمت از :</span><span class="mob_sdp fz14"><?php  echo $meta['price']?>&nbsp;تومان / شب </span>
<?php
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new get_res_price() );

