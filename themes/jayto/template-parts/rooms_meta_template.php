<?php

global $post;
$pid       = $post->ID;
$last_room = get_post_meta( $pid, 'room_count', true );
if ( $last_room == '' ) {
	$last_room = 1;
} else {
	$last_room = $last_room + 1;
}
?>
<script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
<script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>

<?php
update_post_meta( $pid, 'room_count', $last_room );
$rinfo = get_post_meta( $pid, 'rooms_info', true );


if ( $rinfo ) {

	foreach ( $rinfo as $ky => $row ) {

		$mk               = 'hotel_calender' . $ky;
		$dates            = get_post_meta( $pid, $mk, true );
		$odprice          = 'hot_day_price' . $ky;
		$old_room_dprice  = get_post_meta( $pid, $odprice, true );
		$all_reserve_date = get_post_meta( $pid, 'hotel_reserves' . $ky, true );
		$tips_number      = $row['room_tip_number'];
       if (intval($tips_number) == '')
	       $tips_number = 1;
		?>


        <div class="rooms_inner " data-rnum="<?php echo $ky ?> ">
            <div class="del_room " data-info="<?php echo $ky . '-' . $pid ?>">
                <span class="dashicons dashicons-trash del_i"></span>
            </div>
            <div class="rooms_item_box">

                <label>نام اتاق</label>
                <input type="text" class="room_inp room_name" name="room_name" style="width: 66%" value="<?php echo $row['room_name'] ?>">
            </div>
            <div class="rooms_item_box">
                <label class="fz14">تعداد این تیپ اتاق </label>
                <input type="number" class="room_inp  r_tips_number" name="r_short_desc" style="width: 66%" value="<?php echo $tips_number ?>">
            </div>
            <div class="rooms_item_box">
                <label class="fz14">توضیح کوتاه درمورداتاق </label>
                <input type="text" class="room_inp  r_short_desc" name="r_short_desc" style="width: 66%" value="<?php echo $row['r_short_desc'] ?>">
            </div>
            <div class="rooms_item_box">
                <label>تعداد تخت </label>
                <input type="number" class="room_inp room_on_bed" name="room_on_bed" value="<?php echo $row['bed_count'] ?>">
            </div>
            <div class="rooms_item_box">
                <label>تعداد تخت یک نفره</label>
                <select type="number" class="room_inp room_single_bed" name="room_single_bed">
                    <option value="0" <?php if ( $row['room_single_bed'] == 0 )
						echo 'selected' ?> >0
                    </option>
                    <option value="1" <?php if ( $row['room_single_bed'] == 1 )
						echo 'selected' ?> >1
                    </option>
                    <option value="2" <?php if ( $row['room_single_bed'] == 2 )
						echo 'selected' ?> >2
                    </option>
                    <option value="3"<?php if ( $row['room_single_bed'] == 3 )
						echo 'selected' ?> >3
                    </option>
                    <option value="4"<?php if ( $row['room_single_bed'] == 4 )
						echo 'selected' ?> >4
                    </option>
                    <option value="5"<?php if ( $row['room_single_bed'] == 4 )
						echo 'selected' ?> >4
                    </option>
                    <option value="4"<?php if ( $row['room_single_bed'] == 5 )
						echo 'selected' ?> >5
                    </option>
                    <option value="6"<?php if ( $row['room_single_bed'] == 6 )
						echo 'selected' ?> >6
                    </option>
                    <option value="7"<?php if ( $row['room_single_bed'] == 7 )
						echo 'selected' ?> >7
                    </option>
                    <option value="8"<?php if ( $row['room_single_bed'] == 8 )
						echo 'selected' ?> >8
                    </option>
                    <option value="9"<?php if ( $row['room_single_bed'] == 9 )
						echo 'selected' ?> >9
                    </option>
                    <option value="10"<?php if ( $row['room_single_bed'] == 10 )
						echo 'selected' ?> >10
                    </option>
                </select>
            </div>
            <div class="rooms_item_box">
                <label>تعداد تخت دو نفره</label>
                <select type="number" class="room_inp room_Double_bed" name="room_Double_bed">
                    <option value="0"<?php if ( $row['room_Double_bed'] == 0 )
						echo 'selected' ?> >0
                    </option>
                    <option value="1"<?php if ( $row['room_Double_bed'] == 1 )
						echo 'selected' ?> >1
                    </option>
                    <option value="2"<?php if ( $row['room_Double_bed'] == 2 )
						echo 'selected' ?> >2
                    </option>
                    <option value="3"<?php if ( $row['room_Double_bed'] == 3 )
						echo 'selected' ?> >3
                    </option>
                    <option value="4"<?php if ( $row['room_Double_bed'] == 4 )
						echo 'selected' ?> >4
                    </option>
                    <option value="5"<?php if ( $row['room_Double_bed'] == 5 )
						echo 'selected' ?> >5
                    </option>
                    <option value="6"<?php if ( $row['room_Double_bed'] == 6 )
						echo 'selected' ?> >6
                    </option>
                    <option value="7"<?php if ( $row['room_Double_bed'] == 7 )
						echo 'selected' ?> >7
                    </option>
                    <option value="8"<?php if ( $row['room_Double_bed'] == 8 )
						echo 'selected' ?> >8
                    </option>
                    <option value="9"<?php if ( $row['room_Double_bed'] == 9 )
						echo 'selected' ?> >9
                    </option>
                    <option value="10"<?php if ( $row['room_Double_bed'] == 20 )
						echo 'selected' ?> >10
                    </option>

                </select>
            </div>

            <div class="rooms_item_box">
                <label>صبحانه</label>
                <input type="checkbox" class="room_inp room_breackfast" name="room_breackfast" <?php if ( $row['room_breackfast'] == 'on' ) {
					echo 'checked';
				} ?>>
                <label>نهار</label>
                <input type="checkbox" class="room_inp room_lunch" name="room_lunch" <?php if ( $row['room_lunch'] == 'on' ) {
					echo 'checked';
				} ?>>
                <label>شام</label>
                <input type="checkbox" class="room_inp room_Dinner" name="room_Dinner" <?php if ( $row['room_Dinner'] == 'on' ) {
					echo 'checked';
				} ?>>
            </div>
            <div class="rooms_item_box">
                <label>قیمت برای روزهای عادی (تومان)</label>
                <input type="number" class="room_inp room_normal_price" name="room_normal_price" value="<?php echo $row['room_normal_price'] ?>">
            </div>
            <div class="rooms_item_box">
                <label>قیمت برای روزهای آخر هفته (تومان)</label>
                <input type="number" class="room_inp room_endWeek_price" name="room_endWeek_price" value="<?php echo $row['room_endWeek_price'] ?>">
            </div>


            <div class="room_each_day_price<?php echo $ky ?> mbt10 ">
                <label>قیمت روزانه روی تقویم</label>
                <input type="text" value="" class="room_eday_date<?php echo $ky ?>" autocomplete="off">

                <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_eday_date<?php echo $ky ?>"></date-picker>
                <label>قیمت (تومان) &nbsp;<input type="number" class="room_edate_prices<?php echo $ky ?>" name="room_edate_prices<?php echo $ky ?>"></label>
                <span class=" rscs rodp_submit<?php echo $ky ?>">ذخیره</span>
            </div>
            <div class="room_dis_days<?php echo $ky ?> mbt10 rrds">
                <label>غیر فعال کردن تاریخ</label>
                <input type="text" value="" class="room_dis_date<?php echo $ky ?>" autocomplete="off">

                <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_dis_date<?php echo $ky ?>"></date-picker>
                <span class=" rscs roddis_submit<?php echo $ky ?>">ذخیره</span>
            </div>
            <div class="room_rev_days<?php echo $ky ?> mbt10 rrds">
                <label> فعال کردن تاریخ</label>
                <input type="text" value="" class="room_rev_date<?php echo $ky ?>" autocomplete="off">

                <date-picker value="" v-model="dates" multiple display-format="jYYYY-jMM-jDD" format="jYYYY-jMM-jDD" custom-input=".room_rev_date<?php echo $ky ?>"></date-picker>
                <span class=" rscs rorevd_submit<?php echo $ky ?>">ذخیره</span>
            </div>

            <div class="uploadersContainer">
                <div class="uploader">
                    <input type="file" class="file_input" accept="image/*" multiple>
                    <button class="upload_button">آپلود</button>
                    <div class="imageContainer">
						<?php

						if ( count( $row['urls'] ) > 0 ) {

							foreach ( $row['urls'] as $url ) { ?>
                                <div class="imageC_box">
                                    <img src="<?php echo home_url() . '/wp-content/uploads/' . $url ?>">
                                    <span class="room_gall_close dashicons dashicons-no-alt"></span>
                                </div>
							<?php }
						}
						?>
                    </div>
                </div>
            </div>
            <script>
                let app<?php echo $ky?> = new Vue({
                    el: '.room_each_day_price<?php echo $ky?>',
                    data: {
                        dates: '',

                    },

                    components: {
                        DatePicker: VuePersianDatetimePicker
                    }
                });
                let app1<?php echo $ky?> = new Vue({
                    el: '.room_dis_days<?php echo $ky?>',
                    data: {
                        dates: '',

                    },

                    components: {
                        DatePicker: VuePersianDatetimePicker
                    }
                });
                let app2<?php echo $ky?> = new Vue({
                    el: '.room_rev_days<?php echo $ky?>',
                    data: {
                        dates: '',

                    },

                    components: {
                        DatePicker: VuePersianDatetimePicker
                    }
                });
                jQuery('.rodp_submit<?php echo $ky?>').on('click', function (e) {
                    var $this = jQuery(this);
                    var parents = $this.parents('.room_each_day_price<?php echo $ky?>')
                    let dates = parents.find('.room_eday_date<?php echo $ky?>').val();
                    let price = parents.find('.room_edate_prices<?php echo $ky?>').val();

                    jQuery.ajax({
                        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                        type: "POST",
                        data: {action: "set_room_dprice", 'dates': dates, 'price': price, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                        beforeSend: function () {
                            jQuery('.rodp_submit<?php echo $ky?>').text('در حال ذخیره سازی')
                        },
                        success: function (f) {
                            jQuery('.rodp_submit<?php echo $ky?>').text('ذخیره')
                        }
                    })
                })
                jQuery('.roddis_submit<?php echo $ky?>').on('click', function (e) {
                    var $this = jQuery(this);
                    var parents = $this.parents('.room_dis_days<?php echo $ky?>')
                    let dates = parents.find('.room_dis_date<?php echo $ky?>').val();


                    jQuery.ajax({
                        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                        type: "POST",
                        data: {action: "custom_radd_room_reserve", 'dates': dates, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                        beforeSend: function () {
                            $this.text('در حال ذخیره سازی')
                        },
                        success: function (f) {
                            $this.text('ذخیره')
                        }
                    })
                })
                jQuery('.rorevd_submit<?php echo $ky?>').on('click', function (e) {
                    var $this = jQuery(this);
                    var parents = $this.parents('.room_rev_days<?php echo $ky?>')
                    let dates = parents.find('.room_rev_date<?php echo $ky?>').val();


                    jQuery.ajax({
                        url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                        type: "POST",
                        data: {action: "custom_rev_room_reserve", 'dates': dates, 'pid':<?php echo $pid?>, 'room_id':<?php echo $ky?>},
                        beforeSend: function () {
                            $this.text('در حال ذخیره سازی')
                        },
                        success: function (f) {
                            $this.text('ذخیره')
                        }
                    })
                })
            </script>
        </div>
	<?php }
}
?>

<hr>