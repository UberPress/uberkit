<?php

/**
 *
 * Plugin Name: 			UberKit
 * Plugin URI: 				http://uberkit.io
 *
 * Description: 			WordPress Framework
 * Version: 				0.8.1
 *
 * Author:					UberPress
 * Author URI: 				http://uberpress.io
 * Author Email: 			info@uberpress.io
 *
 * Text Domain: 			uberpress
 * Domain Path: 			/uberpress/lang
 *
 * Bitbucket Plugin URI:	uberpress/uberkit
 *
 */

require __DIR__ . '/lib/Plugin.php';

class UberKit extends UK\Plugin
{
    private $_loader;

    private $_components = array();

    const NS = 'UK';

    protected function _init()
    {
        $this->_setupLoader();

        require __DIR__ . '/components.php';

        do_action('uk/loaded', $this);

        add_action('plugins_loaded', function()
        {
            $this->_i18n();
            do_action('uk/init', $this);
        });
    }

    /**
     * Loads the translation files.
     *
     * @since  0.5.0
     * @access public
     * @return void
     */
    protected function _i18n() {

        /* Load the translation of the plugin. */
        load_plugin_textdomain( 'uberkit', false, 'uberkit/lang' );

    }

    private function _setupLoader()
    {
        $loader = $this->_loader = require __DIR__ . '/vendor/autoload.php';

        $loader->addPsr4(self::NS . '\\Component\\', __DIR__ . '/components');
        $loader->addPsr4(self::NS . '\\', __DIR__ . '/lib');
    }

    public function getLoader()
    {
        return $this->_loader;
    }

    public function getComponent($c)
    {
        if(!isset($this->_components[$c]))
        {
            $path = 'components/' . $c;

            $data = array(
                'name' => $c,
                'path' => $this->getPath($path) . '/',
                'url'  => $this->getUrl($path)  . '/',
            );

            $klass = '\\' . self::NS . '\\Component\\' . $c . '\Base';

            $this->_components[$c] = new $klass($this, $data);
        }

        return $this->_components[$c];
    }

    public function loadComponent($c)
    {
        if(is_array($c))
        {
            foreach($c as $v)
                $this->getComponent($v);
        }
        else
        {
            $this->getComponent($c);
        }

        return $this;
    }

    public function isComponentLoaded($c)
    {
        return isset($this->_components[$c]);
    }
}

UberKit::instance();
