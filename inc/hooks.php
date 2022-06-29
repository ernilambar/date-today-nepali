<?php
/**
 * Hooks
 *
 * @package Date_Today_Nepali
 */

/**
 * Load plugin textdomain.
 *
 * @since 1.0.0
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

/**
 * Customize plugin action links.
 *
 * @since 2.3.9
 *
 * @param array $actions Action links.
 * @return array Modified action links.
 */
function date_today_nepali_custom_action_links( $actions ) {
	$url = add_query_arg( array(
			'page' => 'date-today-nepali-welcome',
		),
		admin_url( 'options-general.php' )
	);

	$actions = array_merge(
		array(
			'welcome' => '<a href="' . esc_url( $url ) . '">' . esc_html__( 'Welcome', 'date-today-nepali' ) . '</a>',
		),
		$actions
	);

	return $actions;
}

add_filter( 'plugin_action_links_' . DATE_TODAY_NEPALI_BASE_FILENAME, 'date_today_nepali_custom_action_links' );
