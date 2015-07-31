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
 * HEX to RGBA
 * Convert HEX color value to RGBA color value
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
 * RGB to RGBA
 * Convert RGB color value to RGBA color value
 *
 * @param	string	$color
 * @param	string	$opacity
 *
 * @since	0.5.0
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


/**
 * Color Shade
 * Calculates color shades of a given color
 *
 * @param	array	$rgb	- define a rgb color code
 * @param	string	$type	- choose lighter or leave empty
 * @param	int		$change - defines the change of the base color (eg. 255 -> 250)
 *
 * @since	0.6.0
 */

if( ! function_exists( 'color_shade' ) ) {
	
	function color_shade( array $rgb, $type, $change = 5 ) {
	
		 if( $type == 'lighter' ) {
			 
			$rgb[0] = 255-( 255-$rgb[0] ) + $change;
			$rgb[1] = 255-( 255-$rgb[1] ) + $change;
			$rgb[2] = 255-( 255-$rgb[2] ) + $change;
	
		 } else {
			 
			 $rgb[0] -= $change;
			 $rgb[1] -= $change;
			 $rgb[2] -= $change;
			 
		 }
	
		 return $rgb;
		 
	}
	
}

/**
 * String to RGB
 * Converts a given string to a RGB Color Value
 *
 * @param	array	$str
 *
 * @since	0.6.0
 */
if( ! function_exists( 'str_to_rgb' ) ) {
	
	function str_to_rgb( $str ) {
		
		if( is_array( $str ) )
			return $str;
	
		$str = preg_replace( '/\s+/', '', $str ); // replace all spaces
	
		$str = str_replace( array( 'rgba(', 'rgb(', ')' ), '', $str );
	
		$comp = explode( ',', $str, 4 );
		$cnt  = count( $comp );
	
		if( $cnt < 3 || $cnt > 4 )
			return array( 0,0,0 );
	
		return array_map( 'floatval', $comp );
		
	}
	
}

/**
 * String to RGB
 * Converts a given string to a RGB Color Value
 *
 * @param	array	$str
 *
 * @since	0.6.0
 */
if( ! function_exists( 'rgb_to_str' ) ) {
	
	function rgb_to_str( $rgb, $raw = false ) {
		
		$str = implode( ',', $rgb );
	
		if( $raw )
			return $str;
	
		return ( ( count( $rgb ) == 3 ) ? 'rgb(' : 'rgba(' ) . $str . ')';
		
	}
	
}

/**
 * Animation Effects
 * for use with animate.css
 *
 * @param	array	$effects
 *
 * @since	0.7.0
 */
if( ! function_exists( 'uk_animation_effects' ) ) {

	function uk_animation_effects() {
		
		$effects = array(
		
			'bounce'				=> 'bounce',
			'flash'					=> 'flash',
			'pulse'					=> 'pulse',
			'rubberBand'			=> 'rubberBand',
			'shake'					=> 'shake',
			'swing'					=> 'swing',
			'tada'					=> 'tada',
			'wobble'				=> 'wobble',
			'jello'					=> 'jello',
			'bounceIn'				=> 'bounceIn',
			'bounceInDown'			=> 'bounceInDown',
			'bounceInLeft'			=> 'bounceInLeft',
			'bounceInRight'			=> 'bounceInRight',
			'bounceInUp'			=> 'bounceInUp',
			'bounceOut'				=> 'bounceOut',
			'bounceOutDown'			=> 'bounceOutDown',
			'bounceOutLeft'			=> 'bounceOutLeft',
			'bounceOutRight'		=> 'bounceOutRight',
			'bounceOutUp'			=> 'bounceOutUp',
			'fadeIn'				=> 'fadeIn',
			'fadeInDown'			=> 'fadeInDown',
			'fadeInDownBig'			=> 'fadeInDownBig',
			'fadeInLeft'			=> 'fadeInLeft',
			'fadeInLeftBig'			=> 'fadeInLeftBig',
			'fadeInRight'			=> 'fadeInRight',
			'fadeInRightBig'		=> 'fadeInRightBig',
			'fadeInUp'				=> 'fadeInUp',
			'fadeInUpBig'			=> 'fadeInUpBig',
			'fadeOut'				=> 'fadeOut',
			'fadeOutDown'			=> 'fadeOutDown',
			'fadeOutDownBig'		=> 'fadeOutDownBig',
			'fadeOutLeft'			=> 'fadeOutLeft',
			'fadeOutLeftBig'		=> 'fadeOutLeftBig',
			'fadeOutRight'			=> 'fadeOutRight',
			'fadeOutRightBig'		=> 'fadeOutRightBig',
			'fadeOutUp'				=> 'fadeOutUp',
			'fadeOutUpBig'			=> 'fadeOutUpBig',
			'flipInX'				=> 'flipInX',
			'flipInY'				=> 'flipInY',
			'flipOutX'				=> 'flipOutX',
			'flipOutY'				=> 'flipOutY',
			'lightSpeedIn'			=> 'lightSpeedIn',
			'lightSpeedOut'			=> 'lightSpeedOut',
			'rotateIn'				=> 'rotateIn',
			'rotateInDownLeft'		=> 'rotateInDownLeft',
			'rotateInDownRight'		=> 'rotateInDownRight',
			'rotateInUpLeft'		=> 'rotateInUpLeft',
			'rotateInUpRight'		=> 'rotateInUpRight',
			'rotateOut'				=> 'rotateOut',
			'rotateOutDownLeft'		=> 'rotateOutDownLeft',
			'rotateOutDownRight'	=> 'rotateOutDownRight',
			'rotateOutUpLeft'		=> 'rotateOutUpLeft',
			'rotateOutUpRight'		=> 'rotateOutUpRight',
			'hinge'					=> 'hinge',
			'rollIn'				=> 'rollIn',
			'rollOut'				=> 'rollOut',
			'zoomIn'				=> 'zoomIn',
			'zoomInDown'			=> 'zoomInDown',
			'zoomInLeft'			=> 'zoomInLeft',
			'zoomInRight'			=> 'zoomInRight',
			'zoomInUp'				=> 'zoomInUp',
			'zoomOut'				=> 'zoomOut',
			'zoomOutDown'			=> 'zoomOutDown',
			'zoomOutLeft'			=> 'zoomOutLeft',
			'zoomOutRight'			=> 'zoomOutRight',
			'zoomOutUp'				=> 'zoomOutUp',
			'slideInDown'			=> 'slideInDown',
			'slideInLeft'			=> 'slideInLeft',
			'slideInRight'			=> 'slideInRight',
			'slideInUp'				=> 'slideInUp',
			'slideOutDown'			=> 'slideOutDown',
			'slideOutLeft'			=> 'slideOutLeft',
			'slideOutRight'			=> 'slideOutRight',
			'slideOutUp'			=> 'slideOutUp'
			
		);
		
		return $effects;
		
	}
	
}