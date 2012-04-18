<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<div class="blog-article">
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('post_large', array('class' => 'wide-img')) ?>
			<?php endif ?>
			<h4><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h4>

			<?php if (get_post_type() == 'post'): ?>
				<p class="info"><em>By</em>: <strong><?php the_author_posts_link(); ?></strong><span>|</span> <strong><?php the_time('M d, Y h:i a') ?></strong></p>
			<?php endif ?>

			<?php the_excerpt(); ?>
			<a href="<?php the_permalink(); ?>" class="more">Read More<span class="arr">&nbsp;</span></a>

			<div class="blog-foot">
				<?php steps_share_icons_large(get_permalink(), get_the_title()); ?>
				<?php the_tags('<p class="tags">Tags: ', ', ', '</p>'); ?>
			</div>
		</div>
	<?php endwhile; ?>

	<?php if (  $wp_query->max_num_pages > 1 && function_exists('wp_pagenavi') ) : ?>
		<div class="pagination">
			<?php wp_pagenavi(); ?>
		</div>
	<?php endif; ?>
	
<?php else : ?>
	<div class="blog-article">
		<h4>Not Found</h4>
		
		<div class="entry">
			<?php  
			if ( is_category() ) { // If this is a category archive
				printf("<p>Sorry, but there aren't any posts in the %s category yet.</p>", single_cat_title('',false));
			} else if ( is_date() ) { // If this is a date archive
				echo("<p>Sorry, but there aren't any posts with this date.</p>");
			} else if ( is_author() ) { // If this is a category archive
				$userdata = get_userdatabylogin(get_query_var('author_name'));
				printf("<p>Sorry, but there aren't any posts by %s yet.</p>", $userdata->display_name);
			} else if ( is_search() ) {
				echo("<p>No posts found. Try a different search?</p>");
			} else {
				echo("<p>No posts found.</p>");
			}
			get_search_form(); 
			?>
		</div>
	</div>
<?php endif; ?>
