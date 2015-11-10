<?php
/**
 * DTN Widget Class.
 *
 * @package Date_Today_Nepali
 */

/**
 * DTN widget Class.
 *
 * @since 1.0.0
 */
class DTN_Widget extends WP_Widget {

	/**
	 * Constructor.
	 *
	 * @since 1.0.0
	 */
	function __construct() {

		$opts = array(
		'classname'   => 'dtn_widget',
		'description' => __( 'Date Today Nepali Widget', 'date-today-nepali' ),
		);
		parent::__construct( 'dtn-date-display-widget', __( 'Date Display Widget', 'date-today-nepali' ), $opts );
	}

	/**
	 * Echo the widget content.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args     Display arguments including before_title, after_title,
	 *                        before_widget, and after_widget.
	 * @param array $instance The settings for the particular instance of the widget.
	 */
	function widget( $args, $instance ) {

		extract( $args , EXTR_SKIP );

		$title            = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );
		$display_language = ! empty( $instance['display_language'] ) ? $instance['display_language'] : 'en' ;
		$date_format      = ! empty( $instance['date_format'] ) ? $instance['date_format'] : 4 ;
		$date_separator   = ! empty( $instance['date_separator'] ) ? $instance['date_separator'] : 'space' ;

		switch ( $date_separator ) {
			case 'space':
				$date_separator_value = ' ';
			break;
			case 'dash':
				$date_separator_value = '-';
			break;
			default:
			break;
		}

		echo $before_widget;
		if ( $title ) {
			echo $before_title . $title . $after_title;
		}

		$cal = new Nepali_Calendar();
		$date_arr = explode( '-', date( 'Y-m-d' ) );

		$newd = $cal->eng_to_nep( $date_arr[0], $date_arr[1], $date_arr[2] );

		if ( 'np' === $display_language ) {
			$newd = dtn_convert_to_nepali( $newd );
		}
		$today_date = '';
		switch ( $date_format ) {
			case 1:
				// Format: 21 04 2070 !
				$today_date .= $newd['date'] . $date_separator_value . $newd['month']. $date_separator_value . $newd['year'];
				break;
			case 2:
				// Format: 2070 21 04 !
				$today_date .= $newd['year'] . $date_separator_value . $newd['date'] . $date_separator_value . $newd['month'];
				break;
			case 3:
				// Format: 2070 04 21 !
				$today_date .= $newd['year'] . $date_separator_value . $newd['month'] . $date_separator_value . $newd['date'] ;
				break;
			case 4:
				// Format: 21 Shrawan 2070 !
				$today_date .= $newd['date'] . $date_separator_value . $newd['month_name'] . $date_separator_value . $newd['year'] ;
				break;
			case 5:
				// Format: 2070 Shrawan 21 !
				$today_date .= $newd['year'] . $date_separator_value . $newd['month_name'] . $date_separator_value . $newd['date'] ;
				break;
			case 6:
				// Format: 21 Shrawan 2070, Monday !
				$today_date .= $newd['date'] . $date_separator_value . $newd['month_name'] .
				  $date_separator_value . $newd['year']. ', ' . $newd['day'] ;
				break;
			case 7:
				// Format: Monday, 21 Shrawan 2070 !
				$today_date .= $newd['day'] . ', ' . $newd['date'] . $date_separator_value . $newd['month_name'] .
				  $date_separator_value . $newd['year'] ;
				break;
			case 8:
				// Format: 2070 Shrawan 21, Monday !
				$today_date .= $newd['year'] . $date_separator_value . $newd['month_name'] . $date_separator_value . $newd['date'] . ', ' . $newd['day'] ;
				break;
			case 9:
				// Format: Monday, 2070 Shrawan 21 !
				$today_date .= $newd['day'] . ', ' . $newd['year'] . $date_separator_value . $newd['month_name'] . $date_separator_value . $newd['date'] ;
				break;

			default:
				break;
		}
		echo $today_date;

		echo $after_widget;

	}

	/**
	 * Update widget instance.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance New settings for this instance as input by the user via
	 *                            {@see WP_Widget::form()}.
	 * @param array $old_instance Old settings for this instance.
	 * @return array Settings to save or bool false to cancel saving.
	 */
	function update( $new_instance, $old_instance ) {

		$instance = $old_instance;

		$instance['title']            = sanitize_text_field( $new_instance['title'] );
		$instance['display_language'] = esc_attr( $new_instance['display_language'] );
		$instance['date_format']      = absint( $new_instance['date_format'] );
		$instance['date_separator']   = esc_attr( $new_instance['date_separator'] );

		return $instance;

	}

	/**
	 * Output the settings update form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance Current settings.
	 */
	function form( $instance ) {
		$instance = wp_parse_args( (array) $instance, array(
			'title'            => '',
			'display_language' => 'en',
			'date_format'      => 4,
			'date_separator'   => 'space',
		) );
		$title            = esc_attr( $instance['title'] );
		$display_language = esc_attr( $instance['display_language'] );
		$date_format      = absint( $instance['date_format'] );
		$date_separator   = esc_attr( $instance['date_separator'] );
		?>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title:', 'date-today-nepali' ); ?></label>
        <input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo $title; ?>" />
      </p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'display_language' ) ); ?>"><?php _e( 'Display Language:', 'date-today-nepali' ); ?></label>
        <select id="<?php echo esc_attr( $this->get_field_id( 'display_language' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'display_language' ) ); ?>">
          <option value="np" <?php selected( $display_language, 'np' ); ?>><?php _e( 'Nepali', 'date-today-nepali' ); ?></option>
          <option value="en" <?php selected( $display_language, 'en' ); ?>><?php _e( 'English', 'date-today-nepali' ); ?></option>
        </select>
      </p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>"><?php _e( 'Date Format:', 'date-today-nepali' ); ?></label>
        <select id="<?php echo esc_attr( $this->get_field_id( 'date_format' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_format' ) ); ?>">
          <option value="1" <?php selected( $date_format, '1' ); ?>>21 04 2070</option>
          <option value="2" <?php selected( $date_format, '2' ); ?>>2070 21 04</option>
          <option value="3" <?php selected( $date_format, '3' ); ?>>2070 04 21</option>
          <option value="4" <?php selected( $date_format, '4' ); ?>>21 Shrawan 2070</option>
          <option value="5" <?php selected( $date_format, '5' ); ?>>2070 Shrawan 21</option>
          <option value="6" <?php selected( $date_format, '6' ); ?>>21 Shrawan 2070, Monday</option>
          <option value="7" <?php selected( $date_format, '7' ); ?>>Monday, 21 Shrawan 2070</option>
          <option value="8" <?php selected( $date_format, '8' ); ?>>2070 Shrawan 21, Monday</option>
          <option value="9" <?php selected( $date_format, '9' ); ?>>Monday, 2070 Shrawan 21</option>
        </select>
      </p>
      <p>
        <label for="<?php echo esc_attr( $this->get_field_id( 'date_separator' ) ); ?>"><?php _e( 'Date Separator:', 'date-today-nepali' ); ?></label>
        <select id="<?php echo esc_attr( $this->get_field_id( 'date_separator' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'date_separator' ) ); ?>">
        <option value="space" <?php selected( $date_separator, 'space' ); ?>>&nbsp; (<?php _e( 'Space', 'date-today-nepali' ); ?>)</option>
          <option value="dash" <?php selected( $date_separator, 'dash' ); ?>>- (<?php _e( 'Dash', 'date-today-nepali' ); ?>)</option>
        </select>
      </p>
        <?php
	}
}
