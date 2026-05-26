<?php
/**
 * Header Miscellaneous Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_header_misc( $wp_customize ) {
	
    $wp_customize->add_section( 'header_misc_setting', array(
        'title'    => __( 'Misc Settings', 'travel-agency-pro' ),
        'priority' => 40,
        'panel'    => 'header_setting',
    ) );
    
    /** Enable/Disable Sticky Header */
    $wp_customize->add_setting(
        'ed_sticky_header',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_sticky_header',
			array(
				'section'	  => 'header_misc_setting',
                'label'		  => __( 'Sticky Header', 'travel-agency-pro' ),
                'description' => __( 'Enable to make header sticky.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Enable/Disable Search Form */
    $wp_customize->add_setting(
        'ed_search',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_search',
			array(
				'section'	  => 'header_misc_setting',
                'label'		  => __( 'Search Form', 'travel-agency-pro' ),
                'description' => __( 'Enable to show search form in header.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Phone Label  */
    $wp_customize->add_setting(
        'phone_label',
        array(
            'default'           => __( 'Call us, we are open 24/7', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'phone_label',
        array(
            'label'       => __( 'Phone Label', 'travel-agency-pro' ),
            'description' => __( 'Add phone label in header.', 'travel-agency-pro' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
            'active_callback' => 'travel_agency_pro_header_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'phone_label', array(
        'selector' => '.site-header .header-b .phone-label',
        'render_callback' => 'travel_agency_pro_get_phone_label',
    ) );
    
    /** Phone Number  */
    $wp_customize->add_setting(
        'phone',
        array(
            'default'           => __( '(888) 123-45678', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'phone',
        array(
            'label'       => __( 'Phone Number', 'travel-agency-pro' ),
            'description' => __( 'Add phone no. in header.', 'travel-agency-pro' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'phone', array(
        'selector'        => '.site-header .phone',
        'render_callback' => 'travel_agency_pro_get_header_phone',
    ) );
    
    /** Email */
    $wp_customize->add_setting(
        'email',
        array(
            'default'           => __( 'mail@domain.com', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_email',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'email',
        array(
            'label'       => __( 'Email', 'travel-agency-pro' ),
            'description' => __( 'Add email in header.', 'travel-agency-pro' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
            'active_callback' => 'travel_agency_pro_header_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'email', array(
        'selector'        => '.site-header .email-link .email',
        'render_callback' => 'travel_agency_pro_get_email',
    ) );
    
    /** Work Hour */
    $wp_customize->add_setting(
        'time',
        array(
            'default'           => __( 'Mon - Fri 10:00-18:00', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'time',
        array(
            'label'       => __( 'Work Hour', 'travel-agency-pro' ),
            'description' => __( 'Add working hour in header.', 'travel-agency-pro' ),
            'section'     => 'header_misc_setting',
            'type'        => 'text',
            'active_callback' => 'travel_agency_pro_header_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'time', array(
        'selector'        => '.site-header .opening-time .time',
        'render_callback' => 'travel_agency_pro_get_time',
    ) );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_header_misc' );

/**
 * Active Callback 
*/
function travel_agency_pro_header_ac( $control ){
    $header_layout = $control->manager->get_setting( 'header_layout' )->value();
    $control_id    = $control->id;
    
    if ( $control_id == 'email' && ( $header_layout == 'two' || $header_layout == 'three' || $header_layout == 'four' || $header_layout == 'five' ) ) return true;
    if ( $control_id == 'time' && ( $header_layout == 'two' || $header_layout == 'three' || $header_layout == 'four' ) ) return true;
    if ( $control_id == 'phone_label' && ( $header_layout == 'one' || $header_layout == 'two' || $header_layout == 'three' || $header_layout == 'four' ) ) return true;    
    
    return false;
}