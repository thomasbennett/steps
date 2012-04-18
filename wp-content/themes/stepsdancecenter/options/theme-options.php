<?php
function attach_main_options_page() {
	$title = "Theme Options";
	add_menu_page(
		$title,
		$title, 
		'edit_themes', 
	    basename(__FILE__),
		create_function('', '')
	);
}
add_action('admin_menu', 'attach_main_options_page');

$inner_options = new OptionsPage(array(
	wp_option::factory('separator', 'sep_social', 'Social & Contact'),
	wp_option::factory('text', 'twitter_username')
		->set_default_value('stepsdancectr'),
	wp_option::factory('text', 'facebook_link')
		->set_default_value('http://www.facebook.com/StepsDanceCtr'),
	wp_option::factory('textarea', 'phone_numbers')
		->set_default_value("615-514-2787(ARTS)\n1-888-986-2787(ARTS)"),
	wp_option::factory('text', 'general_address', 'Address')
		->set_default_value('590 Cheron Road  |  Nashville, TN 37115'),

	wp_option::factory('separator', 'sep_misc', 'Misc'),
    wp_option::factory('header_scripts', 'header_script'),
    wp_option::factory('footer_scripts', 'footer_script'),
));
$inner_options->title = 'General';
$inner_options->file = basename(__FILE__);
$inner_options->parent = "theme-options.php";
$inner_options->attach_to_wp();

?>
