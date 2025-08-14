<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class mobile_navigation extends \Elementor\Widget_Base {
	public function get_name() {
		return 'mobile_navigation';
	}

	public function get_title() {
		return 'نویگیشن موبایل';
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
		$user_role = jayto_get_current_user_role();

		$user_role = '';

		$rol = jayto_get_current_user_role();
		if ( in_array( 'host', $rol ) or in_array( 'administrator', $rol ) ) {
			$user_role = 'host';
		} else {
			$user_role = 'guest';
		}

		?>

        <div class="navi_box">

            <a class="nav_item" href="<?php echo home_url() ?>">
                <i class="fa-thin fa-home-lg-alt fa-2x"></i>
                <span class="nav_title">خانه</span>
            </a>
			<?php
            if ($user_role){
	            if ( $user_role == 'host' ) {
		            ?>
                    <a class="nav_item" href="<?php echo home_url() ?>/host_request/">
                        <i class="fa-thin fa-list-alt fa-2x"></i>
                        <span class="nav_title">رزرو ها</span>
                    </a>
	            <?php } else {
		            ?>
                    <a class="nav_item" href="<?php echo home_url() ?>/trips/">
                        <i class="fa-thin fa-bags-shopping fa-2x"></i>
                        <span class="nav_title">سفرها</span>
                    </a>
	            <?php }
            }else{?>
                <a class="nav_item" href="<?php echo home_url() ?>/trips/">
                    <i class="fa-thin fa-bags-shopping fa-2x"></i>
                    <span class="nav_title">سفرها</span>
                </a>
           <?php }

			?>

            <a class="nav_item" href="<?php echo home_url() ?>/favorites/">
                <i class="fa-thin fa-heart fa-2x"></i>
                <span class="nav_title">موردعلاقه</span>
            </a>

            <a class="nav_item" href="<?php echo home_url() ?>/macount">
                <i class="fa-thin fa-user fa-2x"></i>
                <span class="nav_title">حساب کاربری</span>
            </a>

        </div>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new mobile_navigation() );

