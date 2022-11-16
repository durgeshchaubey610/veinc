<?php
/**
 * Testimonial Section
 *
 * @package edulab
 */

function edulab_customize_register_frontpage_pop_testimonial_section( $wp_customize ){

    /** Stat Counter Section */
    $wp_customize->add_section(
        'testimonial_section',
        array(
            'title'         => __( 'Testimonial Section', 'edulab' ),
            'priority'      => 25,
            'panel'         => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_testimonial_section',
        array(
            'default'           => false,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'ed_testimonial_section',
        array(
            'label'       => __( 'Enable/Disable Testimonial', 'edulab' ),
            'section'     => 'testimonial_section',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );

    /** Title */
    $wp_customize->add_setting(
        'testimonial_title',
        array(
            'default'           => __( 'WHAT OTHER SAY ABOUT US', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_title',
        array(
            'label'           => __( 'Testimonial Title', 'edulab' ),
            'section'         => 'testimonial_section',
            'type'            => 'text',
        )
    );

        /** Title */
    $wp_customize->add_setting(
        'testimonial_desc',
        array(
            'default'           => __( 'You can trust our clients', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_desc',
        array(
            'label'           => __( 'Testimonial Desc', 'edulab' ),
            'section'         => 'testimonial_section',
            'type'            => 'text',
        )
    );

    $wp_customize->add_setting( "testimonial_cat",
        array(
            'default'           => '',
            'sanitize_callback' => 'edulab_sanitize_select',
        )
    );
    $wp_customize->add_control( "testimonial_cat",
        array(
            'label'           => esc_html__( 'Testimonial ', 'edulab' ),
            'section'         => 'testimonial_section',
            'type'            => 'select',
            'choices'         => edulab_get_categories( true, 'category', false ),
        )
    ); 
}
add_action( 'customize_register', 'edulab_customize_register_frontpage_pop_testimonial_section' );