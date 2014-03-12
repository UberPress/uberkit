<?php

/**
 *
 * Plugin Name: 	encore Framework
 * Plugin URI: 		-
 *
 * Description: 	Option and Metabox Framework 
 * Version: 		0.2.0
 *
 * Author:			ANEX
 * Author URI: 		http://anex.at
 * Author Email: 	info@anex.at
 *
 * Text Domain: 	encore
 * Domain Path: 	/encore/lang
 *
 */


/**
 * Setup Contants
 */

defined( 'VP_PLUGIN_VERSION' ) or define( 'VP_PLUGIN_VERSION', '0.2.0' );
defined( 'VP_PLUGIN_URL' )     or define( 'VP_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
defined( 'VP_PLUGIN_DIR' )     or define( 'VP_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'VP_PLUGIN_FILE' )    or define( 'VP_PLUGIN_FILE', __FILE__ );

defined( 'ENCORE_PLUGIN_VERSION' ) or define( 'ENCORE_PLUGIN_VERSION', '0.2.0' );
defined( 'ENCORE_PLUGIN_URL' )     or define( 'ENCORE_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
defined( 'ENCORE_PLUGIN_DIR' )     or define( 'ENCORE_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
defined( 'ENCORE_PLUGIN_FILE' )    or define( 'ENCORE_PLUGIN_FILE', __FILE__ );



/**
 * Load Languages
 */

//add_action('plugins_loaded', 'encore_load_textdomain');
//
//function encore_load_textdomain() {
//	load_plugin_textdomain( 'encore', false, dirname( plugin_basename( __FILE__ ) ) . '/lang/' ); 
//}



/**
 * Require Bootstrap
 */

require 'framework/bootstrap.php';



/**
 * Base Class
 */

class encore {
	
    /**
     * Initializes the plugin.
     */
    private function __construct() {
				
		// Internationalize the text strings used.
		add_action( 'plugins_loaded', array( $this, 'i18n' ), 2 );
		
    } // end constructor
	
	/**
	 * Loads the translation files.
	 *
	 * @since  0.1.0
	 * @access public
	 * @return void
	 */
	public function i18n() {

		/* Load the translation of the plugin. */
		load_plugin_textdomain( 'encore', false, 'encore/lang' );
	}

}



/**
 * Wrapper Function
 *
 * @since 0.1
 */

function encore_get_option( $key, $name ) {
	return vp_option( $key . '.' . $name );
}

function encore_option( $key, $name ) {
	return encore_get_option( $key . '.' . $name );
}


// this is a PHP 5.3+ function. should be more efficient than creating
// empty sub classes
class_alias('VP_Option',  'Encore_Option');
class_alias('VP_Metabox', 'Encore_Metabox');
class_alias('VP_ShortcodeGenerator', 'Encore_ShortcodeGenerator');
