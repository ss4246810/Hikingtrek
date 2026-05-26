<?php
/**
 * General Background Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_background( $wp_customize ) {
	
    /** Background Settings */
    $wp_customize->add_section(
        'background_settings',
        array(
            'title'    => __( 'Background Settings', 'travel-agency-pro' ),
            'priority' => 35,
            'panel'    => 'general_settings',
        )
    );
    
    /** Background Color */
    $wp_customize->add_setting( 'bg_color', array(
        'default'           => '#ffffff',
        'sanitize_callback' => 'sanitize_hex_color'
    ) );

    $wp_customize->add_control( 
        new WP_Customize_Color_Control( 
            $wp_customize, 
            'bg_color', 
            array(
                'label'       => __( 'Background Color', 'travel-agency-pro' ),
                'description' => __( 'Pick a color for site background.', 'travel-agency-pro' ),
                'section'     => 'background_settings',                
            )
        )
    );
    
    /** Body Background */
    $wp_customize->add_setting( 'body_bg', array(
        'default'           => 'image',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'body_bg',
			array(
				'section'	  => 'background_settings',
				'label'       => __( 'Body Background', 'travel-agency-pro' ),
                'description' => __( 'Choose body background as image or pattern.', 'travel-agency-pro' ),
				'choices'	  => array(
					'image'   => __( 'Image', 'travel-agency-pro' ),
                    'pattern' => __( 'Pattern', 'travel-agency-pro' ),
				)
			)
		)
	);
    
    /** Background Image */
    $wp_customize->add_setting(
        'bg_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_image',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'bg_image',
           array(
               'label'           => __( 'Background Image', 'travel-agency-pro' ),
               'description'     => __( 'Upload your own custom background image or pattern.', 'travel-agency-pro' ),
               'section'         => 'background_settings',
               'active_callback' => 'travel_agency_pro_body_bg_choice'               
           )
       )
    );    
    
    /** Background Pattern */
    $wp_customize->add_setting( 'bg_pattern', array(
        'default'           => 'nobg',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Image_Control(
			$wp_customize,
			'bg_pattern',
			array(
				'section'		  => 'background_settings',
				'label'			  => __( 'Background Pattern', 'travel-agency-pro' ),
				'description'	  => __( 'Choose from any of 63 awesome background patterns for your site background.', 'travel-agency-pro' ),
				'choices'         => travel_agency_pro_get_patterns(),
                'active_callback' => 'travel_agency_pro_body_bg_choice'
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_background' );

/**
 * Active Callback for Body Background
*/
function travel_agency_pro_body_bg_choice( $control ){
    
    $body_bg    = $control->manager->get_setting( 'body_bg' )->value();
    $control_id = $control->id;
         
    if ( $control_id == 'bg_image' && $body_bg == 'image' ) return true;
    if ( $control_id == 'bg_pattern' && $body_bg == 'pattern' ) return true;
    
    return false;
}