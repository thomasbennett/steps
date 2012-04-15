<?php get_header(); ?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<h1><?php _e('Error 404 - Not Found'); ?><span>&nbsp;</span></h1>
					<div class="article">
						<p><?php printf(__('Please check the URL for proper spelling and capitalization. <br />If you\'re having trouble locating a destination, try visiting the <a href="%1$s">home page</a>.'), get_option('home')); ?></p>
					</div>
				</div>
				<div class="cbox-b"></div>
			</div>
		</div>
		<?php get_sidebar(); ?>
		<div class="cl">&nbsp;</div>
	</div>	
</div>
<!-- End of Main -->
<?php get_sidebar('bottom'); ?>
<?php get_footer(); ?>