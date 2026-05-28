<?php



/**
 * Move Yoast Meta Box to the bottom
 */
add_filter(
	'wpseo_metabox_prio',
	function () {
		return 'low';
	},
	10
);



/**
 * Remove Yoast settings from admin bar
 */
add_action(
	'wp_before_admin_bar_render',
	function () {
		global $wp_admin_bar;

		$wp_admin_bar->remove_menu( 'wpseo-menu' );
	},
	999
);
