<?php


use Elementor\Plugin;
use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class login_button extends \Elementor\Widget_Base {
	public function get_name() {
		return 'login_buttom';
	}

	public function get_title() {
		return 'دکمه ورود ثبت نام';
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
			'jt_reg_but_style',
			[
				'label' => __( 'استایل بدنه  ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_reg_but_box_border',
				'selector' => '{{WRAPPER}} .profile_button',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_reg_but_box_shadow',
				'selector' => '{{WRAPPER}} .profile_button',
			]
		);
		$this->add_control(
			'jt_reg_but_box_bgColor',
			[
				'label' => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_button' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_reg_but_box_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .profile_button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_reg_but_box_ArrowColor',
			[
				'label' => esc_html__( 'رنگ فلش', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_button i' => 'color: {{VALUE}}',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_reg_but_pic_style',
			[
				'label' => __( 'استایل تصویر پروفایل  ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_reg_but_pic_border',
				'selector' => '{{WRAPPER}} .pbu_img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_reg_but_pic_shadow',
				'selector' => '{{WRAPPER}} .pbu_img',
			]
		);

		$this->add_control(
			'jt_reg_but_pic_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .pbu_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_reg_but_drop_style',
			[
				'label' => __( 'استایل موی بازشونده ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_reg_but_drop_border',
				'selector' => '{{WRAPPER}} .profile_drop',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_reg_but_drop_shadow',
				'selector' => '{{WRAPPER}} .profile_drop',
			]
		);
		$this->add_control(
			'jt_reg_but_drop_bg_color',
			[
				'label' => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_drop' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_reg_but_drop_bg_color_hover',
			[
				'label' => esc_html__( 'رنگ هاور آیتم ها', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_drop ul li:hover' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_reg_but_drop_item_color',
			[
				'label' => esc_html__( 'رنگ نوشته', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_drop ul li a' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_reg_but_drop_item_hover_color',
			[
				'label' => esc_html__( 'رنگ هاور نوشته', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .profile_drop ul li a:hover' => 'color: {{VALUE}}',
				],
			]
		);
	}

	protected function render() {
		if ( is_user_logged_in() ) {
          $u_meta=get_user_meta(get_current_user_id(),'user_profile_imsge')
            ?>
            <div class="profile_button">
                <div class="pbu_img">
                    <?php
                    if ($u_meta[0] ){?>
                        <img src="<?php echo $u_meta[0] ?>" alt="">
                  <?php  }else{ $p_image = get_template_directory_uri().'/images/user-profile.png' ?>
                        <img src="<?php echo $p_image ?>" alt="">
                 <?php   }
                    ?>

                </div>
                <i class=" pb_downi fa fa-chevron-down"></i>
                <div class="profile_drop">
                    <ul>
                        <li><a href="<?php echo home_url()?>/account"><?php echo _e('اطلاعات حساب کاربری','jayto') ?></a></li>
                        <li><a href="<?php echo home_url()?>/trips"><?php echo _e('سفرهای من','jayto') ?></a></li>
                        <li><a href="<?php echo home_url()?>/transaction"><?php echo _e('تراکنش های من','jayto') ?></a></li>
                        <li><a href="<?php echo home_url()?>/fa"><?php echo _e('پرسش های متداول','jayto') ?></a></li>
                        <li><a href="<?php echo 	$url = wp_logout_url( home_url() );  ?>"><?php echo _e('خروج از حساب کاربری','jayto') ?></a></li>
                    </ul>
                </div>
            </div>
		<?php } else { ?>
            <div class="login_but">
                <div class="lb_icon">
                    <i class="fa fa-user"></i>
                </div>
                <span class="lb_title">ورود یا ثبت نام</span>

            </div>
		<?php } ?>


	<?php }

	protected function content_template() {

	}
}


Plugin::instance()->widgets_manager->register( new login_button() );

