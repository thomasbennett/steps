<?php 
get_header(); 
the_post();
?>

<?php 
if(have_posts()):
  while(have_posts()):
    the_post();
?>

<article>
  <h1><?php the_content(); ?></h1>
  <div class="entry"><?php the_content(); ?></div> 
</article>

<?php 
  endwhile;
endif; 
?>

<?php get_footer(); ?>
