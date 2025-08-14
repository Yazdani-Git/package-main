<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_post_content extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_post_content';
	}

	public function get_title() {
		return 'متن مطلب';
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


		$content_post = get_post( $post_id );
		$content      = $content_post->post_content;
		$content      = apply_filters( 'the_content', $content );
		$content      = str_replace( ']]>', ']]&gt;', $content );
		?>
        <h1 class="post_title"><?php echo $content; ?></h1>
		<?php


		?>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_post_content() );

