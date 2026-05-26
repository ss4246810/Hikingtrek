<?php
/**
 * Header Social Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_header_social( $wp_customize ) {
	
    $wp_customize->add_section( 'social_setting', array(
        'title'    => __( 'Social Settings', 'travel-agency-pro' ),
        'priority' => 30,
        'panel'    => 'header_setting',
    ) );
    
    /** Enable/Disable Social Links */
    $wp_customize->add_setting(
        'ed_social_links',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_social_links',
			array(
				'section'	  => 'social_setting',
				'label'		  => __( 'Social Links', 'travel-agency-pro' ),
				'description' => __( 'Enable to show social links in header.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Social Links */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'social_links', 
            array(
                'default' => array(
                    array(
                        'font' => 'fa fa-facebook',
                        'link' => 'https://www.facebook.com/',                        
                    ),
                    array(
                        'font' => 'fa fa-twitter',
                        'link' => 'https://twitter.com/',
                    ),
                    array(
                        'font' => 'fa fa-youtube-play',
                        'link' => 'https://www.youtube.com/',
                    ),
                    array(
                        'font' => 'fa fa-instagram',
                        'link' => 'https://www.instagram.com/',
                    ),
                    array(
                        'font' => 'fa fa-google-plus-circle',
                        'link' => 'https://plus.google.com',
                    ),
                    array(
                        'font' => 'fa fa-odnoklassniki',
                        'link' => 'https://ok.ru/',
                    ),
                    array(
                        'font' => 'fa fa-vk',
                        'link' => 'https://vk.com/',
                    ),
                    array(
                        'font' => 'fa fa-xing',
                        'link' => 'https://www.xing.com/',
                    )
                ),
                'sanitize_callback' => array( 'Travel_Agency_Repeater_Setting', 'sanitize_repeater_setting' ),
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'social_links',
			array(
				'section' => 'social_setting',				
				'label'	  => __( 'Social Links', 'travel-agency-pro' ),
				'fields'  => array(
                    'font' => array(
                        'type'        => 'font',
                        'label'       => __( 'Font Awesome Icon', 'travel-agency-pro' ),
                        'description' => __( 'Example: fa-bell', 'travel-agency-pro' ),
                    ),
                    'link' => array(
                        'type'        => 'url',
                        'label'       => __( 'Link', 'travel-agency-pro' ),
                        'description' => __( 'Example: http://facebook.com', 'travel-agency-pro' ),
                    )
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'links', 'travel-agency-pro' ),
                    'field' => 'link'
                )                        
			)
		)
	);
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_header_social' );