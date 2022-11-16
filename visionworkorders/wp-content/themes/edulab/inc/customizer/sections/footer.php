<?php
/**
 * Footer Setting
 *
 * @package Edulab
 */

function edulab_customize_register_footer( $wp_customize ) {
        
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'edulab' ),
            'priority'   => 150,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'cta_section',
        array(
            'default'           => __( 'Any Queries? Ask us a question at<a href="tel:+000000000"><i class="fas fa-phone"></i> +123 9800000000</a>', 'edulab'),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'cta_section',
        array(
            'label'       => __( 'Text', 'edulab' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );

     $wp_customize->selective_refresh->add_partial( 'cta_section', array(
        'selector'          => '.query-section .container p',
        'render_callback'   => 'edulab_get_cta_section',
    ) ); 
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => __( 'Copyright 2018', 'edulab' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'       => __( 'Footer Copyright Text', 'edulab' ),
            'section'     => 'footer_settings',
            'type'        => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector'          => '.footer-last-section .container p',
        'render_callback'   => 'edulab_get_footer_copyright',
    ) );        
}
add_action( 'customize_register', 'edulab_customize_register_footer' );


// Partial refresh
if( ! function_exists( 'edulab_get_cta_section' ) ) :
    /**
     * Cta section
    */
    function edulab_get_cta_section(){
        return wpautop( get_theme_mod( 'cta_section', __( 'Any Queries? Ask us a question at<a href="tel:+000000000"><i class="fas fa-phone"></i> +0000000000</a>', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_footer_copyright' ) ) :
    /**
     * Footer copyright
    */
    function edulab_get_footer_copyright(){
        return wpautop( get_theme_mod( 'footer_copyright', __( 'Copyright 2018 &copy; EduLab</a> <span> | </span>', 'edulab' ) ) );
    }
endif;