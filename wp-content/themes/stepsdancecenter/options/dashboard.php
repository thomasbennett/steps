<?php 

if(is_admin()):

  # content in welcome
	$welcome = '<img src="'.get_template_directory_uri().'/images/logo.jpg" width="170" style="float:left;border:2px solid #ccc;" /><div class="welcome-panel-content"> <h3>Welcome to your Dashboard!</h3> <p class="about-description">If you need help getting started, check out the documentation for <a href="http://steps.dev/wp-admin/admin.php?page=theme-readme">Your Theme Help</a>. If you&#8217;d rather dive right in, here are a few things most people do first when they set up a new WordPress site. If you need help, use the Help tabs in the upper right corner to get information on how to use your current screen and where to go for more assistance.</p> </div> ';

?>

<script>
  jQuery(function($){
    $('#welcome-panel').html('<?php echo $welcome ?>');
  });
</script>

<?php endif; ?>
