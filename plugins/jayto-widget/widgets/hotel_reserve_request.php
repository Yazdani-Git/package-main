<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class hotel_reserve_request extends \Elementor\Widget_Base {
	public function get_name() {
		return 'hotel_reserve_request';
	}

	public function get_title() {
		return 'درخواست رزرو هتل';
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
			'jt_send_request_style',
			[
				'label' => __( 'استایل بدنه ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_send_request_border',
				'selector' => '{{WRAPPER}} .reserve_request_box',
			]
		);
		$this->add_control(
			'jt_send_request_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .reserve_request_box' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_send_request__margin',
			[
				'label'      => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .reserve_request_box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_send_request__shadow',
				'selector' => '{{WRAPPER}} .reserve_request_box',
			]
		);
		$this->add_control(
			'jt_send_request__BG_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reserve_request_box' => 'background: {{VALUE}}',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_send_request_price_night_style',
			[
				'label' => __( 'قیمت / شب ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_send_request_price_night_typography',
				'selector' => '{{WRAPPER}} .reserve_price',
			]
		);
		$this->add_control(
			'jt_send_request_price_night_color',
			[
				'label'     => esc_html__( 'رنک', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reserve_price' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'jt_send_request_price_night_text_shadow',
				'selector' => '{{WRAPPER}} .reserve_price',
			]
		);
		$this->add_control(
			'jt_send_request_price_night_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .reserve_price' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_send_request_price_night__hr',
			[
				'type' => \Elementor\Controls_Manager::DIVIDER,
			]
		);
		$this->add_control(
			'jt_send_request_price_night_note',
			[
				'label' => esc_html__( '/شب', 'textdomain' ),
				'type'  => \Elementor\Controls_Manager::RAW_HTML,

			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_send_request_price_night_night_typography',
				'selector' => '{{WRAPPER}} .nslash',
			]
		);
		$this->add_control(
			'jt_send_request_price_night_night_color',
			[
				'label'     => esc_html__( 'رنک', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .nslash' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 'jt_send_request_price_night_night_text_shadow',
				'selector' => '{{WRAPPER}} .nslash',
			]
		);
		$this->add_control(
			'jt_send_request_price_night/_margin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .nslash' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_send_request__date_style',
			[
				'label' => __( 'استایل انتخاب تاریخ ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_send_request__date_border',
				'selector' => '{{WRAPPER}} .request_dates',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_send_request__date_shadow',
				'selector' => '{{WRAPPER}} .request_dates',
			]
		);
		$this->add_control(
			't_send_request__date_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .request_dates' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			't_send_request__dateIn_options',
			[
				'label'     => esc_html__( 'باکس تاریخ ورود', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 't_send_request__dateIn_typography',
				'selector' => '{{WRAPPER}} #dpin .ds_label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 't_send_request__dateIn_text_shadow',
				'selector' => '{{WRAPPER}} #dpin .ds_label',
			]
		);
		$this->add_control(
			't_send_request__dateIn_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dpin .ds_label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_send_request__dateInIcon_color',
			[
				'label'     => esc_html__( 'رنگ آیکن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dpin .ds_box i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_send_request__dateInIcon_width',
			[
				'label'      => esc_html__( 'اندازه آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} #dpin .ds_box i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__dateOut_options',
			[
				'label'     => esc_html__( 'باکس تاریخ خروج', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 't_send_request__dateOut_typography',
				'selector' => '{{WRAPPER}} #dpout .ds_label',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name'     => 't_send_request__dateOut_text_shadow',
				'selector' => '{{WRAPPER}} #dpout .ds_label',
			]
		);
		$this->add_control(
			't_send_request__dateOut_color',
			[
				'label'     => esc_html__( 'رنگ عنوان', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dpout .ds_label' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_send_request__dateOutIcon_color',
			[
				'label'     => esc_html__( 'رنگ آیکن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} #dpout .ds_box i' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_send_request__dateOutIcon_width',
			[
				'label'      => esc_html__( 'اندازه آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 1000,
						'step' => 5,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} #dpout .ds_box i' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__passenger_options',
			[
				'label'     => esc_html__( 'باکس مسافران', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 't_send_request__passenger_border',
				'selector' => '{{WRAPPER}} .passenger_num',
			]
		);
		$this->add_control(
			't_send_request__passenger_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .passenger_num' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__passengerIcon_color',
			[
				'label'     => esc_html__( 'رنگ آیکن', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .res_ico' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			't_send_request__passengerIcon_size',
			[
				'label'      => esc_html__( 'اندازه آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 25,
				],
				'selectors'  => [
					'{{WRAPPER}} .res_ico' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]

		);
		$this->add_control(
			't_send_request__passengerIcon_margin',
			[
				'label'      => esc_html__( 'فاصله آیکن', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .res_ico' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__AddMinus_options',
			[
				'label'     => esc_html__( 'دکمه های کم و زیاد', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::HEADING,
				'separator' => 'before',
			]
		);
		$this->add_control(
			't_send_request__Add_width',
			[
				'label'      => esc_html__( 'عرض دکمه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .on_plus' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__Add_height',
			[
				'label'      => esc_html__( 'ارتفاع دکمه', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::SLIDER,
				'size_units' => [ 'px' ],
				'range'      => [
					'px' => [
						'min'  => 0,
						'max'  => 50,
						'step' => 1,
					],

				],
				'default'    => [
					'unit' => 'px',
					'size' => 30,
				],
				'selectors'  => [
					'{{WRAPPER}} .on_plus' => 'height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__Add_color',
			[
				'label'     => esc_html__( 'رنگ علامت ها', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .on_plus,{{WRAPPER}} .on_minus' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 't_send_request__Add_border',
				'selector' => '{{WRAPPER}} .on_plus,{{WRAPPER}} .on_minus',
			]
		);
		$this->add_control(
			't_send_request__Add_radius',
			[
				'label'      => esc_html__( 'انحنا', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .on_plus,{{WRAPPER}} .on_minus' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			't_send_request__Add_mardin',
			[
				'label'      => esc_html__( 'فاصله', 'textdomain' ),
				'type'       => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors'  => [
					'{{WRAPPER}} .on_plus,{{WRAPPER}} .on_minus' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'jt_send_request__send_but_style',
			[
				'label' => __( 'دکمه رزرو ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'jt_send_request__send_but_border',
				'selector' => '{{WRAPPER}} .reserve_submit_box a',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name'     => 'jt_send_request__send_but_shadow',
				'selector' => '{{WRAPPER}} .reserve_submit_box a',
			]
		);
		$this->add_control(
			'jt_send_request__send_but_bg_color',
			[
				'label'     => esc_html__( 'رنگ پس زمینه دکمه', 'textdomain' ),
				'type'      => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .reserve_submit_box a' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name'     => 'jt_send_request__send_but_typography',
				'selector' => '{{WRAPPER}} .reserve_submit_box a',
			]
		);

	}

	protected function render() {
		if ( ! isset ( $_GET['action'] ) ) {
			$residence_id = get_the_ID();
		} else {
			$residence_id = create_post_id();
		}
		global $post;
		$author_id = $post->post_author;
		$in_date   = '';
		$out_date  = '';
		$cap       = '';
		if ( isset( $_GET['in_date'] ) ) {
			$in_date = $_GET['in_date'];
		}
		if ( isset( $_GET['out_date'] ) ) {
			$out_date = $_GET['out_date'];
		}
		if ( isset( $_GET['cap'] ) ) {
			$cap = $_GET['cap'];
		}
		$child_select_view = get_option( 'child_select_view' );
		?>

        <div class="reserve_request_box ">
			<?php
			if ( wp_is_mobile() ) { ?>
                <span class="cancel_req_close"><i class="fa fa-close"></i></span>
			<?php }
			?>
            <div class="date_num_box">
				<?php
				if ( $in_date != '' ) {

					$jal_exp = explode( '/', $in_date );
					$in_date = jalali_to_gregorian( $jal_exp[0], $jal_exp[1], $jal_exp[2], '-' );
				} elseif ( $in_date == '' ) {
					if ( isset( $_COOKIE['hin_dat'] ) ) {
						$in_date_array = explode( '/', $_COOKIE['hin_dat'] );
						$in_date       = jalali_to_gregorian( $in_date_array[0], $in_date_array[1], $in_date_array[2], '/' );

					} else {
						$in_date= date( 'Y/m/d', time() );

					}
				}
				if ( $out_date != '' ) {
					$jal_out_exp = explode( '/', $out_date );
					$out_date    = jalali_to_gregorian( $jal_out_exp[0], $jal_out_exp[1], $jal_out_exp[2], '-' );
				} elseif ( $out_date == '' ) {
					if ( isset( $_COOKIE['hin_dat'] ) ) {
						$out_date_array = explode( '/', $_COOKIE['hout_dat'] );
						$out_date       = jalali_to_gregorian( $out_date_array[0], $out_date_array[1], $out_date_array[2], '/' );

					} else {

						$out_date = date( "Y/m/d", strtotime( '+1 day', time() ) );

					}
				}
				$from = jdate( 'Y/m/d' );
				?>
                <div class="request_dates">

                    <div id="hdpin" data-resid="<?php echo get_the_ID(); ?>">
                        <span class="ds_label"><?php echo _e( 'تاریخ ورود', 'jayto' ) ?></span>

                        <div class="ds_box">
                            <i class="fa-thin fa-calendar-day fz25"></i>
                            <date-picker picker-id="ho_in_picker" from="<?php echo $form; ?>" <?php if ( $in_date != '' )
								echo 'value="' . $in_date . ' "' ?> placeholder="انتخاب کنید" mode="single" id="hsearch_date_in_input" name="search_date_in_input" display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD">
                                <template #icon></template>
                            </date-picker>

                        </div>

                    </div>
                    <div id="hdpout" data-resid="<?php echo get_the_ID(); ?>">
                        <span class="ds_label"><?php echo _e( 'تاریخ خروج', 'jayto' ) ?></span>
                        <div class="ds_box">
                            <i class="fa-thin fa-calendar-day"></i>
                            <date-picker picker-id="ho_out_picker" from="<?php echo $form; ?>" <?php if ( $in_date != '' )
								echo 'value="' . $out_date . ' "' ?> from="1401/10/11" placeholder="انتخاب کنید" mode="single" id="hsearch_date_out_input" name="search_date_out_input" display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD">
                                <template #icon></template>
                            </date-picker>
                        </div>

                    </div>

                </div>
                <div class="hotel_passenger_num" data-scap="<?php echo $standard_cap ?>" data-tc="<?php echo $total_capacity ?>" data-ep="<?php echo $ext_person_price ?>">

                    <div class="hpicon"><span class="dashicons dashicons-groups res_ico"></span><span class="fz13  col_gray"><?php echo _e( 'مسافران', 'jayto' ) ?></span></div>

                    <div class="hpselect">

                        <div class="on_num_box">

                            <div class="pselect_title">

                                <span class="on_show fz14 adult_num">
                                    <?php
                                    if ( $cap ) {
	                                    echo $cap;
                                    } else {
	                                    echo '1';
                                    }
                                    ?>
                                </span>&nbsp<span class="fz14"><?php echo _e( ' بزرگسال', 'jayto' ) ?></span>
                            </div>
                            <span class="hon_plus">+</span>

                            <span class="hon_minus">-</span>
                        </div>


						<?php
						if ( $child_select_view == 0 ) { ?>
                            <div class="on_num_box">

                                <div class="pselect_title">

                                    <span class="on_show fz14 under_tow_num ">0</span>&nbsp<span class="fz14"><?php echo _e( ' کودک زیر 2 سال', 'jayto' ) ?></span>
                                </div>
                                <span class="hon_plus">+</span>

                                <span class="hon_minus">-</span>
                            </div>

                            <div class="on_num_box">

                                <div class="pselect_title">

                                    <span class="on_show fz14 chil2_6">0 </span>&nbsp<span class="fz14"><?php echo _e( 'کودک 2 تا 6 سال', 'jayto' ) ?></span>
                                </div>
                                <span class="hon_plus">+</span>

                                <span class="hon_minus">-</span>
                            </div>

                            <div class="on_num_box">

                                <div class="pselect_title">

                                    <span class="on_show fz14 child_up_six">0</span>&nbsp<span class="fz14"><?php echo _e( 'کودک 6 تا 12 سال', 'jayto' ) ?></span>
                                </div>
                                <span class="hon_plus">+</span>

                                <span class="hon_minus">-</span>
                            </div>
						<?php }
						?>

                    </div>
                </div>
            </div>
            <div class="reserve_submit_box">

                <span class="reserv_submit_btn " data-hid="<?php echo $post->ID ?>"><?php echo _e( 'مشاهده اتاق های موجود', 'jayto' ) ?></span>


            </div>


            <div class="res_factor">
                <div class="each_night">

                </div>
                <div class="res_factor_add_people">

                </div>
                <span class="line90"></span>

                <div class="res_factor_total">
                    <div class="rft_box">

                    </div>
                </div>
            </div>
        </div>
        <script>
            new Vue({
                el: '#hdpin',
                components: {
                    datePicker
                }

            })
            new Vue({
                el: '#hdpout',
                components: {
                    datePicker
                }

            })
      jQuery(document).ready(function (){
          jQuery('.reserv_submit_btn').click()
      })
        </script>


	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new hotel_reserve_request() );

