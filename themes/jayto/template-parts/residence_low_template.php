<input type="hidden" data-ri43659="<?php  echo $res_id+100?>" data-oi43654="<?php  echo $order_id+100?>" class="crid">
<?php

if ( $cancel_type == 'easy' ) {
	$easy_cancel = get_option( 'easy_cancel' );

	?>

    <div class="cancel_reserv_box_ord">
        <h4> قوانین لغو رزرو</h4>
    </div>
    <div class="cancel_reserv_box_ord">
        <div class="crb_head">
            <h4>قوانین لغو رزرو &nbsp;(<?php echo $res_info->post_title; ?>)&nbsp;</h4>
            <span class="cancel_box_close"><i class="fa fa-close"></i></span>
        </div>

        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_green"></span>
                <span class="lbef_l bg_green"></span>
                <span class="lbef_b bg_green"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10 ">تا یک روز قبل از ورود مهمان</span>
                <?php
                $one_day=  $easy_cancel['easy_one_day_before_recive'];
                ?>
                <span class="fz11">پرداخت <?php  echo $one_day?>درصد از مبلغ رزرو کسر میگردد</span>
            </div>
        </div>


        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_red"></span>
                <span class="lbef_l bg_red"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10">از روز ورود تا خروج مهمان</span>
                <span class="fz11"><?php echo $easy_cancel['easy_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $easy_cancel['easy_after_recive2'] ?> % مبلغ شب های باقیمانده کسر میگردد</span>
            </div>

        </div>
        <div class="cancel_res_details">
            <p>مبلغ پرداختی توسط شما :&nbsp <?php echo $order_info->price; ?></p>
            <p>مبلغ جریمه استرداد : &nbsp;<?php echo $cancel_price ?></p>
            <p>مبلغ قابل استرداد : &nbsp;<?php echo $order_info->price - $cancel_price ?></p>

        </div>
        <div class="cancel_res_box">
            <p class="dif_term"><label class="ctacl" for="ctac">قوانین و مقررات لغو سفر را خوانده و با آن موافق هستم.</label> <input type="checkbox" name="cancel Terms and Conditions" class="ctac">
            </p>
            <span class="cancel_trip_btn">لغو سفر</span>
        </div>
    </div>
<?php } elseif ( $cancel_type == 'medium' ) { ?>


    <div class="cancel_reserv_box_ord">
        <div class="crb_head">
            <h4>قوانین لغو رزرو &nbsp;(<?php echo $res_info->post_title; ?>)&nbsp;</h4>
            <span class="cancel_box_close"><i class="fa fa-close"></i></span>
        </div>

		<?php
		$medium_cancel = get_option( 'medium_cancel' );

		?>
        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_green"></span>
                <span class="lbef_l bg_green"></span>
                <span class="lbef_b bg_green"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10 ">2 روز قبل از ورود مهمان</span>
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
                <span class="mbt10">تا روز ورود مهمان</span>
                <span><?php echo $medium_cancel['medium_before_recive'] ?>٪ مبلغ شب اول  </span>
            </div>
        </div>
        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_red"></span>
                <span class="lbef_l bg_red"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10">از روز ورود تا خروج مهمان</span>
                <span><?php echo $medium_cancel['medium_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $medium_cancel['medium_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
            </div>
        </div>
        <div class="cancel_res_details">
            <p>مبلغ پرداختی توسط شما :&nbsp <?php echo number_format( $order_info->price ); ?></p>
            <p>مبلغ جریمه استرداد : &nbsp;<?php echo number_format( $cancel_price ) ?></p>
            <p>مبلغ قابل استرداد : &nbsp;<?php echo number_format( $order_info->price - $cancel_price ) ?></p>
        </div>
        <div class="cancel_res_box">
            <p class="dif_term"><label class="ctacl" for="ctac">قوانین و مقررات لغو سفر را خوانده و با آن موافق هستم.</label> <input type="checkbox" name="cancel Terms and Conditions" class="ctac">
            </p>
            <span class="cancel_trip_btn">لغو سفر</span>
        </div>
    </div>

<?php } elseif ( $cancel_type == 'hard' ) {
	$hard_cancel = get_option( 'hard_cancel' );

	?>
    <p>از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard_cancel['hard_before_4day_recivee'] ?>٪ مبلغ شب اول و از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard_cancel['hard_4day_before_recive2'] ?>٪ مبلغ شب‌های باقیمانده کسر می‌گردد.</p>

    <div class="cancel_reserv_box_ord">
        <div class="crb_head">
            <h4>قوانین لغو رزرو &nbsp;(<?php echo $res_info->post_title; ?>)&nbsp;</h4>
            <span class="cancel_box_close"><i class="fa fa-close"></i></span>
        </div>
        <p class="cbz-t">از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard_cancel['hard_before_4day_recivee'] ?>٪ مبلغ شب اول و از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard_cancel['hard_4day_before_recive2'] ?>٪ مبلغ شب‌های باقیمانده کسر می‌گردد.</p>

        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_green"></span>
                <span class="lbef_l bg_green"></span>
                <span class="lbef_b bg_green"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10 ">4 روز قبل از ورود مهمان</span>
                <span><?php echo $hard_cancel['hard_before_4day_recivee'] ?>٪ مبلغ شب اول + <?php echo $hard_cancel['hard_4day_before_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
            </div>
        </div>
        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_orang"></span>
                <span class="lbef_l bg_orang"></span>
                <span class="lbef_b bg_orang"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10">تا روز ورود مهمان</span>
                <span><?php echo $hard_cancel['hard_before_recive1'] ?>٪ مبلغ شب اول + <?php echo $hard_cancel['hard_before_recive2'] ?>٪ مبلغ شب‌های باقیماند</span>
            </div>
        </div>
        <div class="cbc_item">
            <div class="cbc_i ">
                <span class="cbc_ic border_red"></span>
                <span class="lbef_l bg_red"></span>
            </div>
            <div class="cbc_c">
                <span class="mbt10">از روز ورود تا خروج مهمانن</span>
                <span><?php echo $hard_cancel['hard_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $hard_cancel['hard_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
            </div>

        </div>
        <?php

        ?>
        <div class="cancel_res_details">
            <p>مبلغ پرداختی توسط شما :&nbsp <?php echo number_format( $order_info->price ); ?></p>
            <p>مبلغ جریمه استرداد : &nbsp;<?php echo number_format( $cancel_price ) ?></p>
            <p>مبلغ قابل استرداد : &nbsp;<?php echo number_format( $order_info->price - $cancel_price ) ?></p>
        </div>
        <div class="cancel_res_box">
            <p class="dif_term"><label  class="ctacl" for="ctac">قوانین و مقررات لغو سفر را خوانده و با آن موافق هستم.</label> <input type="checkbox" name="cancel Terms and Conditions" class="ctac">
            </p>
            <span class="cancel_trip_btn">لغو سفر</span>
        </div>
    </div>

<?php }
?>
