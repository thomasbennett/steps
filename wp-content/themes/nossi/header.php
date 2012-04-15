<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" <?php language_attributes(); ?>>
<head profile="http://gmpg.org/xfn/11">
<meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>" />
<title><?php wp_title('&laquo;', true, 'right'); ?> <?php bloginfo('name'); ?></title>
<link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>" type="text/css" media="screen" />
<link href='http://fonts.googleapis.com/css?family=Oswald' rel='stylesheet' type='text/css' />
<link rel="shortcut icon" href="<?php bloginfo('stylesheet_directory'); ?>/images/favicon.ico" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
<?php if ( is_singular() ) wp_enqueue_script( 'comment-reply' ); ?>
<?php wp_head(); ?>
<!--[if lte IE 8]>
	<style type="text/css" media="screen">
		#navigation ul ul { border:1px solid #3b3734; border-top:0 }
	</style>
<![endif]-->
</head>
<body <?php body_class(); ?>>
<!-- Header -->
<div id="header">
	<div class="shell">
		<h1 id="logo"><a href="<?php echo home_url('/'); ?>" class="notext"><?php bloginfo('name'); ?></a></h1>
    <div class="cl">&nbsp;</div>
		<div id="navigation">
			<?php wp_nav_menu('theme_location=main-menu&fallback_cb=&container='); ?>
		</div>
		<div id="login-nav">
			<?php wp_nav_menu('theme_location=top-menu&fallback_cb=&container='); ?>
		</div>
		<?php get_search_form(); ?>
		<div class="cl">&nbsp;</div>
	</div>	
</div>
<!-- End of Header -->
	
