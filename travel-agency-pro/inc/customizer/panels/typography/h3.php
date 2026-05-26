<?php
/**
 * H3 Typography Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography_h3( $wp_customize ) {
    
    /** H3 Typography Settings */
    $wp_customize->add_section( 'h3_section', array(
        'title'      => __( 'H3 Settings (Content)', 'travel-agency-pro' ),
        'priority'   => 25,
        'capability' => 'edit_theme_options',
        'panel'      => 'typography_section'
    ) );
    
    /** H3 Font */
    $wp_customize->add_setting( 'h3_font', array(
		'default' => array(                         // Default font styles				
			'font-family' => 'Montserrat',
			'variant'     => '700',
		),
		'sanitize_callback' => array( 'Rara_Fonts', 'sanitize_typography' )
	) );

	$wp_customize->add_control( 
        new Rara_Typography_Control( 
            $wp_customize, 
            'h3_font', 
            array(
        		'label'   => __( 'H3 Font', 'travel-agency-pro' ),
        		'section' => 'h3_section',		
        	) 
         ) 
    );
        
    /** H3 Font Size */
    $wp_customize->add_setting( 'h3_font_size', array(
        'default'           => 32,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'h3_font_size',
			array(
				'section' => 'h3_section',
				'label'	  => __( 'H3 Font Size', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 20,
					'max' 	=> 70,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** H3 Color */
    $wp_customize->add_setting( 'h3_color', array(
        'default'           => '#353d47',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'h3_color', 
            array(
                'label'   => __( 'H3 Color', 'travel-agency-pro' ),
                'section' => 'h3_section',                
            )
        )
    );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography_h3' );