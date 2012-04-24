<?php

$home_slide_settings =& new ECF_Panel('home_slide_settings', 'Slide Settings', 'home_slide', 'normal', 'high');
$home_slide_settings->add_fields(array(
	ECF_Field::factory('image', 'home_slide_bg', 'Background Image')
		->set_size(0, 506)
		->help_text('Maximum height: 506px. Larger images will be scaled proportionally to fit that size.'),
));

$home_spotlight =& new ECF_Panel('home_spotlight', 'Spotlight Details', 'page', 'normal', 'high');
$home_spotlight->show_on_page('homepage-callout');
$home_spotlight->add_fields(array(
	ECF_Field::factory('text', 'home_spotlight_link', 'Link'),
	ECF_Field::factory('text', 'home_spotlight_button', 'Button Text'),
));

$page_settings =& new ECF_Panel('page_settings', 'Page Settings', 'page', 'normal', 'high');
$page_settings->add_fields(array(
	ECF_Field::factory('choosesidebar', 'custom_bottom_sidebar', 'Bottom Sidebar')
		->set_sidebar_options(array(
			'before_widget' => '<div id="%1$s" class="bottom_widget widget %2$s">',
			'after_widget' => '</div>',
			'before_title' => '<h6 class="widgettitle">',
			'after_title' => '</h6>',
		))
));

$gallery_settings =& new ECF_Panel('gallery_settings', 'Gallery Entry Settings', 'gallery', 'normal', 'high');
$gallery_settings->show_on_taxonomy_term('gallery_category', 'video');
$gallery_settings->add_fields(array(
	ECF_Field::factory('text', 'gallery_video_url', 'Video URL')
));

$gallery_settings =& new ECF_Panel('custom_gallery_settings', 'Gallery Entry Settings', 'custom-gallery', 'normal', 'high');
$gallery_settings->show_on_taxonomy_term('custom_gallery_category', 'video');
$gallery_settings->add_fields(array(
	ECF_Field::factory('text', 'custom_gallery_video_url', 'Video URL')
));

?>
