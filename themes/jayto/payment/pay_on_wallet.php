
<?php
/* Template Name: Wallet Pay */
get_header();
$url = home_url() . '/trips/';
?>
<div class="pay_err_box">
	<img src="<?php echo get_template_directory_uri() ?>/images/ok-icon.png" alt="">
	<span>پرداخت از کیف پول</span>
	<span>وجه رزرو شما با موفقیت پرداخت شد </span>


</div>
<div class="peb_link">
    <a href="<?php echo $url ?>">رفتن به سفرهای من</a>
    <a href="<?php echo home_url(); ?>">بازگشت به صفحه اصلی</a>
</div>
<?php
get_footer();