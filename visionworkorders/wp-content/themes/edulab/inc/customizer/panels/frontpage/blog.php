<?php
/**
 * Blog Section
 *
 * @package edulab
 */

function edulab_customize_register_frontpage_blog( $wp_customize ){

    /** Blog Section */
    $wp_customize->add_section(
        'blog_section',
        array(
            'title'    => __( 'Blog Section', 'edulab' ),
            'priority' => 75,
            'panel'    => 'frontpage_settings',
        )
    );

    /** Blog Options */
    $wp_customize->add_setting(
        'ed_blog_section',
        array(
            'default'           => true,
            'sanitize_callback' => 'edulab_sanitize_checkbox',
        )
    );

    $wp_customize->add_control(
        'ed_blog_section',
        array(
            'label'       => __( 'Enable/Disable Blog', 'edulab' ),
            'section'     => 'blog_section',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );

    /** Blog title */
    $wp_customize->add_setting(
        'blog_section_title',
        array(
            'default'           => __( 'Latest Articles', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'blog_section_title',
        array(
            'section'         => 'blog_section',
            'label'           => __( 'Blog Title', 'edulab' ),
        )
    );

    $wp_customize->selective_refresh->add_partial( 'blog_section_title', array(
        'selector'          => '.blog .section-title',
        'render_callback'   => 'edulab_get_blog_section_title',
    ) );

    /** Blog description */
    $wp_customize->add_setting(
        'blog_section_subtitle',
        array(
            'default'           => __( 'You can find the latest news and articles here', 'edulab' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage',
        )
    );
    
    $wp_customize->add_control(
        'blog_section_subtitle',
        array(
            'section'         => 'blog_section',
            'label'           => __( 'Blog Description', 'edulab' ),
        )
    ); 

    $wp_customize->selective_refresh->add_partial( 'blog_section_subtitle', array(
        'selector'          => '.blog .section-desc',
        'render_callback'   => 'edulab_get_blog_section_subtitle',
    ) );


    $wp_customize->add_setting( "blog_cat",
        array(
            'default'           => '1',
            'sanitize_callback' => 'edulab_sanitize_select',
        )
    );
    $wp_customize->add_control( "blog_cat",
        array(
            'label'           => esc_html__( 'Blog category ', 'edulab' ),
            'section'         => 'blog_section',
            'type'            => 'select',
            'choices'         => edulab_get_categories( true, 'category', false ),
        )
    );
    
    /** Blog Section Ends */  
}
add_action( 'customize_register', 'edulab_customize_register_frontpage_blog' );

// Partial refresh
if( ! function_exists( 'edulab_get_blog_section_title' ) ) :
    /**
     * Cta section
    */
    function edulab_get_blog_section_title(){
        return wpautop( get_theme_mod( 'blog_section_title', __( 'LATEST ARTICLES', 'edulab' ) ) );
    }
endif;

if( ! function_exists( 'edulab_get_blog_section_subtitle' ) ) :
    /**
     * Cta section
    */
    function edulab_get_blog_section_subtitle(){
        return wpautop( get_theme_mod( 'blog_section_subtitle', __( 'You can find the latest news and articles here.', 'edulab' ) ) );
    }
endif;