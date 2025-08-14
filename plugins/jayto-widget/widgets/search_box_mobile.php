<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class search_box_mobile extends \Elementor\Widget_Base {
	public function get_name() {
		return 'search_box_mobile';
	}

	public function get_title() {
		return ' باکس جستجوی موبایل';
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
			'search_title_mob',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_title_tit_mob',
			[
				'label' => esc_html__( 'عنوان جستجو', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'مقصد ، اقامتگاه یا شناسه .', 'textdomain' ),
				'placeholder' => esc_html__( 'عنوان را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_title_holder_mob',
			[
				'label' => esc_html__( 'متن نگه دارنده جستجو', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'انتخاب مقصد ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن نگه دارنده را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_in_mob',
			[
				'label' => esc_html__( 'متن تاریخ ورود', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تاریخ ورود ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_in_holder_mob',
			[
				'label' => esc_html__( 'متن نگه دارنده تاریخ ورود', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'وارد کنید. ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_out_mob',
			[
				'label' => esc_html__( 'متن تاریخ خروج', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تاریخ خروج ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_out_holder_mob',
			[
				'label' => esc_html__( 'متن نگه دارنده تاریخ خروج', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'وارد کنید. ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_number_out_holder_mob',
			[
				'label' => esc_html__( 'متن تعداد نفرات', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تعداد نفرات ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {

	}

	protected function render() {
		$terms = get_terms( array(
			'taxonomy'   => 'city',
			'post_type'     => 'residence',
			'hide_empty' => false,
		) );
		$values     = $this->get_settings_for_display();
		$search_title = $values['search_title_tit_mob'];
		$search_titleholder = $values['search_title_holder_mob'];
		$search_date_in = $values['search_date_in_mob'];
		$search_date_in_holder = $values['search_date_in_holder_mob'];
		$search_date_out = $values['search_date_out_mob'];
		$search_date_out_holder = $values['search_date_out_holder_mob'];
		$search_number_out_holder = $values['search_number_out_holder_mob'];
		?>

		<div id="search_box">
			<div class="srarch_city sedi">

				<span class="search_city_label fz15"><?php  echo $search_title ?></span>
				<input id="search_city_input" class="search_city_input sbi fz14" type="text" placeholder="<?php  echo $search_titleholder ?>">

				<input type="hidden" class="city_slug_check">

				<div class="search_result sbox">
					<p class="mbt10 mr10 col_gray">محبوب ترین مقصد ها</p>
					<div class="sb_most_ciyt_box">
						<?php
						$accept_term = ['تهران','رامسر','چالوس','متل قو','رشت','نوشهر','بندرانزلی','اصفحها','شیراز'];
						foreach ($terms as $row){
							if (in_array($row->name,$accept_term)){?>
								<span class="scmc_item" data-city="<?php echo $row->name ?>" data-slug="<?php echo $row->slug?>"><?php echo $row->name ?></span>
							<?php  }

							?>

						<?php     }
						?>

					</div>
				</div>

			</div>

			<div class="srarch_date_in sedi">
				<span class="search_date_in_label fz15"><?php echo $search_date_in ?></span>

				<div id="dpi">

					<date-picker clearable  picker-id="in_picker" from="<?php echo jdate('Y-m-d','','','','en')?>" placeholder="<?php  echo $search_date_in_holder?>" mode="single" id="search_date_in_input" name="search_date_in_input">
						<template #icon></template>
					</date-picker>

				</div>

				<div class="order-num sbox">

				</div>
			</div>
			<div class="srarch_date_out sedi">
				<span class="search_date_out_label fz16"><?php echo $search_date_out ?></span>

				<div id="dpo" >
					<date-picker clearable picker-id="out_picker" from="<?php echo jdate('Y-m-d','','','','en')?>" placeholder="<?php  echo $search_date_out_holder?>" mode="single" id="search_date_out_input" name="search_date_out_input">
						<template #icon></template>
					</date-picker>

				</div>
				<div class="order-num sbox">

				</div>


			</div>
			<div class="srarch_num_people sedi">
				<span class="search_num_people_label fz15"><?php echo  $search_number_out_holder ?></span>
				<input class="search_num_people_input sbi" type="text" placeholder="انتخاب کنید">
				<div class="order-num sbox">
					<div class="on_num_box">
						<span class="on_title"><?php echo  $search_number_out_holder ?> </span>
						<span class="n_plus">+</span>
						<span class="n_show">1</span>
						<span class="n_minus">-</span>
					</div>
				</div>
			</div>
		<div class="sbif">

            <span class="search_but_close">بستن</span>
            <span id="search_but">جستجو</span>
        </div>
		</div>


		<script>
            new Vue({
                el: '#dpi',
                components: {
                    datePicker
                }

            })
            new Vue({
                el: '#dpo',
                components: {
                    datePicker
                }

            })

		</script>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new search_box_mobile() );

