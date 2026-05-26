<?php
/**
 * Header Layout Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_header_layout( $wp_customize ) {
	
    $wp_customize->add_section( 'header_layout_setting', array(
        'title'    => __( 'Layout Settings', 'travel-agency-pro' ),
        'priority' => 35,
        'panel'    => 'header_setting',
    ) );
    
    /** Header Layout */
    $wp_customize->add_setting( 'header_layout', array(
        'default'           => 'one',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Image_Control(
			$wp_customize,
			'header_layout',
			array(
				'section'		=> 'header_layout_setting',
				'label'			=> __( 'Header Layout', 'travel-agency-pro' ),
				'description'	=> __( 'Choose the layout of header for your site.', 'travel-agency-pro' ),
				'choices'		=> array(
					'one'   => get_template_directory_uri() . '/images/header/one.png',
                    'two'   => get_template_directory_uri() . '/images/header/two.png',
                    'three' => get_template_directory_uri() . '/images/header/three.png',
                    'four'  => get_template_directory_uri() . '/images/header/four.png',
                    'five'  => get_template_directory_uri() . '/images/header/five.png',
				)
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_header_layout' );