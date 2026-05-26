<?php
/**
 * Home Page Testimonial Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_home_testimonial( $wp_customize ){
    
    /** Testimonial Section */   
    $wp_customize->add_section( 'testimonial_section', array(
        'title'    => __( 'Testimonial Section', 'travel-agency-pro' ),
        'priority' => 46,
        'panel'    => 'home_page_setting',
    ) ); 
    
    /** Title */
    $wp_customize->add_setting(
        'testimonial_section_title',
        array(
            'default'           => __( 'Testimonials', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_section_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'testimonial_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'testimonial_section_title', array(
        'selector' => '#testimonial_section .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_testimonial_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'testimonial_section_subtitle',
        array(
            'default'           => __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'testimonial_section_subtitle',
        array(
            'label'   => __( 'Sub Title', 'travel-agency-pro' ),
            'section' => 'testimonial_section',
            'type'    => 'textarea',
        )
    );    
    
    $wp_customize->selective_refresh->add_partial( 'testimonial_section_subtitle', array(
        'selector' => '#testimonial_section .section-header .section-content',
        'render_callback' => 'travel_agency_pro_get_testimonial_sub_title',
    ) );

    /** Testimonial Demo */
    $wp_customize->add_setting(
        'ed_testimonial_demo',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_testimonial_demo',
			array(
				'section'     => 'testimonial_section',
				'label'       => __( 'Enable Testimonial Demo Content', 'travel-agency-pro' ),
                'description' => __( 'If there are no testimonial, demo content will be displayed. Uncheck to hide demo content of this section.', 'travel-agency-pro' )
			)
		)
	);

     /** H1 Font Size */
    $wp_customize->add_setting( 'no_of_testimonial', array(
        'default'           => 3,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
        new Rara_Controls_Slider_Control( 
            $wp_customize,
            'no_of_testimonial',
            array(
                'section' => 'testimonial_section',
                'label'   => __( 'Number of testimonials', 'travel-agency-pro' ),
                'choices' => array(
                    'min'   => 1,
                    'max'   => 15,
                    'step'  => 1,
                )
            )
        )
    );
    

    /** Post Order */    
    $wp_customize->add_setting( 
        'testimonial_post_order', 
        array(
            'default'           => 'date',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'testimonial_post_order',
			array(
				'section'	  => 'testimonial_section',
				'label'       => __( 'Post Order', 'travel-agency-pro' ),
                'description' => __( 'Choose post order for testimonial post.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'date'       => __( 'Date', 'travel-agency-pro' ),
                    'menu_order' => __( 'Menu Order', 'travel-agency-pro' ),
				)
			)
		)
	);    

}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_testimonial' );