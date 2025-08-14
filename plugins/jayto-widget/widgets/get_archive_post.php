<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class get_archive_post extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'get_archive_post';
	}

	public function get_title()
	{
		return 'پست های آرشیو';
	}

	public function get_script_depends()
	{
		return ['jayto_script'];
	}

	public function get_icon()
	{
		return 'dashicons dashicons-embed-generic';
	}

	public function get_categories()
	{
		return ['jayto'];
	}


	protected function register_controls()
	{
		$this->start_controls_section(
			'section_content',
			[
				'label' => esc_html__('Content', 'textdomain'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$this->add_control(
			'show_each_slide_arch',
			[
				'label'        => esc_html__('نمایش شناسه', 'textdomain'),
				'type'         => \Elementor\Controls_Manager::SWITCHER,
				'label_on'     => esc_html__('نمایش', 'textdomain'),
				'label_off'    => esc_html__('مخفی', 'textdomain'),
				'return_value' => 'yes',
				'default'      => 'yes',
			]
		);
		$this->add_control(
			'arch_title_widg',
			[
				'label' => esc_html__('عنوان', 'textdomain'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__('اجاره ویلا،هتل و سوییت در', 'textdomain'),
				'placeholder' => esc_html__('عنوان را تایپ کنید', 'textdomain'),
			]
		);
		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab()
	{
		$this->start_controls_section(
			'jt_archive_img_style',
			[
				'label' => __('استایل تصوبر ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_archive_img_border',
				'selector' => '{{WRAPPER}} .archive_post_item a img',
			]
		);
		$this->add_control(
			'jt_archive_img_radius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_post_item a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_img_padding',
			[
				'label'      => esc_html__('فاصله ', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_post_item a img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_archive_img_shadow',
				'selector' => '{{WRAPPER}} .archive_post_item a img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name'     => 'jt_archive_img_filters',
				'selector' => '{{WRAPPER}} .archive_post_item a img',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_title_style',
			[
				'label' => __(' نام اقامتگاه ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_archive_title_typography',
				'selector' => '{{WRAPPER}} .archpname',
			]
		);
		$this->add_control(
			'jt_archive_title_color',
			[
				'label'     => esc_html__('رنگ', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archpname' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_title_margin',
			[
				'label'      => esc_html__('فاصله خارجی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archpname' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_title_padding',
			[
				'label'      => esc_html__('فاصله داخلی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archpname' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_title_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archpname' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_title_radius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archpname' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_city_style',
			[
				'label' => __(' نام شهر/ظرفیت ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_archive_city_typography',
				'selector' => '{{WRAPPER}} .ctz span',
			]
		);
		$this->add_control(
			'jt_archive_city_color',
			[
				'label'     => esc_html__('رنگ', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctz span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_city_margin',
			[
				'label'      => esc_html__('فاصله خارجی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .ctz span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_city_padding',
			[
				'label'      => esc_html__('فاصله داخلی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .ctz span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_city_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .ctz span' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_city_radius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .ctz span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_pack_style',
			[
				'label' => __(' باکسی مشاهده پکیج ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_archive_pack_border',
				'selector' => '{{WRAPPER}} .archive_view_pack',
			]
		);
		$this->add_control(
			'jt_archive_packradius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_view_pack' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_pack_margin',
			[
				'label'      => esc_html__('فاصله', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_view_pack' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_archive_pack_shadow',
				'selector' => '{{WRAPPER}} .archive_view_pack',
			]
		);
		$this->add_control(
			't_archive_pack_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_view_pack' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_archive_pack_color',
			[
				'label'     => esc_html__('رنگ متن', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_view_pack' => 'color: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_discount_style',
			[
				'label' => __(' باکسی تخفیف ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_archive_discount_border',
				'selector' => '{{WRAPPER}} .archive_discount',
			]
		);
		$this->add_control(
			'jt_archive_discountradius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_archive_discount_shadow',
				'selector' => '{{WRAPPER}} .archive_discount',
			]
		);
		$this->add_control(
			't_archive_discount_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_discount' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_archive_discount_color',
			[
				'label'     => esc_html__('رنگ متن', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_discount' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_archive_discount_margin',
			[
				'label'      => esc_html__('فاصله', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_discount' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_items_style',
			[
				'label' => __(' باکسی آیتم ها ', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_archive_items_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .archive_post_item' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_margin',
			[
				'label'      => esc_html__('فاصله خارجی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_post_item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_padding',
			[
				'label'      => esc_html__('فاصله داخلی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_post_item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_archive_items_border',
				'selector' => '{{WRAPPER}} .archive_post_item',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_archive_items_shadow',
				'selector' => '{{WRAPPER}} .archive_post_item',
			]
		);
		$this->add_control(
			'jt_archive_items_radius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .archive_post_item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_archive_bag_style',
			[
				'label' => __('بج رزرو آنی', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_archive_items_bgcolor',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_color',
			[
				'label'     => esc_html__('رنگ متن', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_padding',
			[
				'label'      => esc_html__('فاصله داخلی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_bage_margin',
			[
				'label'      => esc_html__('فاصله خارجی', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_archive_items_bage_radius',
			[
				'label'      => esc_html__('انحنا', 'textdomain'),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors'  => [
					'{{WRAPPER}} .hia_bag' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_archive_items_border',
				'selector' => '{{WRAPPER}} .hia_bag',
			]
		);
		$this->add_control(
			'jt_archive_bag_bg_color',
			[
				'label'     => esc_html__('رنگ پس زمینه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .hia_bag' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_archive_items_box_shadow',
				'selector' => '{{WRAPPER}} .hia_bag',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_qslider_sh_style',
			[
				'label' => __('شناسه', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'jt_qslider_sh_bg_color',
			[
				'label'     => esc_html__('پس زمینه شناسه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_qslider_sh_color',
			[
				'label'     => esc_html__(' رنگ شناسه', 'textdomain'),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .code_st' => 'color: {{VALUE}}',
				],
			]
		);
	}

	public function g_terms($taxonomy, $post_type)
	{
		$terms = get_terms(array(
			'taxonomy'   => $taxonomy,
			'hide_empty' => false,
			'post_type'  => $post_type
		));

		return $terms;
	}

	protected function render()
	{

		$values   = $this->get_settings_for_display();
		$slide_sh = $values['show_each_slide_arch'];
		$onv = $values['arch_title_widg'];
		$in_date  = '';
		$out_date = '';
		$cap      = '';
		if (isset($_GET['in_date'])) {
			$in_date = $_GET['in_date'];
		}
		if (isset($_GET['out_date'])) {
			$out_date = $_GET['out_date'];
		}
		if (isset($_GET['cap'])) {
			$cap = $_GET['cap'];
		}
		if (! isset($_GET['action']) && $_GET['action'] != 'elementor') {
			$all_date_search = get_beetweens_date($in_date, $out_date);
			$terms_object    = get_queried_object();
			$tax_id          = $terms_object->term_id;
			$tax_name        = $terms_object->taxonomy;
			$post_type       = ['residence', 'hotel', 'tour'];

			if ($tax_id) {
				$posts = get_posts(
					array(
						'post_type'      => $post_type,
						'posts_per_page' => '-1',
						'tax_query'      => array(
							array(
								'taxonomy' => $tax_name,
								'field'    => 'term_id',
								'terms'    => $tax_id
							)
						)
					)
				);
			} else {
				$posts = get_posts(
					array(
						'post_type'      => 'residence',
						'posts_per_page' => '-1',

					)
				);
			}
		} else {

			$post_type   = array('residence', 'hotel', 'tour');
			$terms_check = get_terms('city', array(
				'hide_empty' => true,
			));

			$select_terms = [];

			foreach ($terms_check as $check) {
				$select_terms[] = $check->term_id;
			}

			$posts = get_posts(
				array(
					'post_type'      => $post_type,
					'posts_per_page' => '-1',
					'tax_query'      => array(
						array(
							'taxonomy' => 'city',
							'field'    => 'term_id',
							'terms'    => $select_terms,
						)
					)
				)
			);
		}

?>
		<?php

		$hide_archive_title = get_option('hide_archive_title');
		if ($terms_object->taxonomy == 'city' && $hide_archive_title == 0) {

		?>
			<h1 class="fz14 fw500 mbt10"><?php echo $onv ?> <span class="fz16 fw600"><?php echo $terms_object->name ?></span>
			</h1>
			<span class="fz11 fw400 col_gray2  spatiar"><?php echo sizeof($posts) ?>&nbsp;اقامتگاه</span>
		<?php }
		if ($posts) {
		?>
			<div class="archive_box">

				<?php

				if (! isset($_GET['cap'])) {

					foreach ($posts as $row) {
						$meta          = get_post_meta($row->ID, '_all_res_meta', 'false');
						$term_obj_list = get_the_terms($row->ID, 'city');
						$terms_string  = join(' ، ', wp_list_pluck($term_obj_list, 'name'));
						$item_city     = $term = get_term($row->ID, $tax_name);
						$image         = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), 'full');
						$hotel_rooms  = get_post_meta($row->ID, 'rooms_info', true);
						$hotel_meta = get_post_meta($row->ID, 'all_hotel_meta', 'false');
						$all_room_price = [];
						$dis_percents   = [];


						foreach ($hotel_rooms as $rooms) {
							if ($rooms['discount']) {
								$dis_percents[] = $rooms['discount']['perscent_discount'];
							}
						}

						$max_dis_percent = max($dis_percents);
						$min_price = '';
						if ($hotel_rooms) {
							foreach ($hotel_rooms as $room) {
								$all_room_price[] = $room['room_normal_price'];
							}
							$min_price = min($all_room_price);
						}

						if ($min_price != '') {
							$price = $min_price;
						} else {
							$price = $meta['price'];
						}
				?>
						<div class="archive_post_item">
							<?php

							?>

							<a href="<?php echo get_the_permalink($row->ID) ?>" class="pos_relative">
								<img src="<?php echo $image[0] ?>" alt="<?php echo $row->post_title ?>">
								<span class="fz13 col_gray2 mt_10 mr5 archpname"><?php echo $row->post_title ?></span>
								<?php

								if ($slide_sh == 'yes') {
									$codeids = get_post_meta($row->ID, 'codeid', true);

								?>
									<span class="code_st"> شناسه : <?php echo $codeids ?></span>
									<?php
									if ($hotel_meta) {

										if ($hotel_meta['type'] == 0) {
									?>
											<span class="hia_bag"> <i class="fa-solid fa-bolt"></i>رزرو آنی</span>
										<?php }
									} else {
										if ($meta['reserve_type'] == 0) {
										?>
											<span class="hia_bag"> <i class="fa-solid fa-bolt"></i>رزرو آنی</span>
									<?php }
									}

									?>

								<?php }
								?>

								<div class="ctz">
									<span class="add_info fz10 fw300 col_gray mr5"> <?php echo $terms_string ?> </span>
									<span class="dot_span_less fa fa-circle"></span>
									<?php
									if ($meta['total_capacity']) { ?>
										<span class="add_info fz10 fw300 col_gray mr5"> <?php echo $meta['total_capacity'] ?> نفر ظرفیت </span>

									<?php }

									?>
								</div>
								<?php

								if ($max_dis_percent) {
								?>

									<span class="dis_span mr10 mb10">تا <?php echo number_format($max_dis_percent) ?> &nbsp;درصد تخفیف &nbsp;</span>

								<?php }



								if ($meta['off_price'] != '') {

								?>
									<div class="mbt10">

										<span class="archive_discount fz10 fw300  fw400">تا <?php echo $meta['off_price'] ?> درصد تخفیف</span>
									</div>

								<?php } else {
								?>
									<div class="mbt10 width100 mr12"><a href="<?php echo get_the_permalink($row->ID) ?>"
											class="archive_view_pack fz10 fw300 col_gray2 fw400">مشاهده قیمت و پکیج های قابل رزرو</a></div>
								<?php }

								?>
								<span class=" fz10 fw400 col_gray2 mr5 mbt10 width100 mr12 ">شروع قیمت : <span
										class="fz12 fw700">&nbsp;<?php echo number_format($price) ?>&nbsp;تومان</span> / <span
										class="col_gray">هر شب</span></span>
								<?php

								if ($meta['reserve_type'] == 0) {
								?>

								<?php }
								?>
							</a>
						</div>
						<?php
					}
				} elseif (isset($_GET['cap'])) {
					foreach ($posts as $row) {
						$meta          = get_post_meta($row->ID, '_all_res_meta', false);
						$res_ve = get_post_meta( $row->ID, 'resistance_reserves', true );
				
						$term_obj_list = get_the_terms($row->ID, 'city');
						$reserved      = get_post_meta( $row->ID, 'resistance_reserves', true );
						$common = array_intersect($all_date_search,$reserved);
						$check_reserve = 0;

						if (!empty($common)) {
							$check_reserve = 1;
						}
						if ($meta[0]['total_capacity'] >= $cap && $check_reserve == 0) {
							$terms_string = join('،', wp_list_pluck($term_obj_list, 'name'));
							$item_city    = $term = get_term($row->ID, $tax_name);
							$image        = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), 'full');
							$hotel_rooms  = get_post_meta($row->ID, 'rooms_info', true);

							$all_room_price = [];
							$dis_percents   = [];
							foreach ($hotel_rooms as $rooms) {
								if ($rooms['discount']) {
									$dis_percents[] = $rooms['discount']['perscent_discount'];
								}
							}

							$max_dis_percent = max($dis_percents);
							$min_price = '';
							if ($hotel_rooms) {
								foreach ($hotel_rooms as $room) {
									$all_room_price[] = $room['room_normal_price'];
								}
								$min_price = min($all_room_price);
							}
							if ($min_price) {
								$meta[0]['price'] = $min_price;
							}
						?>
							<div class="archive_post_item">

								<a href="<?php echo get_the_permalink($row->ID) ?>" class="pos_relative">
									<img src="<?php echo $image[0] ?>" alt="<?php echo $row->post_title ?>">
									<span class="fz13 col_gray2 mt_10 mr5"><?php echo $row->post_title ?></span>
									<?php

									if ($slide_sh == 'yes') {
										$codeid = get_post_meta($row->ID, 'codeid', true);
									?>
										<span class="code_st"> شناسه : <?php echo $codeid ?></span>
									<?php }
									?>
									<div class="ctz">
										<span class="add_info fz10 fw300 col_gray mr5"> <?php echo $terms_string ?> </span>
										<span class="dot_span_less fa fa-circle"></span>
										<?php
										if ($meta[0]['total_capacity']) { ?>
											<span class="add_info fz10 fw300 col_gray mr5"> <?php echo $meta[0]['total_capacity'] ?> نفر ظرفیت
											</span>

										<?php }
										?>
									</div>
									<?php
									if ($max_dis_percent) {
									?>

										<span class="dis_span width50 mr10 mb10">تا <?php echo number_format($max_dis_percent) ?> &nbsp;درصد تخفیف &nbsp;</span>

									<?php }
									if ($meta[0]['off_price'] != '') {
									?>
										<div class="mbt10">
											<span class="archive_discount fz10 fw300  fw400">تا <?php echo $meta[0]['off_price'] ?> درصد تخفیف</span>
										</div>

									<?php } else {

									?>
										<div class="mbt10"><a href="<?php echo get_the_permalink($row->ID) ?>"
												class="archive_view_pack fz10 fw300 col_gray2 fw400">مشاهده قیمت و پکیج های قابل رزرو</a></div>
									<?php }
									?>
									<?php
									if ($meta[0]['discount']['perscent_discount'] != 0 or $meta[0]['discount']['perscent_discount'] != '') { ?>

										<span class="dis_span"><?php echo number_format($meta[0]['discount']['perscent_discount']) ?> &nbsp;درصد تخفیف &nbsp;</span>

									<?php }

									?>
									<span class=" fz10 fw400 col_gray2 mr5 mbt10 mr5">شروع قیمت : <span
											class="fz12 fw700">&nbsp;<?php echo number_format($meta[0]['price']) ?>&nbsp;تومان</span> / <span
											class="col_gray">هر شب</span></span>

								</a>
							</div>
						<?php }
						?>

				<?php
					}
				}
				?>
			</div>
		<?php } else { ?>
			<div class="not_post_found">
				<img src="<?php echo get_template_directory_uri() ?>/images/images.png" alt="موردی پیدا نشد">
				<span>اقامتگاهی منطبق با جستجوی شما پیدا نشد.</span>
			</div>
		<?php }
		?>


<?php
	}

	protected function content_template() {}
}


\Elementor\Plugin::instance()->widgets_manager->register(new get_archive_post());
