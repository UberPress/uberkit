<?php

/**
 *
 * Checks if given array is a multiarray
 *
 * @since	0.5.0
 * @see		http://pageconfig.com/post/checking-multidimensional-arrays-in-php
 */

function is_multi_array( $array ) {
	
    rsort( $array );
    return isset( $array[0] ) && is_array( $array[0] );
	
}