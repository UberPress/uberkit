<?php

/**
 * Get WP Admin Color Scheme
 *
 * @since 0.8.6
 *
 * @return array
 *
 */

add_action( 'admin_head', 'uk_get_wp_admin_color_scheme' );

function uk_get_wp_admin_color_scheme() {
	
	global $_wp_admin_css_colors;
	$current_color = get_user_option( 'admin_color', get_current_user_id() );
		
	return $_wp_admin_css_colors[$current_color];
			
}

/**
 * Create dynamic CSS based on scheme
 *
 * @since 0.8.6
 *
 * @return array
 *
 */

add_action( 'admin_head', 'uk_color_scheme' );

function uk_color_scheme() {
	
	$scheme = uk_get_wp_admin_color_scheme();
	
	$color = $scheme->colors[3];
	
	echo '<style type="text/css">
	.vp-wrap .vp-menus li.vp-current > a.vp-menu-goto {
		border-left-color: ' . $color . ';
	} 
	.vp-wrap a {
		color: ' . $color . ';
	}
	.vp-wrap .vp-submit .vp-button:hover {
		background: ' . $color . ';
	}
	</style>';
  
}