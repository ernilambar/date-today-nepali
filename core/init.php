<?php

/**
 * Load libraries.
 */
require_once( DATE_TODAY_NEPALI_LIB_DIR . '/nepali_calendar.php' );
require_once( DATE_TODAY_NEPALI_LIB_DIR . '/date_functions.php' );

/**
 * Register widgets.
 */
function date_today_nepali_load_widgets()
{

  include DATE_TODAY_NEPALI_CORE_DIR . '/widget-date-today-nepali.php';
  register_widget( 'DTN_Widget' );

}

add_action('widgets_init', 'date_today_nepali_load_widgets');
