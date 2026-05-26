<?php
/**
 * General Archive Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_archive( $wp_customize ) {
	
    /** Archive Page */
    $wp_customize->add_section(
        'archive_settings',
        array(
            'title'    => __( 'Archive Page Settings', 'travel-agency-pro' ),
            'priority' => 25,
            'panel'    => 'general_settings',
        )
    );
    
    /** Read More label */
    $wp_customize->add_setting(
        'readmore',
        array(
            'default'           => __( 'Read More', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		'readmore',
		array(
			'section' => 'archive_settings',
			'label'	  => __( 'Read More Label', 'travel-agency-pro' ),
            'type'    => 'text'
		)		
	);
    
    $wp_customize->selective_refresh->add_partial( 'readmore', array(
        'selector'        => '.site-main .entry-footer .btn-holder .btn-more',
        'render_callback' => 'travel_agency_pro_get_readmore_btn',
    ) );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_archive' );