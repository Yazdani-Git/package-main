<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class back_to extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'back_to_icon';
	}

	public function get_title()
	{
		return 'آیکن بازگشت';
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
			'bact__body',
			[
				'label' => __('لینک', 'jayto-Plugin'),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			]

		);
		$this->add_control(
			'bact_input_link',
			[
				'label'       => esc_html__('صفحه لینک', 'textdomain'),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => esc_html__('macount', 'textdomain'),
				'placeholder' => esc_html__('نام صفحه را وارد کنید', 'textdomain'),
			]
		);
		$this->end_controls_section();
		$this->style_tab();
	}

	private function style_tab() {}

	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$link    = $settings['bact_input_link']; ?>
		<div class="mh_head_back">
			<?php
			if (wp_is_mobile()) { ?>
				<a href="<?php echo home_url() ?>/<?php echo $link ?>"> <i class="fa-thin fa-arrow-alt-right fa-2x bactoac"></i></a>

			<?php }
			?>
			</a>
		</div>
<?php }

	protected function content_template() {}
}


\Elementor\Plugin::instance()->widgets_manager->register(new back_to());
