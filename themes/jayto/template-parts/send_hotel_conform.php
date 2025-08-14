<?php
$active       = 'active';
$order_status = 0;
$timer        = 0;
$oid          = '';
$res_link     = get_the_permalink( $hotel_id );
$user_id      = get_current_user_id();
$user_wallet  = get_user_meta( $user_id, 'jayto-wallet', false );
$bank_rinfo   = get_option( 'bareqinf' );
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
$bank_name = $bank_rinfo['bank_name'];
if ( sizeof($order_check) == 0 ) {

	insert_hotel_order_table_confirm( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['pci'], $_GET['adult_num'], $_GET['child'], $user_id,4, $dis_price );
	$order_info = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['adult_num'], $_GET['child'], $user_id, 4 );
	$oid        = $order_info['id'];
	$timer      = calc_reserve_timer( $order_info['start_timer'] );

	if ( $timer > 0 ) {
		set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );

	}
} elseif (sizeof($order_check) != 0) {

	if ( $order_check['order_status'] != 4 && $order_check['order_status'] != 10 && $order_check['order_status'] != 5 && $order_check['order_status'] != 1 &&$order_check['order_status'] !=10 &&$order_check['order_status'] !=11) {

		insert_hotel_order_table_confirm( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['pci'], $_GET['adult_num'], $_GET['child'], $user_id,4, $dis_price );
		$order_info = order_room_exist_check( $_GET['check_in'], $_GET['check_out'], $hotel_id, $_GET['roid'], $_GET['adult_num'], $_GET['child'], $user_id, '4' );
		$oid        = $order_info['id'];
		$timer      = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {
			set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );
		}
	} elseif( $order_check['order_status'] == 4 ) {

		$order_info =  order_room_exist_check( $_GET['check_in'],$_GET['check_out'],$hotel_id,$_GET['roid'],$_GET['adult_num'],$_GET['child'],$user_id,'4' );

		$oid        = $order_info['id'];
		$timer      = calc_reserve_timer( $order_info['start_timer'] );
		if ( $timer > 0 ) {

			set_hotel_reserve_date( $hotel_id, $_GET['check_in'], $_GET['check_out'], $_GET['roid'] );

		}
	}elseif ( $order_check['order_status'] == 5 ) {


		$oid        = $order_check['id'];
		global $wpdb;
		$table_name   = $wpdb->prefix . 'jayto_hotel_orders';

		$wpdb->update( $table_name, array(
			'order_status' => 4,
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
                data: {action: "remove_hotel_reserve_date", 'res_id':<?php echo $hotel_id?>, 'room_id':<?php echo $_GET['roid']?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetween_date( $_GET['check_in'], $_GET['check_out'] ) ) . '"]' ?>},
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
    <input type="hidden" class="hotel_wallet" name="hotel_wallet" value="hotel">

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
                                <div><span><?php echo sizeof( $beet_date ) ?></span><span class="space_2x">شب</span><span><?php echo number_format( $order_info['price'] / sizeof( $beet_date ) ) ?></span><span class="space_5x">x</span></div>

                            </div>


                        </div>

                    </div>
                    <span class="line90"></span>
	                <?php
	                if ($in_discount == 'true'){

                        $price_discount = $_GET['pci']*$discount_ifo['perscent_discount']/100;

		                ?>
                        <div class="res_factor_add_people">
                            <div class="res_factor_ap"><span> قیمت</span> <span><?php  echo  number_format($_GET['pci'])  ?>  تومان </span></div>
                        </div>
                        <?php
                        if ($price_discount >0){?>
                            <div class="res_factor_add_people">
                                <div class="res_factor_ap"><span>  تخفیف</span> <span><?php  echo  number_format($price_discount)  ?>  تومان </span></div>
                            </div>
                     <?php   }
                        ?>


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
	                        ?>
                        </div>
                    </div>
                    <div class="reserve_submit_box">
						<?php
						if ( $timer > 0 ) {
							?>
							<?Php

							$amount = $pay_price;

							if ( $user_wallet[0]  >= $pay_price && $pay_price != 0 ) { ?>
                                <span class="wallet_pay">پرداخت از کیف پول</span>


							<?php }

	                    if ($bank_pay == 'ok' && $timer >0 ){


                            ?>
                          <form action="<?php echo get_template_directory_uri() . '/payment/'.$bank_name.'/request-order.php?pt=hotel' ?>" name="order_pay_submit" class="order_pay_submit" method="post"> <?Php $amount = $pay_price;?><input type="hidden" name="dataoi" value="<?php echo $order_info['id'] ?>"><input type="hidden" name="up_wallet_amount" class="up_wallet_amount" value="<?php echo $pay_price ?>"><button type="submit" class="order_pay_submit_but" >پرداخت با درگاه بانکی</button></form>

	                    <?php  }
	                    if ($cash_pay == 'ok'  && $timer >0){ ?>
                          <form action="<?php echo home_url() . '/cash_pay?pt=hotel'?>" name="order_cash_pay_submit" class="order_cash_pay_submit" method="post"> <input type="hidden" name="dataoi" value="<?php echo $order_info['id'] ?>"><button type="submit" class="order_cash_pay_submit_but" >پرداخت نقدی</button></form>

	                    <?php  }
	                    if ($cart_pay == 'ok'  && $timer > 0 ){ ?>
                           <form action="<?php echo home_url() . '/cart_pay?pt=hotel'?>" name="order_cart_pay_submit" class="order_cart_pay_submit" method="post"> <input type="hidden" class="dataoi" name="dataoi" value="<?php echo $order_info['id'] ?>"><button type="submit" class="order_cart_pay_submit_but" >پرداخت کارت به کارت</button></form>

	                    <?php  }
	                    ?>

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
                    <i class="fa fa-clock-o"></i>
                    <h4>در انتظار پرداخت</h4>
                    <p>میزبان شما درخواست رزرو شما را تایید کرد.با توجه به مهلت پرداخت و امکان از دست دادن رزرو هم اکنون پرداخت نمایید.</p>
                    <span class="mt_20 fz11 fw300">مهلت پرداخت</span>
                    <div class="order_pay_timer"></div>
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

                        <div class="tbd_dt">
                            <span class="tdb_title">تعداد مسافران</span>
                                                        <p class="fz13 fw700"><?php echo $_GET['child']+$_GET['adult_num'] ?> نفر &nbsp;<?php echo $add_passenger_title ?>  </p>
                        </div>
						<?php
						if ( $reserve_type != 0 ) {

							?>
                            <button class="edit_date_buton">ویرایش</button>
						<?php }
						?>
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
                <span class="line_dash90 mt_10"></span>
            </div>

        </div>

<?php
if($order_check ){
	$timer = calc_reserve_timer_submit( $order_check['start_timer'] );
}elseif ($order_info ){
	$timer = calc_reserve_timer_submit( $order_info['start_timer'] );
}

?>
    <script>

        jQuery('.order_pay_timer').backward_timer({
            seconds: <?php echo $timer ?> ,
            format: ' m% : s%  ',
            <?php
            if ($order_info){?>
            on_exhausted: function (timer) {


                jQuery.ajax({
                    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                    type: "POST",
                    data: {action: "remove_hotel_reserve_date", 'res_id':<?php echo $hotel_id?>, 'room_id':<?php echo $_GET['roid']?>, 'oid':<?php echo $oid?>, 'date':<?php  echo '["' . implode( '", "', get_beetween_date( $_GET['check_in'], $_GET['check_out'] ) ) . '"]' ?>},
                    beforeSend: function () {
                    },
                    success: function (data) {
                        window.location.href = '<?php echo $res_link ?>'
                    }
                })


            }
           <?php }
            ?>
        })
        jQuery('.order_pay_timer').backward_timer('start')

    </script>

<?php

