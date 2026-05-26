<?php
/**
 * Typography Options 
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_typography( $wp_customize ) {
    
    $wp_customize->add_panel( 'typography_section', array(
        'title'          => __( 'Typography Settings', 'travel-agency-pro' ),
        'priority'       => 60,
        'capability'     => 'edit_theme_options',
    ) );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_typography' );                                                         