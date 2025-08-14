<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class add_favorites extends \Elementor\Widget_Base {
	public function get_name() {
		return 'user_favorites';
	}

	public function get_title() {
		return 'افزودن به علاقه مندی ها';
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
			'adf_content_section',
			[
				'label' => esc_html__( 'تنظیمات استایل', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'adf_content_typography',
				'selector' => '{{WRAPPER}} .atf_title',
			]
		);
		$this->add_control(
			'adf_text_color',
			[
				'label' => esc_html__( 'رنگ متن', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .atf_title' => 'color: {{VALUE}}',
				],
			]
		);

		$this->add_group_control(
			\Elementor\Group_Control_Background::get_type(),
			[
				'name' => 'adf_background_color',
				'types' => [ 'classic', 'gradient' ],
				'selector' => '{{WRAPPER}} .add_to_favorite',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'adf_border',
				'selector' => '{{WRAPPER}} .add_to_favorite',
			]
		);
		$this->add_control(
			'adf_icon_color',
			[
				'label' => esc_html__( 'رنگ آیکن', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .add_to_favorite i' => 'color: {{VALUE}}',
				],
			]
		);

		$this->end_controls_section();


	}


	protected function render() {

		if ( ! isset ( $_GET['action'] ) ) {
			$residence_id = get_the_ID();
		} else {
			$residence_id = create_post_id();
		}
		if ( ! isset ( $_GET['action'] )  ) {
			$user_id = get_current_user_id();
		} else {
			$user_id = '';
		}

       $uird=$residence_id.'-'.$user_id;
		$favo_id= get_user_meta( $user_id, 'user_favorite');

        $favo_id = unserialize($favo_id);

        if (is_user_logged_in()){?>
            <div class="add_to_favorite <?php if (in_array($residence_id,$favo_id))echo  'active';  ?>" data-uird=<?php echo $uird?>>
                <i class="fa-thin fa-heart"></i>
		        <?php if (in_array($residence_id,$favo_id)) {?>
                    <span class="atf_title"><?php echo _e('افزوده شده به علاقه مندی ها','jayto') ?></span>
		        <?php }else{?>
                    <span class="atf_title"><?php echo _e('افزودن به علاقه مندی ها','jayto') ?></span>
		        <?php }?>

            </div>
      <?php  }else{ ?>
            <div class="add_to_favorite_none">
                <i class="fa-thin fa-heart"></i>



                    <span class="atf_title"><?php echo _e('افزودن به علاقه مندی ها','jayto') ?></span>


            </div>
    <?php    }
		?>

		<?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new add_favorites() );

