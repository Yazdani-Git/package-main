<?php

/* Template Name:cat template */

get_header( 'category' );

//print_r($obj);
$get = $_GET;

//print_r($get);
if ( key_exists( 'elementor-preview', $get ) ) {
	the_content();
}

$mypost = get_page_by_title( 'category', OBJECT, 'page' );

$page_id = $mypost->ID;

$frontend = new \Elementor\Frontend();
echo $frontend->get_builder_content_for_display( $page_id, true );


get_footer();
