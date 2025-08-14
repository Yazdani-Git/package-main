<?php
if ( isset( $_POST['sms_name'] ) ) {
	$sms_samaneh_name = $_POST['sms_name'];
	$sms_username     = $_POST['sms_un'];
	$sms_password     = $_POST['sms_pas'];
	$sms_admin        = $_POST['sms_admin'];
	$sms_opt          = $_POST['sms_opt'];
	$sms_host_need    = $_POST['sms_host_need'];
	$sms_send_line    = $_POST['sms_send_line'];
	$sms_adm_tour_request    = $_POST['sms_adm_tour_request'];
	$sms_user_register_to_admin    = $_POST['sms_user_register_to_admin'];
	$sms_user_register    = $_POST['sms_user_register'];
	$sms_host_reserve_to_admin    = $_POST['sms_host_reserve_to_admin'];
	$sms_host_reserve_to_host    = $_POST['sms_host_reserve_to_host'];
	$sms_host_reserve_to_Guest    = $_POST['sms_host_reserve_to_Guest'];
	$sms_hotel_reserve_to_admin    = $_POST['sms_hotel_reserve_to_admin'];
	$sms_hotel_reserve_to_host    = $_POST['sms_hotel_reserve_to_host'];
	$sms_hotel_reserve_to_guest    = $_POST['sms_hotel_reserve_to_guest'];
	$sms_tour_reserve_to_admin    = $_POST['sms_tour_reserve_to_admin'];
	$sms_adm_tour_accept    = $_POST['sms_adm_tour_accept'];
	$sms_tour_reserve_to_host    = $_POST['sms_tour_reserve_to_host'];
	$sms_tour_reserve_to_guest    = $_POST['sms_tour_reserve_to_guest'];
	$sms_submit_comment_to_admin    = $_POST['sms_submit_comment_to_admin'];
	$sms_user_send_ticket    = $_POST['sms_user_send_ticket'];
	$sms_modir_answer_ticket    = $_POST['sms_modir_answer_ticket'];
	$sms_cart_need_conf_to_hoster    = $_POST['sms_cart_need_conf_to_hoster'];
	$sms_cart_need_conf_to_guest    = $_POST['sms_cart_need_conf_to_guest'];
	$sms_reserve_need_conf_to_guest    = $_POST['sms_reserve_need_conf_to_guest'];
	$sms_cash_need_conf_to_guest    = $_POST['sms_cash_need_conf_to_guest'];
	$sms_residance_cancel    = $_POST['sms_residance_cancel'];
	$sms_request_info = [ 'sms_samaneh_name' => $sms_samaneh_name, 'sms_username' => $sms_username, 'sms_password' => $sms_password, 'sms_opt' => $sms_opt, 'sms_host_need' => $sms_host_need, 'sms_send_line' => $sms_send_line,'sms_admin' => $sms_admin,'sms_adm_tour_request'=>$sms_adm_tour_request,'sms_user_register_to_admin'=>$sms_user_register_to_admin,'sms_user_register'=>$sms_user_register, 'sms_host_reserve_to_admin'=>$sms_host_reserve_to_admin,'sms_host_reserve_to_host'=>$sms_host_reserve_to_host,'sms_host_reserve_to_Guest'=>$sms_host_reserve_to_Guest,'sms_hotel_reserve_to_admin'=>$sms_hotel_reserve_to_admin,'sms_hotel_reserve_to_host'=>$sms_hotel_reserve_to_host,'sms_hotel_reserve_to_guest'=>$sms_hotel_reserve_to_guest,'sms_tour_reserve_to_admin'=>$sms_tour_reserve_to_admin,'sms_tour_reserve_to_host'=>$sms_tour_reserve_to_host,'sms_tour_reserve_to_guest'=>$sms_tour_reserve_to_guest,'sms_submit_comment_to_admin'=>$sms_submit_comment_to_admin,'sms_user_send_ticket'=>$sms_user_send_ticket,'sms_modir_answer_ticket'=>$sms_modir_answer_ticket,'sms_cart_need_conf_to_hoster'=>$sms_cart_need_conf_to_hoster,'sms_cart_need_conf_to_guest'=>$sms_cart_need_conf_to_guest,'sms_reserve_need_conf_to_guest'=>$sms_reserve_need_conf_to_guest,'sms_adm_tour_accept'=>$sms_adm_tour_accept,'sms_cash_need_conf_to_guest'=>$sms_cash_need_conf_to_guest,'sms_residance_cancel'=>$sms_residance_cancel];
	update_option( 'sms_enter_info', $sms_request_info );
}
$sms_info = get_option( 'sms_enter_info' );


?>

    <div class="pay_setting_box">
        <p>مشخصات درگاه پیامکی خود را وارد نمایید.</p>
        <form action="#" name="sms_info_form" method="post">
            <div class="bif2_item">
                <lable for="sms_name_input">انتخاب درگاه پیامک</lable>
                <select name="sms_name">
                    <option name="ip_panel" value="ip_panel" <?php if ( $sms_info['sms_samaneh_name'] == 'ip_panel' )
						echo 'selected' ?> >آی پی پنل
                    </option>
                    <option name="melii_payamak" value="melii_payamak" <?php if ( $sms_info['sms_samaneh_name'] == 'melii_payamak' )
						echo 'selected' ?> >ملی پیامک
                    </option>
                    <option name="sms.ir" value="sms.ir" <?php if ( $sms_info['sms_samaneh_name'] == 'sms.ir' )
						echo 'selected' ?> >sms.ir
                    </option>
                    <option name="kaveh" value="kaveh" <?php if ( $sms_info['sms_samaneh_name'] == 'kaveh' )
						echo 'selected' ?> >کاوه نگار
                    </option>



                </select>
            </div>
            <div class="bif2_item">
                <lable for="sms_un">نام کاربری درگاه</lable>
                <input type="text" name="sms_un" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_username'] ?> >
            </div>
            <div class="bif2_item">
                <lable for="sms_pas">رمز عبور درگاه</lable>
                <input type="text" name="sms_pas" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_password'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_send_line">شماره خط ارسال کننده(در صورت نیاز)</lable>
                <input type="text" name="sms_send_line" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_send_line'] ?> >
            </div>
            <div class="bif2_item">
                <lable for="sms_admin">شماره موبایل ادمین</lable>
                <input type="text" placeholder="09121234567" name="sms_admin" <?php if ( $sms_info )	echo 'value=' . $sms_info['sms_admin'] ?> >
            </div>
            <hr>
            <div class="bif2_item ">
                <lable for="sms_opt">کد رمز یکبار مصرف در پنل پیامک</lable>
                <input type="text" name="sms_opt" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_opt'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_host_need">کد رمز ارسال پیامک نیاز به تایید میزبان</lable>
                <input type="text" name="sms_host_need" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_host_need'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_adm_tour_request">کد پیامک درخواست رزرو تور برای ادمین</lable>
                <input type="text" name="sms_adm_tour_request" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_adm_tour_request'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_adm_tour_accept">کد پیامک تایید درخواست تور برای مهمان</lable>
                <input type="text" name="sms_adm_tour_accept" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_adm_tour_accept'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_user_register_to_admin">کد پیامک ثبت نام کاربر برای مدیر سایت</lable>
                <input type="text" name="sms_user_register_to_admin" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_user_register_to_admin'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_user_register">کد پیامک ثبت کاربر برای ثبت نام کننده</lable>
                <input type="text" name="sms_user_register" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_user_register'] ?> >
            </div>

            <div class="bif2_item ">
                <lable for="sms_host_reserve_to_admin">کد پیامک پرداخت موفق رزرو اقامتگاه برای مدیر</lable>
                <input type="text" name="sms_host_reserve_to_admin" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_host_reserve_to_admin'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_host_reserve_to_host">کد پیامک پرداخت موفق رزرو اقامتگاه برای میزبان</lable>
                <input type="text" name="sms_host_reserve_to_host" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_host_reserve_to_host'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_host_reserve_to_Guest">کد پیامک پرداخت موفق رزرو اقامتگاه برای مهمان</lable>
                <input type="text" name="sms_host_reserve_to_Guest" <?php if ( $sms_info )
					echo 'value=' . $sms_info['sms_host_reserve_to_Guest'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_hotel_reserve_to_admin">کد پیامک پرداخت موفق رزرو هتل برای مدیر</lable>
                <input type="text" name="sms_hotel_reserve_to_admin" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_hotel_reserve_to_admin'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_hotel_reserve_to_host">کد پیامک پرداخت موفق رزرو هتل برای میزبان</lable>
                <input type="text" name="sms_hotel_reserve_to_host" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_hotel_reserve_to_host'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_hotel_reserve_to_guest">کد پیامک پرداخت موفق رزرو هتل برای مهمان</lable>
                <input type="text" name="sms_hotel_reserve_to_guest" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_hotel_reserve_to_guest'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_tour_reserve_to_admin">کد پیامک پرداخت موفق رزرو تور برای مدیر</lable>
                <input type="text" name="sms_tour_reserve_to_admin" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_tour_reserve_to_admin'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_tour_reserve_to_host">کد پیامک پرداخت موفق رزرو تور برای میزبان</lable>
                <input type="text" name="sms_tour_reserve_to_host" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_tour_reserve_to_host'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_tour_reserve_to_guest">کد پیامک پرداخت موفق رزرو تور برای مهمان</lable>
                <input type="text" name="sms_tour_reserve_to_guest" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_tour_reserve_to_guest'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_submit_comment_to_admin">کد پیامک ثبت دیدگاه جدید</lable>
                <input type="text" name="sms_submit_comment_to_admin" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_submit_comment_to_admin'] ?> >
            </div>
           
            <div class="bif2_item ">
                <lable for="sms_user_send_ticket"> کد پیامک ثبت تیکت جدید برای مدیر</lable>
                <input type="text" name="sms_user_send_ticket" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_user_send_ticket'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_modir_answer_ticket"> کد پیامک ثبت پاسخ تیکت مدیر برای کاربر</lable>
                <input type="text" name="sms_modir_answer_ticket" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_modir_answer_ticket'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_cart_need_conf_to_hoster"> تایید پرداخت کارت به کارت به میزبان</lable>
                <input type="text" name="sms_cart_need_conf_to_hoster" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_cart_need_conf_to_hoster'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_cart_need_conf_to_guest"> تایید پرداخت کارت به کارت به مهمان</lable>
                <input type="text" name="sms_cart_need_conf_to_guest" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_cart_need_conf_to_guest'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_cash_need_conf_to_guest"> تایید رزرو با پرداخت نقدی به مهمان</lable>
                <input type="text" name="sms_cash_need_conf_to_guest" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_cash_need_conf_to_guest'] ?> >
            </div>
            <div class="bif2_item ">
                <lable for="sms_reserve_need_conf_to_guest">پیام تایید شدن رزرو به مهمان</lable>
                <input type="text" name="sms_reserve_need_conf_to_guest" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_reserve_need_conf_to_guest'] ?> >
            </div>
         
            <div class="bif2_item ">
                <lable for="sms_residance_cancel"> پیامک لغو رزرو اقامتگاه </lable>
                <input type="text" name="sms_residance_cancel" <?php if ( $sms_info )
			        echo 'value=' . $sms_info['sms_residance_cancel'] ?> >
                    <span>پترن :  </span><span> رزرو اقامتگاه با شماره سفارش #code # از طرف مهمان لغو گردید</span>
            </div>
               </div>
            <input type="submit" class="bank_req_submit" value="ذخیره">
        </form>
    </div>
<?php
