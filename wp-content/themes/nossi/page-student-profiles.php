<?php 
/*
Template Name: Student Profiles
*/
get_header(); 
the_post();
?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div id="content">
			<?php nossi_student_profiles_section(); ?>
		</div>
		<?php get_sidebar(); ?>
		<div class="cl">&nbsp;</div>
	</div>	
</div>
<!-- End of Main -->
<?php get_sidebar('bottom'); ?>
<?php get_footer(); ?>