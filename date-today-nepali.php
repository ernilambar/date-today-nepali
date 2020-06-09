<?php
/**
 * Plugin Name: Date Today Nepali
 * Plugin URI: https://www.nilambar.net/2013/10/date-today-nepali-wordpress-plugin.html
 * Description: A small widget plugin to display Nepali date.
 * Version: 2.3.0
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

define( 'DATE_TODAY_NEPALI_NAME', 'Date Today Nepali' );
define( 'DATE_TODAY_NEPALI_SLUG', 'date-today-nepali' );
define( 'DATE_TODAY_NEPALI_BASENAME', basename( dirname( __FILE__ ) ) );
define( 'DATE_TODAY_NEPALI_DIR', rtrim( plugin_dir_path( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_URL', rtrim( plugin_dir_url( __FILE__ ), '/' ) );
define( 'DATE_TODAY_NEPALI_LIB_DIR', DATE_TODAY_NEPALI_DIR . '/lib' );
define( 'DATE_TODAY_NEPALI_CORE_DIR', DATE_TODAY_NEPALI_DIR . '/core' );

// Include core.
require_once DATE_TODAY_NEPALI_DIR . '/vendor/autoload.php';

/**
 * Load plugin textdomain.
 */
function date_today_nepali_load_textdomain() {
	load_plugin_textdomain( 'date-today-nepali' );
}

add_action( 'plugins_loaded', 'date_today_nepali_load_textdomain' );

/**
 * Register widgets.
 *
 * @since 1.0.0
 */
function date_today_nepali_load_widgets() {
	require DATE_TODAY_NEPALI_CORE_DIR . '/widget-date-today-nepali.php';
	register_widget( 'DTN_Widget' );
}

add_action( 'widgets_init', 'date_today_nepali_load_widgets' );

/**
 * Get example formats.
 *
 * @since 1.0.0
 *
 * @return array Example formats.
 */
function date_today_nepali_get_example_formats() {
	$output = array(
		array(
			'format' => 'd F Y',
			'label'  => '१८ जेठ २०७७',
		),
		array(
			'format' => 'F d, Y',
			'label'  => 'जेठ १८, २०७७',
		),
		array(
			'format' => 'Y F d',
			'label'  => '२०७७ जेठ १८',
		),
		array(
			'format' => 'l, d F Y',
			'label'  => 'आइतबार, १८ जेठ २०७७',
		),
		array(
			'format' => 'd.m.y',
			'label'  => '१८.०२.७७',
		),
		array(
			'format' => 'Y.m.d',
			'label'  => '२०७७.०२.१८',
		),
		array(
			'format' => 'D, d F',
			'label'  => 'आइत, १८ जेठ',
		),
		array(
			'format' => 'Y F d, l',
			'label'  => '२०७७ जेठ १८, आइतबार',
		),
	);

	return $output;
}
