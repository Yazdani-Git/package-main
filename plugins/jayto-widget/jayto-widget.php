<?php
/**
 * Plugin Name:       jayto Plugin
 * Description:       .ویجت های اختصاصی برای قالب جایتو . این پلاگین مخصوص قالب جایتو طراحی شده
 * Version:           2.6.3
 * Requires PHP:      7.4
 * Author:           IranCode
 * License:           GPL v2 or later
 * Text Domain:       jayto-Plugin
 */


if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
$my_theme = wp_get_theme();
if ( $my_theme != 'jayto' ) {
	exit();
}


final class Jayto_WIDGET {
	const VERSION = '1.0.0';
	const MINIMUM_ELEMENTOR_VERSION = '3.1.0';
	const MINIMUM_PHP_VERSION = '7.4';
	private static $_instance = null;

	public static function instance() {
		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;
	}

	public function __construct() {


		$this->define_constants();
		$this->init();
		add_action( 'wp_enqueue_scripts', [ $this, 'register_script' ] );
		add_action( 'init', [ $this, 'i18n' ] );
	}

	public function define_constants() {
		define( 'JAYTO_PLUGIN_URL', trailingslashit( plugins_url( '/', __FILE__ ) ) );
		define( 'JAYTO_PLUGIN_PATH', trailingslashit( plugin_dir_path( __FILE__ ) ) );
	}

	public function register_script() {
		wp_register_style( 'jayto_style', JAYTO_PLUGIN_URL . 'assets/source/css/public.css', [], rand(), 'all' );
		wp_register_script( 'jayto_plscript', JAYTO_PLUGIN_URL . 'assets/source/js/public.js', '', rand(), true );
		wp_register_script( 'swiper_js', JAYTO_PLUGIN_URL . 'assets/source/js/swiper-bundle.js', '', rand(), false );
	
		wp_register_script( 'dtp', JAYTO_PLUGIN_URL . 'assets/source/js/dtp.js', '', rand(), false );
		wp_enqueue_script( 'jayto_plscript' );
		wp_enqueue_script( 'swiper_js' );
		wp_enqueue_script( 'swiper_css' );
		wp_enqueue_script( 'dtp' );
		wp_enqueue_script( 'jayto_style' );

		wp_localize_script( 'jayto_plscript', 'aaj_vars', [
			'ajax_url' => admin_url( 'admin-ajax.php' ),

		] );
	}


	public function i18n() {
		load_plugin_textdomain( 'jayto-Plugin', false, dirname( plugin_basename( __FILE__ ) ) . '/langueges' );
	}

	function wpb_widgets_init() {

		register_sidebar( array(
			'name'          => __( 'main-sidebar', 'wpb' ),
			'id'            => 'sidebar-1',
			'description'   => __( 'استفاده از ابزارک توسط در این ناحیه امکانپذیر میباشد', 'wpb' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget'  => '</aside>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>',
		) );


	}

	public function init() {
		add_action( 'elementor/init', [ $this, 'init_category' ] );
//		add_action( 'elementor/init', [ $this, 'init_widgets' ] );
		add_action( 'elementor/widgets/register', [ $this, 'init_widgets' ] );
		add_action( 'widgets_init', [ $this, 'wpb_widgets_init' ] );


	}

	public function init_widgets() {

		require_once JAYTO_PLUGIN_PATH . '/widgets/site_logo.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_residence_title.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/login_button.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/user_favorite.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/search_box.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/search_box_mobile.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/single_hotel_search.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/category.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/hotel_category.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/hotel_query_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/hotel_reserve_request.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/tour_query_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/favorite_dist_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/favorite_dist_hotel_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/query_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/residence_images.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/the_host_description.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/submits_reserve_request.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/tour_reserve_request.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/accommodation_rules.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_archive_post.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/residence_filter.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/add_favorites.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_res_price.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/mobile_navigation.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/mobile_account.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/categories_banner.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/contact_support.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/back_to.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_map.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_link.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/header_menu.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/tile_blog.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_last_post.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_post_title.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_post_author.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_post_image.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_post_content.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_selected_post.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/cat_name.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_cat_posts.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/image_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/the_hotel_description.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/the_tour_descriiption.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/hotel_accommodation_rules.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/tour_reserve_form.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/tour_reserve_info.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_all_tour.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/user_comments.php';
//		require_once JAYTO_PLUGIN_PATH . '/widgets/line_menu.php';
//		require_once JAYTO_PLUGIN_PATH . '/widgets/breadcrumb_widget.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/image_slide.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/get_residence_mobile_title.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/jayto_category_desc.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/discount_slider.php';
		require_once JAYTO_PLUGIN_PATH . '/widgets/post_slider_new.php';
//		require_once JAYTO_PLUGIN_PATH . '/widgets/tour_category.php';







	}

	public function init_category() {

		\Elementor\Plugin::instance()->elements_manager->add_category( 'jayto', [ 'title' => 'ویجت های جایتو' ] );

	}
}

Jayto_WIDGET::instance();
