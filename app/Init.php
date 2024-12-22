<?php
/**
 * Init
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali;

/**
 * Init class.
 *
 * @since 1.0.0
 */
final class Init {

	/**
	 * Store all the classes inside an array.
	 *
	 * @since 1.0.0
	 *
	 * @return array Full list of classes.
	 */
	public static function get_services() {
		$classes = [
			Core\Core::class,
			Admin\Admin::class,
		];

		if ( function_exists( 'register_block_type' ) ) {
			$classes[] = Blocks\Block::class;
		}

		return $classes;
	}

	/**
	 * Loop through the classes, initialize them,
	 * and call the register() method if it exists
	 *
	 * @since 1.0.0
	 */
	public static function register_services() {
		foreach ( self::get_services() as $class_name ) {
			$service = self::instantiate( $class_name );
			if ( method_exists( $service, 'register' ) ) {
				$service->register();
			}
		}
	}

	/**
	 * Initialize the class.
	 *
	 * @since 1.0.0
	 *
	 * @param  class $class_name Class from the services array.
	 * @return class instance   New instance of the class.
	 */
	private static function instantiate( $class_name ) {
		return new $class_name();
	}
}
