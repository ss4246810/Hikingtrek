<?php
/**
 * Home Page Client Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_home_client( $wp_customize ){
    
    /** Client Section */   
    $wp_customize->add_section( 'client_section', array(
        'title'    => __( 'Client Section', 'travel-agency-pro' ),
        'priority' => 105,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Title */
    $wp_customize->add_setting(
        'client_section_title',
        array(
            'default'           => __( 'Recomended', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'client_section_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'client_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'client_section_title', array(
        'selector' => '#client_section .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_client_section_title',
    ) );
    
    /** Background */
    $wp_customize->add_setting(
    'client_bg_image',
        array(
            'default'           => get_template_directory_uri() . '/images/fallback/img30.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );

    $wp_customize->add_control(
       	new WP_Customize_Image_Control(
           $wp_customize,
           'client_bg_image',
           	array(
               'label'   => __( 'Background Image', 'travel-agency-pro' ),
               'section' => 'client_section'
           	)
       	)
    );
    
    /** Add Clients */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'clients_logo', 
            array(
                'default' => travel_agency_pro_get_customizer_defaults( 'team' ),
            )            
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'clients_logo',
			array(
				'section' => 'client_section',				
				'label'	  => __( 'Add Clients', 'travel-agency-pro' ),
                'fields'  => array(
                    'image' => array(
                        'type'  => 'image', 
                        'label' => __( 'Add Image', 'travel-agency-pro' ),
                    ),
                    'link'     => array(
                        'type'  => 'url',
                        'label' => __( 'Link', 'travel-agency-pro' ),
                    ),
                ),
                'row_label' => array(
                    'value' => __( 'client', 'travel-agency-pro' ),
                ),                                                            
			)
		)
	);
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_client' );