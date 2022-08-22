<form action="<?php echo home_url('/'); ?>" method="get" class="search-form">
	<input type="text" name="s" id="s" value="<?php echo get_search_query(); ?>" class="search-field" placeholder="<?php esc_attr_e('Type to start your search...', 'breek'); ?>" aria-label="<?php esc_attr_e('Type to start your search...', 'breek'); ?>" required>
	<button type="submit" class="submit" aria-label="<?php esc_attr_e('Submit', 'breek'); ?>"><i class="remixicon remixicon-search-line"></i></button>
</form>
