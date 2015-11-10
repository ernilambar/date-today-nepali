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
function convertToNepali( $date ) {
	$date['year']       = getNepaliNumber( $date['year'] );
	$date['month_name'] = getMahina( $date['month'] );
	$date['month']      = getNepaliNumber( $date['month'] );
	$date['day']        = getBaar( $date['num_day'] );
	$date['date']       = getNepaliNumber( $date['date'] );
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
function getNepaliNumber( $num ) {
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
function getMahina( $num ) {
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
function getBaar( $num ) {
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
