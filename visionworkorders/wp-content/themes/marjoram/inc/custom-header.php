<?php
/**
 * Sample implementation of the Custom Header feature
 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
 * @package Marjoram

 * Set up the WordPress core custom header feature.
 * @uses marjoram_header_style()
 */
 
register_default_headers( array(
	'default-image' => array(
		'url'           => '%s/images/header.png',
		'thumbnail_url' => '%s/images/header-tn.png',
		'description'   => esc_html__( 'Default Header Image', 'marjoram' ),
	),
) );

function marjoram_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'marjoram_custom_header_setup', array(
		'header-text'           => false,
		'default-image'      => get_parent_theme_file_uri( '/images/header.png' ),
		'width'                  => 1920,
		'height'                 => 250,
		'flex-width'            => true,
		'flex-height'            => true,
	) ) );
}
add_action( 'after_setup_theme', 'marjoram_custom_header_setup' );


