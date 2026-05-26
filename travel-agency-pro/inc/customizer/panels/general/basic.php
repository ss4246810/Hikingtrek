<?php
/**
 * General Basic Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_basic( $wp_customize ) {
	
    /** Basic Settings */
    $wp_customize->add_section(
        'basic_settings',
        array(
            'title'    => __( 'Basic Settings', 'travel-agency-pro' ),
            'priority' => 10,
            'panel'    => 'general_settings',
        )
    );
    
    /** Admin Bar */
    $wp_customize->add_setting(
        'ed_adminbar',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_adminbar',
			array(
				'section'		=> 'basic_settings',
				'label'			=> __( 'Admin Bar', 'travel-agency-pro' ),
				'description'	=> __( 'Disable to hide Admin Bar in frontend when logged in.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Lightbox */
    $wp_customize->add_setting(
        'ed_lightbox',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_lightbox',
			array(
				'section'		=> 'basic_settings',
				'label'			=> __( 'Lightbox', 'travel-agency-pro' ),
				'description'	=> __( 'A lightbox is a stylized pop-up that allows your visitors to view larger versions of images without leaving the current page. You can enable or disable the lightbox here.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Layout Style */
    $wp_customize->add_setting( 'layout_style', array(
        'default'           => 'right-sidebar',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Image_Control(
			$wp_customize,
			'layout_style',
			array(
				'section'		=> 'basic_settings',
				'label'			=> __( 'Layout Style', 'travel-agency-pro' ),
				'description'	=> __( 'Choose the default sidebar position for your site. The position of the sidebar for individual posts can be set in the post editor.', 'travel-agency-pro' ),
				'choices'		=> array(
					'left-sidebar' => get_template_directory_uri() . '/images/left-sidebar.png',
                    'right-sidebar' => get_template_directory_uri() . '/images/right-sidebar.png',
				)
			)
		)
	);
    
    /** Pagination Type */
    $wp_customize->add_setting(
        'pagination_type',
        array(
            'default'           => 'numbered',
            'sanitize_callback' => 'travel_agency_pro_sanitize_select',
        )
    );
    
    $wp_customize->add_control(
        'pagination_type',
        array(
            'label'       => __( 'Pagination Type', 'travel-agency-pro' ),
            'description' => __( 'Select pagination type.', 'travel-agency-pro' ),
            'section'     => 'basic_settings',
            'type'        => 'radio',
            'choices'     => array(
                'default'         => __( 'Default (Next / Previous)', 'travel-agency-pro' ),
                'numbered'        => __( 'Numbered (1 2 3 4...)', 'travel-agency-pro' ),
                'load_more'       => __( 'AJAX (Load More Button)', 'travel-agency-pro' ),
                'infinite_scroll' => __( 'AJAX (Auto Infinite Scroll)', 'travel-agency-pro' ),
            )
        )
    );

     /** Load More Label */
    $wp_customize->add_setting(
        'load_more_label',
        array(
            'default'           => __( 'Load More Posts', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
       'load_more_label',
        array(
            'section' => 'basic_settings',
            'label'   => __( 'Load More Label', 'travel-agency-pro' ),
            'type'    => 'text',
            'active_callback' => 'travel_agency_pro_loading_ac' 
        )       
    );
    
    /** Loading Label */
    $wp_customize->add_setting(
        'loading_label',
        array(
            'default'           => __( 'Loading...', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
       'loading_label',
        array(
            'section' => 'basic_settings',
            'label'   => __( 'Loading Label', 'travel-agency-pro' ),
            'type'    => 'text',
            'active_callback' => 'travel_agency_pro_loading_ac' 
        )       
    );

      /** Nomore Posts */
    $wp_customize->add_setting(
        'nomore_post_label',
        array(
            'default'           => __( 'No More Post', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
       'nomore_post_label',
        array(
            'section' => 'basic_settings',
            'label'   => __( 'No more Post Label', 'travel-agency-pro' ),
            'type'    => 'text',
            'active_callback' => 'travel_agency_pro_loading_ac' 
        )       
    );
    
    /** Excerpt Word Count */
    $wp_customize->add_setting( 'excerpt_word', array(
        'default'           => 45,
        'sanitize_callback' => 'travel_agency_pro_sanitize_select'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Slider_Control( 
			$wp_customize,
			'excerpt_word',
			array(
				'section' => 'basic_settings',
				'label'	  => __( 'Excerpt Word Count', 'travel-agency-pro' ),
				'choices' => array(
					'min' 	=> 10,
					'max' 	=> 65,
					'step'	=> 1,
				)
			)
		)
	);
    
    /** Exclude Categories */
    $wp_customize->add_setting(
		'exclude_categories', 
		array(
			'default' => '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_multiple_check',						
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_MultiCheck_Control(
			$wp_customize,
			'exclude_categories',
			array(
				'section'     => 'basic_settings',
				'label'       => __( 'Exclude Categories', 'travel-agency-pro' ),
                'description' => __( 'Check multiple categories to exclude from blog and archive page.', 'travel-agency-pro' ),
				'choices'     => travel_agency_pro_get_categories( false )
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_basic' );

/**
 * Active Callback for contact phone
*/
function travel_agency_pro_loading_ac( $control ){
    
    $pagination_type = $control->manager->get_setting( 'pagination_type' )->value();
    
    if ( $pagination_type == 'load_more' ) return true;
    
    return false;
}