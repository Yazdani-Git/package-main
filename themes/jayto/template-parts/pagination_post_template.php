<?php
			foreach ( $page_array[$page_number - 1] as $post ) {
				$image_url = get_the_post_thumbnail_url($post->ID, 'full');
				?>
				<div class="lp_item">
					<div class="lpitem_img">
						<img src="<?php echo $image_url ?>" alt="image">
					</div>
					<div class="lpitem_desc">
						<h2>
							<?php echo $post->post_title?>
						</h2>
                        <p><?php echo get_the_excerpt($post->ID) ?></p>
                        <a class="post_read_more" href="<?php echo get_the_permalink($post->ID)?>">بیشتر بخوانید</a>
					</div>


				</div>

			<?php }
			?>