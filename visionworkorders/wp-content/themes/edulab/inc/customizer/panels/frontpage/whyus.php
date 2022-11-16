<?php
/**
 * Why us
 *
 * @package Edulab
 */

function edulab_customize_register_frontpage_why_choose_section( $wp_customize ){

    /** Stat Counter Section */
    $wp_customize->add_section(
        'why_choose_section',
        array(
            'title'    => __( 'Why Us Section', 'edulab' ),
            'priority' => 25,
            'panel'    => 'frontpage_settings',
        )
    );

    $wp_customize->add_setting(
        'ed_whyus_section',
        array(
            'default'           => false,
            'sanitize_callback' => 'edulab_sanitize_checkbox'
        )
    );

    $wp_customize->add_control(
        'ed_whyus_section',
        array(
            'label'       => __( 'Enable/Disable Why Choose Us', 'edulab' ),
            'section'     => 'why_choose_section',
            'type'        => 'checkbox',
            'priority'    => 1,
        )            
    );

    /** Title */
    $wp_customize->add_setting(
        'why_us_about',
        array(
            'default'           => '',
            'sanitize_callback' => 'edulab_sanitize_select',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'why_us_about',
        array(
            'label'           => __( 'Why Us about', 'edulab' ),
            'section'         => 'why_choose_section',
            'type'            => 'select',
            'choices'         => edulab_get_posts( 'page' ),
        )
    );


    /** Why choose us*/
    $wp_customize->add_setting( 
        new Edulab_Repeater_Setting( 
            $wp_customize, 
            'why_us', 
            array(
                'default'           => '',
                'sanitize_callback' => array( 'Edulab_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Edulab_Control_Repeater(
            $wp_customize,
            'why_us',
            array(
                'section' => 'why_choose_section',              
                'label'   => __( 'Why choose us', 'edulab' ),
                'fields'  => array(
                    'font'            => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'edulab' ),
                        'description' => __( 'Example: fa-bell', 'edulab' ),
                    ),
                    'title'           => array(
                        'type'        => 'text',
                        'label'       => __( 'Title', 'edulab' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'why us', 'edulab' ),
                    'field' => 'title'
                ),
                'choices'   => array(
                    'limit' => 4,
                ),                     
            )
        )
    );

    /** Read More */
    $wp_customize->add_setting(
        'whyus_readmore',
        array(
            'default'           => __( 'Read More', 'edulab' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'whyus_readmore',
        array(
            'label'           => __( 'Why Us Read more', 'edulab' ),
            'section'         => 'why_choose_section',
            'type'            => 'text',
        )
    );
}
add_action( 'customize_register', 'edulab_customize_register_frontpage_why_choose_section' );