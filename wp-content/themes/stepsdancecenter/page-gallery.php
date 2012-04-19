<?php 
/*
Template Name: Gallery
*/
get_header(); 
the_post();
?>

<h1><?php the_title(); ?></h1>
<div class="gallery">
  <div class="gallery-nav">
    <ul>
      <?php 
      $cats = get_terms(array('gallery_category'));
      usort($cats, 'steps_sort_gallery_categories');
      foreach ($cats as $key => $cat): ?>
        <li class="nav-<?php echo $cat->slug; ?> <?php echo ($key == 0) ? 'current' : ''; ?>"><a href="#"><span><?php echo $cat->name; ?></span></a></li>
      <?php endforeach ?>
    </ul>
    <span class="hover">&nbsp;</span>
  </div>
  <?php foreach ($cats as $key => $c): ?>
    <div class="slider-tab <?php echo ($key == 0) ? 'active-tab' : ''; ?> <?php echo $c->slug; ?>-tab">
      <?php query_posts('post_type=gallery&posts_per_page=-1&orderby=menu_order&order=ASC&gallery_category=' . $c->slug); ?>
      <div class="main-slider">
        <ul>
          <?php while(have_posts()): 
            the_post(); 
            if ($c->slug == 'video'): 
              $url = get_meta('_gallery_video_url');
              if (!$url) {
                continue;
              }
              ?>
              <li>
                <?php echo create_embedcode($url, 750, 485); ?>
              </li>
            <?php else: 
              if (!has_post_thumbnail()) {
                continue;
              }
              ?>
              <li>
                <?php the_post_thumbnail('gallery_large'); ?>
                <div class="caption">
                  <h5><?php the_title(); ?></h5>
                  <?php the_content(); ?>
                </div>
              </li>
            <?php endif ?>
          <?php endwhile; ?>
        </ul>
      </div>
      <div class="thumbs-slider">
        <ul>
          <?php while(have_posts()): 
            the_post(); 
            if ($c->slug == 'video') {
              $url = get_meta('_gallery_video_url');
              if (!$url) {
                continue;
              }
              $img = get_video_thumb(create_embedcode($url));
            } else {
              if (!has_post_thumbnail()) {
                continue;
              }
              $img = false;
            }
            ?>
            <li title="<?php the_title_attribute(); ?>">
              <span class="mask">&nbsp;</span>
              <?php if ($img): ?>
                <img src="<?php echo $img; ?>" width="48" height="48" alt="" />
              <?php else: ?>
                <?php the_post_thumbnail('gallery_small'); ?>
              <?php endif ?>
            </li>
          <?php endwhile; ?>
        </ul>
      </div>
    </div>
    <?php wp_reset_query(); ?>
  <?php endforeach ?>
  <?php get_sidebar(); ?>
</div>

<!-- End of Main -->
<?php get_sidebar('bottom'); ?>
<?php get_footer(); ?>
