<?php

namespace UK\Component\Compat;

class Base
{
    public function __construct($uk, $data)
    {
        defined( 'ENCORE_PLUGIN_VERSION' ) || define( 'ENCORE_PLUGIN_VERSION', '0.5.0' );
        defined( 'ENCORE_PLUGIN_URL' )     || define( 'ENCORE_PLUGIN_URL', $data['url'] );
        defined( 'ENCORE_PLUGIN_DIR' )     || define( 'ENCORE_PLUGIN_DIR', $data['path'] );
        defined( 'ENCORE_PLUGIN_FILE' )    || define( 'ENCORE_PLUGIN_FILE', __FILE__ );

        defined( 'VP_PLUGIN_VERSION' ) or define( 'VP_PLUGIN_VERSION', ENCORE_PLUGIN_VERSION );
        defined( 'VP_PLUGIN_URL' )     or define( 'VP_PLUGIN_URL', ENCORE_PLUGIN_URL );
        defined( 'VP_PLUGIN_DIR' )     or define( 'VP_PLUGIN_DIR', ENCORE_PLUGIN_DIR );
        defined( 'VP_PLUGIN_FILE' )    or define( 'VP_PLUGIN_FILE', ENCORE_PLUGIN_FILE );


        require __DIR__ . '/framework/bootstrap.php';
        require __DIR__ . '/taxmeta/Tax-meta-class.php'; // specifically used for the menu categories (fabios menu)

        // this is a PHP 5.3+ function. should be more efficient than creating
        // empty sub classes
        class_alias('VP_Option',  'Encore_Option');
        class_alias('VP_Metabox', 'Encore_Metabox');
        class_alias('VP_ShortcodeGenerator', 'Encore_ShortcodeGenerator');

        require __DIR__ . '/helpers.php';
    }
}