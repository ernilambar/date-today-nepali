<?php
/**
 * Plugin Name: Date Today Nepali
 * Plugin URI: https://www.nilambar.net/2013/10/date-today-nepali-wordpress-plugin.html
 * Description: A small widget plugin to display Nepali date.
 * Version: 2.3.7
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * Text Domain: date-today-nepali
 * License: GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 *
 * @package Date_Today_Nepali
 */

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DATE_TODAY_NEPALI_BASENAME', basename( dirname( __FILE__ ) ) );
define( 'DATE_TODAY_NEPALI_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

// Include files.
require_once DATE_TODAY_NEPALI_DIR . '/vendor/autoload.php';
require_once DATE_TODAY_NEPALI_DIR . '/inc/helpers.php';
require_once DATE_TODAY_NEPALI_DIR . '/inc/hooks.php';
