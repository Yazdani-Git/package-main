<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class mobile_account extends \Elementor\Widget_Base {
	public function get_name() {
		return 'mobile_account';
	}

	public function get_title() {
		return 'صفحه کاربری موبایل';
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

    if (is_user_logged_in()){

	    require get_template_directory() . '/template-parts/user_account_menu_template.php';

    }else{

	    require get_template_directory() . '/template-parts/user_mobile_guest_acount.php';

    }



	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new mobile_account() );

