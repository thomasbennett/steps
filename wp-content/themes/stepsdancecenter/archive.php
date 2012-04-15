<?php get_header(); ?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<h1>
						<?php if (is_category()) { ?>
							Archive for the &#8216;<?php single_cat_title(); ?>&#8217; Category
						<?php } elseif( is_tag() ) { ?>
							Posts Tagged &#8216;<?php single_tag_title(); ?>&#8217;
						<?php } elseif (is_day()) { ?>
							Archive for <?php the_time('F jS, Y'); ?>
						<?php } elseif (is_month()) { ?>
							Archive for <?php the_time('F, Y'); ?>
						<?php } elseif (is_year()) { ?>
							Archive for <?php the_time('Y'); ?>
						<?php } elseif (is_author()) {
							$curauth = $wp_query->get_queried_object();
							?>
							Posts by <?php echo $curauth->display_name; ?>
						<?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
							Blog Archives
						<?php } ?>
						<span>&nbsp;</span>
					</h1>
					<?php get_template_part('loop', 'archive'); ?>
				</div>
				<div class="cbox-b"></div>
			</div>
		</div>
		<?php get_sidebar('blog'); ?>
		<div class="cl">&nbsp;</div>
	</div>	
</div>
<!-- End of Main -->
<?php get_sidebar('bottom'); ?>
<?php get_footer(); ?>