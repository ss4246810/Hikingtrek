<?php
/**
 * General Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general( $wp_customize ) {
	
    $wp_customize->add_panel( 'general_settings', array(
        'title'      => __( 'General Settings', 'travel-agency-pro' ),
        'priority'   => 50,
        'capability' => 'edit_theme_options',
    ) );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general' );