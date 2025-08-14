<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class get_cat_posts extends \Elementor\Widget_Base {
	public function get_name() {
		return 'cat_posts';
	}

	public function get_title() {
		return 'پست های دسته بندی';
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

		$posts = get_posts(array(
			'post_type' => 'post',
			'numberposts' => -1,
			'tax_query' => array(
				array(
					'taxonomy' => 'category',
					'field' => 'term_id',
					'terms' => $obj->term_id, /// Where term_id of Term 1 is "1".
					'include_children' => false
				)
			)
		));

		?>
		<div class="blog_tile_box">
			<?php
            if ($posts){
	            foreach ( $posts as $post ) {
		            $image_url = get_the_post_thumbnail_url($post->ID, 'full');
		            ?>
                    <div class="tp_item">
                        <img src="<?php echo $image_url ?>" alt="">
                        <div class="tp_overlay">
                            <a href="<?php echo get_the_permalink($post->ID)  ?>"> <h2> <?php   echo $post->post_title?></h2></a>

                        </div>
                        <div class="border_overlay"></div>

                    </div>
	            <?php }
            }else{

                ?>
                    <div class="not_post_found">
                        <img src="<?php echo get_template_directory_uri()?>/images/images.png" alt="موردی پیدا نشد">
                        <span>موردی پیدا نشد</span>
                    </div>

                    <?php
            }

			?>
		</div>
		<?php
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new get_cat_posts() );

