<?php
/**
 * About Page Service Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about_service( $wp_customize ){
    
    $wp_customize->add_section( 'service_about_section', array(
        'title'      => __( 'Service Section', 'travel-agency-pro' ),
        'priority'   => 40,
        'panel'      => 'about_page_setting',
        'capability' => 'edit_theme_options',
    ) );
    
    /** Title */
    $wp_customize->add_setting(
        'service_about_title',
        array(
            'default'           => __( 'Our Services', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'service_about_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'service_about_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'service_about_title', array(
        'selector'        => '.services .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_about_service_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'service_about_desc',
        array(
            'default'           => __( 'Show the services provided to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Service Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'service_about_desc',
        array(
            'label'   => __( 'Description', 'travel-agency-pro' ),
            'section' => 'service_about_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'service_about_desc', array(
        'selector'        => '.services .section-header .section-content',
        'render_callback' => 'travel_agency_pro_get_about_service_sub_title',
    ) );
    
    /** Services Repeater */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'services_about', 
            array(
                'default' => travel_agency_pro_get_customizer_defaults( 'services' ),                    
            ) 
        ) 
    );
    
    $wp_customize->add_control(
    	new Travel_Agency_Control_Repeater(
    		$wp_customize,
    		'services_about',
    		array(
    			'section' => 'service_about_section',				
    			'label'	  => __( 'Add Services', 'travel-agency-pro' ),
                'fields'  => array(
                    'image' => array(
                        'type'  => 'image', 
                        'label' => __( 'Add Image', 'travel-agency-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-pro' ),
                    ),
                    'content'	=> array(
                        'type'  	=> 'textarea',
                        'label' 	=> __( 'Desciption', 'travel-agency-pro' ),
                    ),                    
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'service', 'travel-agency-pro' ),
                    'field' => 'title'
                ),                                                     
    		)
    	)
    );          
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_service' );