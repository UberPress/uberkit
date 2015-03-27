<?php

namespace UK\Component\Assets;

class Base
{
    const URL_KEY = '__uberkit_assets';

    const REWRITE_PATTERN = 'FOO\.(css|js)$';

    protected $_basePath;

    public function __construct( $uk, $data )
    {
        $this->_basePath = $data['path'];

        add_action('generate_rewrite_rules', array($this, 'generateRewriteRules'));

        /*
        add_action('query_vars', array($this, 'queryVars'));
        add_action('parse_request', array($this, 'parseRequest'));


        add_action('init', function()
        {
            //flush_rewrite_rules();
        });
        */
    }

    public function generateRewriteRules($rewrite)
    {
        $path = str_replace(ABSPATH, '', $this->_basePath);

        $rules = array(
            'uberkit\/assets\/dynamic\.(css|js)' => $path . 'server/index.php',
        );

        // Always add your rules to the top, to make sure your rules have priority
        $rewrite->non_wp_rules = $rules + $rewrite->non_wp_rules;
    }

    public function getServerUrl()
    {
        return site_url('foo');
    }

    public function queryVars($vars)
    {
        $vars[] = self::URL_KEY;
        return $vars;
    }

    public function parseRequest($wp)
    {
        if(isset($wp->query_vars[self::URL_KEY]))
        {
            $this->_serveAssets($wp->query_vars[self::URL_KEY]);
            exit;
        }
    }

    protected function _response($code)
    {
        status_header($code);

        exit;
    }

    protected function _serveAssets($path)
    {
        $info = pathinfo($path);

        $ext  = $info['extension'];

        if(!in_array($ext, array('css', 'js')))
            $this->_response(404);

        die("hi");
    }
}