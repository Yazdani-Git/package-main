<?php


use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_link extends \Elementor\Widget_Base
{
	public function get_name()
	{
		return 'jayto_link';
	}

	public function get_title()
	{
		return 'لیتک سفارشی';
	}

	public function get_script_depends()
	{
		return ['karnama_script'];
	}

	public function get_icon()
	{
		return 'eicon-skill-bar';
	}

	public function get_categories()
	{
		return ['jayto'];
	}

	protected function register_controls()
	{
		$this->start_controls_section(
			'cb_select_section',
			[
				'label' => esc_html__('محتوا', 'textdomain'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);
		$page = array();
		$args = array(

			'post_type' => 'page',

		);
		$pages = get_pages($args);
		foreach ($pages as $row) {
			$page[$row->post_title] = $row->post_title;

		}

		$this->add_control(
			'cb_page_select',
			[
				'label' => esc_html__('انتخاب صفحه', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $page,

			]
		);
		$post_types = get_post_types('', 'names');

		$this->add_control(
			'cb_post_type_select',
			[
				'label' => esc_html__('انتخاب پست تایپ', 'textdomain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'options' => $post_types,

			]
		);
		$this->add_control(
			'cb_post_type_title',
			[
				'label' => esc_html__( 'متن نوشته', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::TEXT,
				'default' => esc_html__( 'مشاهده همه', 'textdomain' ),
				'placeholder' => esc_html__( 'عنوان را وارد کنید', 'textdomain' ),
			]
		);
		$this->end_controls_section();


		$this->style_tab();
	}

	private function style_tab()
	{
		$this->start_controls_section(
			'cb_style_section',
			[
				'label' => esc_html__( 'استایل', 'textdomain' ),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'cb_typography',
				'selector' => '{{WRAPPER}} .cb_class',
			]
		);
		$this->add_control(
			'cb_bg_color',
			[
				'label' => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cb_class' => 'background-color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cb_color',
			[
				'label' => esc_html__( 'رنگ نوشته', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cb_class' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'cb_border_radius',
			[
				'label' => esc_html__( 'انحنای دکمه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .cb_class' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'cb_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em' ],
				'selectors' => [
					'{{WRAPPER}} .cb_class' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function render()
	{
		$values = $this->get_settings_for_display();

		$page = $values['cb_page_select'];
		$post_type = $values['cb_post_type_select'];
		$bot_title = $values['cb_post_type_title'];


		?>

		<a class="cb_class" href="<?php echo home_url() ?>/<?php if ($page != '') echo $page ?><?php if ($post_type != '') echo "?pt=".$post_type ?>"><?php echo $bot_title?></a>
		<?php


	}

	protected function content_template()
	{

	}
}


\Elementor\Plugin::instance()->widgets_manager->register(new jayto_link());




