<?php
/**
 * Single Trip Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_trip( $wp_customize ) {
    
    $wp_customize->add_section( 'trip_page_setting', array(
        'title'      => __( 'Single Trip Page Settings', 'travel-agency-pro' ),
        'priority'   => 46,
        'capability' => 'edit_theme_options',
        'active_callback' => 'travel_agency_is_wpte_activated',
    ) );
    
    /** Related Trip Title */
    $wp_customize->add_setting(
        'related_trip_title',
        array(
            'default'           => __( 'Related Trips', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		'related_trip_title',
		array(
			'section' => 'trip_page_setting',
			'label'	  => __( 'Related Trip Title', 'travel-agency-pro' ),
            'type'    => 'text',
		)		
	);
    
    $wp_customize->selective_refresh->add_partial( 'related_trip_title', array(
        'selector'        => '.site .related-trips .section-title',
        'render_callback' => 'travel_agency_pro_related_trip_title',
    ) );
    
    /** Related Trip Readmore */
    $wp_customize->add_setting(
        'related_trip_readmore',
        array(
            'default'           => __( 'View Details', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		'related_trip_readmore',
		array(
			'section' => 'trip_page_setting',
			'label'	  => __( 'Related Trip Readmore', 'travel-agency-pro' ),
            'type'    => 'text',
		)		
	);
    
    $wp_customize->selective_refresh->add_partial( 'related_trip_readmore', array(
        'selector'        => '.site .related-trips .grid .text-holder .btn-holder .btn-more',
        'render_callback' => 'travel_agency_pro_related_trip_readmore',
    ) );
    
    /** Related Trip Taxonomy */    
    $wp_customize->add_setting( 
        'related_trip_tax', 
        array(
            'default'           => 'destination',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'related_trip_tax',
			array(
				'section'	  => 'trip_page_setting',
				'label'       => __( 'Related Trip Taxonomy', 'travel-agency-pro' ),
                'description' => __( 'Choose Taxonomy to display related trips based on in single trip.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'destination' => __( 'Destination', 'travel-agency-pro' ),
                    'activities'  => __( 'Activities', 'travel-agency-pro' ),
                    'trip_types'  => __( 'Trip Type', 'travel-agency-pro' ),
				),
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_trip' );