<?php
/**
 * Admin
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali\Admin;

use Nilambar\AdminNotice\Notice;

/**
 * Admin class.
 *
 * @since 1.0.0
 */
class Admin {
	/**
	 * Register.
	 *
	 * @since 2.3.8
	 */
	public function register() {
		add_action( 'admin_init', array( $this, 'add_admin_notice' ) );
		add_filter( 'plugin_action_links_' . DATE_TODAY_NEPALI_BASE_FILENAME, array( $this, 'customize_plugin_action_links' ) );
	}

	/**
	 * Add admin notice.
	 *
	 * @since 2.3.8
	 */
	public function add_admin_notice() {
		Notice::init(
			array(
				'slug' => 'date-today-nepali',
				'name' => esc_html__( 'Date Today Nepali', 'date-today-nepali' ),
			)
		);
	}

	/**
	 * Customize plugin action links.
	 *
	 * @since 2.3.9
	 *
	 * @param array $actions Action links.
	 * @return array Modified action links.
	 */
	public function customize_plugin_action_links( $actions ) {
		$url = add_query_arg(
			array(
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

}
