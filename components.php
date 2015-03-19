<?php

/**
 * UK Components that should be always be loaded
 */
add_action('uk/loaded', function($uk)
{
    $uk->loadComponent('Compat')
       ->loadComponent('Widget');
});