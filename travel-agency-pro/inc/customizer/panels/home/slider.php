<?php
/**
 * Home Page Slider Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_home_slider( $wp_customize ) {
    
    /** Slider Auto */
    $wp_customize->add_setting(
        'slider_auto',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'slider_auto',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Auto', 'travel-agency-pro' ),
                'description' => __( 'Enable slider auto transition.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
	);
    
    /** Slider Loop */
    $wp_customize->add_setting(
        'slider_loop',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'slider_loop',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Loop', 'travel-agency-pro' ),
                'description' => __( 'Enable slider loop.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
	);
    
    /** Slider Caption */
    $wp_customize->add_setting(
        'slider_caption',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'slider_caption',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Slider Caption', 'travel-agency-pro' ),
                'description' => __( 'Enable slider caption.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
	);
    
    /** Full Image */
    $wp_customize->add_setting(
        'slider_full_image',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'slider_full_image',
			array(
				'section'     => 'header_image',
				'label'       => __( 'Full Image', 'travel-agency-pro' ),
                'description' => __( 'Enable to use full size image in slider.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
	);
        
    /** Slider Animation */
    $wp_customize->add_setting(
		'slider_animation',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_animation',
    		array(
                'label'	      => __( 'Slider Animation', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'bounceOut'      => __( 'Bounce Out', 'travel-agency-pro' ),
                    'bounceOutLeft'  => __( 'Bounce Out Left', 'travel-agency-pro' ),
                    'bounceOutRight' => __( 'Bounce Out Right', 'travel-agency-pro' ),
                    'bounceOutUp'    => __( 'Bounce Out Up', 'travel-agency-pro' ),
                    'bounceOutDown'  => __( 'Bounce Out Down', 'travel-agency-pro' ),
                    'fadeOut'        => __( 'Fade Out', 'travel-agency-pro' ),
                    'fadeOutLeft'    => __( 'Fade Out Left', 'travel-agency-pro' ),
                    'fadeOutRight'   => __( 'Fade Out Right', 'travel-agency-pro' ),
                    'fadeOutUp'      => __( 'Fade Out Up', 'travel-agency-pro' ),
                    'fadeOutDown'    => __( 'Fade Out Down', 'travel-agency-pro' ),
                    'flipOutX'       => __( 'Flip OutX', 'travel-agency-pro' ),
                    'flipOutY'       => __( 'Flip OutY', 'travel-agency-pro' ),
                    'hinge'          => __( 'Hinge', 'travel-agency-pro' ),
                    'pulse'          => __( 'Pulse', 'travel-agency-pro' ),
                    'rollOut'        => __( 'Roll Out', 'travel-agency-pro' ),
                    'rotateOut'      => __( 'Rotate Out', 'travel-agency-pro' ),
                    'rubberBand'     => __( 'Rubber Band', 'travel-agency-pro' ),
                    'shake'          => __( 'Shake', 'travel-agency-pro' ),
                    ''               => __( 'Slide', 'travel-agency-pro' ),
                    'slideOutLeft'   => __( 'Slide Out Left', 'travel-agency-pro' ),
                    'slideOutRight'  => __( 'Slide Out Right', 'travel-agency-pro' ),
                    'slideOutUp'     => __( 'Slide Out Up', 'travel-agency-pro' ),
                    'slideOutDown'   => __( 'Slide Out Down', 'travel-agency-pro' ),
                    'swing'          => __( 'Swing', 'travel-agency-pro' ),
                    'tada'           => __( 'Tada', 'travel-agency-pro' ),
                    'zoomOut'        => __( 'Zoom Out', 'travel-agency-pro' ),
                    'zoomOutLeft'    => __( 'Zoom Out Left', 'travel-agency-pro' ),
                    'zoomOutRight'   => __( 'Zoom Out Right', 'travel-agency-pro' ),
                    'zoomOutUp'      => __( 'Zoom Out Up', 'travel-agency-pro' ),
                    'zoomOutDown'    => __( 'Zoom Out Down', 'travel-agency-pro' ),
                ),
                'active_callback' => 'travel_agency_pro_banner_ac'                	
     		)
		)
	); 
    
    /** HR */
    $wp_customize->add_setting(
        'hr',
        array(
            'default'           => '',
            'sanitize_callback' => 'wp_kses_post' 
        )
    );
    
    $wp_customize->add_control(
        new Rara_Controls_Info_Text( 
			$wp_customize,
			'hr',
			array(
				'section'	  => 'header_image',
				'description' => '<hr/>',
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
    );
    
    /** Slider Type */
    $wp_customize->add_setting(
		'slider_type',
		array(
			'default'			=> 'post',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_type',
    		array(
                'label'	      => __( 'Choose Slider Type', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => array(
                    'post'   => __( 'Post/Page', 'travel-agency-pro' ),
                    'cat'    => __( 'Category', 'travel-agency-pro' ),
                    'custom' => __( 'Custom', 'travel-agency-pro' ),
                ),
                'active_callback' => 'travel_agency_pro_banner_ac'                	
     		)
		)
	); 
    
    /** Select Post One */
    $wp_customize->add_setting(
		'slider_post_one',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_post_one',
    		array(
                'label'	      => __( 'Choose Post One', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_posts( array( 'post', 'page' ) ),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Select Post Two */
    $wp_customize->add_setting(
		'slider_post_two',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_post_two',
    		array(
                'label'	      => __( 'Choose Post Two', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_posts( array( 'post', 'page' ) ),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Select Post Three */
    $wp_customize->add_setting(
		'slider_post_three',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_post_three',
    		array(
                'label'	      => __( 'Choose Post Three', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_posts( array( 'post', 'page' ) ),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Select Post Four */
    $wp_customize->add_setting(
		'slider_post_four',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_post_four',
    		array(
                'label'	      => __( 'Choose Post Four', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_posts( array( 'post', 'page' ) ),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Select Post Five */
    $wp_customize->add_setting(
		'slider_post_five',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_post_five',
    		array(
                'label'	      => __( 'Choose Post Five', 'travel-agency-pro' ),
                'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_posts( array( 'post', 'page' ) ),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Select Category */
    $wp_customize->add_setting(
		'slider_cat',
		array(
			'default'			=> '',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'slider_cat',
    		array(
                'label'	      => __( 'Slider Category', 'travel-agency-pro' ),
                'description' => __( 'Choose slider category for banner.', 'travel-agency-pro' ),
    			'section'     => 'header_image',
    			'choices'     => travel_agency_pro_get_categories(),
                'active_callback' => 'travel_agency_pro_banner_ac'	
     		)
		)
	);
    
    /** Add Slides */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'slider_custom', 
            array(
                'default' => '',                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'slider_custom',
			array(
				'section' => 'header_image',				
				'label'	  => __( 'Add Sliders', 'travel-agency-pro' ),
                'fields'  => array(
                    'thumbnail' => array(
                        'type'  => 'image', 
                        'label' => __( 'Add Image', 'travel-agency-pro' ),                
                    ),
                    'title'     => array(
                        'type'  => 'text',
                        'label' => __( 'Title', 'travel-agency-pro' ),
                    ),                    
                    'link'     => array(
                        'type'  => 'text',
                        'label' => __( 'Link', 'travel-agency-pro' ),
                    ),
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'Slide', 'travel-agency-pro' ),
                    'field' => 'title'
                ),
                'active_callback' => 'travel_agency_pro_banner_ac'                                              
			)
		)
	);
    
    /** Read More Text */
    $wp_customize->add_setting(
        'slider_readmore',
        array(
            'default'           => __( 'Read More', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
        )
    );
    
    $wp_customize->add_control(
        'slider_readmore',
        array(
            'label'       => __( 'Readmore Text', 'travel-agency-pro' ),
            'section'     => 'header_image',
            'type'        => 'text',
            'active_callback' => 'travel_agency_pro_banner_ac'
        )
    );  
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_slider' );