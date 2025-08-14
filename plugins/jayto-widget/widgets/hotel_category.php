<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class hotel_category extends \Elementor\Widget_Base {
	public function get_name() {
		return 'hotel_category';
	}

	public function get_title() {
		return 'دسته بندی هتل';
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
			'jt_hcat_item-style',
			[
				'label' => __( 'استایل آیتم ها ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_hcat_item-border',
				'selector' => '{{WRAPPER}} .cat_image_item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_hcat_item_shadow',
				'selector' => '{{WRAPPER}} .cat_image_item',
			]
		);
		$this->add_control(
			'jt_hcat_item_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cat_image_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_hcat_img_style',
			[
				'label' => __( 'استایل تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_hcat_img_border',
				'selector' => '{{WRAPPER}} .cat_image_item img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_hcat_img_shadow',
				'selector' => '{{WRAPPER}} .cat_image_item img',
			]
		);
		$this->add_control(
			'jt_hcat_img_radius',
			[
				'label'      => esc_html__( 'انحنای حاشیه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .cat_image_item img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jt_hcat_img_css_filters',
				'selector' => '{{WRAPPER}} .cat_image_item img',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_hcat_name_style',
			[
				'label' => __( 'متن لینک اصلی ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'hcontent_typography',
				'selector' => '{{WRAPPER}} .cat_image_item > a span',
			]
		);

		$this->add_control(
			'jt_hcat_name1_color',
			[
				'label' => esc_html__( 'رنگ لینک مادر', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat_image_item > a span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_hcat_name1_color_hover',
			[
				'label' => esc_html__( 'رنگ هاور لینک مادر', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cat_image_item > a span:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_hcat_name1_margin',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .cat_name' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_hcat_name2_style',
			[
				'label' => __( 'متن لینک فرزند ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'sub_hcat_name_typography',
				'selector' => '{{WRAPPER}} .sub_cat_name > a ',
			]
		);

		$this->add_control(
			'jt_hcat_name2_color',
			[
				'label' => esc_html__( 'رنگ لینک فرزند', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub_cat_name > a ' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_hcat_name2_color_hover',
			[
				'label' => esc_html__( 'رنگ لینک فرزند', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sub_cat_name > a:hover ' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_hcat_name2_margin',
			[
				'label' => esc_html__( 'فاصله', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .sub_cat_name > a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function render() {
		$cats        = get_terms( array(
			'taxonomy'   => 'hotel_category',
			'hide_empty' => false,
			'post_type'  => 'hotel'
		) );
		$cats_parent = [];


		foreach ( $cats as $row ) {
			if ( $row->parent == 0 ) {
				$cats_parent[] = $row;

			}
		}

		?>
		<div class="cat_image_box">
			<?php

			foreach ( $cats_parent as $cat ) {
				$image            = get_term_meta( $cat->term_id, 'term_image', true );
				$child            = get_term_children( $cat->term_id, 'hotel_category' );
				$parent_term_link = get_term_link( $cat->term_id, 'hotel_category' );
				if ( ! wp_is_mobile() ) {
					?>

				<?php }
				?>
				<div class="cat_image_item">
					<img src="<?php echo $image ?>" alt="">
					<a href="<?php  echo home_url().'/hotels'; ?>"> <span class="cat_name"><?php echo $cat->name ?></span></a>
					<span class="sub_cat_name">
                <?php
                $child_num = sizeof( $child );
                $i         = 1;
                foreach ( $child as $row ) {
                     $hotel_href = home_url().'/hotels';
	                $term = get_term_by( 'id', $row, 'hotel_category' );
	                echo '<a href="'.$hotel_href.'">' . $term->name . '</a>';
	                if ( $i < $child_num ) {
		                echo ',';
	                }
	                $i ++;
                }
                ?>
            </span>
				</div>
			<?php }
			?>

		</div>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new hotel_category() );

