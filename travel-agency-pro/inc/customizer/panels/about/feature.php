<?php
/**
 * About Page Feature Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about_feature( $wp_customize ){
    
    $wp_customize->add_section( 'whyus_about_section', array(
        'title'      => __( 'Why Us Section', 'travel-agency-pro' ),
        'priority'   => 30,
        'panel'      => 'about_page_setting',
        'capability' => 'edit_theme_options',
    ) );
    
    /** Title */
    $wp_customize->add_setting(
        'whyus_about_title',
        array(
            'default'           => __( 'Why Book with Us', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'whyus_about_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'whyus_about_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'whyus_about_title', array(
        'selector'        => '#about_whyus .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_about_whyus_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'whyus_about_desc',
        array(
            'default'           => __( 'Let your visitors know why they should trust you and book with you. You can modify this section from Appearance > Customize > Home Page Settings > Why Book with Us.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'whyus_about_desc',
        array(
            'label'   => __( 'Description', 'travel-agency-pro' ),
            'section' => 'whyus_about_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'whyus_about_desc', array(
        'selector'        => '#about_whyus .section-header .section-content',
        'render_callback' => 'travel_agency_pro_get_about_whyus_sub_title',
    ) );
    
    /** Background Image */
    $wp_customize->add_setting(
        'whyus_about_bg_image',
        array(
            'default'           => get_template_directory_uri() . '/images/fallback/img13.jpg',
            'sanitize_callback' => 'esc_url_raw',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'whyus_about_bg_image',
           array(
               'label'   => __( 'Background Image', 'travel-agency-pro' ),
               'section' => 'whyus_about_section',
           )
       )
    );
    
    /** Why Us Repeater */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'whyus_about', 
            array(
                'default' => travel_agency_pro_get_customizer_defaults( 'whyus' ),/** NEED TO HAVE THIS IN THEME IN ABSENCE OF COMPANION PLUGIN */                    
            ) 
        ) 
    );
    
    $wp_customize->add_control(
    	new Travel_Agency_Control_Repeater(
    		$wp_customize,
    		'whyus_about',
    		array(
    			'section' => 'whyus_about_section',				
    			'label'	  => __( 'Add Points', 'travel-agency-pro' ),
                'fields'  => array(
                    'whyus-icon' => array(
                        'type'  => 'font', 
                        'label' => __( 'Add Icon', 'travel-agency-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-pro' ),
                    ),
                    'description'	=> array(
                        'type'  	=> 'textarea',
                        'label' 	=> __( 'Desciption', 'travel-agency-pro' ),
                    ),
                    'url'     => array(
                        'type'  => 'url',
                        'label' => __( 'Link', 'travel-agency-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'points', 'travel-agency-pro' ),
                    'field' => 'title'
                ),                                        
    		)
    	)
    );          
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_feature' );