<?php

function date_today_nepali_load_widgets()
{
    include DATE_TODAY_NEPALI_CORE_DIR . '/widget-date-today-nepali.php';
    // include(plugin_dir_path( __FILE__ ) . "widgets/date-today-nepali.php");
    // register_widget('DTN_Widget');
}
add_action('widgets_init', 'date_today_nepali_load_widgets');
