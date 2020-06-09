<?php
/**
 * Widget class
 *
 * @package Date_Today_Nepali
 */

use Nilambar\NepaliDate\NepaliDate;

/**
 * Widget class.
 *
 * @since 1.0.0
 */
class DTN_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {
		$opts = array(
			'classname'                   => 'dtn_widget',
			'description'                 => esc_html__( 'Date Today Nepali Widget', 'date-today-nepali' ),
			'customize_selective_refresh' => true,
		);

		parent::__construct( 'dtn-date-display-widget', esc_html__( 'Date Display Widget', 'date-today-nepali' ), $opts );
	}

	/**
	 * Echo the widget content.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments.
	 * @param array $instance Widget instance.
	 */
	public function widget( $args, $instance ) {
		$title            = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$display_language = ! empty( $instance['display_language'] ) ? $instance['display_language'] : 'en';
		$display_format   = ! empty( $instance['display_format'] ) ? $instance['display_format'] : 'd F Y';

		echo $args['before_widget'];

		if ( $title ) {
			echo $args['before_title'] . esc_html( $title ) . $args['after_title'];
		}

		$obj = new NepaliDate();

		$date_arr = explode( '-', gmdate( 'Y-m-d' ) );

		$date_details = $obj->getDetails( $date_arr[0], $date_arr[1], $date_arr[2], 'ad', $display_language );

		$formatted_date = $obj->getFormattedDate( $date_details, esc_attr( $display_format ) );

		echo $formatted_date;

		echo $args['after_widget'];
	}

	/**
	 * Update widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		$instance['display_language'] = sanitize_text_field( $new_instance['display_language'] );
		$instance['display_format']   = sanitize_text_field( $new_instance['display_format'] );

		return $instance;
	}

	/**
	 * Output the settings update form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	public function form( $instance ) {
		$instance = wp_parse_args(
			(array) $instance,
			array(
				'title'            => '',
				'display_language' => 'en',
				'display_format'   => 'd F Y',
			)
		);
		?>

		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title:', 'date-today-nepali' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['title'] ); ?>" />
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'display_language' ) ); ?>"><?php esc_html_e( 'Display Language:', 'date-today-nepali' ); ?></label>
			<select id="<?php echo esc_attr( $this->get_field_id( 'display_language' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_language' ) ); ?>">
				<option value="np" <?php selected( $instance['display_language'], 'np' ); ?>><?php esc_html_e( 'Nepali', 'date-today-nepali' ); ?></option>
				<option value="en" <?php selected( $instance['display_language'], 'en' ); ?>><?php esc_html_e( 'English', 'date-today-nepali' ); ?></option>
			</select>
		</p>
		<p>
			<label for="<?php echo esc_attr( $this->get_field_id( 'display_format' ) ); ?>"><?php esc_html_e( 'Date Format:', 'date-today-nepali' ); ?></label>
			<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'display_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_format' ) ); ?>" type="text" value="<?php echo esc_attr( $instance['display_format'] ); ?>" />

			<?php $examples = date_today_nepali_get_example_formats(); ?>

			<?php if ( ! empty( $examples ) ) : ?>
				<table class="example">
					<tr>
						<td><strong>Format</strong></td>
						<td><strong>Example</strong></td>
					</tr>

					<?php foreach ( $examples as $item ) : ?>
						<tr>
							<td><code><?php echo esc_html( $item['format'] ); ?></code></td>
							<td><?php echo esc_html( $item['label'] ); ?></td>
						</tr>
					<?php endforeach; ?>
				</table><!-- .example -->
			<?php endif; ?>

		</p>
		<?php
	}
}
