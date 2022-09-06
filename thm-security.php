<?php
/*
Plugin Name: THM Security
Description: A WordPress security plugin
Version: 1.0.1
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

require_once(dirname(__FILE__) . '/modules/demo.php');
require_once(dirname(__FILE__) . '/modules/feature-limiter.php');
require_once(dirname(__FILE__) . '/modules/username-enumeration.php');
require_once(dirname(__FILE__) . '/modules/log.php');
require_once(dirname(__FILE__) . '/modules/gui.php');
