<?php
/**
 * Edulab Theme Customizer
 *
 * @package Edulab
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
/**
 * Requiring customizer panels & sections
*/

$edulab_sections 		= array( 'header', 'social', 'footer', 'default-settings' );
$edulab_panels       	= array( 'frontpage' );
$edulab_sub_sections 	= array(
    'frontpage'         =>  array( 'banner', 'courses', 'whyus', 'portfolio', 'testimonial', 'blog' )
);

foreach( $edulab_sections as $edulab_section ){
	require get_template_directory() . '/inc/customizer/sections/' . $edulab_section . '.php';
}

foreach( $edulab_panels as $edulab_panel ){
	require get_template_directory() . '/inc/customizer/panels/' . $edulab_panel . '.php';
}

foreach( $edulab_sub_sections as $edulab_sub_section => $edulab_sub_section_value ){
    foreach( $edulab_sub_section_value as $edulab_sub_section_data ){        
        require get_template_directory() . '/inc/customizer/panels/' . $edulab_sub_section . '/' . $edulab_sub_section_data . '.php';
    }
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function edulab_customize_preview_js() {
	wp_enqueue_script( 'edulab-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'edulab_customize_preview_js' );

/**
 * Sanitization Functions
*/
require get_template_directory() . '/inc/customizer/sanitization-functions.php';