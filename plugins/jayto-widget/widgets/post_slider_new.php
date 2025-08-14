<?php

namespace Elementor;

if (!defined('ABSPATH'))
	exit;

class post_slider_new extends Widget_Base
{

	public function get_name()
	{
		return 'post_slider_new';
	}

	public function get_title()
	{
		return __('اسلایدر پست ها (جدید)', 'jayto');
	}

	public function get_icon()
	{
		return 'eicon-slider-album';
	}

	public function get_categories()
	{
		return ['jayto'];
	}

	protected function _register_controls()
	{
		$this->start_controls_section(
			'content_section',
			[
				'label' => __('کوئری', 'jayto'),
				'tab' => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'qs_header_title',
			[
				'label' => esc_html__('عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('عنوان را وارد کنید', 'jayto'),
			]
		);
		$this->add_control(
			'qs_header_desc',
			[
				'label' => esc_html__('توضیح', 'jayto'),
				'type' => \Elementor\Controls_Manager::TEXT,
				'placeholder' => esc_html__('توضیح  را وارد کنید', 'jayto'),
			]
		);
		$this->add_control(
			'td_course_title_tag',
			[
				'label' => __('تگ عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'Paragraph',
					'span' => 'Span',
				],
			]
		);
		$this->add_control(
			'td_course_desc_tag',
			[
				'label' => __('تگ عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'Paragraph',
					'span' => 'Span',
				],
			]
		);

		// کنترل انتخاب نویسنده
		$authors_options = [];
		$authors = get_users(['who' => 'authors', 'orderby' => 'display_name']);
		foreach ($authors as $author) {
			$authors_options[$author->ID] = $author->display_name;
		}

		$this->add_control(
			'query_author_id',
			[
				'label' => __('نویسنده', 'jayto'),
				'type' => Controls_Manager::SELECT2,
				'options' => $authors_options,
				'multiple' => false,
				'label_block' => true,
				'placeholder' => __('نویسنده را انتخاب کنید', 'jayto'),
			]
		);

		// کنترل متنی برای جستجوی آزاد نویسنده (اختیاری)
		$this->add_control(
			'query_teacher_name',
			[
				'label' => __('جستجوی آزاد نویسنده', 'jayto'),
				'type' => Controls_Manager::TEXT,
				'label_block' => true,
				'placeholder' => __('نام نویسنده را وارد کنید (اختیاری)', 'jayto'),
				'description' => __('اگر نویسنده مورد نظر در لیست بالا نبود، نام او را اینجا وارد کنید', 'jayto'),
			]
		);

		// کنترل برای دسته‌بندی‌ها
		$categories_options = [];
		$categories = get_categories(['hide_empty' => false]);
		if (!is_wp_error($categories)) {
			foreach ($categories as $category) {
				$categories_options[$category->slug] = $category->name;
			}
		}

		$this->add_control(
			'query_post_categories',
			[
				'label' => __('کوئری بر اساس دسته‌بندی‌ها', 'jayto'),
				'type' => Controls_Manager::SELECT2,
				'options' => $categories_options,
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __('دسته‌بندی‌ها را انتخاب کنید', 'jayto'),
			]
		);

		// کنترل جداگانه برای تگ‌ها
		$tags_options = [];
		$tags = get_tags(['hide_empty' => false]);
		if (!is_wp_error($tags)) {
			foreach ($tags as $tag) {
				$tags_options[$tag->slug] = $tag->name;
			}
		}

		$this->add_control(
			'query_post_tags',
			[
				'label' => __('کوئری بر اساس تگ‌ها', 'jayto'),
				'type' => Controls_Manager::SELECT2,
				'options' => $tags_options,
				'multiple' => true,
				'label_block' => true,
				'placeholder' => __('تگ‌ها را انتخاب کنید', 'jayto'),
			]
		);

		$this->add_control(
			'posts_per_page',
			[
				'label' => __('تعداد پست‌ها', 'jayto'),
				'type' => Controls_Manager::NUMBER,
				'default' => 10,
				'min' => 1,
				'max' => 50,
				'step' => 1,
			]
		);

		$this->add_control(
			'orderby',
			[
				'label' => __('مرتب‌سازی بر اساس', 'jayto'),
				'type' => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date' => __('تاریخ انتشار', 'jayto'),
					'title' => __('عنوان', 'jayto'),
					'rand' => __('تصادفی', 'jayto'),
					'comment_count' => __('تعداد نظرات', 'jayto'),
					'menu_order' => __('ترتیب منو', 'jayto'),
					'modified' => __('تاریخ ویرایش', 'jayto'),
				],
			]
		);

		$this->add_control(
			'order',
			[
				'label' => __('ترتیب', 'jayto'),
				'type' => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __('نزولی', 'jayto'),
					'ASC' => __('صعودی', 'jayto'),
				],
			]
		);

		$this->add_control(
			'show_placeholder_image',
			[
				'label' => __('نمایش تصویر پیش‌فرض', 'jayto'),
				'type' => Controls_Manager::SWITCHER,
				'label_on' => __('بله', 'jayto'),
				'label_off' => __('خیر', 'jayto'),
				'return_value' => 'yes',
				'default' => 'yes',
				'description' => __('در صورت عدم وجود تصویر شاخص، تصویر پیش‌فرض نمایش داده شود', 'jayto'),
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'td_slider_items_box_style',
			[
				'label' => __(' استایل باکس آیتم ها', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'td_items_box_radius',
			[
				'label' => esc_html__(' انحنای آیتم ها', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .sw_item_inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'td_items_box_shadow',
				'selector' => '{{WRAPPER}} .sw_item_inner ',
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'slider_settings_section',
			[
				'label' => esc_html__('تنظیمات اسلایدر', 'text-domain'),
				'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
			]
		);

		// Loop
		$this->add_control(
			'slider_loop',
			[
				'label' => esc_html__('فعال‌سازی لوپ', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('بله', 'text-domain'),
				'label_off' => esc_html__('خیر', 'text-domain'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		// Centered Slides
		$this->add_control(
			'slider_centered',
			[
				'label' => esc_html__('مرکز‌چین کردن اسلایدها', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('بله', 'text-domain'),
				'label_off' => esc_html__('خیر', 'text-domain'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		// Autoplay Switch
		$this->add_control(
			'slider_autoplay',
			[
				'label' => esc_html__('فعال‌سازی پخش خودکار', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('بله', 'text-domain'),
				'label_off' => esc_html__('خیر', 'text-domain'),
				'return_value' => 'true',
				'default' => 'true',
			]
		);

		$this->add_control(
			'slider_autoplay_delay',
			[
				'label' => esc_html__('تأخیر بین اسلایدها (ms)', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2500,
				'min' => 100,
				'step' => 100,
				'condition' => [
					'slider_autoplay' => 'true',
				],
			]
		);

		$this->add_control(
			'slider_autoplay_disable_on_interaction',
			[
				'label' => esc_html__('توقف با تعامل کاربر', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('بله', 'text-domain'),
				'label_off' => esc_html__('خیر', 'text-domain'),
				'return_value' => 'true',
				'default' => 'false',
				'condition' => [
					'slider_autoplay' => 'true',
				],
			]
		);
		$this->add_control(
			'slider_effect',
			[
				'label' => esc_html__('نوع افکت', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'slide',
				'options' => [
					'slide' => esc_html__('اسلاید معمولی', 'text-domain'),
					'fade' => esc_html__('محو شدن', 'text-domain'),
					'cube' => esc_html__('مکعب', 'text-domain'),
					'coverflow' => esc_html__('Coverflow', 'text-domain'),
					'flip' => esc_html__('چرخش', 'text-domain'),
					'cards' => esc_html__('کارت‌ها', 'text-domain'),
					'creative' => esc_html__('خلاقانه', 'text-domain'),
				],
			]
		);

		// تنظیمات افکت Coverflow
		$this->add_control(
			'coverflow_rotate',
			[
				'label' => esc_html__('زاویه چرخش Coverflow', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['deg'],
				'range' => [
					'deg' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => 'deg',
					'size' => 50,
				],
				'condition' => [
					'slider_effect' => 'coverflow',
				],
			]
		);

		$this->add_control(
			'coverflow_stretch',
			[
				'label' => esc_html__('کشش Coverflow', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 100,
						'step' => 5,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 0,
				],
				'condition' => [
					'slider_effect' => 'coverflow',
				],
			]
		);

		$this->add_control(
			'coverflow_depth',
			[
				'label' => esc_html__('عمق Coverflow', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['%'],
				'range' => [
					'%' => [
						'min' => 0,
						'max' => 200,
						'step' => 10,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'condition' => [
					'slider_effect' => 'coverflow',
				],
			]
		);

		// تنظیمات افکت Cube
		$this->add_control(
			'cube_shadow',
			[
				'label' => esc_html__('سایه مکعب', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('فعال', 'text-domain'),
				'label_off' => esc_html__('غیرفعال', 'text-domain'),
				'return_value' => 'true',
				'default' => 'true',
				'condition' => [
					'slider_effect' => 'cube',
				],
			]
		);

		// تنظیمات افکت Cards
		$this->add_control(
			'cards_per_slide_offset',
			[
				'label' => esc_html__('تعداد کارت‌های قابل مشاهده', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 2,
				'min' => 1,
				'max' => 5,
				'condition' => [
					'slider_effect' => 'cards',
				],
			]
		);

		// تنظیمات افکت Creative
		$this->add_control(
			'creative_progress',
			[
				'label' => esc_html__('نمایش نوار پیشرفت', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SWITCHER,
				'label_on' => esc_html__('فعال', 'text-domain'),
				'label_off' => esc_html__('غیرفعال', 'text-domain'),
				'return_value' => 'true',
				'default' => 'false',
				'condition' => [
					'slider_effect' => 'creative',
				],
			]
		);

		$this->add_control(
			'speed',
			[
				'label' => esc_html__('سرعت انیمیشن (ms)', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 300,
				'min' => 100,
				'max' => 2000,
				'step' => 50,
				'description' => esc_html__('سرعت تغییر اسلایدها', 'text-domain'),
			]
		);
		$this->add_control(
			'slides_300',
			[
				'label' => esc_html__('تعداد در سایز 300px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1.2,
				'step' => 0.1,
			]
		);

		$this->add_control(
			'slides_400',
			[
				'label' => esc_html__('تعداد در سایز 400px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 1.2,
				'step' => 0.1,
			]
		);

		$this->add_control(
			'slides_750',
			[
				'label' => esc_html__('تعداد در سایز 750px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
			'slides_1200',
			[
				'label' => esc_html__('تعداد در سایز 1200px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4.2,
				'step' => 0.1,
			]
		);

		$this->add_control(
			'slides_1400',
			[
				'label' => esc_html__('تعداد در سایز 1400px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 4,
			]
		);

		$this->add_control(
			'slides_1500',
			[
				'label' => esc_html__('تعداد در سایز 1500px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->add_control(
			'slides_1920',
			[
				'label' => esc_html__('تعداد در سایز 1920px', 'text-domain'),
				'type' => \Elementor\Controls_Manager::NUMBER,
				'default' => 5,
			]
		);

		$this->end_controls_section();
		$this->start_controls_section(
			'td_qslider_style',
			[
				'label' => __('متن عنوان ', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'td_qslider_title_typography',
				'selector' => '{{WRAPPER}} .td_lslit',
			]
		);

		$this->add_control(
			'td_cat_name1_color',
			[
				'label' => esc_html__('رنگ عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td_lslit' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_cat_name1_color_hover',
			[
				'label' => esc_html__('رنگ هاورعنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td_lslit:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_cat_name1_color_margin',
			[
				'label' => esc_html__('فاصله', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .td_lslit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'td_cat_name1_color_padding',
			[
				'label' => esc_html__('فاصله داخلی', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .td_lslit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		$this->start_controls_section(
			'td_qslider_desc_style',
			[
				'label' => __(' زیر عنوان ', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);

		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'td_qslider_desc_typography',
				'selector' => '{{WRAPPER}} .td_lslib',
			]
		);

		$this->add_control(
			'td_qslider_desc_color',
			[
				'label' => esc_html__('رنگ عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td_lslib' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_qslider_desc_hover',
			[
				'label' => esc_html__('رنگ هاورعنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .td_lslib:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_qslider_desc_margin',
			[
				'label' => esc_html__('فاصله', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .td_lslib' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'td_qslider_desc_padding',
			[
				'label' => esc_html__('فاصله داخلی', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .std_lslib' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);


		$this->end_controls_section();
		$this->start_controls_section(
			'td_qslider_ctitle_style',
			[
				'label' => __('متن دوره ', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_control(
			'td_qslider_ctitle_tag',
			[
				'label' => __('تگ زیرعنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::SELECT,
				'default' => 'h1',
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'p' => 'Paragraph',
					'span' => 'Span',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'td_qslider_ctitle_typography',
				'selector' => '{{WRAPPER}} .cour_tit',
			]
		);

		$this->add_control(
			'td_slider_ctitle_color',
			[
				'label' => esc_html__('رنگ عنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cour_tit' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_slider_ctitle_color_hover',
			[
				'label' => esc_html__('رنگ هاورعنوان', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .cour_tit:hover' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_slider_ctitle_margin',
			[
				'label' => esc_html__('فاصله', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .cour_tit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'td_slider_ctitle_padding',
			[
				'label' => esc_html__('فاصله داخلی', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .cour_tit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->end_controls_section();
		



		$this->start_controls_section(
			'td_qslider_img_style',
			[
				'label' => __('تصویر ', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'td_qslider_img_border',
				'selector' => '{{WRAPPER}} .qslider_image_nb ',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'td_qslider_img_shadow',
				'selector' => '{{WRAPPER}} .qslider_image_nb ',
			]
		);
		$this->add_control(
			'td_qslider_img_radius',
			[
				'label' => esc_html__('انحنای حاشیه', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .qslider_image_nb' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'td_qslider_img_padd',
			[
				'label' => esc_html__('فاصله داخلی', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .qslider_image_nb' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'td_qslider_img_filters',
				'selector' => '{{WRAPPER}} .qslider_image_nb',
			]
		);

	

		$this->end_controls_section();
		$this->start_controls_section(
			'td_qslider_navi_style',
			[
				'label' => __('فلش ها ', 'jayto'),
				'tab' => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_responsive_control(
			'td_qslider_navi',
			[
				'label' => esc_html__('طول و عرض', 'text-domain'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'vh', 'vw'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .sqbp, {{WRAPPER}} .sqbn' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'border',
				'selector' => '{{WRAPPER}} .sqbp ,{{WRAPPER}} .sqbn ',
			]
		);
		$this->add_control(
			'td_qslider_navi_radius',
			[
				'label' => esc_html__('انحنای حاشیه', 'jayto'),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'selectors' => [
					'{{WRAPPER}} .sqbp,{{WRAPPER}} .sqbn ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'td_qslider_navi_color',
			[
				'label' => esc_html__('رنگ فلش ها', 'jayto'),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .sqbp > span,{{WRAPPER}} .sqbn > span' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'td_qslider_navigap',
			[
				'label' => esc_html__('فاصله', 'jayto'),
				'type' => \Elementor\Controls_Manager::SLIDER,
				'size_units' => ['px', '%', 'em', 'rem', 'custom'],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],

				],
				'default' => [
					'unit' => 'px',
					'size' => 10,
				],
				'selectors' => [
					'{{WRAPPER}} .swiper-but-box ' => 'gap: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}


	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$head_title = $settings['qs_header_title'];
		$head_desc = $settings['qs_header_desc'];
		$title_tag = tag_escape($settings['td_course_title_tag']);
		$desc_tag = tag_escape($settings['td_course_desc_tag']);
		$course_title_tag = tag_escape($settings['td_qslider_ctitle_tag']);
		$tax_query = [];
		$meta_query = [];
		$author_query = [];

		// کوئری دسته‌بندی‌ها
		if (!empty($settings['query_post_categories'])) {
			$tax_query[] = [
				'taxonomy' => 'category',
				'field' => 'slug',
				'terms' => $settings['query_post_categories'],
			];
		}

		// کوئری تگ‌ها
		if (!empty($settings['query_post_tags'])) {
			$tax_query[] = [
				'taxonomy' => 'post_tag',
				'field' => 'slug',
				'terms' => $settings['query_post_tags'],
			];
		}

		// کوئری نویسنده - اولویت با انتخاب از لیست
		if (!empty($settings['query_author_id'])) {
			$author_query = [
				'author' => $settings['query_author_id']
			];
		} elseif (!empty($settings['query_teacher_name'])) {
			// جستجو برای نویسنده بر اساس نام (فقط اگر از لیست انتخاب نشده باشد)
			$author = get_user_by('display_name', $settings['query_teacher_name']);
			if (!$author) {
				$author = get_user_by('user_login', $settings['query_teacher_name']);
			}
			if (!$author) {
				$author = get_user_by('user_nicename', $settings['query_teacher_name']);
			}
			
			if ($author) {
				$author_query = [
					'author' => $author->ID
				];
			}
		}

		$args = [
			'post_type' => 'post',
			'posts_per_page' => !empty($settings['posts_per_page']) ? intval($settings['posts_per_page']) : 10,
			'orderby' => !empty($settings['orderby']) ? $settings['orderby'] : 'date',
			'order' => !empty($settings['order']) ? $settings['order'] : 'DESC',
			'tax_query' => $tax_query,
			'meta_query' => $meta_query,
		];

		// اضافه کردن کوئری نویسنده به آرگومان‌ها
		if (!empty($author_query)) {
			$args = array_merge($args, $author_query);
		}
		$query = new \WP_Query($args);

		$rand = rand(10, 1000000);


?>

		<div class="swiper-container ">

			<div class="swiper_arrow_box">
				<div class="swiper_header">
					<<?php echo $title_tag ?> class="td_lslit"><?php echo $head_title ?></<?php echo $title_tag ?>>
					<<?php echo $desc_tag ?> class="td_lslib"><?php echo $head_desc ?></<?php echo $desc_tag ?>>

					<span class="alide_headline"></span>
				</div>

				<div class="swiper-but-box">
					<div class=" sqbp swiper_que_but_prev<?php echo $rand ?>"><span class="fa fa-chevron-right"></span>
					</div>
					<div class="sqbn swiper_que_but_next<?php echo $rand ?>"><span class="fa fa-chevron-left"></div>
				</div>

			</div>
			<div class="swiper query_slider<?php echo $rand ?>">

				<div class="swiper-wrapper ">

					<?php
					if ($query->have_posts()) {
						while ($query->have_posts()) {
							$query->the_post();
							$row = get_post();
							$image = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), 'medium', true);
							$img_url = $image[0];
							
							// اگر تصویر شاخص وجود نداشت و نمایش تصویر پیش‌فرض فعال باشد
							if (!$img_url && $settings['show_placeholder_image'] === 'yes') {
								$img_url = get_template_directory_uri() . '/assets/images/placeholder.jpg';
							}

					?>
						<div class="swiper-slide">
							<a href="<?php echo get_the_permalink($row->ID) ?>">
								<section class="section slider-section ">

									<div class="swiper swiper-slider query_slider-<?php echo $rand ?>">

										<div class="swiper-wrapper">

											<div class="swipe_item p-3">
												<div class="sw_item_inner">

													<?php if ($img_url): ?>
														<img class="qslider_image_nb" src="<?php echo $img_url; ?>" alt="<?php echo esc_attr(get_the_title($row->ID)); ?>">
													<?php endif; ?>

													<div class="sw_info pl-2 pr-2 ">
														<<?php echo $course_title_tag ?> class="fz14 __colorgray fontIran cour_tit">
															<?php echo esc_html(get_the_title($row->ID)) ?>
														</<?php echo $course_title_tag ?>>
													</div>
												
												</div>
											</div>

										</div>

									</div>

								</section>
							</a>
						</div>
					<?php 
						}
					} else {
						// نمایش پیام در صورت عدم وجود پست
						echo '<div class="swiper-slide"><div class="no-posts-message" style="text-align: center; padding: 20px; color: #666;">';
						echo '<p>' . __('هیچ پستی با این معیارها یافت نشد.', 'jayto') . '</p>';
						echo '</div></div>';
					}
					?>

				</div>

			</div>
		</div>
		<script>
			var swiperConfig = {
				loop: <?php echo $settings['slider_loop'] === 'true' ? 'true' : 'false'; ?>,
				centeredSlides: <?php echo $settings['slider_centered'] === 'true' ? 'true' : 'false'; ?>,
				speed: <?php echo intval($settings['speed'] ?? 300); ?>,
				navigation: {
					nextEl: '.swiper_que_but_next<?php echo $rand ?>',
					prevEl: '.swiper_que_but_prev<?php echo $rand ?>',
				},
				breakpoints: {
					300: {
						slidesPerView: <?php echo $settings['slides_300']; ?>,
						spaceBetween: 5,
					},
					400: {
						slidesPerView: <?php echo $settings['slides_400']; ?>,
						spaceBetween: 5,
					},
					750: {
						slidesPerView: <?php echo $settings['slides_750']; ?>,
						spaceBetween: 5,
					},
					1200: {
						slidesPerView: <?php echo $settings['slides_1200']; ?>,
						spaceBetween: 0,
					},
					1400: {
						slidesPerView: <?php echo $settings['slides_1400']; ?>,
						spaceBetween: 0,
					},
					1500: {
						slidesPerView: <?php echo $settings['slides_1500']; ?>,
						spaceBetween: 10,
					},
					1920: {
						slidesPerView: <?php echo $settings['slides_1920']; ?>,
						spaceBetween: 0,
					}
				}
			};

			<?php if ($settings['slider_autoplay'] === 'true'): ?>
			swiperConfig.autoplay = {
				delay: <?php echo intval($settings['slider_autoplay_delay'] ?: 2500); ?>,
				disableOnInteraction: <?php echo $settings['slider_autoplay_disable_on_interaction'] === 'true' ? 'true' : 'false'; ?>,
			};
			<?php endif; ?>

			<?php if ($settings['slider_effect'] && $settings['slider_effect'] !== 'slide'): ?>
			swiperConfig.effect = "<?php echo $settings['slider_effect']; ?>";
			swiperConfig.grabCursor = true;

			<?php if ($settings['slider_effect'] === 'coverflow'): ?>
			swiperConfig.centeredSlides = false;
			swiperConfig.slidesPerView = "auto";
			swiperConfig.coverflowEffect = {
				rotate: <?php echo $settings['coverflow_rotate']['size'] ?? 50; ?>,
				stretch: <?php echo $settings['coverflow_stretch']['size'] ?? 0; ?>,
				depth: <?php echo $settings['coverflow_depth']['size'] ?? 100; ?>,
				modifier: 1,
				slideShadows: false,
				freeMode: true,
			};
			<?php elseif ($settings['slider_effect'] === 'cube'): ?>
			swiperConfig.cubeEffect = {
				shadow: <?php echo $settings['cube_shadow'] === 'true' ? 'true' : 'false'; ?>,
				slideShadows: true,
				shadowOffset: 20,
				shadowScale: 0.94,
			};
			<?php elseif ($settings['slider_effect'] === 'flip'): ?>
			swiperConfig.flipEffect = {
				slideShadows: true,
				limitRotation: true,
			};
			<?php elseif ($settings['slider_effect'] === 'cards'): ?>
			swiperConfig.cardsEffect = {
				perSlideOffset: 8,
				perSlideRotate: 2,
				rotate: true,
				slideShadows: true,
			};
			swiperConfig.slidesPerView = <?php echo $settings['cards_per_slide_offset'] ?? 2; ?>;
			<?php elseif ($settings['slider_effect'] === 'creative'): ?>
			swiperConfig.creativeEffect = {
				prev: {
					shadow: true,
					translate: [0, 0, -400],
				},
				next: {
					translate: ['100%', 0, 0],
				},
			};
			<?php endif; ?>
			<?php endif; ?>

			var swiper = new Swiper(".query_slider<?php echo $rand ?>", swiperConfig);
		</script>
		</script>
<?php
		wp_reset_postdata();
	}
}


\Elementor\Plugin::instance()->widgets_manager->register(new post_slider_new());
