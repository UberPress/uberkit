<?php

/**
 *
 * Get Option
 * This function is depreceated and will be removed shortly. Use uk_option() instead
 *
 * @depreceated
 *
 */

function encore_get_option( $key, $name = null, $default = null ) {
	
	if( WP_DEBUG == true ) {
		
		echo '<pre>';
		debug_print_backtrace();
		echo '</pre>';
		
		wp_die( 'The encore_option() and encore_get_option function is deprecated. Please use uk_option() and uk_get_option() instead' );
	
	}

	$val = vp_option( ( $name ? ( $key . '.' . $name ) : $key ) );
	
	return $val ? $val : $default;
	
}

function encore_option( $key, $name = null, $default = null ) {
	return encore_get_option( $key, $name, $default );
}



/**
 *
 * Get Meta
 * This function is depreceated and will be removed shortly. Use uk_meta() instead
 *
 * @depreceated
 *
 */

function encore_meta( $key, $subkey = null, $id = null ) {
	
	if( WP_DEBUG == true ) {
		
		echo '<pre>';
		debug_print_backtrace();
		echo '</pre>';
	
		wp_die( 'The encore_meta() function is deprecated. Please use uk_meta() instead' );
	
	}

	if( !$id )
		$id = get_the_ID();

	$meta = get_post_meta( $id, $key ,true);
	
	if( $subkey ) {
		if( is_array( $meta ) && isset( $meta[$subkey] ) ) {
			return $meta[$subkey];
		} else {
			return;
		}
	} else {
		return $meta;
	}

	
}