<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('login_errors', ['TR\Security\UsernameEnumerationPreventer', 'login_errors'], 10, 1);

class UsernameEnumeration
{
    /**
     * Display a neutral error message to the user, if a login attempt has failed.
     * This is supposed to make it a bit harder to figure out if a certain username
     * exists on this website.
     */
    public static function login_errors($error)
    {
        $error = '<strong>Error</strong>: Invalid username, email address or incorrect password.';
        return $error;
    }
}