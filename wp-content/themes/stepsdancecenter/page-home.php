<?php 
/*
Template Name: Home
*/
get_header(); 
?>
<div id="slideshow">
	<ul>
		<?php 
		$count = 0;
		query_posts('post_type=home_slide_1&posts_per_page=-1&orderby=menu_order&order=ASC'); 
		while(have_posts()): 
			the_post();
			$count++;
			$bg = get_meta('_home_slide_1_bg');
			$img = get_meta('_home_slide_1_img');
			$link = get_meta('_home_slide_1_link');
			$clean_title = urlencode(str_replace(array('*', '  '), array('', ' '), get_the_title()));
			$beautiful_title_pieces = explode('*', get_the_title());
			foreach ($beautiful_title_pieces as &$piece) {
				$piece = '<span>' . trim($piece) . '</span>';
			}
			$beautiful_title = implode('<br />', $beautiful_title_pieces);
			?>
			<li>
				<?php if ($bg): ?>
					<img src="<?php echo ecf_get_image_url($bg); ?>" alt="" />
				<?php endif ?>
				<div class="shell">
					<?php if ($img): ?>
						<img src="<?php echo ecf_get_image_url($img); ?>" class="slp" alt="" />
					<?php endif ?>
					<div class="caption">
						<h2><?php echo $beautiful_title; ?></h2>
						<div class="wrap">
							<?php the_content(); ?>
							<?php if ($link): ?>
								<a href="<?php echo $link; ?>" class="more small">LEARN MORE<span class="arr">&nbsp;</span></a>
								<?php nossi_share_icons($link, $clean_title); ?>
							<?php endif ?>
						</div>
					</div>
				</div>
			</li>
		<?php endwhile; ?>
		<?php wp_reset_query(); ?>
	</ul>
	<div class="dots">
		<div class="shell">
			<?php for($i = 1; $i <= $count; $i++): ?>
				<a href="#"></a>
			<?php endfor; ?>
		</div>
	</div>
</div>
<div id="intro">
	<div class="shell">
		<ul>
			<?php 
			$slider_2_posts = get_posts('post_type=home_slide_2&posts_per_page=-1&orderby=menu_order&order=ASC');
			for($i = 0; $i < ceil(count($slider_2_posts) / 2); $i++): 
				?>
				<li>
					<?php for($j = 0; $j <=1; $j++): 
						$idx = $i * 2 + $j;
						if (isset($slider_2_posts[$i * 2 + $j])): 
							$id = $slider_2_posts[$idx]->ID;
							$subtitle = get_meta('_home_slide_2_subtitle', $id);
							$link_url = get_meta('_home_slide_2_link', $id);
							$link_text = get_meta('_home_slide_2_link_text', $id);
							$icon = get_meta('_home_slide_2_icon', $id);
							?>
							<div class="<?php echo ($j == 0) ? 'left' : 'right'; ?>">
								<h5><?php echo $slider_2_posts[$idx]->post_title; ?></h5>
								<?php if ($subtitle): ?>
									<p><?php echo $subtitle; ?></p>
								<?php endif ?>
								<?php if ($link_url && $link_text): ?>
									<a href="<?php echo $link_url; ?>" class="more small"><?php echo $link_text; ?><span class="arr">&nbsp;</span></a>
								<?php endif ?>
								<?php if ($icon): ?>
									<img src="<?php echo ecf_get_image_url($icon); ?>" class="icon" alt="" />
								<?php endif ?>
							</div>						
						<?php endif ?>
					<?php endfor; ?>
					<div class="cl">&nbsp;</div>
				</li>
			<?php endfor; ?>
		</ul>
	</div>
</div>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div class="home-gallery">
			<div class="hg-t"></div>
			<div class="hg-c">
				<div class="head">
					<h4>Pick a Program</h4>
				</div>
				<div class="hg-nav">
					<ul>
						<?php 
						$programs = get_terms(array('program')); 
						usort($programs, 'nossi_sort_programs');
						foreach ($programs as $key => $p): ?>
							<li class="nav-<?php echo $p->slug; echo $key == 0 ? ' current' : ''; ?>"><a href="#"><span><?php echo $p->name; ?></span></a></li>
						<?php endforeach ?>
					</ul>
					<span class="hover">&nbsp;</span>
				</div>
				<div class="tabs-holder">
					<?php foreach ($programs as $key => $p): ?>
						<div class="hg-tab <?php echo ($key == 0) ? 'current' : ''; ?>"<?php echo ($key == 0) ? ' style="display:block"' : ''; ?>>
							<?php 
							$loopID = 0;
							query_posts('post_type=home_slide_3&posts_per_page=-1&orderby=menu_order&order=ASC&program=' . $p->slug); 
							while(have_posts()):
								the_post();
								$loopID++;
								$link = get_meta('_home_slide_3_link');
								if (!$link) {
									$link = '#';
								}
								$img = get_meta('_home_slide_3_image');
								?>
								<div class="col col<?php echo ($loopID % 3) == 0 ? 3 : $loopID % 3; ?>">
									<?php if ($img): ?>
										<img src="<?php echo ecf_get_image_url($img); ?>" alt="" />
									<?php endif ?>
									<a href="<?php echo $link; ?>" class="more"><?php the_title(); ?><span class="arr">&nbsp;</span></a>
									<?php the_content(); ?>
								</div>
								<?php 
								if ($loopID % 3 == 0) {
									echo '<div class="cl">&nbsp;</div>';
								}
							endwhile; 
							wp_reset_query();
							?>
							<div class="cl">&nbsp;</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
			<div class="hg-b"></div>
		</div>
		<?php
		$title = get_meta('_home_dynamic_block_title');
		$items = get_meta('_home_dynamic_block_items');
		$link_url = get_meta('_home_dynamic_block_link_url');
		$link_text = get_meta('_home_dynamic_block_link_text');
		if ($title || $items || ($link_url && $link_text)): ?>
			<div class="hbox">
				<div class="hbox-t"></div>
				<div class="hbox-c">
					<div class="careers">
						<?php if ($title || ($link_url && $link_text)): ?>
							<div class="head">
								<?php if ($title): ?>
									<h4><?php echo $title; ?></h4>
								<?php endif ?>
								<?php if ($link_url && $link_text): ?>
									<a href="<?php echo $link_url; ?>" class="more small"><?php echo $link_text; ?><span class="arr">&nbsp;</span></a>
								<?php endif ?>
								<div class="cl">&nbsp;</div>
							</div>
						<?php endif ?>
						<?php if ($items): 
							$actual_items = explode("\n", $items);
							?>
							<div class="cnt">
								<?php if (count($actual_items) > 1): ?>
									<?php foreach ($actual_items as $item): ?>
										<span><?php echo $item; ?></span>
									<?php endforeach ?>
								<?php else: ?>
									<?php echo wpautop($items); ?>
								<?php endif ?>
							</div>
						<?php endif ?>
					</div>
				</div>
				<div class="hbox-b"></div>
			</div>
		<?php endif ?>
		<div class="feed-section">
			<div class="left">
				<div class="head">
					<?php 
					$link = get_meta('_home_video_view_all');
					$section_title = get_meta('_home_video_section_title'); 
					if (!$section_title) {
						$section_title = 'Videos';
					}
					?>
					<h5><?php echo $section_title; ?></h5>
					<?php if ($link): ?>
						<a href="<?php echo $link; ?>" class="more small">VIEW ALL<span class="arr">&nbsp;</span></a>
					<?php endif ?>
					<div class="cl">&nbsp;</div>
				</div>
				<div class="cnt">
					<?php
					$title = get_meta('_home_video_post_title');
					$descr = get_meta('_home_video_description');
					$date = get_meta('_home_video_date');
					$video_url = get_meta('_home_video_url');
					?>
					<?php if ($video_url): ?>
						<div class="fmedia">
							<a href="<?php echo $video_url; ?>" class="fancybox-video">
								<img src="<?php echo get_video_thumb(create_embedcode($video_url)); ?>" width="130" height="100" alt="" /><span class="mask">&nbsp;</span>
							</a>
						</div>
						<?php 
					endif;
					if ($date): 
						?>
						<p><?php echo date('d/m/y', strtotime($date)); ?></p>
						<?php 
					endif;
					if ($title): 
						?>
						<h5><?php echo $title; ?></h5>
						<?php 
					endif;
					echo wpautop($descr);
					if ($video_url) {
						?>
						<a href="<?php echo $video_url; ?>" class="more small fancybox-video">PLAY<span class="arr">&nbsp;</span></a>
						<?php
						nossi_share_icons($video_url, $title);
					}
					?>
				</div>
			</div>
			<div class="right">
				<?php 
				$news_cat = get_term_by('slug', 'news', 'category');
				if ($news_cat): 
					add_filter('excerpt_length', 'nossi_exceprt_length', 11);
					?>
					<div class="head">
						<h5>In the News</h5>
						<a href="<?php echo get_category_link($news_cat->term_id); ?>" class="more small">VIEW ALL<span class="arr">&nbsp;</span></a>
						<div class="cl">&nbsp;</div>
					</div>
					<div class="cnt">
						<?php 
						query_posts('post_type=post&posts_per_page=1&cat=' . $news_cat->term_id); 
						while(have_posts()):
							the_post(); ?>
              <div class="fmedia">
							  <?php if (has_post_thumbnail()):  ?>
									<a href="<?php the_permalink(); ?>">
										<?php the_post_thumbnail('home_post_thumb'); ?>
									</a>
                <?php else: ?>
                  <img src="<?php bloginfo('template_directory') ?>/images/logo-default.png" alt="Nossi News" />
							  <?php endif ?>
              </div>
							<p><?php the_time('m/d/y'); ?></p>
							<h5><?php the_title(); ?></h5>
							<?php the_excerpt(); ?>
							<a href="<?php the_permalink(); ?>" class="more small">MORE<span class="arr">&nbsp;</span></a>
							<?php 
							nossi_share_icons(get_permalink(), get_the_title());
						endwhile;
						wp_reset_query(); ?>
					</div>
				<?php endif ?>
			</div>
			<div class="cl">&nbsp;</div>
		</div>
	</div>	
</div>
<!-- End of Main -->

<?php get_sidebar('bottom'); ?>

<?php get_footer(); ?>
