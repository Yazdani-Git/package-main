<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class image_slide extends Widget_Base {
	public function get_name() {
		return 'image slide';
	}

	public function get_title() {
		return 'اسلاید تصاویر';
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
			'imgSlides_setting',
			[
				'label' => __( 'تنظیمات اسلاید ها', 'jayto' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$repeater = new \Elementor\Repeater();

		$repeater->add_control(
			'img_slide_image',
			[
				'label'   => __( 'انتخاب تصویر', 'jayto' ),
				'type'    => \Elementor\Controls_Manager::MEDIA,
				'default' => [
					'url' => \Elementor\Utils::get_placeholder_image_src(),
				],
			]
		);


		$repeater->add_control(
			'img_link',
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
			'img_slide_pics',
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
			'img_section',
			[
				'label' => esc_html__( 'استایل تصاویر', 'jayto' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jimg_border',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jimg_shadow',
				'selector' => '{{WRAPPER}} .tile_fig',
			]
		);
		$this->add_control(
			'jimg_radius',
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
		$images    = $values['img_slide_pics'];
		$rand      = rand( 10, 1000000 );
		?>

    <div  class="img_slide<?php  echo $rand?>">

        <div class="swiper-wrapper">

            <?php

	    	foreach ( $images as $row ) {
					?>
            <div class="swiper-slide">

              <img class="img_slide_height" src="<?php echo $row['img_slide_image']['url']; ?>">

     
		     </div>
            <?php }
		   ?>
		
		
        </div>
		<div class="swiper-button-next<?php  echo $rand ?>"></div>
        <div class="swiper-button-prev<?php  echo $rand ?>"></div>
		<div class=" sw_elem swiper-pagination<?php  echo $rand ?>"></div>
    </div>


<script>
var swiper = new Swiper(".img_slide<?php  echo $rand?>", {
    slidesPerView: 1,
    spaceBetween: 0,
	autoHeight: false,
	loop:true,
	pagination: {
    el: '.swiper-pagination<?php  echo $rand ?>',
	dynamicBullets: true,

  },
	autoplay: {
   delay: 3000,
 },

 navigation: {
        nextEl: ".swiper-button-next<?php  echo $rand ?>",
        prevEl: ".swiper-button-prev<?php  echo $rand ?>",
      },
  
    breakpoints: {

        300: {
            slidesPerView: 1,
            spaceBetween:0,
        },
        400: {
            slidesPerView: 1,
            spaceBetween: 0,
        },

        750: {
            slidesPerView: 1,
            spaceBetween: 0,
        },

        1200: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        1400: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        1500: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
        1920: {
            slidesPerView: 1,
            spaceBetween: 0,
        },
    }
});
</script>

<?php }

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new image_slide() );