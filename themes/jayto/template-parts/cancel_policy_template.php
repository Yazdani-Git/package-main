<?php
if ( isset( $_POST['cancel_reserve_submit'] ) ) {
	$easy_one_day_before_recive = $_POST['easy_one_day_before_recive'];
	$easy_before_recive         = $_POST['easy_before_recive'];
	$easy_after_recive1         = $_POST['easy_after_recive1'];
	$easy_after_recive2         = $_POST['easy_after_recive2'];
	$easy_array                 = [ 'easy_one_day_before_recive' => $easy_one_day_before_recive, 'easy_before_recive' => $easy_before_recive, 'easy_after_recive1' => $easy_after_recive1, 'easy_after_recive2' => $easy_after_recive2 ];

	$medium_2day_before_recive = $_POST['medium_2day_before_recive'];
	$medium_before_recive      = $_POST['medium_before_recive'];
	$medium_after_recive1      = $_POST['medium_after_recive1'];
	$medium_after_recive2      = $_POST['medium_after_recive2'];
	$medium_array              = [ 'medium_2day_before_recive' => $medium_2day_before_recive, 'medium_before_recive' => $medium_before_recive, 'medium_after_recive1' => $medium_after_recive1, 'medium_after_recive2' => $medium_after_recive2 ];

	$hard_before_4day_recive = $_POST['hard_before_4day_recive'];
	$hard_4day_before_recive2 = $_POST['hard_4day_before_recive2'];
	$hard_before_recive1      = $_POST['hard_before_recive1'];
	$hard_before_recive2      = $_POST['hard_before_recive2'];
	$hard_after_recive1       = $_POST['hard_after_recive1'];
	$hard_after_recive2       = $_POST['hard_after_recive2'];
	$hard_array               = [
		'hard_before_4day_recivee' => $hard_before_4day_recive,
		'hard_4day_before_recive2' => $hard_4day_before_recive2,
		'hard_before_recive1'      => $hard_before_recive1,
		'hard_before_recive2'      => $hard_before_recive2,
		'hard_after_recive1'       => $hard_after_recive1,
		'hard_after_recive2'       => $hard_after_recive2,
	];
	update_option( 'easy_cancel', $easy_array );
	update_option( 'medium_cancel', $medium_array );
	update_option( 'hard_cancel', $hard_array );

}
$easy=get_option('easy_cancel');
$medium=get_option('medium_cancel');
$hard=get_option('hard_cancel');

?>

<form action="#" method="post">
    <div class="option_box">
        <h4>تنظیمات مقررت لغو رزرو</h4>
        <p>قوانین آسان</p>

        <label for="easy_one_day_before_recive"><span class="opt_lable"> 1 روز قبل از ورود مهمان</span>
            <input type="number"   name="easy_one_day_before_recive" value="<?php echo $easy['easy_one_day_before_recive'] ?>"><span class="mr10"> درصد</span>
        </label>
        <label for="easy_before_recive"><span class="opt_lable"> تا روز ورود مهمان</span>
            <input type="number"  name="easy_before_recive" value="<?php echo $easy['easy_before_recive'] ?>"><span class="mr10" value="20">  درصد مبلغ شب اول</span>
        </label>
        <label for="easy_after_recive1"> <span class="opt_lable">از روز ورود تا روز خروج مهمان</span>
            <input type="number"  name="easy_after_recive1" value="<?php echo $easy['easy_after_recive1'] ?>"><span class="mr10" >  درصد شبهای سپری شده</span>
            <span>بعلاوه</span>
            <input type="number"  name="easy_after_recive2" value="<?php echo $easy['easy_after_recive2'] ?>"><span class="mr10" >  درصد شبهای باقی مانده</span>

        </label>
        <span class="option_dashline"></span>
        <p>قوانین میانه</p>
        <label for="medium_2day_before_recive"><span class="opt_lable"> 2 روز قبل از ورود مهمان</span>
            <input type="number"  name="medium_2day_before_recive" value="<?php echo $medium['medium_2day_before_recive'] ?>"><span class="mr10" >درصد</span>
        </label>
        <label for="medium_before_recive"><span class="opt_lable"> تا روز ورود مهمان</span>
            <input type="number"  name="medium_before_recive" value="<?php echo $medium['medium_before_recive'] ?>"><span class="mr10" >  درصد مبلغ شب اول</span>
        </label>
        <label for="medium_after_recive1"> <span class="opt_lable">از روز ورود تا روز خروج مهمان</span>
            <input type="number"  name="medium_after_recive1" value="<?php echo $medium['medium_after_recive1'] ?>"><span class="mr10" >  درصد شبهای سپری شده</span>
            <span>بعلاوه</span>
            <input type="number"  name="medium_after_recive2" value="<?php echo $medium['medium_after_recive2'] ?>"><span class="mr10" >  درصد شبهای باقی مانده</span>

        </label>
        <span class="option_dashline"></span>
        <p>قوانین سخت</p>
        <label for="hard_before_4day_recive"><span class="opt_lable"> 4 روز قبل از ورود مهمان</span>
            <input type="number" name="hard_before_4day_recive" value="<?php echo $hard['hard_before_4day_recivee'] ?>" ><span class="mr10" >درصد شب اول</span>
            <span>بعلاوه</span>
            <input type="number"  name="hard_4day_before_recive2" value="<?php echo $hard['hard_4day_before_recive2'] ?>"><span class="mr10" >شب های باقی مانده</span>

        </label>

        <label for="hard_before_recive1"> <span class="opt_lable">تاروز ورود مهمان</span>
            <input type="number"  name="hard_before_recive1" value="<?php echo $hard['hard_before_recive1'] ?>"><span class="mr10" > شب اول</span>
            <span>بعلاوه</span>
            <input type="number"  name="hard_before_recive2" value="<?php echo $hard['hard_before_recive2'] ?>"><span class="mr10" >  درصد شبهای باقی مانده</span>

        </label>
        <label for="hard_after_recive1"> <span class="opt_lable">از روز ورود تا خروج</span>
            <input type="number"  name="hard_after_recive1" value="<?php echo $hard['hard_after_recive1'] ?>"><span class="mr10" > شب های سپری شده</span>
            <span>بعلاوه</span>
            <input type="number"  name="hard_after_recive2" value="<?php echo $hard['hard_after_recive2'] ?>"><span class="mr10" >  درصد شبهای باقی مانده</span>

        </label>
    </div>
    <span class="option_dashline"></span>
    <button type="submit" name="cancel_reserve_submit" class="cancel_reserve_submit">ذخیره</button>
</form>


