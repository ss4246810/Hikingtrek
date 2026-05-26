<?php
/**
 * About Page Testimonial Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_about_testimonial( $wp_customize ){
    
    /** Testimonial Section */   
    $wp_customize->add_section( 'about_testimonial_section', array(
        'title'    => __( 'Testimonial Section', 'travel-agency-pro' ),
        'priority' => 55,
        'panel'    => 'about_page_setting',
    ) ); 
    
    /** Title */
    $wp_customize->add_setting(
        'about_testimonial_section_title',
        array(
            'default'           => __( 'Testimonials', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_testimonial_section_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'about_testimonial_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_testimonial_section_title', array(
        'selector' => '#about_testimonial .section-header .section-title',
        'render_callback' => 'travel_agency_pro_about_testimonial_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'about_testimonial_section_subtitle',
        array(
            'default'           => __( 'Show your testimonial here. You can modify this section from Appearance > Customize > About Page Settings > Testimonial Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_testimonial_section_subtitle',
        array(
            'label'   => __( 'Sub Title', 'travel-agency-pro' ),
            'section' => 'about_testimonial_section',
            'type'    => 'textarea',
        )
    );    
    
    $wp_customize->selective_refresh->add_partial( 'about_testimonial_section_subtitle', array(
        'selector' => '#about_testimonial .section-header .section-content',
        'render_callback' => 'travel_agency_pro_about_testimonial_sub_title',
    ) );

    /** Post Order */    
    $wp_customize->add_setting( 
        'about_testimonial_post_order', 
        array(
            'default'           => 'date',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'about_testimonial_post_order',
			array(
				'section'	  => 'about_testimonial_section',
				'label'       => __( 'Post Order', 'travel-agency-pro' ),
                'description' => __( 'Choose post order for testimonial post.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'date'       => __( 'Date', 'travel-agency-pro' ),
                    'menu_order' => __( 'Menu Order', 'travel-agency-pro' ),
				),
			)
		)
	);    

}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_testimonial' );