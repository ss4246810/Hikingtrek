<?php
/**
 * Custom Post Type
 * 
 * @package Travel_Agency_Pro
 */

if ( ! function_exists('travel_agency_pro_testimonial_cpt') ) :
/**
 * Register Testimonial Custom Post Type
 */
function travel_agency_pro_testimonial_cpt() {

	$labels = array(
		'name'                  => _x( 'Testimonials', 'Post Type General Name', 'travel-agency-pro' ),
		'singular_name'         => _x( 'Testimonial', 'Post Type Singular Name', 'travel-agency-pro' ),
		'menu_name'             => __( 'Testimonials', 'travel-agency-pro' ),
		'name_admin_bar'        => __( 'Testimonial', 'travel-agency-pro' ),
		'archives'              => __( 'Testimonial Archives', 'travel-agency-pro' ),
		'attributes'            => __( 'Testimonial Attributes', 'travel-agency-pro' ),
		'parent_item_colon'     => __( 'Parent Testimonial:', 'travel-agency-pro' ),
		'all_items'             => __( 'All Testimonials', 'travel-agency-pro' ),
		'add_new_item'          => __( 'Add New Testimonial', 'travel-agency-pro' ),
		'add_new'               => __( 'Add New', 'travel-agency-pro' ),
		'new_item'              => __( 'New Testimonial', 'travel-agency-pro' ),
		'edit_item'             => __( 'Edit Testimonial', 'travel-agency-pro' ),
		'update_item'           => __( 'Update Testimonial', 'travel-agency-pro' ),
		'view_item'             => __( 'View Testimonial', 'travel-agency-pro' ),
		'view_items'            => __( 'View Testimonials', 'travel-agency-pro' ),
		'search_items'          => __( 'Search Testimonial', 'travel-agency-pro' ),
		'not_found'             => __( 'Not found', 'travel-agency-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'travel-agency-pro' ),
		'featured_image'        => __( 'Featured Image', 'travel-agency-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'travel-agency-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'travel-agency-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'travel-agency-pro' ),
		'insert_into_item'      => __( 'Insert into testimonial', 'travel-agency-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this testimonial', 'travel-agency-pro' ),
		'items_list'            => __( 'Testimonials list', 'travel-agency-pro' ),
		'items_list_navigation' => __( 'Testimonials list navigation', 'travel-agency-pro' ),
		'filter_items_list'     => __( 'Filter testimonials list', 'travel-agency-pro' ),
	);
	$rewrite = array(
		'slug'                  => 'testimonial',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Testimonial', 'travel-agency-pro' ),
		'description'           => __( 'Testimonial Custom Post Type', 'travel-agency-pro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'thumbnail', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-testimonial',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'tap_testimonial', $args );

}
add_action( 'init', 'travel_agency_pro_testimonial_cpt', 0 );
endif;

if ( ! function_exists('travel_agency_pro_team_cpt') ) :
/**
 * Register Team Custom Post Type
*/
function travel_agency_pro_team_cpt() {

	$labels = array(
		'name'                  => _x( 'Teams', 'Post Type General Name', 'travel-agency-pro' ),
		'singular_name'         => _x( 'Team', 'Post Type Singular Name', 'travel-agency-pro' ),
		'menu_name'             => __( 'Teams', 'travel-agency-pro' ),
		'name_admin_bar'        => __( 'Team', 'travel-agency-pro' ),
		'archives'              => __( 'Team Archives', 'travel-agency-pro' ),
		'attributes'            => __( 'Team Attributes', 'travel-agency-pro' ),
		'parent_item_colon'     => __( 'Parent Team:', 'travel-agency-pro' ),
		'all_items'             => __( 'All Teams', 'travel-agency-pro' ),
		'add_new_item'          => __( 'Add New Team', 'travel-agency-pro' ),
		'add_new'               => __( 'Add New', 'travel-agency-pro' ),
		'new_item'              => __( 'New Team', 'travel-agency-pro' ),
		'edit_item'             => __( 'Edit Team', 'travel-agency-pro' ),
		'update_item'           => __( 'Update Team', 'travel-agency-pro' ),
		'view_item'             => __( 'View Team', 'travel-agency-pro' ),
		'view_items'            => __( 'View Teams', 'travel-agency-pro' ),
		'search_items'          => __( 'Search Team', 'travel-agency-pro' ),
		'not_found'             => __( 'Not found', 'travel-agency-pro' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'travel-agency-pro' ),
		'featured_image'        => __( 'Featured Image', 'travel-agency-pro' ),
		'set_featured_image'    => __( 'Set featured image', 'travel-agency-pro' ),
		'remove_featured_image' => __( 'Remove featured image', 'travel-agency-pro' ),
		'use_featured_image'    => __( 'Use as featured image', 'travel-agency-pro' ),
		'insert_into_item'      => __( 'Insert into team', 'travel-agency-pro' ),
		'uploaded_to_this_item' => __( 'Uploaded to this team', 'travel-agency-pro' ),
		'items_list'            => __( 'Teams list', 'travel-agency-pro' ),
		'items_list_navigation' => __( 'Teams list navigation', 'travel-agency-pro' ),
		'filter_items_list'     => __( 'Filter teams list', 'travel-agency-pro' ),
	);
	$rewrite = array(
		'slug'                  => 'team',
		'with_front'            => true,
		'pages'                 => true,
		'feeds'                 => true,
	);
	$args = array(
		'label'                 => __( 'Team', 'travel-agency-pro' ),
		'description'           => __( 'Team Custom Post Type', 'travel-agency-pro' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor', 'excerpt', 'thumbnail', 'page-attributes', ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 25,
		'menu_icon'             => 'dashicons-groups',
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'rewrite'               => $rewrite,
		'capability_type'       => 'post',
	);
	register_post_type( 'tap_team', $args );

}
add_action( 'init', 'travel_agency_pro_team_cpt', 0 );
endif;