<?php 
/*
Template Name: Home
*/
get_header(); 
?>
<div id="slideshow" class="full-center">
	<ul>
		<?php 
		$count = 0;
		query_posts('post_type=home_slide&posts_per_page=-1&orderby=menu_order&order=ASC'); 
		while(have_posts()): 
			the_post();
			$count++;
			$bg = get_meta('_home_slide_bg');
			$img = get_meta('_home_slide_img');
			?>
			<li>
				<?php if ($bg): ?>
					<img src="<?php echo ecf_get_image_url($bg); ?>" alt="" />
				<?php endif ?>
				<div class="center">
					<?php if ($img): ?>
						<img src="<?php echo ecf_get_image_url($img); ?>" class="slp" alt="" />
					<?php endif ?>
				</div>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
</div>

<?php // this is found in header.php and only closes here on this page ?>
</header>

<div id="callout-container" class="center">
  <article class="callout">
    <h2 class="events-icon">Upcoming Events</h2>
    <?php query_posts('post_type=post&posts_per_page=1'); ?>
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <h3><?php the_title(); ?></h3>
      <div class="entry"><?php the_excerpt(); ?></div>
    <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>
  </article>

  <article class="callout spotlight">
    <?php query_posts('pagename=homepage-callout'); ?> 
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <h2 class="add-icon"><?php the_title(); ?></h2>
      <div class="entry"><?php the_excerpt(); ?></div>
      <?php $cta = get_meta('_home_spotlight_button'); ?>
      <?php $cta_link = get_meta('_home_spotlight_link'); ?>
      <?php if ($cta): ?>
        <a class="cta" href="<?php echo $cta_link ?>"><?php echo $cta; ?></a>
      <?php endif; ?>
    <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>
  </article>

  <article class="callout">
    <h2 class="news-icon">The Latest News</h2>
    <?php query_posts('post_type=tribe_events&posts_per_page=1'); ?> 
    <?php if(have_posts()): while(have_posts()): the_post(); ?>
      <h3><?php the_title(); ?></h3>
      <div class="entry"><?php the_excerpt(); ?></div>
    <?php endwhile; endif; ?>
    <?php wp_reset_query(); ?>
  </article>
  
  <div class="clear"></div>
</div>

<div class="center">
  <aside>
    <?php get_sidebar(); ?>
  </aside>

  <?php get_template_part('loop', 'index'); ?>
</div>

<?php get_footer(); ?>
