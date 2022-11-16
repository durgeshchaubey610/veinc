<?php
/**
 * Register Custom Controls
*/
if( ! function_exists( 'labtheme_register_custom_controls' ) ) :
function labtheme_register_custom_controls( $wp_customize ){

    
    //repeater from kirki
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-repeater-setting.php';
    require_once get_template_directory() . '/inc/custom-controls/repeater/class-control-repeater.php';
    
}
endif;
add_action( 'customize_register', 'labtheme_register_custom_controls' );