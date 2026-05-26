<?php
/**
 * H1 Typography Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography_h1( $wp_customize ) {
    
    /** H1 Typography Settings */
    $wp_customize->add_section( 'h1_section', array(
        'title'      => __( 'H1 Settings (Content)', 'travel-agency-pro' ),
        'priority'   => 23,
        'capability' => 'edit_theme_options',
        'panel'      => 'typography_section'
    ) );
    
    /** H1 Font */
    $wp_customize->add_setting( 'h1_font', array(
		'default' => array(                         // Default font styles				
			'font-family' => 'Montserrat',
			'variant'     => '700',
		),
		'sanitize_callback' => array( 'Rara_Fonts', 'sanitize_typography' )
	) );

	$wp_customize->add_control( 
        new Rara_Typography_Control( 
            $wp_customize, 
            'h1_font', 
            array(
        		'label'   => __( 'H1 Font', 'travel-agency-pro' ),
        		'section' => 'h1_section',		
        	) 
         ) 
    );
    
    /** H1 Font Size */
    $wp_customize->add_setting( 'h1_font_size', array(
        'default'           => 48,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'h1_font_size',
			array(
				'section' => 'h1_section',
				'label'	  => __( 'H1 Font Size', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 25,
					'max' 	=> 75,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** H1 Color */
    $wp_customize->add_setting( 'h1_color', array(
        'default'           => '#353d47',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'h1_color', 
            array(
                'label'   => __( 'H1 Color', 'travel-agency-pro' ),
                'section' => 'h1_section',                
            )
        )
    );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography_h1' );