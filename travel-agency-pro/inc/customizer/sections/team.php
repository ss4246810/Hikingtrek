<?php
/**
 * Team Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_team( $wp_customize ) {
    
    $wp_customize->add_section( 'team_page_setting', array(
        'title'      => __( 'Team Page Settings', 'travel-agency-pro' ),
        'priority'   => 45,
        'capability' => 'edit_theme_options',
    ) );
    
    /** Post Order */    
    $wp_customize->add_setting( 
        'team_post_order', 
        array(
            'default'           => 'date',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'team_post_order',
			array(
				'section'	  => 'team_page_setting',
				'label'       => __( 'Post Order', 'travel-agency-pro' ),
                'description' => __( 'Choose post order for team post.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'date'       => __( 'Date', 'travel-agency-pro' ),
                    'menu_order' => __( 'Menu Order', 'travel-agency-pro' ),
				),
			)
		)
	);    
    
    /** Featured Image */    
    $wp_customize->add_setting( 
        'team_page_image', 
        array(
            'default'           => 'featured_image',
            'sanitize_callback' => 'esc_attr'
        ) 
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'team_page_image',
			array(
				'section'	  => 'team_page_setting',
				'label'       => __( 'Featured Image', 'travel-agency-pro' ),
                'description' => __( 'Choose featured image or slider for team page.', 'travel-agency-pro' ),
				'choices'	  => array(                                      					
                    'featured_image'  => __( 'Featured Image', 'travel-agency-pro' ),
                    'featured_slider' => __( 'Featured Slider', 'travel-agency-pro' ),
				),
			)
		)
	);
    
    /** Team Note*/
    $wp_customize->add_setting(
		'team_page_note',
		array(
			'sanitize_callback' => 'wp_kses_post'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Info_Text( 
			$wp_customize,
			'team_page_note',
			array(
				'section'     => 'team_page_setting',  				
                'description' => __( 'The featured image of Team Page template will be displayed if set.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_team_page_ac'
			)
		)
    );
    
    /** Team Gallery */        
    $wp_customize->add_setting( 
        'team_page_slider', 
        array(
            'default' => array(),
            'sanitize_callback' => 'wp_parse_id_list',
        ) 
    );
    
    $wp_customize->add_control( 
        new Rara_Gallery_Control(
            $wp_customize,
            'team_page_slider',
            array(
                'label'    => __( 'Team Image Slider', 'travel-agency-pro' ),
                'section'  => 'team_page_setting',
                'active_callback' => 'travel_agency_pro_team_page_ac'
            )
        ) 
    );  
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_team' );

/**
 * Active Callback
*/
function travel_agency_pro_team_page_ac( $control ){
    $img_type = $control->manager->get_setting( 'team_page_image' )->value();
    $control_id = $control->id;
    
    if ( $control_id == 'team_page_note' && $img_type == 'featured_image' ) return true;
    if ( $control_id == 'team_page_slider' && $img_type == 'featured_slider' ) return true;
    
    return false;
}