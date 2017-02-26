<?php

/**
 * UK Components that should always be loaded
 */
add_action('uk/loaded', function($uk)
{
    $uk->loadComponent('Compat')
       ->loadComponent('Widget')
       ->loadComponent('Applets');
       //->loadComponent('Customize');

       //->loadComponent('Assets');
	   
}, 1);