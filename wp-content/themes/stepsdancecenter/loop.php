<?php if(have_posts()): while(have_posts()): the_post(); endwhile; endif; ?>
<?php wp_reset_query(); ?>

<?php if(is_page('Faculty')): 
  $clean_title = urlencode(str_replace(array('*', '  '), array('', ' '), get_the_title()));
  $beautiful_title_pieces = explode('*', get_the_title());
  foreach ($beautiful_title_pieces as &$piece) {
    $piece = '<span>' . trim($piece) . '</span>';
  }
  $beautiful_title = implode('<br />', $beautiful_title_pieces);
endif; ?>


<div id="content">
<?php if (have_posts()) : ?>
	<?php while (have_posts()) : the_post(); ?>
		<article>
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('post_large', array('class' => 'wide-img')) ?>
			<?php endif ?>
      <?php if( get_post_type() == 'page' ): ?>
        <h1><?php the_title(); ?></h1>
			  <div class="entry"><?php the_content(); ?></div>
      <?php endif; ?>

			<?php if (get_post_type() == 'post'): ?>
				<p class="right info"><span class="the-month"><?php the_time('M'); ?></span><span class="the-day"><?php the_time('d'); ?></p>
        <h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
			  <div class="news-excerpt entry"><?php the_excerpt(); ?></div>
			<?php endif ?>

		</article>
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
</div>
