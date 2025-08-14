<script src=<?php echo get_template_directory_uri() ?>/js/veu.js></script>
<script src="https://cdn.jsdelivr.net/npm/moment"></script>
<script src="https://cdn.jsdelivr.net/npm/moment-jalaali@0.9.2/build/moment-jalaali.js"></script>
<script src=<?php echo get_template_directory_uri() ?>'/js/v-datetime.js'></script>
<?php
$args = array(
	'post_type'  => 'hotel',
	'posts_per_page' => '-1',
);
$hotele = get_posts( $args );
//print_r($residance)

?>
<div class="dis_item">
	<table class="width_100">

		<tbody>
		<?php
		foreach ($hotele as $row){
		$image_url = get_the_post_thumbnail_url( $row->ID, 'thumbnail' );
//		$meta = get_post_meta($row->ID,'rooms_info',true);

		//print_r($discount)
		?>

		<tr>
			<td>
				<div class="dis_img">
					<img src="<?php echo $image_url ?>">
				</div>
			</td>
			<td>
				<div class="red_dname">
					<span><?php echo  $row->post_title ?></span>
				</div>
			</td>
			<td>

				<span class="hvroom" data-hid="<?php echo $row->ID  ?>">مشاهده اتاق ها</span>

			</td>


		</tr>
</div>



<?php   }
?>
</tbody>
</table>
<div class="hrvroom_box"><div class="aot_box width_100">
		<span class="alert_box_close"><i class="dashicons dashicons-no-alt"></i></span>
		<div class="aop_rw">
			<p>اتاق های هتل تست</p>

		</div>



	</div></div>
</div>


