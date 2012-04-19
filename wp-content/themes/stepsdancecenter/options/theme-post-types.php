<?php  

register_post_type('home_slide', array(
	'labels' => array(
		'name'	 => 'Slideshow',
		'singular_name' => 'Slide',
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add new Slide' ),
		'view_item' => 'View Slide',
		'edit_item' => 'Edit Slide',
	    'new_item' => __('New Slide'),
	    'view_item' => __('View Slide'),
	    'search_items' => __('Search Slides'),
	    'not_found' =>  __('No slides found'),
	    'not_found_in_trash' => __('No slides found in Trash'),
	),
	'public' => false,
	'exclude_from_search' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'_edit_link' =>  'post.php?post=%d',
	'rewrite' => false,
	'query_var' => true,
	'supports' => array('title', 'editor', 'page-attributes'),
	'menu_position' => 101,
));

register_post_type('gallery', array(
	'labels' => array(
		'name'	 => 'Gallery',
		'singular_name' => 'Gallery Entry',
		'add_new' => __( 'Add New' ),
		'add_new_item' => __( 'Add new Gallery Entry' ),
		'view_item' => 'View Gallery Entry',
		'edit_item' => 'Edit Gallery Entry',
	    'new_item' => __('New Gallery Entry'),
	    'view_item' => __('View Gallery Entry'),
	    'search_items' => __('Search Gallery'),
	    'not_found' =>  __('No entries found'),
	    'not_found_in_trash' => __('No entries found in Trash'),
	),
	'public' => false,
	'exclude_from_search' => true,
	'show_ui' => true,
	'capability_type' => 'post',
	'hierarchical' => false,
	'_edit_link' =>  'post.php?post=%d',
	'rewrite' => false,
	'query_var' => true,
	'supports' => array('title', 'page-attributes', 'thumbnail', 'editor'),
	'menu_position' => 102,
));

register_taxonomy(
    'gallery_category', 
    array('gallery'), 
        array(
        'hierarchical' => true,
        'labels' => array(
        'name' => _x( 'Gallery Categories', 'taxonomy general name' ),
        'singular_name' => _x( 'Gallery Category', 'taxonomy singular name' ),
        'search_items' =>  __( 'Search Gallery Categories' ),
        'all_items' => __( 'All Gallery Categories' ),
        'parent_item' => __( 'Parent Gallery Category' ),
        'parent_item_colon' => __( 'Parent Gallery Category:' ),
        'edit_item' => __( 'Edit Gallery Category' ), 
        'update_item' => __( 'Update Gallery Category' ),
        'add_new_item' => __( 'Add New Gallery Category' ),
        'new_item_name' => __( 'New Gallery Category Name' ),
        'menu_name' => __( 'Gallery Categories' ),
    ),
    'show_ui' => true,
    'query_var' => true,
    'rewrite' => false,
));
?>
