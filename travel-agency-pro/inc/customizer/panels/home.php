<?php
/**
 * Home Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_home( $wp_customize ) {
    
    $wp_customize->add_panel( 'home_page_setting', array(
        'title'      => __( 'Front Page Settings', 'travel-agency-pro' ),
        'priority'   => 30,
        'capability' => 'edit_theme_options',
    ) );
    
    $wp_customize->get_section( 'header_image' )->panel    = 'home_page_setting';
    $wp_customize->get_section( 'header_image' )->title    = __( 'Banner Section', 'travel-agency-pro' );
    $wp_customize->get_section( 'header_image' )->priority = 10;
    $wp_customize->get_control( 'header_image' )->active_callback = 'travel_agency_pro_banner_ac';
    $wp_customize->get_control( 'header_video' )->active_callback = 'travel_agency_pro_banner_ac';
    $wp_customize->get_control( 'external_header_video' )->active_callback = 'travel_agency_pro_banner_ac';
    $wp_customize->get_section( 'header_image' )->description = '';                                               
    $wp_customize->get_setting( 'header_image' )->transport = 'refresh';
    $wp_customize->get_setting( 'header_video' )->transport = 'refresh';
    $wp_customize->get_setting( 'external_header_video' )->transport = 'refresh';   
    
    
    /** Remove control from plugins */
    $wp_customize->remove_control( 'ed_about_section' );
    $wp_customize->remove_control( 'ed_activities_section' );
    $wp_customize->remove_control( 'ed_popular_section' );
    $wp_customize->remove_control( 'ed_why_us_section' );
    $wp_customize->remove_control( 'ed_feature_section' );
    $wp_customize->remove_control( 'ed_stat_section' );
    $wp_customize->remove_control( 'ed_deal_section' );
    $wp_customize->remove_control( 'ed_cta_section' );
    
    /** Banner Options */
    $wp_customize->add_setting(
		'ed_banner_section',
		array(
			'default'			=> 'static_banner',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'ed_banner_section',
    		array(
                'label'	      => __( 'Banner Options', 'travel-agency-pro' ),
                'description' => __( 'Choose banner as static image/video or as a slider.', 'travel-agency-pro' ),
    			'section'     => 'header_image',
    			'choices'     => array(
                    'no_banner'     => __( 'Disable Banner Section', 'travel-agency-pro' ),
                    'static_banner' => __( 'Static/Video Banner', 'travel-agency-pro' ),
                    'slider_banner' => __( 'Banner as Slider', 'travel-agency-pro' ),
                ),
                'priority' => 5	
     		)            
		)
	);
    
    /** Enable/Disable Search Form */
    $wp_customize->add_setting(
        'ed_banner_search',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
            'transport'         => 'postMessage',
            
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_banner_search',
			array(
				'section'	  => 'header_image',
                'label'		  => __( 'Search Form', 'travel-agency-pro' ),
                'description' => __( 'Enable to show search form in banner.', 'travel-agency-pro' ),
                'active_callback' => 'travel_agency_pro_banner_ac'
			)
		)
	);
    
    
    $wp_customize->selective_refresh->add_partial( 'ed_banner_search', array(
        'selector' => '.banner .banner-form',
        'render_callback' => 'travel_agency_pro_get_banner_search',
    ) );
    
    /** Title */
    $wp_customize->add_setting(
        'banner_title',
        array(
            'default'           => __( 'Find Your Best Holiday', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_title',
        array(
            'label'    => __( 'Title', 'travel-agency-pro' ),
            'section'  => 'header_image',
            'type'     => 'text',
            'active_callback' => 'travel_agency_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_title', array(
        'selector' => '.banner .form-holder .text h1',
        'render_callback' => 'travel_agency_pro_get_banner_title',
    ) );
    
    /** Sub Title */
    $wp_customize->add_setting(
        'banner_subtitle',
        array(
            'default'           => __( 'Find great adventure holidays and activities around the planet.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'banner_subtitle',
        array(
            'label'    => __( 'Sub Title', 'travel-agency-pro' ),
            'section'  => 'header_image',
            'type'     => 'textarea',
            'active_callback' => 'travel_agency_pro_banner_ac'
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'banner_subtitle', array(
        'selector' => '.banner .form-holder .text .banner-content',
        'render_callback' => 'travel_agency_pro_get_banner_sub_title',
    ) );
        
        
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home' );

function travel_agency_pro_banner_ac( $control ){
    $banner      = $control->manager->get_setting( 'ed_banner_section' )->value();
    $slider_type = $control->manager->get_setting( 'slider_type' )->value(); 
    $control_id  = $control->id;
    
    if ( $control_id == 'header_image' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'external_header_video' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'ed_banner_search' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_title' && $banner == 'static_banner' ) return true;
    if ( $control_id == 'banner_subtitle' && $banner == 'static_banner' ) return true;
    
    if ( $control_id == 'slider_type' && $banner == 'slider_banner' ) return true;          
    if ( $control_id == 'slider_auto' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_loop' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_caption' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_full_image' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_animation' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'slider_readmore' && $banner == 'slider_banner' ) return true;
    if ( $control_id == 'hr' && $banner == 'slider_banner' ) return true;
    
    if ( $control_id == 'slider_post_one' && $banner == 'slider_banner' && $slider_type == 'post' ) return true;
    if ( $control_id == 'slider_post_two' && $banner == 'slider_banner' && $slider_type == 'post' ) return true;
    if ( $control_id == 'slider_post_three' && $banner == 'slider_banner' && $slider_type == 'post' ) return true;
    if ( $control_id == 'slider_post_four' && $banner == 'slider_banner' && $slider_type == 'post' ) return true;
    if ( $control_id == 'slider_post_five' && $banner == 'slider_banner' && $slider_type == 'post' ) return true;
    if ( $control_id == 'slider_cat' && $banner == 'slider_banner' && $slider_type == 'cat' ) return true;
    if ( $control_id == 'slider_custom' && $banner == 'slider_banner' && $slider_type == 'custom' ) return true;
    
    return false;        
}