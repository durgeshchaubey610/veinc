<?php
/**
 * Header Setting
 *
 * @package edulab
 */

function edulab_customize_register_general_header( $wp_customize ) {
    
    $wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
    $wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
    $wp_customize->get_setting( 'background_color' )->transport = 'refresh';
    $wp_customize->get_setting( 'background_image' )->transport = 'refresh';
    
    if ( isset( $wp_customize->selective_refresh ) ) {
        $wp_customize->selective_refresh->add_partial(
            'blogname',
            array(
                'selector'        => '.site-title a',
                'render_callback' => 'edulab_customize_partial_blogname',
            )
        );
        $wp_customize->selective_refresh->add_partial(
            'blogdescription',
            array(
                'selector'        => '.site-description',
                'render_callback' => 'edulab_customize_partial_blogdescription',
            )
        );
    }

    /** Header Settings */
    $wp_customize->add_section(
        'header_settings',
        array(
            'title'    => __( 'Header Settings', 'edulab' ),
            'priority' => 20,
        )
    );

    /** Open Link in new tab */
    $wp_customize->add_setting( 
        'ed_header', 
        array(
            'default'           => true,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        ) 
    );
    
    $wp_customize->add_control(
        'ed_header',
        array(
            'section'         => 'header_settings',
            'label'           => __( 'Enable header', 'edulab' ),
            'type'            => 'checkbox', 
        )
    );

    /** Custom Link */
    $wp_customize->add_setting(
        'header_email',
        array(
            'default'           => __( 'info@example.com', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'header_email',
        array(
            'label'           => __( 'Mail', 'edulab' ),
            'section'         => 'header_settings',
            'type'            => 'url',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'header_email', array(
        'selector'          => '.top-header .container .email a',
        'render_callback'   => 'edulab_get_header_email',
    ) );

    /** Custom Link label  */
    $wp_customize->add_setting(
        'header_phone',
        array(
            'default'           => __( '+0 0000000000', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'header_phone',
        array(
            'label'           => __( 'Phone', 'edulab' ),
            'section'         => 'header_settings',
            'type'            => 'text',
        )
    );
    $wp_customize->selective_refresh->add_partial( 'header_phone', array(
        'selector'          => '.top-header .container .phone a',
        'render_callback'   => 'edulab_get_header_phone',
    ) );


    /** Custom Link label  */
    $wp_customize->add_setting(
        'header_text',
        array(
            'default'           => __( 'Join Now', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'header_text',
        array(
            'label'           => __( 'Left Header Text', 'edulab' ),
            'section'         => 'header_settings',
            'type'            => 'text',
        )
    );
    $wp_customize->selective_refresh->add_partial( 'header_text', array(
        'selector'          => '.top-header .container .top-header-right .login-block a',
        'render_callback'   => 'edulab_get_header_text',
    ) );

    $wp_customize->add_setting(
        'header_link',
        array(
            'default'           => __( '#', 'edulab' ),
            'sanitize_callback' => 'esc_url',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'header_link',
        array(
            'label'           => __( 'Left Header Link', 'edulab' ),
            'section'         => 'header_settings',
            'type'            => 'text',
        )
    );
    
    /** Header Settings Ends */
}
add_action( 'customize_register', 'edulab_customize_register_general_header' );


// Partial refresh
if( ! function_exists( 'edulab_get_header_email' ) ) :
    /**
     * Cta section
    */
    function edulab_get_header_email(){
        return wpautop( get_theme_mod( 'header_email', __( 'info@example.com', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_header_phone' ) ) :
    /**
     * Footer copyright
    */
    function edulab_get_header_phone(){
        return wpautop( get_theme_mod( 'header_phone', __( '+0 0000000000', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_header_text' ) ) :
    /**
     * Footer copyright
    */
    function edulab_get_header_text(){
        return wpautop( get_theme_mod( 'header_text', __( 'Join Now', 'edulab' ) ) );
    }
endif;

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function edulab_customize_partial_blogname() {
    bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function edulab_customize_partial_blogdescription() {
    bloginfo( 'description' );
}