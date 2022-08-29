<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('plugins_loaded', ['THM\Security\DemoModule', 'plugins_loaded']);

class DemoModule
{
    public static function plugins_loaded()
    {
        $REQUEST_URI = $_SERVER['REQUEST_URI'];
        if (strpos($REQUEST_URI, '/wp-json') === 0)
        {
            status_header(403);
            echo('Stop!');
            exit;
        }
    }
}
