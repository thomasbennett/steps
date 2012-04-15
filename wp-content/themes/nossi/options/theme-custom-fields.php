<?php

$home_slide_1_settings =& new ECF_Panel('home_slide_1_settings', 'Slide Settings', 'home_slide_1', 'normal', 'high');
$home_slide_1_settings->add_fields(array(
	ECF_Field::factory('text', 'home_slide_1_link', 'Link'),
	ECF_Field::factory('image', 'home_slide_1_bg', 'Background Image')
		->set_size(0, 355)
		->help_text('Maximum height: 355px. Larger images will be scaled proportionally to fit that size.'),
	ECF_Field::factory('image', 'home_slide_1_img', 'Person Image')
	
));

$home_slide_2_settings =& new ECF_Panel('home_slide_2_settings', 'Slide Settings', 'home_slide_2', 'normal', 'high');
$home_slide_2_settings->add_fields(array(
	ECF_Field::factory('text', 'home_slide_2_subtitle', 'Subtitle'),
	ECF_Field::factory('text', 'home_slide_2_link', 'Link URL'),
	ECF_Field::factory('text', 'home_slide_2_link_text', 'Link Text'),
	ECF_Field::factory('image', 'home_slide_2_icon', 'Icon')
		->set_size(68, 68)
		->help_text("Max size: 68px * 68px. Larger images will be scaled & cropped automatically to fit that size."),
));

$home_slide_3_settings =& new ECF_Panel('home_slide_3_settings', 'Slide Settings', 'home_slide_3', 'normal', 'high');
$home_slide_3_settings->add_fields(array(
	ECF_Field::factory('text', 'home_slide_3_link', 'Link URL'),
	ECF_Field::factory('image', 'home_slide_3_image', 'Image')
		->set_size(306, 306)
		->help_text("Max size: 306px * 306px. Larger images will be scaled & cropped automatically to fit that size."),
));

$home_page_settings =& new ECF_Panel('home_page_settings', 'Home Settings', 'page', 'normal', 'high');
$home_page_settings->show_on_template('page-home.php');
$home_page_settings->add_fields(array(
	ECF_Field::factory('separator', 'home_dynamic_block_sep', 'Dynamic Block'),
	ECF_Field::factory('text', 'home_dynamic_block_title', 'Title'),
	ECF_Field::factory('textarea', 'home_dynamic_block_items', 'Items'),
	ECF_Field::factory('text', 'home_dynamic_block_link_url', 'Link URL'),
	ECF_Field::factory('text', 'home_dynamic_block_link_text', 'Link Text'),

	ECF_Field::factory('separator', 'home_video_area_sep', 'Video Area'),
	ECF_Field::factory('text', 'home_video_section_title', 'Section Title'),
	ECF_Field::factory('text', 'home_video_view_all', 'View All Link'),
	ECF_Field::factory('text', 'home_video_post_title', 'Video Title'),
	ECF_Field::factory('date', 'home_video_date', 'Video Date'),
	ECF_Field::factory('text', 'home_video_url', 'Video URL'),
	ECF_Field::factory('textarea', 'home_video_description', 'Video Description'),
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

$student_life_settings =& new ECF_Panel('student_life_settings', 'Student Life Settings', 'page', 'normal', 'high');
$student_life_settings->show_on_template('page-student-life.php');
$student_life_settings->add_fields(array(
	ECF_Field::factory('text', 'student_life_main_title', 'Main Title'),
));

$student_life_slide_settings =& new ECF_Panel('student_life_slide_settings', 'Student Life Slide Settings', 'student_life_slide', 'normal', 'high');
$student_life_slide_settings->add_fields(array(
	ECF_Field::factory('text', 'student_life_slide_link', 'Link'),
	ECF_Field::factory('image', 'student_life_image', 'Image')
		->set_size(496, 312)
		->help_text('Size: 496px * 312px. Larger images will be scaled & cropped to fit that size.'),
	ECF_Field::factory('text', 'student_life_video_url', 'Video URL')
		->help_text('If the video is set, it will be displayed instead of the image (even if there is an image added).')
));

$student_settings =& new ECF_Panel('student_settings', 'Student Settings', 'student', 'normal', 'high');
$student_settings->add_fields(array(
	ECF_Field::factory('text', 'student_full_name', 'Full Name'),
	ECF_Field::factory('image', 'student_main_image', 'Main Image')
		->set_size(159, 167)
		->help_text('Size: 159px * 167px. Larger images will be scaled & cropped to fit that size.'),
	ECF_Field::factory('text', 'student_specialty', 'Specialty'),
	ECF_Field::factory('textarea', 'student_short_description', 'Short Description'),
	ECF_Field::factory('text', 'student_class', 'Class'),
	ECF_Field::Factory('text', 'student_work_link', 'Video Interview')
));

$default_page_settings =& new ECF_Panel('default_page_settings', 'Page Settings', 'page', 'normal', 'high');
$default_page_settings->show_on_template('default');
$default_page_settings->add_fields(array(
	ECF_Field::factory('select', 'display_blog_posts', 'Display Latest Blog Posts?')
		->add_options(array(
			0 => 'No',
			1 => 'Yes'
		))
));
?>
