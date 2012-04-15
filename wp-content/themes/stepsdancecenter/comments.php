<?php
if (theme_comments_restrict_access()) {

	theme_comments_render_list('theme_render_comment');

	theme_comments_render_form(array(
		'title_reply'=>__('Leave a Reply'),
	));
}
?>