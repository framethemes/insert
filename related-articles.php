// Select posts in the same categories as the current post.
if ( !class_exists( 'related_post_category' ) ):
add_action( 'genesis_entry_footer', 'related_post_category', 21 );
function related_post_category() {
	if ( is_single ( ) ) {
		// Get a list of the current post's categories
		global $post;
		$categories = get_the_category($post->ID);
		if ($categories) {
			$category_ids = array();
			foreach($categories as $individual_category) $category_ids[] = $individual_category->term_id;
	 
			$args=array(
				'category__in' => $category_ids,
				'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
				'posts_per_page' => 3, // Number of related posts to display
				'orderby' => 'rand', // Randomize the results
			);
			$my_query = new wp_query($args);
			if( $my_query->have_posts() ): $i = 0; ?>
				<div class="related-posts-container"><div class="related-posts-title-block"><h3 class="related-posts-title"><?php _e( 'Related Articles', 'longviet' );?></h3></div>
					<div class="related-posts-inner"><ul class="related-posts-blook">
					<?php while ($my_query->have_posts()):$my_query->the_post();  ?>
						<li class="related-posts-<?php echo $i; ?>">
							<div class="related-posts-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail('medium'); ?></a>
								<span class="entry-time"><?php echo esc_html( get_the_date() ) ?></span></div>
							<div class="item-details">
								<h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							</div>
						</li> <?php $i ++; ?>
					<?php endwhile;  ?>
				<?php else : ?>
				<p><?php _e( 'Sorry, no related articles to display', 'longviet' );?></p>
				</ul></div></div>
			<?php endif; 
			wp_reset_postdata(); // Reset postdata
		}
		// Get a list of the current post's tags.
		$tags = wp_get_post_tags($post->ID);
		if ($tags) {
			$tag_ids = array();
			foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
			$args=array(
				'tag__in' => $tag_ids,
				'post__not_in' => array($post->ID), // Ensure that the current post is not displayed
				'posts_per_page' => 3, // Number of related posts to display
				'orderby' => 'rand', // Randomize the results
			);
			$my_query = new wp_query($args);
			if( $my_query->have_posts() ): $i = 0; ?>
				<div class="related-posts-container"><div class="related-posts-title-block"><h3 class="related-posts-title"><?php _e( 'Related Articles', 'longviet' );?></h3></div>
					<div class="related-posts-inner"><ul class="related-posts-blook">
					<?php while ($my_query->have_posts()):$my_query->the_post();  ?>
						<li class="related-posts-<?php echo $i; ?>">
							<div class="related-posts-img"><a href="<?php the_permalink(); ?>"><?php the_post_thumbnail(array(235, 160)); ?></a>
								<span class="entry-time"><?php echo esc_html( get_the_date() ) ?></span></div>
							<div class="item-details">
								<h4 class="entry-title"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h4>
							</div>
						</li> <?php $i ++; ?>
					<?php endwhile;  ?>
				<?php else : ?>
				<p><?php _e( 'Sorry, no related articles to display', 'longviet' );?></p>
				</ul></div></div>
			<?php endif; 
			wp_reset_postdata(); // Reset postdata
		}
	}
}
endif;
