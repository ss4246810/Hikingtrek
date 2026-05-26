<?php
/**
 * Sanitization Functions
 * 
 * @package Travel_Agency_Pro
 */
 
/**
 * Sanitize callback for checkbox
*/
function travel_agency_pro_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

/**
 * Sanitize callback for select
*/
function travel_agency_pro_sanitize_select( $value ){
    if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = esc_attr( $subvalue );
		}
		return $value;
	}
	return esc_attr( $value );
}

function travel_agency_pro_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );                                                            
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function travel_agency_pro_sanitize_number_floatval( $number, $setting ) {
    // Ensure $number is an floatval.
    $number = floatval( $number );                                                          
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}
 
function travel_agency_pro_sanitize_image( $image, $setting ) {
    /*
     * Array of valid image file types.
     *
     * The array includes image mime types that are included in wp_get_mime_types()
     */
    $mimes = array(
        'jpg|jpeg|jpe' => 'image/jpeg',
        'gif'          => 'image/gif',
        'png'          => 'image/png',
        'bmp'          => 'image/bmp',
        'tif|tiff'     => 'image/tiff',
        'ico'          => 'image/x-icon'
    );
    // Return an array with file extension and mime_type.
    $file = wp_check_filetype( $image, $mimes );
    // If $image has a valid mime_type, return it; otherwise, return the default.
    return ( $file['ext'] ? $image : '' );
}

function travel_agency_pro_sanitize_multiple_check( $value ) {                        
    $value = ( ! is_array( $value ) ) ? explode( ',', $value ) : $value;
    return ( ! empty( $value ) ) ? array_map( 'sanitize_text_field', $value ) : array();    
}

function travel_agency_pro_sanitize_sortable( $value = array() ) {
	if ( is_string( $value ) || is_numeric( $value ) ) {
		return array(
			esc_attr( $value ),
		);
	}
	$sanitized_value = array();
	foreach ( $value as $sub_value ) {
		$sanitized_value[] = esc_attr( $sub_value );
	}
	return $sanitized_value;
}