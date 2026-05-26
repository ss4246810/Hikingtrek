<?php
/**
 * Header Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_header( $wp_customize ) {
	
    $wp_customize->add_panel( 'header_setting', array(
        'title'      => __( 'Logo & Header Settings', 'travel-agency-pro' ),
        'priority'   => 20,
        'capability' => 'edit_theme_options',
    ) );
    
    $wp_customize->get_section( 'title_tagline' )->panel = 'header_setting';
    $wp_customize->remove_control( 'header_textcolor' );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_header' );