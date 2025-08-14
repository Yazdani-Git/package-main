<?php
function hotel_post_type() {
	$labels = array(
		'name'                  => _x( 'هتل', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'هتل', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'هتل', 'text_domain' ),
		'name_admin_bar'        => __( 'هتل', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'مادر:', 'text_domain' ),
		'all_items'             => __( 'تمام هتل ها', 'text_domain' ),
		'add_new_item'          => __( 'افزودن هتل جدید', 'text_domain' ),
		'add_new'               => __( 'افزودن جدید', 'text_domain' ),
		'new_item'              => __( 'هتل جدید', 'text_domain' ),
		'edit_item'             => __( 'ویرایش هتل', 'text_domain' ),
		'update_item'           => __( 'بروز رسانی هتل', 'text_domain' ),
		'view_item'             => __( 'مشاهده هتل', 'text_domain' ),
		'view_items'            => __( 'مشاهده هتل ها', 'text_domain' ),
		'search_items'          => __( 'جستجوی هتل', 'text_domain' ),
		'not_found'             => __( 'پیدا نشد', 'text_domain' ),
		'not_found_in_trash'    => __( 'در سطل زباله پیدا نشد', 'text_domain' ),
		'featured_image'        => __( 'تصویر هتل', 'text_domain' ),
		'set_featured_image'    => __( 'درج تصویر هتل', 'text_domain' ),
		'remove_featured_image' => __( 'حذف تصویر هتل', 'text_domain' ),
		'use_featured_image'    => __( 'استفاده تصویر هتل', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'بروزرسانی این مورد', 'text_domain' ),
		'items_list'            => __( 'لیست هتل ها', 'text_domain' ),
		'items_list_navigation' => __( 'لیست هتل ها', 'text_domain' ),
		'filter_items_list'     => __( 'فیلتر لیست', 'text_domain' ),
	);
	$args   = array(
		'label'                     => __( 'hotel', 'هتل' ),
		'description'               => __( 'درج و ویرایش هتل ها', 'text_domain' ),
		'labels'                    => $labels,
		'supports'                  => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'author', 'thumbnail', 'comments', 'gallery' ),
		'taxonomies'                => array( 'post_tag' ),
		'hierarchical'              => true,
		'public'                    => true,
		'show_ui'                   => true,
		'show_in_menu'              => true,
		'menu_position'             => 5,
		'show_in_admin_bar'         => true,
		'show_in_nav_menus'         => true,
		'can_export'                => true,
		'has_archive'               => true,
		'exclude_from_search'       => false,
		'publicly_queryable'        => true,
		'capability_type'           => 'page',
		'show_in_admin_status_list' => true,
		'menu_icon'                 => 'dashicons-building',
	);
	register_post_type( 'hotel', $args );
}

add_action( 'init', 'hotel_post_type', 0 );
function hotel_tools_tax() {
	$labels = array(
		'name'                       => _x( 'امکانات', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'امکانات', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'امکانات', 'text_domain' ),
		'all_items'                  => __( 'تمام امکانات', 'text_domain' ),
		'parent_item'                => __( 'مورد مادر', 'text_domain' ),
		'parent_item_colon'          => __( 'مورد مادر:', 'text_domain' ),
		'new_item_name'              => __( ' امکانات جدید', 'text_domain' ),
		'add_new_item'               => __( 'افزودن امکانات جدید', 'text_domain' ),
		'edit_item'                  => __( 'ویرایش امکانات', 'text_domain' ),
		'update_item'                => __( 'بروز رسانی امکانات', 'text_domain' ),
		'view_item'                  => __( 'مشاهده امکانات', 'text_domain' ),
		'separate_items_with_commas' => __( 'امکانات را با کاما جدا کنید', 'text_domain' ),
		'add_or_remove_items'        => __( 'افزودن یا حذف امکانات', 'text_domain' ),
		'choose_from_most_used'      => __( 'انتخاب از بیشترین استفاده شده ها', 'text_domain' ),
		'popular_items'              => __( 'مجموع امکانات', 'text_domain' ),
		'search_items'               => __( 'جستجوی امکانات', 'text_domain' ),
		'not_found'                  => __( 'پیدا نشد', 'text_domain' ),
		'no_terms'                   => __( 'امکانات نیست', 'text_domain' ),
		'items_list'                 => __( 'لیست امکانات', 'text_domain' ),
		'items_list_navigation'      => __( 'لیست امکانات', 'text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'hotel_tools', array( 'hotel' ), $args );
}

add_action( 'init', 'hotel_tools_tax', 0 );
function hotel_loyer_tax() {
	$labels = array(
		'name'                       => _x( 'قوانین', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'قوانین', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'قوانین', 'text_domain' ),
		'all_items'                  => __( 'تمام قوانین', 'text_domain' ),
		'parent_item'                => __( 'مورد مادر', 'text_domain' ),
		'parent_item_colon'          => __( 'مورد مادر:', 'text_domain' ),
		'new_item_name'              => __( ' قوانین جدید', 'text_domain' ),
		'add_new_item'               => __( 'افزودن قوانین جدید', 'text_domain' ),
		'edit_item'                  => __( 'ویرایش قوانین', 'text_domain' ),
		'update_item'                => __( 'بروز رسانی قوانین', 'text_domain' ),
		'view_item'                  => __( 'مشاهده قوانین', 'text_domain' ),
		'separate_items_with_commas' => __( 'قوانین را با کاما جدا کنید', 'text_domain' ),
		'add_or_remove_items'        => __( 'افزودن یا حذف قوانین', 'text_domain' ),
		'choose_from_most_used'      => __( 'انتخاب از بیشترین استفاده شده ها', 'text_domain' ),
		'popular_items'              => __( 'مجموع قوانین', 'text_domain' ),
		'search_items'               => __( 'جستجوی قوانین', 'text_domain' ),
		'not_found'                  => __( 'پیدا نشد', 'text_domain' ),
		'no_terms'                   => __( 'قوانین نیست', 'text_domain' ),
		'items_list'                 => __( 'لیست قوانین', 'text_domain' ),
		'items_list_navigation'      => __( 'لیست قوانین', 'text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'hotel_loyer', array( 'hotel' ), $args );
}

add_action( 'init', 'hotel_loyer_tax', 0 );
function hotel_category_func() {
	$labels = array(
		'name'                       => _x( 'دسته ها', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'دسته', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'دسته', 'text_domain' ),
		'all_items'                  => __( 'تمام موارد', 'text_domain' ),
		'parent_item'                => __( 'مورد مادر', 'text_domain' ),
		'parent_item_colon'          => __( 'مورد مادر:', 'text_domain' ),
		'new_item_name'              => __( ' دسته جدید', 'text_domain' ),
		'add_new_item'               => __( 'افزودن دسته جدید', 'text_domain' ),
		'edit_item'                  => __( 'ویرایش دسته', 'text_domain' ),
		'update_item'                => __( 'بروز رسانی دسته', 'text_domain' ),
		'view_item'                  => __( 'مشاهده دسته', 'text_domain' ),
		'separate_items_with_commas' => __( 'دسته ها را با کاما جدا کنید', 'text_domain' ),
		'add_or_remove_items'        => __( 'افزودن یا حذف دسته', 'text_domain' ),
		'choose_from_most_used'      => __( 'انتخاب از بیشترین استفاده شده ها', 'text_domain' ),
		'popular_items'              => __( 'مجموع دسته ها', 'text_domain' ),
		'search_items'               => __( 'جستجوی دسته', 'text_domain' ),
		'not_found'                  => __( 'پیدا نشد', 'text_domain' ),
		'no_terms'                   => __( 'دسته نیست', 'text_domain' ),
		'items_list'                 => __( 'لیست دسته ها', 'text_domain' ),
		'items_list_navigation'      => __( 'لیست دسته ها', 'text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'hotel_category', array( 'hotel' ), $args );
}

// add_action( 'init', 'hotel_category_func', 0 );
// function hotel_city_taxonomy() {
// 	$labels = array(
// 		'name'                       => _x( 'شهرها', 'Taxonomy General Name', 'text_domain' ),
// 		'singular_name'              => _x( 'شهر', 'Taxonomy Singular Name', 'text_domain' ),
// 		'menu_name'                  => __( 'شهر', 'text_domain' ),
// 		'all_items'                  => __( 'تمام موارد', 'text_domain' ),
// 		'parent_item'                => __( 'مورد مادر', 'text_domain' ),
// 		'parent_item_colon'          => __( 'مورد مادر:', 'text_domain' ),
// 		'new_item_name'              => __( ' شهر جدید', 'text_domain' ),
// 		'add_new_item'               => __( 'افزودن شهر جدید', 'text_domain' ),
// 		'edit_item'                  => __( 'ویرایش شهر', 'text_domain' ),
// 		'update_item'                => __( 'بروز رسانی شهر', 'text_domain' ),
// 		'view_item'                  => __( 'مشاهده شهر', 'text_domain' ),
// 		'separate_items_with_commas' => __( 'شهرها را با کاما جدا کنید', 'text_domain' ),
// 		'add_or_remove_items'        => __( 'افزودن یا حذف شهر', 'text_domain' ),
// 		'choose_from_most_used'      => __( 'انتخاب از بیشترین استفاده شده ها', 'text_domain' ),
// 		'popular_items'              => __( 'مجموع شهر ها', 'text_domain' ),
// 		'search_items'               => __( 'جستجوی شهر', 'text_domain' ),
// 		'not_found'                  => __( 'پیدا نشد', 'text_domain' ),
// 		'no_terms'                   => __( 'شهری نیست', 'text_domain' ),
// 		'items_list'                 => __( 'لیست شهر ها', 'text_domain' ),
// 		'items_list_navigation'      => __( 'لیست شهر ها', 'text_domain' ),
// 	);
// 	$args   = array(
// 		'labels'            => $labels,
// 		'hierarchical'      => true,
// 		'public'            => true,
// 		'show_ui'           => true,
// 		'show_admin_column' => true,
// 		'show_in_nav_menus' => true,
// 		'show_tagcloud'     => true,
// 	);
// 	register_taxonomy( 'city_hotel', array( 'hotel' ), $args );
// }

//add_action( 'init', 'hotel_city_taxonomy', 0 );

add_action( 'init', 'hotel_category_func', 0 );
function admin_hotel_selection_func() {
	$labels = array(
		'name'                       => _x( 'موارد ویژه', 'Taxonomy General Name', 'text_domain' ),
		'singular_name'              => _x( 'مورد ویژه', 'Taxonomy Singular Name', 'text_domain' ),
		'menu_name'                  => __( 'مورد ویژه', 'text_domain' ),
		'all_items'                  => __( 'تمام موارد ویژه', 'text_domain' ),
		'parent_item'                => __( 'مورد ویژه مادر', 'text_domain' ),
		'parent_item_colon'          => __( 'مورد ویژه مادر:', 'text_domain' ),
		'new_item_name'              => __( ' مورد ویژه جدید', 'text_domain' ),
		'add_new_item'               => __( 'افزودن مورد ویژه', 'text_domain' ),
		'edit_item'                  => __( 'ویرایش مورد ویژه', 'text_domain' ),
		'update_item'                => __( 'بروز رسانی مورد ویژه', 'text_domain' ),
		'view_item'                  => __( 'مشاهده مورد ویژه', 'text_domain' ),
		'separate_items_with_commas' => __( 'موارد ویژه را با کاما جدا کنید', 'text_domain' ),
		'add_or_remove_items'        => __( 'افزودن یا مورد ویژه', 'text_domain' ),
		'choose_from_most_used'      => __( 'انتخاب از بیشترین استفاده شده ها', 'text_domain' ),
		'popular_items'              => __( 'مجموع موارد ویژه', 'text_domain' ),
		'search_items'               => __( 'جستجوی مورد ویژه', 'text_domain' ),
		'not_found'                  => __( 'پیدا نشد', 'text_domain' ),
		'no_terms'                   => __( 'مورد ویژه نیست', 'text_domain' ),
		'items_list'                 => __( 'لیست موارد ویژه', 'text_domain' ),
		'items_list_navigation'      => __( 'لیست موارد ویژه', 'text_domain' ),
	);
	$args   = array(
		'labels'            => $labels,
		'hierarchical'      => true,
		'public'            => true,
		'show_ui'           => true,
		'show_admin_column' => true,
		'show_in_nav_menus' => true,
		'show_tagcloud'     => true,
	);
	register_taxonomy( 'admin_hotel_selection', array( 'hotel' ), $args );
}

add_action( 'init', 'admin_hotel_selection_func', 0 );


function hotel_Property_metabox() {
	add_meta_box(
		'hotels_Property',
		'ویژگی ها',
		'hotel_Property_callback',
		'hotel', // Change post type name
		'normal',
		'core'
	);
}

add_action( 'admin_init', 'hotel_Property_metabox' );
function hotel_Property_callback() {
	wp_nonce_field( basename( __FILE__ ), 'hotel_meta_box_nonce' );
	global $post;
	$pid = $post->ID;


	?>

    <div class="room_pbox">
        <div class="room_item_box_pbox">
			<?php

			require get_template_directory() . '/template-parts/room_property.php';
			?>
        </div>

    </div>

<?php }

function hotel_room_add_metabox() {
	add_meta_box(
		'hotels_rooms',
		'اتاق ها',
		'hotel_room_add_metabox_callback',
		'hotel', // Change post type name
		'normal',
		'core'
	);
}

add_action( 'admin_init', 'hotel_room_add_metabox' );
function hotel_room_add_metabox_callback() {
	global $post;
	$pid = $post->ID;


	?>
    <div class="room_pbox">
        <div class="room_item_box_prbox">
			<?php

			require get_template_directory() . '/template-parts/rooms_meta_template.php';
			?>
        </div>
        <div class="room_price_not"><span>با ذخیره سازی قیمت برای 60 روز روی تقویم هتل اعمال میشود</span> </div>

        <div class="savadd_box">
            <span class="add_room " data-pid="<?php echo $pid ?>">افزودن اتاق</span>
            <span class="save_room " data-pid="<?php echo $pid ?>">ذخیره</span>
        </div>
    </div>


<?php }

add_action( "wp_ajax_get_new_room_template", "get_new_room_template_func" );
function get_new_room_template_func() {

	$html = require get_template_directory() . '/template-parts/add_rooms_meta_template.php';
	die( 1 );
	echo json_encode( $html );

}
add_action( "wp_ajax_get_new_hroom_template", "get_new_hroom_template_func" );
function get_new_hroom_template_func() {

	$html = require get_template_directory() . '/template-parts/add_rooms_meta_template.php';
	die( 1 );
	wp_send_json_success( $html);

}

add_action( 'save_post', 'my_save_postdata' );
function my_save_postdata( $postid ) {
	/* check if this is an autosave */
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return false;
	}

	/* check if the user can edit this page */
	if ( ! current_user_can( 'edit_page', $postid ) ) {
		return false;
	}

	/* check if there's a post id and check if this is a post */
	/* make sure this is the same post type as above */
	if ( empty( $postid ) || $_POST['post_type'] != 'residence' ) {
		return false;
	}

	/* if you are going to use text fields, then you should change the part below */
	/* use add_post_meta, update_post_meta and delete_post_meta, to control the stored value */

	/* check if the custom field is submitted (checkboxes that aren't marked, aren't submitted) */
	if ( isset( $_POST['my_featured_post_field'] ) ) {
		/* store the value in the database */
		update_post_meta( $postid, 'my_featured_post_field', $_POST['my_featured_post_field'] );
	} else {
		/* not marked? delete the value in the database */
		delete_post_meta( $postid, 'my_featured_post_field' );
	}
}

function hotel_save_meta_boxes_data( $post_id ) {
	if ( ! isset( $_POST['hotel_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['hotel_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$all_hotel_meta = [];
	if ( isset( $_POST['hotel_type'] ) ) {
		if ( isset( $_POST['hotel_type'] ) ) {
			$type = $_POST['hotel_type'];
		}
		if ( isset( $_POST['hotel_stars'] ) ) {
			$stars = $_POST['hotel_stars'];

		}
		if ( isset( $_POST['hotel_base_price'] ) ) {
			$base_price = $_POST['hotel_base_price'];

		}
		if ( isset( $_POST['in_clock'] ) ) {
			$in_clock = $_POST['in_clock'];

		}
		if ( isset( $_POST['out_clock'] ) ) {
			$out_clock = $_POST['out_clock'];

		}
		if ( isset( $_POST['map_point_lat'] ) ) {
			$map_point_lat = $_POST['map_point_lat'];

		}
		if ( isset( $_POST['map_point_lng'] ) ) {
			$map_point_lng = $_POST['map_point_lng'];

		}
		if ( isset( $_POST['child_bed_need'] ) ) {
			$child_bed_need = $_POST['child_bed_need'];

		}

		if ( isset( $_POST['hotel_phone'] ) ) {
			$hotel_phone = $_POST['hotel_phone'];

		}
		if ( isset( $_POST['hotel_address'] ) ) {
			$hotel_address = $_POST['hotel_address'];

		}
		if ( isset( $_POST['hotelier_name'] ) ) {
			$hotelier_name = $_POST['hotelier_name'];

		}
		if ( isset( $_POST['hotelier_additional'] ) ) {
			$hotelier_additional = $_POST['hotelier_additional'];

		}
		$all_hotel_meta['type']           = sanitize_text_field( $type );
		$all_hotel_meta['stars']          = sanitize_text_field( $stars );
		$all_hotel_meta['base_price']     = sanitize_text_field( $base_price );
		$all_hotel_meta['in_clock']       = sanitize_text_field( $in_clock );
		$all_hotel_meta['out_clock']      = sanitize_text_field( $out_clock );
		$all_hotel_meta['map_point_lat']  = sanitize_text_field( $map_point_lat );
		$all_hotel_meta['map_point_lng']  = sanitize_text_field( $map_point_lng );
		$all_hotel_meta['child_bed_need'] = sanitize_text_field( $child_bed_need );
		$all_hotel_meta['address']        = sanitize_text_field( $hotel_address );
		$all_hotel_meta['hotelier_name']        = sanitize_text_field( $hotelier_name );
		$all_hotel_meta['hotelier_additional']        = sanitize_text_field( $hotelier_additional );
		$all_hotel_meta['phone']        = sanitize_text_field( $hotel_phone );
		$all_hotel_meta['posid']        = sanitize_text_field( $_POST['posid']);
		update_post_meta( $post_id, 'all_hotel_meta', $all_hotel_meta );
		update_post_meta( $post_id, 'codeid', $_POST['posid'] );
	}

}

add_action( 'save_post_hotel', 'hotel_save_meta_boxes_data', 10, 2 );
//add_action( 'wp_ajax_get_rooms_hotel', 'get_rooms_hotel_func' );

function order_room_exist_check( $checkin, $checkout, $hot_id, $room_id, $adult, $child, $user_id, $order_status=null ) {
if ($order_status == null){
	$order_status =4;
}
	global $wpdb;
	$results = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}jayto_hotel_orders WHERE  check_in = '{$checkin}' and check_out = '{$checkout}' and hot_id ={$hot_id}  and room_id = {$room_id} and adult_number = {$adult} and child_number ={$child} and order_status ={$order_status}", ARRAY_A );

	return $results;

}

function insert_hotel_order_table( $checkin, $checkout, $hotel_id, $ro_id, $prices, $adult, $child, $user_id, $order_status,$dicount_price = null  ) {

	global $wpdb;
	$author_id   = get_post_field( 'post_author', $hotel_id );
	$start_timer = time();
	$user        = wp_get_current_user();
	$user_id     = $user->ID;
	$table_name  = $wpdb->prefix . 'jayto_hotel_orders';
	$wpdb->insert( $table_name, array(

		'hot_id'       => $hotel_id,
		'room_id'      => $ro_id,
		'user_id'      => $user_id,
		'author_id'    => $author_id,
		'adult_number' => $adult,
		'child_number' => $child,
		'check_in'     => $checkin,
		'check_out'    => $checkout,
		'start_timer'  => $start_timer,
		'price'        => $prices,
		'order_status' => $order_status,
		'discount_price' => $dicount_price,



	), array(
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',
		'%s',
		'%d',
		'%d',

	) );
}
function insert_hotel_order_table_confirm( $checkin, $checkout, $hotel_id, $ro_id, $prices, $adult, $child, $user_id, $order_status,$discount_price = null ) {

	global $wpdb;
	$author_id   = get_post_field( 'post_author', $hotel_id );
	$start_timer = time();
	$user        = wp_get_current_user();
	$user_id     = $user_id;
	$table_name  = $wpdb->prefix . 'jayto_hotel_orders';
	$wpdb->insert( $table_name, array(

		'hot_id'       => $hotel_id,
		'room_id'      => $ro_id,
		'user_id'      => $user_id,
		'author_id'    => $author_id,
		'adult_number' => $adult,
		'child_number' => $child,
		'check_in'     => $checkin,
		'check_out'    => $checkout,
		'start_timer'  => $start_timer,
		'price'        => $prices,
		'order_status' => $order_status,
		'confirm_status' => 'confirm',
		'discount_price'   => $discount_price,


	), array(
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',
		'%s',
		'%d',
		'%d',
		'%d',
		'%s',
		'%d',


	) );
}

add_action( 'wp_ajax_remove_hotel_reserve_date', 'remove_hotel_reserve_date_func' );
function remove_hotel_reserve_date_func() {
	$res_id       = $_POST['res_id'];
	$dates        = $_POST['date'];
	$oid          = $_POST['oid'];
	$room_id      = $_POST['room_id'];
	$order_status = 5;
	if ( isset( $_POST['cancel'] ) ) {
		if ( $_POST['cancel'] == 1 ) {
			$order_status = 3;
		}

	}
	$all_reserve_date = get_post_meta( $res_id, 'hotel_reserves' . $room_id, true );
	foreach ( $dates as $row ) {

		if ( ( $key = array_search( $row, $all_reserve_date ) ) !== false ) {
			unset( $all_reserve_date[ $key ] );
		}
	}
	update_post_meta( $res_id, 'hotel_reserves' . $room_id, $all_reserve_date );
	update_exist_hotel_order( $oid, $order_status );

}

add_action( 'wp_ajax_hotel_insert_post', 'hotel_insert_post_func' );
function hotel_insert_post_func() {
	$post_title   = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	global $wpdb;
	$post_id = $wpdb->insert_id;
	global $user_ID;
	if ( isset( $_POST['city_terms'] ) ) {
		$city_ids = $_POST['city_terms'];
	}
	if ( isset( $_POST['loyer_terms_ids'] ) ) {
		$loyer_ids = $_POST['loyer_terms_ids'];
	}
	if ( isset( $_POST['tools_terms_ids'] ) ) {
		$tools_ids = $_POST['tools_terms_ids'];
	}
	if ( isset( $_POST['category_terms_ids'] ) ) {
		$category_ids = $_POST['category_terms_ids'];
	}
	$custom_tax = [ 'city' => $city_ids, 'loyer' => $loyer_ids, 'tools' => $tools_ids, 'categories' => $category_ids ];
	$new_post   = array(
		'ID'           => $post_id,
		'post_title'   => $post_title,
		'post_content' => $post_content,
		'post_status'  => 'pending',
		'post_date'    => date( 'Y-m-d H:i:s' ),
		'post_author'  => $user_ID,
		'post_type'    => 'hotel',


	);
	$post_id    = wp_insert_post( $new_post );
	wp_set_post_terms( $post_id, $loyer_ids, 'hotel_loyer' );
	wp_set_post_terms( $post_id, $city_ids, 'city_hotel' );
	wp_set_post_terms( $post_id, $tools_ids, 'hotel_tools' );
	wp_set_post_terms( $post_id, $category_ids, 'hotel_category' );

	if ( isset( $_POST['post_content'] ) ) {
		if ( isset( $_POST['od_tools'] ) ) {
			$odt = $_POST['od_tools'];
		}
		if ( isset( $_POST['od_loyer'] ) ) {
			$odl = $_POST['od_loyer'];
		}
		if ( isset( $_POST['attach_url'] ) ) {
			$image_url = sanitize_text_field( $_POST['attach_url'] );
		}
		if ( isset( $_POST['gallery_urls'] ) ) {
			$gallery_urls = $_POST['gallery_urls'];
		}
		if ( isset( $_POST['reserve_type'] ) ) {
			if ( isset( $_POST['reserve_type'] ) ) {
				$type = $_POST['reserve_type'];
			}
			if ( isset( $_POST['hotel_stars'] ) ) {
				$stars = $_POST['hotel_stars'];

			}

			if ( isset( $_POST['in_clock'] ) ) {
				$in_clock = $_POST['in_clock'];

			}
			if ( isset( $_POST['out_clock'] ) ) {
				$out_clock = $_POST['out_clock'];

			}
			if ( isset( $_POST['map_point_lat'] ) ) {
				$map_point_lat = $_POST['map_point_lat'];

			}
			if ( isset( $_POST['map_point_lng'] ) ) {
				$map_point_lng = $_POST['map_point_lng'];

			}
			if ( isset( $_POST['child_bed_need'] ) ) {
				$child_bed_need = $_POST['child_bed_need'];

			}
			if ( isset( $_POST['hotel_address'] ) ) {
				$hotel_address = $_POST['hotel_address'];

			}

			$all_hotel_meta['type']           = sanitize_text_field( $type );
			$all_hotel_meta['stars']          = sanitize_text_field( $stars );
			$all_hotel_meta['address']        = sanitize_text_field( $hotel_address );
			$all_hotel_meta['in_clock']       = sanitize_text_field( $in_clock );
			$all_hotel_meta['out_clock']      = sanitize_text_field( $out_clock );
			$all_hotel_meta['map_point_lat']  = sanitize_text_field( $map_point_lat );
			$all_hotel_meta['map_point_lng']  = sanitize_text_field( $map_point_lng );
			$all_hotel_meta['child_bed_need'] = sanitize_text_field( $child_bed_need );

			update_post_meta( $post_id, 'all_hotel_meta', $all_hotel_meta );
			update_post_meta( $post_id, 'codeid', $_POST['posid'] );
		}

//        delete_post_meta($post_id,'_all_res_meta');


		if ( $image_url ) {
			$attachment_id = wp_insert_attachment_from_url( $image_url, $post_id );
			set_post_thumbnail( $post_id, $attachment_id );
			$gallery_data = array();
			if ( $gallery_urls ) {
				foreach ( $gallery_urls as $row ) {
					$gallery_data['image_url'][] = $row;
				}

				update_post_meta( $post_id, 'gallery_data', $gallery_data );
			}


		}
	}


}

add_action( 'wp_ajax_hotel_update_post', 'hotel_update_post_func' );
function hotel_update_post_func() {
	$post_title   = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	global $wpdb;
	$post_id = $_POST['post_id'];
	global $user_ID;
	if ( isset( $_POST['city_terms'] ) ) {
		$city_ids = $_POST['city_terms'];
	}
	if ( isset( $_POST['loyer_terms_ids'] ) ) {
		$loyer_ids = $_POST['loyer_terms_ids'];
	}
	if ( isset( $_POST['tools_terms_ids'] ) ) {
		$tools_ids = $_POST['tools_terms_ids'];
	}
	if ( isset( $_POST['category_terms_ids'] ) ) {
		$category_ids = $_POST['category_terms_ids'];
	}
	$custom_tax = [ 'city' => $city_ids, 'loyer' => $loyer_ids, 'tools' => $tools_ids, 'categories' => $category_ids ];
	$new_post   = array(
		'ID'           => $post_id,
		'post_title'   => $post_title,
		'post_content' => $post_content,
		'post_status'  => 'publish',
		'post_date'    => date( 'Y-m-d H:i:s' ),
		'post_author'  => $user_ID,
		'post_type'    => 'hotel',


	);
	$post_id    = wp_update_post( $new_post );
	wp_set_post_terms( $post_id, $loyer_ids, 'hotel_loyer' );
	wp_set_post_terms( $post_id, $city_ids, 'city' );
	wp_set_post_terms( $post_id, $tools_ids, 'hotel_tools' );
	wp_set_post_terms( $post_id, $category_ids, 'hotel_category' );

	if ( isset( $_POST['post_content'] ) ) {
		if ( isset( $_POST['od_tools'] ) ) {
			$odt = $_POST['od_tools'];
		}
		if ( isset( $_POST['od_loyer'] ) ) {
			$odl = $_POST['od_loyer'];
		}
		if ( isset( $_POST['attach_url'] ) ) {
			$image_url = sanitize_text_field( $_POST['attach_url'] );
		}
		if ( isset( $_POST['gallery_urls'] ) ) {
			$gallery_urls = $_POST['gallery_urls'];
		}
		if ( isset( $_POST['reserve_type'] ) ) {
			if ( isset( $_POST['reserve_type'] ) ) {
				$type = $_POST['reserve_type'];
			}
			if ( isset( $_POST['hotel_stars'] ) ) {
				$stars = $_POST['hotel_stars'];

			}

			if ( isset( $_POST['in_clock'] ) ) {
				$in_clock = $_POST['in_clock'];

			}
			if ( isset( $_POST['out_clock'] ) ) {
				$out_clock = $_POST['out_clock'];

			}
			if ( isset( $_POST['map_point_lat'] ) ) {
				$map_point_lat = $_POST['map_point_lat'];

			}
			if ( isset( $_POST['map_point_lng'] ) ) {
				$map_point_lng = $_POST['map_point_lng'];

			}
			if ( isset( $_POST['child_bed_need'] ) ) {
				$child_bed_need = $_POST['child_bed_need'];

			}
			if ( isset( $_POST['hotel_address'] ) ) {
				$hotel_address = $_POST['hotel_address'];

			}

			$all_hotel_meta['type']           = sanitize_text_field( $type );
			$all_hotel_meta['stars']          = sanitize_text_field( $stars );
			$all_hotel_meta['address']        = sanitize_text_field( $hotel_address );
			$all_hotel_meta['in_clock']       = sanitize_text_field( $in_clock );
			$all_hotel_meta['out_clock']      = sanitize_text_field( $out_clock );
			$all_hotel_meta['map_point_lat']  = sanitize_text_field( $map_point_lat );
			$all_hotel_meta['map_point_lng']  = sanitize_text_field( $map_point_lng );
			$all_hotel_meta['child_bed_need'] = sanitize_text_field( $child_bed_need );

			update_post_meta( $post_id, 'all_hotel_meta', $all_hotel_meta );
			update_post_meta( $post_id, 'codeid', $_POST['posid'] );
		}

//        delete_post_meta($post_id,'_all_res_meta');


		if ( $image_url ) {
			$attachment_id = wp_insert_attachment_from_url( $image_url, $post_id );
			set_post_thumbnail( $post_id, $attachment_id );

		}
		if ( $gallery_urls ) {
			$gallery_data = [];
			foreach ( $gallery_urls as $row ) {

				$gallery_data['image_url'][] = $row;
			}

			update_post_meta( $post_id, 'gallery_data', $gallery_data );

		}




		die( 0 );
	}


}
add_action( 'wp_ajax_hhotel_save_rooms', 'hhotel_save_rooms_func' );
function hhotel_save_rooms_func() {
	$pid                    = $_POST['pid'];
	$id_number              = intval( $_POST['room_number'] );
	$room_name              = $_POST['room_name'];
	$bed_count              = $_POST['bed_count'];
	$room_breackfast        = $_POST['room_breackfast'];
	$room_lunch             = $_POST['room_lunch'];
	$room_Dinner            = $_POST['room_Dinner'];
	$room_normal_price      = $_POST['room_normal_price'];
	$room_endWeek_price     = $_POST['room_endWeek_price'];
	$room_child_unsix_price = $_POST['room_child_unsix_price'];
	$room_child_upsix_price = $_POST['room_child_upsix_price'];
	$room_single_bed = $_POST['room_single_bed'];
	$room_Double_bed = $_POST['room_Double_bed'];
	$r_short_desc = $_POST['r_short_desc'];
	$room_tip_number           = $_POST['room_tip_number'];
	$gurls           = $_POST['urls'];

	$info                   = [
		'room_name'              => $room_name,
		'bed_count'              => $bed_count,
		'room_breackfast'        => $room_breackfast,
		'room_lunch'             => $room_lunch,
		'room_Dinner'            => $room_Dinner,
		'room_normal_price'      => $room_normal_price,
		'room_endWeek_price'     => $room_endWeek_price,
		'room_child_unsix_price' => $room_child_unsix_price,
		'room_child_upsix_price' => $room_child_upsix_price,
		'room_single_bed' => $room_single_bed,
		'room_Double_bed' => $room_Double_bed,
		'r_short_desc' => $r_short_desc,
		'room_tip_number'           => $room_tip_number,
		'urls'           => $gurls,

	];
	$hotel_room             = [];
	$hotel_room_old         = get_post_meta( $pid, 'rooms_info', true );


	if ( $hotel_room_old ) {
		$hotel_room = $hotel_room_old;
	}
	$hotel_room[ $id_number ] = $info;
	update_post_meta( $pid, 'rooms_info', $hotel_room );
	$today          = date( 'Y/m/d' );
	$date_new       = strtotime( '+60 days', strtotime( $today ) );
	$date_sixteen   = date( 'Y/m/d', $date_new );
	$exptoday       = explode( '/', $today );
	$expsixteen     = explode( '/', $date_sixteen );
	$per_today      = gregorian_to_jalali( $exptoday[0], $exptoday[1], $exptoday[2], '/' );
	$seex_per_days  = gregorian_to_jalali( $expsixteen[0], $expsixteen[1], $expsixteen[2], '/' );
	$calender       = get_beetween_date( $per_today, $seex_per_days );
	$calender_price = [];
	$hot_day_price  = 'hot_day_price' . $id_number;
	$custom_price   = get_post_meta( $pid, $hot_day_price, true );

	foreach ( $calender as $row ) {
		$date_exp = explode( '-', $row );
		$ts       = jmktime( '0', '0', '0', $date_exp[1], $date_exp[2], $date_exp[0] );
		$end_week = jstrftime( '%a', $ts );
		if ( array_key_exists( $row, $custom_price ) ) {
			$calender_price[ $row ] = $custom_price[ $row ];
		} else {
			if ( $end_week == 'چ' || $end_week == 'پ' || $end_week == 'ج' ) {
				$calender_price[ $row ] = $room_endWeek_price;
			} else {
				$calender_price[ $row ] = $room_normal_price;
			}
		}
	}
	$hotel_calender = 'hotel_calender' . $id_number;
	$sum_night      = 'hotel_calender' . $id_number;
	update_post_meta( $pid, $hotel_calender, $calender_price );

}




add_action( 'wp_ajax_get_single_hotel_search_link', 'get_single_hotel_search_link_func' );
add_action( 'wp_ajax_nopriv_get_single_hotel_search_link', 'get_single_hotel_search_link_func' );
function get_single_hotel_search_link_func() {
	$args         = array(

		'post_type'      => 'hotel',
		'posts_per_page' => '1',
		'post_status'    => 'publish'
	);
	$oneposts      = get_posts( $args );
 $permalink= get_the_permalink($oneposts[0]->ID);
 echo $permalink;
   die(0);
}
