<?php

$parse_uri = explode( 'wp-content', $_SERVER['SCRIPT_FILENAME'] );
require_once( $parse_uri[0] . 'wp-load.php' );

$uri = $_SERVER['REQUEST_URI'];

$filename = basename($uri);

if($filename == 'dynamic.css')
{
    //do_action('uk/assets/css');

    header('Content-Type: text/css');

    $content = apply_filters('uk/assets/css/contents', '');

    echo $content;
}
elseif($filename == 'dynamic.js')
{
    //do_action('uk/assets/js');
}
else
{
    status_header(404);
}