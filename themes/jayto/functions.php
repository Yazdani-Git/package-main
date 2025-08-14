<?php
if(!defined("_S_VERSION")) {
    define("_S_VERSION", "1.0.0");
}
$sms_info = get_option("sms_enter_info");
define("sms_samaneh_name", $sms_info["sms_samaneh_name"]);
define("sms_username", $sms_info["sms_username"]);
define("sms_password", $sms_info["sms_password"]);
define("sms_opt", $sms_info["sms_opt"]);
define("sms_host_need", $sms_info["sms_host_need"]);
define("sms_send_line", $sms_info["sms_send_line"]);
define("modir_phone", $sms_info["sms_admin"]);
define("sms_adm_tour_request", $sms_info["sms_adm_tour_request"]);
define("sms_user_register_to_admin", $sms_info["sms_user_register_to_admin"]);
define("sms_user_register", $sms_info["sms_user_register"]);
define("sms_host_reserve_to_admin", $sms_info["sms_host_reserve_to_admin"]);
define("sms_host_reserve_to_host", $sms_info["sms_host_reserve_to_host"]);
define("sms_host_reserve_to_Guest", $sms_info["sms_host_reserve_to_Guest"]);
define("sms_hotel_reserve_to_admin", $sms_info["sms_hotel_reserve_to_admin"]);
define("sms_hotel_reserve_to_host", $sms_info["sms_hotel_reserve_to_host"]);
define("sms_hotel_reserve_to_guest", $sms_info["sms_hotel_reserve_to_guest"]);
define("sms_tour_reserve_to_admin", $sms_info["sms_tour_reserve_to_admin"]);
define("sms_tour_reserve_to_host", $sms_info["sms_tour_reserve_to_host"]);
define("sms_tour_reserve_to_guest", $sms_info["sms_tour_reserve_to_guest"]);
define("sms_submit_comment_to_admin", $sms_info["sms_submit_comment_to_admin"]);
define("sms_user_send_ticket", $sms_info["sms_user_send_ticket"]);
define("sms_modir_answer_ticket", $sms_info["sms_modir_answer_ticket"]);
define("sms_cart_need_conf_to_hoster", $sms_info["sms_cart_need_conf_to_hoster"]);
define("sms_cart_need_conf_to_guest", $sms_info["sms_cart_need_conf_to_guest"]);
define("sms_reserve_need_conf_to_guest", $sms_info["sms_reserve_need_conf_to_guest"]);
define("sms_cash_need_conf_to_guest", $sms_info["sms_cash_need_conf_to_guest"]);
add_filter("upload_mimes", "enable_svg_upload", 10, 1);
add_action("after_setup_theme", "remove_admin_bar");
add_action("after_setup_theme", "jayto_setup");
add_action("after_setup_theme", "jayto_content_width", 0);
add_action("widgets_init", "jayto_widgets_init");
add_action("wp_enqueue_scripts", "jayto_scripts");
add_action("init", "my_init");
require get_template_directory() . "/inc/custom-header.php";
if(is_admin()) {
    require get_template_directory() . "/inc/admin_function.php";
}
require get_template_directory() . "/inc/template-tags.php";
require get_template_directory() . "/inc/template-functions.php";
require get_template_directory() . "/inc/customizer.php";
if(defined("JETPACK__VERSION")) {
    require get_template_directory() . "/inc/jetpack.php";
}
add_filter("elementor/fonts/groups", function ($font_groups) {
    $font_groups["jayto_fonts"] = __("فونت های جایتو");
    return $font_groups;
});
add_filter("elementor/fonts/additional_fonts", function ($additional_fonts) {
    $additional_fonts["IRANYekan"] = "jayto_fonts";
    $additional_fonts["gandom"] = "jayto_fonts";
    $additional_fonts["parastoo"] = "jayto_fonts";
    $additional_fonts["sahel"] = "jayto_fonts";
    $additional_fonts["samin"] = "jayto_fonts";
    $additional_fonts["tanha"] = "jayto_fonts";
    $additional_fonts["vazir"] = "jayto_fonts";
    return $additional_fonts;
});
add_action("wp_ajax_nopriv_get_ajax_city_search", "get_ajax_city_search_func");
add_action("wp_ajax_get_ajax_city_search", "get_ajax_city_search_func");
add_action("admin_enqueue_scripts", "image_uploader_enqueue");
add_action("init", "custom_post_type", 0);
add_action("init", "custom_taxonomy", 0);
add_action("init", "residence_tools_tax", 0);
add_action("init", "residence_region_tax", 0);
add_action("init", "residence_loyer_tax", 0);
add_action("add_meta_boxes", "residence_meta_box");
add_action("save_post_residence", "residence_save_meta_boxes_data", 10, 2);
add_action("categories_add_form_fields", "add_term_image", 10, 2);
add_action("tour_tools_add_form_fields", "add_term_image", 10, 2);
add_action("hotel_category_add_form_fields", "add_term_image", 10, 2);
add_action("tour_category_add_form_fields", "add_term_image", 10, 2);
add_action("hotel_tools_add_form_fields", "add_term_image", 10, 2);
add_action("city_hotel_add_form_fields", "add_term_image", 10, 2);
add_action("tools_add_form_fields", "add_term_image", 10, 2);
add_action("region_add_form_fields", "add_term_image", 10, 2);
add_action("city_add_form_fields", "add_term_image", 10, 2);
add_action("created_categories", "save_term_image", 10, 2);
add_action("created_hotel_category", "save_term_image", 10, 2);
add_action("created_tour_tools", "save_term_image", 10, 2);
add_action("created_tour_category", "save_term_image", 10, 2);
add_action("created_hotel_tools", "save_term_image", 10, 2);
add_action("created_city_hotel", "save_term_image", 10, 2);
add_action("created_tools", "save_term_image", 10, 2);
add_action("created_region", "save_term_image", 10, 2);
add_action("created_city", "save_term_image", 10, 2);
add_action("categories_edit_form_fields", "edit_image_upload", 10, 2);
add_action("hotel_category_edit_form_fields", "edit_image_upload", 10, 2);
add_action("tour_tools_edit_form_fields", "edit_image_upload", 10, 2);
add_action("tour_category_edit_form_fields", "edit_image_upload", 10, 2);
add_action("hotel_tools_edit_form_fields", "edit_image_upload", 10, 2);
add_action("city_hotel_edit_form_fields", "edit_image_upload", 10, 2);
add_action("tools_edit_form_fields", "edit_image_upload", 10, 2);
add_action("region_edit_form_fields", "edit_image_upload", 10, 2);
add_action("city_edit_form_fields", "edit_image_upload", 10, 2);
add_action("edited_categories", "update_image_upload", 10, 2);
add_action("edited_hotel_category", "update_image_upload", 10, 2);
add_action("edited_tour_tools", "update_image_upload", 10, 2);
add_action("edited_hotel_tools", "update_image_upload", 10, 2);
add_action("edited_tour_category", "update_image_upload", 10, 2);
add_action("edited_city_hotel", "update_image_upload", 10, 2);
add_action("edited_tools", "update_image_upload", 10, 2);
add_action("edited_region", "update_image_upload", 10, 2);
add_action("edited_city", "update_image_upload", 10, 2);
add_action("admin_init", "property_gallery_add_metabox");
add_image_size("slider", 300, 200, false);
add_action("admin_init", "hotel_gallery_add_metabox");
add_action("admin_init", "property_melicart_add_metabox");
add_action("admin_head-post.php", "property_gallery_styles_scripts");
add_action("admin_head-post-new.php", "property_gallery_styles_scripts");
add_action("save_post", "property_gallery_save");
include "jdf.php";
add_action("wp_ajax_calc_reserve_price", "calc_reserve_price");
add_action("wp_ajax_nopriv_calc_reserve_price", "calc_reserve_price");
add_action("wp_ajax_calculate_reserve_price", "calculate_reserve_price_enhanced");
add_action("wp_ajax_nopriv_calculate_reserve_price", "calculate_reserve_price_enhanced");
date_default_timezone_set("Asia/Tehran");
add_action("wp_ajax_calender_next_month", "calender_next_month_func");
add_action("wp_ajax_nopriv_calender_next_month", "calender_next_month_func");
add_action("wp_ajax_calender_prev_month", "calender_prev_month_func");
add_action("wp_ajax_nopriv_calender_prev_month", "calender_prev_month_func");
add_action("wp_ajax_get_archive_search", "get_archive_search_func");
add_action("wp_ajax_nopriv_get_archive_search", "get_archive_search_func");
add_action("elementor/frontend/after_enqueue_styles", function () {
    wp_dequeue_style("font-awesome");
});
add_action("wp_ajax_get_archive_filter", "get_archive_filter_func");
add_action("wp_ajax_nopriv_get_archive_filter", "get_archive_filter_func");
add_action("wp_ajax_add_remove_favorite", "add_remove_favorite_func");
add_action("wp_ajax_remove_favo_page", "remove_favo_page_func");
add_action("wp_ajax_nopriv_send_mobile_to_check", "send_mobile_to_check_func");
add_action("wp_ajax_nopriv_refresh_opt", "refresh_op_func");
add_action("wp_ajax_nopriv_check_opt", "check_opt_func");
add_action("wp_ajax_nopriv_get_register_template", "get_register_template_func");
add_action("wp_ajax_nopriv_create_user_one", "create_user_one_func");
add_action("wp_ajax_nopriv_direct_login", "direct_login_func");
add_action("wp_ajax_nopriv_pass_login", "pass_login_func");
add_action("wp_ajax_change_user_password", "change_user_password_func");
add_action("wp_ajax_update_user_info", "update_user_info_func");
add_action("wp_ajax_file_upload_user_image", "file_upload_user_image_callback");
add_action("wp_ajax_reload_user_image", "reload_user_image_func");
add_action("wp_ajax_remove_reserve_date", "remove_reserve_date");
add_action("wp_ajax_get_rooms_hotel", "get_rooms_hotel_func");
add_action("wp_ajax_nopriv_get_rooms_hotel", "get_rooms_hotel_func");
add_action("wp_ajax_change_order_ststus", "change_order_ststus_func");
add_action("wp_ajax_remove_hotels_rooms", "remove_hotels_rooms_func");
add_action("wp_ajax_get_reserve_submit", "get_reserve_submit_func");
add_action("wp_ajax_get_hreserve_submit", "get_hreserve_submit_func");
add_action("wp_ajax_get_pay_wallet", "get_pay_wallet_func");
add_action("wp_ajax_set_sans_mobile", "set_sans_mobile");
add_action("wp_ajax_set_residence_dprice", "set_residence_dprice_func");
add_action("wp_ajax_set_residence_custom_reserve", "set_residence_custom_reserve_func");
add_action("wp_ajax_custom_reserve_return", "custom_reserve_return_func");
add_action("wp_ajax_get_res_map", "get_res_map_func");
add_action("wp_ajax_get_hres_map", "get_hres_map_func");
add_action("wp_ajax_get_res_low", "get_res_low_func");
add_action("wp_ajax_calc_res_cancel", "calc_res_cancel_func");
add_action("wp_ajax_pay_from_wallet", "pay_from_wallet_func");
add_action("wp_ajax_custom_insert_post", "custom_insert_post_func");
add_action("wp_ajax_custom_post_update", "custom_post_update_func");
add_action("wp_ajax_file_upload", "file_upload_callback");
add_action("wp_ajax_Receipt_upload", "Receipt_upload_callback");
add_action("wp_ajax_file_uploads", "file_uploads_callback");
add_action("wp_ajax_change_user_rol_host", "change_user_rol_host_callback");
add_action("categories_add_form_fields", "add_term_ico", 10, 2);
add_action("created_categories", "save_term_ico", 10, 2);
add_action("categories_edit_form_fields", "edit_ico_upload", 10, 2);
add_action("edited_categories", "update_ico_upload", 10, 2);
add_filter("manage_post_posts_columns", "set_custom_edit_book_columns");
add_filter("cron_schedules", "isa_add_every_three_minutes");
if(!wp_next_scheduled("isa_add_every_three_minutes")) {
    wp_schedule_event(time(), "every_three_minutes", "isa_add_every_three_minutes");
}
add_action("isa_add_every_three_minutes", "every_three_minutes_event_func");
add_action("login_enqueue_scripts", "my_login_stylesheet");
add_action("wp_ajax_add_site_map", "add_site_map_func");
add_action("init", "custom_category", 0);
add_filter("excerpt_length", "wpdocs_custom_excerpt_length", 250);
add_filter("excerpt_more", "wpdocs_excerpt_more");
add_action("admin_menu", "jayto_notification");
$hotel_enable = get_option("hotel_enable");
$tour_enable = get_option("allow_add_theme_tour");
if($hotel_enable == 1) {
    require_once get_template_directory() . "/inc/hotel_post_type.php";
    add_action("wp_ajax_set_room_dprice", "set_room_dprice_func");
    function set_room_dprice_func()
    {
        $dates = $_POST["dates"];
        $price = $_POST["price"];
        $pid = $_POST["pid"];
        $room_id = $_POST["room_id"];
        $mk = "hotel_calender" . $room_id;
        $odprice = "hot_day_price" . $room_id;
        $old_calender = get_post_meta($pid, $mk, true);
        $date_exp = explode(" ~ ", $dates);
        $old_room_dprice = get_post_meta($pid, $odprice, true);
        if($odprice == "") {
            $odprice = [];
        }
        foreach ($date_exp as $row) {
            if(key_exists($row, $old_calender)) {
                $old_calender[$row] = $price;
            }
            $old_room_dprice[$row] = $price;
        }
        update_post_meta($pid, $mk, $old_calender);
        update_post_meta($pid, $odprice, $old_room_dprice);
        exit(0);
    }
}
if($tour_enable == 1) {
    require_once get_template_directory() . "/inc/tour_post_type.php";
}
add_action("wp_ajax_nopriv_get_post_search_link", "get_post_search_link_func");
add_action("wp_ajax_get_post_search_link", "get_post_search_link_func");
add_filter("posts_where", "wpse18703_posts_where", 10, 2);
add_action("wp_ajax_check_last_day_reserve", "check_last_day_reserve_func");
add_action("wp_ajax_nopriv_check_last_day_reserve", "check_last_day_reserve_func");
add_action("wp_ajax_calender_next_cmonth", "calender_next_cmonth_func");
add_action("wp_ajax_nopriv_calender_next_cmonth", "calender_next_cmonth_func");
add_action("wp_ajax_calender_prev_cmonth", "calender_prev_cmonth_func");
add_action("wp_ajax_nopriv_calender_prev_cmonth", "calender_prev_cmonth_func");
add_action("wp_ajax_insert_comments", "insert_comments_func");
add_action("wp_ajax_nopriv_insert_comments", "insert_comments_func");
add_action("wp_ajax_update_comm_answer", "update_comm_answer_func");
add_action("wp_ajax_update_comments_by_attr", "update_comments_by_attr_func");
add_action("wp_ajax_add_ticket", "add_ticket");
add_action("wp_ajax_add_ticket_answer_to_answer", "add_ticket_answer_to_answer");
add_action("wp_ajax_nopriv_get_ajax_paginate_post", "get_ajax_paginate_post_func");
add_action("wp_ajax_get_ajax_paginate_post", "get_ajax_paginate_post_func");
add_action("wp_ajax_nopriv_get_ajax_next_paginate_post", "get_ajax_next_paginate_post_func");
add_action("wp_ajax_get_ajax_next_paginate_post", "get_ajax_next_paginate_post_func");
add_action("wp_ajax_nopriv_get_ajax_prev_paginate_post", "get_ajax_prev_paginate_post_func");
add_action("wp_ajax_get_ajax_prev_paginate_post", "get_ajax_prev_paginate_post_func");
add_action("wp_ajax_insert_cart_info_to_table", "insert_cart_info_to_table_func");
add_action("wp_ajax_user_change_order_status", "user_change_order_status_func");
add_action("wp_ajax_is_user_logged_in", "ajax_check_user_logged_in");
add_action("wp_ajax_nopriv_is_user_logged_in", "ajax_check_user_logged_in");
add_action("admin_menu", "residence_discount_menu");
add_action("admin_menu", "hotel_discount_menu");
add_action("wp_ajax_calender_desk_next_month", "calender_desk_next_month_func");
add_action("wp_ajax_nopriv_calender_desk_next_month", "calender_desk_next_month_func");
add_action("wp_ajax_calender_desk2_next_month", "calender_desk2_next_month_func");
add_action("wp_ajax_nopriv_calender_desk2_next_month", "calender_desk2_next_month_func");
add_action("wp_ajax_refresh_host_date_manager", "refresh_host_date_manager");
add_action("wp_ajax_rebuild_resistance_calender", "rebuild_resistance_calender");
add_action("wp_ajax_get_add_user_tour_exp_template", "get_add_user_tour_exp_template_func");
add_action("wp_ajax_user_add_tour_variable", "user_add_tour_variable_func");
add_action("wp_ajax_user_update_tour_variable", "user_update_tour_variable_func");
add_action("wp_ajax_user_remove_tour_variable", "user_remove_tour_variable_func");
add_action("wp_ajax_set_cookies", "set_cookies_func");
add_action("wp_ajax_nopriv_set_cookies", "set_cookies_func");
add_action("wp_ajax_nopriv_get_room_img", "get_room_img_func");
add_action("wp_ajax_get_room_img", "get_room_img_func");
add_action("wp_ajax_rooms_upload_images_hoster", "rooms_upload_images_hoster_func");
add_action("wp_ajax_hos_delete_rooms_image", "hos_delete_rooms_image_callback");
add_action("wp_ajax_get_my_option", "get_my_option_callback");
add_action("wp_ajax_set_selected_date", "set_selected_date_callback");
add_action("wp_ajax_nopriv_set_selected_date", "set_selected_date_callback");
add_action("wp_ajax_set_selected_date_out", "set_selected_date_out_callback");
add_action("wp_ajax_nopriv_set_selected_date_out", "set_selected_date_out_callback");
add_action("wp_ajax_calcs_reserve_price", "calcs_reserve_price");
add_action("wp_ajax_nopriv_calcs_reserve_price", "calcs_reserve_price");
add_action("wp_head", function () {
    echo "    <script type=\"text/javascript\">\n        var ajaxurl = \"";
    echo admin_url("admin-ajax.php");
    echo "\";\n    </script>\n    ";
});
function enable_svg_upload($upload_mimes)
{
    $upload_mimes["svg"] = "image/svg+xml";
    $upload_mimes["svgz"] = "image/svg+xml";
    return $upload_mimes;
}
function remove_admin_bar()
{
    if(!current_user_can("administrator") && !is_admin()) {
        show_admin_bar(false);
    }
}
function jayto_setup()
{
    load_theme_textdomain("jayto", get_template_directory() . "/languages");
    add_theme_support("automatic-feed-links");
    add_theme_support("title-tag");
    add_theme_support("post-thumbnails");
    function test_add_image_sizes()
    {
        add_image_size("slider", 300, 170, false);
    }
    add_action("after_theme_setup", "test_add_image_sizes");
    register_nav_menus(["menu-1" => esc_html__("Primary", "jayto")]);
    add_theme_support("html5", ["search-form", "comment-form", "comment-list", "gallery", "caption", "style", "script", "post-thumbnails"]);
    add_theme_support("custom-background", apply_filters("jayto_custom_background_args", ["default-color" => "ffffff", "default-image" => ""]));
    add_theme_support("customize-selective-refresh-widgets");
    add_role("host", "میزبان");
    add_action("wp_head", "jayto_get_current_user_role");
    function jayto_get_current_user_role()
    {
        if(is_user_logged_in()) {
            $user = wp_get_current_user();
            $roles = (array) $user->roles;
            return $roles;
        }
        return [];
    }
    add_theme_support("custom-logo", ["height" => 250, "width" => 250, "flex-width" => true, "flex-height" => true]);
}
function jayto_content_width()
{
    $GLOBALS["content_width"] = apply_filters("jayto_content_width", 640);
}
function jayto_widgets_init()
{
    register_sidebar(["name" => esc_html__("Sidebar", "jayto"), "id" => "sidebar-1", "description" => esc_html__("Add widgets here.", "jayto"), "before_widget" => "<section id=\"%1\$s\" class=\"widget %2\$s\">", "after_widget" => "</section>", "before_title" => "<h2 class=\"widget-title\">", "after_title" => "</h2>"]);
}
function jayto_scripts()
{
    wp_enqueue_style("fa6", get_template_directory_uri() . "/fonts/all.css", [], rand(), "all");
    wp_enqueue_style("jayto-style", get_template_directory_uri() . "/css/style.css", [], rand());
    wp_enqueue_style("jayto-responsive", get_template_directory_uri() . "/css/responsive.css", [], rand(), "all");
    wp_enqueue_script("timer_scripts", get_template_directory_uri() . "/js/jquery-backward-timer.src.js", [], rand(), false);
    wp_enqueue_script("host_uploader_scripts", get_template_directory_uri() . "/js/imageuploadify.js", [], rand(), true);
    wp_enqueue_script("jayto_scripts", get_template_directory_uri() . "/js/theme.js", [], rand(), true);
    if(!is_singular("residence")) {
        wp_enqueue_style("calendar-improvements", get_template_directory_uri() . "/css/calendar-improvements.css", [], rand(), "all");
        wp_enqueue_script("v-datetime", get_template_directory_uri() . "/js/v-datetime.js", [], rand(), false);
        wp_enqueue_script("calendar-enhancements", get_template_directory_uri() . "/js/calendar-enhancements.js", ['jquery'], rand(), true);
        wp_localize_script("calendar-enhancements", "jayto_ajax", [
            "ajax_url" => admin_url("admin-ajax.php"),
            "nonce" => wp_create_nonce("jayto_ajax_nonce"),
            "site_url" => get_option("siteurl")
        ]);
    }
    if(did_action("elementor/loaded")) {
        wp_enqueue_script("swiper");
        wp_enqueue_style("swiper");
    }
    wp_localize_script("jayto_scripts", "ajax_data", ["aju" => admin_url("admin-ajax.php"), "bank_request_info" => get_option("bareqinf"), "siteurl" => get_option("siteurl"), "security" => wp_create_nonce("file_upload"), "security2" => wp_create_nonce("file_uploads"), "security3" => wp_create_nonce("Receipt_upload"), "turl" => home_url()]);
}
function my_init()
{
    if(!is_admin()) {
        wp_deregister_script("jquery");
        wp_register_script("jquery", "/wp-includes/js/jquery/jquery.js", false);
        wp_enqueue_script("jquery");
    }
}
function get_ajax_city_search_func()
{
    $city = $_POST["city"];
    $terms = get_terms(["taxonomy" => "city", "hide_empty" => false]);
    $match_term = [];
    $math_city = [];
    $sub_state = [];
    $sta = [];
    $mach_test = "";
    foreach ($terms as $row) {
        if($city == $row->name) {
            $match_term[] = $row;
            if($row->parent == 0) {
                $sta[] = $row;
            }
            $mach_test = $row->slug;
        }
    }
    if(0 < count($match_term)) {
        foreach ($match_term as $math) {
            if($math->parent != 0) {
                foreach ($terms as $row) {
                    if($row->parent == $math->parent) {
                        $sub_state[] = $row;
                    }
                }
            } else {
                foreach ($terms as $row) {
                    if($row->parent == $math->term_id) {
                        $sub_state[] = $row;
                    }
                }
            }
        }
    } else {
        foreach ($terms as $term) {
            if(strpos($term->name, $city) !== false) {
                $math_city[] = $term;
            }
            foreach ($math_city as $math) {
                if($math->parent != 0) {
                    if($math->parent == $term->parent) {
                        $sub_state[] = $term;
                    }
                } elseif($term->parent == $math->term_id) {
                    $sub_state[] = $term;
                }
            }
        }
    }
    echo "    <script>\n        jQuery('.city_slug_check').val('";
    echo $mach_test;
    echo "')\n    </script>\n\t";
    $html = (require "template-parts/mach_city_template.php");
    echo json_encode($html);
    exit(0);
}
function image_uploader_enqueue()
{
    wp_enqueue_media();
    wp_register_script("meta-image", get_template_directory_uri() . "/js/media-uploader.js", ["jquery"]);
    wp_localize_script("meta-image", "meta_image", ["title" => "Upload an Image", "button" => "Use this Image"]);
    wp_enqueue_script("meta-image");
}
function custom_post_type()
{
    $labels = ["name" => _x("اقامتگاه", "Post Type General Name", "text_domain"), "singular_name" => _x("اقامتگاه", "Post Type Singular Name", "text_domain"), "menu_name" => __("اقامتگاه", "text_domain"), "name_admin_bar" => __("اقامتگاه", "text_domain"), "archives" => __("Item Archives", "text_domain"), "attributes" => __("Item Attributes", "text_domain"), "parent_item_colon" => __("مادر:", "text_domain"), "all_items" => __("تمام اقامت گاه ها", "text_domain"), "add_new_item" => __("افزودن اقامتگاه جدید", "text_domain"), "add_new" => __("افزودن جدید", "text_domain"), "new_item" => __("اقامتگاه جدید", "text_domain"), "edit_item" => __("ویرایش اقامتگاه", "text_domain"), "update_item" => __("بروز رسانی اقامتگاه", "text_domain"), "view_item" => __("مشاهده اقامتگاه", "text_domain"), "view_items" => __("مشاهده اقامتگاه ها", "text_domain"), "search_items" => __("جستجوی اقامتگاه", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "not_found_in_trash" => __("در سطل زباله پیدا نشد", "text_domain"), "featured_image" => __("تصویر اقامتگاه", "text_domain"), "set_featured_image" => __("درج تصویر اقامتگاه", "text_domain"), "remove_featured_image" => __("حذف تصویر اقامتگاه", "text_domain"), "use_featured_image" => __("استفاده تصویر اقامتگاه", "text_domain"), "insert_into_item" => __("Insert into item", "text_domain"), "uploaded_to_this_item" => __("بروزرسانی این مورد", "text_domain"), "items_list" => __("لیست اقامتگاه ها", "text_domain"), "items_list_navigation" => __("لیست اقامتگاه ها", "text_domain"), "filter_items_list" => __("فیلتر لیست", "text_domain")];
    $args = ["label" => __("residence", "اقامتگاه"), "description" => __("درج و ویرایش اقامتگاه ها", "text_domain"), "labels" => $labels, "supports" => ["title", "editor", "custom-fields", "page-attributes", "author", "thumbnail", "comments", "gallery"], "taxonomies" => ["post_tag"], "hierarchical" => true, "public" => true, "show_ui" => true, "show_in_menu" => true, "menu_position" => 5, "show_in_admin_bar" => true, "show_in_nav_menus" => true, "can_export" => true, "has_archive" => true, "exclude_from_search" => false, "publicly_queryable" => true, "capability_type" => "page", "show_in_admin_status_list" => true, "menu_icon" => "dashicons-location-alt"];
    register_post_type("residence", $args);
}
function custom_taxonomy()
{
    $labels = ["name" => _x("شهرها", "Taxonomy General Name", "text_domain"), "singular_name" => _x("شهر", "Taxonomy Singular Name", "text_domain"), "menu_name" => __("شهر", "text_domain"), "all_items" => __("تمام موارد", "text_domain"), "parent_item" => __("مورد مادر", "text_domain"), "parent_item_colon" => __("مورد مادر:", "text_domain"), "new_item_name" => __(" شهر جدید", "text_domain"), "add_new_item" => __("افزودن شهر جدید", "text_domain"), "edit_item" => __("ویرایش شهر", "text_domain"), "update_item" => __("بروز رسانی شهر", "text_domain"), "view_item" => __("مشاهده شهر", "text_domain"), "separate_items_with_commas" => __("شهرها را با کاما جدا کنید", "text_domain"), "add_or_remove_items" => __("افزودن یا حذف شهر", "text_domain"), "choose_from_most_used" => __("انتخاب از بیشترین استفاده شده ها", "text_domain"), "popular_items" => __("مجموع شهر ها", "text_domain"), "search_items" => __("جستجوی شهر", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "no_terms" => __("شهری نیست", "text_domain"), "items_list" => __("لیست شهر ها", "text_domain"), "items_list_navigation" => __("لیست شهر ها", "text_domain")];
    $args = ["labels" => $labels, "hierarchical" => true, "public" => true, "show_ui" => true, "show_admin_column" => true, "show_in_nav_menus" => true, "show_tagcloud" => true];
    register_taxonomy("city", ["residence", "tour", "hotel"], $args);
}
function residence_tools_tax()
{
    $labels = ["name" => _x("امکانات", "Taxonomy General Name", "text_domain"), "singular_name" => _x("امکانات", "Taxonomy Singular Name", "text_domain"), "menu_name" => __("امکانات", "text_domain"), "all_items" => __("تمام امکانات", "text_domain"), "parent_item" => __("مورد مادر", "text_domain"), "parent_item_colon" => __("مورد مادر:", "text_domain"), "new_item_name" => __(" امکانات جدید", "text_domain"), "add_new_item" => __("افزودن امکانات جدید", "text_domain"), "edit_item" => __("ویرایش امکانات", "text_domain"), "update_item" => __("بروز رسانی امکانات", "text_domain"), "view_item" => __("مشاهده امکانات", "text_domain"), "separate_items_with_commas" => __("امکانات را با کاما جدا کنید", "text_domain"), "add_or_remove_items" => __("افزودن یا حذف امکانات", "text_domain"), "choose_from_most_used" => __("انتخاب از بیشترین استفاده شده ها", "text_domain"), "popular_items" => __("مجموع امکانات", "text_domain"), "search_items" => __("جستجوی امکانات", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "no_terms" => __("امکانات نیست", "text_domain"), "items_list" => __("لیست امکانات", "text_domain"), "items_list_navigation" => __("لیست امکانات", "text_domain")];
    $args = ["labels" => $labels, "hierarchical" => true, "public" => true, "show_ui" => true, "show_admin_column" => true, "show_in_nav_menus" => true, "show_tagcloud" => true];
    register_taxonomy("tools", ["residence"], $args);
}
function residence_region_tax()
{
    $labels = ["name" => _x("قوانین", "Taxonomy General Name", "text_domain"), "singular_name" => _x("قوانین", "Taxonomy Singular Name", "text_domain"), "menu_name" => __("قوانین", "text_domain"), "all_items" => __("تمام قوانین", "text_domain"), "parent_item" => __("مورد مادر", "text_domain"), "parent_item_colon" => __("مورد مادر:", "text_domain"), "new_item_name" => __(" قوانین جدید", "text_domain"), "add_new_item" => __("افزودن قوانین جدید", "text_domain"), "edit_item" => __("ویرایش قوانین", "text_domain"), "update_item" => __("بروز رسانی قوانین", "text_domain"), "view_item" => __("مشاهده قوانین", "text_domain"), "separate_items_with_commas" => __("قوانین را با کاما جدا کنید", "text_domain"), "add_or_remove_items" => __("افزودن یا حذف قوانین", "text_domain"), "choose_from_most_used" => __("انتخاب از بیشترین استفاده شده ها", "text_domain"), "popular_items" => __("مجموع قوانین", "text_domain"), "search_items" => __("جستجوی قوانین", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "no_terms" => __("قوانین نیست", "text_domain"), "items_list" => __("لیست قوانین", "text_domain"), "items_list_navigation" => __("لیست قوانین", "text_domain")];
    $args = ["labels" => $labels, "hierarchical" => true, "public" => true, "show_ui" => true, "show_admin_column" => true, "show_in_nav_menus" => true, "show_tagcloud" => true];
    register_taxonomy("loyer", ["residence"], $args);
}
function residence_loyer_tax()
{
    $labels = ["name" => _x("منطقه", "Taxonomy General Name", "text_domain"), "singular_name" => _x("منطقه", "Taxonomy Singular Name", "text_domain"), "menu_name" => __("منطقه", "text_domain"), "all_items" => __("تمام مناطق", "text_domain"), "parent_item" => __("مورد مادر", "text_domain"), "parent_item_colon" => __("مورد مادر:", "text_domain"), "new_item_name" => __(" منطقه جدید", "text_domain"), "add_new_item" => __("افزودن منطقه جدید", "text_domain"), "edit_item" => __("ویرایش منطقه", "text_domain"), "update_item" => __("بروز رسانی منطقه", "text_domain"), "view_item" => __("مشاهده منطقه", "text_domain"), "separate_items_with_commas" => __("منطقه را با کاما جدا کنید", "text_domain"), "add_or_remove_items" => __("افزودن یا حذف منطقه", "text_domain"), "choose_from_most_used" => __("انتخاب از بیشترین استفاده شده ها", "text_domain"), "popular_items" => __("مجموع مناطق", "text_domain"), "search_items" => __("جستجوی مناطق", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "no_terms" => __("منطقه ای نیست", "text_domain"), "items_list" => __("لیست مناطق", "text_domain"), "items_list_navigation" => __("لیست مناطق", "text_domain")];
    $args = ["labels" => $labels, "hierarchical" => true, "public" => true, "show_ui" => true, "show_admin_column" => true, "show_in_nav_menus" => true, "show_tagcloud" => true];
    register_taxonomy("region", ["residence", "hotel"], $args);
}
function residence_meta_box($post)
{
    $screens = ["residence"];
    foreach ($screens as $screen) {
        add_meta_box("residence_box_id", "ویژگی های اقامتگاه", "residence_meta_box_func", $screen);
    }
}
function residence_meta_box_func($post)
{
    wp_nonce_field(basename(__FILE__), "residence_meta_box_nonce");
    $meta = get_post_meta($post->ID, "_all_res_meta", false);
    $ot_plans = get_terms(["taxonomy" => "tools", "hide_empty" => false]);
    $plan_id = $meta[0]["od_tools"];
    $loyer = get_terms(["taxonomy" => "loyer", "hide_empty" => false]);
    $loyer_id = $meta[0]["od_loyer"];
    $code = $post->ID + 1000;
    if($meta[0]["posid"] != "") {
        $code = $meta[0]["posid"];
    }
    echo "    <div class='inside' xmlns=\"http://www.w3.org/1999/html\">\n        <p>\n            <label>#شناسه </label>\n            <input type=\"text\" name=\"posid\" value=\"";
    echo $code;
    echo "\"/>\n        </p>\n        <p>\n            <label>متراژ زیربنا (متر) </label>\n            <input type=\"text\" name=\"The_area_of_meter\" value=\"";
    echo $meta[0]["The_area_of_meter"];
    echo "\"/>\n        </p>\n        <p>\n            <label>متراژ کل بنا (متر) </label>\n            <input type=\"text\" name=\"total_area_of_building_meter\"\n                   value=\"";
    echo $meta[0]["total_area_of_building_meter"];
    echo "\"/>\n        </p>\n        <p>\n            <label>نوع اقامتگاه </label>\n\t\t\t";
    $type = $meta[0]["residence_type"];
    echo "            <select name=\"residence_type\" id=\"residence_type\">\n                <option value=\"shutter_type\" ";
    if($type == "shutter_type") {
        echo "selected";
    }
    echo ">دربست\n                </option>\n                <option value=\"shared_type\" ";
    if($type == "shared_type") {
        echo "selected";
    }
    echo ">اشتراکی\n                </option>\n            </select>\n        </p>\n        <p>\n            <label>نوع رزرو </label>\n\t\t\t";
    $type = $meta[0]["reserve_type"];
    echo "            <select name=\"reserve_type\" id=\"reserve_type\">\n                <option value=\"0\" ";
    if($type == "0") {
        echo "selected";
    }
    echo ">قطعی\n                </option>\n                <option value=\"1\" ";
    if($type == "1") {
        echo "selected";
    }
    echo ">نیاز به تایید\n                </option>\n            </select>\n        </p>\n        <p>\n            <label>انتخاب قوانین لغو </label>\n\t\t\t";
    $type = $meta[0]["cancel_type"];
    echo "            <select name=\"cancel_type\" id=\"cancel_type\">\n                <option value=\"easy\" ";
    if($type == "easy") {
        echo "selected";
    }
    echo ">آسان\n                </option>\n                <option value=\"medium\" ";
    if($type == "medium") {
        echo "selected";
    }
    echo ">متوسط\n                </option>\n                <option value=\"hard\" ";
    if($type == "hard") {
        echo "selected";
    }
    echo ">سخت\n                </option>\n            </select>\n        </p>\n        <p>\n            <label>ظرفیت پایه (نفر) </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"base_capacity\" value=\"";
    echo $meta[0]["base_capacity"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>حداکثرظرفیت(ظرفیت پایه + نفر اضافه) </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"total_capacity\" value=\"";
    echo $meta[0]["total_capacity"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>تعداد اتاق ها </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"number_room\" value=\"";
    echo $meta[0]["number_room"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n\n        </p>\n        <p>\n            <label>تعداد تخت های یک نفره </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"Single_bed\" value=\"";
    echo $meta[0]["Single_bed"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>تعداد تخت های دو نفره </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"double_bed\" value=\"";
    echo $meta[0]["double_bed"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>تعداد رختخواب سنتی(تشک) </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"mattress\" value=\"";
    echo $meta[0]["mattress"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>حمام </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"Bathroom\" value=\"";
    echo $meta[0]["Bathroom"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>سرویس بهداشتی ایرانی </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"iranian_toilet\" value=\"";
    echo $meta[0]["iranian_toilet"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>سرویس بهداشتی فرنگی </label>\n            <span class=\"plus_i\"><i class=\"fa fa-plus\"></i></span>\n            <input type=\"number\" class=\"w80i\" name=\"sitting_toilet\" value=\"";
    echo $meta[0]["sitting_toilet"];
    echo "\"/>\n            <span class=\"minus_i\"><i class=\"fa fa-minus\"></i></span>\n        </p>\n        <p>\n            <label>قیمت (هر شب) برای روزهای عادی</label>\n\n            <input type=\"number\" name=\"price\" value=\"";
    echo $meta[0]["price"];
    echo "\"/>\n            <span class=\"res_inp_note\">این قیمت برای تمامی روزهای عادی تقویم شما به مدت 60 روز اعمال خواهد شد. </span>\n        </p>\n        <p>\n\t\t\t";
    $end_w_price = $meta[0]["price"];
    if($meta[0]["end_week_price"] != "" || $meta[0]["end_week_price"] != 0) {
        $end_w_price = $meta[0]["end_week_price"];
    }
    echo "            <label>قیمت برای روزهای آخر هفته</label>\n            <input type=\"number\" name=\"end_week_price\" value=\"";
    echo $end_w_price;
    echo "\"/>\n            <span class=\"res_inp_note\">این قیمت برای تمامی روزهای آخر هفته تقویم شما به مدت 60 روز اعمال خواهد شد. </span>\n        </p>\n        <p class=\"flex_row_box\">\n        <p>\n            <script src=";
    echo get_template_directory_uri();
    echo "/js/veu.js></script>\n            <script src=\"https://cdn.jsdelivr.net/npm/moment\"></script>\n            <script src=\"https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js\"></script>\n            <script src=";
    echo get_template_directory_uri();
    echo "'/js/v-datetime.js'></script>\n\n\n        <div id=\"each_day_price\">\n            <label>تعیین قیمت روی تقویم</label>\n\t\t\t";
    global $post;
    $epid = $post->ID;
    $day_price = "";
    $day_price_key = [];
    foreach ($day_price as $key => $p) {
        $day_price_key[] = $key;
    }
    $imp = implode("~", $day_price_key);
    echo "            <input type=\"text\" value=\"";
    echo $day_price;
    echo "\" class=\"eday_price\" autocomplete=\"off\">\n\n            <date-picker value=\"";
    echo $day_price;
    echo "\" v-model=\"dates\" multiple display-format=\"jYYYY-jMM-jDD\"\n                         format=\"jYYYY-jMM-jDD\" custom-input=\".eday_price\"></date-picker>\n            <label>قیمت (تومان) &nbsp;<input type=\"number\" class=\"edate_prices\" name=\"edate_prices\"></label>\n            <span class=\"edayp_submit\">ذخیره</span>\n        </div>\n        </p>\n        <p>\n\n        <div id=\"dis_day\">\n            <label>غیر فعال کردن تاریخ</label>\n\t\t\t";
    global $post;
    $respid = $post->ID;
    echo "            <input type=\"text\" value=\"\" class=\"dis_days\" autocomplete=\"off\">\n\n            <date-picker value=\"\" v-model=\"dates\" multiple display-format=\"jYYYY-jMM-jDD\" format=\"jYYYY-jMM-jDD\"\n                         custom-input=\".dis_days\"></date-picker>\n            <span class=\"dis_day_submit\"> ذخیره </span>\n\n        </div>\n        <div id=\"return_day\">\n            <label> فعال کردن تاریخ</label>\n\t\t\t";
    global $post;
    $respid = $post->ID;
    echo "            <input type=\"text\" value=\"\" class=\"return_days\" autocomplete=\"off\">\n\n            <date-picker value=\"\" v-model=\"dates\" multiple display-format=\"jYYYY-jMM-jDD\" format=\"jYYYY-jMM-jDD\"\n                         custom-input=\".return_days\"></date-picker>\n            <span class=\"return_day_submit\"> ذخیره </span>\n\n        </div>\n        <p>\n            <script>\n                let app3 = new Vue({\n                    el: '#return_day',\n                    data: {\n                        dates: '',\n\n                    },\n\n                    components: {\n                        DatePicker: VuePersianDatetimePicker\n                    }\n                });\n                let app2 = new Vue({\n                    el: '#dis_day',\n                    data: {\n                        dates: '',\n\n                    },\n\n                    components: {\n                        DatePicker: VuePersianDatetimePicker\n                    }\n                });\n                let app = new Vue({\n                    el: '#each_day_price',\n                    data: {\n                        dates: '',\n\n                    },\n\n                    components: {\n                        DatePicker: VuePersianDatetimePicker\n                    }\n                });\n                \$ed_price = [];\n                jQuery('.edayp_submit').on('click', function (e) {\n                    let dates = jQuery('.eday_price').val()\n                    let price = jQuery('.edate_prices').val();\n\n\n                    jQuery.ajax({\n                        url: \"";
    echo admin_url("admin-ajax.php");
    echo "\",\n                        type: \"POST\",\n                        data: {\n                            action: \"set_residence_dprice\",\n                            'dates': dates,\n                            'price': price,\n                            'pid': ";
    echo $epid;
    echo "                        },\n                        beforeSend: function () {\n                            jQuery('.edayp_submit').text('در حال ذخیره سازی')\n                        },\n                        success: function (f) {\n                            jQuery('.edayp_submit').text('ذخیره')\n                        }\n                    })\n                })\n                jQuery('.dis_day_submit').on('click', function (e) {\n                    let ddates = jQuery('.dis_days').val()\n                    jQuery.ajax({\n                        url: \"";
    echo admin_url("admin-ajax.php");
    echo "\",\n                        type: \"POST\",\n                        data: {\n                            action: \"set_residence_custom_reserve\",\n                            'dates': ddates,\n                            'pid': ";
    echo $epid;
    echo "                        },\n                        beforeSend: function () {\n                            jQuery('.dis_day_submit').text('در حال ذخیره سازی')\n                        },\n                        success: function (f) {\n                            jQuery('.dis_day_submit').text('ذخیره')\n                        }\n                    })\n                })\n                jQuery('.return_day_submit').on('click', function (e) {\n                    let ddates = jQuery('.return_days').val()\n\n\n                    jQuery.ajax({\n                        url: \"";
    echo admin_url("admin-ajax.php");
    echo "\",\n                        type: \"POST\",\n                        data: {\n                            action: \"custom_reserve_return\",\n                            'dates': ddates,\n                            'pid': ";
    echo $respid;
    echo "                        },\n                        beforeSend: function () {\n                            jQuery('.return_day_submit').text('در حال ذخیره سازی')\n                        },\n                        success: function (f) {\n                            jQuery('.return_day_submit').text('ذخیره')\n                        }\n                    })\n                })\n            </script>\n        </p>\n    </div>\n\n    <p>\n        <label> قیمت برای نفرات اضافی (هرنفر)</label>\n        <input type=\"number\" name=\"extra_person\" value=\"";
    echo $meta[0]["extra_person"];
    echo "\"/>\n    </p>\n    <p>\n        <label>ساعت ورود</label>\n        <select name=\"in_clock\">\n\t\t\t";
    $in_saved = $meta[0]["in_clock"];
    $i = 1;
    while ($i <= 24) {
        if($i == $in_saved) {
            $selected = "selected";
        }
        echo "                <option ";
        if($i == $in_saved) {
            echo "selected";
        }
        echo " value=\"";
        echo $i;
        echo "\">";
        echo $i;
        echo "</option>\n\t\t\t";
        $i += 0;
    }
    echo "        </select>\n    </p>\n    <p>\n        <label>ساعت خروج</label>\n        <select name=\"out_clock\">\n\t\t\t";
    $out_saved = $meta[0]["out_clock"];
    $i = 1;
    while ($i <= 24) {
        if($i == $out_saved) {
            $select = "selected";
        }
        echo "\n                <option ";
        if($i == $out_saved) {
            echo "selected";
        }
        echo " value=\"";
        echo $i;
        echo "\">";
        echo $i;
        echo "</option>\n\t\t\t";
        $i += 0;
    }
    echo "        </select>\n    </p>\n    <hr>\n    <p>\n        <label>آدرس اقامتگاه</label>\n        <input type=\"text\" style=\"width: 100%\" name=\"res_address\" value=\"";
    echo $meta[0]["res_address"];
    echo "\"/>\n    </p>\n    <hr>\n    <p>\n    <h4>قوانین اقامتگاه</h4>\n    <link rel=\"stylesheet\" href=\"https://unpkg.com/leaflet@1.9.3/dist/leaflet.css\"\n          integrity=\"sha256-kLaT2GOSpHechhsozzB+flnD+zUyjE2LlfWPgU04xyI=\" crossorigin=\"\"/>\n    <script src=\"https://unpkg.com/leaflet@1.9.3/dist/leaflet.js\"\n            integrity=\"sha256-WBkoXOwTeyKclOHuWtc+i2uENFpDZ9YPdf5Hf+D7ewM=\" crossorigin=\"\"></script>\n    <div class=\"other_plans\">\n\t\t";
    foreach ($loyer as $row) {
        echo "            <div class=\"od_box\">\n                <input type=\"checkbox\" name=\"od_loyer[]\" value=\"";
        echo $row->term_id;
        echo "\" ";
        if($loyer_id != "" && in_array($row->term_id, $loyer_id)) {
            echo "checked";
        }
        echo " />\n                </label>";
        echo $row->name;
        echo " <label>\n            </div>\n\t\t";
    }
    echo "    </div>\n    </p>\n    <p class=\"fw700 fz16\">موقعیت مکانی</p>\n    <p class=\"fw300 fz12 mt_10\">موقعیت مکانی دقیق اقامتگاه را روی نقشه مشخص نمایید..</p>\n\t";
    $lat = $meta[0]["map_point_lat"];
    $lng = $meta[0]["map_point_lng"];
    if(!$lat) {
        $lat = 0;
    }
    if(!$lng) {
        $lng = 0;
    }
    echo "    <div id=\"map_insert_hotel\">\n    </div>\n    <style>\n        #map_insert_hotel {\n            height: 300px;\n            border-radius: 12px;\n            margin: 20px 0\n        }\n\n        .leaflet-control-geocoder {\n            background: white;\n            padding: 5px;\n        }\n\n        element.style {\n        }\n\n        .leaflet-touch .leaflet-bar a:last-child {\n            border-bottom-left-radius: 2px;\n            border-bottom-right-radius: 2px;\n        }\n\n        .leaflet-touch .leaflet-bar a:first-child {\n            border-top-left-radius: 2px;\n            border-top-right-radius: 2px;\n        }\n    </style>\n\n<script src=\"//unpkg.com/@sjaakp/leaflet-search/dist/leaflet-search.js\"></script> \n    <script>\n        let map = L.map('map_insert_hotel').setView([";
    echo $lat;
    echo ", ";
    echo $lng;
    echo "], 15);\n        L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {\n            maxZoom: 19,\n\n        }).addTo(map);\n         map.addControl(L.control.search({ position: 'topright' }));\n\n\n        let marker;\n        marker = new L.marker([";
    echo $lat;
    echo ", ";
    echo $lng;
    echo "], {\n            draggable: 'true'\n        }).addTo(map);\n        marker.on('dragend', function (e) {\n\n            var latlng = marker.getLatLng();\n            jQuery('.map_point_lat').val(latlng.lat)\n            jQuery('.map_point_lng').val(latlng.lng)\n        });\n    </script>\n    <input type=\"hidden\" name=\"map_point_lat\" class=\"map_point_lat \" checked ";
    if($lat) {
        echo "        value=\"";
        echo $lat;
        echo "\" ";
    }
    echo ">\n    <input type=\"hidden\" name=\"map_point_lng\" class=\"map_point_lng\" ";
    if($lat) {
        echo " value=\"";
        echo $lng;
        echo "\"\n\t";
    }
    echo ">\n    </div>\n\t";
}
function residence_save_meta_boxes_data($post_id)
{
    if(!isset($_POST["residence_meta_box_nonce"]) || !wp_verify_nonce($_POST["residence_meta_box_nonce"], basename(__FILE__))) {
        return NULL;
    }
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return NULL;
    }
    if(!current_user_can("edit_post", $post_id)) {
        return NULL;
    }
    $all_residence_meta = [];
    if(isset($_POST["The_area_of_meter"])) {
        if(isset($_POST["od_tools"])) {
            $odt = $_POST["od_tools"];
        }
        if(isset($_POST["od_loyer"])) {
            $odl = $_POST["od_loyer"];
        }
        $all_residence_meta["The_area_of_meter"] = sanitize_text_field($_POST["The_area_of_meter"]);
        $all_residence_meta["total_area_of_building_meter"] = sanitize_text_field($_POST["total_area_of_building_meter"]);
        $all_residence_meta["residence_type"] = sanitize_text_field($_POST["residence_type"]);
        $all_residence_meta["reserve_type"] = sanitize_text_field($_POST["reserve_type"]);
        $all_residence_meta["cancel_type"] = sanitize_text_field($_POST["cancel_type"]);
        $all_residence_meta["base_capacity"] = sanitize_text_field($_POST["base_capacity"]);
        $all_residence_meta["total_capacity"] = sanitize_text_field($_POST["total_capacity"]);
        $all_residence_meta["number_room"] = sanitize_text_field($_POST["number_room"]);
        $all_residence_meta["Single_bed"] = sanitize_text_field($_POST["Single_bed"]);
        $all_residence_meta["double_bed"] = sanitize_text_field($_POST["double_bed"]);
        $all_residence_meta["mattress"] = sanitize_text_field($_POST["mattress"]);
        $all_residence_meta["Bathroom"] = sanitize_text_field($_POST["Bathroom"]);
        $all_residence_meta["iranian_toilet"] = sanitize_text_field($_POST["iranian_toilet"]);
        $all_residence_meta["sitting_toilet"] = sanitize_text_field($_POST["sitting_toilet"]);
        $all_residence_meta["price"] = sanitize_text_field($_POST["price"]);
        $all_residence_meta["end_week_price"] = sanitize_text_field($_POST["end_week_price"]);
        $all_residence_meta["extra_person"] = sanitize_text_field($_POST["extra_person"]);
        $all_residence_meta["od_tools"] = $odt;
        $all_residence_meta["od_loyer"] = $odl;
        $all_residence_meta["in_clock"] = sanitize_text_field($_POST["in_clock"]);
        $all_residence_meta["res_address"] = sanitize_text_field($_POST["res_address"]);
        $all_residence_meta["out_clock"] = sanitize_text_field($_POST["out_clock"]);
        $all_residence_meta["meli_pic"] = sanitize_text_field($_POST["meli_admin_pic"]);
        $all_residence_meta["madarek_urls"] = $_POST["admin_madarek_urls"];
        $all_residence_meta["map_point_lat"] = sanitize_text_field($_POST["map_point_lat"]);
        $all_residence_meta["map_point_lng"] = sanitize_text_field($_POST["map_point_lng"]);
        $all_residence_meta["posid"] = sanitize_text_field($_POST["posid"]);
        update_post_meta($post_id, "_all_res_meta", $all_residence_meta);
        update_post_meta($post_id, "codeid", $_POST["posid"]);
    }
    $up_days_get = get_option("update_date_days");
    if($up_days_get == "") {
        $udg = 60;
    } else {
        $udg = $up_days_get;
    }
    $today = date("Y/m/d");
    $date_new = strtotime("+" . $udg . " days", strtotime($today));
    $date_sixteen = date("Y/m/d", $date_new);
    $exptoday = explode("/", $today);
    $expsixteen = explode("/", $date_sixteen);
    $per_today = gregorian_to_jalali($exptoday[0], $exptoday[1], $exptoday[2], "/");
    $seex_per_days = gregorian_to_jalali($expsixteen[0], $expsixteen[1], $expsixteen[2], "/");
    $calender = get_beetweens_date($per_today, $seex_per_days);
    $calender_price = [];
    $custom_price = get_post_meta($post_id, "res_day_price", true);
    foreach ($calender as $row) {
        $date_exp = explode("-", $row);
        $ts = jmktime("0", "0", "0", $date_exp[1], $date_exp[2], $date_exp[0]);
        $end_week = jstrftime("%a", $ts);
        if(array_key_exists($row, $custom_price)) {
            $calender_price[$row] = $custom_price[$row];
        } elseif($end_week == "چ" || $end_week == "پ" || $end_week == "ج") {
            $calender_price[$row] = $_POST["end_week_price"];
        } else {
            $calender_price[$row] = $_POST["price"];
        }
    }
    update_post_meta($post_id, "resistance_calender", $calender_price);
}
function add_term_image($taxonomy)
{
    echo "    <div class=\"form-field term-group\">\n        <label for=\"\">Upload and Image</label>\n        <input type=\"text\" name=\"txt_upload_icon\" id=\"txt_upload_icon\" value=\"\" style=\"width: 77%\">\n        <input type=\"button\" id=\"upload_image_btn\" class=\"button\" value=\"Upload an Image\"/>\n    </div>\n\t";
}
function save_term_image($term_id, $tt_id)
{
    if(isset($_POST["txt_upload_icon"]) && "" !== $_POST["txt_upload_icon"]) {
        $group = $_POST["txt_upload_icon"];
        update_term_meta($term_id, "term_image", $group, true);
    }
}
function edit_image_upload($term, $taxonomy)
{
    $txt_upload_icon = get_term_meta($term->term_id, "term_image", true);
    echo "    <div class=\"form-field term-group form_align\">\n        <label for=\"\">یک تصویر آپلود کنید</label>\n        <input type=\"text\" name=\"txt_upload_icon\" id=\"txt_upload_icon\" value=\"";
    echo $txt_upload_icon;
    echo "\"\n               style=\"width: 77%\">\n        <input type=\"button\" id=\"upload_image_btn\" class=\"button\" value=\"آپلود تصویر\"/>\n        <img src=\"";
    echo $txt_upload_icon;
    echo "\" alt=\"\">\n    </div>\n\t";
}
function update_image_upload($term_id, $tt_id)
{
    if(isset($_POST["txt_upload_icon"]) && "" !== $_POST["txt_upload_icon"]) {
        $group = $_POST["txt_upload_icon"];
        update_term_meta($term_id, "term_image", $group);
    }
}
function get_beetweens_date($checkin, $checkout)
{
    if(empty($checkin) || empty($checkout)) {
        error_log("Invalid input: Check-in or Check-out date is empty.");
        return [];
    }
    $all_date = [];
    list($sy, $sm, $sd) = explode("/", $checkin);
    list($ey, $em, $ed) = explode("/", $checkout);
    $sm = str_pad($sm, 2, "0", STR_PAD_LEFT);
    $sd = str_pad($sd, 2, "0", STR_PAD_LEFT);
    $em = str_pad($em, 2, "0", STR_PAD_LEFT);
    $ed = str_pad($ed, 2, "0", STR_PAD_LEFT);
    $start_g = jalali_to_gregorian($sy, $sm, $sd, "/");
    $end_g = jalali_to_gregorian($ey, $em, $ed, "/");
    if(!$start_g || !$end_g) {
        error_log("Invalid conversion from Jalali to Gregorian. Start: " . $checkin . ", End: " . $checkout);
        return [];
    }
    $start = new DateTime($start_g);
    $end = new DateTime($end_g);
    $end->modify("+1 day");
    $period = new DatePeriod($start, new DateInterval("P1D"), $end);
    foreach ($period as $date) {
        $gy = $date->format("Y");
        $gm = $date->format("m");
        $gd = $date->format("d");
        list($jy, $jm, $jd) = gregorian_to_jalali($gy, $gm, $gd);
        $jm = str_pad($jm, 2, "0", STR_PAD_LEFT);
        $jd = str_pad($jd, 2, "0", STR_PAD_LEFT);
        $all_date[] = $jy . "-" . $jm . "-" . $jd;
    }
    return $all_date;
}
function get_beetween_date($checkin, $checkout)
{
    include_once "jdf.php";
    $all_date = [];
    list($checkinYear, $checkinMonth, $checkinDay) = explode("-", $checkin);
    list($checkoutYear, $checkoutMonth, $checkoutDay) = explode("-", $checkout);
    $checkinYear = (int) $checkinYear;
    $checkinMonth = (int) $checkinMonth;
    $checkinDay = (int) $checkinDay;
    $checkoutYear = (int) $checkoutYear;
    $checkoutMonth = (int) $checkoutMonth;
    $checkoutDay = (int) $checkoutDay;
    $checkinGregorian = jalali_to_gregorian($checkinYear, $checkinMonth, $checkinDay);
    $checkoutGregorian = jalali_to_gregorian($checkoutYear, $checkoutMonth, $checkoutDay);
    $startDate = new DateTime(implode("-", $checkinGregorian));
    $endDate = new DateTime(implode("-", $checkoutGregorian));
    $period = new DatePeriod($startDate, new DateInterval("P1D"), $endDate);
    foreach ($period as $date) {
        $gregorianDate = $date->format("Y-m-d");
        list($gYear, $gMonth, $gDay) = explode("-", $gregorianDate);
        $jalaliDate = gregorian_to_jalali($gYear, $gMonth, $gDay);
        $all_date[] = sprintf("%04d-%02d-%02d", $jalaliDate[0], $jalaliDate[1], $jalaliDate[2]);
    }
    return $all_date;
}
function get_beetween_date_add($checkin, $checkout)
{
    $start = DateTime::createFromFormat("Y/m/d", $checkin);
    $end = DateTime::createFromFormat("Y/m/d", $checkout);
    $interval = new DateInterval("P1D");
    $end->modify("+1 day");
    $date_range = new DatePeriod($start, $interval, $end);
    $dates = [];
    foreach ($date_range as $date) {
        $dates[] = $date->format("Y-m-d");
    }
    return $dates;
}
function property_gallery_add_metabox()
{
    add_meta_box("post_custom_gallery", "گالری تصاویر", "property_gallery_metabox_callback", "residence", "normal", "core");
}
function hotel_gallery_add_metabox()
{
    add_meta_box("post_custom_gallery", "گالری تصاویر", "property_gallery_metabox_callback", "hotel", "normal", "core");
}
function property_gallery_metabox_callback()
{
    wp_nonce_field(basename(__FILE__), "sample_nonce");
    global $post;
    $gallery_data = get_post_meta($post->ID, "gallery_data", true);
    echo "    <div id=\"gallery_wrapper\">\n        <div id=\"img_box_container\">\n\t\t\t";
    if(isset($gallery_data["image_url"])) {
        for ($i = 0; $i < count($gallery_data["image_url"]); $i++) {
            echo "            <div class=\"gallery_single_row dolu\">\n                <div class=\"gallery_area image_container \">\n                    <img class=\"gallery_img_img\" src=\"";
            esc_html_e($gallery_data["image_url"][$i]);
            echo "\" height=\"55\"\n                         width=\"55\" onclick=\"open_media_uploader_image_this(this)\"/>\n                    <input type=\"hidden\" class=\"meta_image_url\" name=\"gallery[image_url][]\"\n                           value=\"";
            esc_html_e($gallery_data["image_url"][$i]);
            echo "\"/>\n                </div>\n                <div class=\"gallery_area\">\n                    <span class=\"button remove\" onclick=\"remove_img(this)\" title=\"Remove\"/>\n                    x</span>\n                </div>\n                <div class=\"clear\"/>\n            </div>\n        </div>\n\t\t";
        }
    }
    echo "    </div>\n    <div style=\"display:none\" id=\"master_box\">\n        <div class=\"gallery_single_row\">\n            <div class=\"gallery_area image_container\" onclick=\"open_media_uploader_image(this)\">\n                <input class=\"meta_image_url\" value=\"\" type=\"hidden\" name=\"gallery[image_url][]\"/>\n            </div>\n            <div class=\"gallery_area\">\n                <span class=\"button remove\" onclick=\"remove_img(this)\" title=\"Remove\"/>\n                <i class=\"fas fa-trash-alt\"></i></span>\n            </div>\n            <div class=\"clear\"></div>\n        </div>\n    </div>\n    <div id=\"add_gallery_single_row\">\n        <input class=\"button add\" type=\"button\" value=\"+\" onclick=\"open_media_uploader_image_plus();\" title=\"Add image\"/>\n    </div>\n\n\t";
}
function property_melicart_add_metabox()
{
    add_meta_box("post_melicart_image", "تصویر کارت ملی و مدارک اقامتگاه", "property_melicart_add_metabox_callback", "residence", "normal", "core");
}
function property_melicart_add_metabox_callback()
{
    global $post;
    $pid = $post->ID;
    $meta = get_post_meta($pid, "_all_res_meta", "false");
    echo "\n\n\t";
    if($meta["meli_pic"]) {
        echo "        <div id=\"gallery_wrapper\">\n            <div class=\"img_meli_show\">\n                <div class=\"up_meli_host_box\"><a href=\"";
        echo $meta["meli_pic"];
        echo "\"><img\n                                src=\"";
        echo $meta["meli_pic"];
        echo "\"></a></div>\n                <input type=\"hidden\" name=\"meli_admin_pic\" value=\"";
        echo $meta["meli_pic"];
        echo "\">\n            </div>\n        </div>\n\n\t\t";
        if($meta["madarek_urls"]) {
            echo "<div class=\"img_meli_show\">";
            foreach ($meta["madarek_urls"] as $row) {
                echo "                <div class=\"up_meli_host_box\"><a href=\"";
                echo $row;
                echo "\"><img class=\"umh_image\" src=\"";
                echo $row;
                echo "\"></a></div>\n                <input type=\"hidden\" name=\"admin_madarek_urls[]\" value=\"";
                echo $row;
                echo "\">\n\t\t\t";
            }
            echo "</div>";
        }
        echo "\t";
    }
    echo "\n\n\t";
}
function property_gallery_styles_scripts()
{
    global $post;
    if("residence" != $post->post_type) {
        return NULL;
    }
    echo "\n    <script defer src=\"https://use.fontawesome.com/releases/v5.0.8/js/solid.js\"\n            integrity=\"sha384-+Ga2s7YBbhOD6nie0DzrZpJes+b2K1xkpKxTFFcx59QmVPaSA8c7pycsNaFwUK6l\" crossorigin=\"anonymous\">\n    </script>\n    <script defer src=\"https://use.fontawesome.com/releases/v5.0.8/js/fontawesome.js\"\n            integrity=\"sha384-7ox8Q2yzO/uWircfojVuCQOZl+ZZBg2D2J5nkpLqzH1HY0C1dHlTKIbpRz/LG23c\" crossorigin=\"anonymous\">\n    </script>\n\n\t";
}
function property_gallery_save($post_id)
{
    if(defined("DOING_AUTOSAVE") && DOING_AUTOSAVE) {
        return NULL;
    }
    $is_autosave = wp_is_post_autosave($post_id);
    $is_revision = wp_is_post_revision($post_id);
    $is_valid_nonce = isset($_POST["sample_nonce"]) && wp_verify_nonce($_POST["sample_nonce"], basename(__FILE__)) ? "true" : "false";
    if($is_autosave || $is_revision || !$is_valid_nonce) {
        return NULL;
    }
    if(!current_user_can("edit_post", $post_id)) {
        return NULL;
    }
    if($_POST["gallery"]) {
        $gallery_data = [];
        for ($i = 0; $i < count($_POST["gallery"]["image_url"]); $i++) {
            if("" != $_POST["gallery"]["image_url"][$i]) {
                $gallery_data["image_url"][] = $_POST["gallery"]["image_url"][$i];
            }
        }
        if($gallery_data) {
            update_post_meta($post_id, "gallery_data", $gallery_data);
        } else {
            delete_post_meta($post_id, "gallery_data");
        }
    }
}
function create_post_id()
{
    global $wpdb;
    $lastrowId = $wpdb->get_col("SELECT ID FROM wp_posts where post_type='residence' ORDER BY post_date DESC ");
    $lastPropertyId = $lastrowId[0];
    return $lastPropertyId;
}
function calc_reserve_price()
{
    // Enhanced price calculation function with better structure and validation
    $response = array('success' => false, 'data' => array(), 'message' => '');
    
    try {
        // Validate and sanitize input
        $checkin = isset($_POST["checkin"]) ? sanitize_text_field($_POST["checkin"]) : '';
        $checkout = isset($_POST["checkout"]) ? sanitize_text_field($_POST["checkout"]) : '';
        $res_id = isset($_POST["res_id"]) ? intval($_POST["res_id"]) : 0;
        $no_people = isset($_POST["no_people"]) ? intval($_POST["no_people"]) : 1;
        
        // Alternative parameter names for compatibility
        if (empty($checkin)) $checkin = isset($_POST["check_in"]) ? sanitize_text_field($_POST["check_in"]) : '';
        if (empty($checkout)) $checkout = isset($_POST["check_out"]) ? sanitize_text_field($_POST["check_out"]) : '';
        
        // Validate required parameters
        if (empty($checkin) || empty($checkout) || empty($res_id)) {
            $response['message'] = 'پارامترهای ضروری وارد نشده‌اند';
            echo json_encode($response);
            exit(0);
        }
        
        // Validate dates
        if (strtotime($checkout) <= strtotime($checkin)) {
            $response['message'] = 'تاریخ خروج باید بعد از تاریخ ورود باشد';
            echo json_encode($response);
            exit(0);
        }
        
        // Get residence metadata
        $post_data = get_post_meta($res_id, "_all_res_meta", false);
        if (empty($post_data)) {
            $response['message'] = 'اطلاعات اقامتگاه یافت نشد';
            echo json_encode($response);
            exit(0);
        }
        
        $meta = $post_data[0];
        $discount_percent = floatval($meta["discount"]["perscent_discount"] ?? 0);
        $base_price = floatval($meta["price"] ?? 0);
        $extra_person_price = floatval($meta["extra_person"] ?? 0);
        $total_capacity = intval($meta["total_capacity"] ?? 1);
        $base_capacity = intval($meta["base_capacity"] ?? 1);
        $weekend_price = floatval($meta["end_week_price"] ?? $base_price);
        
        // Calculate nights
        $nights = DateDifference($checkin, $checkout);
        if ($nights <= 0) {
            $response['message'] = 'تعداد شب‌های اقامت نامعتبر است';
            echo json_encode($response);
            exit(0);
        }
        
        // Get date range
        $all_dates = get_beetween_date($checkin, $checkout);
        $all_calendar = get_post_meta($res_id, "resistance_calender", true);
        $all_reserved = get_post_meta($res_id, "resistance_reserves", true);
        
        // Check availability
        $is_available = true;
        if ($all_reserved) {
            foreach ($all_reserved as $reserved_date) {
                if (in_array($reserved_date, $all_dates)) {
                    $is_available = false;
                    break;
                }
            }
        }
        
        if (!$is_available) {
            $response['message'] = 'در بازه انتخابی تاریخ‌های رزرو شده وجود دارد';
            echo json_encode($response);
            exit(0);
        }
        
        // Calculate base price for each date
        $date_prices = array();
        $weekend_extras = 0;
        $discount_dates = array();
        
        // Check discount period
        $has_discount = false;
        if (!empty($meta["discount"]["start_date "]) && !empty($meta["discount"]["end_date"])) {
            $discount_start = $meta["discount"]["start_date "];
            $discount_end = $meta["discount"]["end_date"];
            $discount_dates = get_beetween_date_add($discount_start, $discount_end);
            $has_discount = true;
        }
        
        foreach ($all_dates as $date) {
            $daily_price = $base_price;
            
            // Check if date has custom price in calendar
            if ($all_calendar && isset($all_calendar[$date])) {
                $daily_price = floatval($all_calendar[$date]);
            }
            
            // Check if it's weekend (Wed/Thu/Fri)
            $date_timestamp = strtotime($date);
            $day_of_week = jdate('D', $date_timestamp, '', '', 'en');
            if (in_array($day_of_week, ['چ','پ','ج'], true) && $weekend_price > $daily_price) { // Wed/Thu/Fri
                $weekend_extras += ($weekend_price - $daily_price);
                $daily_price = $weekend_price;
            }
            
            $date_prices[$date] = $daily_price;
        }
        
        // Calculate total base price
        $base_total = array_sum($date_prices);
        
        // Calculate extra people cost
        $extra_people = max(0, $no_people - $base_capacity);
        $extra_people_cost = $extra_people * $extra_person_price * $nights;
        
        // Calculate discount
        $total_discount = 0;
        if ($has_discount && $discount_percent > 0) {
            foreach ($all_dates as $date) {
                if (in_array($date, $discount_dates) && isset($date_prices[$date])) {
                    $total_discount += ($date_prices[$date] * $discount_percent / 100);
                }
            }
        }
        
        // Calculate final total
        $subtotal = $base_total + $extra_people_cost;
        $final_total = $subtotal - $total_discount;
        
        // Prepare response data
        $response['success'] = true;
        $response['data'] = array(
            'nights' => $nights,
            'base_price' => $base_total,
            'weekend_extra' => $weekend_extras,
            'extra_people_cost' => $extra_people_cost,
            'extra_people_count' => $extra_people,
            'discount' => $total_discount,
            'subtotal' => $subtotal,
            'total_price' => $final_total,
            'per_night_avg' => round($base_total / $nights),
            'date_breakdown' => $date_prices,
            'is_available' => $is_available
        );
        
        // Legacy compatibility
        $legacy_response = array(
            "total_price" => $final_total,
            "sub_add_people_price" => $extra_people_cost,
            "add_people_num" => $extra_people,
            "count_value" => array_count_values($date_prices),
            "allow" => $is_available ? "yes" : "no",
            "discount" => $total_discount,
            "nights" => $nights
        );
        
        // Return enhanced response for new calendar, legacy for old
        if (isset($_POST['enhanced']) && $_POST['enhanced'] === 'true') {
            echo json_encode($response);
        } else {
            echo json_encode($legacy_response);
        }
        
    } catch (Exception $e) {
        $response['message'] = 'خطا در محاسبه قیمت: ' . $e->getMessage();
        echo json_encode($response);
    }
    
    exit(0);
}

function calculate_reserve_price_enhanced() {
    // Enhanced price calculation specifically for the new calendar widget
    
    // Verify nonce for security
    if (!wp_verify_nonce($_POST['nonce'] ?? '', 'jayto_ajax_nonce')) {
        wp_die('Security check failed');
    }
    
    $response = array('success' => false, 'data' => array(), 'message' => '');
    
    try {
        // Get and validate parameters
        $res_id = intval($_POST['res_id'] ?? 0);
        $check_in = sanitize_text_field($_POST['check_in'] ?? '');
        $check_out = sanitize_text_field($_POST['check_out'] ?? '');
        $num_people = intval($_POST['num_people'] ?? 1);
        
        if (!$res_id || !$check_in || !$check_out) {
            throw new Exception('پارامترهای مورد نیاز ارسال نشده‌اند');
        }
        
        if (strtotime($check_out) <= strtotime($check_in)) {
            throw new Exception('تاریخ خروج باید بعد از تاریخ ورود باشد');
        }
        
        // Get residence data
        $meta = get_post_meta($res_id, "_all_res_meta", true);
        if (!$meta) {
            throw new Exception('اطلاعات اقامتگاه یافت نشد');
        }
        
        // Calculate nights
        $nights = DateDifference($check_in, $check_out);
        if ($nights <= 0) {
            throw new Exception('تعداد شب‌های اقامت نامعتبر');
        }
        
        // Get price data
        $base_price = floatval($meta['price'] ?? 0);
        $extra_person_price = floatval($meta['extra_person'] ?? 0);
        $base_capacity = intval($meta['base_capacity'] ?? 1);
        $weekend_price = floatval($meta['end_week_price'] ?? $base_price);
        
        // Get calendar and reservation data
        $calendar_prices = get_post_meta($res_id, "resistance_calender", true) ?: array();
        $reserved_dates = get_post_meta($res_id, "resistance_reserves", true) ?: array();
        $date_range = get_beetween_date($check_in, $check_out);
        
        // Check availability
        foreach ($reserved_dates as $reserved_date) {
            if (in_array($reserved_date, $date_range)) {
                throw new Exception('در بازه انتخابی روزهای رزرو شده وجود دارد');
            }
        }
        
        // Calculate daily prices
        $total_base_price = 0;
        $weekend_extra = 0;
        $daily_breakdown = array();
        
        foreach ($date_range as $date) {
            $daily_price = $base_price;
            
            // Check custom calendar price
            if (isset($calendar_prices[$date])) {
                $daily_price = floatval($calendar_prices[$date]);
            }
            
            // Check weekend pricing (Wed/Thu/Fri)
            $day_of_week = jdate('D', strtotime($date), '', '', 'en');
            $is_weekend = in_array($day_of_week, ['چ','پ','ج'], true);
            if ($is_weekend && $weekend_price > $daily_price) {
                $weekend_extra += ($weekend_price - $daily_price);
                $daily_price = $weekend_price;
            }
            
            $daily_breakdown[$date] = array(
                'price' => $daily_price,
                'is_weekend' => $is_weekend,
                'date_jalali' => jdate('Y/m/d', strtotime($date))
            );
            
            $total_base_price += $daily_price;
        }
        
        // Calculate extra people cost
        $extra_people = max(0, $num_people - $base_capacity);
        $extra_people_cost = $extra_people * $extra_person_price * $nights;
        
        // Calculate discount if applicable
        $discount_amount = 0;
        if (!empty($meta['discount']['start_date ']) && !empty($meta['discount']['end_date'])) {
            $discount_percent = floatval($meta['discount']['perscent_discount'] ?? 0);
            if ($discount_percent > 0) {
                $discount_dates = get_beetween_date_add(
                    $meta['discount']['start_date '], 
                    $meta['discount']['end_date']
                );
                
                foreach ($date_range as $date) {
                    if (in_array($date, $discount_dates) && isset($daily_breakdown[$date])) {
                        $discount_amount += ($daily_breakdown[$date]['price'] * $discount_percent / 100);
                    }
                }
            }
        }
        
        // Calculate totals
        $subtotal = $total_base_price + $extra_people_cost;
        $final_total = $subtotal - $discount_amount;
        
        $response['success'] = true;
        $response['data'] = array(
            'nights' => $nights,
            'base_price' => $total_base_price,
            'weekend_extra' => $weekend_extra,
            'extra_people_cost' => $extra_people_cost,
            'extra_people_count' => $extra_people,
            'discount' => $discount_amount,
            'subtotal' => $subtotal,
            'total_price' => $final_total,
            'price_per_night' => round($total_base_price / $nights),
            'daily_breakdown' => $daily_breakdown,
            'check_in_jalali' => jdate('Y/m/d', strtotime($check_in)),
            'check_out_jalali' => jdate('Y/m/d', strtotime($check_out))
        );
        
    } catch (Exception $e) {
        $response['message'] = $e->getMessage();
    }
    
    wp_send_json($response);
}

function calender_next_month_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/Calender.php";
    $date_now = date("y-m-d");
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"];
    $next_month = date("Y-m-d", strtotime("+" . $priod . " month", strtotime($date_now)));
    $price_date = get_post_meta($pid, "resistance_calender");
    $next_calender = new Calendar($next_month);
    // Ensure next/prev buttons carry pid so front-end AJAX keeps working
    if (!empty($pid)) {
        if (method_exists($next_calender, 'set_id')) {
            $next_calender->set_id($pid);
        }
    }
    // Pass reserved dates so reserved/unavailable days stay disabled after AJAX
    if (!empty($res) && method_exists($next_calender, 'set_reserved_dates')) {
        $next_calender->set_reserved_dates($res);
    }
    foreach ($price_date[0] as $key => $row) {
        $next_calender->add_event($row / 1000, $key);
    }
    echo $next_calender;
    exit(0);
}
function calender_prev_month_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/Calender.php";
    $date_now = date("y-m-d");
    $now_priod = "";
    $prev_month = "";
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"];
    $now_priod = $priod - 1;
    if($now_priod != 0) {
        $prev_month = date("Y-m-d", strtotime("+" . $now_priod . " month", strtotime($this_month)));
    } else {
        $prev_month = date("Y-m-d");
    }
    if($prev_month <= $date_now) {
        $price_date = get_post_meta($pid, "resistance_calender");
        $prev_calender = new Calendar($prev_month);
        if (!empty($pid)) {
            if (method_exists($prev_calender, 'set_id')) {
                $prev_calender->set_id($pid);
            }
        }
        if (!empty($res) && method_exists($prev_calender, 'set_reserved_dates')) {
            $prev_calender->set_reserved_dates($res);
        }
        foreach ($price_date[0] as $key => $row) {
            $prev_calender->add_event($row / 1000, $key);
        }
        echo $prev_calender;
        exit(0);
    }
}
function get_archive_search_func()
{
    $html = (require "archive.php");
    return $html;
}
function get_archive_filter_func()
{
    $taxonomy = "";
    $post_people_num = "";
    $post_date = "";
    $post_min_price = "";
    $post_max_price = "";
    $room_s_number = "";
    $term_id = "";
    if(isset($_POST["post_people_num"]) && $_POST["post_people_num"] != 0) {
        $post_people_num = (int) $_POST["post_people_num"];
    }
    if(isset($_POST["room_search_num"]) && $_POST["room_search_num"] != 0) {
        $room_s_number = (int) $_POST["room_search_num"];
    }
    if(isset($_POST["post_min_price"]) && $_POST["post_min_price"] != "") {
        $post_min_price = $_POST["post_min_price"];
    } else {
        $post_min_price = 0;
    }
    if(isset($_POST["post_max_price"]) && $_POST["post_max_price"] != 0) {
        $post_max_price = $_POST["post_max_price"];
    } else {
        $post_max_price == 20000000;
    }
    if(isset($_POST["taxonomy"])) {
        $taxonomy = $_POST["taxonomy"];
    }
    if(isset($_POST["term_id"])) {
        $term_id = $_POST["term_id"];
    }
    if($term_id) {
        $args = ["post_type" => ["residence", "hotel"], "posts_per_page" => "-1", "tax_query" => [["taxonomy" => $taxonomy, "field" => "id", "terms" => $term_id]], "post_status" => "publish"];
    } else {
        $args = ["post_type" => ["residence", "hotel"], "posts_per_page" => "-1", "post_status" => "publish"];
    }
    $myposts = get_posts($args);
    $filter_posts = [];
    foreach ($myposts as $rows) {
        $post_type = get_post_type($rows->ID);
        $price = 0;
        if($post_type == "residence") {
            $meta = get_post_meta($rows->ID, "_all_res_meta", false);
            $price = $meta[0]["price"];
            $total_capacity = $meta[0]["total_capacity"];
            $room_number = $meta[0]["number_room"];
            if($post_min_price <= $price && $meta[0]["price"] <= $post_max_price && $post_people_num <= $total_capacity && $room_s_number <= $room_number) {
                $filter_posts[] = $rows;
            }
        }
        if($post_type == "hotel") {
            $hotel_rooms = get_post_meta($rows->ID, "rooms_info", true);
            $all_room_price = [];
            if($hotel_rooms) {
                foreach ($hotel_rooms as $room) {
                    $all_room_price[] = $room["room_normal_price"];
                }
                $min_price = min($all_room_price);
                $total_capacity = $room["room_single_bed"] + $room["room_Double_bed"];
            }
            if($post_min_price <= $min_price && $min_price <= $post_max_price && $post_people_num <= $total_capacity) {
                $filter_posts[] = $rows;
            }
        }
    }
    $html = "";
    if($filter_posts) {
        foreach ($filter_posts as $row) {
            $meta = get_post_meta($row->ID, "_all_res_meta", false);
            $term_obj_list = get_the_terms($row->ID, "city");
            $terms_string = join("،", wp_list_pluck($term_obj_list, "name"));
            $post_type = get_post_type($row->ID);
            $pri = 0;
            if($post_type == "residence") {
                $meta = get_post_meta($row->ID, "_all_res_meta", false);
                $pri = $meta[0]["price"];
            }
            if($post_type == "hotel") {
                $hotel_rooms = get_post_meta($row->ID, "rooms_info", true);
                $all_room_price = [];
                if($hotel_rooms) {
                    foreach ($hotel_rooms as $room) {
                        $all_room_price[] = $room["room_normal_price"];
                    }
                    $pri = min($all_room_price);
                    $total_capacity = $room["room_single_bed"] + $room["room_Double_bed"];
                }
            }
            $image = wp_get_attachment_image_src(get_post_thumbnail_id($row->ID), "medium");
            $html .= (require "template-parts/archive_template.php");
        }
    } else {
        $html .= (require "template-parts/no_archive_template.php");
    }
    exit(0);
}
function show_site_logo()
{
    $custom_logo_id = get_theme_mod("custom_logo");
    $image = wp_get_attachment_image_src($custom_logo_id, "small");
    $site_link = home_url();
    echo "<img class='show_site_log' src='" . $image[0] . "' ></a>";
}
function add_remove_favorite_func()
{
    $user_id = "";
    $residence_id = "";
    $all_user_favorite = [];
    if(isset($_POST["uird"])) {
        $urid = explode("-", $_POST["uird"]);
        $residence_id = (int) $urid[0];
        $user_id = (int) $urid[1];
    }
    $usser_favorits = get_user_meta($user_id, "user_favorite", true);
    if(count($usser_favorits) == 0) {
        $all_user_favorite[] = $residence_id;
        $favo_serial = serialize($all_user_favorite);
        update_user_meta($residence_id, "user_favorite", $favo_serial);
    } elseif(count($usser_favorits) != 0) {
        $all_user_favorite = unserialize($usser_favorits);
        if(!in_array($residence_id, $all_user_favorite)) {
            $all_user_favorite[] = $residence_id;
            $all_favorite_serial = serialize($all_user_favorite);
            update_user_meta($user_id, "user_favorite", $all_favorite_serial);
        } else {
            $pis = array_search($residence_id, $all_user_favorite);
            unset($all_user_favorite[$pis]);
            $all_favorite_serial = serialize($all_user_favorite);
            update_user_meta($user_id, "user_favorite", $all_favorite_serial);
        }
    }
    exit(0);
}
function remove_favo_page_func()
{
    $user_id = "";
    $residence_id = "";
    $all_user_favorite = [];
    if(isset($_POST["uird"])) {
        $urid = explode("-", $_POST["uird"]);
        $residence_id = (int) $urid[0];
        $user_id = (int) $urid[1];
    }
    $usser_favorits = get_user_meta($user_id, "user_favorite", true);
    $all_user_favorite = unserialize($usser_favorits);
    $pis = array_search($residence_id, $all_user_favorite);
    unset($all_user_favorite[$pis]);
    $all_favorite_serial = serialize($all_user_favorite);
    update_user_meta($user_id, "user_favorite", $all_favorite_serial);
}
function send_mobile_to_check_func($check_number_exis)
{
    $mobile_number = "";
    if(isset($_POST["mnumber"])) {
        $mobile_number = $_POST["mnumber"];
    }
    global $wpdb;
    $table_name = $wpdb->prefix . "opt";
    $opt = rand(1000, 9999);
    $created_date = date("Y m d H:i:s");
    $expire_date = date("d-m-Y H:i:s", strtotime("+2 min"));
    $check_number_exist = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE phone_number = " . $mobile_number, OBJECT);
    if($check_number_exist) {
        $wpdb->update($table_name, ["phone_number" => $mobile_number, "opt_code" => $opt, "created_date" => $created_date, "expire_date" => $expire_date], ["id" => $check_number_exist->id], ["%s", "%d", "%s", "%s", "%d"], ["%d"]);
        $txt = "" . $opt . "";
        if(sms_opt) {
            $body_id = sms_opt;
            require "sms/" . sms_samaneh_name . ".php";
        }
    } else {
        $wpdb->insert($table_name, ["phone_number" => $mobile_number, "opt_code" => $opt, "created_date" => $created_date, "expire_date" => $expire_date]);
        $txt = "" . $opt . "";
        if(sms_opt) {
            $body_id = sms_opt;
            require "sms/" . sms_samaneh_name . ".php";
        }
    }
    $html = (require "template-parts/login_template.php");
    exit(0);
}
function refresh_op_func()
{
    $mobile_number = "";
    if(isset($_POST["mnumber"])) {
        $mobile_number = $_POST["mnumber"];
    }
    global $wpdb;
    $table_name = $wpdb->prefix . "opt";
    $opt = rand(1000, 9999);
    $created_date = date("Y m d H:i:s");
    $expire_date = date("d-m-Y H:i:s", strtotime("+2 min"));
    $check_number_exist = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE phone_number = " . $mobile_number, OBJECT);
    if($check_number_exist) {
        $wpdb->update($table_name, ["phone_number" => $mobile_number, "opt_code" => $opt, "created_date" => $created_date, "expire_date" => $expire_date], ["id" => $check_number_exist->id], ["%s", "%d", "%s", "%s", "%d"], ["%d"]);
    } else {
        $wpdb->insert($table_name, ["phone_number" => $mobile_number, "opt_code" => $opt, "created_date" => $created_date, "expire_date" => $expire_date]);
    }
}
function check_opt_func()
{
    $mobile_number = "";
    $opt_code = "";
    if(isset($_POST["mnumber"])) {
        $mobile_number = $_POST["mnumber"];
    }
    if(isset($_POST["opt"])) {
        $opt_code1 = $_POST["opt"];
        $opt_code = implode("", $opt_code1);
    }
    global $wpdb;
    $table_name = $wpdb->prefix . "opt";
    $created_date = date("Y-m-d H:i:s");
    $check_exp = 0;
    $check_code = 0;
    $error = "";
    $html = "";
    $get_number_info = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE phone_number = " . $mobile_number, OBJECT);
    $number_opt = $get_number_info->opt_code;
    $expire_date = $get_number_info->expire_date;
    if(strtotime($expire_date) <= strtotime($created_date)) {
        $check_exp = 1;
        $error = "زمان استفاده از کد یکبار مصرف به پایان رسیده.";
    }
    if($check_exp == 0) {
        if($opt_code == $number_opt) {
        } else {
            $error = "رمز یکبار مصرف اشتباه وارد شده.";
        }
    }
    if($error != "") {
        echo $error;
    } else {
        $html = (require "template-parts/set_password_template.php");
        echo $html;
    }
    exit(0);
}
function get_register_template_func()
{
    $html = (require "template-parts/register_template.php");
    exit(1);
}
function create_user_one_func()
{
    $user_login = "";
    $password = "";
    if(isset($_POST["u_login"])) {
        $user_login = $_POST["u_login"];
    }
    if(isset($_POST["password"])) {
        $password = $_POST["password"];
    }
    wp_create_user($user_login, $password);
    $creds = ["user_login" => $user_login, "user_password" => $password, "remember" => false];
    $user = wp_signon($creds, true);
    if(sms_user_register_to_admin) {
        send_sms_func($user_login, sms_user_register_to_admin, modir_phone);
    }
    if(sms_user_register) {
        send_sms_func($user_login, sms_user_register, $user_login);
    }
    exit(0);
}
function direct_login_func()
{
    $user_login = "";
    $opt_code = "";
    if(isset($_POST["user_name"])) {
        $user_login = $_POST["user_name"];
    }
    $user = get_user_by("login", $user_login);
    if(!is_wp_error($user)) {
        wp_clear_auth_cookie();
        wp_set_current_user($user->ID);
        wp_set_auth_cookie($user->ID);
        exit;
    }
    exit(0);
}
function pass_login_func()
{
    $user_login = "";
    $password = "";
    if(isset($_POST["user_name"])) {
        $user_login = $_POST["user_name"];
    }
    if(isset($_POST["password"])) {
        $password = $_POST["password"];
    }
    $creds = ["user_login" => $user_login, "user_password" => $password, "remember" => true];
    $user = wp_signon($creds, false);
    if(is_wp_error($user)) {
        echo "پسورد اشتباه وارد شده";
    }
    exit(0);
}
function change_user_password_func()
{
    $old_pass = "";
    $new_pass = "";
    $old_pass_database = "";
    $error = "";
    $user = get_currentuserinfo();
    $old_pass_database = $user->user_pass;
    if(isset($_POST["new_pass"])) {
        $new_pass = $_POST["new_pass"];
    }
    if(isset($_POST["old_pass"])) {
        $old_pass = $_POST["old_pass"];
    }
    $hashed_password = wp_check_password($old_pass, $user->data->user_pass, $user->ID);
    if($hashed_password != 1) {
        $error = "رمز عبور فعلی صحیح وارد نشده";
    } else {
        $error = "";
    }
    if($error != "") {
        echo $error;
    } else {
        wp_set_password($new_pass, $user->ID);
    }
    exit(0);
}
function update_user_info_func()
{
    $uid = get_current_user_id();
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $melli_code = $_POST["melli_code"];
    $gender = $_POST["gender"];
    $birth_date = $_POST["birth_date"];
    $user_mobile = $_POST["user_mobile"];
    $user_email = $_POST["user_email"];
    $user_phone = $_POST["user_phone"];
    $user_description = $_POST["user_description"];
    $user_cart = $_POST["bank_cart_num"];
    $user_shaba = $_POST["bank_shaba_num"];
    $user_bacount_name = $_POST["bank_account_name"];
    $bank_name = $_POST["bank_name"];
    $metas = ["first_name" => $first_name, "last_name" => $last_name, "gender" => $gender, "melli_code" => $melli_code, "birth_date" => $birth_date, "user_mobile" => $user_mobile, "user_email" => $user_email, "user_phone" => $user_phone, "description" => $user_description, "user_cart" => $user_cart, "user_shaba" => $user_shaba, "user_bacount_name" => $user_bacount_name, "bank_name" => $bank_name];
    foreach ($metas as $key => $value) {
        update_user_meta($uid, $key, $value);
    }
    $args = ["ID" => $uid, "user_email" => esc_attr($_POST["user_email"])];
    wp_update_user($args);
    exit(0);
}
function DateDifference($firstDate, $secondDate)
{
    list($fdY, $fdM, $fdD) = explode("-", $firstDate);
    list($sdY, $sdM, $sdD) = explode("-", $secondDate);
    $fts = jmktime(0, 0, 0, $fdM, $fdD, $fdY);
    $sts = jmktime(0, 0, 0, $sdM, $sdD, $sdY);
    $diff = $sts - $fts;
    return round($diff / 86400);
}
function file_upload_user_image_callback()
{
    $user = get_current_user_id();
    check_ajax_referer("file_upload", "security");
    $arr_img_ext = ["image/png", "image/jpeg", "image/jpg"];
    if(in_array($_FILES["file"]["type"], $arr_img_ext)) {
        $upload = wp_upload_bits($_FILES["file"]["name"], NULL, file_get_contents($_FILES["file"]["tmp_name"]));
        $old_file = get_user_meta($user, "user_profile_imsge");
        $relative_old_file = wp_make_link_relative($old_file[0]);
        update_user_meta($user, "user_profile_imsge", $upload["url"]);
    }
    wp_die();
}
function reload_user_image_func()
{
    $user = get_current_user_id();
    $image_url = get_user_meta($user, "user_profile_imsge");
    echo $image_url[0];
    wp_die();
}
function calc_order_price($checkin, $checkout, $res_id, $no_people)
{
    $post_data = get_post_meta($res_id, "_all_res_meta", false);
    $price = $post_data[0]["price"];
    $add_price_price = $post_data[0]["extra_person"];
    $total_capacity = $post_data[0]["total_capacity"];
    $base_capacity = $post_data[0]["base_capacity"];
    if($no_people != 0) {
        $add_people_num = $no_people - $base_capacity;
    }
    $days = datedifference($checkin, $checkout);
    $all_dates = get_beetween_date($checkin, $checkout);
    $all_calender = get_post_meta($res_id, "resistance_calender");
    $calender = [];
    foreach ($all_calender[0] as $key => $row) {
        if(in_array($key, $all_dates)) {
            $calender[$key] = $row;
        }
    }
    $count_value = array_count_values($calender);
    $date_prices = [];
    foreach ($all_dates as $row) {
        if(array_key_exists($row, $calender)) {
            $date_prices[$row] = $calender[$row];
        }
    }
    $sub_price_without_extend = array_sum($date_prices);
    if(0 < $add_people_num) {
        $sub_add_people_price = $add_people_num * $add_price_price * $days;
    }
    if(0 <= $sub_add_people_price) {
        $total_price = number_format($sub_price_without_extend + $sub_add_people_price);
    } else {
        $total_price = number_format($sub_price_without_extend);
    }
    $all_price_info = ["total_price" => $total_price, "sub_add_people_price" => $sub_add_people_price, "add_people_num" => $add_people_num, "count_value" => $count_value];
    return $all_price_info;
}
function order_exist_check($checkin, $checkout, $res_id, $no_people, $user_id)
{
    global $wpdb;
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  check_in = '" . $checkin . "' and check_out = '" . $checkout . "' and res_id = " . $res_id . " and passenger_number = " . $no_people . " and user_id =" . $user_id, ARRAY_A);
    return $results;
}
function order_exist_check2($checkin, $checkout, $res_id, $no_people, $user_id, $order_status)
{
    global $wpdb;
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  check_in = '" . $checkin . "' and check_out = '" . $checkout . "' and res_id = " . $res_id . " and passenger_number = " . $no_people . " and user_id =" . $user_id . " and order_status =" . $order_status . " ", ARRAY_A);
    return $results;
}
function insert_order_table($checkin, $checkout, $res_id, $no_people, $price, $order_status, $discount_price = NULL)
{
    global $wpdb;
    $author_id = get_post_field("post_author", $res_id);
    $start_timer = time();
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $table_name = $wpdb->prefix . "jayto_orders";
    $wpdb->insert($table_name, ["res_id" => $res_id, "user_id" => $user_id, "author_id" => $author_id, "passenger_number" => $no_people, "check_in" => $checkin, "check_out" => $checkout, "price" => $price, "start_timer" => $start_timer, "order_status" => $order_status, "discount_price" => $discount_price], ["%d", "%d", "%d", "%d", "%s", "%s", "%d", "%d", "%d", "%d"]);
}
function insert_order_table_confirm($checkin, $checkout, $res_id, $no_people, $price, $order_status, $discount_price = NULL)
{
    global $wpdb;
    $author_id = get_post_field("post_author", $res_id);
    $start_timer = time();
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $table_name = $wpdb->prefix . "jayto_orders";
    $wpdb->insert($table_name, ["res_id" => $res_id, "user_id" => $user_id, "author_id" => $author_id, "passenger_number" => $no_people, "check_in" => $checkin, "check_out" => $checkout, "price" => $price, "start_timer" => $start_timer, "order_status" => $order_status, "confirm_status" => "confirm", "discount_price" => $discount_price], ["%d", "%d", "%d", "%d", "%s", "%s", "%d", "%d", "%d", "%s"]);
}
function get_user_orders($user_role)
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    global $wpdb;
    if($user_role == "host") {
        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  author_id=" . $user_id . " ORDER BY id DESC ", object);
    } elseif($user_role == "guest") {
        $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  user_id=" . $user_id . " ORDER BY id DESC ", object);
    }
    return $results;
}
function get_user_trips($user_role = NULL, $userid = NULL)
{
    if($userid == NULL) {
        $user = wp_get_current_user();
        $user_id = $user->ID;
    } else {
        $user_id = $userid;
    }
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  user_id=" . $user_id . " ORDER BY id DESC ", object);
    $hot_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  user_id=" . $user_id . " ORDER BY id DESC ", object);
    foreach ($hot_results as $row) {
        $obj = new stdClass();
        $obj->res_id = $row->hot_id;
        $obj->author_id = $row->author_id;
        $obj->user_id = $row->user_id;
        $obj->start_timer = $row->start_timer;
        $obj->order_status = $row->order_status;
        $obj->cancel_date = $row->cancel_date;
        $obj->cancel_price = $row->cancel_price;
        $obj->price = $row->price;
        $obj->host_share = $row->host_share;
        $obj->check_in = change_slash_to_dash($row->check_in);
        $obj->check_out = change_slash_to_dash($row->check_out);
        $obj->hotel = 1;
        $obj->room_id = $row->room_id;
        $obj->id = $row->id;
        $obj->adult_number = $row->adult_number;
        $obj->child_number = $row->child_number;
        $obj->passenger_number = $row->child_number + $row->adult_number;
        $obj->discount = $row->discount_price;
        $results[] = $obj;
    }
    return $results;
}
function get_user_tour_trips($user_role = NULL, $userid = NULL)
{
    if($userid == NULL) {
        $user = wp_get_current_user();
        $user_id = $user->ID;
    } else {
        $user_id = $userid;
    }
    $user_posts = [3128];
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "tour_reserve_request  ", object);
    return $results;
}
function change_slash_to_dash($string)
{
    $exp = explode("/", $string);
    $imp = implode("-", $exp);
    return $imp;
}
function get_host_requests()
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  author_id=" . $user_id . " ORDER BY id DESC  ", object);
    $hot_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  author_id=" . $user_id . " ORDER BY id DESC  ", object);
    foreach ($hot_results as $row) {
        $obj = new stdClass();
        $obj->res_id = $row->hot_id;
        $obj->author_id = $row->author_id;
        $obj->user_id = $row->user_id;
        $obj->start_timer = $row->start_timer;
        $obj->order_status = $row->order_status;
        $obj->cancel_date = $row->cancel_date;
        $obj->cancel_price = $row->cancel_price;
        $obj->price = $row->price;
        $obj->host_share = $row->host_share;
        $obj->check_in = change_slash_to_dash($row->check_in);
        $obj->check_out = change_slash_to_dash($row->check_out);
        $obj->hotel = 1;
        $obj->room_id = $row->room_id;
        $obj->id = $row->id;
        $obj->adult_number = $row->adult_number;
        $obj->child_number = $row->child_number;
        $obj->passenger_number = $row->child_number + $row->adult_number;
        $obj->discount = $row->discount_price;
        $results[] = $obj;
    }
    return $results;
}
function change_date_to_alt($check_in, $check_out)
{
    $jalali_checkin_array = explode("-", $check_in);
    $jalali_checkout_array = explode("-", $check_out);
    $milady_checkin = implode("-", jalali_to_gregorian($jalali_checkin_array[0], $jalali_checkin_array[1], $jalali_checkin_array[2]));
    $milady_checkout = implode("-", jalali_to_gregorian($jalali_checkout_array[0], $jalali_checkout_array[1], $jalali_checkout_array[2]));
    $alt_checkin = jdate("d F", strtotime($milady_checkin));
    $alt_checkout = jdate("d F", strtotime($milady_checkout));
    return ["check_in" => $alt_checkin, "checkout" => $alt_checkout];
}
function change_slash_date_to_alt($check_in, $check_out)
{
    $jalali_checkin_array = explode("/", $check_in);
    $jalali_checkout_array = explode("/", $check_out);
    $milady_checkin = implode("-", jalali_to_gregorian($jalali_checkin_array[0], $jalali_checkin_array[1], $jalali_checkin_array[2]));
    $milady_checkout = implode("-", jalali_to_gregorian($jalali_checkout_array[0], $jalali_checkout_array[1], $jalali_checkout_array[2]));
    $alt_checkin = jdate("d F", strtotime($milady_checkin));
    $alt_checkout = jdate("d F", strtotime($milady_checkout));
    return ["check_in" => $alt_checkin, "checkout" => $alt_checkout];
}
function change_slash_date_to_alt_d($check_in, $check_out)
{
    $jalali_checkin_array = explode("/", $check_in);
    $jalali_checkout_array = explode("/", $check_out);
    $alt_checkin = implode("-", $jalali_checkin_array);
    $alt_checkout = implode("-", $jalali_checkout_array);
    $all_date = get_beetween_date($alt_checkin, $alt_checkout);
    return $all_date;
}
function change_date_dash_to_slash($date)
{
    $jalali_checkin_array = explode("-", $date);
    $milady_checkin = implode("/", jalali_to_gregorian($jalali_checkin_array[0], $jalali_checkin_array[1], $jalali_checkin_array[2]));
    $alt_dash_date = jdate("Y/m/d", strtotime($milady_checkin), "", "", "en");
    return $alt_dash_date;
}
function calc_reserve_timer($start_timer)
{
    $timer = get_option("answer_request_time");
    $timer_inserted = date("Y-m-d H:i:s", $start_timer);
    $timer_now = date("Y-m-d H:i:s");
    $min = strtotime($timer_now) - strtotime($timer_inserted);
    $now = new DateTime();
    $future_date = new DateTime($timer_inserted);
    $interval = $future_date->diff($now);
    $min_left = $interval->format("%i") * 60;
    $sec_left = $interval->format("%s");
    $date_left = (int) $sec_left + (int) $min_left;
    if($date_left <= $timer) {
        $timer = $timer - $date_left;
    } elseif($timer < $date_left) {
        $timer = 0;
    }
    return $timer;
}
function calc_reserve_timer_submit($start_timer)
{
    $timer = get_option("pay_time");
    $timer_inserted = date("Y-m-d H:i:s", $start_timer);
    $timer_now = date("Y-m-d H:i:s");
    $min = strtotime($timer_now) - strtotime($timer_inserted);
    $now = new DateTime();
    $future_date = new DateTime($timer_inserted);
    $interval = $future_date->diff($now);
    $min_left = $interval->format("%i") * 60;
    $sec_left = $interval->format("%s");
    $date_left = (int) $sec_left + (int) $min_left;
    if($date_left <= $timer) {
        $timer = $timer - $date_left;
    } elseif($timer < $date_left) {
        $timer = 0;
    }
    return $timer;
}
function set_reserve_date($res_id, $checkin, $checkout)
{
    $reserves = get_post_meta($res_id, "resistance_reserves", true);
    $dates = get_beetween_date($checkin, $checkout);
    if($reserves) {
        foreach ($dates as $row) {
            $reserves[] = $row;
        }
    } else {
        $reserves = $dates;
    }
    update_post_meta($res_id, "resistance_reserves", $reserves);
}
function set_hotel_reserve_date($hotel_id, $checkin, $checkout, $room_id)
{
    $reserves = get_post_meta($hotel_id, "hotel_reserves" . $room_id, true);
    $dates = get_beetweens_date($checkin, $checkout);
    if($reserves) {
        foreach ($dates as $row) {
            $reserves[] = $row;
        }
    } else {
        $reserves = $dates;
    }
    update_post_meta($hotel_id, "hotel_reserves" . $room_id, $reserves);
}
function remove_reserve_date()
{
    $res_id = $_POST["res_id"];
    $dates = $_POST["date"];
    $oid = $_POST["oid"];
    $order_status = 5;
    if(isset($_POST["cancel"]) && $_POST["cancel"] == 1) {
        $order_status = 3;
    }
    $all_reserve_date = get_post_meta($res_id, "resistance_reserves", true);
    foreach ($dates as $row) {
        $key = array_search($row, $all_reserve_date);
        if(false !== $key) {
            unset($all_reserve_date[$key]);
        }
    }
    update_post_meta($res_id, "resistance_reserves", $all_reserve_date);
    update_exist_order($oid, $order_status);
}
function get_rooms_hotel_func()
{
    $hotel_id = $_POST["hotel_id"];
    $hotel_rooms = get_post_meta($hotel_id, "rooms_info", true);
    $hotel_option = get_post_meta($hotel_id, "all_hotel_meta", true);
    $child_bed_need = $hotel_option["child_bed_need"];
    $date_in = $_POST["date_in"];
    $date_out = $_POST["date_out"];
    $beet_dates = get_beetween_date(change_slash_to_dash($date_in), change_slash_to_dash($date_out));
    $number_of_day = count($beet_dates);
    $adult = $_POST["adult"];
    $under_tow_num = $_POST["under_tow_num"];
    $under_tow_bed_need = "";
    $under_2_6_bed_need = "";
    $child_up_six_bed_need = "";
    setcookie("hin_dat", $date_in, time() + 60, "/");
    setcookie("hout_dat", $date_out, time() + 60, "/");
    if($child_bed_need <= 0) {
        $under_tow_bed_need = $under_tow_num;
    }
    $chil2_6 = $_POST["chil2_6"];
    if(2 < $child_bed_need) {
        $under_2_6_bed_need = $chil2_6;
    }
    $child_up_six = $_POST["child_up_six"];
    if(6 <= $child_bed_need) {
        $child_up_six_bed_need = $child_up_six;
    }
    $sum_chield = $_POST["sum_chield"];
    $sum_of_need_room = "";
    $sum_of_bed = $adult + $under_tow_bed_need + $under_2_6_bed_need + $child_up_six_bed_need;
    $available_room = [];
    foreach ($hotel_rooms as $key => $row) {
        if($sum_of_bed <= $row["bed_count"]) {
            $available_room[$key] = $row;
        }
    }
    $html = "";
    $room_pr_check = [];
    foreach ($available_room as $key => $row) {
        $room_dates = get_post_meta($hotel_id, "hotel_calender" . $key, true);
        $reseveed_room = get_post_meta($hotel_id, "hotel_reserves" . $key, true);
        $rid = $key;
        $tips_number = $row["room_tip_number"];
        $ndate = new DateTime();
        $now_date = $ndate->format("Y/m/d");
        $discount_ifo = $row["discount"];
        $in_discount = "false";
        $discount = 0;
        $start_date_jalali = $discount_ifo["start_date "];
        $end_date_jalali = $discount_ifo["end_date"];
        $start_array = explode("/", $start_date_jalali);
        $end_array = explode("/", $end_date_jalali);
        $end_date = jmktime("23", "0", "0", $end_array[1], $end_array[2], $end_array[0], "", "");
        $start_date = jmktime("23", "0", "0", $start_array[1], $start_array[2], $start_array[0], "", "");
        $start_date = date("Y/m/d", $start_date);
        $end_date = date("Y/m/d", $end_date);
        if($start_date <= $now_date && $now_date <= $end_date) {
            $in_discount = "true";
        }
        if($in_discount == "true") {
            $discount_percent = $discount_ifo["perscent_discount"];
        }
        $room_price = [];
        $days_avaleble = [];
        $count_date_reserve = array_count_values($reseveed_room);
        foreach ($count_date_reserve as $key => $value) {
            if(array_key_exists($key, $room_dates) && $tips_number <= $rn) {
                unset($room_dates[$key]);
            }
        }
        foreach ($beet_dates as $date) {
            $rn = $count_date_reserve[$date];
            if(key_exists($date, $room_dates) && $rn < $tips_number) {
                $days_avaleble[] = $date;
                $room_price[] = $room_dates[$date];
            }
        }
        $sum_room_price = array_sum($room_price);
        if($room_price) {
            $room_pr_check[] = $room_price;
            if(count($days_avaleble) == $number_of_day) {
                $html .= (require "template-parts/room_for_res_template.php");
            }
        }
    }
    if(!$room_pr_check) {
        echo "        <div class=\"not_post_found\">\n\n            <div class=\"dfcc\">\n\n                <img src=\"";
        echo get_template_directory_uri();
        echo "/images/images.png\" alt=\"\">\n                <span>موردی مطابق با جستجوی شما یافت نشد تاریخ دیگری را انتخاب نمایید.</span>\n            </div>\n        </div>\n\t";
    }
    exit(0);
}
function update_exist_order($order_id, $order_status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_orders";
    $wpdb->update($table_name, ["order_status" => $order_status], ["id" => $order_id], ["%d"], ["%d"]);
}
function update_exist_hotel_order($order_id, $order_status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_hotel_orders";
    $wpdb->update($table_name, ["order_status" => $order_status], ["id" => $order_id], ["%d"], ["%d"]);
}
function change_order_ststus_func()
{
    $order_id = $_POST["oid"];
    $os = $_POST["os"];
    $cf = $_POST["sc"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_orders";
    if($_POST["pt"] == "hotel") {
        $table_name = $wpdb->prefix . "jayto_hotel_orders";
    }
    $wpdb->update($table_name, ["order_status" => $os, "confirm_status" => $cf], ["id" => $order_id], ["%d", "%s"], ["%d"]);
    $order = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id = " . $order_id, OBJECT);
    $mo = get_user_by("id", $order->user_id);
    $mobile_number = $mo->user_login;
    if($os == 4 && sms_reserve_need_conf_to_guest) {
        send_sms_func($order->id, sms_reserve_need_conf_to_guest, $mobile_number);
    }
    if($order->order_status == 4 && sms_reserve_need_conf_to_guest) {
        send_sms_func($order->id, sms_reserve_need_conf_to_guest, $mobile_number);
    }
}
function delete_row_table($row_id)
{
    global $wpdb;
    $table = $wpdb->prefix . "jayto_orders";
    $wpdb->delete($table, ["id" => $row_id]);
}
function remove_hotels_rooms_func()
{
    $data = $_POST["data"];
    $data_exp = explode("-", $data);
    list($room_id, $hotel_id) = $data_exp;
    $hotel_room_old = get_post_meta($hotel_id, "rooms_info", true);
    unset($hotel_room_old[$room_id]);
    update_post_meta($hotel_id, "rooms_info", $hotel_room_old);
    echo "hi";
    exit(0);
}
function get_reserve_submit_func()
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $res_id = $_POST["res_id"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $no_people = $_POST["passenger_num"];
    $oi = $_POST["oi"];
    global $wpdb;
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  id = " . $oi . " ", ARRAY_A);
    $res = "confirm";
    if($results["order_status"] == 4 && $results["confirm_status"] != "confirm") {
        $table_name = $wpdb->prefix . "jayto_orders";
        $wpdb->update($table_name, ["start_timer" => time()], ["id" => $oi], ["%d"], ["%d"]);
        echo $res;
    } elseif($results["order_status"] == 4 && $results["confirm_status"] == "confirm") {
        echo $res;
    }
    if($results["order_status"] == 3) {
        echo "cancel";
    }
    exit(0);
}
function get_hreserve_submit_func()
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $res_id = $_POST["res_id"];
    $checkin = $_POST["checkin"];
    $checkout = $_POST["checkout"];
    $no_people = $_POST["passenger_num"];
    $oi = $_POST["oi"];
    global $wpdb;
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  id = " . $oi . " ", ARRAY_A);
    $res = "confirm";
    if($results["order_status"] == 4 && $results["confirm_status"] != "confirm") {
        $table_name = $wpdb->prefix . "jayto_hotel_orders";
        $wpdb->update($table_name, ["start_timer" => time()], ["id" => $oi], ["%d"], ["%d"]);
        echo $res;
    } elseif($results["order_status"] == 4 && $results["confirm_status"] == "confirm") {
        echo $res;
    }
    if($results["order_status"] == 3) {
        echo "cancel";
    }
    exit(0);
}
function get_pay_wallet_func()
{
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $user_info = get_user_meta($user_id);
    $amount = $_POST["amount"];
    $request_date = time();
    $res_orders = get_max_price_get();
    $user_wallet = get_user_meta($user_id, "jayto-wallet", true);
    $lock_price = array_sum($res_orders);
    $max_price_order = $user_wallet - $lock_price;
    $new_wallet_amount = $user_wallet - $amount;
    $pay_number_id = generateRandomString();
    $cart_info = $user_info["user_cart"][0];
    $cart_digits = strlen((string) $cart_info);
    $cart_check = "";
    if($cart_info != "" && $cart_digits == 16) {
        $cart_check = "ok";
    } else {
        $cart_check = "nok";
    }
    if($cart_check == "ok") {
        if($amount <= $max_price_order) {
            global $wpdb;
            $table_name = $wpdb->prefix . "jayto_request_wallet";
            $wpdb->insert($table_name, ["user_id" => $user_id, "amount" => $amount, "pay_status" => 0, "request_date" => $request_date, "pay_number" => $pay_number_id], ["%d", "%d", "%d", "%d", "%s"]);
            $new_wallet = update_user_meta($user_id, "jayto-wallet", $new_wallet_amount);
        } else {
            echo "max_order_error";
        }
    } else {
        echo "cart_check_nok";
    }
    exit(0);
}
function generateRandomString($length = 10)
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}
function set_sans_mobile()
{
    $sanse = $_POST["sans"];
    $pid = $_POST["pid"];
    $oid = $_POST["oid"];
    $sans_time = $_POST["sans_time"];
    $sans_date = $_POST["sans_date"];
    $old_sanse = get_post_meta($pid, "tour_sans", true);
    $sans_exp = explode(" ~ ", $sanse);
    if(isset($_POST["request_type"]) && $_POST["request_type"] != "") {
        $res_type = "private";
        $send_exp_sans = explode("/ ", $sanse);
        global $wpdb;
        $table_name_order = $wpdb->prefix . "tour_reserve_request";
        $wpdb->update($table_name_order, ["tour_date" => $sans_date, "sans" => $sans_time], ["id" => $oid], ["%s", "%s"], ["%d"]);
    } else {
        $res_type = "general";
    }
    $sans_array = [];
    if(!$old_sanse) {
        foreach ($sans_exp as $san) {
            $exp_dateTime = explode("/", $san);
            $sans_array[$exp_dateTime[0]] = [$exp_dateTime[1] => ["reserve" => 0, "reserve_ids" => [], "request_type" => $res_type]];
        }
        update_post_meta($pid, "tour_sans", $sans_array);
    } else {
        foreach ($sans_exp as $san) {
            $time_sanse = [];
            $exp_dateTime = explode("/", $san);
            if(!key_exists($exp_dateTime[0], $old_sanse)) {
                $old_sanse[$exp_dateTime[0]] = [$exp_dateTime[1] => ["reserve" => 0, "reserve_ids" => [], "request_type" => $res_type]];
            } elseif(!key_exists($exp_dateTime[1], $exp_dateTime[0])) {
                $exp_dateTime[1] = ["reserve" => 0, "reserve_ids" => [], "request_type" => $res_type];
                $old_sanse[$exp_dateTime[0]][$exp_dateTime[1]];
            }
        }
        update_post_meta($pid, "tour_sans", $old_sanse);
        echo json_encode($sanse);
    }
    exit(0);
}
function set_residence_dprice_func()
{
    $dates = $_POST["dates"];
    $price = $_POST["price"];
    $pid = $_POST["pid"];
    $old_prices = get_post_meta($pid, "res_day_price", true);
    $sixteen_prices = get_post_meta($pid, "resistance_calender", true);
    $date_exp = explode(" ~ ", $dates);
    if($old_prices) {
        $dprices = $old_prices;
    } else {
        $dprices = [];
    }
    foreach ($date_exp as $row) {
        $dprices[$row] = $price;
    }
    foreach ($dprices as $key => $row) {
        if(key_exists($key, $sixteen_prices)) {
            $sixteen_prices[$key] = $row;
        }
    }
    update_post_meta($pid, "res_day_price", $dprices);
    update_post_meta($pid, "resistance_calender", $sixteen_prices);
    exit(0);
}
function set_residence_custom_reserve_func()
{
    $dat = $_POST["dates"];
    $pid = $_POST["pid"];
    $old_date = get_post_meta($pid, "resistance_reserves", true);
    $host_blocked = get_post_meta($pid, "host_blocked_dates", true);
    $date_exp = explode(" ~ ", $dat);
    if(!$old_date) {
        $old_date = [];
    }
    if(!$host_blocked) { $host_blocked = []; }
    foreach ($date_exp as $row) {
        if(!in_array($row, $old_date)) {
            $old_date[] = $row;
        }
        if(!in_array($row, $host_blocked)) {
            $host_blocked[] = $row; // track host-specific blocks
        }
    }
    update_post_meta($pid, "resistance_reserves", $old_date);
    update_post_meta($pid, "host_blocked_dates", $host_blocked);
    exit(0);
}
function custom_reserve_return_func()
{
    $dates = $_POST["dates"];
    $pid = $_POST["pid"];
    $old_date = get_post_meta($pid, "resistance_reserves", true);
    $host_blocked = get_post_meta($pid, "host_blocked_dates", true);
    if(!$old_date) {
        $old_date = [];
    }
    if(!$host_blocked) { $host_blocked = []; }
    $date_exp = explode(" ~ ", $dates);
    foreach ($date_exp as $row) {
        $key = array_search($row, $old_date);
        if(false !== $key) {
            unset($old_date[$key]);
        }
        $hkey = array_search($row, $host_blocked);
        if(false !== $hkey) { unset($host_blocked[$hkey]); }
    }
    update_post_meta($pid, "resistance_reserves", $old_date);
    update_post_meta($pid, "host_blocked_dates", $host_blocked);
    exit(0);
}
function get_res_map_func()
{
    $res_id = $_POST["res_id"];
    $meta = get_post_meta($res_id, "_all_res_meta", true);
    $map_lat = $meta["map_point_lat"];
    $map_lng = $meta["map_point_lng"];
    $html = (require get_template_directory() . "/template-parts/get_res_map_template.php");
    echo $html;
}
function get_hres_map_func()
{
    $res_id = $_POST["res_id"];
    $meta = get_post_meta($res_id, "all_hotel_meta", true);
    $map_lat = $meta["map_point_lat"];
    $map_lng = $meta["map_point_lng"];
    $html = (require get_template_directory() . "/template-parts/get_res_map_template.php");
    echo $html;
}
function get_user_order_by_id($id)
{
    global $wpdb;
    $results = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  id=" . $id . " ", object);
    return $results;
}
function get_res_low_func($html)
{
    $res_id = $_POST["res_id"];
    $order_id = $_POST["order_id"];
    if(!isset($_GET["action"])) {
        $residence_id = $res_id;
    } else {
        $residence_id = create_post_id();
    }
    $meta = get_post_meta($res_id, "_all_res_meta", false);
    $cancel_type = $meta[0]["cancel_type"];
    $res_info = get_post($res_id);
    $order_info = get_user_order_by_id($order_id);
    $cancel_price = calc_user_cancel_price($order_info->check_in, $order_info->check_out, $res_id, $cancel_type, $order_info->price);
    $html = (require get_template_directory() . "/template-parts/residence_low_template.php");
    echo json_encode($html);
    exit(0);
}
function calc_res_cancel_func($html)
{
    global $wpdb;
    $res_id = $_POST["res_id"];
    $order_id = $_POST["order_id"];
    if(!isset($_GET["action"])) {
        $residence_id = $res_id;
    } else {
        $residence_id = create_post_id();
    }
    $meta = get_post_meta($res_id, "_all_res_meta", false);
    $cancel_type = $meta[0]["cancel_type"];
    $res_info = get_post($res_id);
    $order_info = get_user_order_by_id($order_id);
    $cancel_price = calc_user_cancel_price($order_info->check_in, $order_info->check_out, $res_id, $cancel_type, $order_info->price);
    $cancel_price_last = $order_info->price - $cancel_price;
    $hp = get_option("hoster_percent");
    $hoster_cancel = $order_info->host_share - $cancel_price * $hp / 100;
    $table_name_order = $wpdb->prefix . "jayto_orders";
    $user_id = $order_info->user_id;
    $hoster_id = $order_info->author_id;
    $guest_wallet = get_user_meta($user_id, "jayto-wallet", true);
    $new_guest_walet = $guest_wallet + $cancel_price_last;
    $hoster_wallet = get_user_meta($hoster_id, "jayto-wallet", true);
    $new_hoster_wallet = $hoster_wallet - $hoster_cancel;
    update_user_meta($user_id, "jayto-wallet", $new_guest_walet);
    update_user_meta($hoster_id, "jayto-wallet", $new_hoster_wallet);
    $wpdb->update($table_name_order, ["order_status" => 6, "cancel_date" => jdate("Y-m-d", "", "", "", "en"), "cancel_price" => $cancel_price_last], ["id" => $order_id], ["%d", "%s", "%d"], ["%d"]);
    $today = jdate("Y-m-d", "", "", "", "en");
    $checkin = $order_info->check_in;
    $checkout = $order_info->check_out;
    $all_reserve_date = get_post_meta($res_id, "resistance_reserves", true);
    $user_rereved_date = get_beetween_date($checkin, $checkout);
    if($today < $checkin) {
        foreach ($user_rereved_date as $row) {
            $key = array_search($row, $all_reserve_date);
            if(false !== $key) {
                unset($all_reserve_date[$key]);
            }
        }
        update_post_meta($res_id, "resistance_reserves", $all_reserve_date);
    } elseif($checkin <= $today) {
        $left_days = get_beetween_date($today, $checkin);
        foreach ($left_days as $row) {
            $key = array_search($row, $user_rereved_date);
            if(false !== $key) {
                unset($user_rereved_date[$key]);
            }
        }
        foreach ($user_rereved_date as $row) {
            $key = array_search($row, $all_reserve_date);
            if(false !== $key) {
                unset($all_reserve_date[$key]);
            }
        }
        update_post_meta($res_id, "resistance_reserves", $all_reserve_date);
    }
}
function calc_user_cancel_price($checkin, $checkout, $res_id, $cancel_type, $order_info)
{
    $all_dates = get_beetween_date($checkin, $checkout);
    $all_calender = get_post_meta($res_id, "resistance_calender");
    $calender = [];
    $today = jdate("Y-m-d", time(), "", "", "en");
    $checkin_exp = explode("-", $checkin);
    $checkin_timestamp = jmktime("0", "0", "0", $checkin_exp[1], $checkin_exp[2], $checkin_exp[0]);
    $one_day_before = $checkin_timestamp - 86400;
    $two_day_before = $checkin_timestamp - 172800;
    $four_day_before = $checkin_timestamp - 345600;
    $j_tow_day_before = jdate("Y-m-d", $two_day_before, "", "", "en");
    $j_one_day_before = jdate("Y-m-d", $one_day_before, "", "", "en");
    $j_four_day_before = jdate("Y-m-d", $four_day_before, "", "", "en");
    foreach ($all_calender[0] as $key => $row) {
        if(in_array($key, $all_dates)) {
            $calender[$key] = $row;
        }
    }
    $jarime = 0;
    if($checkout <= $today) {
        $jarime = $order_info;
    } else {
        if($cancel_type == "easy") {
            $easy_cancel_option = get_option("easy_cancel");
            if($today <= $j_one_day_before && $j_one_day_before < $checkin) {
                $jarime = $order_info * $easy_cancel_option["easy_one_day_before_recive"] / 100;
            }
            if($j_one_day_before < $today && $today < jdate("Y-m-d", $checkin_timestamp + 1, "", "", "en")) {
                $jarime = $order_info * $easy_cancel_option["easy_before_recive"] / 100;
            }
            if($checkin <= $today) {
                $calc_user_cancel_price = [];
                $left_date_price = [];
                $pss_date = get_beetween_date($checkin, $today);
                foreach ($pss_date as $row) {
                    $pass_date_price[$row] = $calender[$row];
                }
                $pass_day_price = array_sum($pass_date_price) * $easy_cancel_option["easy_after_recive1"] / 100;
                $left_days = get_beetween_date($today, $checkout);
                foreach ($left_days as $row) {
                    $left_date_price[$row] = $calender[$row];
                }
                if(1 < count($all_dates)) {
                    $left_day_price = array_sum($left_date_price) * $easy_cancel_option["easy_after_recive2"] / 100;
                    $jarime = $pass_day_price + $left_day_price;
                } else {
                    $jarime = $order_info;
                }
            }
        }
        if($cancel_type == "medium") {
            $medium_cancel_option = get_option("medium_cancel");
            if($today <= $j_tow_day_before) {
                $jarime = $order_info * $medium_cancel_option["medium_2day_before_recive"] / 100;
            }
            if($today == $j_one_day_before) {
                $jarime = $order_info * $medium_cancel_option["medium_before_recive"] / 100;
            }
            if($checkin <= $today) {
                $pass_date_price = [];
                $left_date_price = [];
                $pss_date = get_beetween_date($checkin, $today);
                foreach ($pss_date as $row) {
                    $pass_date_price[$row] = $calender[$row];
                }
                $pass_day_price = array_sum($pass_date_price) * $medium_cancel_option["medium_after_recive1 "] / 100;
                $left_days = get_beetween_date($today, $checkout);
                foreach ($left_days as $row) {
                    $left_date_price[$row] = $calender[$row];
                }
                if(1 < count($all_dates)) {
                    $left_day_price = array_sum($left_date_price) * $medium_cancel_option["medium_after_recive2"] / 100;
                    $jarime = $pass_day_price + $left_day_price;
                } else {
                    $jarime = $order_info;
                }
            }
        }
        if($cancel_type == "hard") {
            $hard_cancel_option = get_option("hard_cancel");
            if($today <= $j_four_day_before) {
                $all_reserve_date = get_beetween_date($checkin, $checkout);
                $first_night_price = $calender[$checkin];
                $left_date_price_array = [];
                unset($all_reserve_date[0]);
                foreach ($all_reserve_date as $row) {
                    $left_date_price_array[$row] = $calender[$row];
                }
                $left_price_sum = array_sum($left_date_price_array);
                $first_night_price_jarime = $first_night_price * $hard_cancel_option["hard_before_4day_recivee"] / 100;
                $left_price_sum_jarime = $left_price_sum * $hard_cancel_option["hard_4day_before_recive2"] / 100;
                $jarime = $first_night_price_jarime + $left_price_sum_jarime;
            }
            if($today <= jdate("Y-m-d", $checkin_timestamp + 1, "", "", "en") && $j_four_day_before < $today) {
                $all_reserve_date = get_beetween_date($checkin, $checkout);
                $first_night_price = $calender[$checkin];
                $left_date_price_array = [];
                unset($all_reserve_date[0]);
                foreach ($all_reserve_date as $row) {
                    $left_date_price_array[$row] = $calender[$row];
                }
                $left_price_sum = array_sum($left_date_price_array);
                $first_night_price_jarime = $first_night_price * $hard_cancel_option["hard_before_recive1"] / 100;
                $left_price_sum_jarime = $left_price_sum * $hard_cancel_option["hard_before_recive2"] / 100;
                $jarime = $first_night_price_jarime + $left_price_sum_jarime;
            }
            if($checkin <= $today) {
                $pass_date_price = [];
                $left_date_price = [];
                $pss_date = get_beetween_date($checkin, $today);
                foreach ($pss_date as $row) {
                    $pass_date_price[$row] = $calender[$row];
                }
                $pass_day_price = array_sum($pass_date_price) * $hard_cancel_option["hard_after_recive1 "] / 100;
                $left_days = get_beetween_date($today, $checkout);
                foreach ($left_days as $row) {
                    $left_date_price[$row] = $calender[$row];
                }
                if(1 < count($all_dates)) {
                    $left_day_price = array_sum($left_date_price) * $hard_cancel_option["hard_after_recive2"] / 100;
                    $jarime = $pass_day_price + $left_day_price;
                } else {
                    $jarime = $order_info;
                }
            }
        }
    }
    return $jarime;
}
function pay_from_wallet_func()
{
    global $wpdb;
    $oid = $_POST["oid"];
    $amount = $_POST["amount"];
    $passenger_name = $_POST["passenger_name"];
    $passenger_famili = $_POST["passenger_famili"];
    $passenger_phone = $_POST["passenger_phone"];
    $wallet_type = $_POST["wallet_type"];
    $user = wp_get_current_user();
    $user_id = $user->ID;
    $table_name = $wpdb->prefix . "jayto_transaction";
    $old_wallet = get_user_meta($user_id, "jayto-wallet", true);
    $new_wallet = $old_wallet - $amount;
    update_user_meta($user_id, "jayto-wallet", $new_wallet);
    $wpdb->insert($table_name, ["Authority" => "", "refid" => "", "user_id" => $user_id, "pay_date" => time(), "pay_status" => 1, "amount" => $amount, "orderid" => $oid, "transaction_desc" => "واریز وجه رزرو از کیف پول", "passenger_name" => $passenger_name, "passenger_famili" => $passenger_famili, "passenger_phone" => $passenger_phone], ["%s", "%s", "%d", "%d", "%d", "%d", "%d", "%s", "%s", "%s", "%s"]);
    $table_name_order = $wpdb->prefix . "jayto_orders";
    if($wallet_type == "hotel") {
        $table_name_order = $wpdb->prefix . "jayto_hotel_orders";
    }
    if($wallet_type == "experiences") {
        $table_name_order = $wpdb->prefix . "tour_reserve_request";
    }
    $wpdb->update($table_name_order, ["order_status" => 10], ["id" => $oid], ["%d"], ["%d"]);
    $or_id = $oid;
    $order_info = $wpdb->get_row("SELECT * FROM " . $table_name_order . " WHERE id = '" . $or_id . "'", ARRAY_A);
    $hp = get_option("hoster_percent");
    $old_wallet = get_user_meta($order_info["author_id"], "jayto-wallet", true);
    $new_wallet = $old_wallet + $order_info["price"] * $hp / 100;
    update_user_meta($order_info["author_id"], "jayto-wallet", $new_wallet);
    $wpdb->update($table_name_order, ["host_share" => $order_info["price"] * $hp / 100], ["id" => $order_info["id"]], ["%d"], ["%d"]);
    exit(0);
}
function get_transaction($user_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_transaction";
    $transaction = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE user_id = " . $user_id, ARRAY_A);
    return $transaction;
}
function get_max_price_get($user_role = "")
{
    global $wpdb;
    $author_id = get_current_user_id();
    $table_name = $wpdb->prefix . "jayto_orders";
    $author_orders = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE author_id = " . $author_id . " and order_status = 10", ARRAY_A);
    $prices = [];
    $today = time();
    foreach ($author_orders as $row) {
        $checkout_array = explode("-", $row["check_out"]);
        $checkout_time = jmktime(0, 0, 0, $checkout_array[1], $checkout_array[2], $checkout_array[0], "", "");
        if($today < $checkout_time) {
            if($user_role == "host") {
                $prices[] = $row["host_share"];
            } else {
                $prices[] = $row["price"];
            }
        }
    }
    return $prices;
}
function custom_insert_post_func()
{
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    global $wpdb;
    $post_id = $wpdb->insert_id;
    global $user_ID;
    if(isset($_POST["city_terms"])) {
        $city_ids = $_POST["city_terms"];
    }
    if(isset($_POST["region_terms_ids"])) {
        $region_ids = $_POST["region_terms_ids"];
    }
    if(isset($_POST["tools_terms_ids"])) {
        $tools_ids = $_POST["tools_terms_ids"];
    }
    if(isset($_POST["category_terms_ids"])) {
        $category_ids = $_POST["category_terms_ids"];
    }
    $custom_tax = ["city" => $city_ids, "region" => $region_ids, "tools" => $tools_ids, "categories" => $category_ids];
    $new_post = ["ID" => $post_id, "post_title" => $post_title, "post_content" => $post_content, "post_status" => "pending", "post_date" => date("Y-m-d H:i:s"), "post_author" => $user_ID, "post_type" => "residence"];
    $post_id = wp_insert_post($new_post);
    wp_set_post_terms($post_id, $region_ids, "region");
    wp_set_post_terms($post_id, $city_ids, "city");
    wp_set_post_terms($post_id, $tools_ids, "tools");
    wp_set_post_terms($post_id, $category_ids, "categories");
    if(isset($_POST["The_area_of_meter"])) {
        if(isset($_POST["od_tools"])) {
            $odt = $_POST["od_tools"];
        }
        if(isset($_POST["od_loyer"])) {
            $odl = $_POST["od_loyer"];
        }
        if(isset($_POST["attach_url"])) {
            $image_url = sanitize_text_field($_POST["attach_url"]);
        }
        if(isset($_POST["gallery_urls"])) {
            $gallery_urls = $_POST["gallery_urls"];
        }
        $all_residence_meta["The_area_of_meter"] = sanitize_text_field($_POST["The_area_of_meter"]);
        $all_residence_meta["total_area_of_building_meter"] = sanitize_text_field($_POST["total_area_of_building_meter"]);
        $all_residence_meta["residence_type"] = sanitize_text_field($_POST["residence_type"]);
        $all_residence_meta["reserve_type"] = sanitize_text_field($_POST["reserve_type"]);
        $all_residence_meta["cancel_type"] = sanitize_text_field($_POST["cancel_type"]);
        $all_residence_meta["base_capacity"] = sanitize_text_field($_POST["base_capacity"]);
        $all_residence_meta["total_capacity"] = sanitize_text_field($_POST["total_capacity"]);
        $all_residence_meta["number_room"] = sanitize_text_field($_POST["number_room"]);
        $all_residence_meta["Single_bed"] = sanitize_text_field($_POST["Single_bed"]);
        $all_residence_meta["double_bed"] = sanitize_text_field($_POST["double_bed"]);
        $all_residence_meta["mattress"] = sanitize_text_field($_POST["mattress"]);
        $all_residence_meta["Bathroom"] = sanitize_text_field($_POST["Bathroom"]);
        $all_residence_meta["iranian_toilet"] = sanitize_text_field($_POST["iranian_toilet"]);
        $all_residence_meta["sitting_toilet"] = sanitize_text_field($_POST["sitting_toilet"]);
        $all_residence_meta["price"] = sanitize_text_field($_POST["price"]);
        $all_residence_meta["end_week_price"] = sanitize_text_field($_POST["end_week_price"]);
        $all_residence_meta["extra_person"] = sanitize_text_field($_POST["extra_person"]);
        $all_residence_meta["od_tools"] = $odt;
        $all_residence_meta["od_loyer"] = $odl;
        $all_residence_meta["in_clock"] = sanitize_text_field($_POST["in_clock"]);
        $all_residence_meta["meli_pic"] = sanitize_text_field($_POST["meli_pic"]);
        $all_residence_meta["madarek_urls"] = $_POST["madarek_urls"];
        $all_residence_meta["res_address"] = sanitize_text_field($_POST["res_address"]);
        $all_residence_meta["out_clock"] = sanitize_text_field($_POST["out_clock"]);
        $all_residence_meta["map_point_lat"] = sanitize_text_field($_POST["map_point_lat"]);
        $all_residence_meta["map_point_lng"] = sanitize_text_field($_POST["map_point_lng"]);
        $all_residence_meta["posid"] = sanitize_text_field($_POST["posid"]);
        update_post_meta($post_id, "_all_res_meta", $all_residence_meta);
        update_post_meta($post_id, "codeid", $_POST["posid"]);
        $up_days_get = get_option("update_date_days");
        if($up_days_get == "") {
            $udg = 60;
        } else {
            $udg = $up_days_get;
        }
        $today = date("Y/m/d");
        $date_new = strtotime("+" . $udg . " days", strtotime($today));
        $date_sixteen = date("Y/m/d", $date_new);
        $exptoday = explode("/", $today);
        $expsixteen = explode("/", $date_sixteen);
        $per_today = gregorian_to_jalali($exptoday[0], $exptoday[1], $exptoday[2], "/");
        $seex_per_days = gregorian_to_jalali($expsixteen[0], $expsixteen[1], $expsixteen[2], "/");
        $calender = get_beetweens_date($per_today, $seex_per_days);
        $calender_price = [];
        $custom_price = get_post_meta($post_id, "res_day_price", true);
        if($calender) {
            foreach ($calender as $row) {
                $date_exp = explode("-", $row);
                $ts = jmktime("0", "0", "0", $date_exp[1], $date_exp[2], $date_exp[0]);
                $end_week = jstrftime("%a", $ts);
                if(array_key_exists($row, $custom_price)) {
                    $calender_price[$row] = $custom_price[$row];
                } elseif($end_week == "چ" || $end_week == "پ" || $end_week == "ج") {
                    $calender_price[$row] = $_POST["end_week_price"];
                } else {
                    $calender_price[$row] = $_POST["price"];
                }
            }
            update_post_meta($post_id, "resistance_calender", $calender_price);
        }
        if($image_url) {
            $attachment_id = wp_insert_attachment_from_url($image_url, $post_id);
            set_post_thumbnail($post_id, $attachment_id);
            $gallery_data = [];
            if($gallery_urls) {
                foreach ($gallery_urls as $row) {
                    $gallery_data["image_url"][] = $row;
                }
                update_post_meta($post_id, "gallery_data", $gallery_data);
            }
        }
    }
}
function custom_post_update_func()
{
    $post_title = $_POST["post_title"];
    $post_content = $_POST["post_content"];
    $post_id = $_POST["post_id"];
    global $user_ID;
    if(isset($_POST["city_terms"])) {
        $city_ids = $_POST["city_terms"];
    }
    if(isset($_POST["region_terms_ids"])) {
        $region_ids = $_POST["region_terms_ids"];
    }
    if(isset($_POST["tools_terms_ids"])) {
        $tools_ids = $_POST["tools_terms_ids"];
    }
    if(isset($_POST["category_terms_ids"])) {
        $category_ids = $_POST["category_terms_ids"];
    }
    $custom_tax = ["city" => $city_ids, "region" => $region_ids, "tools" => $tools_ids, "categories" => $category_ids];
    $new_post = ["ID" => $post_id, "post_title" => $post_title, "post_content" => $post_content, "post_category" => $category_ids];
    $post_id = wp_update_post($new_post);
    wp_set_post_terms($post_id, $region_ids, "region");
    wp_set_post_terms($post_id, $city_ids, "city");
    wp_set_post_terms($post_id, $tools_ids, "tools");
    wp_set_post_terms($post_id, $category_ids, "categories");
    if(isset($_POST["The_area_of_meter"])) {
        if(isset($_POST["od_tools"])) {
            $odt = $_POST["od_tools"];
        }
        if(isset($_POST["od_loyer"])) {
            $odl = $_POST["od_loyer"];
        }
        if(isset($_POST["attach_url"])) {
            $image_url = sanitize_text_field($_POST["attach_url"]);
        }
        if(isset($_POST["gallery_urls"])) {
            $gallery_urls = $_POST["gallery_urls"];
        }
        $all_residence_meta["The_area_of_meter"] = sanitize_text_field($_POST["The_area_of_meter"]);
        $all_residence_meta["total_area_of_building_meter"] = sanitize_text_field($_POST["total_area_of_building_meter"]);
        $all_residence_meta["residence_type"] = sanitize_text_field($_POST["residence_type"]);
        $all_residence_meta["reserve_type"] = sanitize_text_field($_POST["reserve_type"]);
        $all_residence_meta["cancel_type"] = sanitize_text_field($_POST["cancel_type"]);
        $all_residence_meta["base_capacity"] = sanitize_text_field($_POST["base_capacity"]);
        $all_residence_meta["total_capacity"] = sanitize_text_field($_POST["total_capacity"]);
        $all_residence_meta["number_room"] = sanitize_text_field($_POST["number_room"]);
        $all_residence_meta["Single_bed"] = sanitize_text_field($_POST["Single_bed"]);
        $all_residence_meta["double_bed"] = sanitize_text_field($_POST["double_bed"]);
        $all_residence_meta["mattress"] = sanitize_text_field($_POST["mattress"]);
        $all_residence_meta["Bathroom"] = sanitize_text_field($_POST["Bathroom"]);
        $all_residence_meta["iranian_toilet"] = sanitize_text_field($_POST["iranian_toilet"]);
        $all_residence_meta["sitting_toilet"] = sanitize_text_field($_POST["sitting_toilet"]);
        $all_residence_meta["price"] = sanitize_text_field($_POST["price"]);
        $all_residence_meta["end_week_price"] = sanitize_text_field($_POST["end_week_price"]);
        $all_residence_meta["extra_person"] = sanitize_text_field($_POST["extra_person"]);
        $all_residence_meta["od_tools"] = $odt;
        $all_residence_meta["od_loyer"] = $odl;
        $all_residence_meta["in_clock"] = sanitize_text_field($_POST["in_clock"]);
        $all_residence_meta["meli_pic"] = sanitize_text_field($_POST["meli_pic"]);
        $all_residence_meta["madarek_urls"] = $_POST["madarek_urls"];
        $all_residence_meta["res_address"] = sanitize_text_field($_POST["res_address"]);
        $all_residence_meta["out_clock"] = sanitize_text_field($_POST["out_clock"]);
        $all_residence_meta["map_point_lat"] = sanitize_text_field($_POST["map_point_lat"]);
        $all_residence_meta["map_point_lng"] = sanitize_text_field($_POST["map_point_lng"]);
        update_post_meta($post_id, "_all_res_meta", $all_residence_meta);
        update_post_meta($post_id, "codeid", $_POST["posid"]);
        $up_days_get = get_option("update_date_days");
        if($up_days_get == "") {
            $udg = 60;
        } else {
            $udg = $up_days_get;
        }
        $today = date("Y/m/d");
        $date_new = strtotime("+" . $udg . " days", strtotime($today));
        $date_sixteen = date("Y/m/d", $date_new);
        $exptoday = explode("/", $today);
        $expsixteen = explode("/", $date_sixteen);
        $per_today = gregorian_to_jalali($exptoday[0], $exptoday[1], $exptoday[2], "/");
        $seex_per_days = gregorian_to_jalali($expsixteen[0], $expsixteen[1], $expsixteen[2], "/");
        $calender = get_beetween_date($per_today, $seex_per_days);
        $calender_price = [];
        $custom_price = get_post_meta($post_id, "res_day_price", true);
        if($calender) {
            foreach ($calender as $row) {
                $date_exp = explode("-", $row);
                $ts = jmktime("0", "0", "0", $date_exp[1], $date_exp[2], $date_exp[0]);
                $end_week = jstrftime("%a", $ts);
                if(array_key_exists($row, $custom_price)) {
                    $calender_price[$row] = $custom_price[$row];
                } elseif($end_week == "چ" || $end_week == "پ" || $end_week == "ج") {
                    $calender_price[$row] = $_POST["end_week_price"];
                } else {
                    $calender_price[$row] = $_POST["price"];
                }
            }
            update_post_meta($post_id, "resistance_calender", $calender_price);
        }
        if($image_url) {
            $attachment_id = wp_insert_attachment_from_url($image_url, $post_id);
            set_post_thumbnail($post_id, $attachment_id);
        }
        if($gallery_urls) {
            $gallery_data = [];
            foreach ($gallery_urls as $row) {
                $gallery_data["image_url"][] = $row;
            }
            update_post_meta($post_id, "gallery_data", $gallery_data);
        }
    }
}
function file_upload_callback()
{
    check_ajax_referer("file_upload", "security");
    $arr_img_ext = ["image/png", "image/jpeg", "image/jpg"];
    if(in_array($_FILES["file"]["type"], $arr_img_ext)) {
        $upload = wp_upload_bits($_FILES["file"]["name"], NULL, file_get_contents($_FILES["file"]["tmp_name"]));
    }
    echo $upload["url"];
    wp_die();
}
function Receipt_upload_callback()
{
    check_ajax_referer("Receipt_upload", "security3");
    $arr_img_ext = ["image/png", "image/jpeg", "image/jpg"];
    if(in_array($_FILES["file"]["type"], $arr_img_ext)) {
        $upload = wp_upload_bits($_FILES["file"]["name"], NULL, file_get_contents($_FILES["file"]["tmp_name"]));
    }
    echo $upload["url"];
    wp_die();
}
function file_uploads_callback()
{
    check_ajax_referer("file_uploads", "security2");
    $arr_img_ext = ["image/png", "image/jpeg", "image/jpg"];
    $urls = [];
    $no_files = count($_FILES["files"]["name"]);
    for ($i = 0; $i < $no_files; $i++) {
        if(in_array($_FILES["files"]["type"][$i], $arr_img_ext)) {
            $upload = wp_upload_bits($_FILES["files"]["name"][$i], NULL, file_get_contents($_FILES["files"]["tmp_name"][$i]));
            $urls[] = $upload["url"];
        }
    }
    echo json_encode($urls);
    wp_die();
}
function wp_insert_attachment_from_url($url, $parent_post_id = NULL)
{
    if(!class_exists("WP_Http")) {
        require_once ABSPATH . WPINC . "/class-http.php";
    }
    $http = new WP_Http();
    $response = $http->request($url);
    if(200 !== $response["response"]["code"]) {
        return false;
    }
    $upload = wp_upload_bits(basename($url), NULL, $response["body"]);
    if(!empty($upload["error"])) {
        return false;
    }
    $file_path = $upload["file"];
    $file_name = basename($file_path);
    $file_type = wp_check_filetype($file_name, NULL);
    $attachment_title = sanitize_file_name(pathinfo($file_name, PATHINFO_FILENAME));
    $wp_upload_dir = wp_upload_dir();
    $post_info = ["guid" => $wp_upload_dir["url"] . "/" . $file_name, "post_mime_type" => $file_type["type"], "post_title" => $attachment_title, "post_content" => "", "post_status" => "inherit"];
    $attach_id = wp_insert_attachment($post_info, $file_path, $parent_post_id);
    require_once ABSPATH . "wp-admin/includes/image.php";
    $attach_data = wp_generate_attachment_metadata($attach_id, $file_path);
    wp_update_attachment_metadata($attach_id, $attach_data);
    return $attach_id;
}
function change_user_rol_host_callback()
{
    $curent_user_id = get_current_user_id();
    $u = new WP_User($curent_user_id);
    $user_mobile = $u->user_login;
    $u->set_role("host");
    $act = "";
    if(wp_is_mobile()) {
        $act = "mob";
    } else {
        $act = "desc";
    }
    echo $act;
    exit(0);
}
function add_term_ico($taxonomy)
{
    echo "    <div class=\"form-field term-group\">\n        <label for=\"\">یک تصوبر برای آیکن آپلود کنید</label>\n        <input type=\"text\" name=\"txt_upload_ico\" id=\"txt_upload_ico\" value=\"\" style=\"width: 77%\">\n        <input type=\"button\" id=\"upload_ico_btn\" class=\"button\" value=\"Upload an Image\"/>\n    </div>\n\t";
}
function save_term_ico($term_id, $tt_id)
{
    if(isset($_POST["txt_upload_ico"]) && "" !== $_POST["txt_upload_ico"]) {
        $group = $_POST["txt_upload_ico"];
        add_term_meta($term_id, "term_ico", $group, true);
    }
}
function edit_ico_upload($term, $taxonomy)
{
    $txt_upload_ico = get_term_meta($term->term_id, "term_ico", true);
    echo "    <div class=\"form-field term-group form_align\">\n        <label for=\"\">یک تصویربرای آیکن آپلود کنید</label>\n        <input type=\"text\" name=\"txt_upload_ico\" id=\"txt_upload_ico\" value=\"";
    echo $txt_upload_ico;
    echo "\"\n               style=\"width: 77%\">\n        <input type=\"button\" id=\"upload_ico_btn\" class=\"button\" value=\"آپلود تصویر\"/>\n        <img src=\"";
    echo $txt_upload_ico;
    echo "\" alt=\"\">\n    </div>\n\t";
}
function update_ico_upload($term_id, $tt_id)
{
    if(isset($_POST["txt_upload_ico"]) && "" !== $_POST["txt_upload_ico"]) {
        $group = $_POST["txt_upload_ico"];
        update_term_meta($term_id, "term_ico", $group);
    }
}
function set_custom_edit_book_columns($columns)
{
    $columns["status"] = __("Status", "your_text_domain");
    return $columns;
}
function pippin_get_image_id($image_url)
{
    global $wpdb;
    $attachment = $wpdb->get_col($wpdb->prepare("SELECT ID FROM " . $wpdb->posts . " WHERE guid='%s';", $image_url));
    return $attachment[0];
}
function remove_Unbound_reserve_date($res_id, $dates, $oid, $os)
{
    $order_status = $os;
    $all_reserve_date = get_post_meta($res_id, "resistance_reserves", true);
    foreach ($dates as $row) {
        $key = array_search($row, $all_reserve_date);
        if(false !== $key) {
            unset($all_reserve_date[$key]);
        }
    }
    update_post_meta($res_id, "resistance_reserves", $all_reserve_date);
    update_exist_order($oid, $order_status);
}
function isa_add_every_three_minutes($schedules)
{
    $schedules["every_three_minutes"] = ["interval" => 180, "display" => __("Every 3 Minutes", "textdomain")];
    return $schedules;
}
function every_three_minutes_event_func()
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  order_status=4  ", object);
    $results_need = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  order_status=1 ", object);
    $hotel_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  order_status=4  ", object);
    $hotel_results_need = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  order_status=1 ", object);
    $now = time();
    $ptime = get_option("pay_time");
    foreach ($results as $row) {
        if($row->start_timer + $ptime < $now) {
            $dates = get_beetween_date($row->check_in, $row->check_out);
            remove_unbound_reserve_date($row->res_id, $dates, $row->id, 5);
        }
    }
    foreach ($results_need as $row) {
        if($row->start_timer + $ptime < $now) {
            $dates = get_beetween_date($row->check_in, $row->check_out);
            remove_unbound_reserve_date($row->res_id, $dates, $row->id, 5);
        }
    }
    foreach ($hotel_results_need as $row) {
        if($row->start_timer + $ptime < $now) {
            $dates = get_beetween_date($row->check_in, $row->check_out);
            remove_hotel_Unbound_reserve_date($row->hot_id, $row->room_id, $dates, $row->id, 5);
        }
    }
    foreach ($hotel_results as $row) {
        if($row->start_timer + $ptime < $now) {
            $dates = get_beetween_date($row->check_in, $row->check_out);
            remove_hotel_Unbound_reserve_date($row->hot_id, $row->room_id, $dates, $row->id, 5);
        }
    }
}
function remove_hotel_Unbound_reserve_date($res_id, $room_id, $dates, $oid, $os)
{
    $order_status = $os;
    $all_reserve_date = get_post_meta($res_id, "hotel_reserves" . $room_id, true);
    foreach ($dates as $row) {
        $key = array_search($row, $all_reserve_date);
        if(false !== $key) {
            unset($all_reserve_date[$key]);
        }
    }
    update_post_meta($res_id, "hotel_reserves" . $room_id, $all_reserve_date);
    update_hotel_exist_order($oid, $order_status);
}
function update_hotel_exist_order($order_id, $order_status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_hotel_orders";
    $wpdb->update($table_name, ["order_status" => $order_status], ["id" => $order_id], ["%d"], ["%d"]);
}
function my_login_stylesheet()
{
    wp_enqueue_style("custom-login", get_stylesheet_directory_uri() . "/css/style-login.css");
}
function add_site_map_func()
{
    $lat = $_POST["lat"];
    $lng = $_POST["lng"];
    update_option("site_map_lat", $lat);
    update_option("site_map_lng", $lng);
}
function custom_category()
{
    $labels = ["name" => _x("دسته ها", "Taxonomy General Name", "text_domain"), "singular_name" => _x("دسته", "Taxonomy Singular Name", "text_domain"), "menu_name" => __("دسته", "text_domain"), "all_items" => __("تمام موارد", "text_domain"), "parent_item" => __("مورد مادر", "text_domain"), "parent_item_colon" => __("مورد مادر:", "text_domain"), "new_item_name" => __(" دسته جدید", "text_domain"), "add_new_item" => __("افزودن دسته جدید", "text_domain"), "edit_item" => __("ویرایش دسته", "text_domain"), "update_item" => __("بروز رسانی دسته", "text_domain"), "view_item" => __("مشاهده دسته", "text_domain"), "separate_items_with_commas" => __("دسته ها را با کاما جدا کنید", "text_domain"), "add_or_remove_items" => __("افزودن یا حذف دسته", "text_domain"), "choose_from_most_used" => __("انتخاب از بیشترین استفاده شده ها", "text_domain"), "popular_items" => __("مجموع دسته ها", "text_domain"), "search_items" => __("جستجوی دسته", "text_domain"), "not_found" => __("پیدا نشد", "text_domain"), "no_terms" => __("دسته نیست", "text_domain"), "items_list" => __("لیست دسته ها", "text_domain"), "items_list_navigation" => __("لیست دسته ها", "text_domain")];
    $args = ["labels" => $labels, "hierarchical" => true, "public" => true, "show_ui" => true, "show_admin_column" => true, "show_in_nav_menus" => true, "show_tagcloud" => true];
    register_taxonomy("categories", ["residence"], $args);
}
function wpdocs_custom_excerpt_length($length)
{
    return 20;
}
function wpdocs_excerpt_more($more)
{
    return "...";
}
function create_posts_id()
{
    global $wpdb;
    $lastrowId = $wpdb->get_col("SELECT ID FROM wp_posts where post_type='post' ORDER BY post_date DESC ");
    $lastPropertyId = $lastrowId[0];
    return $lastPropertyId;
}
function jayto_notification()
{
    add_menu_page("اطلاعیه ها", "اطلاعیه ها", "manage_options", "jayto_notifiacation_page", "jayto_notification_callback", "dashicons-warning", "1");
}
function jayto_notification_callback()
{
    echo "    <div class=\"notice notice-success is-dismissible\">\n        <p>اطلاعیه مهم</p>\n        <p>\n            سلام و عرض ادب\n            بخش جدیدی به قالب در بخش هتل ها اضافه شده که این امکان را فراهم میکند تا از یک نوع تیپ اتاق به تعداد تعریف شود و نیاز به تعریف چند اتاق نباشد یعنی اگر 5 اتاق 2خوایه داریم نیازی نیست 5 اتاق تعریف کنیم و یک اتاق تعریف کرده و برای این اتاق تعداد 5 را مشخص میکنیم.مقدار پیش فرض این فیلد یک\n            میباشد یکبار برای اتاق ها ذخیره سازی و بروز رسانی انجام دهید.\n            موفق و پیروز باشید.\n        <p><a href=\"https://www.zhaket.com/web/zhaket-smart-updater\">افزونه بروز رسان هوشمند ژآکت </a></p>\n        </p>\n\n    </div>\n\n";
}
function send_sms_func($txt, $body_id, $mobile_number = NULL)
{
    if($mobile_number == NULL) {
        $user_p = wp_get_current_user();
        $mobile_number = $user_p->user_login;
    }
    require get_template_directory() . "/sms/" . sms_samaneh_name . ".php";
}
function get_post_search_link_func()
{
    $pid = $_POST["pid"];
    $permalink = get_the_permalink($pid);
    echo $permalink;
    exit(0);
}
function wpse18703_posts_where($where, &$wp_query)
{
    global $wpdb;
    if($wpse18703_title = $wp_query->get("wpse18703_title")) {
        $where .= " AND " . $wpdb->posts . ".post_title LIKE '" . esc_sql($wpdb->esc_like($wpse18703_title)) . "%'";
    }
    return $where;
}
function check_last_day_reserve_func()
{
    $chech_in = $_POST["checkin"];
    $res_id = $_POST["res_id"];
    $price_date = get_post_meta($res_id, "resistance_calender", true);
    $res_day_price = get_post_meta($res_id, "res_day_price", true);
    $res = get_post_meta($res_id, "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "calender2.php";
    $calendar = new Calender2();
    if(count($price_date)) {
        foreach ($price_date as $key => $row) {
            $calendar->add_event($row / 1000, $key);
        }
    }
    $calendar->set_id($res_id);
    $calendar->set_chech_in($chech_in);
    if ($res) {
        $calendar->set_reserved_dates($res);
    }
    echo $calendar;
    exit(0);
}
function calender_next_cmonth_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/calender2.php";
    $date_now = date("y-m-d");
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"];
    $next_date = $_POST["next_date"];
    $next_month = date("Y-m-d", strtotime("+" . $priod . " month", strtotime($date_now)));
    $price_date = get_post_meta($pid, "resistance_calender");
    $next_calender = new Calender2($next_month);
    if ($price_date && is_array($price_date)) {
        $calendar_data = is_array($price_date[0]) ? $price_date[0] : $price_date;
        foreach ($calendar_data as $key => $row) {
            $next_calender->add_event($row / 1000, $key);
        }
    }
    $next_calender->set_id($pid);
    $next_calender->set_chech_in($next_date);
    if ($res) {
        $next_calender->set_reserved_dates($res);
    }
    echo $next_calender;
    exit(0);
}
function calender_prev_cmonth_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/calender2.php";
    $date_now = date("y-m-d");
    $now_priod = "";
    $prev_month = "";
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"];
    $now_priod = $priod - 1;
    $next_date = $_POST["next_date"];
    if($now_priod != 0) {
        $prev_month = date("Y-m-d", strtotime("+" . $now_priod . " month", strtotime($this_month)));
    } else {
        $prev_month = date("Y-m-d");
    }
    if($prev_month <= $date_now) {
        $price_date = get_post_meta($pid, "resistance_calender");
        $prev_calender = new Calender2($prev_month);
        if ($price_date && is_array($price_date)) {
            $calendar_data = is_array($price_date[0]) ? $price_date[0] : $price_date;
            foreach ($calendar_data as $key => $row) {
                $prev_calender->add_event($row / 1000, $key);
            }
        }
        $prev_calender->set_id($pid);
        $prev_calender->set_chech_in($next_date);
        if ($res) {
            $prev_calender->set_reserved_dates($res);
        }
        echo $prev_calender;
        exit(0);
    }
}
function get_order_by_id($oid)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_orders";
    $info = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id = " . $oid, OBJECT);
    return $info;
}
function get_hotel_order_by_id($oid)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_hotel_orders";
    $info = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id = " . $oid, OBJECT);
    return $info;
}
function get_res_comments($res_id)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_comments";
    $info = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE res_id = " . $res_id, OBJECT);
    return $info;
}
function insert_comments_func()
{
    $oi_arr = $_POST["oid"];
    $Match_the_ad = $_POST["Match_the_ad"];
    $Services = $_POST["Services"];
    $res_encounter = $_POST["res_encounter"];
    $cleaning = $_POST["cleaning"];
    $price = $_POST["price"];
    $desc = $_POST["desc"];
    $res_Location = $_POST["res_Location"];
    $oi_exp = explode("-", $oi_arr);
    $res_id = $oi_exp[1] - 0;
    $user_id = $oi_exp[2];
    $comment_date = jdate("Y-m-d", "", "", "", "en");
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_comments";
    $user_comment = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE user_id = " . $user_id . " AND res_id = " . $res_id, OBJECT);
    $check = "no";
    if(!$user_comment) {
        $wpdb->insert($table_name, ["user_id" => $user_id, "res_id" => $res_id, "comment" => $desc, "Match_the_ad" => $Match_the_ad, "Services" => $Services, "res_Location" => $res_Location, "res_encounter" => $res_encounter, "cleaning" => $cleaning, "price" => $price, "comment_date" => $comment_date, "confirm" => 0]);
        $check = "yes";
        if(sms_submit_comment_to_admin) {
            send_sms_func($user_id, sms_submit_comment_to_admin, modir_phone);
        }
    }
    echo $check;
    exit(0);
}
function update_comm_answer_func()
{
    $comment_id = $_POST["id"];
    $comment_desc = $_POST["comment"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_comments";
    $wpdb->update($table_name, ["admin_answer" => $comment_desc], ["id" => $comment_id], ["%s"], ["%d"]);
    exit(0);
}
function get_comments_by_hoster($ids)
{
    global $wpdb;
    $results_first = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_comments  ORDER BY id DESC ", ARRAY_A);
    $results = [];
    foreach ($results_first as $row) {
        if(in_array($row["res_id"], $ids)) {
            $results[] = $row;
        }
    }
    $ans_comment = [];
    if($results) {
        foreach ($results as $row) {
            if($row["admin_answer"] == "") {
                $result_comment = $row;
                $post = get_post($row["res_id"]);
                $result_comment["post_name"] = $post->post_title;
                $ans_comment[] = $result_comment;
            }
        }
        $count_all_comment = count($results);
        $no_answer_count = $count_all_comment - count($ans_comment);
        $res = ["no_ans_count" => $no_answer_count, "all_comment_count" => $count_all_comment, "ans_comment" => $ans_comment];
    }
    return $res;
}
function update_comments_by_attr_func()
{
    $ids = $_POST["ids"];
    $option = $_POST["option"];
    $res_id_array = explode("-", $ids);
    global $wpdb;
    $results_first = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_comments  ORDER BY id DESC ", ARRAY_A);
    $results = [];
    foreach ($results_first as $row) {
        if(in_array($row["res_id"], $res_id_array)) {
            $results[] = $row;
        }
    }
    $ans_comment = [];
    if($results) {
        if($option == "noAnswer_comment") {
            foreach ($results as $row) {
                if($row["admin_answer"] == "") {
                    $result_comment = $row;
                    $post = get_post($row["res_id"]);
                    $result_comment["post_name"] = $post->post_title;
                    $ans_comment[] = $result_comment;
                }
            }
            if($ans_comment) {
                $count_all_comment = count($results);
                $no_answer_count = $count_all_comment - count($ans_comment);
                $host_comments = ["no_ans_count" => $no_answer_count, "all_comment_count" => $count_all_comment, "ans_comment" => $ans_comment];
                $html = (include get_template_directory() . "/template-parts/upadate_comment_content.php");
                exit(0);
            }
            echo "                <div class=\"no_comment_box d_flex  justc_center\">\n                    <img class=\"w30p\" src=\"";
            echo get_template_directory_uri();
            echo "/images/no-comment.png\" alt=\"no-comment\">\n\n                </div>\n                <p class=\"text_cnt\">نظر درانتظار پاسخی ندارید</p>\n\t\t\t\t";
            exit(0);
        } elseif($option == "answered_comment") {
            foreach ($results as $row) {
                if($row["admin_answer"] != "") {
                    $result_comment = $row;
                    $post = get_post($row["res_id"]);
                    $result_comment["post_name"] = $post->post_title;
                    $ans_comment[] = $result_comment;
                }
            }
            if($ans_comment) {
                $count_all_comment = count($results);
                $no_answer_count = $count_all_comment - count($ans_comment);
                $host_comments = ["no_ans_count" => $no_answer_count, "all_comment_count" => $count_all_comment, "ans_comment" => $ans_comment];
                $html = (include get_template_directory() . "/template-parts/answerd_comment_content.php");
                exit(0);
            }
            echo "                <div class=\"no_comment_box d_flex  justc_center\">\n                    <img class=\"w30p\" src=\"";
            echo get_template_directory_uri();
            echo "/images/no-comment.png\" alt=\"no-comment\">\n\n                </div>\n                <p class=\"text_cnt\">نظر پاسخ داده شده ای ندارید</p>\n\t\t\t\t";
            exit(0);
        }
    } else {
        exit(0);
    }
}
function get_user_tickets($uid)
{
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE uid = " . $uid . " ORDER BY `id` DESC", ARRAY_A);
    return $results;
}
function get_all_answer_tickets()
{
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE parent !=0 ", ARRAY_A);
    return $results;
}
function add_ticket()
{
    $link_target = "";
    $date = date("Y-m-d");
    $ticket_subject = sanitize_text_field($_POST["tic_sub"]);
    $uid = sanitize_text_field($_POST["uid"]);
    $ticket_desc = sanitize_text_field($_POST["tick_desc"]);
    $file = $_FILES["fileupload"];
    $ext = $file["type"];
    $name = $file["name"];
    $lastaddr = $file["tmp_name"];
    $extallowed = 0;
    $maxfsize = 5000000;
    $orgsize = (int) $file["size"];
    $Allowedext = ["jpg", "jpeg", "png"];
    $Allowedsize = 0;
    $exterror = "";
    $sizeerror = "";
    $orgext = pathinfo($file["name"], PATHINFO_EXTENSION);
    $orgname = pathinfo($file["name"], PATHINFO_FILENAME);
    $error = 0;
    $all_error = [];
    if($ticket_subject == "") {
        $error = 1;
        $all_error[] = "فیلد موضوع نمیتواند خالی باشد";
    }
    if($ticket_subject == "") {
        $error = 1;
        $all_error[] = "فیلد متن نمیتواند خالی باشد";
    }
    if($orgext) {
        if(!in_array($orgext, $Allowedext)) {
            $error = 1;
            $all_error[] = "پسوند فایل مجاز نمیباشد.";
        } elseif($maxfsize < $orgsize) {
            $error = 1;
            $all_error[] = "حجم فایل بیشتر از مقدار تعیین شده میباشد";
        }
    }
    if($error == 1) {
        echo json_encode($all_error);
        exit(0);
    }
    if($error == 0) {
        if($orgsize != 0) {
            $newname = time() . random_int(1, 100);
        }
        $target = __DIR__ . "/ticket_image/" . $newname . "." . $orgext;
        if($orgsize != 0) {
            $link_target = get_template_directory_uri() . "/ticket_image/" . $newname . "." . $orgext;
            move_uploaded_file($lastaddr, $target);
        }
    }
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $wpdb->insert($table_name, ["uid" => $uid, "subject" => $ticket_subject, "description" => $ticket_desc, "ticket_date" => $date, "parent" => 0, "status" => 0, "file_link" => $link_target], ["%d", "%s", "%s", "%s", "%d", "%d", "%s"]);
    $user_phone = get_user_by("id", $uid);
    if(sms_user_send_ticket) {
        send_sms_func($user_phone->user_nicename, sms_user_send_ticket, modir_phone);
    }
    exit(0);
}
function add_ticket_answer_to_answer()
{
    $link_target = "";
    $date = date("Y-m-d H:i:s");
    $user = get_current_user_id();
    $ticket_subject = "پاسخ تیکت به ادمین";
    $ticket_desc = sanitize_text_field($_POST["ticket_desc"]);
    $atid = sanitize_text_field($_POST["atid"]);
    $file = $_FILES["us_tick_fileupload"];
    $ext = $file["type"];
    $name = $file["name"];
    $lastaddr = $file["tmp_name"];
    if($file["size"] != 0) {
        $orgext = pathinfo($file["name"], PATHINFO_EXTENSION);
        $orgname = pathinfo($file["name"], PATHINFO_FILENAME);
        $newname = time() . random_int(1, 100);
        $target = __DIR__ . "/ticket_image/" . $newname . "." . $orgext;
        $link_target = get_template_directory_uri() . "/ticket_image/" . $newname . "." . $orgext;
        move_uploaded_file($lastaddr, $target);
    }
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $wpdb->insert($table_name, ["uid" => $user, "subject" => $ticket_subject, "description" => $ticket_desc, "ticket_date" => $date, "parent" => $atid, "status" => 0, "file_link" => $link_target], ["%d", "%s", "%s", "%s", "%d", "%d", "%s"]);
    $wpdb->update($table_name, ["status" => 0], ["id" => $atid]);
    exit(0);
}
function get_ajax_paginate_post_func()
{
    $page_number = $_POST["page_number"];
    $num_in_page = $_POST["num_in_page"];
    $args = ["numberposts" => -1, "post_type" => "post"];
    $tile_post = get_posts($args);
    $post_to_ars = (array) $tile_post;
    $page_array = array_chunk($post_to_ars, $num_in_page, truu);
    $html = (require "template-parts/pagination_post_template.php");
    exit(1);
}
function get_ajax_next_paginate_post_func()
{
    $priv_number = $_POST["priv_number"];
    $first_number = $_POST["first_number"];
    $args = ["numberposts" => -1, "post_type" => "post"];
    $tile_post = get_posts($args);
    $post_to_ars = (array) $tile_post;
    $slice_post = array_slice($post_to_ars, $priv_number * 1, NULL, true);
    $posts_number = count($slice_post);
    $html = (require "template-parts/next_pagination.php");
    exit(1);
}
function get_ajax_prev_paginate_post_func()
{
    $priv_number = $_POST["priv_number"];
    $first_number = $_POST["first_number"];
    $args = ["numberposts" => -1, "post_type" => "post"];
    $last_prive = (int) $priv_number - 1;
    $tile_post = get_posts($args);
    $post_to_ars = (array) $tile_post;
    $post_to_ars_rev = array_reverse($post_to_ars, true);
    $slice_post = array_slice($post_to_ars_rev, -1 * $last_prive * 1, NULL, true);
    $posts_number = count($slice_post);
    $html = (require "template-parts/prev_pagination.php");
    exit(0);
}
function update_order_pay_type($oid, $p_type, $pay_type, $order_status)
{
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_orders";
    if($p_type == "hotel") {
        $table_name = $wpdb->prefix . "jayto_hotel_orders";
    }
    $wpdb->update($table_name, ["order_status" => $order_status, "pay_type" => $pay_type], ["id" => $oid], ["%d", "%s"], ["%d"]);
}
function insert_cart_info_to_table_func()
{
    global $wpdb;
    $p_type = $_POST["ptype"];
    $oid = $_POST["oid"];
    $os = $_POST["os"];
    if(isset($_POST["fname"])) {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
    } else {
        $fname = $_POST["fname"];
        $lname = $_POST["lname"];
        $phone = $_POST["phone"];
    }
    $cart_digits = $_POST["cart_digits"];
    $receipt_image = $_POST["receipt_image"];
    $table_name = $wpdb->prefix . "jayto_orders";
    if($p_type == "hotel") {
        $table_name = $wpdb->prefix . "jayto_hotel_orders";
    }
    $wpdb->update($table_name, ["cart_digit" => $cart_digits, "cart_img" => $receipt_image, "order_status" => $os], ["id" => $oid], ["%d", "%s", "%d"], ["%d"]);
    $order = $wpdb->get_row("SELECT * FROM " . $table_name . " WHERE id = " . $oid, OBJECT);
    $table_transaction = $wpdb->prefix . "jayto_transaction";
    $transaction = $wpdb->get_row("SELECT * FROM " . $table_transaction . " WHERE orderid = " . $order->id, OBJECT);
    $host_share = get_option("hoster_percent");
    $hoster_share = $order->price * $host_share / 100;
    if(!$transaction) {
        $wpdb->insert($table_transaction, ["Authority" => "", "refid" => "", "user_id" => $order->user_id, "pay_date" => time(), "pay_status" => 1, "amount" => $order->price, "orderid" => $order->id, "transaction_desc" => "واریز بابت رزرو", "passenger_name" => $fname, "passenger_famili" => $lname, "passenger_phone" => $phone], ["%s", "%s", "%d", "%d", "%d", "%d", "%d", "%s", "%s", "%s", "%s"]);
    } else {
        $wpdb->update($table_transaction, ["user_id" => $order->author_id, "pay_date" => time(), "pay_status" => 1, "orderid" => $order->id, "transaction_desc" => "واریز بابت رزرو", "passenger_name" => $fname, "passenger_famili" => $lname, "passenger_phone" => $phone], ["id" => $transaction->id], ["%d", "%d", "%d", "%d", "%s", "%s", "%s", "%s"], ["%d"]);
    }
    $mobile_number = "";
    if(user_can($order->author_id, "administrator")) {
        $mobile_number = sms_modir_answer_ticket;
    } else {
        $mo = get_user_meta($order->user_id, "user_mobile", true);
        $mobile_number = $mo;
    }
    if(sms_cart_need_conf_to_hoster) {
        send_sms_func($order->id, sms_cart_need_conf_to_hoster, $mobile_number);
    }
    echo json_encode($oid);
    exit(0);
}
function user_change_order_status_func()
{
    $order_id = $_POST["oid"];
    $os = $_POST["os"];
    $update_wallet = "";
    if(isset($_POST["update_wallet"])) {
        $update_wallet = $_POST["update_wallet"];
    }
    $cf = "confirm";
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_orders";
    $table_transaction = $wpdb->prefix . "jayto_transaction";
    if($_POST["pt"] == "hotel") {
        $table_name = $wpdb->prefix . "jayto_hotel_orders";
    }
    $wpdb->update($table_name, ["order_status" => $os, "confirm_status" => $cf], ["id" => $order_id], ["%d", "%s"], ["%d"]);
    $order = get_order_by_id($order_id);
    if($_POST["pt"] == "hotel") {
        $order = get_hotel_order_by_id($order_id);
    }
    $wallet_old = get_user_meta($order->author_id, "jayto-wallet", true);
    $host_share = get_option("hoster_percent");
    $amount_for_update = $order->price * $host_share / 100;
    $new_wallet_amount = $wallet_old + $amount_for_update;
    update_user_meta($order->author_id, "jayto-wallet", $new_wallet_amount);
    $wpdb->update($table_name, ["host_share" => $amount_for_update], ["id" => $order_id], ["%d"], ["%d"]);
    $wpdb->update($table_transaction, ["pay_status" => 1], ["user_id" => $order->author_id], ["%d"], ["%d"]);
    if(user_can($order->author_id, "administrator")) {
        $mobile_number = sms_modir_answer_ticket;
    } else {
        $mo = get_user_meta($order->user_id, "user_mobile", true);
        $mobile_number = $mo;
    }
    send_sms_func($order->id, sms_cart_need_conf_to_guest, $mobile_number);
    exit(0);
}
function ajax_check_user_logged_in()
{
    echo is_user_logged_in() ? "yes" : "no";
    exit;
}
function residence_discount_menu()
{
    add_submenu_page("edit.php?post_type=residence", __("تخفیف", "jayto"), __("تخفیف", "jayto"), "manage_options", "books-shortcode-ref", "residence_discount_ref_page_callback");
}
function residence_discount_ref_page_callback()
{
    echo "    <div class=\"wrap\">\n        <h4>تخفیف ها</h4>\n\n\t\t";
    require "template-parts/residence_discount_page.php";
    echo "    </div>\n\t";
}
function hotel_discount_menu()
{
    add_submenu_page("edit.php?post_type=hotel", __("تخفیف", "jayto"), __("تخفیف", "jayto"), "manage_options", "hotel_discoint", "hotel_discount_ref_page_callback");
}
function hotel_discount_ref_page_callback()
{
    echo "    <div class=\"wrap\">\n        <h4>تخفیف ها</h4>\n\n\t\t";
    require "template-parts/hotel_discount_page.php";
    echo "    </div>\n\t";
}
function calender_desk_next_month_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/Calender_desktop.php";
    $date_now = date("y-m-d");
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"] + 1;
    $next_month = date("Y-m-d", strtotime("+" . $priod . " month", strtotime($date_now)));
    $price_date = get_post_meta($pid, "resistance_calender");
    $next_calender = new Calendar_desktop($next_month);
    if (!empty($pid) && method_exists($next_calender, 'set_id')) {
        $next_calender->set_id($pid);
    }
    if (!empty($res) && method_exists($next_calender, 'set_reserved_dates')) {
        $next_calender->set_reserved_dates($res);
    }
    foreach ($price_date[0] as $key => $row) {
        $next_calender->add_event($row / 1000, $key);
    }
    echo $next_calender;
    exit(0);
}
function calender_desk2_next_month_func()
{
    $res = get_post_meta($_POST["pid"], "resistance_reserves", true);
    include JAYTO_PLUGIN_PATH . "/Calender_desktop2.php";
    $date_now = date("y-m-d");
    $this_month = $_POST["month"];
    $pid = $_POST["pid"];
    $priod = $_POST["priod"] + 2;
    $next_month = date("Y-m-d", strtotime("+" . $priod . " month", strtotime($date_now)));
    $price_date = get_post_meta($pid, "resistance_calender");
    $next_calender = new Calendar_desktop2($next_month);
    if (!empty($pid) && method_exists($next_calender, 'set_id')) {
        $next_calender->set_id($pid);
    }
    if (!empty($res) && method_exists($next_calender, 'set_reserved_dates')) {
        $next_calender->set_reserved_dates($res);
    }
    foreach ($price_date[0] as $key => $row) {
        $next_calender->add_event($row / 1000, $key);
    }
    echo $next_calender;
    exit(0);
}

function refresh_host_date_manager(){
    $pid = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
    if(!$pid){ wp_send_json_error(['message'=>'bad pid']); }

    include_once JAYTO_PLUGIN_PATH . '/Calender_desktop.php';
    include_once JAYTO_PLUGIN_PATH . '/Calender_desktop2.php';

    $price_date_map = get_post_meta($pid, 'resistance_calender', true);
    if (!is_array($price_date_map)) { $price_date_map = []; }
    $reserved_list = get_post_meta($pid, 'resistance_reserves', true);
    if (!is_array($reserved_list)) { $reserved_list = []; }
    $host_blocked_list = get_post_meta($pid, 'host_blocked_dates', true);
    if(!is_array($host_blocked_list)) { $host_blocked_list = []; }

    $adm_cal1 = new Calendar_desktop();
    if (method_exists($adm_cal1, 'set_reserved_dates')) { $adm_cal1->set_reserved_dates($reserved_list); }
    if (method_exists($adm_cal1, 'set_host_blocked_dates')) { $adm_cal1->set_host_blocked_dates($host_blocked_list); }
    if (method_exists($adm_cal1, 'set_id')) { $adm_cal1->set_id($pid); }
    foreach ($price_date_map as $k => $v) { $adm_cal1->add_event($v / 1000, $k); }

    $next_month_base = date('Y-m-d', strtotime('+1 month'));
    $exp_date = explode('-', $next_month_base);
    list($m_year, $m_month, $m_day) = $exp_date;
    $shamsi_date = gregorian_to_jalali($m_year, $m_month, $m_day);
    $date_j = jalali_to_gregorian($shamsi_date[0], $shamsi_date[1], $shamsi_date[2], '-');
    $adm_cal2 = new Calendar_desktop2($date_j);
    if (method_exists($adm_cal2, 'set_reserved_dates')) { $adm_cal2->set_reserved_dates($reserved_list); }
    if (method_exists($adm_cal2, 'set_host_blocked_dates')) { $adm_cal2->set_host_blocked_dates($host_blocked_list); }
    if (method_exists($adm_cal2, 'set_id')) { $adm_cal2->set_id($pid); }
    foreach ($price_date_map as $k => $v) { $adm_cal2->add_event($v / 1000, $k); }

    ob_start();
    echo '<div class="calender_box1">' . $adm_cal1 . '</div>';
    echo '<div class="calender_box2">' . $adm_cal2 . '</div>';
    $html = ob_get_clean();
    echo $html;
    exit(0);
}

// Rebuild next-N-days price map immediately (apply Price/Weekend inputs without full Save)
function rebuild_resistance_calender(){
    $post_id = isset($_POST['pid']) ? intval($_POST['pid']) : 0;
    $price = isset($_POST['price']) ? floatval($_POST['price']) : 0;
    $end_week_price = isset($_POST['end_week_price']) ? floatval($_POST['end_week_price']) : 0;
    $days_forward = intval(get_option('up_days_get', 60));
    if(!$post_id || !$price){ wp_send_json_error(['message'=>'bad params']); }

    $today = date("Y/m/d");
    $target = date("Y/m/d", strtotime("+{$days_forward} days", strtotime($today)));
    $per_today = gregorian_to_jalali(date('Y', strtotime($today)), date('m', strtotime($today)), date('d', strtotime($today)), '/');
    $per_target = gregorian_to_jalali(date('Y', strtotime($target)), date('m', strtotime($target)), date('d', strtotime($target)), '/');
    $dates = get_beetweens_date($per_today, $per_target);

    $custom_price = get_post_meta($post_id, 'res_day_price', true);
    if(!is_array($custom_price)) $custom_price = [];
    $map = [];
    foreach($dates as $row){
        $parts = explode('-', $row);
        $ts = jmktime(0,0,0, $parts[1], $parts[2], $parts[0]);
        $dow = jstrftime('%a', $ts);
        if(array_key_exists($row, $custom_price)){
            $map[$row] = $custom_price[$row];
        } elseif(in_array($dow, ['چ','پ','ج'], true)){
            $map[$row] = $end_week_price ?: $price;
        } else {
            $map[$row] = $price;
        }
    }
    update_post_meta($post_id, 'resistance_calender', $map);
    wp_send_json_success(['updated'=>count($map)]);
}
function get_add_user_tour_exp_template_func()
{
    $tour_id = $_POST["tour_id"];
    $html = (require get_template_directory() . "/template-parts/add_tour_exp_template.php");
    exit(0);
}
function user_add_tour_variable_func()
{
    $tour_id = $_POST["tour_id"];
    $name = $_POST["name"];
    $base = $_POST["base"];
    $price = $_POST["price"];
    global $wpdb;
    $table_name = $wpdb->prefix . "tour_variable";
    $wpdb->insert($table_name, ["tid" => $tour_id, "title" => $name, "base" => $base, "price" => $price], ["%d", "%s", "%d", "%d"]);
    $lastid = $wpdb->insert_id;
    $data = ["tid" => $tour_id, "title" => $name, "base" => $base, "price" => $price, "lid" => $lastid];
    echo json_encode($data);
    exit(0);
}
function user_update_tour_variable_func()
{
    $id = $_POST["id"];
    $name = $_POST["name"];
    $price = $_POST["price"];
    $base = $_POST["base"];
    global $wpdb;
    $table_name = $wpdb->prefix . "tour_variable";
    $wpdb->update($table_name, ["title" => $name, "base" => $base, "price" => $price], ["id" => $id], ["%s", "%d", "%d"], ["%d"]);
    exit(0);
}
function user_remove_tour_variable_func()
{
    $tour_id = $_POST["id"];
    global $wpdb;
    $table = $wpdb->prefix . "tour_variable";
    $wpdb->delete($table, ["id" => $tour_id]);
    exit(0);
}
function set_cookies_func()
{
    $checkin = "";
    if(isset($_POST["checkin"])) {
        $checkin = $_POST["checkin"];
    }
    if(isset($_POST["checkin"])) {
        $cook_name = $_POST["cook_name"];
    }
    setcookie($cook_name, $checkin, time() + 60, "/");
    exit(0);
}
function get_room_img_func()
{
    if(isset($_POST["hotel_id"])) {
        $hotel_id = $_POST["hotel_id"];
    }
    if(isset($_POST["key"])) {
        $key = $_POST["key"];
    }
    $hotel_rooms = get_post_meta($hotel_id, "rooms_info", true);
    $urls = $hotel_rooms[$key]["urls"];
    $name = $hotel_rooms[$key]["room_name"];
    ob_start();
    include "template-parts/view_rooms_img_tmp.php";
    $html = ob_get_clean();
    echo $html;
    wp_die();
}
function rooms_upload_images_hoster_func()
{
    $uploaded_files = [];
    if(!empty($_FILES["file"]["name"][0])) {
        $files = $_FILES["file"];
        foreach ($files["name"] as $key => $value) {
            if($files["name"][$key]) {
                $file = ["name" => $files["name"][$key], "type" => $files["type"][$key], "tmp_name" => $files["tmp_name"][$key], "error" => $files["error"][$key], "size" => $files["size"][$key]];
                $upload_overrides = ["test_form" => false];
                $upload = wp_handle_upload($file, $upload_overrides);
                if(!isset($upload["error"])) {
                    $uploaded_files[] = $upload["url"];
                }
            }
        }
    }
    echo json_encode($uploaded_files);
    wp_die();
}
function hos_delete_rooms_image_callback()
{
    $file_path = $_POST["image_url"];
    $is_deleted = wp_delete_file($file_path);
    if($is_deleted) {
        echo "فایل با موفقیت از رسانه‌های وردپرس حذف شد";
    } else {
        echo "خطا در حذف فایل از رسانه‌های وردپرس";
    }
    exit(0);
}
function get_my_option_callback()
{
    $p_option = $_POST["option"];
    $option = get_option($p_option);
    echo $option;
    exit(0);
}
function set_selected_date_callback()
{
    session_start();
    if(isset($_POST["date"]) && isset($_POST["ddate"])) {
        $_SESSION["in_start_date"] = sanitize_text_field($_POST["date"]);
        $_SESSION["in_end_ddate"] = sanitize_text_field($_POST["ddate"]);
        wp_send_json_success(["message" => "Session saved"]);
    } else {
        wp_send_json_error(["message" => "Missing data"]);
    }
}
function set_selected_date_out_callback()
{
    session_start();
    if(isset($_POST["date"]) && isset($_POST["ddate"])) {
        $_SESSION["out_end_date"] = sanitize_text_field($_POST["date"]);
        $_SESSION["out_end_ddate"] = sanitize_text_field($_POST["ddate"]);
        wp_send_json_success(["message" => "Session saved"]);
    } else {
        wp_send_json_error(["message" => "Missing data"]);
    }
}
function calcs_reserve_price()
{
    $checkin = isset($_POST["checkin"]) ? sanitize_text_field($_POST["checkin"]) : "";
    $checkout = isset($_POST["checkout"]) ? sanitize_text_field($_POST["checkout"]) : "";
    $res_id = isset($_POST["res_id"]) ? (int) $_POST["res_id"] : 0;
    $no_people = isset($_POST["no_people"]) ? (int) $_POST["no_people"] : 0;
    if(!$checkin || !$checkout || !$res_id) {
        wp_send_json_error(["message" => "اطلاعات ناقص ارسال شده است."]);
    }
    $post_data = get_post_meta($res_id, "_all_res_meta", true);
    if(empty($post_data)) {
        wp_send_json_error(["message" => "اطلاعات اقامتگاه پیدا نشد."]);
    }
    $days = datedifference($checkin, $checkout);
    $all_dates = get_beetween_date($checkin, $checkout);
    $all_calender = get_post_meta($res_id, "resistance_calender");
    $all_reserved = get_post_meta($res_id, "resistance_reserves", true);
    $calender = [];
    $ndate = new DateTime();
    $now_date = $ndate->format("Y/m/d");
    $in_discount = "false";
    $discount = 0;
    if($start_date_jalali = $post_data[0]["discount"]["start_date "]) {
        $start_date_jalali = $post_data[0]["discount"]["start_date "];
        $end_date_jalali = $post_data[0]["discount"]["end_date"];
        $discount_array = get_beetween_date_add($start_date_jalali, $end_date_jalali);
        $in_discount = "true";
    }
    if($all_reserved) {
        foreach ($all_reserved as $row) {
            if(in_array($row, $all_dates)) {
                $allow = "no";
            } else {
                $allow = "yes";
            }
        }
    } else {
        $allow = "yes";
    }
    foreach ($all_calender[0] as $key => $row) {
        if(in_array($key, $all_dates)) {
            $calender[$key] = $row;
        }
    }
    $count_value = array_count_values($calender);
    $date_prices = [];
    $dis_array = [];
    foreach ($all_dates as $row) {
        if(array_key_exists($row, $calender)) {
            $date_prices[$row] = $calender[$row];
        }
        if($in_discount == "true" && isset($discount_array) && in_array($row, $discount_array)) {
            $percent = isset($post_data[0]["discount"]["percent"]) ? floatval($post_data[0]["discount"]["percent"]) : 0;
            $dis_array[] = $calender[$row] * $percent / 100;
        }
    }
    $sub_price_without_extend = array_sum($date_prices);
    // Initialize to avoid undefined notices
    $add_people_num = isset($post_data[0]['add_people_num']) ? intval($post_data[0]['add_people_num']) : (isset($add_people_num) ? intval($add_people_num) : 0);
    $add_price_price = isset($post_data[0]['add_price_price']) ? intval($post_data[0]['add_price_price']) : (isset($add_price_price) ? intval($add_price_price) : 0);
    $sub_add_people_price = isset($sub_add_people_price) ? intval($sub_add_people_price) : 0;
    if(0 < $add_people_num) {
        $sub_add_people_price = $add_people_num * $add_price_price * $days;
    }
    if(0 <= $sub_add_people_price) {
        $total_price = $sub_price_without_extend + $sub_add_people_price;
    } else {
        $total_price = $sub_price_without_extend;
    }
    if($in_discount == "true") {
        $sum_discount = array_sum($dis_array);
    } else {
        $sum_discount = 0;
    }
    $all_price_info = ["total_price" => $total_price, "sub_add_people_price" => $sub_add_people_price, "add_people_num" => $add_people_num, "count_value" => $count_value, "allow" => $allow, "discount" => $sum_discount];
    wp_send_json_success(["total_price" => $total_price, "sub_add_people_price" => $sub_add_people_price, "add_people_num" => $add_people_num, "count_value" => $count_value, "allow" => $allow, "discount"]);
}

?>
