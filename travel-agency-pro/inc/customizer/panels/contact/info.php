<?php
/**
 * Contact Page Address Option.
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_contact_info( $wp_customize ) {
    
    /** Contact Page Settings */
    $wp_customize->add_section( 
        'contact_detail_settings',
         array(        
            'title'    => __( 'Contact Details Settings', 'travel-agency-pro' ),
            'panel'    => 'contact_page_setting',
            'priority' => 20,            
        ) 
    );
    
    /** Phone Label */
    $wp_customize->add_setting(
        'contact_phone_label',
        array(
            'default'           => __( 'Phone', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_phone_label',
        array(
            'label'   => __( 'Phone Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_phone_label', array(
        'selector' => '.contact-info #phone .title',
        'render_callback' => 'travel_agency_pro_phone_label',
    ) );
    
    /** Contact Phone  */
    $wp_customize->add_setting(
        'contact_phone',
        array(
            'default'           => __( '(888) 123-456789', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_phone',
        array(
            'label'       => __( 'Contact Phone', 'travel-agency-pro' ),
            'description' => __( 'Enter the contact phone. For Multiple Phone numbers seperate with comas. e.g, (888) 123-456789, 9876543210', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_phone', array(
        'selector' => '.contact-info #phone #phone-content',
        'render_callback' => 'travel_agency_pro_contact_phone',
    ) );
    
    /** Email Label */
    $wp_customize->add_setting(
        'email_label',
        array(
            'default'           => __( 'Email', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'email_label',
        array(
            'label'   => __( 'Email Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'email_label', array(
        'selector' => '.contact-info #email .title',
        'render_callback' => 'travel_agency_pro_email_label',
    ) );
    
    /** Contact Email  */
    $wp_customize->add_setting(
        'contact_email',
        array(
            'default'           => __( 'info@testing.com, info@gmail.com, support@test.com', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_email',
        array(
            'label'       => __( 'Contact Email', 'travel-agency-pro' ),
            'description' => __( 'Enter the contact email. For Multiple Emails seperate with comas. e.g, info@test.com, info@gmail.com', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                                    
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_email', array(
        'selector' => '.contact-info #email #email-content',
        'render_callback' => 'travel_agency_pro_contact_email',
    ) );
    
    /** Location Label */
    $wp_customize->add_setting(
        'location_label',
        array(
            'default'           => __( 'Location', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'location_label',
        array(
            'label'   => __( 'Location Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'location_label', array(
        'selector' => '.contact-info #location .title',
        'render_callback' => 'travel_agency_pro_location_label',
    ) );
    
    /** Contact Address  */
    $wp_customize->add_setting(
        'contact_address',
        array(
            'default'           => __( 'Travel Agency. PO Box 19604, Thamel Kathmandu, Nepal', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_address',
        array(
            'label'       => __( 'Contact Address', 'travel-agency-pro' ),
            'description' => __( 'Enter the contact address.', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                                    
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_address', array(
        'selector' => '.contact-info #location .address address',
        'render_callback' => 'travel_agency_pro_contact_address',
    ) );
    
    /** WhatsApp Label */
    $wp_customize->add_setting(
        'whatsapp_label',
        array(
            'default'           => __( 'WhatsApp', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'whatsapp_label',
        array(
            'label'   => __( 'WhatsApp Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'whatsapp_label', array(
        'selector' => '.contact-info #whatsap .title',
        'render_callback' => 'travel_agency_pro_whatsapp_label',
    ) );
    
    /** Contact What's App  */
    $wp_customize->add_setting(
        'contact_whatsapp',
        array(
            'default'           => __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_whatsapp',
        array(
            'label'       => __( 'Contact What\'s App', 'travel-agency-pro' ),
            'description' => __( 'Enter the contact phone. For Multiple Phone numbers seperate with comas. e.g, +977- 9876543210, +977-9877777777', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                                    
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_whatsapp', array(
        'selector' => '.contact-info #whatsap #whatsap-content',
        'render_callback' => 'travel_agency_pro_contact_whatsapp',
    ) );
    
    /** Skype Label */
    $wp_customize->add_setting(
        'skype_label',
        array(
            'default'           => __( 'Skype', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'skype_label',
        array(
            'label'   => __( 'Skype Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'skype_label', array(
        'selector' => '.contact-info #skype .title',
        'render_callback' => 'travel_agency_pro_skype_label',
    ) );
    
    /** Contact Skype  */
    $wp_customize->add_setting(
        'contact_skype',
        array(
            'default'           => __( 'skype@company.com', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_skype',
        array(
            'label'       => __( 'Contact Skype', 'travel-agency-pro' ),
            'description' => __( 'Enter the Skype IDs. For Multiple Skype IDs seperate with comas. e.g, skype@company.com, skype@testing.com', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                                    
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'contact_skype', array(
        'selector' => '.contact-info #skype #skype-content',
        'render_callback' => 'travel_agency_pro_contact_skype',
    ) );
    
    /** Viber Label */
    $wp_customize->add_setting(
        'viber_label',
        array(
            'default'           => __( 'Viber', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'viber_label',
        array(
            'label'   => __( 'Viber Label', 'travel-agency-pro' ),
            'section' => 'contact_detail_settings',
            'type'    => 'text',                               
        )
    );
    
    $wp_customize->selective_refresh->add_partial( 'viber_label', array(
        'selector' => '.contact-info #viber .title',
        'render_callback' => 'travel_agency_pro_viber_label',
    ) );
    
    /** Contact Viber  */
    $wp_customize->add_setting(
        'contact_viber',
        array(
            'default'           => __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ),
            'sanitize_callback' => 'wp_kses_post',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
        'contact_viber',
        array(
            'label'       => __( 'Contact Viber', 'travel-agency-pro' ),
            'description' => __( 'Enter the viber number. For Multiple Viber numbers seperate with comas. e.g, +977- 9876543210, +977-9877777777', 'travel-agency-pro' ),
            'section'     => 'contact_detail_settings',
            'type'        => 'textarea',                                    
        )
    );

    $wp_customize->selective_refresh->add_partial( 'contact_viber', array(
        'selector' => '.contact-info #viber #viber-content',
        'render_callback' => 'travel_agency_pro_contact_viber',
    ) );
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_contact_info' );