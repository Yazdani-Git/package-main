<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class image_slider extends Widget_Base {
	public function get_name() {
		return 'select_img_slider';
	}

	public function get_title() {
		return 'اسلایدر تصاویر منتخب';
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
		$this->start_controls_section(
			'ndgSlides_setting',
			[
				'label' => __( 'تنظیمات اسلاید ها', 'jayto' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'ndg_slide_image',
			[
				'label'   => __( 'انتخاب تصویر', 'jayto' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'ndg_link',
			[
				'label'         => __( 'لینک تصویر', 'jayto' ),
				'type'          => \Elementor\Controls_Manager::URL,
				'placeholder'   => __( 'https://your-link.com', 'jayto' ),
				'show_external' => true,
				'default'       => [
					'url'         => '',
					'is_external' => true,
					'nofollow'    => true,
				],
			]
		);


		$this->add_control(
			'ndg_slide_pics',
			[
				'label'  => __( ' اسلاید ها', 'jayto' ),
				'type'   => \Elementor\Controls_Manager::REPEATER,
				'fields' => $repeater->get_controls(),
//				'title_field' => '{{{ vit_slide_image}}}',
			]
		);

		$this->end_controls_section();

		$this->style_tab();
	}

	private function style_tab() {
		$this->start_controls_section(
			'ndg_section',
			[
				'label' => esc_html__( 'استایل تصاویر', 'jayto' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jndg_border',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jndg_shadow',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_control(
			'jndg_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .tile_fig' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

	}

	protected function render() {
		$values = $this->get_settings_for_display();
		$images    = $values['ndg_slide_pics'];
		$rand2     = rand( 10, 1000000 );
		?>
   <div class="swiper-container ">

<div class="swiper_arrow_box" style="width:auto" >
<div class="swiper-but-box" >

		<div class=" sqbp swiper_que_but_prev<?php echo $rand2 ?>"><span class="fa fa-chevron-right"></span></div>
		<div class="sqbn swiper_que_but_next<?php echo $rand2 ?>"><span class="fa fa-chevron-left"></span></div>
	</div>
</div>
<div class="swiper query_slider<?php echo $rand2 ?>">

	<div class="swiper-wrapper">

		<?php

		foreach ( $images as $row ) {
		

			?>
			<div class="swiper-slide">
			<a href="<?php  echo $row['ndg_link']['url']?>">
					<section class="section slider-section bor11">
						<div class="container slider-column">
							<div class="swiper swiper-slider query_slider2-<?php echo $rand2 ?>">

								<div class="swiper-wrapper">
								<img src="<?php  echo $row['ndg_slide_image']['url']?>" alt="">

								

								</div>
							
							</div>
						</div>
					
					</section>

			



				</a>
			</div>
		<?php }
		?>


	</div>

</div>
</div>
<script>
var swiper5 = new Swiper(".query_slider<?php  echo $rand2 ?>", {
	slidesPerView: 4.5,
	spaceBetween: 30,
	freeMode: true,
	navigation: {
		nextEl: '.swiper_que_but_next<?php  echo $rand2 ?>',
		prevEl: '.swiper_que_but_prev<?php  echo $rand2 ?>',
	},
	breakpoints: {

		300: {
			slidesPerView: 1,
			spaceBetween: 10,
		},
		400: {
			slidesPerView: 1,
			spaceBetween: 10,
		},

		750: {
			slidesPerView: 4.5,
			spaceBetween: 10,
		},

		1200: {
			slidesPerView: 4.5,
			spaceBetween: 30,
		},
		1400: {
			slidesPerView: 4.5,
			spaceBetween: 30,
		},
		1500: {
			slidesPerView: 5.5,
			spaceBetween: 30,
		},
		1920: {
			slidesPerView: 5.5,
			spaceBetween: 30,
		},
	}
});


</script>

	<?php }

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new image_slider() );

