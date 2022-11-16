<?php
/**
 * MISC Settings
 *
 * @package edulab
 */

function edulab_customize_register_misc_settings( $wp_customize ){

    /** Front Page Settings */
    $wp_customize->add_panel( 
        'default_settings',
         array(
            'priority'    => 100,
            'capability'  => 'edit_theme_options',
            'title'       => __( 'Default Settings', 'edulab' ),
        ) 
    );
    $wp_customize->get_section( 'colors' )->panel  = 'default_settings';
    $wp_customize->get_section( 'background_image' )->panel  = 'default_settings';

}
add_action( 'customize_register', 'edulab_customize_register_misc_settings' );