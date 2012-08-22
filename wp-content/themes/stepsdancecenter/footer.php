    <footer>
      <div class="center">
        <div class="right">
          <a class="left" style="margin-right: 15px;" href="http://twitter.com/#/stepsdancectr" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/twitter.png" alt="twitter"></a>
          <a class="left" href="http://facebook.com/stepsdancecenter" target="_blank"><img src="<?php bloginfo('template_directory'); ?>/images/facebook.png" alt="facebook"></a>

          <div class="clear"></div>

          <small>
            Design By: 
            <a href="http://thomasgbennett.com" title="Nashville Web Design - Thomas Bennett" target="_Blank" style="margin-top: 10px;display: inline-block;">
              <img src="<?php bloginfo('template_directory'); ?>/images/thomas-bennett-nashville-web-design.png" alt="Nashville Web Design - Thomas Bennett" />
            </a>
          </small>
        </div>

        <nav>
          <?php wp_nav_menu('menu=footer&fallback_cb=&container='); ?>
        </nav>
        <br />
        <p class="copyright">Copyright &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. All Rights Reserved.</p>
      </div>

      <div class="clear"></div>
    </footer>

    <?php wp_footer(); ?>
	</body>
</html>
