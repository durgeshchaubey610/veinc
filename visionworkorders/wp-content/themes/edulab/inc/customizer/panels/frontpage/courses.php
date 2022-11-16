<?php
/**
 * Courses Section
 *
 * @package Edulab
 */

function edulab_customize_register_frontpage_courses_section( $wp_customize ){

    /** Stat Counter Section */
    $wp_customize->add_section(
        'courses_section',
        array(
            'title'         => __( 'Courses Section', 'edulab' ),
            'priority'      => 25,
            'panel'         => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_courses_section',
        array(
            'default'           => false,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'ed_courses_section',
        array(
            'label'       => __( 'Enable/Disable Courses', 'edulab' ),
            'section'     => 'courses_section',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );

    /** Title */
    $wp_customize->add_setting(
        'courses_title',
        array(
            'default'           => __( 'Popular Courses', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'courses_title',
        array(
            'label'           => __( 'Course Title', 'edulab' ),
            'section'         => 'courses_section',
            'type'            => 'text',
        )
    );

    $wp_customize->selective_refresh->add_partial( 'courses_title', array(
        'selector'          => '.course .section-title',
        'render_callback'   => 'edulab_get_courses_title',
    ) );

    $courses_no = '6';

    for ( $i = 1; $i <= $courses_no; $i++ ) {

        $wp_customize->add_setting( "courses_no_$i",
            array(
                'default'           => '',
                'sanitize_callback' => 'edulab_sanitize_select',
            )
        );
        $wp_customize->add_control( "courses_no_$i",
            array(
                'label'           => esc_html__( 'Course ', 'edulab' ) . ' - ' . $i,
                'section'         => 'courses_section',
                'type'            => 'select',
                'choices'         => edulab_get_posts( 'post' ),
            )
        ); 
    }
}
add_action( 'customize_register', 'edulab_customize_register_frontpage_courses_section' );


// Partial refresh
if( ! function_exists( 'edulab_get_courses_title' ) ) :
    /**
     * Cta section
    */
    function edulab_get_courses_title(){
        return wpautop( get_theme_mod( 'courses_title', __( 'Popular Courses', 'edulab' ) ) );
    }
endif;