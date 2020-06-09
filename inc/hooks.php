<?php
/**
 * Hooks
 *
 * @package Date_Today_Nepali
 */

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
	require DATE_TODAY_NEPALI_DIR . '/inc/class-dtn-widget.php';

	register_widget( 'DTN_Widget' );
}

add_action( 'widgets_init', 'date_today_nepali_load_widgets' );
