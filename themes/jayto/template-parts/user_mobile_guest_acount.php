<div class="mlogin_box">
    <p class="fz15 mbt15 fw400">ورود یا ثبت نام</p>
    <p class="fz13 mbt15 fw300">برای تجربه بهتر در روند رزرو اقامتگاه وارد شوید یا ثبت نام کنید.</p>
    <span class="monone_login login_but">ورود / ثبت نام</span>
</div>
<hr>
<div class="nl_item_box">
    <a href="<?php echo home_url(); ?>/contact_support" class="prb_menu_item">
        <span class="prb_icon"><i class="fa-regular fa-phone-alt"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">تماس با پشتیبانی</span>


        </div>
        <i class="fa fa-chevron-left col_gray"></i>
    </a>
</div>
<div class="nl_item_box">

    <a href="<?php echo home_url(); ?>/faq" class="prb_menu_item">
        <span class="prb_icon"><i class="fa-regular fa-question"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">پرسش های متداول</span>


        </div>
        <i class="fa fa-chevron-left col_gray"></i>
    </a>
</div>
<div class="nl_item_box">
    <a href="<?php echo home_url(); ?>/about-us" class="prb_menu_item">
        <span class="prb_icon"><i class="fa-regular fa-info"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">درباره ما</span>


        </div>
        <i class="fa fa-chevron-left col_gray"></i>
    </a>
</div>
<div class="nl_item_box">
    <a href="<?php echo home_url(); ?>/contact" class="prb_menu_item">
        <span class="prb_icon"><i class="fa-regular fa-phone"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">تماس با ما</span>


        </div>
        <i class="fa fa-chevron-left col_gray"></i>
    </a>
</div>
<div class="nl_item_box">
    <a href="<?php echo home_url(); ?>/mag" class="prb_menu_item">
        <span class="prb_icon"><i class="fa-regular fa-book"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">مجله ما</span>


        </div>
        <i class="fa fa-chevron-left col_gray"></i>
    </a>
</div>
<div class="nl_item_box">
    <a class="prb_menu_item" href="<?php echo $url = wp_logout_url( home_url() ); ?>">
        <span class="prb_icon m-0"><i class="fa-regular fa-portal-exit"></i></span>
        <div class="prb_menu_container">
            <span class="fz16 fw400 col_gray2">خروج از حساب کاربری</span>


        </div>

    </a>

</div>
<?php
get_footer();