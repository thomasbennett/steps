<?php

$home_slide_settings =& new ECF_Panel('home_slide_settings', 'Slide Settings', 'home_slide', 'normal', 'high');
$home_slide_settings->add_fields(array(
	ECF_Field::factory('image', 'home_slide_bg', 'Background Image')
		->set_size(0, 355)
		->help_text('Maximum height: 355px. Larger images will be scaled proportionally to fit that size.'),
	
));

$page_settings =& new ECF_Panel('page_settings', 'Page Settings', 'page', 'normal', 'high');
$page_settings->add_fields(array(
	ECF_FIeld::factory('choosesidebar', 'custom_bottom_sidebar', 'Bottom Sidebar')
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
	ECF_FIeld::factory('text', 'gallery_video_url', 'Video URL')
));

$gallery_settings =& new ECF_Panel('custom_gallery_settings', 'Gallery Entry Settings', 'custom-gallery', 'normal', 'high');
$gallery_settings->show_on_taxonomy_term('custom_gallery_category', 'video');
$gallery_settings->add_fields(array(
	ECF_FIeld::factory('text', 'custom_gallery_video_url', 'Video URL')
));

?>
