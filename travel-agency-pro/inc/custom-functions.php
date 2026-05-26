<?php
/**
 * Travel Agency custom functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Agency_Pro
 */

/**
 * Show/Hide Admin Bar in frontend.
*/
if( ! get_theme_mod( 'ed_adminbar', true ) ) add_filter( 'show_admin_bar', '__return_false' );

if ( ! function_exists( 'travel_agency_pro_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function travel_agency_pro_setup() {
	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on Travel Agency, use a find and replace
	 * to change 'travel-agency-pro' to the name of your theme in all the template files.
	 */
	load_theme_textdomain( 'travel-agency-pro', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Let WordPress manage the document title.
	 * By adding theme support, we declare that this theme does not use a
	 * hard-coded <title> tag in the document head, and expect WordPress to
	 * provide it for us.
	 */
	add_theme_support( 'title-tag' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );

	$menus = array(
		'primary' => esc_html__( 'Primary', 'travel-agency-pro' ),
        'mobile'  => esc_html__( 'Mobile Menu', 'travel-agency-pro' ),
        'trekking'  => esc_html__( 'Trekking In Nepal', 'travel-agency-pro' ),
        'peak-climbing'  => esc_html__( 'Peak Climbing', 'travel-agency-pro' ),
        'sightseeing-tours'  => esc_html__( 'Sightseeing Tours', 'travel-agency-pro' ),
        'adventure-activities'  => esc_html__( 'Adventure Activities', 'travel-agency-pro' ),

	);
    
    if( is_polylang_active() ){
        $menus['language'] = esc_html__( 'Language', 'travel-agency-pro' ); 
    }
    // This theme uses wp_nav_menu() in two location.
	register_nav_menus( $menus );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
	) );
    
    //Custom Header
    add_theme_support( 'custom-header', apply_filters( 'travel_agency_pro_custom_header_args', array(
		'default-image' => get_template_directory_uri() . '/images/fallback/banner-img.jpg',
        'video'         => true,
		'width'         => 1920,
		'height'        => 680,
        'header-text'   => false
	) ) );
    
	// Add theme support for selective refresh for widgets.
	add_theme_support( 'customize-selective-refresh-widgets' );
    
    /** Custom Logo */
    add_theme_support( 'custom-logo', array(    	
    	'header-text' => array( 'site-title', 'site-description' ),
    ) );
    
    /** Image Sizes */
    add_image_size( 'travel-agency-slider', 1920, 680, true );
    add_image_size( 'travel-agency-full', 1290, 540, true );
    add_image_size( 'travel-agency-popular', 630, 630, true );
    add_image_size( 'travel-agency-popular-small', 300, 300, true );
    add_image_size( 'travel-agency-blog', 410, 250, true );
    add_image_size( 'travel-agency-related', 280, 170, true );
    add_image_size( 'travel-agency-recent', 300, 170, true );
    add_image_size( 'travel-agency-team', 280, 350, true );
    add_image_size( 'travel-agency-team-detail', 300, 400, true );
    add_image_size( 'travel-agency-team-gallery', 293, 225, true );
    
    // Add theme support for Responsive Videos.
	add_theme_support( 'jetpack-responsive-videos' );
        
    /** Starter Content */
    $starter_content = array(
        // Specify the core-defined pages to create and add custom thumbnails to some of them.
		'posts' => array( 'home', 'blog' ),
		
        // Default to a static front page and assign the front and posts pages.
		'options' => array(
			'show_on_front' => 'page',
			'page_on_front' => '{{home}}',
			'page_for_posts' => '{{blog}}',
		),
        
        // Set up nav menus for each of the two areas registered in the theme.
		'nav_menus' => array(
			// Assign a menu to the "top" location.
			'primary' => array(
				'name' => __( 'Primary', 'travel-agency-pro' ),
				'items' => array(
					'page_home',
					'page_blog'
				)
			)
		),
    );
    
    $starter_content = apply_filters( 'travel_agency_pro_starter_content', $starter_content );

	add_theme_support( 'starter-content', $starter_content );
    
}
endif;
add_action( 'after_setup_theme', 'travel_agency_pro_setup' );

if( ! function_exists( 'travel_agency_pro_content_width' ) ) :
/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function travel_agency_pro_content_width() {
	$GLOBALS['content_width'] = apply_filters( 'travel_agency_pro_content_width', 910 );
}
endif;
add_action( 'after_setup_theme', 'travel_agency_pro_content_width', 0 );

if( ! function_exists( 'travel_agency_pro_template_redirect_content_width' ) ) :
/**
* Adjust content_width value according to template.
*
* @return void
*/
function travel_agency_pro_template_redirect_content_width(){	
    $sidebar = travel_agency_pro_sidebar( true );
    if( $sidebar ){
	   $GLOBALS['content_width'] = 910;        
	}else{
		$GLOBALS['content_width'] = 1290;
	}
}
endif;
add_action( 'template_redirect', 'travel_agency_pro_template_redirect_content_width' );

if( ! function_exists( 'travel_agency_pro_scripts' ) ) :
/**
 * Enqueue scripts and styles.
 */
function travel_agency_pro_scripts() {
	// Use minified libraries if SCRIPT_DEBUG is turned off
    $build  = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '/build' : '';
    $suffix = ( defined( 'SCRIPT_DEBUG' ) && SCRIPT_DEBUG ) ? '' : '.min';
    
    wp_enqueue_style( 'font-awesome', get_template_directory_uri(). '/css' . $build . '/font-awesome' . $suffix . '.css', array(), '4.7' );
    wp_enqueue_style( 'owl-carousel', get_template_directory_uri(). '/css' . $build . '/owl.carousel' . $suffix . '.css', array(), '2.2.1' );
    wp_enqueue_style( 'animate', get_template_directory_uri(). '/css' . $build . '/animate' . $suffix . '.css', array(), TAP_THEME_VERSION );
    wp_enqueue_style( 'travel-agency-pro-google-fonts', travel_agency_pro_fonts_url(), array(), null );
    wp_enqueue_style( 'travel-agency-pro', get_stylesheet_uri(), array(), TAP_THEME_VERSION );
    
    if( is_woocommerce_activated() )
    wp_enqueue_style( 'travel-agency-pro-worcommerce', get_template_directory_uri(). '/css' . $build . '/woocommerce' . $suffix . '.css', array( 'travel-agency-pro' ), TAP_THEME_VERSION );
    
    //Fancy Box
    if( get_theme_mod( 'ed_lightbox') ){
        wp_enqueue_style( 'jquery-fancybox', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.css', '', '2.1.5' );
        wp_enqueue_script( 'jquery-fancybox-pack', get_template_directory_uri() . '/js/fancybox/jquery.fancybox.pack.js', array('jquery'), '2.1.5', true );
    }
    
    if( ( is_front_page() && ! is_home() ) || is_tax() || is_page_template( 'templates/about.php' ) || is_page_template( 'templates/testimonial.php' ) ){
        wp_enqueue_style( 'jquery-rateyo', get_template_directory_uri() . '/inc/css/jquery.rateyo.min.css', array(), TAP_THEME_VERSION ); 
        wp_enqueue_script( 'jquery-rateyo', get_template_directory_uri() . '/inc/js/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', false );
    }
    
    if( is_page_template( 'templates/contact.php' ) ){
        $latitude      = get_theme_mod( 'latitude', 27.7204766 );
        $longitude     = get_theme_mod( 'longitude', 85.3389148 );
        $map_height    = get_theme_mod( 'map_height', 545 );
        $map_zoom      = get_theme_mod( 'map_zoom', 17 );
        $map_scroll    = get_theme_mod( 'ed_map_scroll', 'true' );
        $map_control   = get_theme_mod( 'ed_map_controls', 'true' );
        $map_api_key   = get_theme_mod( 'map_api' ); //'AIzaSyAZT7rXreW10gL5X8K0YSQ0en2V9BjDSm4';
        $ed_map_marker = get_theme_mod( 'ed_map_marker', false );
        $marker_title  = get_theme_mod( 'marker_title' );
        $custom_css    = '#map-canvas {	
                        width  : 100%;
                    	height : ' . absint( $map_height ) . 'px;
                    }';
        wp_add_inline_style( 'travel-agency-pro', $custom_css );
        wp_enqueue_script( 'travel-agency-pro-google-map', '//maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=' . $map_api_key );
        wp_enqueue_script( 'travel-agency-pro-google', get_template_directory_uri() . '/js' . $build . '/google' . $suffix . '.js', array( 'jquery', 'travel-agency-pro-google-map' ), TAP_THEME_VERSION, true );        
        
        $array = array(
            'latitude'     => esc_attr( $latitude ),
            'longitude'    => esc_attr( $longitude ),
            'zoom'         => absint( $map_zoom ), 
            'scroll'       => (bool) $map_scroll,
            'control'      => (bool) $map_control,
            'ed_marker'    => (bool) $ed_map_marker,
            'marker_title' => esc_html( $marker_title )
        );
        wp_localize_script( 'travel-agency-pro-google', 'tap_gdata', $array );
        
    }
    
	wp_enqueue_script( 'wow', get_template_directory_uri() . '/js' . $build . '/wow' . $suffix . '.js', array( 'jquery' ), TAP_THEME_VERSION, true );
    wp_enqueue_script( 'owl-carousel', get_template_directory_uri() . '/js' . $build . '/owl.carousel' . $suffix . '.js', array( 'jquery' ), '2.2.1', true );
    wp_enqueue_script( 'travel-agency-pro', get_template_directory_uri() . '/js' . $build . '/custom' . $suffix . '.js', array( 'jquery' ), TAP_THEME_VERSION, true );
    
    $slider_auto    = get_theme_mod( 'slider_auto', true );
    $slider_loop    = get_theme_mod( 'slider_loop', true );
    $animation      = get_theme_mod( 'slider_animation' );
    $header_layout  = get_theme_mod( 'header_layout', 'one' );
    $sticky_header  = get_theme_mod( 'ed_sticky_header' );
    
    $args = array(
        'url'       => admin_url( 'admin-ajax.php' ),
        'auto'      => esc_attr( $slider_auto ),
		'loop'      => esc_attr( $slider_loop ),
        'animation' => esc_attr( $animation ),
        'rtl'       => is_rtl(),
        'lightbox'  => esc_attr( get_theme_mod( 'ed_lightbox') ),
        'h_layout'  => esc_attr( $header_layout ),
        'sticky'    => esc_attr( $sticky_header ),
    );
    
    wp_localize_script( 'travel-agency-pro', 'tap_data', $args );
    
    $pagination = get_theme_mod( 'pagination_type', 'default' );
    $loadmore   = get_theme_mod( 'load_more_label', __( 'Load More Posts', 'travel-agency-pro' ) );
    $loading    = get_theme_mod( 'loading_label', __( 'Loading...', 'travel-agency-pro' ) );
    $nomore     = get_theme_mod( 'nomore_post_label', __( 'No More Post', 'travel-agency-pro' ) );
    
    if( $pagination == 'load_more' || $pagination == 'infinite_scroll' ){
        
        // Add parameters for the JS
        global $wp_query;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;
        $posts_per_page = get_option( 'posts_per_page' );
        
        if( is_page_template( 'templates/testimonial.php' ) ){
            $args = array(
                'post_type'      => 'tap_testimonial',
                'post_status'    => 'publish',
                'posts_per_page' => $posts_per_page,
                'paged'          => $paged,
            );
        
            $qry = new WP_Query( $args );
            $max = $qry->max_num_pages;    
        }else{
            $max = $wp_query->max_num_pages;
        }
        
        wp_enqueue_script( 'travel-agency-pro-ajax', get_template_directory_uri() . '/js' . $build . '/ajax' . $suffix . '.js', array('jquery'), TAP_THEME_VERSION, true );
        
        wp_localize_script( 
            'travel-agency-pro-ajax', 
            'tap_ajax',
            array(
                'startPage'  => $paged,
                'maxPages'   => $max,
                'nextLink'   => next_posts( $max, false ),
                'autoLoad'   => $pagination,
                'loadmore'   => $loadmore,
                'loading'    => $loading,
                'nomore'     => $nomore,
                'plugin_url' => plugins_url(),                
             )
        );
        
        if ( is_jetpack_activated( true ) ) {
            wp_enqueue_style( 'tiled-gallery', plugins_url() . '/jetpack/modules/tiled-gallery/tiled-gallery/tiled-gallery.css' );            
        }
    }
    
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
endif;
add_action( 'wp_enqueue_scripts', 'travel_agency_pro_scripts' );

if( ! function_exists( 'travel_agency_pro_admin_scripts' ) ) :
/**
 * Enqueue admin scripts and styles
*/
function travel_agency_pro_admin_scripts( $hook ){
    global $post;
    $screen = get_current_screen();
    
    $data = array( 'screen' => $screen->id );
    if( $screen->id == 'tap_testimonial'){
        wp_enqueue_style( 'jquery-ui', '//ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css' );
        wp_enqueue_style( 'jquery-rateyo', get_template_directory_uri() . '/inc/css/jquery.rateyo.min.css', array(), TAP_THEME_VERSION ); 
        wp_enqueue_script( 'jquery-rateyo', get_template_directory_uri() . '/inc/js/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', false );
        $data['id'] = $post->ID;   
    }
    
    if( $hook == 'post-new.php' || $hook == 'post.php' ){
        $data ['post_type'] = $post->post_type;
        wp_enqueue_style( 'travel-agency-pro-admin', get_template_directory_uri() . '/inc/css/admin.css', array(), TAP_THEME_VERSION );     
        wp_enqueue_script( 'travel-agency-pro-admin', get_template_directory_uri() . '/inc/js/admin.js', array( 'jquery', 'jquery-ui-sortable', 'jquery-ui-datepicker' ), TAP_THEME_VERSION, false );
        wp_localize_script( 'travel-agency-pro-admin', 'tap_admin', $data );
    }
    
    if( $screen->id == 'tap_team' ){
        wp_enqueue_script( 'travel-agency-pro-gallery', get_template_directory_uri() . '/inc/js/gallery.js', array( 'jquery' ), TAP_THEME_VERSION, false );
        $arr = array(
            'change_image' => __( 'Change Image', 'travel-agency-pro' ),
            'remove_image' => __( 'Remove Image', 'travel-agency-pro' ),
        );
        wp_localize_script( 'travel-agency-pro-gallery', 'tap_gallery_data', $arr );    
    }
    
    
}
endif;
add_action( 'admin_enqueue_scripts', 'travel_agency_pro_admin_scripts' );

if( ! function_exists( 'travel_agency_pro_body_classes' ) ) :
/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function travel_agency_pro_body_classes( $classes ) {
	
    $bg_color   = get_theme_mod( 'bg_color', '#ffffff' );
    $bg_image   = get_theme_mod( 'bg_image' );
    $bg_pattern = get_theme_mod( 'bg_pattern', 'nobg' );
    $bg         = get_theme_mod( 'body_bg', 'image' );
    
    // Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}
    
    // Adds a class for custom background Color
    if( $bg_color != '#ffffff' ){
        $classes[] = 'custom-background-color custom-background';
    }
    
    // Adds a class for custom background Color
    if( ( $bg == 'image' && $bg_image ) || (  $bg == 'pattern' && $bg_pattern != 'nobg' ) ){
        $classes[] = 'custom-background-image custom-background';
    }
    
    if( is_post_type_archive( 'trip' ) ){
        $classes[] = 'full-width';
    } 
    
    $classes[] = travel_agency_pro_sidebar( false, true );
    
	return $classes;
}
endif;
add_filter( 'body_class', 'travel_agency_pro_body_classes' );

if( ! function_exists( 'travel_agency_pro_post_classes' ) ) :
/**
 * Adds custom class in post class1
*/
function travel_agency_pro_post_classes( $classes ){
    if( is_search() || ( get_post_type() == 'tap_team' ) ){
        $classes[] = 'post';
    }
    
    $classes[] = 'latest_post';
    
    if( is_post_type_archive( 'trip' ) ){
        $classes[] = 'col';
    }
    
    return $classes;    
}
endif;
add_filter( 'post_class', 'travel_agency_pro_post_classes' );

if( ! function_exists( 'travel_agency_pro_pingback_header' ) ) :
/**
 * Add a pingback url auto-discovery header for singularly identifiable articles.
 */
function travel_agency_pro_pingback_header() {
	if ( is_singular() && pings_open() ) {
		echo '<link rel="pingback" href="', esc_url( get_bloginfo( 'pingback_url' ) ), '">';
	}
}
endif;
add_action( 'wp_head', 'travel_agency_pro_pingback_header' );

if ( ! function_exists( 'travel_agency_pro_excerpt_more' ) ) :
/**
 * Replaces "[...]" (appended to automatically generated excerpts) with ... * 
 */
function travel_agency_pro_excerpt_more() {
	return ' &hellip; ';
}

endif;
add_filter( 'excerpt_more', 'travel_agency_pro_excerpt_more' );

if ( ! function_exists( 'travel_agency_pro_excerpt_length' ) ) :
/**
 * Changes the default 55 character in excerpt 
*/
function travel_agency_pro_excerpt_length( $length ) {
	$excerpt_word = get_theme_mod( 'excerpt_word', 45 );
    return is_admin() ? $length : $excerpt_word;    
}
endif;
add_filter( 'excerpt_length', 'travel_agency_pro_excerpt_length', 999 );

if( ! function_exists( 'travel_agency_pro_change_comment_form_default_fields' ) ) :
/**
 * Change Comment form default fields i.e. author, email & url.
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_agency_pro_change_comment_form_default_fields( $fields ){
    
    // get the current commenter if available
    $commenter = wp_get_current_commenter();
 
    // core functionality
    $req = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );    
 
    // Change just the author field
    $fields['author'] = '<p class="comment-form-author"><label for="author">' . esc_html__( 'Name', 'travel-agency-pro' ) . '<span class="required">*</span></label><input id="author" name="author" placeholder="' . esc_attr__( 'Name*', 'travel-agency-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['email'] = '<p class="comment-form-email"><label for="email">' . esc_html__( 'Email', 'travel-agency-pro' ) . '<span class="required">*</span></label><input id="email" name="email" placeholder="' . esc_attr__( 'Email*', 'travel-agency-pro' ) . '" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></p>';
    
    $fields['url'] = '<p class="comment-form-url"><label for="url">' . esc_html__( 'Website', 'travel-agency-pro' ) . '</label><input id="url" name="url" placeholder="' . esc_attr__( 'Website', 'travel-agency-pro' ) . '" type="text" value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></p>'; 
    
    return $fields;
    
}
endif;
add_filter( 'comment_form_default_fields', 'travel_agency_pro_change_comment_form_default_fields' );

if( ! function_exists( 'travel_agency_pro_change_comment_form_defaults' ) ) :
/**
 * Change Comment Form defaults
 * https://blog.josemcastaneda.com/2016/08/08/copy-paste-hurting-theme/
*/
function travel_agency_pro_change_comment_form_defaults( $defaults ){
    
    $defaults['comment_field'] = '<p class="comment-form-comment"><label for="comment">' . esc_html__( 'Comment', 'travel-agency-pro' ) . '</label><textarea id="comment" name="comment" placeholder="' . esc_attr__( 'Comment', 'travel-agency-pro' ) . '" cols="45" rows="8" aria-required="true"></textarea></p>';
    
    return $defaults;
    
}
endif;
add_filter( 'comment_form_defaults', 'travel_agency_pro_change_comment_form_defaults' );

if( ! function_exists( 'travel_agency_pro_popular_post_img_size' ) ) :
/**
 * Popular Post Image size
*/
function travel_agency_pro_popular_post_img_size(){
    return 'travel-agency-recent';
}
endif;
add_filter( 'popular_post_size', 'travel_agency_pro_popular_post_img_size' );

if( ! function_exists( 'travel_agency_pro_recent_post_img_size' ) ) :
/**
 * Recent Post Image size
*/
function travel_agency_pro_recent_post_img_size(){
    return 'travel-agency-recent';
}
endif;
add_filter( 'recent_img_size', 'travel_agency_pro_recent_post_img_size' );

if( ! function_exists( 'travel_agency_pro_featured_post_img_size' ) ) :
/**
 * Featured Post Image size
*/
function travel_agency_pro_featured_post_img_size(){
    return 'travel-agency-recent';
}
endif;
add_filter( 'featured_img_size', 'travel_agency_pro_featured_post_img_size' );

if( ! function_exists( 'travel_agency_pro_tax_img_size' ) ) :
/**
 * Featured Post Image size
*/
function travel_agency_pro_tax_img_size(){
    return 'travel-agency-full';
}
endif;
add_filter( 'wp_travel_engine_template_banner_size', 'travel_agency_pro_tax_img_size' );

if( ! function_exists( 'travel_agency_pro_post_like_cb' ) ) :
/**
 * Ajax Callback for post like
*/
function travel_agency_pro_post_like_cb(){
    $post_id    = $_POST['id'];
    $count_key  = '_tap_post_like';
    $count = get_post_meta( $post_id, $count_key, true );
    
    if( ! $count ){
        $count = 1;        
        $return = add_post_meta( $post_id, $count_key, $count );
    }else{
        $count++;
        $return = update_post_meta( $post_id, $count_key, $count );
    }

    if( $return ) echo travel_agency_pro_get_like_count( $post_id );
    wp_die(); // this is required to terminate immediately and return a proper response        
}
endif;
add_action( 'wp_ajax_travel_agency_pro_post_like', 'travel_agency_pro_post_like_cb' );
add_action( 'wp_ajax_nopriv_travel_agency_pro_post_like', 'travel_agency_pro_post_like_cb' );

if( ! function_exists( 'travel_agency_pro_allowed_social_protocols' ) ) :
/**
 * List of allowed social protocols in HTML attributes.
 * @param  array $protocols Array of allowed protocols.
 * @return array
 */
function travel_agency_pro_allowed_social_protocols( $protocols ) {
    $social_protocols = array(
        'skype'
    );
    return array_merge( $protocols, $social_protocols );    
}
endif;
add_filter( 'kses_allowed_protocols' , 'travel_agency_pro_allowed_social_protocols' );

if( ! function_exists( 'travel_agency_pro_exclude_cat' ) ) :
/**
 * Exclude post with Category from blog and archive page. 
*/
function travel_agency_pro_exclude_cat( $query ){
    $cat = get_theme_mod( 'exclude_categories' );
    
    if( $cat && ! is_admin() && $query->is_main_query() ){
        $cat = array_diff( array_unique( $cat ), array('') );
        if( $query->is_home() || $query->is_archive() ) {
			$query->set( 'category__not_in', $cat );
		}
    }    
}
endif;
add_filter( 'pre_get_posts', 'travel_agency_pro_exclude_cat' );

if( ! function_exists( 'travel_agency_pro_custom_category_widget' ) ) :
/** 
 * Exclude Categories from Category Widget 
*/ 
function travel_agency_pro_custom_category_widget( $arg ) {
	$cat = get_theme_mod( 'exclude_categories' );
    
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["exclude"] = $cat;
    }
	return $arg;
}
endif;
add_filter( "widget_categories_args", "travel_agency_pro_custom_category_widget" );
add_filter( "widget_categories_dropdown_args", "travel_agency_pro_custom_category_widget" );

if( ! function_exists( 'travel_agency_pro_exclude_posts_from_recentPostWidget_by_cat' ) ) :
/**
 * Exclude post from recent post widget of excluded catergory
 * 
 * @link http://blog.grokdd.com/exclude-recent-posts-by-category/
*/
function travel_agency_pro_exclude_posts_from_recentPostWidget_by_cat( $arg ){
    
    $cat = get_theme_mod( 'exclude_categories' );
   
    if( $cat ){
        $cat = array_diff( array_unique( $cat ), array('') );
        $arg["category__not_in"] = $cat;
    }    
    return $arg;   
}
endif;
add_filter( "widget_posts_args", "travel_agency_pro_exclude_posts_from_recentPostWidget_by_cat" );

if( ! function_exists( 'travel_agency_pro_setup_pages' ) ) :
/**
 * Setup Contact and About Us Page Programatically
*/
function travel_agency_pro_setup_pages(){
    
    $pages = array(
        'contact-us' => array( 
            'page_name'     => 'Contact Us',
            'page_template' => 'templates/contact.php'
        ),
        'about-us' => array( 
            'page_name'     => 'About Us',
            'page_template' => 'templates/about.php'
        ),
        'our-team' => array( 
            'page_name'     => 'Our Team',
            'page_template' => 'templates/team.php'
        ),
        'testimonials' => array( 
            'page_name'     => 'Testimonials',
            'page_template' => 'templates/testimonial.php'
        )
    );
    
    foreach( $pages as $page => $val ){
        travel_agency_pro_create_post( $val['page_name'], $page, $val['page_template'] );
    }
    
}
endif;
add_filter( 'after_switch_theme', 'travel_agency_pro_setup_pages' );

if( ! function_exists( 'travel_agency_pro_og_header' ) ) :
/**
 * Add og meta tags in header for social sharing
*/
function travel_agency_pro_og_header() {
    if( is_single() ){
        global $post;
        
        $post_thumbnail_id = get_post_thumbnail_id( $post->ID );
        if( $post_thumbnail_id ){
            $featured_image = wp_get_attachment_image_url( $post_thumbnail_id, 'lawyer-landing-page-portfolio' );
        }
        
        if( has_excerpt( $post->ID ) ){
            $description = $post->post_excerpt;
        }
        else {
            $description = travel_agency_pro_truncate( $post->post_content, 250 );
        }
    
        if( $post_thumbnail_id && $featured_image && $description ){ ?>
            <meta property="og:url"         content="<?php echo esc_url( get_permalink( $post->ID ) ); ?>" />
            <meta property="og:type"        content="article" />
            <meta property="og:title"       content="<?php echo esc_html( $post->post_title )?>" />
            <meta property="og:description" content="<?php echo esc_html( $description ); ?>" />
            <meta property="og:image"       content="<?php echo esc_url( $featured_image ); ?>" />
        <?php
        }
    }
}
endif;
add_action( 'wp_head', 'travel_agency_pro_og_header' );

if( ! function_exists( 'travel_agency_pro_migrate_free_option' ) ) :
/**
 * Function to migrate free theme option to pro theme
*/
function travel_agency_pro_migrate_free_option(){
    
    $fresh  = get_option( '_tap_fresh_install' ); //flag to check if it is first switch
    
    if( ! $fresh ){
        
        $options = get_option( 'theme_mods_travel-agency' );
        
        if( $options ){
            foreach( $options as $option => $value ){
                if( $option !== 'sidebars_widgets' ){
                    set_theme_mod( $option, $value );
                }    
            }
            update_option( '_tap_fresh_install', true );
        }  
    }
}
endif;
add_action( 'after_switch_theme', 'travel_agency_pro_migrate_free_option' );