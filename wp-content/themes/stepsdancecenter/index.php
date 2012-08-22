<?php get_header(); ?>

<div class="center" <?php if(!is_front_page()): ?>style="margin-top: 195px;"<?php endif; ?>>
  <aside>
    <?php get_sidebar(); ?>
  </aside>

  <?php get_template_part('loop'); ?>
</div>

<?php get_footer(); ?>
