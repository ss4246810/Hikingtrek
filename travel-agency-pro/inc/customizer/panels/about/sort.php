<?php
/**
 * About Page Sort Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_about_sort( $wp_customize ){
    
    /** Sort Home Page Section */   
    $wp_customize->add_section( 'sort_about_section', array(
        'title'    => __( 'Sort About Page Section', 'travel-agency-pro' ),
        'priority' => 110,
        'panel'    => 'about_page_setting',
    ) ); 
    
    /** Sort About Page Section Section */
    $wp_customize->add_setting(
		'about_sort', 
		array(
			'default' => array( 'intro', 'clients', 'feature', 'services', 'stats', 'testimonials', 'team' ),
			'sanitize_callback' => 'travel_agency_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new Rara_Control_Sortable(
			$wp_customize,
			'about_sort',
			array(
				'section'     => 'sort_about_section',
				'label'       => __( 'Sort Sections', 'travel-agency-pro' ),
				'description' => __( 'Sort or toggle about page sections.', 'travel-agency-pro' ),
				'choices'     => array(
            		'intro'        => __( 'Intro Section', 'travel-agency-pro' ),
            		'clients'      => __( 'Client Section', 'travel-agency-pro' ),
            		'feature'      => __( 'Why Us Section', 'travel-agency-pro' ),
            		'services'     => __( 'Service Section', 'travel-agency-pro' ),
            		'stats'        => __( 'Stats Section', 'travel-agency-pro' ),
                    'testimonials' => __( 'Testimonial Section', 'travel-agency-pro' ),
                    'team'         => __( 'Team Section', 'travel-agency-pro' ),
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_sort' );