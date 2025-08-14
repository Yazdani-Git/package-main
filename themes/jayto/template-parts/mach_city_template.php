<?php


$sta_title = $sta[0]->name;
if ( $sta_title == '' ) {
	$sta_title = 'مرتبط';
}
?>

<?php
if ( is_numeric( $city ) ) {

	$posts = get_posts( array(
		'numberposts' => - 1,
		'post_type'   => array( 'residence', 'tour', 'hotel' ),
		'meta_query'  => array(
			array(
				'key'     => 'codeid',
				'value'   => $city,
				'compare' => 'LIKE'
			)
		)

	) );

	foreach ( $posts as $row ) { ?>
        <p><span class="sres_icon_box codinp data-post="<?php echo $row->ID ?>"" ><i class="fa-thin fa-house-window"></i></span><?php echo $row->name ?><span class="width100 codinp" data-post="<?php echo $row->ID ?>"><?php echo $row->post_title ?></span></p>
		<?php wp_die();
	}
} else {
	if ( sizeof( $sub_state ) != 0 ) { ?>
        <div class="related_city">

            <div class="related_city_state_title"> دیگر شهر های<span>   <?php echo $sta_title; ?></span></div>

            <ul>
				<?php
				foreach ( $sub_state as $row ) { ?>
                    <li data-city="<?php echo $row->name; ?>" data-slug="<?php echo $row->slug ?>"><span class="sres_icon_box"><i class="fa-thin fa-house-window"></i></span><?php echo $row->name ?></li>
				<?php }
				?>
            </ul>
			<?php
			$args = array(
				'post_type' => array( 'residence', 'tour', 'hotel' ),
				's'         => $city,
				'orderby'   => 'title',
				'order'     => 'ASC',

			);

			$myposts = get_posts( $args );


			if ( $myposts ) {
				echo '<ul class="line_h30 text-r">';
				foreach ( $myposts as $item ) { ?>
                    <li class="codinp cupoint fz13  mbt10" data-post="<?php echo $item->ID ?> "><span class="sres_icon_box"><i class="fa-thin fa-house-window"></i></span> <?php echo $item->post_title ?></li>

				<?php }
				echo '</ul>';
			}
			?>
        </div>
	<?php } else {
		$args = array(
			'post_type' => array( 'residence', 'tour', 'hotel' ),
			's'         => $city,
			'orderby'   => 'title',
			'order'     => 'ASC',

		);

		$myposts = get_posts( $args );


		if ( $myposts ) {
			echo '<ul class="line_h30 text-r padd20">';
			foreach ( $myposts as $item ) { ?>
                <li class="codinp cupoint fz13  mbt10" data-post="<?php echo $item->ID ?> "><span class="sres_icon_box"><i class="fa-thin fa-house-window"></i></span> <?php echo $item->post_title ?></li>

			<?php }
			echo '</ul>';
		}
		?>


	<?php }
	wp_die();
}


