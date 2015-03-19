<?php

namespace UK\Util;

class SafeGetterProxy
{
    protected $_obj;

    public function __construct($obj)
    {
        $this->_obj = $obj;
    }

    public function getObject()
    {
        return $this->_obj;
    }

    protected function _startsWith($haystack, $needle)
    {
        return !strncmp($haystack, $needle, strlen($needle));
    }

    public function __isset($key)
    {
        $method = 'get' . ucfirst(strtolower($key));

        return method_exists($this->_obj, $method);
    }

    public function __get($key)
    {
        $method = 'get' . ucfirst(strtolower($key));

        if(method_exists($this->_obj, $method))
            return call_user_func(array($this->_obj, $method));
    }

    public function __call($method, $args)
    {
        if($this->_startsWith($method, 'get') && method_exists($this->_obj, $method))
            return call_user_func(array($this->_obj, $method));
    }
}