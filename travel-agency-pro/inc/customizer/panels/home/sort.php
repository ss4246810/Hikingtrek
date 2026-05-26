<?php
/**
 * Home Page Sort Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_home_sort( $wp_customize ){
    
    /** Sort Home Page Section */   
    $wp_customize->add_section( 'sort_home_section', array(
        'title'    => __( 'Sort Home Page Section', 'travel-agency-pro' ),
        'priority' => 110,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Sort Home Page Section Section */
    $wp_customize->add_setting(
		'home_sort', 
		array(
			'default' => array( 'about', 'activities', 'popular', 'whyus', 'feature', 'stat', 'deal', 'testimonial', 'cta', 'blog', 'client' ),
			'sanitize_callback' => 'travel_agency_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new Rara_Control_Sortable(
			$wp_customize,
			'home_sort',
			array(
				'section'     => 'sort_home_section',
				'label'       => __( 'Sort Sections', 'travel-agency-pro' ),
				'description' => __( 'Sort or toggle home page sections.', 'travel-agency-pro' ),
				'choices'     => array(
            		'about'       => __( 'About Section', 'travel-agency-pro' ),
            		'activities'  => __( 'Adventure Activities Section', 'travel-agency-pro' ),
            		'popular'     => __( 'Best Seller Packages', 'travel-agency-pro' ),
            		'whyus'       => __( 'Why Book with Us', 'travel-agency-pro' ),
            		'feature'     => __( 'Featured Section', 'travel-agency-pro' ),
            		'stat'        => __( 'Stats Counter Setting', 'travel-agency-pro' ),
                    'deal'        => __( 'Deals Section', 'travel-agency-pro' ), 
                    'testimonial' => __( 'Testimonial Section', 'travel-agency-pro' ),
                    'cta'         => __( 'Call to Action Section', 'travel-agency-pro' ),
                    'blog'        => __( 'Blog Section', 'travel-agency-pro' ),
                    'client'      => __( 'Client Section', 'travel-agency-pro' ),
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_sort' );