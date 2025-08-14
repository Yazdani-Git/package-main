<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_reserve_info extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_reserve_info';
	}

	public function get_title() {
		return 'اطلاعات تور فرم رزرو';
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


	}

	protected function render() {
		if (  isset ( $_GET['poid'] )  ) {
			$tour_id = $_GET['poid'];
		} else {
			$tour_id = create_post_id();
		}
   

        $uid=get_current_user_id();
		$input_sans = get_user_meta( $uid, 'sans_session', true );
		$tmeta = 	get_post_meta( $tour_id, 'all_tour_meta', true);
		$item_city          = get_the_terms( $tour_id, 'city' );
		$featured_img_url = get_the_post_thumbnail_url($tour_id, 'full');
		$args       = array(
			'post_type'      => 'tour',
			'posts_per_page' => '1',
			'post_id'        =>$tour_id,
			'post_status'    => 'publish'
		);
		$tour_information = get_post( $tour_id );
   
            ?>
        <div class="resf_infbox">
            <div class="d_flex jcspcbt  resf_infhead ">
                <figure class="w50p">
                    <img class="bor7" src="<?php  echo $featured_img_url ?>" alt="">
                </figure>
                <div class="dfcflx ">
                    <p class="fz12"><?php  echo $tour_information->post_title ?></p>

                    <p class="fz12 mt_10 jayja" >
                        <i class="fa-thin fa-location-pin-lock col_orng"></i>


		                <?php
		                $no_city = sizeof( $item_city );
		                $i       = 1;
		                foreach ( $item_city as $item ) {
			                ?>
                            <span class="scn mbt15"><?php echo $item->name; ?><?php
				                if ( $i < $no_city )
					                echo '-'
				                ?></span>
			                <?php $i ++;
		                }
		                ?>
                       </p>
                </div>
            </div>
            <span class="line"></span>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/جای تجربه.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">جای تجربه</p>
                    <p class="fz13 fw500 mt_10"><?php echo $tmeta['tour_place_opt']?></p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/چالش فیزیکی.png" alt="" class="mt_20">                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">چالش فیزیکی</p>
                    <p class="fz13 fw500 mt_10"><?php echo $tmeta['Physical_challenge'] ?></p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/مناسب برای.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">مناسب برای</p>
                    <p class="fz13 fw500 mt_10"><?php  echo $tmeta['age_need'] ?></p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/مدت تجربه.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">مدت تجربه</p>
                    <p class="fz13 fw500 mt_10"><?php  echo $tmeta['tour_time'] ?> ساعت </p>
                </div>
            </div>
            <div class="d_flex mt_10 ">
                <figure>
                    <img src="<?php echo get_template_directory_uri() ?>/images/ظرفیت هر سانس.png" alt="" class="mt_20">
                </figure>
                <div class="mr10 ">
                    <p class="fz11 col_gray fw300 ">ظرفیت هر سانس</p>
                    <p class="fz13 fw500 mt_10"><?php echo  $tmeta['tour_capacity'] ?>  نفر </p>
                </div>
            </div>

        </div>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_reserve_info() );

