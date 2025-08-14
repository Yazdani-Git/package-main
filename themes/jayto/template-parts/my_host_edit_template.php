<?php
/* Template Name:My Host Edit */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
if (!is_user_logged_in()) {
    exit; // Exit if accessed directly.
}
get_header('single');
$res_id = $_GET['ri'];
$meta = get_post_meta($res_id, '_all_res_meta', 'true');

//print_r($res_meta)
$args = array(
    'id' => $res_id,
    'orderby' => 'id',
    'order' => 'ASC',
    'post_type' => 'residence',
    'posts_per_page' => '-1'
);
$tour_enable = get_option('allow_add_theme_tour');
$allow_add_tour_hoster = get_option('allow_add_tour_hoster');
$residence = get_post($res_id);
$taxonomy = ['city', 'tools', 'region', 'categories'];
$city_term = get_the_terms($res_id, $taxonomy);
$term_ids = [];
foreach ($city_term as $row) {
    $term_ids[] = $row->term_id;

}
$thumbnail = get_the_post_thumbnail_url($res_id);

$post_id = $res_id;
$post = get_post($post_id, OBJECT, 'edit');
$content = $post->post_content;
$post_gallery_image = get_post_meta($res_id, 'gallery_data', 'true');

$user_role = '';
$rol = jayto_get_current_user_role();

if (in_array('host', $rol) or in_array('administrator', $rol)) {
    $user_role = 'host';
}
?>

<div class="profile_box">
    <?php
    if (!wp_is_mobile()) { ?>
        <div class="prb_menu">
            <div class="prb_menu_body">
                <div class="prb_menu_section">
                    <span class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">لیست سفرها و درخواست ها</span>
                            <a href="<?php echo home_url(); ?>/trips" class="fz11 fw300 col_gray mbt10 ">سفرهای من</a>
                            <?php
                            if ($tour_enable) { ?>
                                <a href="<?php echo home_url(); ?>/experiences" class="fz11 fw300 col_gray mbt10 "> تجربه های
                                    من</a>
                            <?php }
                            ?>
                            <?php
                            if ($user_role == 'host') {
                                ?>
                                <a href="<?php echo home_url(); ?>/host_request" class="fz11 fw300 col_gray mbt10 "> درخواست
                                    ها</a>
                                <a href="<?php echo home_url(); ?>/tour_reserve_request" class="fz11 fw300 col_gray mbt10 ">
                                    درخواست های رزرو تور</a>
                            <?php }
                            ?>

                            <span class="line_dash mbt10"></span>
                        </div>
                    </span>

                    <?php
                    if ($user_role == 'host') {
                        ?>
                        <span class="prb_menu_item active">
                            <span class="prb_icon"><i class="fa fa-shopping-bag"></i></span>
                            <div class="prb_menu_container active">
                                <span class="fz12 fw700 col_gray2 ">اقامت گاه های من</span>
                                <a href="<?php echo home_url(); ?>/my-host" class="fz11 fw300 col_gray mbt10 ">لیست اقامتگاه
                                </a>
                                <a href="<?php echo home_url(); ?>/add-host" class="fz11 fw300 col_gray mbt10 ">ثبت اقامتگاه
                                </a>
                                <span class="line_dash mbt10"></span>
                            </div>
                        </span>
                        <?php
                        $allow_add_hotel = get_option('allow_add_hotel');
                        if ($allow_add_hotel == 1) { ?>
                            <span class="prb_menu_item ">
                                <span class="prb_icon"><i class=" fas fa-hotel"></i></span>
                                <div class="prb_menu_container active">
                                    <span class="fz12 fw700 col_gray2 ">هتل های من</span>
                                    <a href="<?php echo home_url(); ?>/my-hotel" class="fz11 fw300 col_gray mbt10 ">لیست هتل ها </a>
                                    <a href="<?php echo home_url(); ?>/add_hotel" class="fz11 fw300 col_gray mbt10 ">ثبت هتل </a>
                                    <span class="line_dash mbt10"></span>
                                </div>
                            </span>
                        <?php }
                        ?>
                        <?php
                        if ($allow_add_tour_hoster == 1) { ?>
                            <span class="prb_menu_item ">
                                <span class="prb_icon"><i class="fa fa-tree"></i></span>
                                <div class="prb_menu_container active">
                                    <span class="fz12 fw700 col_gray2 ">تجربه های من</span>
                                    <a href="<?php echo home_url(); ?>/my-experiences" class="fz11 fw300 col_gray mbt10 ">لیست تجربه
                                        ها </a>
                                    <a href="<?php echo home_url(); ?>/add_experiences" class="fz11 fw300 col_gray mbt10 ">ثبت تجربه
                                    </a>
                                    <span class="line_dash mbt10"></span>
                                </div>
                            </span>
                        <?php }
                        ?>
                    <?php }
                    ?>

                    <a href="<?php echo home_url(); ?>/favorites" class="prb_menu_item">
                        <span class="prb_icon"><i class="fa fa-heart"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">موردعلاقه ها</span>
                            <span class="fz11 fw300 col_gray mbt10">لیست اقامتگاه های مورد علاعق</span>

                        </div>
                    </a>
                </div>
                <?php
                if ($user_role != 'host') {
                    ?>
                    <div class="prb_menu_section">
                        <p class="fz11 fw300 col_gray mbt10">میزبانی اقامتگاه</p>
                        <a href="#" class="prb_menu_item">
                            <span class="prb_icon"><i class="fa fa-exchange "></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">میزبان شوید</span>
                                <span class="fz11 fw300 col_gray mbt10">همین حالا اقامتگاه خود را ثبت کرده و کسب درآمد
                                    کنید.</span>

                            </div>
                        </a>
                    </div>
                <?php }
                ?>
                <div class="prb_menu_section">
                    <p class="fz11 fw300 col_gray mbt10">حساب کاربری</p>
                    <a href="<?php echo home_url(); ?>/account" class="prb_menu_item ">
                        <span class="prb_icon"><i class="fa fa-user-alt"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">اطلاعات حساب کاربری</span>
                            <span class="fz11 fw300 col_gray mbt10">مشاهده و ویرایش حساب کاربری</span>
                            <span class="line_dash mbt10"></span>
                        </div>

                    </a>
                    <a href="<?php echo home_url(); ?>/transaction" class="prb_menu_item">

                        <span class="prb_icon"><i class="fa fa-file-text "></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">تراکنش های من</span>
                            <span class="fz11 fw300 col_gray mbt10">مشاهده زمان و تاریخ تراکنش ها</span>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </a>
                    <a href="<?php echo home_url() ?>/password" class="prb_menu_item">
                        <span class="prb_icon"><i class="fa fa-key"></i></span>
                        <div class="prb_menu_container">
                            <span class="fz12 fw700 col_gray2">رمز عبور</span>
                            <span class="fz11 fw300 col_gray mbt10">تنظیم و تغییر رمز عبور</span>
                            <span class="line_dash mbt10"></span>
                        </div>
                    </a>
                    <div class="prb_menu_section">
                        <p class="fz11 fw300 col_gray mbt10">اعتبار</p>
                        <a href="<?php echo home_url(); ?>/wallet" class="prb_menu_item ">
                            <span class="prb_icon"><i class="fas fa-wallet"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">کیف پول</span>
                                <span class="fz11 fw300 col_gray mbt10">موجودی،افزایش اعتبار</span>

                            </div>
                        </a>
                        <a href="<?php echo home_url(); ?>/blocked wallet" class="prb_menu_item ">
                            <span class="prb_icon"><i class="fas fa-ban"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">مسدود شده ها</span>
                            </div>
                        </a>
                        <a href="<?php echo home_url(); ?>/request for payment" class="prb_menu_item ">
                            <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">درخواست وجه</span>


                            </div>
                        </a>
                        <a href="<?php echo home_url(); ?>/wallet requests" class="prb_menu_item ">
                            <span class="prb_icon"><i class="fas fa-credit-card"></i></span>
                            <div class="prb_menu_container">
                                <span class="fz12 fw700 col_gray2">لیست درخواست وجه</span>


                            </div>
                        </a>
                        <a href='<?php echo home_url(); ?>/user note' class='prb_menu_item '>
                            <span class='prb_icon'><i class="fa-solid fa-envelope"></i></span>
                            <div class='prb_menu_container'>
                                <span class='fz12 fw700 col_gray2'><?php echo _e('پیام ها', 'jayto') ?></span>
                                <span
                                    class='fz10 fw300 col_gray mbt10'><?php echo _e('مشاهده پیام های مدیریتی', 'jayto') ?></span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    <?php }
    ?>


    <div class="prb_content">
        <p class="fw700 fz15">ویرایش اقامتگاه</p>
        <div class="input_add_h">
            <span class="ip_title ">نام اقامتگاه</span>
            <input type="text" style="text-align: right;width: 97%;margin-bottom: 10px;"
                value="<?php echo $residence->post_title ?>" class="input_temp host_name_inp" autocomplete="off"
                placeholder="نام اقامتگاه">
        </div>
        <div class="input_add_h">
            <span class="ip_title">توضیحات اقامتگاه</span>
            <?php
            $content = $content;
            $custom_editor_id = "add_hd";
            $custom_editor_name = "add_host_description";
            $args = array(
                'media_buttons' => false, // This setting removes the media button.
                'textarea_name' => $custom_editor_name, // Set custom name.
                'textarea_rows' => get_option('default_post_edit_rows', 10), //Determine the number of rows.
                'quicktags' => false, // Remove view as HTML button.
            );
            wp_editor($content, $custom_editor_id, $args);
            $loyer = get_terms(array(
                'taxonomy' => 'loyer',
                'hide_empty' => false,
            ));

            ?>
        </div>

        <div class="input_add_h">
            <span class="ip_title">ویژگی های اقامتگاه</span>

            <div class='inside' xmlns="http://www.w3.org/1999/html">
                <p>
                    <label>متراژ زیربنا (متر) </label>
                    <input type="text" name="The_area_of_meter" value="<?php echo $meta['The_area_of_meter']; ?>" />
                </p>
                <p>
                    <label>متراژ کل بنا (متر) </label>
                    <input type="text" name="total_area_of_building_meter"
                        value="<?php echo $meta['total_area_of_building_meter']; ?>" />
                </p>
                <p>
                    <label>نوع اقامتگاه </label>
                    <?php
                    $type = $meta['residence_type'];
                    ?>
                    <select name="residence_type" class="w12em" id="residence_type">
                        <option value="shutter_type" <?php if ($type == 'shutter_type')
                            echo 'selected' ?>>دربست
                            </option>
                            <option value="shared_type" <?php if ($type == 'shared_type')
                            echo 'selected' ?>>اشتراکی
                            </option>
                        </select>
                    </p>
                    <p>
                        <label>نوع رزرو </label>
                        <?php
                        $type = $meta['reserve_type'];
                        ?>
                    <select name="reserve_type" class="w12em" id="reserve_type">
                        <option value="0" <?php if ($type == '0')
                            echo 'selected' ?>>قطعی
                            </option>
                            <option value="1" <?php if ($type == '1')
                            echo 'selected' ?>>نیاز به تایید
                            </option>
                        </select>
                    </p>
                    <p>
                        <label>انتخاب قوانین لغو </label>
                        <?php
                        $type = $meta['cancel_type'];
                        ?>
                    <select name="cancel_type" class="w12em" id="cancel_type">
                        <option value="easy" <?php if ($type == 'easy')
                            echo 'selected' ?>>آسان
                            </option>
                            <option value="medium" <?php if ($type == 'medium')
                            echo 'selected' ?>>متوسط
                            </option>
                            <option value="hard" <?php if ($type == 'hard')
                            echo 'selected' ?>>سخت
                            </option>
                        </select>
                        <span class="btn_view_low">مشاهده قوانین لغو</span>
                    <div class="view_low_box">
                        <div class="cbc_box">
                            <span class="cancel_box_close_form"><i class="fa fa-close"></i></span>
                        </div>
                        <?php

                        require get_template_directory() . '/template-parts/view_host_low_template.php';
                        ?>
                </div>
                </p>
                <div class="adr_row">
                    <label>ظرفیت پایه (نفر) </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="base_capacity"
                            value="<?php echo $meta['base_capacity']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>

                    </div>
                </div>
                <div class="adr_row">

                    <label>حداکثرظرفیت(ظرفیت پایه + نفر اضافه) </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="total_capacity"
                            value="<?php echo $meta['total_capacity']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>

                </div>
                <div class="adr_row">
                    <label>تعداد اتاق ها </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="number_room"
                            value="<?php echo $meta['number_room']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i>
                        </span>
                    </div>
                </div>
                <div class="adr_row">
                    <label>تعداد تخت های یک نفره </label>
                    <div class="pm_box">

                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="Single_bed"
                            value="<?php echo $meta['Single_bed']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <div class="adr_row">
                    <label>تعداد تخت های دو نفره </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="double_bed"
                            value="<?php echo $meta['double_bed']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <div class="adr_row">

                    <label>تعداد رختخواب سنتی(تشک) </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="mattress" value="<?php echo $meta['mattress']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <div class="adr_row">
                    <label>حمام </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="Bathroom" value="<?php echo $meta['Bathroom']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <div class="adr_row">
                    <label>سرویس بهداشتی ایرانی </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="iranian_toilet"
                            value="<?php echo $meta['iranian_toilet']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <div class="adr_row">
                    <label>سرویس بهداشتی فرنگی </label>
                    <div class="pm_box">
                        <span class="plus_i"><i class="fa fa-plus"></i></span>
                        <input type="number" class="w80i" name="sitting_toilet"
                            value="<?php echo $meta[0]['sitting_toilet']; ?>" />
                        <span class="minus_i"><i class="fa fa-minus"></i></span>
                    </div>
                </div>
                <p>
                    <label> قیمت (هر شب) برای روزهای عادی (تومان)</label>

                    <input type="number" name="price" value="<?php echo $meta['price']; ?>" />
                    <span class="res_inp_note">این قیمت برای تمامی روزهای عادی تقویم شما به مدت 60 روز اعمال خواهد شد.
                    </span>
                </p>
                <p>
                    <label> قیمت برای زورهای آخر هفته (تومان)</label>
                    <input type="number" name="end_week_price" value="<?php echo $meta['end_week_price']; ?>" />
                    <span class="res_inp_note">این قیمت برای تمامی روزهای آخر هفته تقویم شما به مدت 60 روز اعمال خواهد
                        شد. </span>
                </p>


                <p>
                    <label> قیمت برای نفرات اضافی (هرنفر تومان)</label>
                    <input type="number" name="extra_person" value="<?php echo $meta['extra_person']; ?>" />
                </p>
                <!-- Legacy date pickers (disabled). Kept as comment for rollback if needed)
                <p>
                  <div class="flex_row_box">
                    <p>
                      <script src=<?php echo get_template_directory_uri() ?>/js/v-datetime.js'></script>
                      <label>تعیین قیمت روی تقویم</label>
                      <div id="each_day_price"> ... </div>
                  </div>
                </p>
                <p>
                  <div id="dis_day"> ... </div>
                </p>
                <p>
                  <div id="return_day"> ... </div>
                </p>
                -->

                <p>
                <div id="host_date_manager" data-resid="<?php echo esc_attr($res_id); ?>">
                    <label class="fz13 hdpwcs" style="display:block;margin:12px 0 8px;">مدیریت پیشرفته تقویم (انتخاب مستقیم روزها، غیرفعال/فعال، تعیین قیمت)</label>
                    <?php
                    // Render two months like desktop calendar to get Jalali days with data-date attributes
                    include_once JAYTO_PLUGIN_PATH . '/Calender_desktop.php';
                    include_once JAYTO_PLUGIN_PATH . '/Calender_desktop2.php';
                    $price_date_map = get_post_meta($res_id, 'resistance_calender', true);
                    if (!is_array($price_date_map)) { $price_date_map = []; }
                    $reserved_list = get_post_meta($res_id, 'resistance_reserves', true);
                    if (!is_array($reserved_list)) { $reserved_list = []; }
                    $host_blocked_list = get_post_meta($res_id, 'host_blocked_dates', true);
                    if (!is_array($host_blocked_list)) { $host_blocked_list = []; }

                    $adm_cal1 = new Calendar_desktop();
                    if (method_exists($adm_cal1, 'set_reserved_dates')) { $adm_cal1->set_reserved_dates($reserved_list); }
                    if (method_exists($adm_cal1, 'set_host_blocked_dates')) { $adm_cal1->set_host_blocked_dates($host_blocked_list); }
                    if (method_exists($adm_cal1, 'set_id')) { $adm_cal1->set_id($res_id); }
                    foreach ($price_date_map as $k => $v) { $adm_cal1->add_event($v / 1000, $k); }

                    $next_month_base = date('Y-m-d', strtotime('+1 month'));
                    $exp_date = explode('-', $next_month_base);
                    list($m_year, $m_month, $m_day) = $exp_date;
                    $shamsi_date = gregorian_to_jalali($m_year, $m_month, $m_day);
                    $date_j = jalali_to_gregorian($shamsi_date[0], $shamsi_date[1], $shamsi_date[2], '-');
                    $adm_cal2 = new Calendar_desktop2($date_j);
                    if (method_exists($adm_cal2, 'set_reserved_dates')) { $adm_cal2->set_reserved_dates($reserved_list); }
                    if (method_exists($adm_cal2, 'set_host_blocked_dates')) { $adm_cal2->set_host_blocked_dates($host_blocked_list); }
                    if (method_exists($adm_cal2, 'set_id')) { $adm_cal2->set_id($res_id); }
                    foreach ($price_date_map as $k => $v) { $adm_cal2->add_event($v / 1000, $k); }
                    ?>
                    <div class="calender_box1"><?php echo $adm_cal1; ?></div>
                    <div class="calender_box2"><?php echo $adm_cal2; ?></div>

                    <div class="calendar-color-legend">
                        <h4 class="legend-title">راهنمای رنگ‌بندی تقویم</h4>
                        <div class="legend-items">
                            <div class="legend-item">
                                <div class="legend-color legend-available"></div>
                                <span>روزهای موجود (قابل انتخاب)</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-reserved"></div>
                                <span>روزهای رزرو شده</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-host-blocked"></div>
                                <span>روزهای مسدود توسط میزبان</span>
                            </div>
                            <div class="legend-item">
                                <div class="legend-color legend-unavailable">
                                    <span class="legend-x"></span>
                                </div>
                                <span>روزهای غیرمجاز/غیرفعال</span>
                            </div>
                        </div>
                    </div>

                    <div class="admin-cal-tools" style="display:flex;gap:10px;align-items:center;margin-top:10px;flex-wrap:wrap;">
                        <button type="button" class="btn-admin disable-selected" style="padding:8px 12px;border-radius:8px;background:#f56565;color:#fff;border:none;">غیرفعال کردن انتخاب‌ها</button>
                        <button type="button" class="btn-admin enable-selected" style="padding:8px 12px;border-radius:8px;background:#48bb78;color:#fff;border:none;">فعال کردن انتخاب‌ها</button>
                        <div class="price-tool" style="display:flex;gap:8px;align-items:center;">
                            <label>قیمت (تومان)</label>
                            <input type="number" class="admin-price-input" style="width:140px;padding:6px 8px;border:1px solid #e2e8f0;border-radius:8px;">
                            <button type="button" class="btn-admin set-price-selected" style="padding:8px 12px;border-radius:8px;background:#4299e1;color:#fff;border:none;">اعمال قیمت به انتخاب‌ها</button>
                        </div>
                        <span class="hint" style="color:#718096;">برای انتخاب چند تاریخ، روی روزها کلیک کنید (قابل انتخاب/لغو).</span>
                    </div>
                    <style>
                        /* Mobile-friendly layout */
                        @media (max-width: 768px){
                            #host_date_manager{padding:8px}
                            #host_date_manager .calendar{max-width:100%; width:100%}
                            #host_date_manager .calender_box1, #host_date_manager .calender_box2{display:block;width:100%}
                            #host_date_manager .admin-cal-tools{flex-direction:column;align-items:stretch}
                            #host_date_manager .price-tool{flex-wrap:wrap}
                            #host_date_manager .btn-admin{width:100%}
                        }
                        /* Selection highlight */
                        #host_date_manager .day_num.adm-selected{outline:2px solid #3182ce; box-shadow: 0 0 0 2px rgba(49,130,206,.2) inset}
                    </style>
                </div>
                </p>
                <p>
                    <label>ساعت ورود</label>
                    <select name="in_clock" class="w12em">

                        <?php
                        $in_saved = $meta['in_clock'];
                        for ($i = 1; $i <= 24; $i++) {
                            if ($i == $in_saved)
                                $selected = 'selected' ?>
                                <option <?php if ($i == $in_saved)
                                echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?>
                            </option>
                        <?php }
                        ?>
                    </select>
                </p>
                <p>
                    <label>ساعت خروج</label>
                    <select name="out_clock" class="w12em">
                        <?php

                        $out_saved = $meta['out_clock'];
                        for ($i = 1; $i <= 24; $i++) {
                            if ($i == $out_saved)
                                $select = 'selected' ?>

                                <option <?php if ($i == $out_saved)
                                echo 'selected' ?> value="<?php echo $i ?>"><?php echo $i ?>
                            </option>
                        <?php }
                        ?>

                    </select>
                </p>

                <p>

                <div class="up_feauture_imgage_box">
                    <div class="hdiv"><span class="mt_20 fz16">تصویر اصلی اقامتگاه.</span></div>

                    <form class="thumbnailUpload" enctype="multipart/form-data" <?php if ($thumbnail) { ?>
                            style="display: none" <?php } ?>>

                        <div class="thumbnail_form-group ">
                            <div class="error_upload_box"></div>
                            <img class="img_fe_upload"
                                src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                            <input type="file" id="file" accept="image/*" />
                            <input type="hidden" class="attach_url">
                        </div>
                    </form>
                    <div class="img_box_show">
                        <?php
                        if ($thumbnail) {
                            ?>

                            <div class="up_single_host_box"><img src="<?php echo $thumbnail ?>"><i class="fa fa-close"></i>
                            </div>
                        <?php }
                        ?>
                        <div class="rorp_not">
                            <span class="rorp_notic"></span>
                        </div>
                    </div>

                </div>


                </p>
                <p>
                <div class="up_feauture_imgage_box">
                    <div class="hdiv"><span class="mt_20 fz16">گالری تصاویر اقامتگاه.</span></div>

                    <form class="thumbnailUpload" enctype="multipart/form-data">

                        <div class="thumbnail_form-group">

                            <img class="img_fe_upload"
                                src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png" alt="">
                            <input type="file" multiple id="files" name="files[]" enctype="multipart/form-data"
                                accept="image/*" />
                            <input type="hidden" class="attach_url">
                        </div>
                    </form>
                    <div class="img_box_show_gall">

                        <?php
                        if ($post_gallery_image) {
                            foreach ($post_gallery_image['image_url'] as $row) { ?>
                                <div class="up_gall_host_box"><img src="<?php echo $row ?>"><i class="fa fa-close"></i></div>
                            <?php }

                        }
                        ?>
                        <div class="gup_not">
                            <span class="gup_notic"></span>
                        </div>
                    </div>

                </div>

                </p>


            </div>


        </div>

        <div class="input_add_h">
            <span class="ip_title">انتخاب شهر/استان</span>

            <input type="text" id="city-search-box" placeholder="نام شهر یا استان را وارد کنید..." class="search-input">

            <div class="term_drop">
                <ul id="city-list">
                    <?php
                    $terms = get_terms(array(
                        'taxonomy' => 'city',
                        'parent' => '0',
                        'hide_empty' => false,
                    ));
                    if (!is_wp_error($terms) && !empty($terms)) {
                        foreach ($terms as $term) { ?>
                            <li id="city-<?php echo $term->term_id ?>" class="eadf parent-term">
                                <label class="selectit fw700 fz13 city_pb">
                                    <input value="<?php echo $term->term_id ?>" type="checkbox" name="tax_input[city][]"
                                        id="in-city-<?php echo $term->term_id ?>">
                                    <?php echo $term->name ?>
                                </label>

                                <ul class="child-terms">
                                    <?php
                                    $terms_child = get_terms(array(
                                        'taxonomy' => 'city',
                                        'parent' => $term->term_id,
                                        'hide_empty' => false,
                                    ));
                                    foreach ($terms_child as $child) { ?>
                                        <li id="city-<?php echo $child->term_id ?>" class="child-term">
                                            <label class="selectit mbchild">
                                                <input value="<?php echo $child->term_id ?>" type="checkbox"
                                                    name="tax_input[city][]" id="in-city-<?php echo $child->term_id ?>">
                                                <?php echo $child->name ?>
                                            </label>
                                        </li>
                                    <?php } ?>
                                </ul>
                            </li>
                        <?php }
                    }
                    ?>
                </ul>
            </div>
        </div>

        <div class="input_add_h">
            <span class="ip_title">نوع اقامتگاه</span>
            <div class="term_drop_flex">

                <?php
                $terms_cat = get_terms(array(
                    'taxonomy' => 'categories',
                    'parent' => '0',
                    'hide_empty' => false,
                    'post_type' => 'residence',
                ));
                if (!is_wp_error($terms_cat) && !empty($terms_cat)) {
                    foreach ($terms_cat as $term) {
                        ?>
                        <?php
                        $terms_cat_child = get_terms(array(
                            'taxonomy' => 'categories',
                            'parent' => $term->term_id,
                            'hide_empty' => false,
                            'post_type' => 'residence',
                        ));
                        ?>

                        <?php
                        if ($terms_cat_child) {
                            if ($terms_cat_child) {
                                foreach ($terms_cat_child as $child) {

                                    ?>
                                    <div class="city_item">
                                        <div id="category-<?php echo $child->term_id ?>" class="citbox">
                                            <?php
                                            $cat_image = get_term_meta($child->term_id, 'term_image', true);
                                            ?>
                                            <img src="<?php echo $cat_image ?>" alt="">
                                            <label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox"
                                                    class="inpcheck" name="tax_input[categories][]"
                                                    id="in-city-<?php echo $child->term_id ?>" <?php if (in_array($child->term_id, $term_ids))
                                                           echo 'checked' ?>>
                                                </label>
                                            </div>

                                            <span><?php echo $child->name ?></span>
                                    </div>

                                <?php }
                            } else {
                                foreach ($terms_cat as $child) {

                                    ?>
                                    <div class="city_item">
                                        <div id="category-<?php echo $child->term_id ?>" class="citbox">
                                            <?php
                                            $cat_image = get_term_meta($child->term_id, 'term_image', true);
                                            ?>
                                            <img src="<?php echo $cat_image ?>" alt="">
                                            <label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox"
                                                    class="inpcheck" name="tax_input[categories][]"
                                                    id="in-city-<?php echo $child->term_id ?>" <?php if (in_array($child->term_id, $term_ids))
                                                           echo 'checked' ?>>
                                                </label>
                                            </div>

                                            <span><?php echo $child->name ?></span>
                                    </div>

                                <?php }
                            }
                        }


                        ?>

                    <?php }
                }
                if (!$terms_cat_child) {
                    foreach ($terms_cat as $child) {
                        ?>

                        <div class="city_item">
                            <div id="category-<?php echo $child->term_id ?>" class="citbox">
                                <?php
                                $cat_image = get_term_meta($child->term_id, 'term_image', true);
                                ?>
                                <img src="<?php echo $cat_image ?>" alt="">
                                <label class="selectit cb_chile "> <input value="<?php echo $child->term_id ?>" type="checkbox"
                                        class="inpcheck" name="tax_input[categories][]"
                                        id="in-city-<?php echo $child->term_id ?>">
                                </label>
                            </div>

                            <span><?php echo $child->name ?></span>
                        </div>


                    <?php }
                }
                ?>
            </div>

        </div>

        <div class="input_add_h">
            <span class="ip_title"> منطقه اقامتگاه</span>

            <div class="term_drop_flex">
                <?php
                $terms_region = get_terms(array(
                    'taxonomy' => 'region',
                    'parent' => '0',
                    'hide_empty' => false,
                    'post_type' => 'residence',
                ));
                if (!is_wp_error($terms_region) && !empty($terms_region)) {
                    foreach ($terms_region as $term) {

                        ?>
                        <div class="city_item">
                            <div id="city-<?php echo $term->term_id ?>" class="citbox">
                                <?php
                                $cat_image = get_term_meta($term->term_id, 'term_image', true);
                                ?>
                                <img src="<?php echo $cat_image ?>" alt="">
                                <label class="selectit cb_chile "> <input value="<?php echo $term->term_id ?>" type="checkbox"
                                        <?php if (in_array($term->term_id, $term_ids))
                                            echo 'checked' ?> class="inpcheck"
                                            name="tax_input[region][]" id="in-city-<?php echo $term->term_id ?>">
                                </label>
                            </div>

                            <span><?php echo $term->name ?></span>
                        </div>


                    <?php }
                }
                ?>

            </div>


        </div>
        <div class="input_add_h">
            <span class="ip_title">امکانات اقامتگاه</span>

            <div class="term_drop_flex">
                <?php
                $terms_tools = get_terms(array(
                    'taxonomy' => 'tools',
                    'parent' => '0',
                    'hide_empty' => false,
                    'post_type' => 'residence',
                ));
                if (!is_wp_error($terms_cat) && !empty($terms_cat)) {
                    foreach ($terms_tools as $term) {

                        ?>
                        <div class="city_item">
                            <div id="city-<?php echo $term->term_id ?>" class="citbox">
                                <?php
                                $tools_image = get_term_meta($term->term_id, 'term_image', true);
                                ?>
                                <img style="width: 35px;height: 35px;border-radius: 7px;object-fit: none;"
                                    src="<?php echo $tools_image ?>" alt="">
                                <label class="selectit cb_chile "> <input value="<?php echo $term->term_id ?>" type="checkbox"
                                        <?php if (in_array($term->term_id, $term_ids))
                                            echo 'checked' ?> class="inpcheck"
                                            name="tax_input[tools][]" id="in-city-<?php echo $term->term_id ?>">
                                </label>
                            </div>

                            <span><?php echo $term->name ?></span>
                        </div>


                    <?php }
                }
                ?>

            </div>


        </div>
        <div class="input_add_h">
            <span class="ip_title ">آدرس اقامتگاه</span>

            <input type="text" style="width: 96%;margin-bottom: 20px;text-align: right" name="res_address"
                value="<?php echo $meta['res_address']; ?>" class="input_temp host_name_inp" autocomplete="off"
                value="<?php echo $meta[0]['res_address']; ?>">
        </div>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css"
            integrity="sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=" crossorigin="" />
        <script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"
            integrity="sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=" crossorigin=""></script>
        <script src="//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js"></script>
        <div class="input_add_h">
            <span class="ip_title ">نقشه اقامتگاه</span>
            <div id="add_host_map">
            </div>
            <style>
                #add_host_map {
                    height: 300px;
                    border-radius: 12px;
                    margin: 20px 0;
                    width: 96%;
                }
            </style>

            <script>
                <?php
                if ($meta['map_point_lat'] == '') {
                    $bsmlat = get_option('bsmlat');
                    $bsmlang = get_option('bsmlang');
                    $lat = $bsmlat;
                    $lng = $bsmlang;
                    if (!$lat) {
                        $lat = 35.7009;
                    }
                    if (!$lng) {
                        $lng = 51.3912;
                    }
                } else {
                    $lat = $meta['map_point_lat'];
                    $lng = $meta['map_point_lng'];
                }

                ?>
                var greenIcon = L.icon({
                    iconUrl: '<?php echo get_template_directory_uri(); ?>/images//pointssv.svg',
                    shadowUrl: 'leaf-shadow.png',
                    iconSize: [90, 90], // size of the icon
                    shadowSize: [50, 64], // size of the shadow
                    iconAnchor: [22, 94], // point of the icon which will correspond to marker's location
                    shadowAnchor: [4, 62],  // the same for the shadow
                    popupAnchor: [-3, -76] // point from which the popup should open relative to the iconAnchor


                });
                let map = L.map('add_host_map').setView([<?php echo $lat ?>, <?php echo $lng ?>], 15);
                L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {

                    attribution: '',
                }).addTo(map);
                map.addControl(L.control.search({ position: 'topright' }));
                let marker;
                marker = new L.marker([<?php echo $lat ?>, <?php echo $lng ?>], { draggable: 'true' }).addTo(map);
                marker.on('dragend', function (e) {
                    var latlng = marker.getLatLng();
                    jQuery('.map_point_lat').val(latlng.lat)
                    jQuery('.map_point_lng').val(latlng.lng)
                });
            </script>
            <input type="hidden" name="map_point_lat" class="map_point_lat " checked <?php if ($lat) { ?>
                    value="<?php echo $lat ?>" <?php } ?>>
            <input type="hidden" name="map_point_lng" class="map_point_lng" <?php if ($lat) { ?>
                    value="<?php echo $lng ?>" <?php } ?>>
        </div>
        <div class="input_add_h">
            <span class="ip_title ">قوانین اقامتگاه</span>
            <div class="other_plans">
                <?php
                foreach ($loyer as $row) {

                    ?>
                    <div class="od_box">
                        <input type="checkbox" name="od_loyer[]" value="<?php echo $row->term_id; ?>" <?php if ($meta['od_loyer'] != '') {
                               if (in_array($row->term_id, $meta['od_loyer'])) {
                                   echo "checked";
                               }
                           } ?> />
                        </label><?php echo $row->name; ?> <label>
                    </div>
                <?php }
                ?>
            </div>


        </div>


        <div class="up_feauture_imgage_box">
            <div class="hdiv"><span class="mt_20 fz16"> تصویر کارت ملی خود را آپلود نمایید (شما باید مالک یا نماینده
                    قانونی ملک باشید).</span></div>
            <form class="thumbnailUpload" enctype="multipart/form-data" <?php if ($meta['meli_pic']) { ?>
                    style="display: none" <?php } ?>>

                <div class="thumbnail_form-group">

                    <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png"
                        alt="">
                    <input type="file" id="melli_file" accept="image/*" />
                    <input type="hidden" class="attach_url">
                </div>
            </form>
            <div class="img_meli_show">
                <?php
                if ($meta['meli_pic']) { ?>

                    <div class="up_meli_host_box"><img src="<?php echo $meta['meli_pic'] ?>"><i class="fa fa-close"></i>
                    </div>
                <?php }
                ?>
            </div>

        </div>
        <div class="up_feauture_imgage_box">
            <div class="hdiv"><span class="mt_20 fz16">سند ملک یا قبض برق یا مجوز گردشگری اقامتگاه را بارگذاری
                    نمایید.</span></div>
            <form class="thumbnailUpload" enctype="multipart/form-data">

                <div class="thumbnail_form-group">

                    <img class="img_fe_upload" src="<?php echo get_template_directory_uri() ?>/images/camera-icon.png"
                        alt="">
                    <input type="file" multiple id="madarek_files" name="files[]" enctype="multipart/form-data"
                        accept="image/*" />
                    <input type="hidden" class="attach_url">
                </div>
            </form>
            <div class="madarek_box_show_gall">
                <?php
                if ($meta['madarek_urls']) {
                    foreach ($meta['madarek_urls'] as $row) { ?>
                        <div class="up_gall_host_box_larg"><img src="<?php echo $row ?>"><i class="fa fa-close"></i></div> <?php }

                }
                ?>
            </div>

        </div>

        <span id="host_update_post_btn">ذخیره</span>
    </div>


</div>
<script type="application/javascript">
    // Legacy Vue date pickers removed (kept as comment above). All date ops now via #host_date_manager.
</script>
<?php
get_footer();