<?php
/**
 * The WordPress Plugin
 *
 * @package   Date_Today_Nepali
 * @author    Nilambar Sharma<nilambar@outlook.com>
 * @license   GPL-2.0+
 * @link      http://nilambar.net
 * @copyright 2013 Nilambar Sharma
 *
 * @wordpress-plugin
 * Plugin Name:       Date Today Nepali
 * Plugin URI:        http://www.nilambar.net/2013/10/date-today-nepali-wordpress-plugin.html
 * Description:       A small plugin to display Nepali date.
 * Version:           1.0.2
 * Author:            Nilambar Sharma
 * Author URI:        http://nilambar.net/
 * Text Domain:       date-today-nepali-locale
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


require_once( plugin_dir_path( __FILE__ ) . 'class-date-today-nepali.php' );

/*
 * Register hooks that are fired when the plugin is activated or deactivated.
 * When the plugin is deleted, the uninstall.php file is loaded.
 */
register_activation_hook( __FILE__, array( 'Date_Today_Nepali', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'Date_Today_Nepali', 'deactivate' ) );

add_action( 'plugins_loaded', array( 'Date_Today_Nepali', 'get_instance' ) );

function load_date_today_nepali_widgets()
{
    include(plugin_dir_path( __FILE__ ) . "widgets/date-today-nepali.php");
    register_widget('DTN_Widget');
}
add_action('widgets_init', 'load_date_today_nepali_widgets');
