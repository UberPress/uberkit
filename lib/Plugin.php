<?php

namespace UK;

use ReflectionClass;

class Plugin
{
    const DS = '/';

    private static $_instances = array();

    private $_reflectionClass;

    private $_basePath;
    private $_baseUrl;
    protected $_optionKey;

    private $_data;

    public static function instance()
    {
        $c = get_called_class();

        if (!isset(self::$_instances[$c]))
        {
            self::$_instances[$c] = $instance = new $c;
            $instance->_init();
        }

        return self::$_instances[$c];
    }

    public static function getInstance()
    {
        return self::instance();
    }

    protected function _init()
    {
    }

    protected function _getReflectionClass()
    {
        if(!$this->_reflectionClass)
            $this->_reflectionClass = new ReflectionClass($this);
        return $this->_reflectionClass;
    }

    public function getBaseName()
    {
        $rc = $this->_getReflectionClass();
        return basename(dirname($rc->getFileName()));
    }

    /**
     * Get plugin base file relative to wp-content/plugins:
     * example: myplugin/plugin.php
     */
    public function getBaseNameWP()
    {
        return $this->getBaseName() . '/plugin.php';
    }

    public function getUrl($url = null)
    {
        if(!$this->_baseUrl)
            $this->_baseUrl = WP_PLUGIN_URL . self::DS . $this->getBaseName() . self::DS;

        return $this->_baseUrl . $url;
    }

    public function getPath($path = null)
    {
        if(!$this->_basePath)
            $this->_basePath = dirname($this->_getReflectionClass()->getFileName()) . self::DS;

        return $this->_basePath . $path;
    }

    public function getData()
    {
        if(!$this->_data)
            $this->_data = get_plugin_data(WP_PLUGIN_DIR . self::DS . $this->getBaseNameWP());
        return $this->_data;
    }

    public function getOptionKey()
    {
        if(!$this->_optionKey)
            $this->_optionKey = str_replace('-', '_', $this->getBaseName()) . '_option';
        return $this->_optionKey;
    }

    public function getOption($key = null, $default = null)
    {
        $prefix = $this->getOptionKey();
        return encore_get_option($prefix, $key, $default);
    }

    public function __get($key)
    {
        $data = $this->getData();

        if(isset($data[$key]))
            return $data[$key];
    }

    public function __isset($key)
    {
        return isset($this->_data[$key]);
    }
}