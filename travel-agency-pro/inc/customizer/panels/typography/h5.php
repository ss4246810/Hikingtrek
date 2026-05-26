<?php
/**
 * H5 Typography Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography_h5( $wp_customize ) {
    
    /** H5 Typography Settings */
    $wp_customize->add_section( 'h5_section', array(
        'title'      => __( 'H5 Settings (Content)', 'travel-agency-pro' ),
        'priority'   => 27,
        'capability' => 'edit_theme_options',
        'panel'      => 'typography_section'
    ) );
    
    /** H5 Font */
    $wp_customize->add_setting( 'h5_font', array(
		'default' => array(                         // Default font styles				
			'font-family' => 'Montserrat',
			'variant'     => '700',
		),
		'sanitize_callback' => array( 'Rara_Fonts', 'sanitize_typography' )
	) );

	$wp_customize->add_control( 
        new Rara_Typography_Control( 
            $wp_customize, 
            'h5_font', 
            array(
        		'label'   => __( 'H5 Font', 'travel-agency-pro' ),
        		'section' => 'h5_section',		
        	) 
         ) 
    );
        
    /** H5 Font Size */
    $wp_customize->add_setting( 'h5_font_size', array(
        'default'           => 24,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'h5_font_size',
			array(
				'section' => 'h5_section',
				'label'	  => __( 'H5 Font Size', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 10,
					'max' 	=> 40,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** H5 Color */
    $wp_customize->add_setting( 'h5_color', array(
        'default'           => '#353d47',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'h5_color', 
            array(
                'label'   => __( 'H5 Color', 'travel-agency-pro' ),
                'section' => 'h5_section',                
            )
        )
    );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography_h5' );