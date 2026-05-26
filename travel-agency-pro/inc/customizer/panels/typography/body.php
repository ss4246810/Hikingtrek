<?php
/**
 * Body Typography Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography_body( $wp_customize ) {

    /** Body Settings */
    $wp_customize->add_section( 'typography_body_section', array(
        'title'      => __( 'Body Settings', 'travel-agency-pro' ),
        'priority'   => 11,
        'capability' => 'edit_theme_options',
        'panel'      => 'typography_section'
    ) );
    
    /** Primary Font */
    $wp_customize->add_setting(
		'primary_font',
		array(
			'default'			=> 'Poppins',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'primary_font',
    		array(
                'label'	      => __( 'Primary Font', 'travel-agency-pro' ),
                'description' => __( 'Primary font of the site.', 'travel-agency-pro' ),
    			'section'     => 'typography_body_section',
    			'choices'     => travel_agency_pro_get_all_fonts(),	
     		)
		)
	);
    
    /** Secondary Font */
    $wp_customize->add_setting(
		'secondary_font',
		array(
			'default'			=> 'Montserrat',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'secondary_font',
    		array(
                'label'	      => __( 'Secondary Font', 'travel-agency-pro' ),
                'description' => __( 'Secondary font of the site.', 'travel-agency-pro' ),
    			'section'     => 'typography_body_section',
    			'choices'     => travel_agency_pro_get_all_fonts(),	
     		)
		)
	);
    
    /** Body Font Size */
    $wp_customize->add_setting( 'font_size', array(
        'default'           => 16,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'font_size',
			array(
				'section' => 'typography_body_section',
				'label'	  => __( 'Font Size', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 10,
					'max' 	=> 35,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** Body Color */
    $wp_customize->add_setting( 'body_color', array(
        'default'           => '#666666',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'body_color', 
            array(
                'label'   => __( 'Body Color', 'travel-agency-pro' ),
                'section' => 'typography_body_section',                
            )
        )
    );
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography_body' );