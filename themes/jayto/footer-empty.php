<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package jayto
 */
$footer   = get_page_by_title( 'فوترخام', OBJECT, 'elementor_library' );
$page_id  = $footer->ID;
$frontend = new \Elementor\Frontend();
?>

<footer id="colophon" class="site-footer">
	<!--		--><?php
	echo $frontend->get_builder_content_for_display( $page_id, true );
	//		?>

</footer>
<div id="login_box">
	<?php
	require 'template-parts/register_template.php'
	?>
	<div id="dark_box"></div>
	<div id="alert_box">
		<span class="alert_box_close"><i class="fa fa-close"></i></span>
	</div>
</div>

<?php wp_footer(); ?>

</body>
</html>
