<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );

add_action('plugins_loaded',['THM\Security\Log', 'plugins_loaded']);
add_action('wp_login_failed', ['THM\Security\Log', 'wp_login_failed'], 10, 2);
add_action('shutdown',['THM\Security\Log', 'shutdown']);

class Log
{
    private static $db_version = '1';
    public static $table_name = 'thm_security_log';

    /**
     * Checks if the database table is up-to-date.
     */
    public static function plugins_loaded()
	{
		if ( get_site_option( self::$table_name . '_db_version' ) != self::$db_version )
		{
			self::install();
		}
	}

    /**
     * Create or updates the database table and stores the db version
     * in the site options.
     */
    private static function install()
	{
		global $wpdb;
        $db = $wpdb->prefix . self::$table_name;
		
		$charset_collate = $wpdb->get_charset_collate();
		
		$table = "CREATE TABLE $db (
			time TIMESTAMP DEFAULT CURRENT_TIMESTAMP NOT NULL,
            client VARCHAR(32) NOT NULL,
            url VARCHAR(255) NOT NULL
		) $charset_collate;";
        dbDelta( $table );

		update_option( self::$table_name . '_db_version', self::$db_version );
	}

    /**
     * Example code to show how to retrieve data from the table.
     */
    public static function query_requests_by_client($client)
    {
        global $wpdb;
        $db = $wpdb->prefix . self::$table_name;

        $sql = $wpdb->prepare("SELECT * FROM $db WHERE client = %s;", $client);
        return $wpdb->get_results($sql, ARRAY_A);
    }

    /**
     * Callback to handle the event of a failed login attempt.
     * 
     * @param string   $username Username or email address.
     * @param WP_Error $error    A WP_Error object with the authentication failure details.
     */
    public static function wp_login_failed($username, $error)
    {

    }

    /**
     * The shutdown action is always called, even on fatal errors, Ajax requests,
     * and when using exit; or die(); to terminate a running request.
     *
     * That makes this function perfect for a “catch-all” logic, like writing a log file.
     */
    public static function shutdown()
    {
        global $wpdb;
        $db = $wpdb->prefix . self::$table_name;
        $client = sanitize_text_field($_SERVER['REMOTE_ADDR']);
        $url = sanitize_text_field($_SERVER['REQUEST_URI']);

        $wpdb->insert($db, [
            'client' => $client,
            'url' => $url
        ]);
    }
}
