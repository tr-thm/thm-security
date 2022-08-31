<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_filter('admin_notices',               ['THM\Security\UsernameEnumeration', 'admin_notices'],               10, 0);
add_filter('login_errors',                ['THM\Security\UsernameEnumeration', 'login_errors'],                10, 1);
add_filter('author_link',                 ['THM\Security\UsernameEnumeration', 'author_link'],                 10, 3); 
add_filter('the_author',                  ['THM\Security\UsernameEnumeration', 'the_author'],                  10, 1); 
add_filter('body_class',                  ['THM\Security\UsernameEnumeration', 'body_class'],                  10, 2);

/**
 * The purpose of this module is to prevent trivial ways to
 * acquire the usernames of this website
 */
class UsernameEnumeration
{
    /**
     * Display a warning in the admin panel in case a user has the same display
     * and login name.
     */
    public static function admin_notices()
    {
        $user = wp_get_current_user();

        if ($user->user_login === $user->display_name)
        {
            echo '
                <div class="notice notice-warning">
                    <p><strong>Warning:</strong> Your public display name is set the same as your login name. This is a security issue. Certain features of your account have been disabled until this problem is solved.</p>
                    <p>Please go to your <a href="/wp-admin/profile.php">profile</a> and change your display name.</p>
                </div>
            ';
        }
    }

    /**
     * Displays a neutral error message to the user, if a login attempt has failed.
     * 
     * This is supposed to make it a bit harder to figure out if a certain username
     * exists on this website.
     */
    public static function login_errors($error)
    {
        //Remove login codes from the global error object.
        //Prevents the autofocus in the login form
        global $errors;
        $errors->remove('invalid_username');
        $errors->remove('incorrect_password');

        $error = '<strong>Error</strong>: Invalid username, email address or password.';
        return $error;
    }
    
    /**
     * Prevents the author link creation from an author id.
     * 
     * This disables the 301-redirect from /?author=1 to /author/admin
     * It also removes the author link from Author Sitemap http://localhost/wp-sitemap-users-1.xml
     * It also removes the link on the author name below each post.
     * 
     * Affected URLs:
     * --- http://localhost/author/admin
     * --- http://localhost/?author=1
     * --- http://localhost/wp-sitemap-users-1.xml
     * --- http://localhost/hello-world/
     */
    public static function author_link($link, $author_id, $author_nicename )
    {
        return false;
    }

    /**
     * Prevent actual usernames from being displayed on the author pages
     * and in the Generator tag of the RSS feed.
     * 
     * Affected URLs:
     * --- http://localhost/author/admin
     * --- http://localhost/?author=1
     * --- http://localhost/feed/
     */
    public static function the_author($displayname)
    {
        if (username_exists($displayname))
        {
            $displayname = '';
        }
        return $displayname;
    }

    /**
     * Removes author-* classes from the body
     * 
     * Affected URLs:
     * --- http://localhost/author/admin
     * --- http://localhost/?author=1
     */
    public static function body_class($classes, $class)
    {
        return array_filter($classes, function($c) {
            return strpos($c, 'author-') !== 0;
        });
    }
}