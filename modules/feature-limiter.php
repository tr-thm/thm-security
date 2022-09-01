<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('template_redirect', ['THM\Security\FeatureLimiter', 'template_redirect']);

/**
 * The purpose of this module is to disable some basic wordpress
 * functions that almost no one needs
 */
class FeatureLimiter
{
    /**
     * Entirely disables the author pages. It is not required
     * but since we already removed all links to those pages,
     * they serve no pupose anymore.
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
}
