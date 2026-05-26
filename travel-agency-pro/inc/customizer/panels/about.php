<?php
/**
 * About Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about( $wp_customize ) {
    
    $wp_customize->add_panel( 'about_page_setting', array(
        'title'      => __( 'About Page Settings', 'travel-agency-pro' ),
        'priority'   => 35,
        'capability' => 'edit_theme_options',
    ) );
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about' );