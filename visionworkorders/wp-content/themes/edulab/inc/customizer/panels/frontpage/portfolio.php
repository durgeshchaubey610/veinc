<?php
/**
 * gallery Section
 *
 * @package Edulab
 */

function edulab_customize_register_frontpage_portfolio( $wp_customize ){

    /** gallery Section */
    $wp_customize->add_section(
        'portfolio_section',
        array(
            'title'    => __( 'Portfolio Section', 'edulab' ),
            'priority' => 75,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_portfolio_section',
        array(
            'default'           => false,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'ed_portfolio_section',
        array(
            'label'       => __( 'Enable/Disable portfolio', 'edulab' ),
            'section'     => 'portfolio_section',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );

    /** gallery title */
    $wp_customize->add_setting(
        'portfolio_title',
        array(
            'default'           => __( 'Portfolio', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_title',
        array(
            'section'         => 'portfolio_section',
            'label'           => __( 'Portfolio Title', 'edulab' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'portfolio_title', array(
        'selector'          => '.portfolio .section-title',
        'render_callback'   => 'edulab_get_portfolio_title',
    ) );

    /** gallery description */
    $wp_customize->add_setting(
        'portfolio_desc',
        array(
            'default'           => __( 'You can find here', 'edulab' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'portfolio_desc',
        array(
            'section'         => 'portfolio_section',
            'label'           => __( 'Portfolio Description', 'edulab' ),
        )
    );
    $wp_customize->selective_refresh->add_partial( 'portfolio_desc', array(
        'selector'          => '.portfolio .section-desc',
        'render_callback'   => 'edulab_get_portfolio_desc',
    ) );

    $wp_customize->add_setting( "portfolio_cat",
        array(
            'default'           => '',
            'sanitize_callback' => 'edulab_sanitize_select',
        )
    );
    $wp_customize->add_control( "portfolio_cat",
        array(
            'label'           => esc_html__( 'Portfolio ', 'edulab' ),
            'section'         => 'portfolio_section',
            'type'            => 'select',
            'choices'         => edulab_get_categories( true, 'category', false ),
        )
    ); 
}
add_action( 'customize_register', 'edulab_customize_register_frontpage_portfolio' );

// Partial refresh
if( ! function_exists( 'edulab_get_portfolio_title' ) ) :
    /**
     * Cta section
    */
    function edulab_get_portfolio_title(){
        return wpautop( get_theme_mod( 'portfolio_title', __( 'Portfolio', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_portfolio_desc' ) ) :
    /**
     * Cta section
    */
    function edulab_get_portfolio_desc(){
        return wpautop( get_theme_mod( 'portfolio_desc', __( 'You can find here', 'edulab' ) ) );
    }
endif;