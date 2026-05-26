<?php
/**
 * About Page Client Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about_client( $wp_customize ){
    
    $wp_customize->add_section( 'client_about_section', array(
        'title'      => __( 'Client Section', 'travel-agency-pro' ),
        'priority'   => 20,
        'panel'      => 'about_page_setting',
        'capability' => 'edit_theme_options',
    ) );
    
    /** Title */
    $wp_customize->add_setting(
        'about_client_title',
        array(
            'default'           => __( 'Associated With', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_client_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'client_about_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_client_title', array(
        'selector' => '#about_clients .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_about_client_title',
    ) );
    
    /** Add Clients */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'about_clients', 
            array(
                'default' => travel_agency_pro_get_customizer_defaults( 'team' ),                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'about_clients',
			array(
				'section' => 'client_about_section',				
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
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_client' );