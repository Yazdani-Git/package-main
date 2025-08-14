<div class="lb_logo">
	<?php
	show_site_logo();

	?>
	<span class="log_box_close"><i class="fa fa-close"></i></span>
</div>
<div class="set_pass_title">
	<span class="set_pass_inon">انتخاب رمز عبور</span>
	<span class=" fz10 fw300 set_pass_into">رمز عبور خود را انتخاب نمایید. رمز عبور شما باید حداقل از 6 حرف تشکیل شده باشدو شامل عدد و حروف انگلیسی باشد.</span>

</div>
<div class="set_pass_inp_box">
    <div class="paaes_input">
       <i class=" pass_eye fa-thin fa fa-eye"></i> <input type="password" name="set_pass" class="set_pass inppss" placeholder="رمز عبور">
    </div>

	<input type="hidden" name="set_pass_phone" class="set_pass_phone" value="<?php echo $mobile_number?>">
    <div class="paaes_input">
        <i class=" pass_eye fa-thin fa fa-eye"></i><input type="password" name="retype_pass" class="retype_pass inppss" placeholder="تکرار رمز عبور">
    </div>
</div>
<div class="set_pass_error"></div>
<div class="pass_page_sbox">
    <button class="sp_submit">ورود</button>
</div>
<?php
die(1);


