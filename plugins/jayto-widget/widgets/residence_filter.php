<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class residence_filter extends \Elementor\Widget_Base {
	public function get_name() {
		return 'residence_filter';
	}

	public function get_title() {
		return 'فیلتر اقامتگاه';
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

		?>
<div class="filters">
    <?php
		$obj=get_queried_object();
        $t_date=jdate("Y-m-d")
        ?>
        
        <div class="sboxes">
            <input type="hidden" class="tax_h" data-tax="<?php echo $obj->taxonomy?>" data-tid="<?php echo $obj->term_id?>">
            <div class="filter_date ">
                <date-picker placeholder="<?php echo _e('انتخاب تاریخ','jayto') ?>" from="<?php $t_date  ?>"></date-picker>

            </div>
        </div>

    <div class="people_num pinp">
        <div class="sboxes">
            <i class="fa-thin fa-people-simple fa-2x"></i>
            <input name="pn_input" class="pn_input fillimp" type="text"
                placeholder="<?php echo _e('تعداد نفرات','jayto') ?>">
            <div class="shpn"></div>
        </div>

        <div class="pn_input_box filbox">
            <div class="pnib_top">
                <figure><img src="<?php echo get_template_directory_uri() ?>/images/arch_people.svg'" alt=""></figure>
                <div class="pnib_title">
                    <span class="fz15 fw700"><?php echo _e('تعداد نفرات','jayto') ?></span>
                    <span class="no_matt fz12 fw300 col_gray">مهم نیست</span>
                </div>
                <div class="add_min_box">
                    <button class="plus_but">+</button>
                    <span class="mp_val">0</span>
                    <button class="minus_but">-</button>
                </div>
            </div>
            <span class="line"></span>
            <div class="pnib_bot">
                <span class="arch_clos_num"><?php echo _e('حذف فیلتر','jayto') ?></span>
                <span class="arch_submit_num subm"><?php echo _e('ثبت تعداد نفرات','jayto') ?></span>
            </div>
        </div>
    </div>
    <div class="price_filter pinp">
        <div class="sboxes">
            <i class="fa-thin fa-sack-dollar fa-2x"></i>
            <input name="price_input" class="price_input fillimp" type="text"
                placeholder="<?php echo _e('قیمت برای هر شب','jayto') ?>">
        </div>

        <div class="price_input_box filbox">
            <div class="pri_top">
                <p class="width100 mt_10"><span
                        class="fz15 fw700 col_gray2"><?php echo _e('قیمت برای هر شب','jayto') ?></span></p>

                <div>
                    <div class="disjc mt_10 mb10">
                        <span class="range_input_min">50000</span>&nbsp;
                        <span><?php echo _e('تومان','jayto') ?> <span class="col_gray fz11">
                                <?php echo _e('تا','jayto') ?> </span></span>
                        &nbsp; <span class="range_input_max">5000000</span>&nbsp;
                        <span><?php echo _e('تومان','jayto') ?> </span>
                    </div>

                    <div class="rsic">
                        <input class="slider" name="min_price" id="min_price" type="range" min="50000" max="5000000"
                            step="1000" value="50000">

                        <input class="slider" name="max_price" id="max_price" type="range" min="50000" max="5000000"
                            step="1000" value="5000000">

                    </div>


                </div>


            </div>
            <span class="line"></span>
            <div class="pnib_bot">
                <span class="arch_clos_price"><?php echo _e('حذف فیلتر','jayto') ?></span>
                <span class="arch_submit_price subm"><?php echo _e('ثبت قیمت','jayto') ?></span>
            </div>
        </div>
    </div>
    <div class="people_num pinp">

        <div class="sboxes">
            <i class="fa-thin fa-door-closed fa-2x"></i>
            <input name="rp_input" class="rpn_input fillimp" type="text"
                placeholder="<?php echo _e('تعداد اتاق','jayto') ?>">
            <div class="show_rn_txt"></div>
        </div>
        <div class="pn_input_box filbox">
            <div class="pnib_top">
                <figure><i class="fa-thin fa-door-closed fa-2x"> </i></figure>
                <div class="pnib_title">
                    <span class="fz15 fw700"><?php echo _e('تعداد اتاق','jayto') ?></span>
                    <span class="no_matt_room fz12 fw300 col_gray"><?php echo _e('مهم نیست','jayto') ?></span>
                </div>
                <div class="add_min_box">
                    <button class="plus_but_filter">+</button>
                    <span class="rmp_val">0</span>
                    <button class="minus_but_filter">-</button>
                </div>
            </div>
            <span class="line"></span>
            <div class="pnib_bot">
                <span class="arch_room_arch_clos_num"><?php echo _e('حذف فیلتر','jayto') ?></span>
                <span class="arch_room_num_submit subm"><?php echo _e('ثبت تعداد اتاق','jayto') ?></span>
            </div>
        </div>
    </div>
    <script>
    new Vue({
        
        el: '.filter_date',
        components: {
            datePicker,

        }
   

    })
    </script>
    <?php


	}

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new residence_filter() );