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
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<?php 
					$name = get_meta('_student_full_name'); 
					if (!$name) {
						$name = get_the_title();
					}
					?>
					<h1><?php echo $name; ?><span>&nbsp;</span></h1>
					<div class="profile">
						<?php $images = get_post_images(get_the_id()); ?>
						<?php if ($images): ?>
              <?php $link = get_meta('_student_work_link'); ?>
              <?php if ($link): ?>
                
                <div class="profile-gallery"><div class="slider"><iframe style="float:right;" width="310" height="195" src="<?php echo $link; ?>" frameborder="0" allowfullscreen></iframe></div></div>
                <a style="clear:right;margin-top: 20px;" href="/student-life/student-gallery" class="blue-btn wordspace"><span>View Nossi Student Work</span></a>
              <?php else: ?>
                <div class="profile-gallery">
                  <div class="slider">
                    <ul>
                      <?php foreach ($images as $img): ?>
                        <li><img src="<?php echo $img->student_slide; ?>" alt="" /></li>
                      <?php endforeach ?>
                    </ul>
                  </div>
                  <div class="thumbs">
                    <?php foreach ($images as $img): ?>
                      <a href="#"><img src="<?php echo $img->student_thumb; ?>" alt="" /><span class="mask">&nbsp;</span></a>
                    <?php endforeach ?>
                    <div class="cl">&nbsp;</div>
                  </div>
                  <a style="clear:right;margin-top: 20px;" href="/student-life/student-gallery" class="blue-btn wordspace"><span>View Nossi Student Work</span></a>
                </div>
              <?php endif ?>
            <?php endif; ?>
						<div class="cnt" style="float:none;">
							<?php 
							$specialty = get_meta('_student_specialty'); 
							$class = get_meta('_student_class');
							?>

							<?php if ($specialty): ?>
								<h4><?php echo $specialty; ?></h4>
							<?php endif ?>
							<?php if ($class): ?>
								<h6><?php echo $class; ?></h6>
							<?php endif ?>
							<?php the_content(); ?>
						</div>
						<div class="cl">&nbsp;</div>
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
