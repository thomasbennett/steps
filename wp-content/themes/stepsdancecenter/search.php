<?php get_header(); ?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<h1>Search Results<span>&nbsp;</span></h1>
					<?php get_template_part('loop', 'search'); ?>
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