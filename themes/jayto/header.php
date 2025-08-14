<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jayto
 */

use Elementor\Frontend;

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
	<script src="<?php echo get_template_directory_uri()   ?>/js/veu.js"></script>
    <script src="<?php echo get_template_directory_uri()   ?>/js/v-datetime.js"></script>
	
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>


<div id="page" class="site">
	<?php
	$header_type = get_option( 'change_search_fsh' );
	?>


    <header id="masthead" class="site-header">
		<?php
		if ( ! wp_is_mobile() ) {
			if ( $header_type == 0 ) {
				$header = get_page_by_title( 'هدر اصلی', OBJECT, 'elementor_library' );

			}elseif ($header_type == 1 ){
				$header = get_page_by_title( 'هدر هتل تک', OBJECT, 'elementor_library' );
            }

		} else {
			if ( $header_type == 0 ) {
				$header = get_page_by_title( 'هدر موبایل', OBJECT, 'elementor_library' );

			}elseif ($header_type == 1 ){
				$header = get_page_by_title( 'هدر هتل تک موبایل', OBJECT, 'elementor_library' );
			}

		}

		$page_id  = $header->ID;
		$frontend = new Frontend();
		echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $page_id, 'true' );

		?>
    </header><!-- #masthead -->
