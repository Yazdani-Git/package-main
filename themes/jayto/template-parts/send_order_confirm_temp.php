<?php
$active       = 'active';
$order_status = 0;
$timer        = 0;
$oid          = '';
$res_link     = get_the_permalink( $res_id );
 $user_id      = get_current_user_id();
$user_wallet  = get_user_meta( $user_id, 'jayto-wallet', false );
$bank_rinfo   = get_option( 'bareqinf' );

$bank_name = $bank_rinfo['bank_name'];
$pay_type  = get_option( 'pays_type' );

$bank_pay  = '';
$cart_pay  = '';
$cash_pay  = '';
if ( in_array( 'bank_pay', $pay_type ) ) {
	$bank_pay = 'ok';
}
if ( in_array( 'cart_pay', $pay_type ) ) {
	$cart_pay = 'ok';
}
if ( in_array( 'cash_pay', $pay_type ) ) {
	$cash_pay = 'ok';
}

//delete_post_meta($res_id, 'resistance_reserves' );
if (!$order_check ) {

	insert_order_table_confirm( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'],  $prices,4, $discount );
	$order_info = order_exist_check( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'], $user_id );
	$oid        = $order_info['id'];
	$timer      = calc_reserve_timer( $order_info['start_timer'] );
	if ( $timer > 0 ) {
		set_reserve_date( $_GET['res_id'], $_GET['check_in'], $_GET['checkout'] );

	}

} else {

	if ( $order_check['order_status'] != 4 && $order_check['order_status'] != 10 && $order_check['order_status'] != 5 && $order_check['order_status'] != 1 && $order_check['order_status'] != 10 && $order_check['order_status'] != 11 && $order_check['order_status'] != 12 ) {

		insert_order_table_confirm( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'],  $prices,4, $discount );
		$order_info = order_exist_check2( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'], $user_id, 4 );
		$oid        = $order_info['id'];
		$timer      = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_reserve_date( $_GET['res_id'], $_GET['check_in'], $_GET['checkout'] );

		}

	} elseif ( $order_check['order_status'] == 4 ) {

		$order_info = order_exist_check2( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'], $user_id, 4 );
		$oid        = $order_info['id'];

		$timer = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_reserve_date( $_GET['res_id'], $_GET['check_in'], $_GET['checkout'] );

		}
	}elseif ( $order_check['order_status'] == 5 ) {


		 $oid        = $order_check['id'];
        global $wpdb;
	$table_name   = $wpdb->prefix . 'jayto_orders';

	$wpdb->update( $table_name, array(
			'order_status' => 4,
			'start_timer'     =>time() ,


		), array( 'id' => $order_check['id'] ), array(
			'%d',
			'%d',



		), array( '%d' ) );
    	$order_info = order_exist_check2( $_GET['check_in'], $_GET['checkout'], $_GET['res_id'], $_GET['pass_num'], $user_id, 4 );

		$timer = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_reserve_date( $_GET['res_id'], $_GET['check_in'], $_GET['checkout'] );

		}
	}

	if ( $timer <= 0 ) {
		?>
        <script>
            if (document.addEventListener) document.addEventListener("visibilitychange", visibilityChanged);
            jQuery.ajax({
                url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                type: "POST",
                data: {action: "remove_reserve_date", 'res_id':<?php echo $res_id?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetween_date( $_GET['check_in'], $_GET['checkout'] ) ) . '"]' ?>},
                beforeSend: function () {
                    window.location.href = '<?php echo $res_link ?>'
                },
                success: function (data) {

                }
            })
        </script>
	<?php }
}
?>
    <form action="<?php echo get_template_directory_uri() . '/payment/' . $bank_name . '/request-order.php' ?>" name="order_pay_submit" class="order_pay_submit" method="post">

        <div class="request_page">

            <div class="calc_info_box">
                <div class="request_page_calc_price">
                    <div class="rqpc_image_box">
                        <img src="<?php echo $img_url[0] ?>" alt="">
                        <span class="rqpc_title"><?php echo $post->post_title ?></span>
                    </div>
                    <span class="line90"></span>
                    <p class="rpc_head">جزئیات پرداخت</p>

                    <div class="res_factor">
                        <div class="each_night">

							<?php
							foreach ( $pri['count_value'] as $key => $row ) {
								?>
                                <div class="res_factor_item">
                                    <div><span><?php echo $row ?></span><span class="space_2x">شب</span><span><?php echo $key ?></span><span class="space_5x">x</span></div>
                                    <div><span><?php echo $key * $row ?></span><span class="space_2x">تومان</span></div>
                                </div>
							<?php }
							?>


                        </div>
						<?php
						if ( $pri ['add_people_num'] > 0 ) {
                         
					 	$passenger_number_base_r = $_GET['pass_num'];
						$extra_passenger_r       = intval($passenger_number_base_r ) - intval($all_res_info['base_capacity']);

							?>
                            <div class="res_factor_add_people">
                                <div class="res_factor_ap"><span> <?php echo $extra_passenger_r  ?> نفر مهمان اضافه</span> <span><?php echo $extra_passenger_r * $all_res_info['extra_person'] ?> تومان</span></div>
                            </div>

						<?php }
						?>
						   <?php
                         if ($in_discount == 'true'){
                           $total_discount = $prices * $discount_ifo['perscent_discount'] /100 ;
                            $total_price_discount = $prices- $total_discount;

                             ?>
                             <div class="res_factor_add_people">
                                <div class="res_factor_ap"><span>  تخفیف</span> <span><?php  echo  number_format($dis_price)  ?>  تومان </span></div>
                            </div>
                       <?php  }
                       ?>
                    </div>


                            <div class="res_factor_total">
                        <div class="rft_box">
                            <div class="rft_box"><span>جمع مبلغ اقامت</span> <span><?php
                            if ($discount){
                                echo $discount;
                            }else{
                                echo $prices;
                            }
                            ?> تومان<span></span></span></div>
                        </div>

                    </div>

                    <div class="reserve_submit_box">
						<?php
						if ( $timer > 0 ) {
							?>
							<?Php

							$amount =$prices;
                           
							if ( $user_wallet[0]  >= $amount && $amount != 0  ) {
								?>
                                <span class="wallet_pay">پرداخت از کیف پول</span>


							<?php }
							?>
							<?php
							if ( $bank_pay == 'ok' ) { ?>
                                <input type="hidden" class="dataoi" name="dataoi" value="<?php echo $oid ?>">

                                       <input type="hidden" class="up_wallet_amount" name="up_wallet_amount" value="<?php
                            if ($discount){
                                echo $discount;
                            }else{
                                echo $prices;
                            }
                            ?>">


                                <button type="submit" class="order_pay_submit_but">پرداخت از درگاه بانکی</button>
							<?php }


                       ?>
                    </form>
                    <?php

                    	if ( $cash_pay == 'ok' ) { ?>
                                <form action="<?php echo home_url() . '/cash_pay' ?>" name="order_cash_pay_submit" class="order_cash_pay_submit" method="post"><input type="hidden" name="dataoi" value="<?php echo $oid ?>"  >
                                    <button type="submit" class="order_cash_pay_submit_but">پرداخت نقدی</button>
                                </form>
							<?php } ?>
                        <?php
							if ( $cart_pay == 'ok' ) { ?>
                                <form action="<?php echo home_url() . '/cart_pay' ?>" name="order_cart_pay_submit" class="order_cart_pay_submit" method="post">  <input type="hidden" name="dataoi" value="<?php echo $oid ?>">
                                    <button type="submit" class="order_cart_pay_submit_but">پرداخت کارت به کارت</button>
                                </form>
							<?php }
							?>


						<?php }
						?>
                    </div>

                      <span class="fz12 mbt10 view_low_pay com_cansel">مشاهده قوانین لغو رزرو</span>
                       <label class="agr_low">
                         قوانین و شرایط را خوانده و موافقم.

                      <input type="checkbox" id="agree_check">
                        </label>
                </div>
            </div>
            <div class="rp_info">
                <div class="confirmation_box">
                    <div class="conf_submit_box">
                        <div class="con_sub-box active">
                            <i class="fa fa-dot-circle"></i>
                        </div>

                        <span class="conf_sub_tit">ثبت درخواست</span>


                    </div>
                    <div class="conf_submit_box ">
                        <div class="con_sub-box <?php echo $active ?>">
                            <span class="conf_line  <?php echo $active ?>"></span>
                            <i class="fa fa-dot-circle"></i>

                        </div>
                        <p class="conf_sub_tit">تایید میزبان</p>


                    </div>
                    <div class="conf_submit_box  ">
                        <div class="con_sub-box <?php echo $active ?>">
                            <span class="conf_line  <?php echo $active ?>"></span>
                            <i class="fa fa-dot-circle "></i>

                        </div>
                        <p class="conf_sub_tit">پرداخت</p>


                    </div>

                </div>
                <div class="order_pay_timer_box">
                    <i class="fa fa-clock-o"></i>
                    <h4>در انتظار پرداخت</h4>
                    <p>میزبان شما درخواست رزرو شما را تایید کرد.با توجه به مهلت پرداخت و امکان از دست دادن رزرو هم اکنون پرداخت نمایید.</p>
                    <span class="mt_20 fz11 fw300">مهلت پرداخت</span>
                    <div class="order_pay_timer"></div>
                </div>
                <span class="line_dash90"></span>
                <div class="trip_date_box ">
                   <i class="fa-light fa-calendar"></i>
                    <div class="tdb_date">

                        <div class="tbd_dt">
                            <span class="tdb_title fz13">تاریخ سفر</span>
							<?php
							$alt_date = change_date_to_alt( $_GET['check_in'], $_GET['checkout'] );
							?>
                            <p class="fz13 fw700"><?php echo $alt_date['check_in'] ?> تا <?php echo $alt_date['checkout'] ?></p>
                        </div>

                    </div>

                </div>
                <div class="trip_date_box">
                   <i class="fa-light fa-users"></i>
                    <div class="tdb_date">
						<?php
                       
						$passenger_number_base = $_GET['pass_num'];
						$extra_passenger       = intval($_GET['pass_num']) - intval($all_res_info['base_capacity']);
						if ( $passenger_number_base > $all_res_info['base_capacity'] ) {
							$passenger_number_base = $all_res_info['base_capacity'];
							$add_passenger_title   = '+&nbsp' . $extra_passenger . ' &nbspنفر  اضافه ';
						}


						?>
                        <div class="tbd_dt">
                            <span class="tdb_title fz13">تعداد مسافران</span>
                            <p class="fz13 fw700"><?php echo $passenger_number_base ?> نفر &nbsp;<?php echo $add_passenger_title ?>  </p>
                        </div>
						<?php
						if ( $res_type != 0 ) {

							?>
                            <button class="edit_date_buton">ویرایش</button>
						<?php }
						?>
                    </div>

                </div>
                <div class="passenger_info_box">
                   <i class="fa-light fa-memo-circle-info"></i>
                    <span class="tdb_title mr5 fz13">اطلاعات مسافر</span>
                    <div class="tdb_date">

                        <div class="pibox_dt">

                            <input type="text" name="psi_name" class="psi_name" placeholder="نام">
                            <input type="text" name="psi_lastname" class="psi_lastname" placeholder="نام خانوادگی">
                            <input type="number" name="psi_phone" class="psi_phone" placeholder="شماره همراه">

                        </div>

                    </div>
                    <p class="fz13">نام و نام خانوادگی خود را دقیقا مطابق کارت شناسایی وارد کنید</p>
                </div>
<!--                <span class="line_dash90 mt_10"></span>-->
            </div>

        </div>
    </form>
    <?php

	$meta    = get_post_meta(  $res_id, '_all_res_meta', false );
     $easy_cancel = get_option( 'easy_cancel' );
		$cancel_type = $meta[0]['cancel_type'];
        if ( $cancel_type == 'easy' ) {

				$one_day = 100 - $easy_cancel['easy_one_day_before_recive'];
				?>

                <div class="cancel_reserv_box">
                    <div class="crb_head">
                        <h4> قوانین لغو رزرو</h4>
                        <span class="cancel_box_close"><i class="fa fa-close"></i></span>
                    </div>
                    <p class="cbz-t rldesc"> &nbsp <?php echo _e( 'از لحظه رزرو تا 1 روز قبل از تاریخ ورود', 'jayto' ) ?>&nbsp;<?php echo $one_day ?> درصد مبلغ رزرو بازگشت داده می‌شود.</p>

                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_green"></span>
                            <span class="lbef_l bg_green"></span>
                            <span class="lbef_b bg_green"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10 "><?php echo _e( '1 روز قبل از ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz11"><?php echo 100 - $one_day ?>   درصد مبلغ رزرو کسر میگردد. </span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_orang"></span>
                            <span class="lbef_l bg_orang"></span>
                            <span class="lbef_b bg_orang"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'تا روز ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz11"><?php echo $easy_cancel['easy_before_recive'] ?>٪ مبلغ شب اول کسر میگردد  </span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_red"></span>
                            <span class="lbef_l bg_red"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'از روز ورود تا خروج مهمان', 'jayto' ) ?></span>
                            <span class="fz11"><?php echo $easy_cancel['easy_after_recive1'] ?>٪ <?php echo _e( ' مبلغ شب‌های سپری شده', 'jayto' ) ?> + <?php echo $easy_cancel['easy_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده کسر میگردد</span>
                        </div>
                    </div>
                </div>
			<?php } elseif ( $cancel_type == 'medium' ) {
				$medium_cancel = get_option( 'medium_cancel' ); ?>


                <div class="cancel_reserv_box">
                    <div class="crb_head">
                        <h4> قوانین لغو رزرو</h4>
                        <span class="cancel_box_close"><i class="fa fa-close"></i></span>
                    </div>

                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_green"></span>
                            <span class="lbef_l bg_green"></span>
                            <span class="lbef_b bg_green"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10 "><?php echo _e( '2 روز قبل از ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz13"> <?php echo $medium_cancel['medium_2day_before_recive'] ?>   درصد مبلغ رزرو کسر خواهد شد</span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_orang"></span>
                            <span class="lbef_l bg_orang"></span>
                            <span class="lbef_b bg_orang"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'تا روز ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz13"><?php echo $medium_cancel['medium_before_recive'] ?>٪<?php echo _e( ' مبلغ شب اول کسر میگردد', 'jayto' ) ?>  </span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_red"></span>
                            <span class="lbef_l bg_red"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'از روز ورود تا خروج مهمان', 'jayto' ) ?></span>
                            <span class="fz13"><?php echo $medium_cancel['medium_after_recive1'] ?>٪ <?php echo _e( 'مبلغ شب‌های سپری شده', 'jayto' ) ?> + <?php echo $medium_cancel['medium_after_recive2'] ?> ٪ مبلغ شبهای باقیمانده کسر میگردد</span>
                        </div>
                    </div>
                </div>
			<?php } elseif ( $cancel_type == 'hard' ) {
				$hard_cancel = get_option( 'hard_cancel' );

				?>
                <p class="rldesc"><?php echo _e( 'از لحظه رزرو تا ۴ روز قبل از تاریخ ورود', 'jayto' ) ?> <?php echo $hard_cancel['hard_before_4day_recivee'] ?>٪ <?php echo _e( 'مبلغ شب اول ', 'jayto' ) ?> <?php echo $hard_cancel['hard_4day_before_recive2'] ?> + ٪ مبلغ شب‌های باقیمانده کسر
                    می‌گردد.</p>

                <div class="cancel_reserv_box">
                    <div class="crb_head">
                        <h4> <?php echo _e( 'قوانین لغو رزرو', 'jayto' ) ?></h4>
                        <span class="cancel_box_close"><i class="fa fa-close"></i></span>
                    </div>

                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_green"></span>
                            <span class="lbef_l bg_green"></span>
                            <span class="lbef_b bg_green"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10 "><?php echo _e( '4 روز قبل از ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz13"><?php echo $hard_cancel['hard_before_4day_recivee'] ?>٪ <?php echo _e( 'مبلغ شب اول', 'jayto' ) ?> + <?php echo $hard_cancel['hard_4day_before_recive2'] ?>٪ <?php echo _e( 'مبلغ شب های باقیمانده کسر میگردد', 'jayto' ) ?></span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_orang"></span>
                            <span class="lbef_l bg_orang"></span>
                            <span class="lbef_b bg_orang"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'تا روز ورود مهمان', 'jayto' ) ?></span>
                            <span class="fz13"><?php echo $hard_cancel['hard_before_recive1'] ?>٪ <?php echo _e( 'مبلغ شب اول', 'jayto' ) ?> + <?php echo $hard_cancel['hard_before_recive2'] ?>٪ <?php echo _e( 'مبلغ شب های باقیمانده کسر میگردد', 'jayto' ) ?></span>
                        </div>
                    </div>
                    <div class="cbc_item">
                        <div class="cbc_i ">
                            <span class="cbc_ic border_red"></span>
                            <span class="lbef_l bg_red"></span>
                        </div>
                        <div class="cbc_c">
                            <span class="mbt10"><?php echo _e( 'از روز ورود تا خروج مهمان', 'jayto' ) ?></span>
                            <span class="fz13"><?php echo $hard_cancel['hard_after_recive1'] ?>٪ <?php echo _e( 'مبلغ شب‌های سپری شده', 'jayto' ) ?> + <?php echo $hard_cancel['hard_after_recive2'] ?>٪ <?php echo _e( 'مبلغ شب های باقی مانده کسر میگردد', 'jayto' ) ?></span>
                        </div>
                    </div>
                </div>
			<?php }



$timer      = calc_reserve_timer_submit( $order_info['start_timer'] );
?>
    <script>

        jQuery('.order_pay_timer').backward_timer({
            seconds: <?php echo $timer ?>
            , format: ' m% : s%  ',
            on_exhausted: function (timer) {


                jQuery.ajax({
                    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                    type: "POST",
                    data: {action: "remove_reserve_date", 'oid':<?php echo $oid?> , 'res_id':<?php echo $res_id?>, 'date':<?php  echo '["' . implode( '", "', get_beetween_date( $_GET['check_in'], $_GET['checkout'] ) ) . '"]' ?>},
                    beforeSend: function () {
                    },
                    success: function (data) {
                        window.location.href = '<?php echo $res_link ?>'
                    }
                })


            }
        })
        jQuery('.order_pay_timer').backward_timer('start')

    </script>

<?php

