<?php


get_header('empty');

$mypost = get_page_by_title('404', OBJECT, 'page' );

$page_id = $mypost->ID;

$frontend = new \Elementor\Frontend();
echo $frontend->get_builder_content_for_display( $page_id, true );

get_footer('empty');
