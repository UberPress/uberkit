<?php

/**
 * Get Option
 *
 * @since	0.5.0
 *
 * @param	string			$key
 * @param	string			$name
 * @param	string|array	$default
 *
 */

function uk_option( $key, $name = null, $default = null ) {
	
	$value = vp_option( ( $name ? ( $key . '.' . $name ) : $key ) );
	
	return $value ? $value : $default;
	
}



/**
 *
 * Get Meta
 *
 * @since	0.5.0
 *
 * @param 	string 	$key
 * @param 	string 	$subkey
 * @param 	string 	$id
 *
 * @todo	add additional parameter for default value
 *
 */

function uk_meta( $key, $subkey = null, $id = null ) {

	if( !$id )
		$id = get_the_ID();

	$meta = get_post_meta( $id, $key, true );
	
	if( $subkey ) {
		
		if( is_array( $meta ) && isset( $meta[$subkey] ) )
			return $meta[$subkey];
		
		return;
		
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
 * @param	string	$operator
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
 * Convert Array into proper format for UberKit (VafPress)
 * 
 * This function can be used for the options.
 * It converts an array into the proper format to be used within the framework
 *
 * @since	0.5.0
 *
 * @param	array	$data
 * @param	bool	$image
 *
 * @return	array
 *
 */

function uk_options_build_array( $data ) {
	
	// create empty array to fill
	$options = array();
	
	// loop through $data and fill $options array with the necessary data
	if( is_multi_array( $data ) ) {
		
		foreach( $data as $key => $value ) {
			
			$value['value']	= $key;
			$options[] = $value;
			
		}
		
	} else {
		
		foreach( $data as $key => $value ) {
			
			$options[] = array(
				'label'	=> $value,
				'value'	=> $key
			);
			
		}
		
	}
	
	
	// return formatted array
	return $options;
	
}


/**
 *
 * Sort an array by another array
 * This function sorts an array based on another array.
 * 
 * @since	0.5.0
 * 
 */
 
if( ! function_exists( 'sort_array_by_array' ) ) {
	
	function sort_array_by_array( $array, $orderArray ) {
		
		// create empty array
		$ordered = array();
		
		// loop through arrays
		foreach( $orderArray as $key )
			if( isset( $array[$key] ) )
				$ordered[$key] = $array[$key];
		
		// return ordered array
		return $ordered;
		
	}
	
}



/**
 *
 * Helper function to
 * sort array by position key
 *
 * @since	0.5.0
 * @see		http://docs.php.net/manual/en/function.array-multisort.php
 */

if( ! function_exists( 'sort_array_by_position' ) ) {
	
	function sort_array_by_position( $array = array(), $order = SORT_NUMERIC ) {
	
		if( ! is_array( $array ) )
			return;
	
		// Sort array by position
			
		$position = array();
		
		foreach ( $array as $key => $row ) {
			
			if( empty( $row['position'] ) )
				$row['position'] = 1000;
			
			$position[$key] = $row['position'];
		}
		
		array_multisort( $position, $order, $array );
		
		return $array;
	
	}
	
}




/**
 *
 * hex2rgba()
 * Convert HEX to RGBA
 *
 * @param	string	$color
 * @param	string	$opacity
 *
 * @since	0.5.0
 *
 */

if( ! function_exists( 'hex2rgba' ) ) {
	
	function hex2rgba( $color, $opacity = false ) {
	
		$default = 'rgb(0,0,0)';
	
		//Return default if no color provided
		if( empty( $color ) )
			  return; 
	
		//Sanitize $color if "#" is provided 
		if ( $color[0] == '#' ) {
			$color = substr( $color, 1 );
		}
	
		//Check if color has 6 or 3 characters and get values
		if (strlen($color) == 6) {
			$hex = array( $color[0] . $color[1], $color[2] . $color[3], $color[4] . $color[5] );
		} elseif ( strlen( $color ) == 3 ) {
			$hex = array( $color[0] . $color[0], $color[1] . $color[1], $color[2] . $color[2] );
		} else {
			return $default;
		}
	
		//Convert hexadec to rgb
		$rgb =  array_map('hexdec', $hex);
	
		//Check if opacity is set(rgba or rgb)
		if( $opacity ){
			if( abs( $opacity ) > 1)
				$opacity = 1.0;
			$output = 'rgba('.implode( ",",$rgb ).','.$opacity.')';
		} else {
			$output = 'rgb('.implode( ",",$rgb ).')';
		}
	
		//Return rgb(a) color string
		return $output;
		
	}
	
}



/**
 *
 * rgb2rgba()
 * Convert RGB to RGBA
 *
 * @param	string	$color
 * @param	string	$opacity
 *
 * @since	0.5.0
 *
 */

if( ! function_exists( 'rgb2rgba' ) ) {
	
	function rgb2rgba( $color, $opacity = false ) {
		
		$default = 'rgb(0,0,0)';
	
		// Abort if no color provided
		if( empty( $color ) )
			  return; 
			  
		// Sanitize $color if "rgba()" is provided 
		$color = substr( $color, 4, -1 );
	
		// Check if opacity is set(rgba or rgb)
		if( $opacity ) {
			
			if( abs( $opacity ) > 1)
				$opacity = 1.0;
				
			$output = 'rgba(' . $color . ',' . $opacity . ')';
			
		} else {
			
			$output = 'rgb(' . $color . ')';
			
		}
	
		// Return rgb(a) color string
		return $output;
		
	}
	
}