<?php

namespace THM\Security;

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

add_action('plugins_loaded',    ['THM\Security\Cron', 'plugins_loaded']);
add_filter('cron_schedules',    ['THM\Security\Cron', 'schedules']);
add_action('thm_security_task', ['THM\Security\Cron', 'task']);

class Cron
{
    /**
     * Once all plugins are loaded, we check if our scheduled task is already registered.
     * If not we register it.
     */
    public static function plugins_loaded()
    {
        $args = [false];
        if (!wp_next_scheduled( 'thm_security_task', $args))
        {
            wp_schedule_event(time(), '5min', 'thm_security_task', $args);
        }
    }

    /**
     * This specifies the interval we would like to run our task at.
     * Some of those constants like '1min' or '10min' might already exist.
     * We conditionally add ours here only if it does not yet exist.
     */
    public static function schedules($schedules)
    {
        if (!isset($schedules['5min']))
        {
            $schedules['5min'] = array(
                'interval' => 5*60,
                'display' => __('Once every 5 minutes'));
        }
        return $schedules;
    }

    /**
     * This is the actual task, that gets executed regularly.
     * To debug this, I recommend the free 'WP Crontrol' plugin.
     */
    public static function task()
    {
        //this runs every 5 minutes in the background
    }
}