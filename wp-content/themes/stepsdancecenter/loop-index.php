<?php if (have_posts()) : ?>
  <div id="content">
	<?php while (have_posts()) : the_post(); ?>
    <section>
			<?php if (has_post_thumbnail()): ?>
				<?php the_post_thumbnail('post_large', array('class' => 'wide-img')) ?>
			<?php endif ?>
			<h2><?php the_title(); ?></h2>

			<div class="entry">
        <?php the_content(); ?>
      </div>
		</section>
	<?php endwhile; ?>
  </div>
<?php endif; ?>
