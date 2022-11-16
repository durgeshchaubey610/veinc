<?php
/**
 * Header Settings
 *
 * @package edulab
 */

function edulab_customize_register_social( $wp_customize ) {
    
    $wp_customize->add_section( 'social_setting', array(
        'title'    => __( 'Social Settings', 'edulab' ),
        'priority' => 50,
    ) );
    
    /** Enable/Disable Social Links */
    $wp_customize->add_setting(
        'ed_social_links',
        array(
            'default'           => true,
            'sanitize_callback' => 'edulab_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
        'ed_social_links',
        array(
            'section'     => 'social_setting',
            'label'       => __( 'Social Links', 'edulab' ),
            'description' => __( 'Enable to show social links.', 'edulab' ),
            'type'        => 'checkbox'
        )       
    );
    
    /** Social Links */
    $wp_customize->add_setting( 
        new Edulab_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => array(
                    array(
                        'font' => 'fab fa-facebook',
                        'link' => 'https://www.facebook.com/',                        
                    ),
                    array(
                        'font' => 'fab fa-twitter',
                        'link' => 'https://twitter.com/',
                    ),
                    array(
                        'font' => 'fab fa-youtube',
                        'link' => 'https://www.youtube.com/',
                    ),
                    array(
                        'font' => 'fab fa-instagram',
                        'link' => 'https://www.instagram.com/',
                    )
                ),
                'sanitize_callback' => array( 'Edulab_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
        new Edulab_Control_Repeater(
            $wp_customize,
            'social_links',
            array(
                'section' => 'social_setting',              
                'label'   => __( 'Social Links', 'edulab' ),
                'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'edulab' ),
                        'description' => __( 'Example: fa-bell', 'edulab' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'edulab' ),
                        'description' => __( 'Example: http://facebook.com', 'edulab' ),
                    ),
                    'header' => array(
                        'type'  => 'checkbox',
                        'label' => __( 'Header', 'edulab' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'links', 'edulab' ),
                    'field' => 'link'
                )                        
            )
        )
    );
}
add_action( 'customize_register', 'edulab_customize_register_social' );