<?php
/**
 * Sidebar Options
 *
 * @package Travel_Agency_Pro
 */

function travel_agency_pro_customize_register_sidebar( $wp_customize ) {

    $wp_customize->add_section( 'sidebar_settings', array(
        'title'       => __( 'Sidebar Settings', 'travel-agency-pro' ),
        'priority'    => 55,
        'capability'  => 'edit_theme_options',
        'description' => __( 'Add custom sidebars. You need to save the changes and reload the customizer to use the sidebars in the dropdowns below.
You can add content to the sidebars in Appearance->Widgets.', 'travel-agency-pro' ),
    ) );
    
    /** Custom Sidebars */
    $wp_customize->add_setting( 
        new Travel_Agency_Repeater_Setting( 
            $wp_customize, 
            'sidebar', 
            array(
                'default' => '',                             
            ) 
        ) 
    );
    
    $wp_customize->add_control(
		new Travel_Agency_Control_Repeater(
			$wp_customize,
			'sidebar',
			array(
				'section' => 'sidebar_settings',				
				'label'	  => __( 'Add Sidebars', 'travel-agency-pro' ),
                'fields'  => array(
                    'name' => array(
                        'type'         => 'text',
                        'label'        => __( 'Name', 'travel-agency-pro' ),
                        'description'  => __( 'Example: Homepage Sidebar', 'travel-agency-pro' ),
                    )
                ),
                'row_label' => array(
                    'type'  => 'field',
                    'value' => __( 'sidebar', 'travel-agency-pro' ),
                    'field' => 'name'
                )                                              
			)
		)
	);
    
    /** Blog Page */
    $wp_customize->add_setting(
		'blog_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'blog_page_sidebar',
    		array(
                'label'	      => __( 'Blog Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the blog page.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true ),	
     		)
		)
	);
    
    /** Single Page */
    $wp_customize->add_setting(
		'single_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'single_page_sidebar',
    		array(
                'label'	      => __( 'Single Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the single pages. If a page has a custom sidebar set, it will override this.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true ),	
     		)
		)
	);
    
    /** Single Post */
    $wp_customize->add_setting(
		'single_post_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'single_post_sidebar',
    		array(
                'label'	      => __( 'Single Post Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the single posts. If a post has a custom sidebar set, it will override this.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true ),	
     		)
		)
	);
        
    /** Archive Page */
    $wp_customize->add_setting(
		'archive_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'archive_page_sidebar',
    		array(
                'label'	      => __( 'Archive Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the archives. Specific archive sidebars will override this setting (see below).', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true ),	
     		)
		)
	);
    
    /** Category Archive Page */
    $wp_customize->add_setting(
		'cat_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'cat_archive_page_sidebar',
    		array(
                'label'	      => __( 'Category Archive Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the category archives.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true, true ),	
     		)
		)
	);
    
    /** Tag Archive Page */
    $wp_customize->add_setting(
		'tag_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'tag_archive_page_sidebar',
    		array(
                'label'	      => __( 'Tag Archive Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the tag archives.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true, true ),	
     		)
		)
	);
    
    /** Date Archive Page */
    $wp_customize->add_setting(
		'date_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'date_archive_page_sidebar',
    		array(
                'label'	      => __( 'Date Archive Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the date archives.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true, true ),	
     		)
		)
	);
    
    /** Author Archive Page */
    $wp_customize->add_setting(
		'author_archive_page_sidebar',
		array(
			'default'			=> 'default-sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'author_archive_page_sidebar',
    		array(
                'label'	      => __( 'Author Archive Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the author archives.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true, true ),	
     		)
		)
	);
    
    /** Search Page */
    $wp_customize->add_setting(
		'search_page_sidebar',
		array(
			'default'			=> 'sidebar',
			'sanitize_callback' => 'travel_agency_pro_sanitize_select'
		)
	);

	$wp_customize->add_control(
		new Rara_Controls_Select_Control(
    		$wp_customize,
    		'search_page_sidebar',
    		array(
                'label'	      => __( 'Search Page Sidebar', 'travel-agency-pro' ),
                'description' => __( 'Select a sidebar for the search results.', 'travel-agency-pro' ),
    			'section'     => 'sidebar_settings',
    			'choices'     => travel_agency_pro_get_dynamnic_sidebar( true, true ),	
     		)
		)
	);
    
}
add_action( 'customize_register', 'travel_agency_pro_customize_register_sidebar' );