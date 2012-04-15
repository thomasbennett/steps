<div id="bottom-content">
	<div class="shell">
		<?php 
		$sidebar = false;
		if (is_page()) {
			$sidebar = get_meta('_custom_bottom_sidebar');
		}
		if (!$sidebar) {
			$sidebar = 'bottom-widgets';
		}
		dynamic_sidebar($sidebar);
		?>
		<div class="cl">&nbsp;</div>
	</div>			
</div>