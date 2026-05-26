<?php
/**
 * General Social Sharing Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_sharing( $wp_customize ) {
	
    /** Social Sharing */
    $wp_customize->add_section(
        'social_sharing',
        array(
            'title'    => __( 'Social Sharing', 'travel-agency-pro' ),
            'priority' => 30,
            'panel'    => 'general_settings',
        )
    );
    
    /** Enable Social Sharing Buttons */
    $wp_customize->add_setting(
        'ed_social_sharing',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_social_sharing',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Enable Social Sharing Buttons', 'travel-agency-pro' ),
                'description' => __( 'Enable or disable social sharing buttons on archive and single posts.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Social Sharing Buttons */
    $wp_customize->add_setting(
		'social_share', 
		array(
			'default' => array( 'facebook', 'twitter', 'linkedin', 'gplus', 'pinterest' ),
			'sanitize_callback' => 'travel_agency_pro_sanitize_sortable',						
		)
	);

	$wp_customize->add_control(
		new Rara_Control_Sortable(
			$wp_customize,
			'social_share',
			array(
				'section'     => 'social_sharing',
				'label'       => __( 'Social Sharing Buttons', 'travel-agency-pro' ),
				'description' => __( 'Sort or toggle social sharing buttons.', 'travel-agency-pro' ),
				'choices'     => array(
            		'facebook'  => __( 'Facebook', 'travel-agency-pro' ),
            		'twitter'   => __( 'Twitter', 'travel-agency-pro' ),
            		'linkedin'  => __( 'Linkedin', 'travel-agency-pro' ),
            		'pinterest' => __( 'Pinterest', 'travel-agency-pro' ),
            		'email'     => __( 'Email', 'travel-agency-pro' ),
            		'gplus'     => __( 'Google Plus', 'travel-agency-pro' ),
                    'stumble'   => __( 'StumbleUpon', 'travel-agency-pro' ),
                    'reddit'    => __( 'Reddit', 'travel-agency-pro' ),            
            	),
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_sharing' );