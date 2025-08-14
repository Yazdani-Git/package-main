<?php


class header_menu extends \Elementor\Widget_Base {
	public function get_name() {
		return 'jayto_menu';
	}

	public function get_title() {
		return 'منوی دسته بندی';
	}

	public function get_script_depends() {
		return [ 'jayto_script' ];
	}

	public function get_icon() {
		return 'eicon-skill-bar';
	}

	public function get_categories() {
		return [ 'jayto' ];
	}

	protected function register_controls() {

	}

	protected function render() {
//		$args = array(
//                'posr_per_page'=>'20',
//			'orderby' => 'name',
//			'order' => 'ASC',
//			'parent' => 0,
//            'hide_empty'=>'false'
//		);
//		$categories = get_categories($args);
		$args       = array(
			'post_type'  => 'post',
			'taxonomy'   => 'category',
			'parent'     => 0,
			'hide_empty' => 0
		);
		$categories = get_terms( $args );

		?>
        <div class="menu_box">
			<?php
			if ( ! wp_is_mobile() ) {
				?>
                <div class="head_menu">
                    <li><a href="<?php echo site_url() ?>/mag">صفحه اصلی</a></li>
                    <ul>
						<?php
						foreach ( $categories as $cat ) {
							$args2          = array(
								'post_type'  => 'post',
								'taxonomy'   => 'category',
								'parent'     => $cat->term_id,
								'hide_empty' => 0
							);
							$sub_categories = get_terms( $args2 );
							?>


							<?php
							$category_link = get_category_link( $cat->term_id )
							?>
                            <li><a href="<?php echo $category_link ?>">  <?php echo $cat->name ?>

									<?php
									if ( $sub_categories ) {
										?>
                                        <i class="fa-regular fa-chevron-down"></i>
									<?php }
									?>
                                </a>
								<?php

								if ( $sub_categories ) { ?>
                                    <div class="head_sub_menu">
                                        <ul>
											<?php
											foreach ( $sub_categories as $row ) {
												$sub_category_link = get_category_link( $row->term_id )
												?>

                                                <li><a href="<?php echo $sub_category_link ?>"><?php echo $row->name ?></a></li>
											<?php }
											?>


                                        </ul>
                                    </div>
								<?php }

								?>


                            </li>


						<?php }
						?>
                    </ul>
                </div>
			<?php } else {
				?>
                <div class="humber_menu">
                    <i class="fa fa-thin fa-bars fa-2x"></i>
                </div>
                <div class="humber_overbox">
                    <div class="humber_close">
                        <i class="fa-thin fa fa-close  col_red"></i>
                    </div>
                    <div class="drop_menu">
                        <li><a href="<?php echo site_url() ?>/mag">صفحه اصلی</a></li>
                        <ul>
							<?php
							foreach ( $categories as $cat ) {
								$args2          = array(
									'post_type'  => 'post',
									'taxonomy'   => 'category',
									'parent'     => $cat->term_id,
									'hide_empty' => 0
								);
								$sub_categories = get_terms( $args2 );
								?>


								<?php

								$category_link = get_category_link( $cat->term_id );
                                 if ($sub_categories){
	                                 $cls = 'is_parent';
                                 }else{
	                                 $cls = '';
                                 }

								?>
                                <li class="<?php echo $cls?>">


									<?php
									if ( ! $sub_categories ) { ?>
                                        <a href="<?php echo $category_link ?>">  <?php echo $cat->name ?>

											<?php
											if ( $sub_categories ) {
												?>

											<?php }
											?>
                                        </a>
									<?php } else { ?>
                                        <span><?php echo $cat->name ?><i class="fa-regular fa-chevron-down"></i></span>
									<?php }
									if ( $sub_categories ) { ?>
                                        <div class="drop_sub_menu">
                                            <ul>
												<?php
												foreach ( $sub_categories as $row ) {
													$sub_category_link = get_category_link( $row->term_id )
													?>

                                                    <li><a href="<?php echo $sub_category_link ?>"><?php echo $row->name ?></a></li>
												<?php }
												?>


                                            </ul>
                                        </div>
									<?php }

									?>


                                </li>


							<?php }
							?>
                        </ul>
                    </div>
                </div>
			<?php }
			?>
        </div>

		<?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new header_menu() );




