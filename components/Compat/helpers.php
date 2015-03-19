<?php

/**
 * Get Option
 *
 * @param $key		string
 * @param $name		string
 * @param $default	string|array
 *
 * @since 0.5.0
 */

function uk_get_option( $key, $name = null, $default = null ) {
	
	$val = vp_option( ( $name ? ( $key . '.' . $name ) : $key ) );
	
	return $val ? $val : $default;
	
}

function uk_option( $key, $name = null, $default = null ) {
	
	return uk_get_option( $key, $name, $default );
	
}


/**
 * Get Post Meta
 *
 * @param $key		string
 * @param $subkey	string
 * @param $id		string
 *
 * @since 0.5.0
 */

function uk_meta( $key, $subkey = null, $id = null ) {

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

function encore_get_option( $key, $name = null, $default = null ) {
	
	$val = vp_option( ( $name ? ( $key . '.' . $name ) : $key ) );
	
	return $val ? $val : $default;
	
}

function encore_option( $key, $name = null, $default = null ) {
	return encore_get_option( $key, $name, $default );
}

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
