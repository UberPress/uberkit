<?php

namespace UK\Util;

class Singleton
{
    private static $_instances;

    public static function getInstance()
    {
        $c = get_called_class();

        if (!isset(self::$_instances[$c]))
            self::$_instances[$c] = new $c;
        return self::$_instances[$c];
    }
}