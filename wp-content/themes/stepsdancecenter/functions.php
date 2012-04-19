<?php

function theme_init_theme() {
	# Enqueue jQuery
	wp_enqueue_script('jquery');
	
	# Enqueue Custom Scripts & Styles
	if (!is_admin()) {
		wp_enqueue_script('jquery-fancybox', get_bloginfo('stylesheet_directory') . '/js/jquery.fancybox-1.3.4.js', array('jquery'), '1.3.4');
		wp_enqueue_script('jquery-jcarousel', get_bloginfo('stylesheet_directory') . '/js/jquery.jcarousel.js', array('jquery'), '0.2.8');
		wp_enqueue_script('jquery-tiptip', get_bloginfo('stylesheet_directory') . '/js/jquery.tipTip.js', array('jquery'), '1.3');
		wp_enqueue_script('jquery-mousewheel', get_bloginfo('stylesheet_directory') . '/js/jquery.mousewheel.js', array('jquery'), '3.0.6');
		wp_enqueue_script('jquery-jscrollpane', get_bloginfo('stylesheet_directory') . '/js/jquery.jscrollpane.js', array('jquery', 'jquery-mousewheel'), '2.0');
		wp_enqueue_script('jquery-theme-custom', get_bloginfo('stylesheet_directory') . '/js/functions.js', array('jquery-fancybox', 'jquery-tiptip', 'jquery-jcarousel', 'jquery-jscrollpane'), '1.0');
        
		wp_enqueue_style('jquery-tiptip', get_bloginfo('stylesheet_directory') . '/tipTip.css', array(), '1.3');
		wp_enqueue_style('jquery-jscrollpane', get_bloginfo('stylesheet_directory') . '/jquery.jscrollpane.css', array(), '2.0');
		wp_enqueue_style('jquery-fancybox', get_bloginfo('stylesheet_directory') . '/fancybox/jquery.fancybox-1.3.4.css', array(), '1.3.4');
	}
}
add_action('init', 'theme_init_theme');


add_action('after_setup_theme', 'theme_setup_theme');

# To override theme setup process in a child theme, add your own theme_setup_theme() to your child theme's
# functions.php file.
if ( ! function_exists( 'theme_setup_theme' ) ):
function theme_setup_theme() {
	include_once('lib/common.php');

	# Theme supports
	add_theme_support('automatic-feed-links');
	add_theme_support('menus');
	add_theme_support('post-thumbnails');

	# Custom image sizes
	add_image_size('home_post_thumb', 130, 100, true);
	add_image_size('event_thumb', 180, 104, true);
	add_image_size('post_large', 715, 215, true);
	add_image_size('post_medium', 230, 157, true);
	add_image_size('post_normal', 270, 150, true);
	add_image_size('gallery_large', 748, 374, true);
	add_image_size('gallery_small', 48, 48, true);

	# Register CPTs
	include_once('options/theme-post-types.php');
	
	# Attach custom widgets
	include_once('lib/custom-widgets/widgets.php');
	include_once('options/theme-widgets.php');
	
	# Add Actions
	add_action('widgets_init', 'theme_widgets_init');
	add_action('wp_loaded', 'attach_theme_options');
	add_action('wp_head', '_print_ie6_styles');

	# Add Filters
	
}
endif;

# Register Sidebars
# Note: In a child theme with custom theme_setup_theme() this function is not hooked to widgets_init
function theme_widgets_init() {
	register_sidebar(array(
		'name' => 'Default Sidebar',
		'id' => 'default-sidebar',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widgettitle">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => 'Post Sidebar',
		'id' => 'bottom-widgets',
		'before_widget' => '<div id="%1$s" class="bottom_widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widgettitle">',
		'after_title' => '</h6>',
	));
	register_sidebar(array(
		'name' => 'Page Sidebar',
		'id' => 'footer-widgets',
		'before_widget' => '<div id="%1$s" class="widget col %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h6 class="widgettitle">',
		'after_title' => '</h6>',
	));
}

function attach_theme_options() {
	# Attach theme options
	include_once('lib/theme-options/theme-options.php');
	
	include_once('options/theme-options.php');
	// include_once('options/other-options.php');
	
	# Theme Help needs to be after options/theme-options.php
	include_once('lib/theme-options/theme-readme.php');
	
	# Attach ECFs
	include_once('lib/enhanced-custom-fields/enhanced-custom-fields.php');
	include_once('options/theme-custom-fields.php');

	# Include shortcodes
	include_once('options/theme-shortcodes.php');
}

function steps_sort_programs($a, $b) {
	$x = get_metadata("taxonomy", $a->term_id, 'program_order', true);
	if (!$x) {
		$x = 0;
	}
	$y = get_metadata("taxonomy", $b->term_id, 'program_order', true);
	if (!$y) {
		$y = 0;
	}
	return strcmp($x, $y);
}

function steps_sort_gallery_categories($a, $b) {
	$x = get_metadata("taxonomy", $a->term_id, 'gallery_category_order', true);
	if (!$x) {
		$x = 0;
	}
	$y = get_metadata("taxonomy", $b->term_id, 'gallery_category_order', true);
	if (!$y) {
		$y = 0;
	}
	return strcmp($x, $y);
}

function steps_share_icons($link, $title) {
	?>
	<div class="social-icons">
		<a href="http://twitter.com/home?status= <?php echo $link; ?>" class="tw" target="_blank"></a>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($link); ?>&amp;t=<?php echo $title; ?>" target="blank" class="fb"></a>
		<div class="cl">&nbsp;</div>
	</div>
	<?php
}

function steps_share_icons_large($link, $title) {
	?>
	<div class="social">
		<a href="http://twitter.com/home?status= <?php echo $link; ?>" class="tw" target="_blank"><span class="icon">&nbsp;</span>Tweet This</a><span class="div">&nbsp;</span>
		<a href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($link); ?>&amp;t=<?php echo $title; ?>" target="blank" class="fb"><span class="icon">&nbsp;</span>Like This</a>
	</div>
	<?php
}

add_filter('excerpt_length', 'steps_exceprt_length_long');
function steps_exceprt_length($length) {
	return 13;
}
function steps_exceprt_length_average($length) {
	return 26;
}
function steps_exceprt_length_long($length) {
	return 120;
}

add_filter('excerpt_more', 'steps_excerpt_more');
function steps_excerpt_more($more) {
	return '...';
}

function steps_blog_title() {
	$id = get_option('page_for_posts');
	if ($id) {
		$title = get_the_title($id);
	} else {
		$title = 'Nossi Blog';
	}
	echo $title;
}

add_filter('the_content', 'steps_clean_shortcode_content');
function steps_clean_shortcode_content( $content ) {
    /* Parse nested shortcodes and add formatting. */
    $content = trim( wpautop( do_shortcode( $content ) ) );

    /* Remove '</p>' from the start of the string. */
    if ( substr( $content, 0, 4 ) == '</p>' )
        $content = substr( $content, 4 );

    /* Remove '<p>' from the end of the string. */
    if ( substr( $content, -3, 3 ) == '<p>' )
        $content = substr( $content, 0, -3 );

    /* Remove any instances of '<p></p>'. */
    $content = str_replace( array( '<p></p>' ), '', $content );

    return $content;
}

remove_filter('the_content', 'wpautop');
add_filter('the_content', 'wpautop', 13);

function steps_autolink_footer_menu_titles($title) {
	$p = get_page_by_path(sanitize_title_with_dashes($title));
	if ($p) {
		$title = '<a href="' . get_permalink($p->ID) . '">' . $title . '</a>';
	}
	return $title;
}
?>
