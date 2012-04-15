<?php 
get_header(); 
the_post();
?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<h1><?php the_title(); ?><span>&nbsp;</span></h1>
					<div class="article">
						<?php the_content(); ?>
						<div class="cl">&nbsp;</div>
					</div>
				</div>
				<div class="cbox-b"></div>
			</div>
			<?php $display_posts = get_meta('_display_blog_posts'); ?>
			<?php if ($display_posts): ?>
				<div class="tbox">
					<div class="tbox-t"></div>
					<div class="tbox-c">
						<h1>Nossi Blog<span>&nbsp;</span></h1>
						<?php 
						$loopID = 0;
						add_filter('excerpt_length', 'nossi_exceprt_length_average');
						query_posts('post_type=post&posts_per_page=2&orderby=menu_order&order=ASC'); 
						while(have_posts()):
							the_post();
							$loopID++;
							?>
							<div class="article <?php echo ($loopID % 2 == 0) ? 'right' : 'left'; ?>">
								<?php if (has_post_thumbnail()): ?>
									<?php the_post_thumbnail('post_normal', array('class' => 'imgbg type2')); ?>
								<?php endif ?>
								<h5><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h5>
								<?php the_excerpt(); ?>
								<p><a href="<?php the_permalink(); ?>" class="more small">Read More<span class="arr">&nbsp;</span></a></p>
							</div>
							<?php
						endwhile;
						wp_reset_query();
						remove_filter('excerpt_length', 'nossi_exceprt_length_average');
						?>
						<div class="cl">&nbsp;</div>
					</div>
					<div class="tbox-b"></div>
				</div>
			<?php endif ?>
		</div>
		<?php get_sidebar(); ?>
		<div class="cl">&nbsp;</div>
	</div>	
</div>
<!-- End of Main -->
<?php get_sidebar('bottom'); ?>
<?php get_footer(); ?>
