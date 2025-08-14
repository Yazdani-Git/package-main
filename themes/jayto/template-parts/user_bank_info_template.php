<span class="alert_box_close"><i class="dashicons dashicons-no-alt"></i></span>

<?php
//print_r($user_meta);
 $user_cart = $user_meta['user_cart'][0];
$user_shaba = $user_meta['user_shaba'][0];
 $user_bacount_name = $user_meta['user_bacount_name'][0];
 $bank_name = $user_meta['bank_name'][0];

?>
<div class="bac_box">
    <h4 >اطلاعات حساب درخواست کننده وجه</h4>
    <p>شماره کارت : <?php  echo $user_cart ;?></p>
    <p>شماره شبا : <?php  echo $user_shaba ;?></p>
    <p>نام صاحب حساب : <?php  echo $user_bacount_name ;?></p>
    <p>نام بانک : <?php  echo $bank_name ;?></p>
<div class="df3434">
    <p>   نام کاربر: <?php  echo $user_meta['first_name'][0]?></p>
    <p>   نام خانوادگی کاربر: <?php  echo $user_meta['last_name'][0]?></p>
    <p>   موبایل کاربر: <?php  echo $user_meta['user_mobile'][0]?></p>
</div>
</div>

