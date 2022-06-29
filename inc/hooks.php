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

/**
 * Add admin notice.
 *
 * @since 2.3.8
 */
function date_today_nepali_add_admin_notice() {
	// Setup notice.
	\Nilambar\AdminNotice\Notice::init(
		array(
			'slug' => 'date-today-nepali',
			'name' => esc_html__( 'Date Today Nepali', 'date-today-nepali' ),
		)
	);
}

add_action( 'admin_init', 'date_today_nepali_add_admin_notice' );
