<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class cat_name extends \Elementor\Widget_Base {
	public function get_name() {
		return 'cat-name';
	}

	public function get_title() {
		return 'نام دسته بندی';
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
		$obj         = get_queried_object();
		$term_parent = get_term_by( 'term_id', $obj->parent, 'category' );
		$name        = $term_parent->name;

		?>
        <h1 class="catna"><?php echo $name ?></h1>
        <h3><?php  echo $obj->name ?></h3>

	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new cat_name() );

