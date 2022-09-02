<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('template_redirect', ['THM\Security\FeatureLimiter', 'template_redirect']);
add_filter('xmlrpc_enabled', ['THM\Security\FeatureLimiter', 'xmlrpc_enabled']);

/**
 * The purpose of this module is to disable some basic wordpress
 * functions that almost no one needs
 */
class FeatureLimiter
{
    /**
     * Entirely disables the author pages. It is not required
     * but since we already removed all links to those pages,
     * they serve no purpose anymore.
     * 
     * Affected URLs:
     * --- http://localhost/author/admin
     * --- http://localhost/?author=1
     */
    public static function template_redirect()
    {
        if (is_author())
        {
            global $wp_query;
            $wp_query->set_404();
        }
    }

    /**
     * Disables the XMLRPC Interface. It has been replaced by the newer
     * REST API and is no longer needed.
     * 
     * It is frequently used for bruteforce or ddos attacks.
     */
    public static function xmlrpc_enabled($enabled)
    {
        $enabled = false;
        return $enabled;
    }
}
