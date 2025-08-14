<?php
$active       = 'active';
$order_status = 0;
$timer        = 0;
$oid          = '';
$res_link     = get_the_permalink( $order['tour_id'] );
$user_id = get_current_user_id();
$user_wallet= get_user_meta($user_id,'jayto-wallet',false);
$bank_rinfo=get_option('bareqinf');
$bank_name = $bank_rinfo['bank_name'];
//delete_post_meta($res_id, 'resistance_reserves' );
$admin_time =  get_option( 'pay_time' );
 $timer =    $admin_time - (time()-$order['start_timer'])  ;
if ($timer <= 0){?>
    <script>

            window.location.href = '<?php echo $res_link ?>'

    </script>
<?php }
?>
	<form action="<?php echo get_template_directory_uri() . '/payment/'.$bank_name.'/request-order.php?pt=experiences' ?>" name="order_pay_submit" class="order_pay_submit" method="post">

		<div class="request_page">

			<div class="calc_info_box">
				<div class="request_page_calc_price">
					<div class="rqpc_image_box">
						<img src="<?php echo $img_url[0] ?>" alt="">
						<span class="rqpc_title"><?php echo $post->post_title ?></span>
					</div>
					<span class="line90"></span>

					<div class="res_factor">
						<div class="each_night">

							<?php
							foreach ( $prices['count_value'] as $key => $row ) {
								?>
								<div class="res_factor_item">
									<div><span><?php echo $row ?></span><span class="space_2x">شب</span><span><?php echo $key ?></span><span class="space_5x">x</span></div>
									<div><span><?php echo $key * $row ?></span><span class="space_2x">تومان</span></div>
								</div>
							<?php }
							?>


						</div>

					</div>
					<span class="line90"></span>

					<div class="res_factor_total">
						<div class="rft_box">
							<div class="rft_box"><span>جمع مبلغ اقامت</span> <span><?php echo number_format($order['price']) ?> تومان<span></span></span></div>
						</div>
					</div>
					<div class="reserve_submit_box">
						<?php
						if ( $timer > 0 ) {
							?>
							<?Php

							$amount =  $order['price'];

							if ($user_wallet[0] /10 >= $amount){?>
								<span class="wallet_pay">پرداخت از کیف پول</span>



							<?php   }
							?>
							<input type="hidden" class="dataoi" name="dataoi" value="<?php echo $order['id'] ?>">
							<input type="hidden" class="up_wallet_amount" name="up_wallet_amount" value="<?php echo $amount   ?>">
							<button type="submit" class="order_pay_submit_but">پرداخت</button>

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
					<i class="fa-thin fz25 fa-calendar"></i>
					<div class="tdb_date">

						<div class="tbd_dt">
							<span class="tdb_title fz13 fw700">تاریخ تجربه</span>

							<p class="fz13 fw700"><?php echo $order['tour_date'] ?>  </p>
						</div>

					</div>

				</div>
				<div class="trip_date_box">
					<i class="fa-thin fz25  fa-user"></i>
					<div class="tdb_date">

						<div class="tbd_dt">
							<span class="tdb_title fz13 fw700">تعداد مسافران</span>
							<p class="fz13 fw700"><?php echo $order['pepole_number'] ?> نفر &nbsp;  </p>
						</div>

					</div>

				</div>

				<span class="line_dash90 mt_10"></span>
			</div>

		</div>
	</form>
<?php


?>
	<script>

        jQuery('.order_pay_timer').backward_timer({
            seconds: <?php echo $timer ?>
            , format: ' m% : s%  ',
            on_exhausted: function (timer) {
                jQuery.ajax({
                    url: '<?php echo admin_url( 'admin-ajax.php' ); ?>',
                    type: "POST",
                    data: {action: "change_tur_status", 'os': 4,'oi':<?php echo $order['id']  ?> },
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

