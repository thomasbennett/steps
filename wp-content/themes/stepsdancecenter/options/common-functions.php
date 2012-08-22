<?php

# Content Cleanup and Common Shortcode Setup
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

# Dashboard Customization
function custom_dashboard_widget() {
  include_once('dashboard.php');
}
add_action('admin_footer', 'custom_dashboard_widget');

# Theme Cleanup
function disable_default_dashboard_widgets() {

  # Dashboard
	#remove_meta_box('dashboard_right_now', 'dashboard', 'core');
	#remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
	remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
	remove_meta_box('dashboard_plugins', 'dashboard', 'core');

	#remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
	remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
	remove_meta_box('dashboard_primary', 'dashboard', 'core');
	remove_meta_box('dashboard_secondary', 'dashboard', 'core');

  # remove additional plugins
	remove_meta_box('tribe_dashboard_widget', 'dashboard', 'normal');
	remove_meta_box('rg_forms_dashboard', 'dashboard', 'normal');
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

# Cleanup wp_head
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator'); //removes WP Version # for security
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link');
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links_extra', 3);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'wp_shortlink_wp_head', 10, 0 );
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

?>
