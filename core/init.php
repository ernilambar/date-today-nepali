<?php
/**
 * Initialization required for plugin.
 *
 * @package Date_Today_Nepali
 */

// Load libraries.
require_once( DATE_TODAY_NEPALI_LIB_DIR . '/nepali-calendar.php' );
require_once( DATE_TODAY_NEPALI_LIB_DIR . '/date-functions.php' );

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
