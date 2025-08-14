<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class user_comments extends \Elementor\Widget_Base {
	public function get_name() {
		return 'user_comments';
	}

	public function get_title() {
		return 'بازخوردها';
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

		if ( ! isset ( $_GET['action'] ) ) {
			$res_id = get_the_ID();
		} else {
			$res_id = create_post_id();

		}
		$com=get_res_comments($res_id);
		$Match_the_ad_a=[];
		$Services_a=[];
		$res_Location_a=[];
		$res_encounter_a=[];
		$cleaning_a=[];
		$price_a=[];
	if($com){
		foreach($com as $row){
			// print_r($row);

			 $Match_the_ad_a[]=$row->Match_the_ad;
			$Services_a[]=$row->Services;
			$res_Location_a[]=$row->res_Location;
			$res_encounter_a[]=$row->res_encounter;
			$cleaning_a[]=$row->cleaning;
			$price_a[]=$row->price;
		}
		 $Match_the_ad_ave = array_sum($Match_the_ad_a)/count($Match_the_ad_a);
		 $Services_ave = array_sum($Services_a)/count($Services_a);
		 $res_Location_ave = array_sum($res_Location_a)/count($res_Location_a);
		 $res_encounter_ave = array_sum($res_encounter_a)/count($res_encounter_a);
		 $cleaning_ave = array_sum($cleaning_a)/count($cleaning_a);
		 $price_ave = array_sum($price_a)/count($price_a);
		 $all_star_sum = ((array_sum($Match_the_ad_a)+array_sum($Services_a)+array_sum($res_Location_a)+array_sum($res_encounter_a)+array_sum($cleaning_a)+array_sum($price_a))/6);
	}

		require get_template_directory() . '/template-parts/comments_template.php';

	 }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new user_comments() );

