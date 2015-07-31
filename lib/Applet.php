<?php

namespace UK;

class Applet
{
    /**
     * @var array applet registry by class name
     */
    private static $_applets = array();

    /**
     * @var array applet registry by slug
     */
    private static $_appletsByName = array();

    /**
     * @var array default spec
     */
    private $_defaults = array(
        'shortcode'   => true,
        'widget'      => true,
        'description' => '',
        'options'     => array(),
    );

    protected $_spec;

    /**
     * @var bool
     */
    protected $_rendered;

    /**
     * Get a specific applet instance using the applet's slug
     *
     * @param  string $name
     * @return object
     */
    public static function instance($name = null)
    {
        if($name)
            return isset(self::$_appletsByName[$name]) ? self::$_appletsByName[$name] : null;

        $c = get_called_class();

        if (!isset(self::$_applets[$c]))
        {
            self::$_applets[$c] = $applet = new $c;
            $spec = $applet->_init();

            if(!isset($spec['slug']))
                $spec['slug'] = self::_generateSlug($c);

            self::$_appletsByName[$spec['slug']] = $applet;

            $applet->_setup($spec);
        }

        return self::$_applets[$c];
    }

    /**
     * Register the concrete applet class
     *
     * @return object the created applet instance
     */
    public static function register()
    {
        return self::instance();
    }

    /**
     * Get all applet instances
     *
     * @return array
     */
    public static function instances()
    {
        return self::$_applets;
    }

    /**
     * The init function is expected to return
     * an array containing the applet's definiton
     *
     * @return array
     */
    protected function _init()
    {
        return array();
    }

    /**
     * The assets function is used to enqueue
     * applet-specific assets
     *
     * @return array
     */
    protected function _assets()
    {
        return array();
    }

    /**
     * Used to automatically generate an applet slug
     * based on its class name
     */
    private static function _generateSlug($c)
    {
        return str_replace('\\', '_', strtolower($c));
    }

    /**
     * Currently does nothing but merging the applet's
     * definition (see _init() with the defaults
     */
    private function _setup($spec)
    {
        $this->_spec = $spec += $this->_defaults;
    }

    /**
     * Get the applet definition
     */
    public function getSpec($key = null)
    {
        if(!$key)
            return $this->_spec;

        if(isset($this->_spec[$key]))
            return $this->_spec[$key];
    }

    /**
     * Get the applet's assets
     */
    public function getAssets()
    {
        return $this->_assets();
    }

    /**
     * Used by renderers to parse the invocation attributes
     */
    public function parseAttrs($attrs = array(), $defaults)
    {
        foreach($defaults as $section)
        {
            if(!is_array($section['options']))
                continue;

            foreach($section['options'] as $key => $opt)
            {
                if(empty($attrs[$key]) || ((!isset($opt['strict']) || $opt['strict'] !== false) && is_array($opt['items']) && !isset($opt['items'][$options[$key]])))
                    $attrs[$key] = isset($opt['default']) ? $opt['default'] : null;
                //else
                //    var_dump($key);
            }

        }

        //var_dump($attrs);

        return apply_filters('uk_applet_args', $attrs, $defaults);
    }

    /**
     * Render the applet using the specified attributes
     *
     * @param  array  $instance the attributes
     * @param  array  $context  context information
     * @return string the rendered output
     */
    public function render($instance, $context = array())
    {
        $this->_rendered = true;

        return $this->_render($this->parseAttrs($instance, $this->getSpec('options')), $context);
    }

    /**
     * Internal rendering function that's intended
     * to be overriden by the sub-class
     */
    protected function _render($instance, $context)
    {
    }

    /**
     * Check whether the applet was rendered at least once
     *
     * @return bool
     */
    public function wasRendered()
    {
        return !!$this->_rendered;
    }
}