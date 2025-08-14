<?php
if (isset($_POST['merchent_id'])){
	$merchent = $_POST['merchent_id'];
	$terminal_id = $_POST['terminal_id'];
	$terminal_kye = $_POST['terminal_kye'];
	$bank_username = $_POST['bank_username'];
	$bank_password = $_POST['bank_password'];
	$bank_name = $_POST['bank_name'];
	$bank_request_info = ['merchent_id'=>$merchent,'bank_user_name'=>$bank_username,'bank_pass'=>$bank_password,'bank_name'=>$bank_name,'terminal_id'=>$terminal_id,'terminal_kye'=>$terminal_kye];
	update_option('bareqinf',$bank_request_info);
}
$bank_rinfo=get_option('bareqinf');


?>

<div class="pay_setting_box">
	<p>مشخصات درگاه پرداخت خود را وارد نمایید.</p>
	<form action="#" name="bank_info_form" method="post">
		<div class="bif_item">
			<lable for="merchent_input" >انتخاب بانک</lable>
			<select  name="bank_name">
				<option value="zarinpal" <?php  if ($bank_rinfo['bank_name'] == 'zarinpal')echo 'selected'?> >زرین پال</option>
				<option value="mellat" <?php  if ($bank_rinfo['bank_name'] == 'mellat')echo 'selected'?>>ملت</option>
                <option value="meli" <?php  if ($bank_rinfo['bank_name'] == 'meli')echo 'selected'?>>ملی</option>
                <option value="pay" <?php  if ($bank_rinfo['bank_name'] == 'pay')echo 'selected'?>>پی</option>
				<option value="idpay" <?php  if ($bank_rinfo['bank_name'] == 'idpay')echo 'selected'?>>آیدی پی</option>
				<option value="nextpay" <?php  if ($bank_rinfo['bank_name'] == 'nextpay')echo 'selected'?>>نکست پی</option>
				<option value="bitpay" <?php  if ($bank_rinfo['bank_name'] == 'bitpay')echo 'selected'?>>بیت پی</option>
				<option value="mrpay" <?php  if ($bank_rinfo['bank_name'] == 'mrpay')echo 'selected'?>>آقای پرداخت</option>
				<option value="saman" <?php  if ($bank_rinfo['bank_name'] == 'saman')echo 'selected'?>>سامان</option>


			</select>
		</div>
	<div class="bif_item">
		<lable for="merchent_id">شناسه پذیرنده</lable>
		<input type="text" name="merchent_id" <?php  if ($bank_rinfo) echo 'value='.$bank_rinfo['merchent_id'] ?> >
	</div>
	<div class="bif_item">
		<lable for="terminal_id">شناسه ترمینال(بانک ملی)</lable>
		<input type="text" name="terminal_id" <?php  if ($bank_rinfo) echo 'value='.$bank_rinfo['terminal_id'] ?> >
	</div>
	<div class="bif_item">
		<lable for="terminal_kye">کلید پذیرنده(بانک ملی)</lable>
		<input type="text" name="terminal_kye" <?php  if ($bank_rinfo) echo 'value='.$bank_rinfo['terminal_kye'] ?> >
	</div>
	<div class="bif_item">
		<lable for="bank_username">نام کاربری</lable>
		<input type="text" name="bank_username" <?php  if ($bank_rinfo) echo 'value='.$bank_rinfo['bank_user_name'] ?> >
	</div>
	<div class="bif_item">
		<lable for="bank_password">پسورد</lable>
		<input type="text" name="bank_password" <?php  if ($bank_rinfo) echo 'value='.$bank_rinfo['bank_pass'] ?> >
	</div>
        <input type="submit" class="bank_req_submit" value="ذخیره">
	</form>
</div>
<?php
