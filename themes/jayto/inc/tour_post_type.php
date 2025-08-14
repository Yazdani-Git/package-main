<?php
$sms_info = get_option( 'sms_enter_info' );
add_action( 'admin_menu', 'jayto_tour_request' );
function jayto_tour_request() {
	add_menu_page( 'درخواست رزرو تور', 'درخواست رزرو تور', 'manage_options', 'jayto_tour_request_page', 'jayto_tour_request_page_callback', 'dashicons-warning', '3' );
}

function jayto_tour_request_page_callback() {
	require get_template_directory() . '/template-parts/admin_tour_request.php';

}

function tour_post_type() {
	$labels = array(
		'name'                  => _x( 'تور', 'Post Type General Name', 'text_domain' ),
		'singular_name'         => _x( 'تور', 'Post Type Singular Name', 'text_domain' ),
		'menu_name'             => __( 'تور', 'text_domain' ),
		'name_admin_bar'        => __( 'تور', 'text_domain' ),
		'archives'              => __( 'Item Archives', 'text_domain' ),
		'attributes'            => __( 'Item Attributes', 'text_domain' ),
		'parent_item_colon'     => __( 'مادر:', 'text_domain' ),
		'all_items'             => __( 'تمام تور ها', 'text_domain' ),
		'add_new_item'          => __( 'افزودن تور جدید', 'text_domain' ),
		'add_new'               => __( 'افزودن جدید', 'text_domain' ),
		'new_item'              => __( 'تور جدید', 'text_domain' ),
		'edit_item'             => __( 'ویرایش تور', 'text_domain' ),
		'update_item'           => __( 'بروز رسانی تور', 'text_domain' ),
		'view_item'             => __( 'مشاهده تور', 'text_domain' ),
		'view_items'            => __( 'مشاهده تور ها', 'text_domain' ),
		'search_items'          => __( 'جستجوی تور', 'text_domain' ),
		'not_found'             => __( 'پیدا نشد', 'text_domain' ),
		'not_found_in_trash'    => __( 'در سطل زباله پیدا نشد', 'text_domain' ),
		'featured_image'        => __( 'تصویر تور', 'text_domain' ),
		'set_featured_image'    => __( 'درج تصویر تور', 'text_domain' ),
		'remove_featured_image' => __( 'حذف تصویر تور', 'text_domain' ),
		'use_featured_image'    => __( 'استفاده تصویر تور', 'text_domain' ),
		'insert_into_item'      => __( 'Insert into item', 'text_domain' ),
		'uploaded_to_this_item' => __( 'بروزرسانی این مورد', 'text_domain' ),
		'items_list'            => __( 'لیست تور ها', 'text_domain' ),
		'items_list_navigation' => __( 'لیست تور ها', 'text_domain' ),
		'filter_items_list'     => __( 'فیلتر لیست', 'text_domain' ),
	);
	$args   = array(
		'label'                     => __( 'tour', 'تور' ),
		'description'               => __( 'درج و ویرایش تور ها', 'text_domain' ),
		'labels'                    => $labels,
		'supports'                  => array( 'title', 'editor', 'custom-fields', 'page-attributes', 'author', 'thumbnail', 'comments', 'gallery' ),
		'taxonomies'                => array( 'post_tag' ),
		'hierarchical'              => true,
		'public'                    => true,
		'show_ui'                   => true,
		'show_in_menu'              => true,
		'menu_position'             => 4,
		'show_in_admin_bar'         => true,
		'show_in_nav_menus'         => true,
		'can_export'                => true,
		'has_archive'               => true,
		'exclude_from_search'       => false,
		'publicly_queryable'        => true,
		'capability_type'           => 'page',
		'show_in_admin_status_list' => true,
		'menu_icon'                 => 'dashicons-palmtree',
	);
	register_post_type( 'tour', $args );
}

add_action( 'init', 'tour_post_type', 0 );
function tour_category_func() {
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
	register_taxonomy( 'tour_category', array( 'tour' ), $args );
}

//add_action( 'pre_get_posts', 'add_custom_post_types_to_query' );
add_action( 'init', 'tour_category_func', 0 );
function tour_Property_metabox() {
	add_meta_box(
		'tour_Property',
		'ویژگی ها',
		'tour_Property_callback',
		'tour', // Change post type name
		'normal',
		'core'
	);
}

add_action( 'admin_init', 'tour_Property_metabox' );
function tour_Property_callback() {
	wp_nonce_field( basename( __FILE__ ), 'tour_meta_box_nonce' );
	global $post;
	$pid = $post->ID;


	?>

    <div class="room_pbox">
        <script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
        <script src="https://cdn.jsdelivr.net/npm/moment"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
        <script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
        <div class="room_item_box_pbox">
			<?php

			require get_template_directory() . '/template-parts/tour_property.php';
			?>
        </div>

    </div>

<?php }

function tour_save_meta_boxes_data( $post_id ) {
	if ( ! isset( $_POST['tour_meta_box_nonce'] ) || ! wp_verify_nonce( $_POST['tour_meta_box_nonce'], basename( __FILE__ ) ) ) {
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	if ( ! current_user_can( 'edit_post', $post_id ) ) {
		return;
	}
	$all_tour_meta = [];
	if ( isset( $_POST['tour_place_opt'] ) ) {

		$tour_place_opt = $_POST['tour_place_opt'];

		if ( isset( $_POST['Physical_challenge'] ) ) {
			$Physical_challenge = $_POST['Physical_challenge'];
		}
		if ( isset( $_POST['age_need'] ) ) {
			$age_need = $_POST['age_need'];
		}
		if ( isset( $_POST['about_me'] ) ) {
			$about_me = $_POST['about_me'];
		}
		if ( isset( $_POST['tour_time'] ) ) {
			$tour_time = $_POST['tour_time'];
		}
		if ( isset( $_POST['tour_capacity'] ) ) {
			$tour_capacity = $_POST['tour_capacity'];
		}
		if ( isset( $_POST['necessary_supplies'] ) ) {
			$necessary_supplies = $_POST['necessary_supplies'];
		}
		if ( isset( $_POST['proposal_supplies'] ) ) {
			$proposal_supplies = $_POST['proposal_supplies'];
		}
		if ( isset( $_POST['text_before'] ) ) {
			$text_before = $_POST['text_before'];
		}
		if ( isset( $_POST['map_point_lat'] ) ) {
			$map_point_lat = $_POST['map_point_lat'];
		}
		if ( isset( $_POST['map_point_lng'] ) ) {
			$map_point_lng = $_POST['map_point_lng'];
		}
		if ( isset( $_POST['tour_address'] ) ) {
			$tour_address = $_POST['tour_address'];
		}
		if ( isset( $_POST['tour_price'] ) ) {
			$tour_price = $_POST['tour_price'];
		}
		if ( isset( $_POST['tour_shutter_price'] ) ) {
			$tour_shutter_price = $_POST['tour_shutter_price'];
		}

		$all_tour_meta['tour_place_opt']     = sanitize_text_field( $tour_place_opt );
		$all_tour_meta['Physical_challenge'] = sanitize_text_field( $Physical_challenge );
		$all_tour_meta['age_need']           = sanitize_text_field( $age_need );
		$all_tour_meta['tour_time']          = sanitize_text_field( $tour_time );
		$all_tour_meta['tour_capacity']      = sanitize_text_field( $tour_capacity );
		$all_tour_meta['necessary_supplies'] = sanitize_text_field( $necessary_supplies );
		$all_tour_meta['proposal_supplies']  = sanitize_text_field( $proposal_supplies );
		$all_tour_meta['text_before']        = sanitize_text_field( $text_before );
		$all_tour_meta['map_point_lat']      = sanitize_text_field( $map_point_lat );
		$all_tour_meta['map_point_lng']      = sanitize_text_field( $map_point_lng );
		$all_tour_meta['tour_address']       = sanitize_text_field( $tour_address );
		$all_tour_meta['tour_price']         = sanitize_text_field( $tour_price );
		$all_tour_meta['tour_shutter_price']         = sanitize_text_field( $tour_shutter_price );
		$all_tour_meta['about_me']           = sanitize_text_field( $about_me );

		update_post_meta( $post_id, 'all_tour_meta', $all_tour_meta );
	}

}

add_action( 'save_post_tour', 'tour_save_meta_boxes_data', 10, 2 );

function tour_tools_tax() {
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
	register_taxonomy( 'tour_tools', array( 'tour' ), $args );
}

add_action( 'init', 'tour_tools_tax', 0 );
function admin_tour_selection_func() {
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
	register_taxonomy( 'admin_tour_selection', array( 'tour' ), $args );
}

add_action( 'init', 'admin_tour_selection_func', 0 );
function tour_gallery_add_metabox() {
	add_meta_box(
		'tour_custom_gallery',
		'گالری تصاویر',
		'tour_gallery_metabox_callback',
		'tour', // Change post type name
		'normal',
		'core'
	);
}

add_action( 'admin_init', 'tour_gallery_add_metabox' );
function tour_gallery_metabox_callback() {
	wp_nonce_field( basename( __FILE__ ), 'sample_nonce' );
	global $post;
	$gallery_data = get_post_meta( $post->ID, 'gallery_data', true );


	?>
    <div id="gallery_wrapper">
        <div id="img_box_container">
			<?php
			if ( isset( $gallery_data['image_url'] ) ){
			for ( $i = 0;
			$i < count( $gallery_data['image_url'] );
			$i ++ ){
			?>
            <div class="gallery_single_row dolu">
                <div class="gallery_area image_container ">
                    <img class="gallery_img_img" src="<?php esc_html_e( $gallery_data['image_url'][ $i ] ); ?>" height="55" width="55" onclick="open_media_uploader_image_this(this)"/>
                    <input type="hidden"
                           class="meta_image_url"
                           name="gallery[image_url][]"
                           value="<?php esc_html_e( $gallery_data['image_url'][ $i ] ); ?>"
                    />
                </div>
                <div class="gallery_area">
                    <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
                </div>
                <div class="clear"/>
            </div>
        </div>
		<?php
		}
		}
		?>
    </div>
    <div style="display:none" id="master_box">
        <div class="gallery_single_row">
            <div class="gallery_area image_container" onclick="open_media_uploader_image(this)">
                <input class="meta_image_url" value="" type="hidden" name="gallery[image_url][]"/>
            </div>
            <div class="gallery_area">
                <span class="button remove" onclick="remove_img(this)" title="Remove"/><i class="fas fa-trash-alt"></i></span>
            </div>
            <div class="clear"></div>
        </div>
    </div>
    <div id="add_gallery_single_row">
        <input class="button add" type="button" value="+" onclick="open_media_uploader_image_plus();" title="Add image"/>
    </div>
    </div>
	<?php
}

function tour_Sans_add_metabox() {
	add_meta_box(
		'tour_sans',
		'سانس ها',
		'tour_Sans_add_metabox_callback',
		'tour', // Change post type name
		'normal',
		'core'
	);
}

add_action( 'admin_init', 'tour_Sans_add_metabox' );
function tour_Sans_add_metabox_callback() {
	global $post;
	$pid  = $post->ID;
	$sans = get_post_meta( $pid, 'tour_sans', true );


	?>
    <div class="room_pbox">
        <div class="view_avsans">
			<?php
			$time_now = jdate( 'Y-m-d', time(), '', '', 'en' );
			foreach ( $sans as $key => $row ) {
				if ( $key >= $time_now ) { ?>
                    <div class="sans_item">

                        <p class="sidate " data-piind="<?php echo get_the_ID() ?>"> <?php echo $key ?></span></p>
                        <div class="siitmd">
							<?php
							foreach ( $row as $k => $item ) {

								?>
                                <span class="sitime"><?php echo $k ?> - رزرو شده :  <?php echo $item['reserve'] ?>&nbsp; &nbsp;نفر  <span class="dashicons dashicons-trash del_sans" data-time="<?php echo $k ?>"></span>
							<?php }
							?>
                        </div>
                    </div>
				<?php }
				?>

			<?php }
			?>

        </div>
        <div class="room_item_box_prbox ">
            <p>
            <div class="added_aj_sans d_flex"></div>
            <div id="each_day_price d_flex ">
                <label class="mr5 mbt10">افزودن سانس </label>

                <div class="sans_box">
                    <input type="text" value="" class="sans" autocomplete="off">
                    <date-picker value="" type="datetime" display-format="jYYYY-jMM-jDD/HH:mm" format="jYYYY-jMM-jDD" custom-input=".sans"></date-picker>

                    <span class="add_sans_submit">ذخیره</span>
                </div>
            </div>
            </p>
            <p>
        </div>

        <script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
        <script src="https://cdn.jsdelivr.net/npm/moment"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
        <script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>   <script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
        <script src="https://cdn.jsdelivr.net/npm/moment"></script>
        <script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
        <script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
        <script>
            let app55 = new Vue({
                el: '.sans_box',
                data: {
                    dates: '',
                },
                components: {
                    DatePicker: VuePersianDatetimePicker
                }
            });
            jQuery('.add_sans_submit').on('click', function (e) {
                let sans = jQuery('.sans').val()
                jQuery.ajax({
                    url: "<?php echo admin_url( 'admin-ajax.php' ); ?>",
                    type: "POST",
                    data: {action: "set_sans", 'sans': sans, 'pid': <?php echo $pid ?>  },
                    beforeSend: function () {
                        jQuery('.add_sans_submit').text('درحال ذخیره سازی')
                    },
                    success: function (f) {
                        let result = jQuery.parseJSON(f)
                        let data = result.split('/')

                        jQuery('.added_aj_sans').append('<div class="sans_item d_flex alignc flex_row"><span class="sidate">' + data[0] + '</span>=> <div class="siitmd"><span class="sitime">' + data[1] + ' </span> </div></div>')
                        jQuery('.add_sans_submit').text('ذخیره')
                        sans.val('')
                    }
                })
            })
        </script>
    </div>
<?php }
function handle_setsanse() {
	// دریافت مقادیر ارسالی از درخواست AJAX
	$postData = $_POST['postData'];
	$user_id = get_current_user_id();

	// به‌روزرسانی meta کاربر
	delete_user_meta($user_id, 'sans_session');
	update_user_meta($user_id, 'sans_session', $postData);
	$dd=get_user_meta($user_id, 'sans_session');
	header('Content-Type: application/json');
    echo json_encode($dd);

	wp_die(); // پایان دادن به AJAX
}
add_action('wp_ajax_ssans_set', 'handle_setsanse');
function get_tour_sans( $tour_id ) {
	$sans = get_post_meta( $tour_id, 'tour_sans', true );

	return $sans;
}

function change_date_month_word( $time ) {
	$date_exp   = explode( '-', $time );
	$time_stamp = jmktime( 0, 0, 0, $date_exp[1], $date_exp[2], $date_exp[0], '', '' );
	$ndate      = jdate( 'd F Y', $time_stamp, '', '', 'en' );

	return $ndate;
}

add_action( 'wp_ajax_set_tour_session', 'set_tour_session_func' );
function set_tour_session_func() {
	$info     = $_POST['data'];
	$info_exp = explode( '~', $info );
	$uid      = get_current_user_id();
	$data     = [ 'tid' => $info_exp[0], 'date' => $info_exp[1], 'sans' => $info_exp[2] ];
	delete_user_meta( $uid, 'sans_session' );
	update_user_meta( $uid, 'sans_session', $data );

	die( 0 );

}

add_action( 'wp_ajax_get_add_tour_exp_template', 'get_add_tour_exp_template_func' );
function get_add_tour_exp_template_func() {
	$tour_id = $_POST['tour_id'];
	$html    = require get_template_directory() . '/template-parts/add_tour_exp_template.php';
	die( 0 );
	echo $html;


}

add_action( 'wp_ajax_add_tour_variable', 'add_tour_variable_func' );
function add_tour_variable_func() {
	$tour_id = $_POST['tour_id'];
	$name    = $_POST['name'];
	$base    = $_POST['base'];
	$price   = $_POST['price'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'tour_variable';

	$wpdb->insert( $table_name, array(
		'tid'   => $tour_id,
		'title' => $name,
		'base'  => $base,
		'price' => $price,
	), array(
		'%d',
		'%s',
		'%d',
		'%d',


	) );
	$lastid = $wpdb->insert_id;
	$data   = [ 'tid' => $tour_id, 'title' => $name, 'base' => $base, 'price' => $price, 'lid' => $lastid ];
	echo json_encode( $data );
	die( 0 );


}

add_action( 'wp_ajax_remove_tour_variable', 'remove_tour_variable_func' );
function remove_tour_variable_func() {
	$tour_id = $_POST['id'];

	global $wpdb;
	$table = $wpdb->prefix . 'tour_variable';
	$wpdb->delete( $table, array( 'id' => $tour_id ) );
	die( 0 );


}
add_action( 'wp_ajax_get_var_price', 'get_var_price_func' );
function get_var_price_func() {
	$var_id = $_POST['data'];

	global $wpdb;

	$results = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}tour_variable WHERE  id = {$var_id} ", ARRAY_A );

	echo $results['price'];

die(0);


}
add_action( 'wp_ajax_update_tour_variable', 'update_tour_variable_func' );
function update_tour_variable_func() {
	$id    = $_POST['id'];
	$name  = $_POST['name'];
	$price = $_POST['price'];
	$base  = $_POST['base'];

	global $wpdb;
	$table_name = $wpdb->prefix . 'tour_variable';
	$wpdb->update( $table_name, array(

		'title' => $name,
		'base'  => $base,
		'price' => $price,


	), array( 'id' => $id ), array(
		'%s',
		'%d',
		'%d',

	), array( '%d' ) );
	die( 0 );


}

add_action( 'wp_ajax_set_tour_session_exclusive', 'set_tour_session_exclusive_func' );
function set_tour_session_exclusive_func() {
	$info = $_POST['data'];

	$uid  = get_current_user_id();
	$data = [ 'tid' => $info ];
	delete_user_meta( $uid, 'sans_session' );
	update_user_meta( $uid, 'sans_session', $data );

	die( 0 );

}

add_action( "wp_ajax_tour_send_order_save", "tour_send_order_save_func" );
function tour_send_order_save_func() {
	$uid                = $_POST['uid'];
	$tour_id            = $_POST['tour_id'];
	$request_date       = $_POST['date_request'];
	$request_type       = $_POST['request_type'];
	$tour_date          = $_POST['tour_date'];
	$sans               = $_POST['sans'];
	$people_number      = $_POST['people_number'];
	$order_status       = $_POST['order_ststus'];
	$price              = $_POST['price'];
	$pay_status         = $_POST['pay_status'];
	$passenger_phone    = $_POST['passenger_phone'];
	$passenger_name     = $_POST['passenger_name'];
	$passenger_lastname = $_POST['passenger_lastname'];
	$varid = $_POST['varid'];
	global $wpdb;
	$table_name = $wpdb->prefix . 'tour_reserve_request';
	$wpdb->insert( $table_name, array(
		'user_id'          => $uid,
		'tour_id'          => $tour_id,
		'request_date'     => $request_date,
		'request_type'     => $request_type,
		'tour_date'        => $tour_date,
		'sans'             => $sans,
		'pepole_number'    => $people_number,
		'order_status'     => $order_status,
		'price'            => $price,
		'pay_status'       => $pay_status,
		'passenger_phone'  => $passenger_phone,
		'passenger_name'   => $passenger_name,
		'passenger_famili' => $passenger_lastname,
		'var_id' => $varid,
	), array(
		'%d',
		'%d',
		'%s',
		'%s',
		'%s',
		'%s',
		'%d',
		'%d',
		'%d',
		'%d',
		'%s',
		'%s',
		'%s',
		'%d',

	) );
   $tour_name = get_the_title($tour_id);
	$smstrta     = ' '.$tour_name.';'.$tour_date.' ';
	if (sms_hotel_reserve_to_admin){
		send_sms_func( $smstrta, sms_adm_tour_request, modir_phone );
	}
}

function get_user_experience_trips( $user_role ) {
	$user    = wp_get_current_user();
	$user_id = $user->ID;
	global $wpdb;

	$hot_results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}tour_reserve_request WHERE  user_id={$user_id} ORDER BY id DESC ", object );
	foreach ( $hot_results as $row ) {
		$obj         = new stdClass();
		$obj->res_id = $row->tour_id;
//		$obj->author_id        = $row->author_id;
		$obj->user_id          = $row->user_id;
		$obj->start_timer      = $row->start_timer;
		$obj->order_status     = $row->order_status;
		$obj->price            = $row->price;
		$obj->host_share       = $row->host_share;
		$obj->tour_date        = $row->tour_date;
		$obj->request_type     = $row->request_type;
		$obj->pay_status       = $row->pay_status;
		$obj->passenger_phone  = $row->passenger_phone;
		$obj->passenger_name   = $row->passenger_name;
		$obj->passenger_famili = $row->passenger_famili;
		$obj->sans             = $row->sans;
		$obj->id               = $row->id;
		$obj->passenger_number = $row->pepole_number;
		$obj->var_id = $row->var_id;



		$results[] = $obj;
	}

	return $results;
}

function get_experiens_by_id( $oid ) {
	global $wpdb;
	$results = $wpdb->get_row( "SELECT * FROM {$wpdb->prefix}tour_reserve_request WHERE  id = {$oid} ", ARRAY_A );

	return $results;
}

add_action( 'wp_ajax_change_tur_status', 'change_tur_status_func' );
function change_tur_status_func() {
	$order_status = $_POST['os'];
	$order_id     = $_POST['oi'];
	$start_timer  = '';
	if ( $order_status == 2 ) {
		$start_timer = time();
	}
	global $wpdb;

	$tour_results = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}tour_reserve_request WHERE  id={$order_id} ORDER BY id DESC ", object );
	$table_name = $wpdb->prefix . 'tour_reserve_request';
	$wpdb->update( $table_name, array(
		'order_status' => $order_status,
		'start_timer'  => $start_timer,


	), array( 'id' => $order_id ), array(
		'%d',
		'%d',

	), array( '%d' ) );
	if (sms_adm_tour_accept && $order_status==2){
		send_sms_func($tour_results->id, sms_adm_tour_accept, $tour_results->passenger_phone );
	}
	die( 0 );

}


add_action( 'wp_ajax_custom_insert_tour', 'custom_insert_tour_func' );
function custom_insert_tour_func() {
	$post_title   = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	global $wpdb;
	$post_id = $wpdb->insert_id;
	global $user_ID;
	if ( isset( $_POST['city_terms'] ) ) {
		$city_ids = $_POST['city_terms'];
	}
	if ( isset( $_POST['region_terms_ids'] ) ) {
		$region_ids = $_POST['region_terms_ids'];
	}
	if ( isset( $_POST['tools_terms_ids'] ) ) {
		$tools_ids = $_POST['tools_terms_ids'];
	}
	if ( isset( $_POST['category_terms_ids'] ) ) {
		$category_ids = $_POST['category_terms_ids'];
	}
//	$custom_tax = [ 'city' => $city_ids, 'region' => $region_ids, 'tools' => $tools_ids, 'categories' => $category_ids ];
	$new_post = array(
		'ID'           => $post_id,
		'post_title'   => $post_title,
		'post_content' => $post_content,
		'post_status'  => 'pending',
		'post_date'    => date( 'Y-m-d H:i:s' ),
		'post_author'  => $user_ID,
		'post_type'    => 'tour',


	);
	$post_id  = wp_insert_post( $new_post );
	wp_set_post_terms( $post_id, $region_ids, 'region' );
	wp_set_post_terms( $post_id, $city_ids, 'city' );
	wp_set_post_terms( $post_id, $tools_ids, 'tour_tools' );
	wp_set_post_terms( $post_id, $category_ids, 'tour_category' );

	if ( isset( $_POST['post_title'] ) ) {

		if ( isset( $_POST['attach_url'] ) ) {
			$image_url = sanitize_text_field( $_POST['attach_url'] );
		}
		if ( isset( $_POST['gallery_urls'] ) ) {
			$gallery_urls = $_POST['gallery_urls'];
		}
		$all_tour_meta = [];
		if ( isset( $_POST['tour_place_opt'] ) ) {

			$tour_place_opt = $_POST['tour_place_opt'];

			if ( isset( $_POST['Physical_challenge'] ) ) {
				$Physical_challenge = $_POST['Physical_challenge'];
			}
			if ( isset( $_POST['age_need'] ) ) {
				$age_need = $_POST['age_need'];
			}
			if ( isset( $_POST['tour_time'] ) ) {
				$tour_time = $_POST['tour_time'];
			}
			if ( isset( $_POST['tour_capacity'] ) ) {
				$tour_capacity = $_POST['tour_capacity'];
			}
			if ( isset( $_POST['necessary_supplies'] ) ) {
				$necessary_supplies = $_POST['necessary_supplies'];
			}
			if ( isset( $_POST['proposal_supplies'] ) ) {
				$proposal_supplies = $_POST['proposal_supplies'];
			}
			if ( isset( $_POST['text_before'] ) ) {
				$text_before = $_POST['text_before'];
			}
			if ( isset( $_POST['map_point_lat'] ) ) {
				$map_point_lat = $_POST['map_point_lat'];
			}
			if ( isset( $_POST['map_point_lng'] ) ) {
				$map_point_lng = $_POST['map_point_lng'];
			}
			if ( isset( $_POST['tour_address'] ) ) {
				$tour_address = $_POST['tour_address'];
			}
			if ( isset( $_POST['tour_price'] ) ) {
				$tour_price = $_POST['tour_price'];
			}
			if ( isset( $_POST['tour_shutter_price'] ) ) {
				$tour_shutter_price = $_POST['tour_shutter_price'];
			}
			if ( isset( $_POST['necessary_supplies'] ) ) {
				$necessary_supplies = $_POST['necessary_supplies'];
			}
			if ( isset( $_POST['proposal_supplies'] ) ) {
				$proposal_supplies = $_POST['proposal_supplies'];
			}
			if ( isset( $_POST['text_before'] ) ) {
				$text_before = $_POST['text_before'];
			}
			$all_tour_meta['tour_place_opt']     = sanitize_text_field( $tour_place_opt );
			$all_tour_meta['Physical_challenge'] = sanitize_text_field( $Physical_challenge );
			$all_tour_meta['age_need']           = sanitize_text_field( $age_need );
			$all_tour_meta['tour_time']          = sanitize_text_field( $tour_time );
			$all_tour_meta['tour_capacity']      = sanitize_text_field( $tour_capacity );
			$all_tour_meta['map_point_lat']      = sanitize_text_field( $map_point_lat );
			$all_tour_meta['map_point_lng']      = sanitize_text_field( $map_point_lng );
			$all_tour_meta['tour_address']       = sanitize_text_field( $tour_address );
			$all_tour_meta['tour_price']         = sanitize_text_field( $tour_price );
			$all_tour_meta['tour_shutter_price']         = sanitize_text_field( $tour_shutter_price );
			$all_tour_meta['necessary_supplies'] = sanitize_text_field( $necessary_supplies );
			$all_tour_meta['proposal_supplies']  = sanitize_text_field( $proposal_supplies );
			$all_tour_meta['text_before']        = sanitize_text_field( $text_before );

			update_post_meta( $post_id, 'all_tour_meta', $all_tour_meta );
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
}

add_action( 'wp_ajax_custom_update_tour', 'custom_update_tour_func' );
function custom_update_tour_func() {
	$post_title   = $_POST['post_title'];
	$post_content = $_POST['post_content'];
	$poid         = $_POST['postId'];
	global $user_ID;
	if ( isset( $_POST['city_terms'] ) ) {
		$city_ids = $_POST['city_terms'];
	}
	if ( isset( $_POST['region_terms_ids'] ) ) {
		$region_ids = $_POST['region_terms_ids'];
	}
	if ( isset( $_POST['tools_terms_ids'] ) ) {
		$tools_ids = $_POST['tools_terms_ids'];
	}
	if ( isset( $_POST['category_terms_ids'] ) ) {
		$category_ids = $_POST['category_terms_ids'];
	}
	if ( isset( $_POST['tour_shutter_price'] ) ) {
		$tour_shutter_price = $_POST['tour_shutter_price'];
	}
//	$custom_tax = [ 'city' => $city_ids, 'region' => $region_ids, 'tools' => $tools_ids, 'categories' => $category_ids ];
	$new_post = array(
		'ID'           => $poid,
		'post_title'   => $post_title,
		'post_content' => $post_content,


	);
	$post_id  = wp_update_post( $new_post );
	wp_set_post_terms( $post_id, $region_ids, 'region' );
	wp_set_post_terms( $post_id, $city_ids, 'city' );
	wp_set_post_terms( $post_id, $tools_ids, 'tour_tools' );
	wp_set_post_terms( $post_id, $category_ids, 'tour_category' );

	if ( isset( $_POST['post_title'] ) ) {

		if ( isset( $_POST['attach_url'] ) ) {
			$image_url = sanitize_text_field( $_POST['attach_url'] );
		}
		if ( isset( $_POST['gallery_urls'] ) ) {
			$gallery_urls = $_POST['gallery_urls'];
		}
		$all_tour_meta = [];
		if ( isset( $_POST['tour_place_opt'] ) ) {

			$tour_place_opt = $_POST['tour_place_opt'];

			if ( isset( $_POST['Physical_challenge'] ) ) {
				$Physical_challenge = $_POST['Physical_challenge'];
			}
			if ( isset( $_POST['age_need'] ) ) {
				$age_need = $_POST['age_need'];
			}
			if ( isset( $_POST['about_me'] ) ) {
				$about_me = $_POST['about_me'];
			}
			if ( isset( $_POST['tour_time'] ) ) {
				$tour_time = $_POST['tour_time'];
			}
			if ( isset( $_POST['tour_capacity'] ) ) {
				$tour_capacity = $_POST['tour_capacity'];
			}
			if ( isset( $_POST['necessary_supplies'] ) ) {
				$necessary_supplies = $_POST['necessary_supplies'];
			}
			if ( isset( $_POST['proposal_supplies'] ) ) {
				$proposal_supplies = $_POST['proposal_supplies'];
			}
			if ( isset( $_POST['text_before'] ) ) {
				$text_before = $_POST['text_before'];
			}
			if ( isset( $_POST['map_point_lat'] ) ) {
				$map_point_lat = $_POST['map_point_lat'];
			}
			if ( isset( $_POST['map_point_lng'] ) ) {
				$map_point_lng = $_POST['map_point_lng'];
			}
			if ( isset( $_POST['tour_address'] ) ) {
				$tour_address = $_POST['tour_address'];
			}
			if ( isset( $_POST['tour_price'] ) ) {
				$tour_price = $_POST['tour_price'];
			}
			if ( isset( $_POST['necessary_supplies'] ) ) {
				$necessary_supplies = $_POST['necessary_supplies'];
			}
			if ( isset( $_POST['proposal_supplies'] ) ) {
				$proposal_supplies = $_POST['proposal_supplies'];
			}
			if ( isset( $_POST['text_before'] ) ) {
				$text_before = $_POST['text_before'];
			}
			if ( isset( $_POST['gallery_urls'] ) ) {
				$gallery_urls = $_POST['gallery_urls'];
			}

			$all_tour_meta['tour_place_opt']     = sanitize_text_field( $tour_place_opt );
			$all_tour_meta['Physical_challenge'] = sanitize_text_field( $Physical_challenge );
			$all_tour_meta['age_need']           = sanitize_text_field( $age_need );
			$all_tour_meta['tour_time']          = sanitize_text_field( $tour_time );
			$all_tour_meta['tour_capacity']      = sanitize_text_field( $tour_capacity );
			$all_tour_meta['map_point_lat']      = sanitize_text_field( $map_point_lat );
			$all_tour_meta['map_point_lng']      = sanitize_text_field( $map_point_lng );
			$all_tour_meta['tour_address']       = sanitize_text_field( $tour_address );
			$all_tour_meta['tour_price']         = sanitize_text_field( $tour_price );
			$all_tour_meta['tour_shutter_price']         = sanitize_text_field( $tour_shutter_price );
			$all_tour_meta['necessary_supplies'] = sanitize_text_field( $necessary_supplies );
			$all_tour_meta['proposal_supplies']  = sanitize_text_field( $proposal_supplies );
			$all_tour_meta['about_me']           = sanitize_text_field( $about_me );
			$all_tour_meta['text_before']        = sanitize_text_field( $text_before );


			update_post_meta( $post_id, 'all_tour_meta', $all_tour_meta );
//        delete_post_meta($post_id,'_all_res_meta');

			if ( $image_url ) {
				$attachment_id = wp_insert_attachment_from_url( $image_url, $post_id );
				set_post_thumbnail( $post_id, $attachment_id );
				$gallery_data = array();
				if ( $gallery_urls ) {
					foreach ( $gallery_urls as $row ) {
						$gallery_data['image_url'][] = $row;
					}

					update_post_meta( $poid, 'gallery_data', $gallery_data );
				}


			}
		}


	}
}

function get_tour_var_by_tour_id( $tour_id ) {
	global $wpdb;

	$var = $wpdb->get_results( "SELECT * FROM {$wpdb->prefix}tour_variable WHERE  tid={$tour_id} ORDER BY id DESC ", object );

	return $var;
}
add_action( 'wp_ajax_del_sans_h', 'del_sans_h_func' );
function del_sans_h_func() {
	$date     = $_POST['date'];
	$pid      = $_POST['pid'];
	$time      = $_POST['time'];
	$sizof = '';
	$old_sanse = get_post_meta( $pid, 'tour_sans', true );
	$fsans =$old_sanse[$date];

	$reserved=$fsans[$time]['reserve'];
	if ($reserved == 0){
		unset($old_sanse[$date][$time]);
		if (sizeof($old_sanse[$date ]) == 0 ){
			unset($old_sanse[$date]);
			$sizof = 'zero';
		}
		update_post_meta( $pid, 'tour_sans', $old_sanse );
	}

	echo $sizof;
//    echo json_encode($reserved);
	die(0);
}