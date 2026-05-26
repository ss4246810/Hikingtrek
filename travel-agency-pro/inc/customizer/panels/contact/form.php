<?php
/**
 * Contact Form Address Option.
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_contact_form( $wp_customize ) {
    
    /** Contact Page Settings */
    $wp_customize->add_section( 
        'contact_form_settings',
         array(        
            'title'    => __( 'Contact Form Settings', 'travel-agency-pro' ),
            'panel'    => 'contact_page_setting',
            'priority' => 30,            
        ) 
    );
    
    /** Contact Info Title  */
    $wp_customize->add_setting(
        'contact_info_title',
        array(
            'default'           => __( 'Leave Us Your Info', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_info_title',
        array(
            'label'       => __( 'Contact Info Title', 'travel-agency-pro' ),
            'section'     => 'contact_form_settings',
            'type'        => 'text',                                 
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_info_title', array(
        'selector' => '#form_section .section-header .section-title',
        'render_callback' => 'travel_agency_pro_contact_form_title',
    ) );
    
    /** Contact Info Content  */
    $wp_customize->add_setting(
        'contact_info_content',
        array(
            'default'           => __( 'The contact page is just for demonstration purpose. Please DON\'T contact us via the contact form. For any questions or support, contact us on our support forum.', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_info_content',
        array(
            'label'       => __( 'Contact Info Content', 'travel-agency-pro' ),
            'section'     => 'contact_form_settings',
            'type'        => 'textarea',                                 
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_info_content', array(
        'selector' => '#form_section .section-header .section-content',
        'render_callback' => 'travel_agency_pro_contact_form_sub_title',
    ) );
    
    if( is_cf7_activated() ){
        /** Contact Form  */
        $wp_customize->add_setting(
            'contact_form',
            array(
                'default'           => '',
                'sanitize_callback' => 'wp_kses_post',
            )
        );
        
        $wp_customize->add_control(
            'contact_form',
            array(
                'label'       => __( 'Contact Form', 'travel-agency-pro' ),
                'description' => __( 'Enter the Contact Form 7 Shortcode. Ex. [contact-form-7 id="186" title="Contact form 1"]', 'travel-agency-pro' ),
                'section'     => 'contact_form_settings',
                'type'        => 'text',                                    
            )
        );
    }else{
        $wp_customize->add_setting(
    		'contact_note',
    		array(
    			'sanitize_callback' => 'wp_kses_post'
    		)
    	);
    
    	$wp_customize->add_control(
    		new Rara_Controls_Info_Text( 
    			$wp_customize,
    			'contact_note',
    			array(
    				'section'     => 'contact_form_settings', 
                    'label'       => __( 'Contact Form', 'travel-agency-pro' ),   				
                    'description' => sprintf( __( 'Please add contact form 7 shortcode after installing and activating the %1$sContact Form 7%2$s.', 'travel-agency-pro' ), '<a href="' . admin_url( 'themes.php?page=tgmpa-install-plugins' ) . '" target="_blank">', '</a>' ),
    			)
    		)
       );                        
    }
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_contact_form' );