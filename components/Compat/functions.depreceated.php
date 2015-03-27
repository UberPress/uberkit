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