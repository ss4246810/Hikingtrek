<?php
/**
 * Home Page Search Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_home_search( $wp_customize ){
    
    /** Search Section */   
    $wp_customize->add_section( 'search_section', array(
        'title'    => __( 'Search Section', 'travel-agency-pro' ),
        'priority' => 11,
        'panel'    => 'home_page_setting',
    ) ); 
    
    if( is_wte_advanced_search_active() ){
        /** Enable Search Bar */
        $wp_customize->add_setting(
            'ed_search_bar',
            array(
                'default'           => true,
                'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
            )
        );
        
        $wp_customize->add_control(
    		new Rara_Controls_Toggle_Control( 
    			$wp_customize,
    			'ed_search_bar',
    			array(
    				'section'     => 'search_section',
    				'label'       => __( 'Search Bar', 'travel-agency-pro' ),
                    'description' => __( 'Enable Search Bar', 'travel-agency-pro' ),
    			)
    		)
    	);
    }else{
        /** Note */
        $wp_customize->add_setting(
            'search_text',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post' 
            )
        );
        
        $wp_customize->add_control(
            new Rara_Controls_Info_Text( 
    			$wp_customize,
    			'search_text',
    			array(
    				'section'	  => 'search_section',
    				'description' => sprintf( __( 'Please install and activate the recommended plugin %1$sWP Travel Engine - Trip Search%2$s and refresh the customizer. After that option related with this section will be visible.', 'travel-agency-pro' ), '<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '" target="_blank">', '</a>' )
    			)
    		)
        );        
    }         
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_home_search' ); 