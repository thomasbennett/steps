<?php get_header(); ?>
<h1><?php steps_blog_title(); ?></h1>
<?php if (have_posts()) : ?>
  <?php while (have_posts()) : the_post(); ?>
    <div class="blog-article">
      <?php if (has_post_thumbnail()): ?>
        <?php the_post_thumbnail('post_large', array('class' => 'wide-img')) ?>
      <?php endif ?>
      <h4><?php the_title(); ?></h4>
      <p class="info"><em>By</em>: <strong><?php the_author_posts_link(); ?></strong><span>|</span> <strong><?php the_time('M d, Y h:i a') ?></strong></p>
      <?php the_content(); ?>
      <div class="blog-foot">
        <?php steps_share_icons_large(get_permalink(), get_the_title()); ?>
        <?php the_tags('<p class="tags">Tags: ', ', ', '</p>'); ?>
      </div>
    </div>
  <?php endwhile; ?>
<?php endif; ?>

<?php $post_type = get_post_type(); ?>

<?php get_sidebar(); ?>

<?php get_footer(); ?>
