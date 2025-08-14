
<?php


use Elementor\Scheme_Color;
use Elementor\Widget_Base;
use Elementor\Controls_Manager;


class tour_reserve_form extends \Elementor\Widget_Base {
	public function get_name() {
		return 'tour_reserve_form';
	}

	public function get_title() {
		return 'فرم رزرو تور';
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
			$tour_id = $_GET['poid'];
		} else {
			$tour_id = create_post_id();
		}
		$user_info = wp_get_current_user();

		if ( isset( $_GET['data'] ) ) {
			$info_exp = explode( '~', $_GET['data'] );
			$data     = [ 'tid' => $tour_id, 'date' => $info_exp[0], 'sans' => $info_exp[1] ];
			delete_user_meta( $user_info->ID, 'sans_session' );
			update_user_meta( $user_info->ID, 'sans_session', $data );
		}

		$input_sans = get_user_meta( $user_info->ID, 'sans_session', true );
		$tour_meta  = get_post_meta( $tour_id, 'all_tour_meta', true );
		$tour_var   = get_tour_var_by_tour_id( $tour_id );
		$price      = $tour_meta['tour_price'];
        if ($tour_meta['tour_shutter_price']){
	        $shutter_price      = $tour_meta['tour_shutter_price'];
        }else{
	        $shutter_price = 0;
        }

		$vi         = '';


		if ( $tour_var ) {
			foreach ( $tour_var as $var ) {

				if ( $var->base == 1 ) {
					$price = $var->price;

				}
				$vi = $var->id;
			}

		}

		if ( $input_sans ) {
			if ( $input_sans['date'] != '' ) {
				$date = change_date_month_word( $input_sans['date'] );
			} else {
				$date = 'تاریخ و ساعت انتخابی';
			}
			if ( $input_sans['sans'] != '' ) {
				$sans = $input_sans['sans'];
			} else {
				$sans = '';
			}

		}

		if ( $input_sans['date'] != '' ) {
			$type = 'general';
		} else {
			$type = 'private';
		}

		if ( ! isset ( $_GET['rt'] ) && $_GET['rt'] == 'pri') {
			$type = 'private';
		}
		?>
        <script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
        <script src="https://cdn.jsdelivr.net/npm/moment"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
        <script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
        <div class="tform_box d_flex height60">
            <figure><i class="fa-thin fa-calendar-day  ml_10"></i></figure>
            <div class="w80p">
                <p class="fz12 col_gray">تاریخ و ساعت :</p>
                <div class="chn_sans">
                <p class="fz13 mt_10"> <?php echo $date ?> - ساعت <?php echo $sans ?></p>
                </div>
            </div>



            <?php
            if (isset($_GET['rt'])){ ?>
                <div class="sans_box">

                    <label class="mr5 mbt10 fz11">تعیین سانس </label>
                    <input type="text" value="" class="csans" autocomplete="off">
                    <date-picker value=""  type="datetime" display-format="jYYYY-jMM-jDD/HH:mm" format="jYYYY-jMM-jDD" custom-input=".csans"></date-picker>
                    <span class="add_ssans_submit">ثبت </span>
                </div>
           <?php }
            ?>

<script>


    let app66 = new Vue({
        el: '.sans_box',
        data: {
            dates: '',
        },
        components: {
            DatePicker: VuePersianDatetimePicker
        }
    });
    jQuery('.add_ssans_submit').on('click', function (e) {
        let sans = jQuery('.csans').val();
        jQuery.ajax({
            url: "<?php echo admin_url('admin-ajax.php'); ?>",
            type: "POST",
            data: {
                action: "set_sans",
                sans: sans,
                pid: "<?php echo $_GET['poid']; ?>"
            },
            beforeSend: function () {
                jQuery('.add_ssans_submit').text('...');
            },
            success: function (response) {
                let result = jQuery.parseJSON(response);
                let data = result.split('/');

                let postData = {
                    tid: "<?php echo $_GET['poid']; ?>",
                    date: data[0],
                    sans: data[1]
                };

                jQuery.ajax({
                    url: "<?php echo admin_url('admin-ajax.php'); ?>",
                    type: "POST",
                    data: {
                        action: "ssans_set",
                        postData: postData
                    },
                    success: function (response) {
                        var data = response;

                        jQuery('.chn_sans').find('p').html('<p class="fz13 mt_10">'+ data[0]['date'] + '-' + data[0]['sans'] + '</p>');
                        jQuery('.add_ssans_submit').text('ذخیره');
                    }
                });
            }
        });
    });

</script>
        </div>
		<?php
		if ( $tour_var ) {
			echo "<div class='select_res'>";
			echo '<p class="fz13 fw700 col_gray">انتخاب اقامتگاه</p>';

			foreach ( $tour_var as $row ) { ?>

                <input type="checkbox" class="uexs" data-varid="<?php echo $row->id ?>" <?php if ( $row->base == 1 )
					echo 'checked="checked"' ?>>
                <label class="fz11"><?php echo $row->title ?></label>
			<?php }
			echo "</div>";

		}

		?>
        <?php

        if ($shutter_price or $shutter_price != 0){ ?>
	        <div class="tform_box d_flex height60">
            <figure><i class="fa-thin fa-bus  ml_10"></i></figure>
            <p class="fz12 col_gray">دربست کردن تور</p>
            <input type="checkbox" class="tour_shutter" data-varid="<?php echo $row->id ?>" >


        </div>
     <?php
        }
        ?>
        <div class="tform_box d_flex nump height60">
            <figure><i class="fa-thin fa-people  ml_10"></i></figure>
            <p class="fz12 col_gray">تعداد نفرات</p>
            <div class="pm_box w80p justc_end">

                <span class="plus_m imp_mp"><i class="fa fa-plus"></i></span>
                <input type="number" class="w40i bord_no base_capacity " data-maxc="<?php echo $tour_meta['tour_capacity'] ?>"
                       name="base_capacity" value="1">
                <span class="minus_m imp_mp"><i class="fa fa-minus"></i></span>
            </div>


        </div>
        <div class="pinfo_box ">
            <i class="fa-thin fa-address-card"></i>

            <span class="fz13 mr5">اطلاعات مسافر</span>
            <div class="tdb_date">

                <div class="pibox_dt height60">

                    <input type="text" name="psi_name" class="psi_name height35" placeholder="نام">
                    <input type="text" name="psi_lastname" class="psi_lastname height35" placeholder="نام خانوادگی">
                    <input type="text" disabled name="psi_phone" value="<?php echo $user_info->user_login ?>"
                           class="psi_phone height35" placeholder="شماره همراه">

                </div>

            </div>


        </div>
        <span class="line_dash_2">
        <div class="d_flex jcspcbt mbt20 height60 ">
        <p><span> قیمت: </span><span class="topri"><?php echo $price ?><span> تومان </span></p>
        <?php
        if ( ! is_user_logged_in() ) { ?>
            <span class="non_log_submit fz14">درخواست رزرو</span>

        <?php } else { ?>
            <span class="tres_send fz14">درخواست رزرو</span>
        <?php }
        ?>

    </div>

    <script>
    var pri = <?php  echo $price ?>;
    <?php
    if($vi){?>
    var vid = <?php  echo $vi ?>;
    <?php  }
    ?>
    jQuery(document).on('click', '.uexs', function () {
        let $this = jQuery(this)
        jQuery('.uexs').removeClass('active')
        jQuery('.uexs').not(this).prop('checked', false);
        $this.addClass('active');
        vid = $this.data('varid')
        if (vid !== null) {
            jQuery.ajax({
                url: ajax_data.aju,
                type: "POST",
                data: {
                    action: "get_var_price",
                    data: vid
                },
                beforeSend: function () {
                },
                success: function (f) {
                    pri = f
                    jQuery('.topri').html(f + ' <span> تومان </span>')
                    jQuery('.base_capacity').val(1)
                }

            })
        }
    });
    jQuery(document).ready(function() {
        jQuery('.tour_shutter').change(function() {
            if (jQuery(this).is(':checked')) {

               jQuery('.select_res').fadeOut()
               jQuery('.nump').fadeOut()
                jQuery('.topri').html(<?php  echo $shutter_price  ?> + ' <span> تومان </span>')
            } else {

                jQuery('.select_res').fadeIn()
                jQuery('.nump').fadeIn()
            }
        });
    });

    jQuery(document).on('click', '.plus_m', function () {

        let $this = jQuery(this);
        let parents = $this.parents('.pm_box');
        let elem = parents.find('input');
        let input_val = elem.val();
        var max_cap = elem.data('maxc');
        var price = pri;
        if (input_val < max_cap) {
            var new_num = Number(input_val) + 1
            elem.val(new_num);
            jQuery('.topri').text(price * new_num + ' تومان ')
        }
    })
    jQuery(document).on('click', '.minus_m', function () {
        let $this = jQuery(this);
        let parents = $this.parents('.pm_box');
        let elem = parents.find('input');
        let input_val = elem.val();
        let price = pri;
        if (Number(input_val > 1)) {
            var new_num = Number(input_val) - 1
            elem.val(new_num)
            jQuery('.topri').text(price * new_num + ' تومان ')
        }
    })
    jQuery(document).on('click', '.tres_send', function () {
        var shp = 'nok'
        if (jQuery('.tour_shutter').is(':checked')) {

       shp = 'ok'
        }
      <?php
      if(isset($_GET['rt'])  ){
          $type = 'private';

      }
      ?>

        let $this = jQuery(this);
        let uid = <?php  echo $user_info->ID ?>;
	    <?php
	    if ($vi){ ?>
        let varid = vid;
	    <?php    }
	    ?>
        let tour_id = <?php  echo $tour_id ?>;
        let date_request = '<?php  echo jdate( 'Y-m-d H:s', time(), '', '', 'en' )?>'
        var request_type = '<?php echo $type ?>';
        var tour_date = '<?php   echo $input_sans['date']    ?>';
        var sans = '<?php   echo $input_sans['sans']  ?>'
        var people_number = jQuery('.base_capacity').val();
        let order_status = 1
        var price = 0
        var price_each = pri;


        if (shp === 'ok'){
             price =<?php  echo $shutter_price ?>;
            request_type =   'private_shutter'
        }else {
            price = people_number * price_each;

        }

        var pay_status = 0;
        let passenger_phone = jQuery('.psi_phone').val()
        let passenger_name = jQuery('.psi_name').val()
        let passenger_lastname = jQuery('.psi_lastname').val()
        if (passenger_name.length === 0) {
            jQuery('.psi_name').css({
                'border-color': 'red'
            })
        } else {
            jQuery('.psi_name').css({
                'border-color': '#ddd'
            })
        }
        if (passenger_lastname.length === 0) {
            jQuery('.psi_lastname').css({
                'border-color': 'red'
            })
        } else {
            jQuery('.psi_lastname').css({
                'border-color': '#ddd'
            })
        }

        if (passenger_name.length !== 0 && passenger_lastname.length !== 0) {

            jQuery.ajax({
                url: ajax_data.aju,
                type: "POST",
                data: {
                    action: "tour_send_order_save",
                    'uid': uid,
                    'tour_id': tour_id,
                    'date_request': date_request,
                    'request_type': request_type,
                    'tour_date': tour_date,
                    'sans': sans,
                    'people_number': people_number,
                    'order_ststus': order_status,
                    'price': price,
                    'pay_status': pay_status,
                    'passenger_phone': passenger_phone,
                    'passenger_name': passenger_name,
                    'passenger_lastname': passenger_lastname,
				    <?php
				    if ($vi){ ?>
                    'varid': varid
				    <?php    }
				    ?>

                },

                beforeSend: function () {


                },
                success: function (response) {
                    let url = ajax_data.turl + '/experiences'
                    jQuery(location).attr('href', url);
                    jQuery('.no_item').css({
                        'display': 'none'
                    })
                    jQuery('.room_item_box_prbox').append(response)
                }

            })
        }

    })
    </script>
	<?php }

	protected function content_template() {

	}
}


\Elementor\Plugin::instance()->widgets_manager->register( new tour_reserve_form() );