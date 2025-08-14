<?php
/* Template Name:Single Post */

get_header('category');

$get =$_GET;
if (key_exists('elementor-preview',$get)){
	the_content();
}
ob_start();
$mypost = get_page_by_title('post', OBJECT, 'page' );
$page_id = $mypost->ID;
$frontend = new \Elementor\Frontend();
echo $frontend->get_builder_content_for_display( $page_id, true );
get_footer();
