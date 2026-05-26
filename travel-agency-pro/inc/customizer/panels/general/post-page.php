<?php
/**
 * General Post Page Settings
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_general_postpage( $wp_customize ) {
	
    /** Post Page */
    $wp_customize->add_section(
        'post_page_settings',
        array(
            'title'    => __( 'Post Page Settings', 'travel-agency-pro' ),
            'priority' => 20,
            'panel'    => 'general_settings',
        )
    );
    
    /** Author Bio */
    $wp_customize->add_setting(
        'ed_bio',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_bio',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Author Bio', 'travel-agency-pro' ),
                'description' => __( 'Enable to show Author Bio in Single Post. You have to insert "Biographical Info" from author&rsquo;s Profile page.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Featured Image */
    $wp_customize->add_setting(
        'ed_featured_image',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_featured_image',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Featured Image', 'travel-agency-pro' ),
                'description' => __( 'Enable to show Featured Image in Single Post/Page.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Comments */
    $wp_customize->add_setting(
        'ed_comments',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Show Comments', 'travel-agency-pro' ),
                'description' => __( 'Enable to show Comments in Single Post/Page.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Highlight Author Comment */
    $wp_customize->add_setting(
        'ed_auth_comments',
        array(
            'default'           => '',
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_auth_comments',
			array(
				'section'     => 'post_page_settings',
				'label'       => __( 'Highlight Author Comments', 'travel-agency-pro' ),
                'description' => __( 'Enable to higlight Author Comments.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Enable/Disable Related Posts */
    $wp_customize->add_setting(
        'ed_related',
        array(
            'default'           => true,
            'sanitize_callback' => 'travel_agency_pro_sanitize_checkbox',
        )
    );
    
    $wp_customize->add_control(
		new Rara_Controls_Toggle_Control( 
			$wp_customize,
			'ed_related',
			array(
				'section'     => 'post_page_settings',
				'label'		  => __( 'Related Posts', 'travel-agency-pro' ),
                'description' => __( 'Enable to show related posts in single post page.', 'travel-agency-pro' ),
			)
		)
	);
    
    /** Related Title */
    $wp_customize->add_setting(
        'related_title',
        array(
            'default'           => __( 'You may also like...', 'travel-agency-pro' ),
            'sanitize_callback' => 'sanitize_text_field',
            'transport'         => 'postMessage'
        )
    );
    
    $wp_customize->add_control(
		'related_title',
		array(
			'section' => 'post_page_settings',
			'label'	  => __( 'Related Post Title', 'travel-agency-pro' ),
            'type'    => 'text',
            'active_callback' => 'travel_agency_pro_related_post_label_show'
		)		
	);
    
    $wp_customize->selective_refresh->add_partial( 'related_title', array(
        'selector'        => '.site-main .related-post .title',
        'render_callback' => 'travel_agency_pro_get_related_title',
    ) );
    
    /** Related Post Taxonomy */    
    $wp_customize->add_setting( 'related_taxonomy', array(
        'default'           => 'cat',
        'sanitize_callback' => 'esc_attr'
    ) );
    
    $wp_customize->add_control(
		new Rara_Controls_Radio_Buttonset_Control(
			$wp_customize,
			'related_taxonomy',
			array(
				'section'	  => 'post_page_settings',
				'label'       => __( 'Related Post Taxonomy', 'travel-agency-pro' ),
                'description' => __( 'Choose Categories/Tags to display related post based on in Single Post.', 'travel-agency-pro' ),
				'choices'	  => array(
					'cat'   => __( 'Category', 'travel-agency-pro' ),
                    'tag'   => __( 'Tags', 'travel-agency-pro' ),
				),
                'active_callback' => 'travel_agency_pro_related_post_label_show'
			)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_general_postpage' );

/**
 * Active Callback for Related Post Label
*/
function travel_agency_pro_related_post_label_show( $control ){
    $ed_related = $control->manager->get_setting( 'ed_related' )->value();
    
    if ( $ed_related ) return true;
    
    return false;
}