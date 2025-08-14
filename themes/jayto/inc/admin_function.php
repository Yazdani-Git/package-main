<?php
add_action("admin_menu", "tadris_setting");
if(!wp_next_scheduled("check_theme_ac")) {
    wp_schedule_event(time(), "Every 24h", "check_theme_ac");
}
add_action("check_theme_ac", "check_theme_ac_func");
add_action("admin_menu", "residence_request");
add_action("admin_menu", "wallet_operation");
add_action("admin_menu", "send_notif");
add_action("admin_menu", "hotel_request");
add_action("admin_menu", "comments_management");
add_action("admin_menu", "Financial");
add_action("admin_menu", "ticket_management");
add_action("admin_enqueue_scripts", "jayto_admin_scripts");
add_action("wp_ajax_get_orders_by_status", "get_orders_by_status_func");
add_action("wp_ajax_get_hot_orders_by_status", "get_hot_orders_by_status_func");
add_action("wp_ajax_get_finc_by_status", "get_finc_by_status_func");
add_action("wp_ajax_admin_get_dans_template", "admin_get_dans_template_func");
add_action("wp_ajax_admin_update_private_sanse_table", "admin_update_private_sanse_table_func");
add_action("wp_ajax_add_residance_discount", "add_residance_discount_func");
add_action("wp_ajax_get_order_info", "get_order_info_func");
add_action("wp_ajax_show_hotel_info", "show_hotel_info_func");
add_action("wp_ajax_get_hot_order_info", "get_hot_order_info_func");
add_action("wp_ajax_get_torder_info", "get_torder_info_func");
add_action("wp_ajax_get_wallet_pay_notic_temp", "get_wallet_pay_notic_temp_func");
add_action("wp_ajax_get_user_bank_info", "get_user_bank_info_func");
add_action("wp_ajax_add_wallet_pay_notic", "add_wallet_pay_notic_func");
add_action("wp_ajax_get_chrw_temp", "get_chrw_temp_func");
add_action("wp_ajax_chanhe_rw", "chanhe_rw_func");
add_action("wp_ajax_chanhe_tur_status", "chanhe_tur_status_func");
add_action("wp_ajax_get_tur_ch_temp", "get_tur_ch_temp_func");
add_action("admin_menu", "notification_bubble_in_admin_menu_qa");
add_action("wp_ajax_edit_comments_admin", "edit_comments_admin_func");
add_action("wp_ajax_get_user_wallet_add", "get_user_wallet_add_func");
add_action("wp_ajax_get_user_noti_add", "get_user_noti_add_func");
add_action("wp_ajax_add_noti_to_user", "add_noti_to_user_func");
add_action("wp_ajax_delete_user_not", "delete_user_not_func");
add_action("wp_ajax_adm_update_wallet", "adm_update_wallet_func");
add_action("wp_ajax_adm_update_wallet_low", "adm_update_wallet_low_func");
add_action("wp_ajax_edit_comments_down", "edit_comments_down_func");
add_action("wp_ajax_refresh_coment_html", "refresh_coment_html_func");
add_action("init", "register_custom_post_status");
add_action("admin_footer", "display_custom_post_status_option");
add_action("post_submitbox_misc_actions", "my_featured_post_field");
add_action("wp_ajax_hotel_save_rooms", "hotel_save_rooms_func");
add_action("wp_ajax_room_file_upload", "room_file_upload_callback");
add_action("wp_ajax_admin_ticket_answer", "admin_ticket_answer");
add_action("wp_ajax_admin_ticket_answer_1", "admin_ticket_answer_1");
add_action("wp_ajax_get_hotel_rooms", "get_hotel_rooms_func");
add_action("wp_ajax_add_room_discount", "add_room_discount_func");
add_action("wp_ajax_admin_ticket_change_status", "admin_ticket_change_status");
add_action("wp_ajax_get_tour_order_by_status", "get_tour_order_by_status_func");
add_action("wp_ajax_remove_hotel_room", "remove_hotel_room_func");
add_action("wp_ajax_admin_change_order_status", "admin_change_order_status_func");
add_action("wp_ajax_admin_change_order_status_cart_return", "admin_change_order_status_cart_return_func");
add_action("wp_ajax_admin_change_order_status_for_request", "admin_change_order_status_for_request_func");
add_action("wp_ajax_get_admin_change_order_status_tmp", "get_admin_change_order_status_tmp_func");
add_action("wp_ajax_change_admin_hotel_room", "change_admin_hotel_room_func");
add_action("wp_ajax_set_sans", "set_sans_func");
add_action("wp_ajax_del_sans_admin", "del_sans_admin_func");
add_action("wp_ajax_custom_radd_room_reserve", "custom_add_room_reserve_func");
add_action("wp_ajax_custom_rev_room_reserve", "custom_rev_room_reserve_func");
add_action("init", "create_cart_pay_page");
add_action("init", "create_cash_pay_page");
add_action("after_setup_theme", "create_voucher_page");
add_action("wp_ajax_rooms_upload_images", "rooms_upload_images_func");
add_action("wp_ajax_delete_rooms_image", "delete_rooms_image_callback");
add_action("init", "create_opt_db");
add_action("wp_enqueue_scripts", "load_custom_swiper");
add_action("admin_footer", "custom_admin_script");
class Zhaket_License
{
    public static $check_url = "http://guard.zhaket.com/api/";
    public function __construct()
    {
    }
    public static function sendRequest($method, $params = [])
    {
        $param_string = http_build_query($params);
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_URL, self::$check_url . $method . "?" . $param_string);
        $content = curl_exec($ch);
        return json_decode($content);
    }
    public static function isValid($license_token)
    {
        $result = self::sendRequest("validation-license", ["token" => $license_token, "domain" => self::getHost()]);
        return $result;
    }
    public static function install($license_token, $product_token)
    {
        $result = self::sendRequest("install-license", ["product_token" => $product_token, "token" => $license_token, "domain" => self::getHost()]);
        return $result;
    }
    public static function getHost()
    {
        $possibleHostSources = ["HTTP_X_FORWARDED_HOST", "HTTP_HOST", "SERVER_NAME", "SERVER_ADDR"];
        $sourceTransformations = ["HTTP_X_FORWARDED_HOST" => function ($value) {
            $elements = explode(",", $value);
            return trim(end($elements));
        }];
        $host = "";
        foreach ($possibleHostSources as $source) {
            if(!empty($host)) {
                $host = preg_replace("/:\\d+\$/", "", $host);
                $host = str_ireplace("www.", "", $host);
                return trim($host);
            }
            if(empty($_SERVER[$source])) {
            } else {
                $host = $_SERVER[$source];
                if(array_key_exists($source, $sourceTransformations)) {
                    $host = $sourceTransformations[$source]($host);
                }
            }
        }
    }
}
function tadris_setting()
{
    add_menu_page("تنظیمات قالب", "تنظیمات قالب", "manage_options", "jayto_setting_page", "option_function", "", "2");
    add_submenu_page("jayto_setting_page", "تنظیمات مقررات لغو", "تنظیمات مقررات لغو", "manage_options", "Cancel Policy", "cancel_policy_function");
    add_submenu_page("jayto_setting_page", "تنظیمات درگاه پرداخت", "تنظیمات درگاه پرداخت", "manage_options", "pay setting", "pay_setting_function");
    add_submenu_page("jayto_setting_page", "تنظیمات پیامک", "تنظیمات پیامک", "manage_options", "sms setting", "sms_setting_function");
    add_menu_page("active jayto", "فعال سازی قالب", "manage_options", "active_jayto", "active_jayto_func");
}
function active_jayto_func()
{
    if(isset($_POST["user_lic_inp"])) {
        $usinp = $_POST["user_lic_inp"];
        update_option("ulic_input", $usinp);
    }
    $olic_opt = get_option("ulic_input");
    $license_token = $olic_opt;
    $produc_token = "5eea4962-75e7-4c97-8445-b35f1c1d1c8d";
    $result = Zhaket_License::install($license_token, $produc_token);
    if($result->status == "successful") {
        echo "<div class='lic_succs'>" . $result->message . "</div>";
        update_option("lic_successful", "succ_1");
    } else {
        update_option("lic_successful", "succ_0");
        if(!is_object($result->message)) {
            echo "<div class='lic_succs_no'>" . $result->message . "</div>";
        } else {
            foreach ($result->message as $message) {
                foreach ($message as $msg) {
                    echo "<div class='lic_succs_no'>" . $msg . "</div>";
                    echo "<br>";
                }
            }
        }
    }
    echo "    <div class=\"lic_activate\">\r\n        <form action=\"\" name=\"us_lic_act\" method=\"post\">\r\n            <label for=\"lic_input\">کدفعال سازی لایسنس </label>\r\n            <input type=\"text\" name=\"user_lic_inp\">\r\n            <input type=\"submit\" value=\"فعال سازی\">\r\n        </form>\r\n    </div>\r\n\r\n";
}
function check_theme_ac_func()
{
    $olic_opt = get_option("ulic_input");
    $license_tokens = $olic_opt;
    $license_token = $license_tokens;
    $result = Zhaket_License::isValid($license_token);
    if($result->status == "successful") {
        echo $result->message;
    } else {
        update_option("lic_successful", "succ_0");
        if(!is_object($result->message)) {
            echo $result->message;
        } else {
            foreach ($result->message as $message) {
                foreach ($message as $msg) {
                    echo $msg . "<br>";
                }
            }
        }
    }
}
function check_licence()
{
    $check = get_option("lic_successful");
    return $check;
}
function option_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/option_page_template.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function cancel_policy_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/cancel_policy_template.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function pay_setting_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/pay_setting_template.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function sms_setting_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/sms_setting_template.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function residence_request()
{
    add_menu_page("درخواست ها", "لیست درخواست ها", "manage_options", "residence_request_page", "request_page_function", "dashicons-welcome-widgets-menus", "3");
}
function request_page_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/admin_request_page.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function wallet_operation()
{
    add_menu_page("عملیات کیف پول", "عملیات کیف پول", "manage_options", "wallet_operation_page", "wallet_operation_page", "dashicons-portfolio", "10");
}
function wallet_operation_page()
{
    require get_template_directory() . "/template-parts/admin_add_wallet_money.php";
}
function send_notif()
{
    add_menu_page("ارسال پیام به کاربر", "ارسال پیام به کاربر", "manage_options", "send_notif_page", "send_notif_page", "dashicons-email-alt", "10");
}
function send_notif_page()
{
    require get_template_directory() . "/template-parts/admin_send_notification.php";
}
function hotel_request()
{
    add_menu_page("درخواست های هتل", "لیست درخواست هتل", "manage_options", "hotel_request_page", "request_hotel_page_function", "dashicons-welcome-widgets-menus", "3");
}
function request_hotel_page_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/admin_hotel_request_page.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function comments_management()
{
    add_menu_page("مدیریت نظرات", "مدیریت نظرات", "manage_options", "comments_management", "comments_management_page_function", "dashicons-welcome-widgets-menus", "11");
}
function comments_management_page_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        $comments = get_all_comments();
        echo "        <div class='admin_comment_box'>\r\n\t\t\t";
        require get_template_directory() . "/template-parts/admin_first_comment.php";
        echo "        </div>\r\n\t\t";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function Financial()
{
    add_menu_page("مالی", "مالی", "manage_options", "Financial_page", "Financial_function", "dashicons-money-alt", 28);
}
function Financial_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        require get_template_directory() . "/template-parts/Financial_template.php";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function ticket_management()
{
    add_menu_page("مدیریت تیکت ها", "مدیریت تیکت ها", "manage_options", "ticket_management", "ticket_management_page_function", " dashicons-tickets", "11");
}
function ticket_management_page_function()
{
    $check_lic = check_licence();
    if($check_lic === "succ_1") {
        $comments = get_all_comments();
        echo "        <div class='admin_comment_box'>\r\n\t\t\t";
        require get_template_directory() . "/template-parts/admin_ticket_template.php";
        echo "\r\n        </div>\r\n\t\t";
    } else {
        echo "<div class='ck_licc'><spsn>برای مشاهده تنظیمات لایسنس خود را فعال نمایید.</spsn></div>";
    }
}
function jayto_admin_scripts()
{
    wp_enqueue_style("jayto_admin_style", get_template_directory_uri() . "/css/admin_css.css", [], rand());
    wp_enqueue_script("media_uploader", get_template_directory_uri() . "/js/media-uploader.js", [], rand());
    wp_enqueue_script("admin_custom_js", get_template_directory_uri() . "/js/custom_admin.js", [], rand(), false);
    wp_enqueue_script("jayto_veu", "https://cdn.jsdelivr.net/npm/vue", ["jQuery"], NULL, false);
    wp_enqueue_script("jayto_mom", "https://cdn.jsdelivr.net/npm/moment", ["jQuery"], NULL, false);
    wp_enqueue_script("jayto_moment_jalali", "https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js", ["jQuery"], NULL, false);
    wp_enqueue_script("jayto_vdate", get_template_directory_uri() . "/js/v-datetime.js", ["jQuery"], NULL, false);
    wp_localize_script("admin_custom_js", "ajax_data", ["adju" => admin_url("admin-ajax.php"), "siteurl" => get_option("siteurl"), "security" => wp_create_nonce("file_upload"), "security5" => wp_create_nonce("rooms_upload_images"), "turl" => home_url()]);
}
function get_orders_by_status_func()
{
    $os = $_POST["os"];
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  order_status= " . $os . " ORDER BY id DESC ", object);
    $result1 = [];
    $result2 = [];
    $result3 = [];
    $result4 = [];
    $result5 = [];
    $result6 = [];
    $result7 = [];
    $result10 = [];
    $result11 = [];
    $result12 = [];
    $all_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_orders  ORDER BY id DESC ", object);
    foreach ($all_results as $key => $row) {
        if($row->order_status == 1) {
            $result1[$key] = $row;
        }
        if($row->order_status == 2) {
            $result2[$key] = $row;
        }
        if($row->order_status == 3) {
            $result3[$key] = $row;
        }
        if($row->order_status == 4) {
            $result4[$key] = $row;
        }
        if($row->order_status == 5) {
            $result5[$key] = $row;
        }
        if($row->order_status == 6) {
            $result6[$key] = $row;
        }
        if($row->order_status == 7) {
            $result7[$key] = $row;
        }
        if($row->order_status == 10) {
            $result10[$key] = $row;
        }
        if($row->order_status == 11) {
            $result11[$key] = $row;
        }
        if($row->order_status == 12) {
            $result12[$key] = $row;
        }
    }
    $html = (include get_template_directory() . "/template-parts/amin_order_template.php");
    exit(0);
}
function get_hot_orders_by_status_func()
{
    $os = $_POST["os"];
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  order_status= " . $os . " ORDER BY id DESC ", object);
    $result2 = [];
    $result3 = [];
    $result4 = [];
    $result5 = [];
    $result6 = [];
    $result7 = [];
    $result10 = [];
    $result11 = [];
    $result12 = [];
    $all_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders  ORDER BY id DESC ", object);
    foreach ($all_results as $key => $row) {
        if($row->order_status == 1) {
            $result2[$key] = $row;
        }
        if($row->order_status == 3) {
            $result3[$key] = $row;
        }
        if($row->order_status == 4) {
            $result4[$key] = $row;
        }
        if($row->order_status == 5) {
            $result5[$key] = $row;
        }
        if($row->order_status == 5) {
            $result6[$key] = $row;
        }
        if($row->order_status == 7) {
            $result7[$key] = $row;
        }
        if($row->order_status == 10) {
            $result10[$key] = $row;
        }
        if($row->order_status == 12) {
            $result12[$key] = $row;
        }
        if($row->order_status == 11) {
            $result11[$key] = $row;
        }
    }
    $html = (include get_template_directory() . "/template-parts/hot_admin_order_template.php");
    exit(0);
}
function get_finc_by_status_func()
{
    $os = $_POST["os"];
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_request_wallet WHERE pay_status= " . $os . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/fanacial_ajax_template.php");
    exit(0);
}
function admin_get_dans_template_func()
{
    $oid = $_POST["oid"];
    $html = (include get_template_directory() . "/template-parts/get_sans_template.php");
    exit(0);
}
function admin_update_private_sanse_table_func()
{
    $oid = $_POST["oid"];
    $dateTime = $_POST["dateTime"];
    $dateTime_exp = explode("/", $dateTime);
    global $wpdb;
    $table_name = $wpdb->prefix . "tour_reserve_request";
    $wpdb->update($table_name, ["tour_date" => $dateTime_exp[0], "sans" => $dateTime_exp[1]], ["id" => $oid], ["%s", "%s"], ["%d"]);
    exit(0);
}
function add_residance_discount_func()
{
    $id = $_POST["id"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $percent_discount = $_POST["percent_discount"];
    $res_meta = get_post_meta($id, "_all_res_meta", true);
    $discount = ["start_date " => $start_date, "end_date" => $end_date, "perscent_discount" => $percent_discount];
    $res_meta["discount"] = $discount;
    update_post_meta($id, "_all_res_meta", $res_meta);
    $res_meta2 = get_post_meta($id, "_all_res_meta", true);
    wp_send_json($res_meta2);
    exit(0);
}
function get_order_info_func()
{
    $oi = $_POST["oi"];
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_orders WHERE  id= " . $oi . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/admin_show_complete_order.php");
    exit(0);
}
function show_hotel_info_func()
{
    $oi = $_POST["oi"];
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  id= " . $oi . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/hotel_info_template.php");
    exit(1);
}
function get_hot_order_info_func()
{
    $oi = $_POST["oi"];
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_hotel_orders WHERE  id= " . $oi . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/admin_show_hot_complete_order.php");
    exit(0);
}
function get_torder_info_func()
{
    $oi = $_POST["oi"];
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "tour_reserve_request WHERE  id= " . $oi . " ORDER BY id DESC ", object);
    $eghamat = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "tour_variable WHERE  id= " . $result->var_id . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/adm_show_tour_order_info.php");
    exit(0);
}
function get_wallet_pay_notic_temp_func()
{
    $oi = $_POST["ui"];
    global $wpdb;
    $result = $wpdb->get_row("SELECT * FROM " . $wpdb->prefix . "jayto_request_wallet WHERE  id= " . $oi . " ORDER BY id DESC ", object);
    $html = (include get_template_directory() . "/template-parts/adm_add_wr_notic.php");
    exit(0);
}
function get_user_bank_info_func()
{
    $uid = $_POST["uid"];
    $user_meta = get_user_meta($uid);
    $html = (include get_template_directory() . "/template-parts/user_bank_info_template.php");
    exit(0);
}
function add_wallet_pay_notic_func()
{
    $oi = $_POST["ui"];
    $notic = $_POST["notic"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_request_wallet";
    $wpdb->update($table_name, ["admin_notic" => $notic], ["id" => $oi], ["%s"], ["%d"]);
    exit(0);
}
function get_chrw_temp_func()
{
    $oi = $_POST["ui"];
    $notic = $_POST["notic"];
    $html = (include get_template_directory() . "/template-parts/change_wr_status.php");
    exit(0);
}
function chanhe_rw_func()
{
    $ui = $_POST["ui"];
    $oi = $_POST["oi"];
    $pay_date = "";
    if($oi == 3) {
        $pay_date = time();
    }
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_request_wallet";
    $wpdb->update($table_name, ["pay_status" => $oi, "pay_date" => $pay_date], ["id" => $ui], ["%s", "%d"], ["%d"]);
    exit(0);
}
function chanhe_tur_status_func()
{
    $order_status = $_POST["os"];
    $order_id = $_POST["oi"];
    $start_timer = "";
    if($order_status == 2) {
        $start_timer = time();
    }
    global $wpdb;
    $table_name = $wpdb->prefix . "tour_reserve_request";
    $wpdb->update($table_name, ["order_status" => $order_status, "start_timer" => $start_timer], ["id" => $order_id], ["%d", "%d"], ["%d"]);
    exit(0);
}
function get_tur_ch_temp_func()
{
    $oi = $_POST["oi"];
    $html = (require get_template_directory() . "/template-parts/change_tour_os_temp.php");
    echo $html;
}
function notification_bubble_in_admin_menu_qa()
{
    global $menu;
    global $wpdb;
    $res = get_posts(["posts_per_page" => "-1", "orderby" => "rand", "post_type" => "residence", "post_status" => ["pending", "draft"]]);
    $fin = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_request_wallet  ", ARRAY_A);
    $fin_array = [];
    foreach ($fin as $number) {
        if($number["pay_date"] == "") {
            $fin_array[] = $number;
        }
    }
    $fin_num = count($fin_array);
    $comment_count = get_comment_counts();
    $number = count($res);
    $menu[6][0] >>= $number ? "<span class='update-plugins count-1'><span class='update-count'>" . $number . " </span></span>" : "";
    $menu[28][0] >>= $fin_num ? "<span class='update-plugins count-1'><span class='update-count'>" . $fin_num . " </span></span>" : "";
    $menu[11][0] >>= $comment_count[0] ? "<span class='update-plugins count-1'><span class='update-count'>" . $comment_count[0] . " </span></span>" : "";
}
function get_all_comments($status = 0)
{
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "jayto_comments WHERE  confirm=" . $status . " ORDER BY id DESC ", object);
    return $results;
}
function edit_comments_admin_func()
{
    $id = $_POST["id"];
    $order = $_POST["order"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_comments";
    if($order == "confirm") {
        $wpdb->update($table_name, ["confirm" => 1], ["id" => $id], ["%d"], ["%d"]);
    }
    if($order == "reject") {
        $wpdb->update($table_name, ["confirm" => 0], ["id" => $id], ["%d"], ["%d"]);
    }
    if($order == "delete") {
        $wpdb->delete($table_name, ["id" => $id]);
    }
    if($order == "edit") {
        $wpdb->update($table_name, ["comment" => 1], ["id" => $id], ["%s"], ["%d"]);
    }
    exit(0);
}
function get_user_wallet_add_func()
{
    $mobile_number = $_POST["mobile_number"];
    $user = get_user_by("login", $mobile_number);
    $uid = $user->ID;
    if($user) {
        $last_wallet = get_user_meta($uid, "jayto-wallet", "true");
        $html = (require get_template_directory() . "/template-parts/add_wallet_template.php");
        exit(1);
    }
    $html = (require get_template_directory() . "/template-parts/add_wallet_error.php");
    exit(1);
}
function get_user_noti_add_func()
{
    $mobile_number = $_POST["mobile_number"];
    $user = get_user_by("login", $mobile_number);
    $uid = $user->ID;
    if($user) {
        $last_wallet = get_user_meta($uid, "jayto-wallet", "true");
        $html = (require get_template_directory() . "/template-parts/admin_notification_template.php");
        exit(1);
    }
    $html = (require get_template_directory() . "/template-parts/add_wallet_error.php");
    exit(1);
}
function add_noti_to_user_func()
{
    $desc = $_POST["desc"];
    $uid = $_POST["uid"];
    $user_notes = [];
    $old_note = get_user_meta($uid, "user_note", false);
    $user_notes[] = $desc;
    foreach ($old_note[0] as $note) {
        $user_notes[] = $note;
    }
    update_user_meta($uid, "user_note", $user_notes);
    $last_key = array_key_first($user_notes);
    echo $last_key;
    exit(0);
}
function delete_user_not_func()
{
    $id = $_POST["id"];
    $uid = $_POST["uid"];
    $user_notes = [];
    $old_note = get_user_meta($uid, "user_note", false);
    foreach ($old_note[0] as $note) {
        $user_notes[] = $note;
    }
    unset($user_notes[$id]);
    update_user_meta($uid, "user_note", $user_notes);
}
function adm_update_wallet_func()
{
    global $wpdb;
    $mobile_number = $_POST["mobile_number"];
    $amount = $_POST["amount"];
    $user = get_user_by("login", $mobile_number);
    $uid = $user->ID;
    $now_wallet = get_user_meta($uid, "jayto-wallet", "true");
    $last_wallet = $now_wallet + $amount;
    update_user_meta($uid, "jayto-wallet", $last_wallet);
    $table_name = $wpdb->prefix . "jayto_transaction";
    $wpdb->insert($table_name, ["Authority" => time(), "refid" => time(), "user_id" => $uid, "pay_date" => time(), "pay_status" => 1, "amount" => $amount, "transaction_desc" => "شارژ کیف پول توسط ادمین"], ["%d", "%d", "%d", "%d", "%d", "%d", "%s"]);
    $html = (require get_template_directory() . "/template-parts/add_wallet_template.php");
    exit(1);
}
function adm_update_wallet_low_func()
{
    global $wpdb;
    $mobile_number = $_POST["mobile_number"];
    $amount = $_POST["amount"];
    $user = get_user_by("login", $mobile_number);
    $uid = $user->ID;
    $now_wallet = get_user_meta($uid, "jayto-wallet", "true");
    $last_wallet = $now_wallet - $amount;
    update_user_meta($uid, "jayto-wallet", $last_wallet);
    $table_name = $wpdb->prefix . "jayto_transaction";
    $wpdb->insert($table_name, ["Authority" => time(), "refid" => time(), "user_id" => $uid, "pay_date" => time(), "pay_status" => 1, "amount" => $amount, "transaction_desc" => ";کاهش موجودی کیف پول توسط ادمین"], ["%d", "%d", "%d", "%d", "%d", "%d", "%s"]);
    $html = (require get_template_directory() . "/template-parts/add_wallet_template.php");
    exit(1);
}
function edit_comments_down_func()
{
    $id = $_POST["id"];
    $text = $_POST["text"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_comments";
    $wpdb->update($table_name, ["comment" => $text], ["id" => $id], ["%s"], ["%d"]);
    exit(0);
}
function get_comment_counts()
{
    global $wpdb;
    $results_need = $wpdb->get_results("SELECT id FROM " . $wpdb->prefix . "jayto_comments WHERE  confirm=0 ORDER BY id DESC ", ARRAY_A);
    $results_conf = $wpdb->get_results("SELECT id FROM " . $wpdb->prefix . "jayto_comments WHERE  confirm=1 ORDER BY id DESC ", ARRAY_A);
    $count_conf = count($results_conf);
    $count_need = count($results_need);
    $result = [$count_need, $count_conf];
    return $result;
}
function refresh_coment_html_func()
{
    if(isset($_POST["status"])) {
        $status = $_POST["status"];
    } else {
        $status = 0;
    }
    $comments = get_all_comments($status);
    $html = "<div class='admin_comment_box'>";
    $html .= (require get_template_directory() . "/template-parts/admin_first_comment.php");
    $html .= "</div>";
    return $html;
}
function register_custom_post_status()
{
    register_post_status("failed", ["label" => _x("ردشده", "residence"), "public" => true, "exclude_from_search" => false, "show_in_admin_all_list" => true, "show_in_admin_status_list" => true, "label_count" => _n_noop("fail <span class=\"count\">(%s)</span>", "failed <span class=\"count\">(%s)</span>")]);
}
function display_custom_post_status_option()
{
    global $post;
    $complete = "";
    $label = "";
    if($post->post_type == "residence") {
        if($post->post_status == "failed") {
            $selected = "selected";
        }
        echo "<script>\r\njQuery(document).ready(function(){\r\njQuery(\"select#post_status\").append(\"<option value=\\\"failed\\\" " . $selected . ">ردشده</option>\");\r\njQuery(\".misc-pub-section label\").append(\"<span id=\\\"post-status-display\\\"> ردشده</span>\");\r\n});\r\n</script>\r\n";
    }
}
function my_featured_post_field()
{
    global $post;
    if(get_post_type($post) != "residence") {
        return false;
    }
    $value = get_post_meta($post->ID, "my_featured_post_field", true);
    echo "    <div class=\"misc-pub-section micp_custom\">\r\n\t\t        <span>دلیل رد</span>\r\n        <input type=\"text\" value=\"";
    echo $value;
    echo "\" name=\"my_featured_post_field\"/>\r\n    </div>\r\n\t";
}
function hotel_save_rooms_func()
{
    $pid = $_POST["pid"];
    $id_number = (int) $_POST["room_number"];
    $room_name = $_POST["room_name"];
    $bed_count = $_POST["bed_count"];
    $room_breackfast = $_POST["room_breackfast"];
    $room_lunch = $_POST["room_lunch"];
    $room_Dinner = $_POST["room_Dinner"];
    $room_normal_price = $_POST["room_normal_price"];
    $room_endWeek_price = $_POST["room_endWeek_price"];
    $room_child_unsix_price = $_POST["room_child_unsix_price"];
    $room_child_upsix_price = $_POST["room_child_upsix_price"];
    $room_single_bed = $_POST["room_single_bed"];
    $room_Double_bed = $_POST["room_Double_bed"];
    $r_short_desc = $_POST["r_short_desc"];
    $room_property = $_POST["room_property"];
    $room_tip_number = $_POST["room_tip_number"];
    $gurls = $_POST["urls"];
    $info = ["room_name" => $room_name, "bed_count" => $bed_count, "room_breackfast" => $room_breackfast, "room_lunch" => $room_lunch, "room_Dinner" => $room_Dinner, "room_normal_price" => $room_normal_price, "room_endWeek_price" => $room_endWeek_price, "room_child_unsix_price" => $room_child_unsix_price, "room_child_upsix_price" => $room_child_upsix_price, "room_single_bed" => $room_single_bed, "room_Double_bed" => $room_Double_bed, "r_short_desc" => $r_short_desc, "room_property" => $room_property, "room_tip_number" => $room_tip_number, "urls" => $gurls];
    $hotel_room = [];
    $hotel_room_old = get_post_meta($pid, "rooms_info", true);
    if($hotel_room_old) {
        $hotel_room = $hotel_room_old;
    }
    $hotel_room[$id_number] = $info;
    update_post_meta($pid, "rooms_info", $hotel_room);
    $today = date("Y/m/d");
    $date_new = strtotime("+60 days", strtotime($today));
    $date_sixteen = date("Y/m/d", $date_new);
    $exptoday = explode("/", $today);
    $expsixteen = explode("/", $date_sixteen);
    $per_today = gregorian_to_jalali($exptoday[0], $exptoday[1], $exptoday[2], "/");
    $seex_per_days = gregorian_to_jalali($expsixteen[0], $expsixteen[1], $expsixteen[2], "/");
    $calender = get_beetweens_date($per_today, $seex_per_days);
    $calender_price = [];
    $hot_day_price = "hot_day_price" . $id_number;
    $custom_price = get_post_meta($pid, $hot_day_price, true);
    foreach ($calender as $row) {
        $date_exp = explode("-", $row);
        $ts = jmktime("0", "0", "0", $date_exp[1], $date_exp[2], $date_exp[0]);
        $end_week = jstrftime("%a", $ts);
        if(array_key_exists($row, $custom_price)) {
            $calender_price[$row] = $custom_price[$row];
        } elseif($end_week == "چ" || $end_week == "پ" || $end_week == "ج") {
            $calender_price[$row] = $room_endWeek_price;
        } else {
            $calender_price[$row] = $room_normal_price;
        }
    }
    $hotel_calender = "hotel_calender" . $id_number;
    $sum_night = "hotel_calender" . $id_number;
    update_post_meta($pid, $hotel_calender, $calender_price);
}
function room_file_upload_callback()
{
    check_ajax_referer("room_file_upload", "security5");
    $arr_img_ext = ["image/png", "image/jpeg", "image/jpg"];
    if(in_array($_FILES["files"]["type"], $arr_img_ext)) {
        $upload = wp_upload_bits($_FILES["file"]["name"], NULL, file_get_contents($_FILES["file"]["tmp_name"]));
    }
    echo $upload["url"];
    wp_die();
}
function get_nun_answer_ticket()
{
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $results = $wpdb->get_results("SELECT * FROM " . $table_name . " WHERE parent = 0 ORDER BY `id` DESC", ARRAY_A);
    return $results;
}
function admin_ticket_answer()
{
    $link_target = "";
    $uid = sanitize_text_field($_POST["uid"]);
    $ticket_desc = sanitize_text_field($_POST["answer"]);
    $ticket_parent = sanitize_text_field($_POST["tid"]);
    $ticket_answer_date = $date = date("Y-m-d H:i:s");
    $file = $_FILES["admin_fileupload"];
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
    $wpdb->insert($table_name, ["uid" => $uid, "subject" => "پاسخ تیکت", "description" => $ticket_desc, "ticket_date" => $ticket_answer_date, "parent" => $ticket_parent, "status" => 0, "admin_status" => 1, "file_link" => $link_target], ["%d", "%s", "%s", "%s", "%d", "%d", "%d", "%s"]);
    $wpdb->query($wpdb->prepare("UPDATE " . $table_name . " SET status = %d WHERE ID = %d", 1, $ticket_parent));
    exit(0);
}
function get_hotel_rooms_func()
{
    $hid = $_POST["hid"];
    $hotel_rooms = get_post_meta($hid, "rooms_info", true);
    $html = (require get_template_directory() . "/template-parts/get_rooms_add_discount.php");
    exit(0);
}
function add_room_discount_func()
{
    $hid = $_POST["hid"];
    $rid = $_POST["rid"];
    $start_date = $_POST["start_date"];
    $end_date = $_POST["end_date"];
    $percent_discount = $_POST["percent_discount"];
    $hotel_rooms = get_post_meta($hid, "rooms_info", true);
    $discount = ["start_date " => $start_date, "end_date" => $end_date, "perscent_discount" => $percent_discount];
    $hotel_rooms[$rid]["discount"] = $discount;
    update_post_meta($hid, "rooms_info", $hotel_rooms);
    exit(0);
}
function admin_ticket_answer_1()
{
    $uid = sanitize_text_field($_POST["uid"]);
    $ticket_desc = sanitize_text_field($_POST["answer"]);
    $ticket_parent = sanitize_text_field($_POST["tid"]);
    $ticket_answer_date = $date = date("Y-m-d H:i:s");
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $wpdb->insert($table_name, ["uid" => $uid, "subject" => "پاسخ تیکت", "description" => $ticket_desc, "ticket_date" => $ticket_answer_date, "parent" => $ticket_parent, "status" => 0], ["%d", "%s", "%s", "%s", "%d", "%d"]);
    $wpdb->update($table_name, ["status" => 1], ["id" => $ticket_parent], ["%d"], ["%d"]);
    exit(0);
}
function admin_ticket_change_status()
{
    global $wpdb;
    global $table_prefix;
    $table_name = $table_prefix . "user_ticket";
    $tid = $_POST["tid"];
    $status = $_POST["status"];
    $wpdb->update($table_name, ["status" => $status], ["id" => $tid], ["%d"], ["%d"]);
    exit(0);
}
function get_tour_order_by_status_func()
{
    $os = $_POST["os"];
    global $wpdb;
    $results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "tour_reserve_request WHERE  order_status= " . $os . " ORDER BY id DESC ", object);
    $result1 = [];
    $result2 = [];
    $result3 = [];
    $result4 = [];
    $all_results = $wpdb->get_results("SELECT * FROM " . $wpdb->prefix . "tour_reserve_request  ORDER BY id DESC ", object);
    foreach ($all_results as $key => $row) {
        if($row->order_status == 1) {
            $result1[$key] = $row;
        }
        if($row->order_status == 2) {
            $result2[$key] = $row;
        }
        if($row->order_status == 3) {
            $result3[$key] = $row;
        }
        if($row->order_status == 4) {
            $result4[$key] = $row;
        }
    }
    $html = (include get_template_directory() . "/template-parts/tour_order_template.php");
    exit(0);
}
function remove_hotel_room_func()
{
    $data = $_POST["data"];
    $data_exp = explode("-", $data);
    list($room_id, $hotel_id) = $data_exp;
    $hotel_room_old = get_post_meta($hotel_id, "rooms_info", true);
    unset($hotel_room_old[$room_id]);
    update_post_meta($hotel_id, "rooms_info", $hotel_room_old);
    exit(0);
}
function admin_change_order_status_func()
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
    if($order->order_status == 12 && sms_cart_need_conf_to_guest) {
        send_sms_func($order->id, sms_cart_need_conf_to_guest, $mobile_number);
    }
    if($order->order_status == 4 && sms_reserve_need_conf_to_guest) {
        send_sms_func($order_id, sms_reserve_need_conf_to_guest, $mobile_number);
    }
    if($order->order_status == 11 && sms_cash_need_conf_to_guest) {
        send_sms_func($order_id, sms_cash_need_conf_to_guest, $mobile_number);
    }
    exit(0);
}
function admin_change_order_status_cart_return_func()
{
    $order_id = $_POST["oid"];
    $os = $_POST["os"];
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
    $wpdb->update($table_name, ["host_share" => $amount_for_update], ["id" => $order_id], ["%d"], ["%d"]);
    $wpdb->update($table_transaction, ["pay_status" => 0], ["user_id" => $order->author_id], ["%d"], ["%d"]);
    if(user_can($order->author_id, "administrator")) {
        $mobile_number = sms_modir_answer_ticket;
    } else {
        $mo = get_user_meta($order->user_id, "user_mobile", true);
        $mobile_number = $mo;
    }
    if($order->order_status == 12 && sms_cart_need_conf_to_guest) {
        send_sms_func($order->id, sms_cart_need_conf_to_guest, $mobile_number);
    }
    if($order->order_status == 4 && sms_reserve_need_conf_to_guest) {
        send_sms_func($order_id, sms_reserve_need_conf_to_guest, $mobile_number);
    }
    exit(0);
}
function admin_change_order_status_for_request_func()
{
    $order_id = $_POST["oid"];
    $os = $_POST["os"];
    $new_time = time();
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
    $host_share = get_option("hoster_percent");
    $amount_for_update = $order->price * $host_share / 100;
    $wpdb->update($table_name, ["host_share" => $amount_for_update], ["id" => $order_id], ["%d"], ["%d"]);
    $mo = get_user_by("id", $order->user_id);
    $mobile_number = $mo->user_login;
    if($order->order_status == 12 && sms_cart_need_conf_to_guest) {
        send_sms_func($order->id, sms_cart_need_conf_to_guest, $mobile_number);
    }
    if($order->order_status == 4 && sms_reserve_need_conf_to_guest) {
        send_sms_func($order->id, sms_reserve_need_conf_to_guest, $mobile_number);
    }
    exit(0);
}
function get_admin_change_order_status_tmp_func()
{
    $res = $_POST["res"];
    $status = $_POST["status"];
    if($res == "res") {
        $html = (include get_template_directory() . "/template-parts/admin_opt_res_page.php");
    } else {
        $html = (include get_template_directory() . "/template-parts/admin_op_template.php");
    }
    exit(0);
}
function change_admin_hotel_room_func()
{
    $order_id = $_POST["oid"];
    $room_id = $_POST["new_room_id"];
    global $wpdb;
    $table_name = $wpdb->prefix . "jayto_hotel_orders";
    $wpdb->update($table_name, ["room_id" => $room_id], ["id" => $order_id], ["%d"], ["%d"]);
    $html = (include get_template_directory() . "/template-parts/admin_op_template.php");
    exit(0);
}
function set_sans_func()
{
    $sans = $_POST["sans"];
    $pid = $_POST["pid"];
    $old_sanse = get_post_meta($pid, "tour_sans", true);
    $sans_exp = explode("/", $sans);
    $sans_array = [];
    if(!$old_sanse) {
        $sans_array[$sans_exp[0]] = [$sans_exp[1] => ["reserve" => 0, "reserve_ids" => [], "request_type" => "general"]];
        update_post_meta($pid, "tour_sans", $sans_array);
    } else {
        foreach ($old_sanse as $key => $row) {
            $sans_array[$key] = $row;
        }
        foreach ($sans_array as $san) {
            if(!key_exists($sans_exp[0], $sans_array)) {
                $sans_array[$sans_exp[0]] = [$sans_exp[1] => ["reserve" => 0, "reserve_ids" => [], "request_type" => "general"]];
            } else {
                $sans_array[$sans_exp[0]][$sans_exp[1]] = ["reserve" => 0, "reserve_ids" => [], "request_type" => "general"];
            }
        }
        update_post_meta($pid, "tour_sans", $sans_array);
    }
    $send_data = $sans_exp[0] . "/" . $sans_exp[1];
    echo json_encode($send_data);
    exit(0);
}
function del_sans_admin_func()
{
    $date = $_POST["date"];
    $pid = $_POST["pid"];
    $time = $_POST["time"];
    $sizof = "";
    $old_sanse = get_post_meta($pid, "tour_sans", true);
    $fsans = $old_sanse[$date];
    $reserved = $fsans[$time]["reserve"];
    if($reserved == 0) {
        unset($old_sanse[$date][$time]);
        if(count($old_sanse[$date]) == 0) {
            unset($old_sanse[$date]);
            $sizof = "zero";
        }
        update_post_meta($pid, "tour_sans", $old_sanse);
    }
    echo $sizof;
    exit(0);
}
function custom_add_room_reserve_func()
{
    $dates = $_POST["dates"];
    $pid = $_POST["pid"];
    $room_id = $_POST["room_id"];
    $dates_exp = explode(" ~ ", $dates);
    $all_reserve_date = get_post_meta($pid, "hotel_reserves" . $room_id, false);
    foreach ($dates_exp as $row) {
        if(!in_array($row, $all_reserve_date)) {
            $all_reserve_date[0][] = $row;
        }
    }
    update_post_meta($pid, "hotel_reserves" . $room_id, $all_reserve_date);
}
function custom_rev_room_reserve_func()
{
    $dates = $_POST["dates"];
    $pid = $_POST["pid"];
    $room_id = $_POST["room_id"];
    $dates_exp = explode("~", $dates);
    $all_reserve_date = get_post_meta($pid, "hotel_reserves" . $room_id, false);
    foreach ($dates_exp as $row) {
        if(($key = array_search($row, $all_reserve_date)) !== false) {
            unset($all_reserve_date[$key]);
        }
    }
    update_post_meta($pid, "hotel_reserves" . $room_id, $all_reserve_date);
}
function admin_user_ids()
{
    global $wpdb;
    $wp_user_search = $wpdb->get_results("SELECT ID, display_name FROM " . $wpdb->users . " ORDER BY ID");
    $adminArray = [];
    foreach ($wp_user_search as $userid) {
        $curID = $userid->ID;
        $curuser = get_userdata($curID);
        $user_level = $curuser->user_level;
        if(8 <= $user_level) {
            $adminArray[] = $curID;
        }
    }
    return $adminArray[0];
}
function create_cart_pay_page()
{
    global $user_ID;
    if(get_page_by_title("cart_pay") == NULL) {
        $new_post = ["post_title" => "cart_pay", "post_content" => "", "post_status" => "publish", "post_date" => date("Y-m-d H:i:s"), "post_author" => admin_user_ids(), "post_type" => "page"];
        $post_id = wp_insert_post($new_post);
        update_post_meta($post_id, "_wp_page_template", "template-parts/cart_pay_template.php");
    }
}
function create_cash_pay_page()
{
    global $user_ID;
    if(get_page_by_title("cash_pay") == NULL) {
        $new_post = ["post_title" => "cash_pay", "post_content" => "", "post_status" => "publish", "post_date" => date("Y-m-d H:i:s"), "post_author" => admin_user_ids(), "post_type" => "page"];
        $post_id = wp_insert_post($new_post);
        update_post_meta($post_id, "_wp_page_template", "template-parts/cash_pay_template.php");
    }
}
function create_voucher_page()
{
    if(get_page_by_title("voucher") == NULL) {
        $new_post = ["post_title" => "voucher", "post_content" => "", "post_status" => "publish", "post_date" => current_time("mysql"), "post_author" => 1, "post_type" => "page"];
        $post_id = wp_insert_post($new_post);
        if(!is_wp_error($post_id)) {
            update_post_meta($post_id, "_wp_page_template", "template-parts/voucher_hotel.php");
        }
    }
}
function rooms_upload_images_func()
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
function delete_rooms_image_callback()
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
function create_opt_db()
{
    $tbl_opt_check = get_option("table_opt_check");
    global $wpdb;
    $table_name = $wpdb->prefix . "opt";
    $table_name2 = $wpdb->prefix . "jayto_orders";
    $table_name3 = $wpdb->prefix . "jayto_transaction";
    $table_name4 = $wpdb->prefix . "jayto_request_wallet";
    $table_name5 = $wpdb->prefix . "jayto_hotel_orders";
    $table_name6 = $wpdb->prefix . "tour_reserve_request";
    $table_name7 = $wpdb->prefix . "jayto_comments";
    $table_name8 = $wpdb->prefix . "user_ticket";
    $table_name9 = $wpdb->prefix . "user_answer";
    $table_name10 = $wpdb->prefix . "tour_variable";
    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE IF NOT EXISTS " . $table_name . " (\r\n     id BIGINT NOT NULL AUTO_INCREMENT,\r\n     phone_number VARCHAR(255) NOT NULL,\r\n    opt_code INT(255) NOT NULL ,\r\n    created_date  VARCHAR(255) NOT NULL ,\r\n    expire_date  VARCHAR(255) NOT NULL ,\r\n      PRIMARY KEY id (id)\r\n    ) " . $charset_collate . ";";
    $sql2 = "CREATE TABLE IF NOT EXISTS " . $table_name2 . " (id INT NOT NULL AUTO_INCREMENT ,res_id INT(255) NOT NULL,author_id INT(255) NOT NULL , user_id INT(255) NOT NULL , passenger_number INT(255) NOT NULL , check_in VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , check_out VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , price INT(255) NOT NULL , start_timer INT(255) NOT NULL , order_status INT NOT NULL ,cancel_date VARCHAR(255) NULL DEFAULT NULL,cancel_price INT(255) NULL DEFAULT NULL,host_share INT(255) NULL DEFAULT NULL,  PRIMARY KEY id (id)) " . $charset_collate . ";";
    $sql5 = "CREATE TABLE IF NOT EXISTS " . $table_name5 . " (id INT NOT NULL AUTO_INCREMENT ,hot_id INT(255) NOT NULL,room_id INT(255) NULL,author_id INT(255) NOT NULL , user_id INT(255) NOT NULL , adult_number INT(255) NOT NULL, child_number INT(255) NOT NULL , check_in VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , check_out VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL , price INT(255) NOT NULL , start_timer INT(255) NOT NULL , order_status INT NOT NULL ,cancel_date VARCHAR(255) NULL DEFAULT NULL,cancel_price INT(255) NULL DEFAULT NULL,host_share INT(255) NULL DEFAULT NULL,  PRIMARY KEY id (id)) " . $charset_collate . ";";
    $sql3 = "CREATE TABLE IF NOT EXISTS " . $table_name3 . " (\r\n     id INT(255) NOT NULL AUTO_INCREMENT,\r\n     Authority VARCHAR(255) NULL DEFAULT NULL,\r\n    refid VARCHAR(255) NULL DEFAULT NULL ,\r\n    user_id  INT NULL DEFAULT NULL ,\r\n    pay_date  INT NULL DEFAULT NULL ,\r\n    pay_status  INT NULL DEFAULT 0 ,\r\n     amount  INT NULL DEFAULT NULL ,\r\n       orderid  INT NULL DEFAULT NULL ,\r\n     passenger_name VARCHAR(255) NULL DEFAULT NULL ,\r\n     passenger_famili VARCHAR(255) NULL DEFAULT NULL ,\r\n     passenger_phone VARCHAR(255) NULL DEFAULT NULL ,\r\n     transaction_desc VARCHAR(255) NULL DEFAULT NULL ,\r\n       PRIMARY KEY id (id)\r\n    ) " . $charset_collate . ";";
    $sql4 = "CREATE TABLE IF NOT EXISTS " . $table_name4 . " (\r\n     id INT(255) NOT NULL AUTO_INCREMENT,\r\n     user_id INT(255) NULL DEFAULT NULL,\r\n    amount INT(255) NULL DEFAULT NULL ,\r\n    pay_number  VARCHAR(255) NULL DEFAULT NULL ,\r\n    request_date  INT(255) NULL DEFAULT NULL ,\r\n    pay_date  INT(255) NULL DEFAULT NULL ,\r\n    pay_status  INT NULL DEFAULT 0 ,\r\n    admin_notic  VARCHAR(255) NULL DEFAULT NULL ,\r\n       PRIMARY KEY id (id)\r\n    ) " . $charset_collate . ";";
    $sql6 = "CREATE TABLE IF NOT EXISTS " . $table_name6 . " (\r\n     id INT(255) NOT NULL AUTO_INCREMENT,\r\n     tour_id INT(255)  NULL DEFAULT NULL,\r\n    user_id INT(255) NULL DEFAULT NULL ,\r\n    request_date  VARCHAR(255) NULL DEFAULT NULL ,\r\n    request_type  VARCHAR(255) NULL DEFAULT NULL ,\r\n    tour_date  VARCHAR(255) NULL DEFAULT NULL ,\r\n    sans  VARCHAR(255) NULL DEFAULT NULL ,\r\n    pepole_number  INT(255) NULL DEFAULT NULL ,\r\n    price  INT(255) NULL DEFAULT NULL ,\r\n    order_status  INT(255) NULL DEFAULT NULL ,\r\n    pay_status  INT(255) NULL DEFAULT NULL ,\r\n    start_timer INT(255) NULL DEFAULT NULL ,\r\n    passenger_phone VARCHAR(255) NULL DEFAULT NULL ,\r\n    passenger_name VARCHAR(255) NULL DEFAULT NULL ,\r\n    passenger_famili VARCHAR(255) NULL DEFAULT NULL ,\r\n    host_share INT(255) NULL DEFAULT NULL ,\r\n       PRIMARY KEY id (id)\r\n    ) " . $charset_collate . ";";
    $sql7 = "CREATE TABLE IF NOT EXISTS " . $table_name7 . " (\r\n\tid INT(255) NOT NULL AUTO_INCREMENT,\r\n\tres_id INT(255)  NULL DEFAULT NULL,\r\n   user_id INT(255) NULL DEFAULT NULL ,\r\n   comment  TEXT(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   comment_date  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   Match_the_ad  INT(255) NULL DEFAULT NULL ,\r\n   Services  INT(255) NULL DEFAULT NULL ,\r\n   res_Location  INT(255) NULL DEFAULT NULL ,\r\n  res_encounter  INT(255) NULL DEFAULT NULL ,\r\n  cleaning  INT(255) NULL DEFAULT NULL ,\r\n   price  INT(255) NULL DEFAULT NULL ,\r\n   admin_answer  TEXT(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   confirm INT(255) NULL DEFAULT NULL ,\r\n\r\n\t  PRIMARY KEY id (id)\r\n   ) " . $charset_collate . ";";
    $sql8 = "CREATE TABLE IF NOT EXISTS " . $table_name8 . " (\r\n\tid INT(255) NOT NULL AUTO_INCREMENT,\r\n\tuid INT(255)  NULL DEFAULT NULL,\r\n   subject  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   description  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   ticket_date  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   file_link  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   parent  INT(255) NULL DEFAULT NULL ,\r\n   status  INT(255) NULL DEFAULT NULL ,\r\n   admin_status  INT(255) NULL DEFAULT NULL ,\r\n\r\n\r\n\t  PRIMARY KEY id (id)\r\n   ) " . $charset_collate . ";";
    $sql9 = "CREATE TABLE IF NOT EXISTS " . $table_name9 . " (\r\n\tid INT(255) NOT NULL AUTO_INCREMENT,\r\n\tuid INT(255)  NULL DEFAULT NULL,\r\n\tpid INT(255)  NULL DEFAULT NULL,\r\n   title  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   answer_date  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   parent  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n\t  PRIMARY KEY id (id)\r\n   ) " . $charset_collate . ";";
    $sql10 = "CREATE TABLE IF NOT EXISTS " . $table_name10 . " (\r\n\tid INT(255) NOT NULL AUTO_INCREMENT,\r\n\ttid INT(255)  NULL DEFAULT NULL,\r\n\ttitle VARCHAR(255)  NULL DEFAULT NULL,\r\n   price  VARCHAR(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL ,\r\n   base  INT(255) NULL DEFAULT NULL ,\r\n  \t  PRIMARY KEY id (id)\r\n   ) " . $charset_collate . ";";
    require_once ABSPATH . "wp-admin/includes/upgrade.php";
    dbDelta($sql);
    dbDelta($sql2);
    dbDelta($sql3);
    dbDelta($sql4);
    dbDelta($sql5);
    dbDelta($sql6);
    dbDelta($sql7);
    dbDelta($sql8);
    dbDelta($sql9);
    dbDelta($sql10);
    $column_name = "confirm_status";
    $column_pay = "pay_type";
    $cart_digit = "cart_digit";
    $recipt_img = "cart_img";
    $discount_price = "discount_price";
    $tour_var = "var_id";
    $create_ddl = "ALTER TABLE " . $table_name2 . " ADD " . $column_name . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name2, $column_name, $create_ddl);
    $create_ddl2 = "ALTER TABLE " . $table_name5 . " ADD " . $column_name . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name5, $column_name, $create_ddl2);
    $create_ddl3 = "ALTER TABLE " . $table_name5 . " ADD " . $column_pay . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name5, $column_pay, $create_ddl3);
    $create_ddl4 = "ALTER TABLE " . $table_name2 . " ADD " . $column_pay . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name2, $column_pay, $create_ddl4);
    $create_ddl5 = "ALTER TABLE " . $table_name2 . " ADD " . $cart_digit . " VARCHAR(255)  NULL DEFAULT NULL";
    $create_ddl6 = "ALTER TABLE " . $table_name5 . " ADD " . $cart_digit . " VARCHAR(255)  NULL DEFAULT NULL";
    $create_ddl61 = "ALTER TABLE " . $table_name6 . " ADD " . $tour_var . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name2, $cart_digit, $create_ddl5);
    maybe_add_column($table_name5, $cart_digit, $create_ddl6);
    $create_ddl7 = "ALTER TABLE " . $table_name2 . " ADD " . $recipt_img . " VARCHAR(255)  NULL DEFAULT NULL";
    $create_ddl8 = "ALTER TABLE " . $table_name5 . " ADD " . $recipt_img . " VARCHAR(255)  NULL DEFAULT NULL";
    $create_ddl9 = "ALTER TABLE " . $table_name2 . " ADD " . $discount_price . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name2, $recipt_img, $create_ddl7);
    $create_ddl10 = "ALTER TABLE " . $table_name5 . " ADD " . $discount_price . " VARCHAR(255)  NULL DEFAULT NULL";
    maybe_add_column($table_name2, $recipt_img, $create_ddl7);
    maybe_add_column($table_name5, $recipt_img, $create_ddl8);
    maybe_add_column($table_name2, $discount_price, $create_ddl9);
    maybe_add_column($table_name5, $discount_price, $create_ddl10);
    maybe_add_column($table_name6, $tour_var, $create_ddl61);
}
function custom_admin_script()
{
    echo "    <script type=\"text/javascript\">\r\n        jQuery(document).ready(function(\$) {\r\n            \$('.taxonomy-city input[type=\"checkbox\"]').on('change', function() {\r\n                var isParent = \$(this).parent().hasClass('cat-parent'); \r\n                if (isParent) {\r\n                    \$(this).closest('ul').find('input[type=\"checkbox\"]').prop('checked', false);\r\n                    \$(this).prop('checked', true);\r\n                }\r\n            });\r\n        });\r\n    </script>\r\n    ";
}

?>
