<div class="lb_logo">
	<?php
	show_site_logo();
	$user    = username_exists( $mobile_number );
	$resend_one_code_time=get_option('resend_one_code_time');
	?>
    <span class="log_box_close"><i class="fa fa-close"></i></span>
</div>

<div class="logopt">
    <div>
        <spna class="fz16 fw700 dfc">تایید شماره موبایل</spna>
        <spna class="fz11 fw300 dfc col_gray2 mbt20">کد ۴ رقمی ارسال‌شده به شماره "<?php echo $mobile_number ?>" را واردکنید.</spna>
    </div>
    <div class="mbn_show ">
        <span class="mbn_show_edit">ویرایش شماره</span>
        <input class="mbn_inp" type="tel" value="<?php echo $mobile_number ?>">
    </div>
    <div class="opt_box">
        <input class="opt_numbers opt_item_css " data-idx="1" pattern="[0-9]*" min="0" max="9" maxlength="1" autocomplete="off" type="tel">
        <input class="opt_numbers opt_item_css" data-idx="2" pattern="[0-9]*" min="0" max="9" maxlength="1" autocomplete="off" type="tel">
        <input class="opt_numbers opt_item_css" data-idx="3" pattern="[0-9]*" min="0" max="9" maxlength="1" autocomplete="off" type="tel">
        <input class="opt_numbers opt_item_css" data-idx="4" pattern="[0-9]*" min="0" max="9" maxlength="1" autocomplete="off" type="tel">
        <div class="opt_resend opt_item_css"><i class="fa fa-refresh"></i><div class="opt_timer"></div></div>
    </div>
    <script>
        jQuery('.opt_timer').backward_timer({
            seconds: <?php  echo $resend_one_code_time ?>
            , format: ' m% : s%  ',
            on_exhausted: function(timer) {
            jQuery('.opt_timer').fadeOut(0);
            jQuery('.opt_resend i').css({'font-size':'16px','opacity':'1','pointer-events':'auto','cursor':'pointer'});

            }
        })
        jQuery('.opt_timer').backward_timer('start')
    </script>
    <div class="login_form_error">

    </div>
    <?php
    $low_view_text    = get_option( 'low_view_text' );
    $low_view_link_text     = get_option( 'low_view_link_text' );
    $low_view_link     = get_option( 'low_view_link' );
    if (!$user && $low_view_text != '' && $low_view_link_text != '' && $low_view_link != ''  ){ ?>
        <div class="mbt15 text_cnt">
            <span class="fz11" ><?php echo $low_view_text ?></span>
            <a href="<?php echo $low_view_link ?>" target="_blank" class="fz11"><?php echo $low_view_link_text ?></a>
        </div>
  <?php  }
    ?>
    <div class="login_sub_box">
        <?php
        if ($user){?>
	        <button class="un_login_submit">ورود با رمز عبور</button>
       <?php }else{?>
	        <button class="un_login_submit_disable">ورود با رمز عبور</button>
     <?php   }
        ?>

		<?php
		if ( ! $user ) {
			?>
            <button class="opt_login_submit">ادامه</button>
		<?php } else {
			?>

            <button class="direct_login">ورود</button>
		<?php }
		?>
    </div>
</div>
<div class="logpass">
    <span class="fz16 fw700 dfc">رمز عبور</span>
    <div class="paaes_input">
        <i class=" pass_eye fa-thin fa fa-eye"></i> <input type="password" class=" inppss paa_log_inp">
    </div>
    <div class="lip_error"></div>
    <spna class="log_in_pass">ورود</spna>
</div>

