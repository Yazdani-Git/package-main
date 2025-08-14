<?php
/* Template Name:cashTemplate */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
get_header('single');
$oid = $_POST['dataoi'];
$pt = 'residance';

$post_type = $_GET['pt'];
if ($post_type == 'hotel'){
    $pt = 'hotel';
}
update_order_pay_type($oid,$pt,'cash',11);
?>

    <div class="cpay_box">
        <p>رزرو شما با موفقیت ثبت شد ( پرداخت شما بصورت نقدی میباشد )</p>

        <div class="goto_box ">
            <a href="<?php  echo home_url()?>" class="ret_but">صفحه اصلی </a>
            <a href="<?php  echo home_url()?>/trips" class="ret_but">سفر های من</a>
        </div>
    </div>

<?php
get_footer();


