<?php
/**
 * SEO Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_seo( $wp_customize ) {
    
    /** SEO Settings */
    $wp_customize->add_section(
        'breadcrumb_settings',
        array(
            'title'    => __( 'SEO Settings', 'travel-agency-pro' ),
            'priority' => 15,
            'panel'    => 'general_settings',
        )
    );

    /** Enable/Disable BreadCrumb */
    $wp_customize->add_setting(
        'ed_breadcrumb',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_breadcrumb',
			array(
				'section' => 'breadcrumb_settings',
				'label'	  => __( 'Enable Breadcrumb', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Home Text */
    $wp_customize->add_setting(
        'breadcrumb_home_text',
        array(
            'default'           => __( 'Home', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'breadcrumb_home_text',
        array(
            'label'   => __( 'Breadcrumb Home Text', 'travel-agency-pro' ),
            'section' => 'breadcrumb_settings',
            'type'    => 'text',
        )
    );
    
    /** Breadcrumb Separator */
    $wp_customize->add_setting(
        'breadcrumb_separator',
        array(
            'default'           => __( '>', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'breadcrumb_separator',
        array(
            'label'   => __( 'Breadcrumb Separator', 'travel-agency-pro' ),
            'section' => 'breadcrumb_settings',
            'type'    => 'text',
        )
    );
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_seo' );