<?php
ob_start();
get_header('single');


$mypost = get_page_by_title('single_hotel', OBJECT, 'page' );

$page_id = $mypost->ID;

$frontend = new \Elementor\Frontend();

echo Elementor\Plugin::instance()->frontend->get_builder_content_for_display( $page_id,true);

get_footer();
