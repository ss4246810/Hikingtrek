<?php
/**
 * About Page Team Settings
 *
 * @package Travel_Agency_Pro
 */
 
function travel_agency_pro_customize_register_about_team( $wp_customize ){
    
    /** Team Section */   
    $wp_customize->add_section( 'about_team_section', array(
        'title'    => __( 'Team Section', 'travel-agency-pro' ),
        'priority' => 55,
        'panel'    => 'about_page_setting',
    ) ); 
    
    /** Title */
    $wp_customize->add_setting(
        'about_team_section_title',
        array(
            'default'           => __( 'Our Team', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_team_section_title',
        array(
            'label'   => __( 'Title', 'travel-agency-pro' ),
            'section' => 'about_team_section',
            'type'    => 'text',
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'about_team_section_title', array(
        'selector' => '#about_team .section-header .section-title',
        'render_callback' => 'travel_agency_pro_about_team_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'about_team_section_subtitle',
        array(
            'default'           => __( 'Show your teams to your customers here. You can customize this section from Appearance > Customize > About Page Settings > Team Section.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'about_team_section_subtitle',
        array(
            'label'   => __( 'Sub Title', 'travel-agency-pro' ),
            'section' => 'about_team_section',
            'type'    => 'textarea',
        )
    );    
    
    $wp_customize->selective_refresh->add_partial( 'about_team_section_subtitle', array(
        'selector' => '#about_team .section-header .section-content',
        'render_callback' => 'travel_agency_pro_about_team_sub_title',
    ) );
    
    /** No. of Team */
    $wp_customize->add_setting(
		'no_of_team',
		array(
			'default'			=> '12',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'no_of_team',
    		array(
                'label'       => __( 'No. of Team', 'travel-agency-pro' ),
                'section'     => 'about_team_section',            
    			'choices'     => array(
                    '4'  => __( '4', 'travel-agency-pro' ),
                    '8'  => __( '8', 'travel-agency-pro' ),
                    '12' => __( '12', 'travel-agency-pro' ),
                ),
     		)
		)
	);
        
    /** Post Order */    
    $wp_customize->add_setting( 
        'about_team_post_order', 
        array(
            'default'           => 'date',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'about_team_post_order',
			array(
				'section'	  => 'about_team_section',
				'label'       => __( 'Post Order', 'travel-agency-pro' ),
                'description' => __( 'Choose post order for team post.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'date'       => __( 'Date', 'travel-agency-pro' ),
                    'menu_order' => __( 'Menu Order', 'travel-agency-pro' ),
				),
			)
		)
	);    

}
add_action( 'customize_register', 'travel_agency_pro_customize_register_about_team' );