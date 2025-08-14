<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class submits_reserve_request extends \Elementor\Widget_Base {
	public function get_name() {
		return 'submit_reserve_request';
	}

	public function get_title() {
		return 'ارسال درخواست رزرو';
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
			'res_but_content',
			[
				'label' => esc_html__( 'محتوا', 'textdomain' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'res_but_title',
			[
				'label'       => esc_html__( 'متن دکمه', 'textdomain' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__( 'عنوان دکمه', 'textdomain' ),
			]
		);

		$this->end_controls_section();


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

	    $settings = $this->get_settings_for_display();
	    $but_text = $settings['res_but_title'];
	    if ( $but_text == '' ) {
		    $but_text = 'ارسال درخواست رزرو';
	    }
	    global $post;
	    if ( ! isset ( $_GET['action'] ) ) {
		    $residence_id = get_the_ID();
	    } else {
		    $residence_id = create_post_id();

	    }


	    $author_id      = $post->post_author;
	    $end_week_price = '';
	    $meta           = get_post_meta( $residence_id, '_all_res_meta', false );
	    $in_date        = '';
	    $out_date       = '';
	    $cap            = '';
	    if ( isset( $_GET['in_date'] ) ) {
		    $in_date = $_GET['in_date'];
	    } else {
		    $in_date = jdate( 'Y-m-d', '', '', '', 'en' );
	    }
	    if ( isset( $_GET['out_date'] ) ) {
		    $out_date = $_GET['out_date'];
	    } else {
		    $last     = time() + 86400;
		    $out_date = jdate( 'Y-m-d', $last, '', '', 'en' );


	    }
	    if ( isset( $_GET['cap'] ) ) {
		    $cap = $_GET['cap'];
	    } else {
		    $cap = 1;
	    }
	    $standard_cap     = $meta[0]['base_capacity'];
	    $standard_price   = $meta[0]['price'];
	    $ext_person_price = $meta[0]['extra_person'];
	    $total_capacity   = $meta[0]['total_capacity'];
	    $end_week_price   = $meta[0]['end_week_price'];
        $discount_date_start =$meta[0]['discount']['start_date ' ];
        $discount_date_end =$meta[0]['discount']['end_date' ];
        $discount_precent = $meta[0]['discount']['perscent_discount' ]/100;
        $all_discount=get_beetweens_date($discount_date_start,$discount_date_end);

	    if ( $end_week_price == '' || $end_week_price == 0 ) {
		    $end_week_price = $standard_price;
	    }

	    ?>
	    <?php
	    $date_now      = date( 'Y/m/d' );
	    $date_array    = explode( '/', $date_now );
	    $jalai_date    = gregorian_to_jalali( $date_array[0], $date_array[1], $date_array[2], '/' );
	    $price_date    = get_post_meta( $residence_id, 'resistance_calender', true );
	    $res_day_price = get_post_meta( $residence_id, 'res_day_price', true );
	    $reserves      = get_post_meta( $residence_id, 'resistance_reserves', true );
	    $iodate        = get_beetween_date( $in_date, $out_date );

	    $allows_reserve = 'yes';
	    if ( $iodate ) {
		    foreach ( $iodate as $io ) {
			    if ( in_array( $io, $reserves ) ) {
				    $allows_reserve = 'no';
			    }
		    }
	    }
	    if ( $res_day_price ) {
		    foreach ( $res_day_price as $key => $row ) {
			    if ( key_exists( $key, $price_date ) ) {
				    $price_date[ $key ] = $row;
			    }
		    }
	    }

		foreach ($all_discount as $key) {
			if (isset($price_date[$key])) {

				$price_date[$key] = intval(round($price_date[$key] - ($price_date[$key] * $discount_precent), 0));
			}
		}
	  $opt = get_option('single_edit');
		if ($opt == 0){

            include JAYTO_PLUGIN_PATH . '/Calender.php';
            include JAYTO_PLUGIN_PATH . '/Calender_desktop.php';
            include JAYTO_PLUGIN_PATH . '/Calender_desktop2.php';
            $calendar       = new Calendar();
            if (method_exists($calendar, 'set_id')) { $calendar->set_id($residence_id); }
            $calendar_desk1 = new Calendar_desktop();
            if (method_exists($calendar_desk1, 'set_id')) { $calendar_desk1->set_id($residence_id); }
			$last_month     = date( 'Y-m-d', strtotime( '+1 month', strtotime( date( 'Y-m-d' ) ) ) );
			$exp_date       = explode( '-', $last_month );
			list( $m_year, $m_month, $m_day ) = $exp_date;
			$shamsi_date    = gregorian_to_jalali( $m_year, $m_month, $m_day );
			$date_j         = jalali_to_gregorian( $shamsi_date[0], $shamsi_date[1], $shamsi_date[2], '-' );
            $calendar_desk2 = new Calendar_desktop2( $date_j );
            if (method_exists($calendar_desk2, 'set_id')) { $calendar_desk2->set_id($residence_id); }

			if ( $price_date ) {
				foreach ( $price_date as $key => $row ) {
					$calendar->add_event( $row / 1000, $key );
				}
			}
			if ( $price_date ) {
				foreach ( $price_date as $key => $row ) {
					$calendar_desk1->add_event( $row / 1000, $key );
				}
			}
			if ( $price_date ) {
				foreach ( $price_date as $key => $row ) {
					$calendar_desk2->add_event( $row / 1000, $key );
				}
			}

			// Set reserved dates for all calendars
			$reserved_dates = get_post_meta( $residence_id, 'resistance_reserves', true );
			if ( $reserved_dates ) {
				$calendar->set_reserved_dates( $reserved_dates );
				$calendar_desk1->set_reserved_dates( $reserved_dates );
				$calendar_desk2->set_reserved_dates( $reserved_dates );
			}
			
			// Set check-in date for checkout calendar logic
			$session_check_in = $_SESSION['in_start_date'] ?? '';
			if ( !empty( $session_check_in ) ) {
				$calendar->set_check_in( $session_check_in );
				$calendar_desk1->set_check_in( $session_check_in );
				$calendar_desk2->set_check_in( $session_check_in );
			}
		}

	    ?>

        <div class="reserve_request_box ">
		    <?php



		    if ( wp_is_mobile() ) { ?>
                <span class="cancel_req_close"><i class="fa fa-close"></i></span>
		    <?php }
		    ?>

            <span
                    class="reserve_price"><?php echo number_format( $meta[0]['price'] ) ?>&nbsp<?php echo _e( 'تومان', 'jayto' ) ?></span><span
                    class="fz12 col_gray nslash">/ &nbsp<?php echo _e( 'شب', 'jayto' ) ?></span>
            <div class="date_num_box">

                <div class="request_dates">
					<?php
					session_start();
                    $start_date = $_SESSION['in_start_date'] ?? '';
                    $start_ddate = $_SESSION['in_end_ddate'] ?? '';
                    $end_date = $_SESSION['out_end_date'] ?? '';
                    $end_ddate = $_SESSION['out_end_ddate'] ?? '';
                  
					?>
                <script>
                  jQuery(document).ready(function($) {
                 $('.dpi_inp').val('<?php echo $start_ddate ?>').attr('data-complete', '<?php echo $start_date ?>')
                 $('.dpo_inp').val('<?php echo $end_ddate ?>') .attr('data-complete', '<?php echo $end_date ?>')
            
      
                });
				jQuery(document).ready(function($) {
					var res_id =  $('#dpin').attr('data-resid')
        var checkin  = '<?php echo $start_date ?>';
        var checkout = '<?php echo $end_date ?>';
        var res_id   = res_id; // فرض بر اینه که همچین input داری
        var no_people = 1; // تعداد افراد از یک input

	
        calcReservePrice(
            res_id,
			checkin,
            checkout,
            no_people
        );

    

 
});

                </script>
                    <div id="dpin" data-resid="<?php echo $residence_id; ?>">
                        <span class="ds_label"><?php echo _e( 'تاریخ ورود', 'jayto' ) ?></span>

                        <div class="ds_box">
                            <i class="fa-thin fa-calendar-day fz25"></i>

                            <input type="text" name="dp_inp" class="dpi_inp" 
                                   placeholder="<?php echo _e( 'انتخاب تاریخ', 'jayto' ) ?>">

                        </div>
                        <div class="in_calender">
						    <?php
						    if ( ! wp_is_mobile() ) { ?>
                                <div class="calender_box1">
								    <?php

								    echo $calendar_desk1;

								    ?>
                                </div>
                                <div class="calender_box2">
								    <?php

								    echo $calendar_desk2;
								    ?>
                                </div>
						    <?php } else {
							    echo $calendar;
						    }
						    ?>

                        </div>
                    </div>
					

                    <div id="dpout" data-resid="<?php echo $residence_id; ?>">
                        <span class="ds_label"><?php echo _e( 'تاریخ خروج', 'jayto' ) ?></span>
                        <div class="ds_box">
                            <i class="fa-thin fa-calendar-day"></i>
                            <input type="text" name="dpo_inp"  class="dpo_inp" 
                                   placeholder="<?php echo _e( 'انتخاب تاریخ', 'jayto' ) ?>">
                        </div>
                        <div class="out_calender">
						    <?php
						    if ( ! wp_is_mobile() ) { ?>
                                <div class="calender_box1">
								    <?php

								    echo $calendar_desk1;

								    ?>
                                </div>
                                <div class="calender_box2">
								    <?php

								    echo $calendar_desk2;
								    ?>
                                </div>
						    <?php } else {
							    echo $calendar;
						    }
						    ?>
                        </div>
                    </div>

                </div>

                <div class="passenger_num" data-scap="<?php echo $standard_cap ?>" data-tc="<?php echo $total_capacity ?>"
                     data-ep="<?php echo $ext_person_price ?>">

                    <div class="picon"><span class="dashicons dashicons-groups res_ico"></span></div>
                    <p class="fz13  col_gray"><?php echo _e( 'مسافران', 'jayto' ) ?></p>
                    <div class="pselect">
                        <div class="on_num_box">
                            <div class="pselect_title">
							    <?php
							    if ( ! $cap ) {
								    $cap = 1;
							    }
							    ?>
                                <span class="on_show"><?php echo $cap ?></span>&nbsp<span><?php echo _e( 'نفر', 'jayto' ) ?></span>
                            </div>
                            <span class="on_plus">+</span>
                            <span class="on_minus">-</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="reserve_submit_box">
			    <?php

			    if ( is_user_logged_in() ) { ?>
                    <a href="<?php echo home_url() ?>/request?res_id=<?php echo $residence_id ?>"
                       class="reserv_submit_btn"><?php echo _e( $but_text, 'jayto' ) ?></a>
			    <?php } else {
				    ?>
                    <span class="reserv_submit_btn non_log_submit"><?php echo _e( $but_text, 'jayto' ) ?></span>

			    <?php }
			    ?>
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
                <div class="alertno text_cnt">
                    <p class="fz11">دراین بازه زمانی امکان رزرو وجود ندارد تاریخ دیگری را انتخاب نمایید.</p>
                </div>
            </div>
		    <?php
		    if ( isset( $_GET['in_date'] ) ) { ?>
                <script>
                    let inpin = jQuery('.dpi_inp');
                    let outpin = jQuery('.dpo_inp');

                    inpin.attr("data-complete", '<?php  echo $_GET['in_date'] ?>')
                    inpin.val("<?php  echo $_GET['in_date'] ?>")
                    outpin.attr("data-complete", '<?php  echo $_GET['in_date'] ?>')
                    outpin.val("<?php  echo $_GET['out_date'] ?>")

                    function txx() {


                        let res_id = jQuery('#dpout').attr('data-resid')
                        let no_people = jQuery('.on_show').text();

                        var checkout = '<?php  echo $_GET['out_date']?>';
                        var checkin = ' <?php  echo $_GET['in_date']?>';
                        jQuery('.out_calender').hide(0);
                        jQuery.ajax({
                            url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                            type: "POST",
                            data: {
                                action: "calc_reserve_price",
                                'checkin': checkin,
                                'checkout': checkout,
                                'res_id': res_id,
                                'no_people': no_people
                            },
                            beforeSend: function () {
                            },
                            success: function (data) {
                                let result = jQuery.parseJSON(data)
                                let each_night = result.count_value;
                                jQuery('.res_factor_ap').remove()
                                jQuery('.rft_box').remove()
                                jQuery('.res_factor_item').remove()
                                if (result.sub_add_people_price > 0) {
                                    jQuery('.res_factor_add_people').append('<div class="res_factor_ap"></div>')

                                    jQuery('.res_factor_ap').append('<span> ' + result.add_people_num +
                                        ' نفر مهمان اضافه</span> </span> <span>' + result.sub_add_people_price +
                                        ' تومان</span>')

                                }
                                jQuery.each(each_night, function (index, value) {
                                    let sum_each = value * index;
                                    jQuery('.each_night').append("<div class='res_factor_item'><div><span>" + value +
                                        "</span><span  class='space_2x'>شب</span><span>" + index +
                                        "</span><span class='space_5x'>x</span></div><div><span>" + value * index +
                                        "</span><span class='space_2x'>تومان</span></div></div>")
                                })
                                // jQuery('.res_factor').append(' <span className="line90"></span>')
                                jQuery('.res_factor_total').append('<div class="rft_box"></div>')
                                jQuery('.rft_box').append('<span>جمع مبلغ اقامت</span> <span>' + result.total_price +
                                    ' تومان<span/>');
                                let checki = jQuery('.dpi_inp').attr('data-complete')
                                let base_url = ajax_data.turl;
                                jQuery('.reserve_submit_box a').attr("href", '' + base_url + '/request?res_id=' + res_id +
                                    '&check_in=' + checki + '&checkout=' + checkout + '&pass_num=' + no_people);
                            }
                        })

                    }

                    txx()
                </script>
		    <?php } ?>
        </div>
	    <?php

	    $today     = date( 'Y/m/d' );
	    $exptoday  = explode( '/', $today );
	    $per_today = gregorian_to_jalali( $exptoday[0], $exptoday[1], $exptoday[2], '/' );

	    ?>
	    <?php
    }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new submits_reserve_request() );