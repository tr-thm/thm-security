<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('plugins_loaded', ['THM\Security\DemoModule', 'plugins_loaded']);

class DemoModule
{
    public static function plugins_loaded()
    {
        $REQUEST_URI = $_SERVER['REQUEST_URI'];
        if (0 === stripos($REQUEST_URI, '/stop'))
        {
            status_header(403);
            echo('Stop!');
            exit;
        }
    }
}
