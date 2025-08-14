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
    <link rel="stylesheet" href="<?php echo get_template_directory_uri()   ?>/css/veu.jsleaflet.css"  />
    <script src="<?php echo get_template_directory_uri()   ?>/js/veu.js"></script>
    <script src="<?php echo get_template_directory_uri()   ?>/js/v-datetime.js"></script>
    <script src="<?php echo get_template_directory_uri()   ?>/js/moment.js"></script>
    <script src="<?php echo get_template_directory_uri()   ?>/js/moment-jalali.js"></script>
    <script src="<?php echo get_template_directory_uri()   ?>/js/leaflet.js"></script>
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php


?>
<div id="page-archive" class="site">

	<header id="masthead" class="site-header_archive">
		<?php

		$header = get_page_by_title('هدرخام', OBJECT, 'elementor_library');
		$page_id  = $header->ID;
		$frontend = new Frontend();
		echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $page_id,'true' );

		?>
	</header><!-- #masthead -->
