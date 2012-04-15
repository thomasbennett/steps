<?php 
/*
Template Name: Student Life
*/
get_header(); 
the_post();
?>
<!-- Main -->
<div id="main" class="student">
	<div class="shell">
		<?php $title = get_meta('_student_life_main_title'); ?>
		<?php if ($title): ?>
			<div class="head">
				<h2><?php echo $title; ?></h2>	
			</div>
		<?php endif ?>
		<div class="slider">
			<ul>
				<?php 
				$count = 0;
				query_posts('post_type=student_life_slide&posts_per_page=-1&orderby=menu_order&order=ASC');
				while(have_posts()): 
					$count++;
					the_post(); 
					$link = get_meta('_student_life_slide_link');
					$img = get_meta('_student_life_image');
					$video = get_meta('_student_life_video_url');
					?>
					<li>
						<div class="media">
							<?php if ($video): ?>
								<?php echo create_embedcode($video, 496, 312); ?>
							<?php elseif($img): ?>
								<img src="<?php echo ecf_get_image_url($img); ?>" alt="" />
							<?php endif ?>
						</div>
						<div class="article">
							<h1><?php the_title(); ?><span>&nbsp;</span></h1>
							<div class="text">
								<?php the_content(); ?>
							</div>
							<?php if ($link): ?>
								<a href="<?php echo $link; ?>" class="more small">Read More<span class="arr">&nbsp;</span></a>
							<?php endif ?>
						</div>
					</li>
					<?php 
				endwhile;
				wp_reset_query(); 
				?>
			</ul>
			<div class="dots" <?php if($count < 2): ?>style="display:none;"<?php endif; ?>>
				<?php for($i = 0; $i < $count; $i++): ?>
					<a href="#"></a>
				<?php endfor; ?>
			</div>
		</div>
		<div class="profile-cols type2">
			<div class="heading">
				<h3>MEET THE STUDENTS</h3>
			</div>
			<?php 
			$loopID = 0;
			query_posts('post_type=student&posts_per_page=-1&orderby=menu_order&order=ASC'); 
			while(have_posts()):
				the_post();
				$loopID++;
				$img = get_meta('_student_main_image');
				$specialty = get_meta('_student_specialty');
				?>
				<div class="col">
          <a href="<?php the_permalink(); ?>"> 
					<?php if ($img): ?>
						<img src="<?php echo ecf_get_image_url($img); ?>" alt="" />
					<?php endif ?>
					<div class="ttl">
						<h4 class="custom<?php echo $loopID; ?>"><?php the_title(); ?></h4>
						<?php echo $specialty ? $specialty : '&nbsp;'; ?><span class="arr">&nbsp;</span>
						<div class="cl">&nbsp;</div>
					</div>
					<?php echo wpautop(get_meta('_student_short_description')); ?>
          </a>
				</div>
				<?php
			endwhile;
			wp_reset_query();
			?>
			<div class="cl">&nbsp;</div>
		</div>
		<div class="prof-links">
			<?php wp_nav_menu('theme_location=student-life-menu&fallback_cb=&container=&link_before=<span>&link_after=</span>'); ?>
			<div class="cl">&nbsp;</div>
		</div>
	</div>	
</div>
<!-- End of Main -->
<?php get_footer(); ?>
