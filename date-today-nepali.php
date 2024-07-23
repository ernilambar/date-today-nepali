<?php
/**
 * Plugin Name: Date Today Nepali
 * Plugin URI: https://www.nilambar.net/2013/10/date-today-nepali-wordpress-plugin.html
 * Description: A small widget plugin to display Nepali date.
 * Version: 3.1.1
 * Requires at least: 6.3
 * Requires PHP: 7.2
 * Author: Nilambar Sharma
 * Author URI: https://www.nilambar.net/
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: date-today-nepali
 * Domain Path: /languages
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'DATE_TODAY_NEPALI_VERSION', '3.1.1' );
define( 'DATE_TODAY_NEPALI_BASE_NAME', basename( __DIR__ ) );
define( 'DATE_TODAY_NEPALI_BASE_FILEPATH', __FILE__ );
define( 'DATE_TODAY_NEPALI_BASE_FILENAME', plugin_basename( __FILE__ ) );
define( 'DATE_TODAY_NEPALI_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );

if ( ! defined( 'WP_WELCOME_DIR' ) ) {
	define( 'WP_WELCOME_DIR', DATE_TODAY_NEPALI_DIR . '/vendor/ernilambar/wp-welcome' );
}

if ( ! defined( 'WP_WELCOME_URL' ) ) {
	define( 'WP_WELCOME_URL', DATE_TODAY_NEPALI_URL . '/vendor/ernilambar/wp-welcome' );
}

// Include autoload.
if ( file_exists( DATE_TODAY_NEPALI_DIR . '/vendor/autoload.php' ) ) {
	require_once DATE_TODAY_NEPALI_DIR . '/vendor/autoload.php';
	require_once DATE_TODAY_NEPALI_DIR . '/vendor/ernilambar/wp-welcome/init.php';
}

if ( class_exists( 'DateTodayNepali\Init' ) ) {
	Init::register_services();
}
