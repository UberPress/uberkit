<?php

namespace UK\Component\Compat;

class Base {
	
    public function __construct( $uk, $data ) {
		
        defined( 'UK_PLUGIN_VERSION' )		|| define( 'UK_PLUGIN_VERSION', '0.10.0' );
        defined( 'UK_PLUGIN_URL' )			|| define( 'UK_PLUGIN_URL', $data['url'] );
        defined( 'UK_PLUGIN_DIR' )			|| define( 'UK_PLUGIN_DIR', $data['path'] );
        defined( 'UK_PLUGIN_FILE' )			|| define( 'UK_PLUGIN_FILE', __FILE__ );

        defined( 'VP_PLUGIN_VERSION' )		|| define( 'VP_PLUGIN_VERSION', UK_PLUGIN_VERSION );
        defined( 'VP_PLUGIN_URL' )			|| define( 'VP_PLUGIN_URL', UK_PLUGIN_URL );
        defined( 'VP_PLUGIN_DIR' )			|| define( 'VP_PLUGIN_DIR', UK_PLUGIN_DIR );
        defined( 'VP_PLUGIN_FILE' )			|| define( 'VP_PLUGIN_FILE', UK_PLUGIN_FILE );

        defined( 'ENCORE_PLUGIN_VERSION' )	|| define( 'ENCORE_PLUGIN_VERSION', UK_PLUGIN_VERSION );
        defined( 'ENCORE_PLUGIN_URL' )		|| define( 'ENCORE_PLUGIN_URL', UK_PLUGIN_URL );
        defined( 'ENCORE_PLUGIN_DIR' )		|| define( 'ENCORE_PLUGIN_DIR', UK_PLUGIN_DIR );
        defined( 'ENCORE_PLUGIN_FILE' )		|| define( 'ENCORE_PLUGIN_FILE', UK_PLUGIN_FILE );

        require __DIR__ . '/framework/bootstrap.php';
        require __DIR__ . '/taxmeta/Tax-meta-class.php'; // specifically used for the menu categories (fabios menu)
       
	    require __DIR__ . '/functions.base.php';
        require __DIR__ . '/functions.admin.php';
        require __DIR__ . '/functions.helpers.php';
        require __DIR__ . '/functions.depreceated.php';

        // this is a PHP 5.3+ function. should be more efficient than creating
        // empty sub classes
        class_alias( 'VP_Option', 'UK_Option' );
        class_alias( 'VP_Metabox', 'UK_Metabox' );
        class_alias( 'VP_ShortcodeGenerator', 'UK_ShortcodeGenerator' );
       
	    class_alias( 'VP_View', 'UK_View' );
	    class_alias( 'VP_Util_Config', 'UK_Util_Config' );

        class_alias( 'VP_Option',  'Encore_Option' );
        class_alias( 'VP_Metabox', 'Encore_Metabox' );
        class_alias( 'VP_ShortcodeGenerator', 'Encore_ShortcodeGenerator' );
		
    }
	
}