<?php
/**
 * Footer Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_footer( $wp_customize ) {
    
    $wp_customize->add_section(
        'footer_settings',
        array(
            'title'      => __( 'Footer Settings', 'travel-agency-pro' ),
            'priority'   => 500,
            'capability' => 'edit_theme_options',
        )
    );
    
    /** Footer Copyright */
    $wp_customize->add_setting(
        'footer_copyright',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'footer_copyright',
        array(
            'label'   => __( 'Footer Copyright', 'travel-agency-pro' ),
            'section' => 'footer_settings',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'footer_copyright', array(
        'selector' => '.footer-b .copyright',
        'render_callback' => 'travel_agency_pro_get_footer_copyright',
    ) );
    
    /** Hide Author Link */
    $wp_customize->add_setting(
        'ed_author_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_author_link',
			array(
				'section' => 'footer_settings',
				'label'	  => __( 'Hide Author Link', 'travel-agency-pro' ),
			)
		)
	);
    
    $wp_customize->selective_refresh->add_partial( 'ed_author_link', array(
        'selector' => '.site-info .author-link',
        'render_callback' => 'travel_agency_pro_ed_author_link',
    ) );
    
    /** Hide WordPress Link */
    $wp_customize->add_setting(
        'ed_wp_link',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_wp_link',
			array(
				'section' => 'footer_settings',
				'label'	  => __( 'Hide WordPress Link', 'travel-agency-pro' ),
			)
		)
	);
    
    $wp_customize->selective_refresh->add_partial( 'ed_wp_link', array(
        'selector' => '.site-info .wp-link',
        'render_callback' => 'travel_agency_pro_ed_wp_link',
    ) );
       
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_footer' );