<script>
    jQuery('.archive_box').css({'display':'grid'})
</script>
<div class="archive_post_item">

	<a href="<?php echo get_the_permalink( $row->ID ) ?>">
		<img src="<?php echo $image[0] ?>" alt="<?php echo $row->post_title ?>">
		<span class="fz13 col_gray2 mt_10 mr5"><?php echo $row->post_title ?></span>
		<div class="tspans">
			<span class="add_info fz10 fw300 col_gray mr5"> <?php echo $terms_string ?>  </span>
			<span class="dot_span_less fa fa-circle"></span>
            <?php
            if ($meta[0]['total_capacity']){?>
                <span class="add_info fz10 fw300 col_gray mr5"> <?php echo $meta[0]['total_capacity'] ?> نفر ظرفیت   </span>
            <?php }
            ?>

		</div>
		<?php
		if ( $meta[0]['off_price'] != '' ){?>
			<div class="mbt10">
				<span class="archive_discount fz10 fw300  fw400"><?php echo _e('تا 10 درصد تخفیف','jayto') ?>
</span>
			</div>

		<?php }else{?>
			<div class="mbt10"> <a href="<?php echo get_the_permalink($row->ID)?>" class="archive_view_pack fz10 fw300 col_gray2 fw400"><?php echo _e('مشاهده قیمت و پکیج های قابل رزرو :','jayto') ?></a></div>
		<?php	}
		?>
		<span class=" fz10 fw400 col_gray2 mr5 mbt10 mr5"><?php echo _e('شروع قیمت :','jayto') ?> <span class="fz12 fw700">&nbsp;<?php echo number_format( $pri ) ?>&nbsp;<?php echo _e('تومان','jayto') ?>
</span> / <span class="col_gray"><?php echo _e('هر شب','jayto') ?></span></span>
	</a>
</div>
