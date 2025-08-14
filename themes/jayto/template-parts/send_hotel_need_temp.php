<?php
 $active              = '';
$order_status        = 0;
$timer               = 0;
$oid                 = '';
$res_link            = get_the_permalink( $hotel_id );
$user_id             = get_current_user_id();
 $user_wallet         = get_user_meta( $user_id, 'jayto-wallet', false );

$bank_rinfo          = get_option( 'bareqinf' );
$answer_request_time = get_option( 'answer_request_time' );
$bank_name           = $bank_rinfo['bank_name'];
$pay_type       = get_option( 'pays_type' );
$bank_pay='';
$cart_pay='';
$cash_pay='';
if (in_array('bank_pay',$pay_type)){
	$bank_pay = 'ok';
}
if (in_array('cart_pay',$pay_type)){
	$cart_pay = 'ok';
}
if (in_array('cash_pay',$pay_type)){
	$cash_pay = 'ok';
}
$pay_price = $_GET['pci'];
$prs=$_GET['pci'];
if ($in_discount=='true'){
 	$dis_price=$_GET['pci']-($_GET['pci']*$discount_ifo['perscent_discount']/100);
}else{
	$dis_price=0;
}
if ($in_discount=='true'){
	$pay_price=$dis_price;
}

//delete_post_meta($res_id, 'resistance_reserves' );
if ( ! $order_check ) {

	insert_hotel_order_table( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['pci'], $_GET['adult_num'], $_GET['child'], $user_id,1, $dis_price );
	$order_info = order_room_exist_check( $_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'1' );
	$oid        = $order_info['id'];
	$timer      = calc_reserve_timer( $order_info['start_timer'] );

	if ( $timer > 0 ) {
		set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );

	}
	$hoster        = get_post_field( 'post_author', $_GET['$hotel_id'] );
	$hoster_name   = get_user_by( 'id', $hoster );
	$mobile_number = $hoster_name->user_login;
	$txt           = $order_info['id'];
	$body_id       = sms_host_need;
	require get_template_directory() . '/sms/' . sms_samaneh_name . '.php';
	send_sms_func( $txt, sms_host_need, modir_phone );
} else {

	if ( $order_check['order_status'] != 1 && $order_check['order_status'] != 10 && $order_check['order_status'] != 5 && $order_check['order_status'] != 4 && $order_check['order_status'] != 3 &&$order_check['order_status'] !=12 &&$order_check['order_status'] !=11 ) {

		insert_hotel_order_table( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['pci'], $_GET['adult_num'], $_GET['child'], $user_id,1, $dis_price );
		$order_info = order_room_exist_check( $_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'4' );
		$oid        = $order_info['id'];
		$timer      = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );
		}
		$hoster        = get_post_field( 'post_author', $_GET['hotel_id'] );
		$hoster_name   = get_user_by( 'id', $hoster );
		$mobile_number = $hoster_name->user_login;
		$txt           = $order_info['id'];

	} elseif ( $order_check['order_status'] == 4 ) {

		$order_info = order_room_exist_check($_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'4');
       $oid         = $order_info['id'];
		$timer  = calc_reserve_timer_submit( $order_info['start_timer'] );
		$active = 'active';
	} elseif ( $order_check['order_status'] == 1 ) {

		$order_info = order_room_exist_check( $_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'1' );
		$oid        = $order_info['id'];
 	$timer      = calc_reserve_timer( $order_info['start_timer'] );

	} elseif ( $order_check['order_status'] == 3 ) {
		$order_info = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['pci'], $_GET['adult_num'], $_GET['child'], $user_id, 3 );

		$oid   = $order_info['id'];
		$timer = calc_reserve_timer( $order_info['start_timer'] );

	}elseif ( $order_check['order_status'] == 5 ) {


		$oid        = $order_check['id'];
		global $wpdb;
		$table_name   = $wpdb->prefix . 'jayto_hotel_orders';

		$wpdb->update( $table_name, array(
			'order_status' => 1,
			'start_timer'     =>time() ,


		), array( 'id' => $order_check['id'] ), array(
			'%d',
			'%d',



		), array( '%d' ) );
		$order_info =  order_room_exist_check( $_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'4' );

		$timer = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );

		}
	}
	$pay_price=filter_var( $order_info['price'], FILTER_SANITIZE_NUMBER_INT );;
	if ($in_discount == 'true'){

		$pay_price=$dis_price;
	}


	if ( $timer <= 0 ) {
		?>
        <script>

            jQuery.ajax({
                url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                type: "POST",
                data: {action: "remove_hotel_reserve_date", 'res_id':<?php echo $hotel_id?>, 'room_id':<?php echo $_GET['roid']?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetweens_date( $_GET['check_in'], $_GET['check_out'] ) ) . '"]' ?>},

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
        <form action="<?php echo get_template_directory_uri() . '/payment/' . $bank_name . '/request-order.php?pt=hotel' ?>" name="order_pay_submit" class="order_pay_submit" method="post">

        <div class="request_page">

            <div class="calc_info_box">
                <div class="request_page_calc_price">
                    <div class="rqpc_image_box">
						<?php echo $image_thumb ?>
                        <p class="dfdc"><span class="rqpc_title"><?php echo $post->post_title ?></span><span class="rqpc_title"><?php echo $this_room['room_name'] ?></span></p>

                    </div>
                    <span class="line90"></span>
                    <p class="rpc_head">جزئیات پرداخت</p>
                    <div class="res_factor">
                        <div class="each_night">


                            <div class="res_factor_item">
                                <?php
                                if ($in_discount == 'true'){  ?>
                                    <div><span><?php echo sizeof( $beet_date ) ?></span><span class="space_2x">شب</span><span><?php echo number_format( $dis_price / sizeof( $beet_date ) ) ?></span><span class="space_5x">x</span></div>

                                <?php  }else{ ?>
                                    <div><span><?php echo sizeof( $beet_date ) ?></span><span class="space_2x">شب</span><span><?php echo number_format( $order_info['price'] / sizeof( $beet_date ) ) ?></span><span class="space_5x">x</span></div>

                                <?php }
                                ?>

                            </div>


                        </div>

                    </div>
                    <span class="line90"></span>
	                <?php
	                if ($in_discount == 'true'){

		                $price_discount = $_GET['pci']*$discount_ifo['perscent_discount']/100;

		                ?>
                        <div class="res_factor_add_people">
                            <div class="res_factor_ap"><span> قیمت</span> <span><?php  echo  number_format($prs)  ?>  تومان </span></div>
                        </div>
                        <div class="res_factor_add_people">
                            <div class="res_factor_ap"><span>  تخفیف</span> <span><?php  echo  number_format($price_discount)  ?>  تومان </span></div>
                        </div>

	                <?php  }
	                ?>
                    <div class="res_factor_total">
                        <div class="rft_box">
	                        <?php
	                        if ($in_discount == 'true'){   ?>

                                <div class="rft_box"><span>جمع مبلغ اقامت</span> <span><?php echo number_format( $dis_price ) ?> تومان<span></span></span></div>
	                        <?php  }else{ ?>
                                <div class="rft_box"><span>جمع مبلغ اقامت</span> <span><?php echo number_format( $order_info['price'] ) ?> تومان<span></span></span></div>

	                        <?php }
	                        ?>                        </div>
                    </div>
                    <div class="reserve_submit_box">
						<?php
						if ( $order_info['order_status'] == 4 && $bank_pay == 'ok' && $timer > 0) {
							?>
                            <form action="<?php echo get_template_directory_uri() . '/payment/' . $bank_name . '/request-order.php?pt=hotel' ?>" name="order_pay_submit" class="order_pay_submit" method="post"> <?Php $amount = $pay_price; ?><input type="hidden"
                                <input type="hidden" class="dataoi" name="dataoi" value="<?php echo $order_info['id'] ?>">
                                <input type="hidden" class="up_wallet_amount" name="up_wallet_amount" value="<?php echo $pay_price ?>">
                                <button type="submit" class="order_pay_submit_but">پرداخت</button>

                            </form>'
						<?php }
						?>

                    </div>

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
                    <div class="optbi">
                        <i class="fa fa-clock-o"></i>
                    </div>

					<?php
					if ( $order_info['order_status'] == 4 ) {
						?>
                        <h4>در انتظار پرداخت</h4>
                        <p>میزبان شما درخواست رزرو شما را تایید کرد.با توجه به مهلت پرداخت و امکان از دست دادن رزرو هم اکنون پرداخت نمایید.</p>
					<?php } elseif ( $order_info['order_status'] == 1 ) {
						?>
                        <h4>در انتظار تایید میزبان</h4>
                        <p>درخواست شما برای میزبان ارسال شده و در انتظار تایید میزبان میباشد.در صورت تایید میزبان میتوانید رزرو خود را قطعی کنید.</p>

					<?php }
					?>
                    <div class="pay_time_box">

                        <div class="pay_tboxi">
                            <span class="mt_20 fz11 fw300">مهلت پرداخت</span>
                            <div class="order_pay_timer"></div>
                        </div>
                    </div>
                </div>
                <span class="line_dash90"></span>
                <div class="trip_date_box ">
                    <i class="fa fa-calendar"></i>
                    <div class="tdb_date">

                        <div class="tbd_dt">
                            <span class="tdb_title">تاریخ سفر</span>
							<?php
							$alt_date = change_slash_date_to_alt( $_GET['check_in'], $_GET['check_out'] );

							?>
                            <p class="fz13 fw700"><?php echo $alt_date['check_in'] ?> تا <?php echo $alt_date['checkout'] ?></p>
                        </div>

                    </div>

                </div>
                <div class="trip_date_box">
                    <i class="fa fa-user"></i>
                    <div class="tdb_date">

                        <div class="tdb_date">

                            <div class="tbd_dt">
                                <span class="tdb_title">تعداد مسافران</span>
                                <!--                            <p class="fz13 fw700">--><?php //echo $passenger_number_base ?><!-- نفر &nbsp;--><?php //echo $add_passenger_title ?><!--  </p>-->
                            </div>

                        </div>


                    </div>

                </div>
                <div class="passenger_info_box">
                    <i class="fa fa-address-card"></i>
                    <span class="tdb_title mr5">اطلاعات مسافر</span>
                    <div class="tdb_date">

                        <div class="pibox_dt">

                            <input type="text" name="psi_name" class="psi_name" placeholder="نام">
                            <input type="text" name="psi_lastname" class="psi_lastname" placeholder="نام خانوادگی">
                            <input type="number" name="psi_phone" class="psi_phone" placeholder="شماره همراه">


                        </div>

                    </div>
                    <p>نام و نام خانوادگی خود را دقیقا مطابق کارت شناسایی وارد کنید</p>
                </div>

            </div>
			<?php
			$resend_link = get_post_permalink( $hotel_id )
			?>
        </div>
    </form>
<?php

$cancel = 0;
?>
    <script>

        jQuery('.order_pay_timer').backward_timer({
            seconds: <?php echo $timer?>
            , format: ' m% : s%  ',
            on_exhausted: function (timer) {

                jQuery.ajax({
                    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                    type: "POST",
                    data: {action: "remove_hotel_reserve_date", 'res_id':<?php echo $hotel_id?>, 'room_id':<?php echo $_GET['roid']?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetweens_date( $_GET['check_in'], $_GET['check_out'] ) ) . '"]' ?>},

                    beforeSend: function () {
                    },
                    success: function (data) {
                        window.location.href = '<?php echo $res_link ?>'
                    }
                })


            }
        })
        jQuery('.order_pay_timer').backward_timer('start')

        <?php

            if ($oid){ ?>
        let startTime = new Date().getTime();
        let interval = setInterval(function () {
            // if (new Date().getTime() - startTime > 90) {
            //     clearInterval(interval);
            //     return;
            // }
            jQuery.ajax({
                url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                type: "POST",
                data: {action: "get_hreserve_submit", 'oi':<?php  echo $oid?> },
                beforeSend: function () {
              
                },
                success: function (data) {

                    if (data === 'confirm') {

                        jQuery('.order_pay_timer_box h4').text('در انتظارپرداخت')
                        jQuery('.order_pay_timer_box p').text('میزبان شما درخواست رزرو شما را تایید کرد.با توجه به مهلت پرداخت و امکان از دست دادن رزرو هم اکنون پرداخت نمایید.')

				        <?php
				        if ($bank_pay == 'ok' && $timer > 0 ){ ?>
                        jQuery('.reserve_submit_box').html('<form action="<?php echo get_template_directory_uri() . '/payment/'.$bank_name.'/request-order.php?pt=hotel' ?>" name="order_pay_submit" class="order_pay_submit" method="post"> <?Php $amount = $pay_price;?><input type="hidden" name="dataoi" value="<?php echo $order_info['id'] ?>"><input type="hidden" name="up_wallet_amount" class="up_wallet_amount"  value="<?php echo $pay_price ?>"><button type="submit" class="order_pay_submit_but" >پرداخت با درگاه بانکی</button></form>');

				        <?php  }
				        if ($cash_pay == 'ok'  && $timer >0){ ?>
                        jQuery('.reserve_submit_box').append('<form action="<?php echo home_url() . '/cash_pay?pt=hotel'?>" name="order_cash_pay_submit" class="order_cash_pay_submit" method="post"> <input type="hidden" name="dataoi" value="<?php echo $order_info['id'] ?>"><button type="submit" class="order_cash_pay_submit_but" >پرداخت نقدی</button></form>');

				        <?php  }
				        if ($cart_pay == 'ok'  && $timer > 0 ){ ?>
                        jQuery('.reserve_submit_box').append('<form action="<?php echo home_url() . '/cart_pay?pt=hotel'?>" name="order_cart_pay_submit" class="order_cart_pay_submit" method="post"> <input type="hidden" class="dataoi" name="dataoi" value="<?php echo $order_info['id'] ?>"><button type="submit" class="order_cart_pay_submit_but" >پرداخت کارت به کارت</button></form>');

				        <?php  }
				        ?>
	                    <?php

	                    if ( $user_wallet[0]  >= $pay_price && $pay_price != 0  ){ ?>

                        jQuery('.reserve_submit_box').append('<span class="wallet_pay" data-type="hotel" data-amount="<?php echo ($pay_price/10)  ?>" data-oid ="<?php echo $order_info['id'] ?>"</span> پرداخت با کیف پول ')

	                    <?php  }
	                    ?>
                        jQuery('.con_sub-box').addClass('active')
                        jQuery('.conf_line').addClass('active');
				        <?php
				        $active = 'active';
				        ?>
 clearInterval(interval);
				        <?php

	                    if($order_check ){
		                    $timer = calc_reserve_timer_submit( $order_check['start_timer'] );
	                    }elseif ($order_info ){
		                    $timer = calc_reserve_timer_submit( $order_info['start_timer'] );
	                    }

				        ?>

                        jQuery('.order_pay_timer').backward_timer({

                            seconds: <?php echo $timer?>
                            , format: ' m% : s%  ',
                            on_exhausted: function (timer) {
                                jQuery.ajax({
                                    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                                    type: "POST",
                                    data: {action: "remove_hotel_reserve_date", 'res_id':<?php echo $hotel_id?>, 'room_id':<?php echo $_GET['roid']?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetweens_date( $_GET['check_in'], $_GET['check_out'] ) ) . '"]' ?>},

                                    beforeSend: function () {
                                    },
                                    success: function (data) {
                                        window.location.replace("<?php echo $resend_link ?>");
                                    }
                                })
                            }
                        })
                        jQuery('.order_pay_timer').backward_timer('start')

                    }
                    if (data === 'cancel') {
				        <?php
				        $active = '';
				        $cancel = 1;

				        ?>

                        jQuery('.order_pay_timer_box h4').text('درخواست شما از طرف میزبان رد شد.')
                        jQuery('.optbi i').remove()
                        jQuery('.optbi').append('<i class="fas fa-exclamation"></i>')
                        jQuery('.order_pay_timer_box p').remove()
                        jQuery('.pay_time_box .pay_tboxi').remove()



                        clearInterval(interval);
                       <?php

                       if ($oid != ''){ ?>
                        jQuery.ajax({
                            url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                            type: "POST",
                            data: {action: "remove_reserve_date", 'oid':<?php echo $oid?> , 'cancel': 1, 'res_id':<?php echo $hotel_id?>, 'date':<?php  echo '["' . implode( '", "', get_beetweens_date( $_GET['check_in'], $_GET['checkout'] ) ) . '"]' ?>},
                            beforeSend: function () {
                            },
                            success: function (data) {
                                window.setTimeout(function () {
                                    window.location.href = '<?php echo $res_link ?>'

                                }, 4000);

                            }
                        })
                      <?php }
                       ?>

                    }
                }
            })
         
        }, 4000 );
           <?php
        ?>

    </script>
<?php }

