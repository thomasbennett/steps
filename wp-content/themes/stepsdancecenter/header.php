<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head>
  <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
  <title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
  <link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
  <link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
  <script src="<?php bloginfo('template_directory') ?>/js/modernizr-1.7.min.js"></script>
  <?php wp_head(); ?>
  <!--[if lte IE 8]>
  <![endif]-->
</head>

<body>
<header>
  <?php if(is_front_page()): ?>
    <div id="header-bg"></div>
  <?php else: ?>
    <div class="inner-header"></div>
  <?php endif; ?>

  <div class="center">
    <?php if(is_home()): ?>
      <a href="<?php echo home_url('/'); ?>"><h1 id="logo"><?php bloginfo('name'); ?></h1></a>
    <?php else: ?>
      <a href="<?php echo home_url('/'); ?>"><h3 id="logo"><?php bloginfo('name'); ?></h3></a>
    <?php endif; ?>

    <nav>
      <?php wp_nav_menu('menu=primary&fallback_cb=&container='); ?>
    </nav>
  </div>

  <?php if(is_front_page()): 
  // don't close it
  // instead, close after the slideshow
  else: ?>
</header>
  <?php endif; ?>
