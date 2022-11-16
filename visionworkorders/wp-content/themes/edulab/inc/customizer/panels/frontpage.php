<?php
/**
 * Front Page Settings
 *
 * @package Edulab
 */

function edulab_customize_register_frontpage( $wp_customize ) {
	
    /** Front Page Settings */
    $wp_customize->add_panel( 
        'frontpage_settings',
         array(
            'priority'    => 40,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Front Page Settings', 'edulab' ),
            'description' => __( 'Static Home Page settings.', 'edulab' ),
        ) 
    );    
      
}
add_action( 'customize_register', 'edulab_customize_register_frontpage' );