<?php

add_shortcode('left', 'shortcode_left');
function shortcode_left($atts, $content = '') {
	return steps_clean_shortcode_content('<div class="article-left">' . steps_clean_shortcode_content($content) . '</div>');
}

add_shortcode('right', 'shortcode_right');
function shortcode_right($atts, $content = '') {
	return steps_clean_shortcode_content('<div class="article-right">' . steps_clean_shortcode_content($content) . '</div>');
}

add_shortcode('blue_button', 'shortcode_blue_button');
function shortcode_blue_button($atts, $content = '') {
	if (!isset($atts['link']) || !$atts['link']) {
		$atts['link'] = '#';
	}
	if (!isset($atts['text']) || !$atts['text']) {
		$atts['text'] = 'Button Text';
	}
	if (!isset($atts['style']) || !$atts['style']) {
		$atts['style'] = '';
	}
	if (!isset($atts['size']) || $atts['size'] != 'big') {
		$atts['size'] = 'small';
	}
	return '<a style="' . $atts['style'] . '" href="' . $atts['link'] . '" class="' . $atts['size'] . ' blue-btn ' . (isset($atts['align']) && $atts['align'] ? ' align' . $atts['align'] : '') . '"><span>' . $atts['text'] . '</span></a>';
}

add_shortcode('clear', 'shortcode_clear');
function shortcode_clear($atts, $content = '') {
	return '<div class="cl">&nbsp;</div>';
}

add_shortcode('endsection', 'shortcode_endsection');
function shortcode_endsection($atts, $content = '') {
  return '</div>';
}

add_shortcode('newsection', 'shortcode_opensection');
function shortcode_opensection($atts, $content='') {
  return '
      </div> 
    </div>
    <div class="cbox-b"></div>
  </div>
  
  <div class="cl"></div>

  <div class="cbox" style="padding-bottom:0;">
    <div class="cbox-t"></div>
    <div class="cbox-c">'
      .steps_clean_shortcode_content($content).
    '<style>
      .tbox { float: right; margin-top: 30px; }
      #sidebar { position: absolute; left: 50%; margin-left: -477px; float: none;}
    </style>';
}

add_shortcode('four_boxes', 'shortcode_four_boxes');
function shortcode_four_boxes($atts, $content = '') {
	return steps_clean_shortcode_content('<div class="right linksbox">' . steps_clean_shortcode_content($content) . '<div class="cl">&nbsp;</div></div>');
}

add_shortcode('four_boxes_item', 'shortcode_four_boxes_item');
function shortcode_four_boxes_item($atts, $content = '') {
	if (!isset($atts['align']) || !$atts['align']) {
		$atts['align'] = 'left';
	}
	if (!isset($atts['link']) || !$atts['link']) {
		$atts['link'] = '#';
	}
	if (!isset($atts['image']) || !$atts['image']) {
		$atts['image'] = get_bloginfo('stylesheet_directory') . '/images/ic1.png';
	}
	if (!isset($atts['title']) || !$atts['title']) {
		$atts['title'] = 'Item Title';
	}
	return '<div class="box align' . $atts['align'] . '"><a href="' . $atts['link'] . '" class="more"><img src="' . $atts['image'] . '" alt="" />' . $atts['title'] . '<span class="arr">&nbsp;</span></a></div>' . ($atts['align'] == 'right' ? '<div class="cl">&nbsp;</div>' : "");
}

add_shortcode('single_link', 'shortcode_single_link');
function shortcode_single_link($atts, $content = '') {
	if (!isset($atts['link']) || !$atts['link']) {
		$atts['link'] = '#';
	}
	if (!isset($atts['title']) || !$atts['title']) {
		$atts['title'] = 'Link Title Here';
	}
	return '<a href="' . $atts['link'] . '" class="more">' . (isset($atts['image']) && $atts['image'] ? '<img src="' . $atts['image'] . '" alt="" />' : '') . $atts['title'] . '<span class="arr">&nbsp;</span></a>';
}

add_shortcode('contact_details', 'shortcode_contact_details');
function shortcode_contact_details($atts, $content = '') {
	if (!isset($atts['email']) || !$atts['email']) {
		$atts['email'] = get_bloginfo('admin_email');
	}
	if (!isset($atts['phone']) || !$atts['phone']) {
		$atts['phone'] = '1.800.566.6811';
	}
	return '<div class="right contactbox"><p class="phone"><span class="blue">Contact Us via Phone</span><strong>' . $atts['phone'] . '</strong></p><p class="email"><a href="mailto:' . $atts['email'] . '" class="more">Email<span class="arr">&nbsp;</span><img src="' . get_bloginfo('stylesheet_directory') . '/images/ic6.png" alt="" /></a></p></div>';
}

add_shortcode('deadlines', 'shortcode_deadlines');
function shortcode_deadlines($atts, $content = '') {
	return steps_clean_shortcode_content('<div class="deadlines">' . steps_clean_shortcode_content($content) . '<div class="cl">&nbsp;</div></div>');
}

add_shortcode('video', 'shortcode_video');
function shortcode_video($atts, $content = '') {
	ob_start();
	if (!isset($atts['align']) || $atts['align'] != 'right') {
		$atts['align'] = 'left';
	}
	if (!isset($atts['title'])) {
		$atts['title'] = '';
	}
	if (!isset($atts['video'])) {
		$atts['video'] = 'http://www.youtube.com/watch?v=qiQj0o8BOYw';
	}
	?>
	<div class="article col <?php echo ($atts['align'] == 'right') ? 'col2' : ''; ?>">
		<div class="video">
			<?php echo create_embedcode($atts['video'], 338, 212); ?>
		</div>
		<?php if ($atts['title']): ?>
			<h5><?php echo $atts['title']; ?></h5>
		<?php endif ?>
		<?php echo wpautop($content); ?>
	</div>
	<?php
	$html = ob_get_clean();
	return $html;
}

add_shortcode('form_popup', 'shortcode_form_popup');
function shortcode_form_popup($atts, $content = '') {
	ob_start();
	if (!isset($atts['id']) || !$atts['id']) {
		return 'Please specify the ID of the form.';
	}
	if (!isset($atts['title']) || !$atts['title']) {
		$atts['title'] = 'Form Title Here';
	}
	echo '<a href="#gform-' . $atts['id'] . '" class="form-popup-link blue-btn alignleft"><span>' . $atts['title'] . '</span></a>';
	echo '<div style="display:none">';
	echo '<div id="gform-' . $atts['id'] . '" class="form-popup">';
	gravity_form($atts['id'], true, true, false, null, true);
	echo '</div>';
	echo '</div>';
	$html = ob_get_clean();
	return $html;
}
add_shortcode('custom_gallery', 'shortcode_custom_gallery');
function shortcode_custom_gallery($atts, $content) {
	$category = $atts['category'];

	$query_string = 'post_type=custom-gallery&posts_per_page=-1&orderby=menu_order&order=ASC';

	if( isset($atts['category']) && term_exists($atts['category'], 'custom_gallery_category') )
	$query_string .= '&custom_gallery_category=' . $category;

	query_posts($query_string);

	ob_start();
	?>
	<div class="gallery gallery-shortcode">
		<div class="main-slider">
			<ul>
				<?php while(have_posts()): 
					the_post(); 
					if ($category == 'video'): 
						$url = get_meta('_custom_gallery_video_url');
						if (!$url) {
							continue;
						}
					?>
						<li>
						<?php echo create_embedcode($url, 750, 485); ?>
						</li>
				<?php else: 
						if (!has_post_thumbnail()) {
						continue;
						}
					?>
						<li>
						<?php the_post_thumbnail('gallery_large'); ?>
							<div class="caption">
							<h5><?php the_title(); ?></h5>
								<?php the_content(); ?>
						</div>
						</li>
				<?php endif ?>
				<?php endwhile; ?>
		</ul>
		</div>
	<div class="thumbs-slider">
			<ul>
			<?php while(have_posts()): 
					the_post(); 
				if ($category == 'video') {
						$url = get_meta('_custom_gallery_video_url');
					if (!$url) {
							continue;
					}
						$img = get_video_thumb(create_embedcode($url));
				} else {
						if (!has_post_thumbnail()) {
						continue;
						}
					$img = false;
					}
					?>
					<li title="<?php the_title_attribute(); ?>"><span class="mask">&nbsp;</span><?php if ($img): 
							?><img src="<?php echo $img; ?>" width="48" height="48" alt="" /><?php
						else:
							?><?php the_post_thumbnail('gallery_small'); ?>
					<?php endif ?>
					</li>
			<?php endwhile; ?>
			</ul>
	</div>
		<?php wp_reset_query(); ?>
</div>
	<?php

	$gallery = ob_get_clean();

	$gallery = preg_replace('/>\s*</U', '><', $gallery);

	return $gallery;
}

add_shortcode('popup', 'shortcode_popup');
function shortcode_popup($atts,$content = null) {
	$title = isset($atts['title']) ? $atts['title'] : 'Title Goes Here';

	ob_start();

	$number = rand( 1000, 9999 );

	echo '<a href="#popup-' . $number . '" class="popup-link">' . $title . '</a>';

	echo '<div style="display:none"><div class="popup-content" id="popup-' . $number . '">' . do_shortcode($content) . '</div></div>';

	return ob_get_clean();
}

add_shortcode('box', 'shortcode_box');
function shortcode_box($atts, $content = null) {
	ob_start();
	?>
	<div class="cbox">
		<div class="cbox-t"></div>
		<div class="cbox-c">
			<?php if(isset($atts['title'])): ?>
			<h1><?php echo $atts['title'] ?><span>&nbsp;</span></h1>
			<?php endif; ?>

			<div class="article">
				<?php echo do_shortcode($content); ?>
				<div class="cl">&nbsp;</div>
			</div>
		</div>
		<div class="cbox-b"></div>
	</div>
	<?php

	$content = ob_get_clean();

	$content = preg_replace('/>\s*</U', '><', $content);

	return $content;
}

add_shortcode('gallery_popup', 'shortcode_gallery_popup');
function shortcode_gallery_popup($atts, $content = '') {
	global $post;
	$images = get_post_images($post->ID);
	if (!$images) {
		return;
	}
	if (!isset($atts['title']) || !$atts['title']) {
		$atts['title'] = 'Link Title Here';
	}
	ob_start();
	?>
	<a href="#gallery-popup" class="gallery-popup-link blue-btn alignleft"><span><?php echo $atts['title']; ?></span></a>
	<div style="display: none;">
		<div id="gallery-popup">
			<div class="main-slider">
				<ul>
					<?php foreach ($images as $img): ?>
						<li>
							<img src="<?php echo $img->gallery_large; ?>" alt="" />
							<div class="caption">
								<h5><?php echo $img->post_title; ?></h5>
								<?php echo wpautop($img->post_content); ?>
							</div>
						</li>
					<?php endforeach ?>
				</ul>
			</div>
			<div class="thumbs-slider">
				<ul>
					<?php foreach ($images as $img): ?>
						<li title="<?php echo esc_attr($img->post_title); ?>"><span class="mask">&nbsp;</span><img  src="<?php echo $img->student_thumb; ?>" alt="" /></li>
					<?php endforeach ?>
				</ul>
			</div>
		</div>
	</div>
	<?php
	$html = ob_get_clean();
	return $html;
}

?>
