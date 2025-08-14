
<?php
$easy=get_option('easy_cancel');
$medium=get_option('medium_cancel');
$hard=get_option('hard_cancel');
?>
<div class="crb_head">
    <h4>قوانین لغو رزرو آسان&nbsp;&nbsp;</h4>

</div>
<p class="cbz-t">  از لحظه رزرو تا 1 روز قبل از تاریخ ورود کل مبلغ رزرو بازگشت داده می‌شود.</p>

<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_green"></span>
        <span class="lbef_l bg_green"></span>
        <span class="lbef_b bg_green"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10 ">1 روز قبل از ورود مهمان</span>
        <span>پرداخت کامل وجه به مهمان</span>
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
        <span><?php echo $easy['easy_before_recive'] ?>٪ مبلغ شب اول  </span>
    </div>
</div>
<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_red"></span>
        <span class="lbef_l bg_red"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10">از روز ورود تا خروج مهمان</span>
        <span><?php echo $easy['easy_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $easy['easy_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
    </div>

</div>


<div class="crb_head">
    <h4>قوانین لغو رزرو میانه&nbsp;&nbsp;</h4>

</div>
<p class="cbz-t"> از لحظه رزرو تا 2 روز قبل از تاریخ ورود کل مبلغ رزرو بازگشت داده می‌شود.</p>

<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_green"></span>
        <span class="lbef_l bg_green"></span>
        <span class="lbef_b bg_green"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10 ">2 روز قبل از ورود مهمان</span>
        <span>پرداخت کامل وجه به مهمان</span>
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
        <span><?php echo $medium['medium_before_recive'] ?>٪ مبلغ شب اول  </span>
    </div>
</div>
<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_red"></span>
        <span class="lbef_l bg_red"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10">از روز ورود تا خروج مهمان</span>
        <span><?php echo $medium['medium_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $medium['medium_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
    </div>
</div>






<div class="crb_head">
    <h4>قوانین لغو رزرو سخت&nbsp;&nbsp;</h4>

</div>
<p class="cbz-t">از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard['hard_before_4day_recivee'] ?>٪ مبلغ شب اول و از لحظه رزرو تا ۴ روز قبل از تاریخ ورود <?php echo $hard['hard_4day_before_recive2'] ?>٪ مبلغ شب‌های باقیمانده کسر می‌گردد.</p>

<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_green"></span>
        <span class="lbef_l bg_green"></span>
        <span class="lbef_b bg_green"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10 ">4 روز قبل از ورود مهمان</span>
        <span><?php echo $hard['hard_before_4day_recivee'] ?>٪ مبلغ شب اول + <?php echo $hard['hard_4day_before_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
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
        <span><?php echo $hard['hard_before_recive1'] ?>٪ مبلغ شب اول + <?php echo $hard['hard_before_recive2'] ?>٪ مبلغ شب‌های باقیماند</span>
    </div>
</div>
<div class="cbc_item">
    <div class="cbc_i ">
        <span class="cbc_ic border_red"></span>
        <span class="lbef_l bg_red"></span>
    </div>
    <div class="cbc_c">
        <span class="mbt10">از روز ورود تا خروج مهمانن</span>
        <span><?php echo $hard['hard_after_recive1'] ?>٪ مبلغ شب‌های سپری شده + <?php echo $hard['hard_after_recive2'] ?>٪ مبلغ شب‌های باقیمانده</span>
    </div>

</div>



