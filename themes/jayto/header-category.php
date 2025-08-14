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




	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<?php


?>

<div id="page_head" class="site">

	<header id="masthead" class="site-header_single">
		<?php
ob_start();
		$header = get_page_by_title('هدردسته بندی', OBJECT, 'elementor_library');
		$page_id  = $header->ID;
		$frontend = new Frontend();
		echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $page_id,true );

		?>
	</header><!-- #masthead -->
