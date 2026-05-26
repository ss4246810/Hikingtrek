<?php
/**
 * Color Scheme Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_color_scheme( $wp_customize ) {
    
    $wp_customize->add_section(
        'color_scheme_section',
        array(
            'title'      => __( 'Color Scheme', 'travel-agency-pro' ),
            'priority'   => 65,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Color Scheme */
    $wp_customize->add_setting( 
        'color_scheme', 
        array(
            'default'           => '#32b67a',
            'sanitize_callback' => 'sanitize_hex_color'
        ) 
    );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'color_scheme', 
            array(
                'label'   => __( 'Color Scheme', 'travel-agency-pro' ),
                'section' => 'color_scheme_section',                
            )
        )
    );
       
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_color_scheme' );