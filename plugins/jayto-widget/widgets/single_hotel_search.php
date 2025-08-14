<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class single_hotel_search extends \Elementor\Widget_Base {
	public function get_name() {
		return 'single search_box';
	}

	public function get_title() {
		return '  باکس جستجوی هتل تک';
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
			'stjt_search_box_style',
			[
				'label' => __( 'استایل باکس جستجو ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'stjt_search_box_border',
				'selector' => '{{WRAPPER}} #search_box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'stjt_search_box_shadow',
				'selector' => '{{WRAPPER}} #search_box',
			]
		);
		$this->add_control(
			'stjt_search_box_Bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #search_box' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'stjt_search_box_title_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sedi span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'stjt_search_box_input_devider',
			[
				'label'     => esc_html__( 'جدا کننده', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'stjt_search_box_input_border',
				'selector' => '{{WRAPPER}} .sedi',
			]
		);
		$this->add_control(
			'stjt_search_box_submit_devider',
			[
				'label'     => esc_html__( 'دکمه جسنجو', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'stjt_search_box_submit_border',
				'selector' => '{{WRAPPER}} #search_but',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'stjt_search_box_submit_shadow',
				'selector' => '{{WRAPPER}} #search_but',
			]
		);
		$this->add_control(
			'stjt_search_box_submit_bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #search_but' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'stjt_search_box_submit_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} #search_but' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'stjt_search_box_submit_icon_color',
			[
				'label'     => esc_html__( 'رنگ آیکن دکمه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #search_but i' => 'color: {{VALUE}}',
				],
			]
		);

	}

	protected function render() {


		?>

		<div id="search_box">


			<div class="srarch_date_in sedi">
				<span class="search_date_in_label"><?php echo _e( 'تاریخ ورود', 'jayto' ) ?></span>

				<div id="dpi2">
					<date-picker picker-id="in_picker" from="1401/10/11"   placeholder="وارد کنید" mode="single" id="search_date_in_input2" name="search_date_in_input2">
						<template #icon></template>
					</date-picker>

				</div>

				<div class="order-num sbox">

				</div>
			</div>
			<div class="srarch_date_out sedi">
				<span class="search_date_out_label"><?php echo _e( 'تاریخ خروج', 'jayto' ) ?></span>

				<div id="dpo2">
					<date-picker picker-id="out_picker" from="1401/10/11" placeholder="وارد کنید" mode="single" id="search_date_out_input2" name="search_date_out_input2">
						<template #icon></template>
					</date-picker>

				</div>
				<div class="order-num sbox">

				</div>


			</div>
			<div class="srarch_num_people sedi">
				<span class="search_num_people_label"> <?php echo _e( 'تعداد نفرات', 'jayto' ) ?></span>
				<input class="search_num_people_input sbi" type="text" placeholder="انتخاب کنید">
				<div class="order-num sbox">
					<div class="on_num_box">
						<span class="on_title"><?php echo _e( 'تعداد نفرات', 'jayto' ) ?></span>
						<span class="n_plus">+</span>
						<span class="n_show">1</span>
						<span class="n_minus">-</span>
					</div>
				</div>
			</div>
			<span  id="search_but_st"><i class="fa-regular fa-search"></i></span>
		</div>


		<script>
            new Vue({
                el: '#dpi2',
                components: {
                    datePicker
                }

            })
            new Vue({
                el: '#dpo2',
                components: {
                    datePicker
                }

            })

		</script>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new single_hotel_search() );

