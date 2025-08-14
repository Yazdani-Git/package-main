
<div class="user_uf_box">
	<div class="user_p_image">
        <?php
        if ($user_prifile_image){?>
            <img src="<?php echo $user_prifile_image ?>" alt="">
    <?php    }else{ $p_image = get_template_directory_uri().'/images/user-profile.png'?>
            <img src="<?php echo $p_image ?>" alt="">
    <?php    }
        ?>

    </div>
	<div class="fupload">
		<span>  <i class="fa fa-pen"></i>ویرایش تصویر پروفایل </span>
		<form class="fileUpload" enctype="multipart/form-data">
			<div class="form-group">

				<input type="file" id="file_user_pic" accept="image/*"/>
			</div>
		</form>
	</div>
</div>
<div class="input_pass_box">
	<span class="ip_title">نام و نام خانوادگی</span>
	<input type="text" autocomplete="off" class="a_uname ta_right" value="<?php echo $user_name ?>">
	<input type="text" autocomplete="off" class="a_lastname mr5 ta_right" value="<?php echo $last_lastname ?>">

</div>
<div class="oup_error chpass_err"></div>
<span class="line_dash90"></span>
<div class="input_pass_box">
	<span class="ip_title">کد ملی</span>
	<input type="text" class="mcode" value="<?php echo $melli_code ?>" autocomplete="off">

</div>
<div class="nup_error chpass_err"></div>
<span class="line_dash90"></span>
<div class="input_pass_box">
	<span class="ip_title">جنسیت</span>
	<select type="text" name="gender" class="gender ta_right" autocomplete="off">
		<option value="men" <?php if ( $user_gender == 'men' )
			echo 'selected' ?>>مرد
		</option>
		<option value="women" <?php if ( $user_gender == 'women' )
			echo 'selected' ?>>زن
		</option>
	</select>


</div>
<div class="rnup_error chpass_err"></div>
<span class="line_dash90"></span>

<div class="input_pass_box">
	<span class="ip_title">تاریخ تولد</span>
	<input type="text" value="<?php echo $user_birth ?>" class="au_date" autocomplete="off" placeholder="تاریخ تولد خود را انتخاب نمایید.">
	<div id="select_birth">
		<date-picker v-model="date"  value="<?php echo $user_birth ?>" simple custom-input=".au_date"></date-picker>
	</div>
</div>
<div class="rnup_error chpass_err"></div>
<span class="line_dash90"></span>

<div class="input_pass_box">
	<span class="ip_title">شمار همراه</span>
	<input type="tel" disabled class="au_mobile bgc_f5" autocomplete="off" value="<?php echo $user_info->user_login ?>">

</div>
<div class="rnup_error chpass_err"></div>
<span class="line_dash90"></span>

<div class="input_pass_box">
	<span class="ip_title">ایمیل</span>
	<input type="email" class="au_email" autocomplete="off" value="<?php echo $user_email ?>">

</div>
<div class="rnup_error chpass_err"></div>
<span class="line_dash90"></span>
<div class="input_pass_box">
	<span class="ip_title">تلفن ثابت</span>
	<input type="number" value="<?php echo $user_phone ?>" class="au_phone " autocomplete="off" placeholder="شماره تلفن به همراه کد استان">

</div>
<span class="line_dash90"></span>

<div class="input_pass_box">
    <span class="ip_title">شماره کارت</span>
    <input type="number" value="<?php echo $user_cart ?>" class="au_cartnum " autocomplete="off" placeholder="شماره کارت بانکی">
</div>
<div class="input_pass_box">
    <span class="ip_title">شماره شبا</span>
    <input type="text" value="<?php echo $user_shaba ?>" class="au_shaba " autocomplete="off" placeholder="شماره شبا">
</div>
<div class="input_pass_box">
    <span class="ip_title">نام صاحب حساب</span>
    <input type="text" value="<?php echo $user_bacount_name ?>" class="au_accountname " autocomplete="off" placeholder="نام صاحب حساب باید با نام و نام خانوادگی حساب کاربری یکی باشد">
</div>
<div class="input_pass_box">
    <span class="ip_title">نام بانک</span>
    <input type="text" value="<?php echo $bank_name ?>" class="au_bank_name " autocomplete="off" placeholder="نام بانک">
</div>
<div class="rnup_error chpass_err"></div>
<span class="line_dash90"></span>
<div class="input_pass_box">
	<span class="ip_title">توضیح مختصر</span>
	<textarea class="au_desc" autocomplete="off"><?php echo $user_description ?></textarea>

</div>
<div class="rnup_error chpass_err"></div>
<span class="line"></span>
<div class="cop_err chpass_er"></div>
<span class="change_user_info_submit">ذخیره</span>