<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;

class breadcrumb_widget extends Widget_Base {
    public function get_name() {
        return 'jayto breadcrumb';
    }

    public function get_title() {
        return 'نمایش مسیر';
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
            'linMenu_StyleSection',
            [
                'label' => esc_html__( 'Content', 'plugin-name' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'bread_BgColor',
            [
                'label' => esc_html__( 'رنگ پس زمینه', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bread_st' => 'background-color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
            'bread_Color',
            [
                'label' => esc_html__( 'رنگ نوشته مسیر', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bread_st' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->add_control(
			'bread_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bread_st' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'bread_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bread_st' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->add_control(
			'bread_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .bread_st' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

        $this->end_controls_section();

    }

    protected function render() {
        echo '<a class="bread_st" href="'.home_url().'" rel="nofollow">خانه</a>';
        if ( is_category() || is_single() ) {
            echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
            the_category( ' &bull; ' );
            if ( is_single() ) {
                $tit = get_the_title();
                echo "<span class='bread_st'>".$tit."</span>";

            }
        } elseif ( is_page() ) {
            echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;';
            echo '<span class="bread_st">'.the_title().'</span>';
        } elseif ( is_search() ) {
            echo '&nbsp;&nbsp;&#187;&nbsp;&nbsp;نتیجه جستجو برای ';
            echo '"<em>';
            echo the_search_query();
            echo '</em>"';
        }

    }

    protected function content_template() {

    }
}

\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new breadcrumb_widget() );

?>

