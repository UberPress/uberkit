<?php

namespace UK\Util;

class HTTP
{
    public static function getCurrentURL()
    {
        global $wp;
        return add_query_arg($wp->query_string, '', home_url($wp->request));
    }

    public static function getMethod()
    {
        return strtoupper($_SERVER['REQUEST_METHOD']);
    }

    public static function isXmlHttpRequest()
    {
        return !empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest';
    }

    public static function isPost()
    {
        return self::getMethod() == 'POST';
    }
}