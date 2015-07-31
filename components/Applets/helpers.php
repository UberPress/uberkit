<?php

function the_applet($name, $attrs = array())
{
    if($applet = UK\Applet::instance($name))
        echo $applet->render($attrs, array('context' => 'tag'));  
}