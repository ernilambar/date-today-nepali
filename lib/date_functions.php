<?php
/**
 * Date functions.
 *
 * @package Date_Today_Nepali
 */

/**
 * Convert date to Nepali
 *
 * @since 1.0.0
 *
 * @param  array $date Date to be converted.
 * @return array Converted date.
 */
function dtn_convert_to_nepali( $date ) {
	$date['year']       = dtn_get_nepali_number( $date['year'] );
	$date['month_name'] = dtn_get_mahina( $date['month'] );
	$date['month']      = dtn_get_nepali_number( $date['month'] );
	$date['day']        = dtn_get_baar( $date['num_day'] );
	$date['date']       = dtn_get_nepali_number( $date['date'] );
	return $date;
}

/**
 * Get nepali number.
 *
 * @since 1.0.0
 *
 * @param int $num Number.
 * @return string Translated number.
 */
function dtn_get_nepali_number( $num ) {
	$str = array();
	$numarr = str_split( $num );
	if ( 1 === count( $numarr ) ) {
		array_unshift( $numarr, '0' );
	}
	$number = array( '०','१','२','३','४','५','६','७','८','९' );
	$cnt = count( $numarr );
	for ( $i = 0; $i < $cnt; $i++ ) {
		$str[ $i ] = $number[ $numarr[ $i ] ];
	}
	return implode( '', $str );
}

/**
 * Get nepali month from number.
 *
 * @since 1.0.0
 *
 * @param int $num Number for month.
 * @return string Month text in Nepali.
 */
function dtn_get_mahina( $num ) {
	$bar = array( 'बैशाख','जेठ','असार','साउन','भदौ','असोज','कार्तिक','मङि्सर','पुष','माघ','फागुन','चैत' );
	$ret = $bar[ $num -1 ];
	return  $ret;
}

/**
 * Get nepali day from number.
 *
 * @since 1.0.0
 *
 * @param int $num Number for day.
 * @return string Day text in Nepali.
 */
function dtn_get_baar( $num ) {
	$bar = array( 'आइतबार','सोमबार','मङ्गलबार','बुधबार','बिहिबार','शुक्रबार','शनिबार' );
	$ret = $bar[ $num -1 ];
	return  ($ret);
}

/**
 * Trim array.
 *
 * @since 1.0.0
 *
 * @param array $a Date to be trimmed.
 * @return array Trimmed date.
 */
function array_trim_nil( $a ) {
	$j = 0;
	$cnt = count( $a );
	for ( $i = 0; $i < $cnt; $i++ ) {
		if ( strlen( $a[ $i ] ) > 2 ) {
			$b[ $j++ ] = $a[ $i ];
		}
	}
	return $b;
}
