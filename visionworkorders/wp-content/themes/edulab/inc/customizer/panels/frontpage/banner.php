<?php
/**
 * Banner Section
 *
 * @package edulab
 */

function edulab_customize_register_frontpage_banner( $wp_customize ) { 
    
    $wp_customize->get_section( 'header_image' )->panel                    = 'frontpage_settings';
    $wp_customize->get_section( 'header_image' )->title                    = __( 'Banner Section', 'edulab' );
    $wp_customize->get_section( 'header_image' )->priority                 = 10;
    $wp_customize->get_section( 'header_image' )->description              = '';                                   
    $wp_customize->get_setting( 'header_image' )->transport                = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport                = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport       = 'refresh';
    
    /** Banner Options */
    $wp_customize->add_setting(
        'ed_banner_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'ed_banner_section',
        array(
            'label'       => __( 'Enable/Disable Banner', 'edulab' ),
            'section'     => 'header_image',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           =>  __( 'Welcome to Education', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'           => __( 'Banner Title', 'edulab' ),
            'section'         => 'header_image',
            'type'            => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector'          => '.banner .container h2',
        'render_callback'   => 'edulab_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'you can now find the courses for you', 'edulab' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'           => __( 'Banner description', 'edulab' ),
            'section'         => 'header_image',
            'type'            => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector'          => '.banner .container h3',
        'render_callback'   => 'edulab_get_banner_subtitle',
    ) );

    $wp_customize->add_setting(
        'banner_readmore',
        array(
            'default'           => __( 'Read More', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage' 
        )
    );
        
    $wp_customize->add_control(
        'banner_readmore',
        array(
            'type'            => 'text',
            'section'         => 'header_image',
            'label'           => __( 'Read More', 'edulab' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'banner_readmore', array(
        'selector'          => '.banner .read-more-btn',
        'render_callback'   => 'edulab_get_banner_readmore',
    ) );

    // read_more_link
    $wp_customize->add_setting(
        'banner_readmore_link',
        array(
            'default'           => '#',
            'sanitize_callback' => 'esc_url_raw',
            'transport'         => 'postMessage' 
        )
    );
        
    $wp_customize->add_control(
        'banner_readmore_link',
        array(
            'type'            => 'url',
            'section'         => 'header_image',
            'label'           => __( 'Read More link', 'edulab' ),
        )
    );

}
add_action( 'customize_register', 'edulab_customize_register_frontpage_banner' );


// Partial refresh
if( ! function_exists( 'edulab_get_banner_title' ) ) :
    /**
     * Cta section
    */
    function edulab_get_banner_title(){
        return wpautop( get_theme_mod( 'banner_title', __( 'Welcome to Education', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_banner_subtitle' ) ) :
    /**
     * Footer copyright
    */
    function edulab_get_banner_subtitle(){
        return wpautop( get_theme_mod( 'banner_subtitle', __( 'you can now find the courses for you', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_banner_readmore' ) ) :
    /**
     * Footer copyright
    */
    function edulab_get_banner_readmore(){
        return wpautop( get_theme_mod( 'banner_readmore', __( 'Read More', 'edulab' ) ) );
    }
endif;