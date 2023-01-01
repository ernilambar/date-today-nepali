<?php
/**
 * Block
 *
 * @package Date_Today_Nepali
 */

namespace DateTodayNepali\Blocks;

use Nilambar\NepaliDate\NepaliDate;

/**
 * Block class.
 *
 * @since 2.5.0
 */
class Block {

	/**
	 * Register.
	 *
	 * @since 2.5.0
	 */
	public function register() {
		add_action( 'init', array( $this, 'register_blocks' ) );
	}

	/**
	 * Register blocks.
	 *
	 * @since 2.5.0
	 */
	public function register_blocks() {
		register_block_type( DATE_TODAY_NEPALI_DIR . '/build', array(
			'render_callback' => function( $attributes ) {
				ob_start();

				$obj = new NepaliDate();

				$date_arr = explode( '-', gmdate( 'Y-m-d' ) );

				$date_details = $obj->getDetails( $date_arr[0], $date_arr[1], $date_arr[2], 'ad', $attributes['displayLanguage'] );

				$formatted_date = $obj->getFormattedDate( $date_details, esc_attr( $attributes['displayFormat'] ) );
				?>
				<div <?php echo wp_kses_data( get_block_wrapper_attributes() ); ?>>
					<?php echo $formatted_date; ?>
				</div>
				<?php
				return ob_get_clean();
			},
		) );
	}
}
