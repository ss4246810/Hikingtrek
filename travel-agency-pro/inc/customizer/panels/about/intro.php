<?php
/**
 * About Page Intro Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about_intro( $wp_customize ) {
    
    $wp_customize->add_section( 'intro_about_section', array(
        'title'      => __( 'Intro Section', 'travel-agency-pro' ),
        'priority'   => 10,
        'panel'      => 'about_page_setting',
        'capability' => 'edit_theme_options',
    ) );
    
    /** Upload feature image */
    $wp_customize->add_setting(
        'about_image',
        array(
            'default' => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_number_absint',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Cropped_Image_Control(
           $wp_customize,
           'about_image',
           array(
               'label'      => __( 'Upload Feature Image', 'travel-agency-pro' ),
               'section'    => 'intro_about_section',
               'width'       => 1290,
               'height'      => 550,
           )
       )
    );
    
    /** Title */
    $wp_customize->add_setting(
        'about_intro_title',
        array(
            'default'           => __( 'Create your Travel Booking Website with Travel Agency Theme', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_intro_title',
        array(
            'label'    => __( 'Intro Title', 'travel-agency-pro' ),
            'section'  => 'intro_about_section',
            'type'     => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_intro_title', array(
        'selector' => '#about_intro .text-holder .title',
        'render_callback' => 'travel_agency_pro_get_about_intro_title',
    ) );
    
    /** Content */
    $wp_customize->add_setting(
        'about_intro_content',
        array(
            'default'           => __( 'Tell a story about your company here. You can modify this section from Appearance > Customize > Home Page Settings > About Section.

Travel Agency is a free WordPress theme that you can use create stunning and functional travel and tour booking website. It is lightweight, responsive and SEO friendly. It is compatible with WP Travel Engine, a WordPress plugin for travel booking.

It is also translation ready. So you can translate your website in any language.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_intro_content',
        array(
            'label'    => __( 'Intro Content', 'travel-agency-pro' ),
            'section'  => 'intro_about_section',
            'type'     => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_intro_content', array(
        'selector' => '#about_intro .text-holder .section-content',
        'render_callback' => 'travel_agency_pro_get_about_intro_sub_title',
    ) ); 

    /** Ad Image/Code */
	$wp_customize->add_setting( 
        'about_ad_content',
		array(
			'default' => '<img src="' . get_template_directory_uri() . '/images/fallback/img81.jpg">',
        )
    );

	$wp_customize->add_control(
		new Travel_Agency_Pro_Editor_Control(
			$wp_customize,
			'about_ad_content',
			array(
				'label'    => __( 'Ad Image/Code', 'travel-agency-pro' ),
				'section'  => 'intro_about_section',
			)
		)
	);           
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_intro' );