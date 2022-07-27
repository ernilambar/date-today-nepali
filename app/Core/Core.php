<?php
/**
 * Core
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali\Core;

use DateTodayNepali\Widgets\Dtn;

/**
 * Core class.
 *
 * @since 1.0.0
 */
class Core {
	/**
	 * Register.
	 *
	 * @since 2.3.8
	 */
	public function register() {
		add_action( 'plugins_loaded', array( $this, 'load_textdomain' ) );
		add_action( 'widgets_init', array( $this, 'register_widgets' ) );
	}

	/**
	 * Load plugin textdomain.
	 *
	 * @since 1.0.0
	 */
	public function load_textdomain() {
		load_plugin_textdomain( 'date-today-nepali' );
	}

	/**
	 * Register widgets.
	 *
	 * @since 1.0.0
	 */
	public function register_widgets() {
		register_widget( Dtn::class );
	}
}
