<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class jayto_last_post extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_last_post';
	}

	public function get_title() {
		return 'آخرین مطالب';
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
				'lsp_content_section',
				[
					'label' => esc_html__( 'Content', 'textdomain' ),
					'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
				]
			);
	
			$this->add_control(
				'lsp_title',
				[
					'label' => esc_html__( 'تعداد پست در هر صفحه', 'textdomain' ),
					'type' => \Elementor\Controls_Manager::TEXT,
					'default' => esc_html__( '4', 'textdomain' ),
					'placeholder' => esc_html__( 'تعداد را اینجابنویسید', 'textdomain' ),
				]
			);
	
			$this->end_controls_section();
	
	
		$this->style_tab();
	}

	private function style_tab() {
	
		$this->start_controls_section(
			'jt_last_post_img-style',
			[
				'label' => __( 'استایل تصویر ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_last_post_img_border',
				'selector' => '{{WRAPPER}} .lpitem_img',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_last_post_img_shadow',
				'selector' => '{{WRAPPER}} .lpitem_img',
			]
		);
		$this->add_control(
			'jt_last_post_img_radius',
			[
				'label' => esc_html__( 'انحنا', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_img_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_img' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_img_padding',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_img' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Css_Filter::get_type(),
			[
				'name' => 'jt_last_post_img_filters',
				'selector' => '{{WRAPPER}} .lpitem_img img',
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_last_post_title-style',
			[
				'label' => __( 'استایل عنوان ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_last_post_title_typography',
				'selector' => '{{WRAPPER}} .lpitem_desc h2',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'jt_last_post_title_text_shadow',
				'selector' => '{{WRAPPER}} .lpitem_desc h2',
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_desc h2' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_desc h2' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_last_post_desc-style',
			[
				'label' => __( 'استایل توضیحات ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_last_post_desc_typography',
				'selector' => '{{WRAPPER}} .lpitem_desc p',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Text_Shadow::get_type(),
			[
				'name' => 'jt_last_post_title_text_shadow',
				'selector' => '{{WRAPPER}} .lpitem_desc p',
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_desc p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_title_margin',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .lpitem_desc p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
		$this->start_controls_section(
			'jt_last_post_more-style',
			[
				'label' => __( 'استایل دکمه ', 'jayto-Plugin' ),
				'tab'   => \Elementor\Controls_Manager::TAB_STYLE,
			]

		);
		$this->add_group_control(
			\Elementor\Group_Control_Typography::get_type(),
			[
				'name' => 'jt_last_post_more_typography',
				'selector' => '{{WRAPPER}} .post_read_more',
			]
		);
		$this->add_control(
			'jt_last_post_more_bgcolor',
			[
				'label' => esc_html__( 'رنگ پس زمینه', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post_read_more' => 'background: {{VALUE}}',
				],
			]
		);
		$this->add_control(
			'jt_last_post_more_title_color',
			[
				'label' => esc_html__( 'رنگ نوشته', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .post_read_more' => 'color: {{VALUE}}',
				],
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Box_Shadow::get_type(),
			[
				'name' => 'jt_last_post_more_shadow',
				'selector' => '{{WRAPPER}} .post_read_more',
			]
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name' => 'jt_last_post_more_border',
				'selector' => '{{WRAPPER}} .post_read_more',
			]
		);
		$this->add_control(
			'jt_last_post_more_margin',
			[
				'label' => esc_html__( 'فاصله خارجی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .post_read_more' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
		$this->add_control(
			'jt_last_post_more_margin',
			[
				'label' => esc_html__( 'فاصله داخلی', 'textdomain' ),
				'type' => \Elementor\Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
				'selectors' => [
					'{{WRAPPER}} .post_read_more' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);
	}

	protected function render() {
		$settings = $this->get_settings_for_display();
	 $num_in_page    = intval($settings['lsp_title']);

	 $max_number = 10;
		$args = array(
			'numberposts' => -1,
			'post_type'   => 'post'
		);
		$args_on_page = array(
			'numberposts' => $num_in_page,
			'post_type'   => 'post'
		);
		

		$tile_post = get_posts( $args );
		$tile_post_page = get_posts( $args_on_page );
		 $post_sum = count($tile_post);
		 $page_number = ceil($post_sum/$num_in_page);
		
		?>
				<input type="hidden" class="pagenum_hid" value = "<?php  echo $num_in_page ?>" >
		<div class="blog_lp_box">

			<?php
			foreach ( $tile_post_page as $post ) {
				$image_url = get_the_post_thumbnail_url($post->ID, 'full');
				?>
				<div class="lp_item">
					<div class="lpitem_img">
						<img src="<?php echo $image_url ?>" alt="">
					</div>
					<div class="lpitem_desc">
						<h2>
							<?php echo $post->post_title?>
						</h2>
                        <p><?php echo get_the_excerpt($post->ID) ?></p>
                        <a class="post_read_more" href="<?php echo get_the_permalink($post->ID)?>">بیشتر بخوانید</a>
					</div>


				</div>

			<?php }
			?>
		</div>
		<div class="j_pagination">
			<?php
              for($i = 1 ; $i<=  $page_number ; $i++ ){
				if($i <= $max_number){ ?>
              <span class="pagi_num" data-page ="<?php echo $i  ?>"><?php echo $i  ?></span>
				<?php }
				?>
                
			<?php  }
			if($page_number > $max_number){
			echo	"<span class='last_page_pagination'>...</span>";
			}
			
			?>
		</div>
		<?php
	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new jayto_last_post() );

