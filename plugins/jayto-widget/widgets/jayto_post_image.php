<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_post_image extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_post_image';
	}

	public function get_title() {
		return 'تصویر مطلب';
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


		$featured_img_url = get_the_post_thumbnail_url($post_id, 'full');
		?>
		<img src="<?php  echo $featured_img_url?>" alt="">
		<?php


		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_post_image() );

