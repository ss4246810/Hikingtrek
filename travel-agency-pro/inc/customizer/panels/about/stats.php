<?php
/**
 * About Page Stats Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_about_stat( $wp_customize ){
    
    $wp_customize->add_section( 'stat_about_section', array(
        'title'      => __( 'Stats Section', 'travel-agency-pro' ),
        'priority'   => 50,
        'panel'      => 'about_page_setting',
        'capability' => 'edit_theme_options',
    ) );
    
    /** Title */
    $wp_customize->add_setting(
        'about_stat_counter_title',
        array(
            'default'           => __( 'Stats Counter', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'about_stat_counter_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'stat_about_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_stat_counter_title', array(
        'selector'        => '#about_stats .section-header .section-title',
        'render_callback' => 'travel_agency_pro_get_about_stats_title',
    ) );
    
    /** Description */
    $wp_customize->add_setting(
        'about_stat_counter_desc',
        array(
            'default'           => __( 'Display most valuable statistics about your company here. You can modify this section from Appearance > Customize > About Page Settings > Stats Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
        
    $wp_customize->add_control(
        'about_stat_counter_desc',
        array(
            'label'   => __( 'Description', 'travel-agency-pro' ),
            'section' => 'stat_about_section',
            'type'    => 'textarea',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_stat_counter_desc', array(
        'selector'        => '#about_stats .section-header .section-content',
        'render_callback' => 'travel_agency_pro_get_about_stats_sub_title',
    ) );
    
    /** Background Image */
    $wp_customize->add_setting(
        'about_stat_bg_image',
        array(
            'default'           => get_template_directory_uri() . '/images/fallback/img20.jpg',
            'sanitize_callback' => 'esc_url',
        )
    );
    
    $wp_customize->add_control(
       new WP_Customize_Image_Control(
           $wp_customize,
           'about_stat_bg_image',
           array(
               'label'   => __( 'Background Image', 'travel-agency-pro' ),
               'section' => 'stat_about_section',
           )
       )
    );
    
    /** Counters */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'about_counter', 
            array(
                'default' => travel_agency_pro_get_customizer_defaults( 'stats' ) /** NEED TO HAVE THIS IN THEME IN ABSENCE OF COMPANION PLUGIN */                  
            ) 
        ) 
    );
    
    $wp_customize->add_control(
    	new Travel_Agency_Control_Repeater(
    		$wp_customize,
    		'about_counter',
    		array(
    			'section' => 'stat_about_section',				
    			'label'	  => __( 'Add Counter', 'travel-agency-pro' ),
                'fields'  => array(
                    'icon' => array(
                        'type'  => 'font', 
                        'label' => __( 'Add Icon', 'travel-agency-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-pro' ),
                    ),
                    'number'   	=> array(
                        'type'  => 'text',
                        'label' => __( 'Number', 'travel-agency-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type' => 'field',
                    'value' => __( 'counter', 'travel-agency-pro' ),
                    'field' => 'title'
                ),                                                          
    		)
    	)
    );          
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_stat' );