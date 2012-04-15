<?php 
/*
Template Name: Events
*/
get_header(); 
?>
<!-- Main -->
<div id="main">
	<div class="shell">
		<div class="layout-switch">
			<span class="label">Grid View</span>
			<a href="#"><img src="<?php bloginfo('stylesheet_directory'); ?>/images/switch.png" alt="" /></a>
		</div>
		<div class="cl">&nbsp;</div>
		<div id="content">
			<div class="cbox">
				<div class="cbox-t"></div>
				<div class="cbox-c">
					<h1>Events<span>&nbsp;</span></h1>
					<div id="events-list" class="list">
						<?php $events = tribe_get_events(array(
							'eventDisplay'=>'upcoming',
							'posts_per_page' => -1
						)); 
						foreach ($events as $e): 
							$start = tribe_get_start_date($e->ID, false);
							$end = tribe_get_end_date($e->ID, false);
							$city = tribe_get_city($e->ID);
							$state = tribe_get_state($e->ID);
							?>
							<div class="event-article">
								<div class="top">
									<?php if (has_post_thumbnail($e->ID)): ?>
										<?php echo get_the_post_thumbnail($e->ID, 'event_thumb', array('class' => 'imgbg mini alignleft')); ?>
									<?php endif ?>
									<h4><?php echo $e->post_title; ?></h4>
									<?php if ($start): ?>
										<p><em>Start:</em>  <strong><?php echo $start; ?></strong></p>
									<?php endif ?>
									<?php if ($end): ?>
										<p><em>End:</em>  <strong><?php echo $end; ?></strong></p>
									<?php endif ?>
									<?php if ($city || $state): ?>
										<p><em>Location:</em>  <strong><?php echo $city; echo ($city && $state) ? ', ' : ''; echo $state; ?></strong></p>
									<?php endif ?>
									
									<a href="<?php echo get_permalink($e->ID) ?>ical/" class="more">Send to iCal<span class="arr">&nbsp;</span></a>
									<div class="cl">&nbsp;</div>
								</div>
								<div class="cnt">
									<?php echo wpautop($e->post_content); ?>
								</div>
							</div>
						<?php endforeach ?>
					</div>
          <?php
          if( is_singular('tribe_events')):
            the_post(); 
          ?>
          <div class="entry">
            <?php the_content(); ?>
          </div>
          <?php 
          else:
					  include(TribeEventsTemplates::getTemplateHierarchy('gridview'));
          endif; 
          ?>
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
