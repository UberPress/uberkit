<?php

namespace UK;

class Widget extends \WP_Widget {
	
    public static function getInstanceById( $id ) {
        
		global $wp_registered_widgets;

        /**
         * WHO OF THOSES RETARDED CORE DEVELOPERS
         * DIDN'T GET THE CONCEPT OF OO WHEN IMPLEMENTING
         * THE WIDGET SYSTEM???
         *
         * WHY IS THERE A SHARED WIDGET CLASS INSTANCE
         * AMONG ALL VIRTUAL WIDGET "INSTANCES"
         * 
         * WHY DOES ONE NEED TO CALL "_set" ON THE WIDGET
         * CLASS INSTANCE TO TELL THE WIDGET ITS REAL IDENTITY?
         *
         * TELL ME.
         */

        if( isset( $wp_registered_widgets[$id] ) ) {
			
            $instance	= $wp_registered_widgets[$id];
            $class		= $instance['callback'][0];
            $number		= $instance['params'][0]['number'];

            $class->_set($number);

            return $class;
			
        }

        return false;
    }

    public function getSettings() {
		
        $settings = $this->get_settings();
        return $settings[$this->number];
		
    }

    public function getInstanceHash() {
		
        // just use any salt here...
        return md5( $this->id . NONCE_SALT );
		
    }

    // tiny utility function
    public static function getDefault( array $arr, $key, $default = '' ) {
        return isset( $arr[$key] ) ? $arr[$key] : $default;
    }
}
