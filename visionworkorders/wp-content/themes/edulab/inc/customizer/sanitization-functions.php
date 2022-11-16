<?php
/**
 * Sanitization Functions
 * 
 * @package Edulab
*/

function edulab_sanitize_checkbox( $checked ){
    // Boolean check.
    return ( ( isset( $checked ) && true == $checked ) ? true : false );
}

function edulab_sanitize_select( $value ){    
    if ( is_array( $value ) ) {
		foreach ( $value as $key => $subvalue ) {
			$value[ $key ] = sanitize_text_field( $subvalue );
		}
		return $value;
	}
	return sanitize_text_field( $value );    
}

function edulab_sanitize_number_absint( $number, $setting ) {
    // Ensure $number is an absolute integer (whole number, zero or greater).
    $number = absint( $number );
    
    // If the input is an absolute integer, return it; otherwise, return the default
    return ( $number ? $number : $setting->default );
}

function edulab_sanitize_iframe( $iframe ){
    $allow_tag = array(
                    'iframe'=>array(
                        'src'=>array(),
                        'width'=>array(),
                        'height'=>array()
                    )
                );
    return wp_kses( $iframe, $allow_tag );
}

function edulab_sanitize_sortable( $value = array() ) {

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