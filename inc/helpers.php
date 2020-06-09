<?php

/**
 * Get example formats.
 *
 * @since 1.0.0
 *
 * @return array Example formats.
 */
function date_today_nepali_get_example_formats() {
	$output = array(
		array(
			'format' => 'd F Y',
			'label'  => '१८ जेठ २०७७',
		),
		array(
			'format' => 'F d, Y',
			'label'  => 'जेठ १८, २०७७',
		),
		array(
			'format' => 'Y F d',
			'label'  => '२०७७ जेठ १८',
		),
		array(
			'format' => 'l, d F Y',
			'label'  => 'आइतबार, १८ जेठ २०७७',
		),
		array(
			'format' => 'd.m.y',
			'label'  => '१८.०२.७७',
		),
		array(
			'format' => 'Y.m.d',
			'label'  => '२०७७.०२.१८',
		),
		array(
			'format' => 'D, d F',
			'label'  => 'आइत, १८ जेठ',
		),
		array(
			'format' => 'Y F d, l',
			'label'  => '२०७७ जेठ १८, आइतबार',
		),
	);

	return $output;
}
