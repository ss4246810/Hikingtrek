<?php
/**
 * Contact Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_contact( $wp_customize ) {
    
    $wp_customize->add_panel( 'contact_page_setting', array(
        'title'    => __( 'Contact Page Settings', 'travel-agency-pro' ),
        'priority' => 40,
        'capability' => 'edit_theme_options',
    ) );
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_contact' );