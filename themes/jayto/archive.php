<?php
/**
 * The template for displaying archive pages
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package jayto
 */

get_header('archive');

$mypost = get_page_by_title('archive', OBJECT, 'page' );

$page_id = $mypost->ID;

$frontend = new \Elementor\Frontend();
echo $frontend->get_builder_content_for_display( $page_id, true );

get_footer();
