<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class search_box extends \Elementor\Widget_Base {
	public function get_name() {
		return 'search_box';
	}

	public function get_title() {
		return 'باکس جستجو';
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
			'search_title',
			[
				'label' => esc_html__( 'Content', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'search_title_tit',
			[
				'label' => esc_html__( 'عنوان جستجو', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'مقصد ، اقامتگاه یا شناسه .', 'textdomain' ),
				'placeholder' => esc_html__( 'عنوان را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_title_holder',
			[
				'label' => esc_html__( 'متن نگه دارنده جستجو', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'انتخاب مقصد ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن نگه دارنده را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_in',
			[
				'label' => esc_html__( 'متن تاریخ ورود', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تایخ ورود ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_in_holder',
			[
				'label' => esc_html__( 'متن نگه دارنده تاریخ ورود', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'وارد کنید. ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_out',
			[
				'label' => esc_html__( 'متن تاریخ خروج', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'تایخ خروج ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_date_out_holder',
			[
				'label' => esc_html__( 'متن نگه دارنده تاریخ خروج', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'وارد کنید. ', 'textdomain' ),
				'placeholder' => esc_html__( 'متن  را تایپ کنید', 'textdomain' ),
			]
		);
		$this->add_control(
			'search_number_out_holder',
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
		$this->start_controls_section(
			'jt_search_box_style',
			[
				'label' => __( 'استایل باکس جستجو ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_search_box_border',
				'selector' => '{{WRAPPER}} #search_box',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_search_box_shadow',
				'selector' => '{{WRAPPER}} #search_box',
			]
		);
		$this->add_control(
			'jt_search_box_Bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #search_box' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_search_box_title_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sedi span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_search_box_input_devider',
			[
				'label'     => esc_html__( 'جدا کننده', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_search_box_input_border',
				'selector' => '{{WRAPPER}} .sedi',
			]
		);
		$this->add_control(
			'jt_search_box_submit_devider',
			[
				'label'     => esc_html__( 'دکمه جسنجو', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_search_box_submit_border',
				'selector' => '{{WRAPPER}} #search_but',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_search_box_submit_shadow',
				'selector' => '{{WRAPPER}} #search_but',
			]
		);
		$this->add_control(
			'jt_search_box_submit_bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #search_but' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_search_box_submit_radius',
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
			'jt_search_box_submit_icon_color',
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
		$terms = get_terms( array(
			'taxonomy'   => array('city'),
			'post_type'  => ['residence','hotel'],
			'hide_empty' => false,
			'orderby'  => 'id',
          'order'    => 'rand'
		) );

		$values     = $this->get_settings_for_display();
		$search_title = $values['search_title_tit'];
		$search_titleholder = $values['search_title_holder'];
		$search_date_in = $values['search_date_in'];
		$search_date_in_holder = $values['search_date_in_holder'];
		$search_date_out = $values['search_date_out'];
		$search_date_out_holder = $values['search_date_out_holder'];
		$search_number_out_holder = $values['search_number_out_holder'];
		?>

        <div id="search_box">
            <div class="srarch_city sedi">

                <span class="search_city_label"><?php  echo $search_title ?></span>
                <input id="search_city_input" class="search_city_input sbi" type="text" placeholder="<?php  echo $search_titleholder ?>">

                <input type="hidden" class="city_slug_check">

                <div class="search_result sbox">
                    <p class="mbt10 mr10 col_gray"><?php echo _e( 'محبوب ترین مقصد ها', 'jayto' ) ?></p>
                    <div class="sb_most_ciyt_box">
						<?php
						$accept_term_array = array_rand($terms,9);
						$accept_term=[];
					foreach($accept_term_array as $arr){
                     $term_name = get_term_by('id',$arr,'city');
					 $accept_term[]= $term_name->name;
					}
				
									foreach ( $terms as $row ) {
							if ( in_array( $row->name, $accept_term ) ) {
								?>
                                <span class="scmc_item" data-city="<?php echo $row->name ?>" data-slug="<?php echo $row->slug ?>"><?php echo $row->name ?></span>
							<?php }

							?>

						<?php }
						?>

                    </div>
                </div>

            </div>

            <div class="srarch_date_in sedi">
                <span class="search_date_in_label"><?php echo $search_date_in ?></span>

                <div id="dpi">
				<?php
                 $from = jdate('Y/m/d');
				
			
			
			
				?>
                    <date-picker picker-id="in_picker"   from= "<?php echo $form; ?>"  placeholder="<?php  echo $search_date_in_holder?>" mode="single" id="search_date_in_input" name="search_date_in_input">
                        <template #icon></template>
                    </date-picker>

                </div>

                <div class="order-num sbox">

                </div>
            </div>
            <div class="srarch_date_out sedi">
                <span class="search_date_out_label"><?php echo $search_date_out ?></span>

                <div id="dpo">
                    <date-picker picker-id="out_picker" from= "<?php echo $form; ?>" placeholder="<?php  echo $search_date_out_holder?>" mode="single" id="search_date_out_input" name="search_date_out_input">
                        <template #icon></template>
                    </date-picker>

                </div>
                <div class="order-num sbox">

                </div>


            </div>
            <div class="srarch_num_people sedi">
                <span class="search_num_people_label"> <?php echo  $search_number_out_holder ?></span>
                <input class="search_num_people_input sbi" type="text" placeholder="انتخاب کنید">
                <div class="order-num sbox">
                    <div class="on_num_box">
                        <span class="on_title"><?php  echo  $search_number_out_holder ?> </span>
                        <span class="n_plus">+</span>
                        <span class="n_show">1</span>
                        <span class="n_minus">-</span>
                    </div>
                </div>
            </div>
            <span id="search_but"><i class="fa-regular fa-search"></i></span>
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


\Elementor\Plugin::instance()->widgets_manager->register( new search_box() );

