<?php

/**
 * Get Option
 *
 * @param	string			$key
 * @param	string			$name
 * @param	string|array	$default
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
 *
 * Get Post Meta
 *
 * @param 	string 	$key
 * @param 	string 	$subkey
 * @param 	string 	$id
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

/**
 *
 * Get Post Types in Array for Options
 * 
 * This function can be used for the options.
 * It takes the same parameters as the native get_post_type function
 * excerpt the $output parameter (which can be names or objects). This is set to objects
 * since this is important for this function to work properly.
 *
 * @since	0.5.0
 *
 * @param	array	$args
 * @param	string	$perator
 *
 * @return	array
 *
 * @see		https://codex.wordpress.org/Function_Reference/get_post_types
 *
 */

function uk_options_post_types( $args = array(), $operator = 'and' ) {
	
	// get post types
	$types = get_post_types( $args, 'objects', $operator );
	
	// create empty option array to fill
	$options = array();
	
	// loop through post types and fill options array with the necessary data
	foreach( $types as $key => $value ) {
		
		$options[] = array(
			'label'	=> $value->labels->name,
			'value'	=> $key
		);
		
	}
	
	// return options
	return $options;
	
}

/**
 *
 * Get Option
 * This function is depreceated and will be removed shortly. Use uk_get_option() instead
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
 * This function is depreceated and will be removed shortly. Use uk_get_option() instead
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
