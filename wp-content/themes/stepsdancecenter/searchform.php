<div class="searchform">
	<form action="<?php echo home_url('/'); ?>">
		<input type="text" class="field" title="SEARCH" value="<?php echo get_search_query() ? get_search_query() : 'SEARCH'; ?>" name="s" />
		<input type="submit" value="Submit" class="submit notext" />
	</form>
</div>