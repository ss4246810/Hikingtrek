<?php
/**
 * H4 Typography Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography_h4( $wp_customize ) {
    
    /** H4 Typography Settings */
    $wp_customize->add_section( 'h4_section', array(
        'title'      => __( 'H4 Settings (Content)', 'travel-agency-pro' ),
        'priority'   => 26,
        'capability' => 'edit_theme_options',
        'panel'      => 'typography_section'
    ) );
    
    /** H4 Font */
    $wp_customize->add_setting( 'h4_font', array(
		'default' => array(                         // Default font styles				
			'font-family' => 'Montserrat',
			'variant'     => '700',
		),
		'sanitize_callback' => array( 'Rara_Fonts', 'sanitize_typography' )
	) );

	$wp_customize->add_control( 
        new Rara_Typography_Control( 
            $wp_customize, 
            'h4_font', 
            array(
        		'label'   => __( 'H4 Font', 'travel-agency-pro' ),
        		'section' => 'h4_section',		
        	) 
         ) 
    );
    
    /** H4 Font Size */
    $wp_customize->add_setting( 'h4_font_size', array(
        'default'           => 28,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'h4_font_size',
			array(
				'section' => 'h4_section',
				'label'	  => __( 'H4 Font Size', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 10,
					'max' 	=> 50,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** H4 Color */
    $wp_customize->add_setting( 'h4_color', array(
        'default'           => '#353d47',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'h4_color', 
            array(
                'label'   => __( 'H4 Color', 'travel-agency-pro' ),
                'section' => 'h4_section',                
            )
        )
    );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography_h4' );