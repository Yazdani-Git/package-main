<div class="lb_logo" xmlns="http://www.w3.org/1999/html">
	<?php
	show_site_logo();
if (!wp_is_mobile()){?>
    <span class="log_box_close"><i class="fa fa-close"></i></span>
<?php }else{ ?>
    <a href="<?php echo home_url()?>/macount"><i class="fa-thin fa-arrow-alt-left fa-2x bactoac"></i> </a>
<?php }
	?>

</div>
<form action="#">
	<apna class="fz16 fw700 dfc">ورود یا ثبت نام </apna>
	<apna class="fz11 fw300 dfc col_gray2 mbt20">برای ورود  شماره همراه خود را وارد کنید</apna>
	<input type="number" name="tel_enter" class="tel_enter" placeholder="۰۹xxxxxxxxx">
	<span class="log_box_err"></span>
	<button type="submit" class="imn">ادامه</button>
</form>
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
</div>