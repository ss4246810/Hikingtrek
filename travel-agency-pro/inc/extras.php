<?php
/**
 * Custom template tags for this theme
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Travel_Agency_Pro
 */

if ( ! function_exists( 'travel_agency_pro_posted_on' ) ) :
/**
 * Posted On
 */
function travel_agency_pro_posted_on() {
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf( $time_string,
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() ),
		esc_attr( get_the_modified_date( 'c' ) ),
		esc_html( get_the_modified_date() )
	);

	echo '<span class="posted-on"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a></span>';
}
endif;

if( ! function_exists( 'travel_agency_pro_posted_by' ) ) :
/**
 * Posted By
*/
function travel_agency_pro_posted_by(){
    echo '<span class="byline"><i class="fa fa-user-o"></i><span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span></span>';
}
endif; 

if( ! function_exists( 'travel_agency_pro_categories' ) ) :
/**
 * Blog Categories
*/
function travel_agency_pro_categories(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		$categories_list = get_the_category_list( esc_html__( ' ', 'travel-agency-pro' ) );
		if ( $categories_list ) {
			/* translators: 1: list of categories. */
			printf( '<span class="cat-links">' . $categories_list . '</span>'  ); // WPCS: XSS OK.
		}	
	}
}
endif;

if( ! function_exists( 'travel_agency_pro_tags' ) ) :
/**
 * Blog Categories
*/
function travel_agency_pro_tags(){
    // Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {	
		/* translators: used between list items, there is a space */
		$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', 'travel-agency-pro' ) );
		if ( $tags_list ) {
			/* translators: 1: list of tags. */
			printf( '<div class="tags">' . $tags_list . '</div>' ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'travel_agency_pro_comment_count' ) ) :
/**
 * Comments counts
 */
function travel_agency_pro_comment_count(){	
	if ( ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<span class="comments"><i class="fa fa-comment-o"></i>';
		comments_popup_link(
			sprintf(
				wp_kses(
					/* translators: %s: post title */
					__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', 'travel-agency-pro' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			), 
            __( '1', 'travel-agency-pro' ), 
            __( '%', 'travel-agency-pro' ) 
		);
		echo '</span>';
	}	
}
endif;
 
if( ! function_exists( 'travel_agency_pro_comment_list' ) ) :
/**
 * Callback function for Comment List
 * 
 * @link https://codex.wordpress.org/Function_Reference/wp_list_comments 
 */
function travel_agency_pro_comment_list( $comment, $args, $depth ) {
    if ( 'div' === $args['style'] ) {
        $tag       = 'div';
        $add_below = 'comment';
    } else {
        $tag       = 'li';
        $add_below = 'div-comment';
    }
    ?>
    <<?php echo $tag ?> <?php comment_class( empty( $args['has_children'] ) ? '' : 'parent' ) ?> id="comment-<?php comment_ID() ?>">
    
    <?php if ( 'div' != $args['style'] ){ ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
    <?php } ?>
        
            <div class="comment-meta">
                <div class="comment-author vcard">
                    <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] ); ?>
                </div>                
            </div><!-- .comment-meta -->
            
            <div class="text-holder">
                <div class="top">
                
                    <?php if ( $comment->comment_approved == '0' ){ ?>
                        <em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'travel-agency-pro' ); ?></em>
                    <?php } ?>
                    
                    <div class="left">
                        <b class="fn"><?php comment_author(); ?></b>
                        <span class="says"><?php __( 'Says:', 'travel-agency-pro' ); ?></span>
                        <div class="comment-metadata">
                            <?php
                            /* translators: 1: date, 2: time */
                            printf( __( '%1$s at %2$s', 'travel-agency-pro' ), get_comment_date(),  get_comment_time() ); ?>
                        </div>
                        <?php edit_comment_link( __( '(Edit)', 'travel-agency-pro' ), '  ', '' ); ?>                
                    </div><!-- .left -->
                    
                    <div class="reply"><?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?></div>
                </div>
                <div class="comment-content"><?php comment_text(); ?></div>
                
                
            </div><!-- .text-holder -->
            
    <?php if ( 'div' != $args['style'] ){ ?>
        </div>
    <?php }
}    
endif;

if( ! function_exists( 'travel_agency_pro_get_trip_currency' ) ) :
/**
 * Get currency for WP Travel Engine Trip
*/
function travel_agency_pro_get_trip_currency(){
    $currency = '';
    if( travel_agency_is_wpte_activated() ){
        $wpte_setting = get_option( 'wp_travel_engine_settings', true ); 
        $code = 'USD';
        if( isset( $wpte_setting['currency_code'] ) && $wpte_setting['currency_code']!= '' ){
            $code = $wpte_setting['currency_code'];
        } 
        $obj = new Wp_Travel_Engine_Functions();
        $currency = $obj->wp_travel_engine_currencies_symbol( $code );
    }
    return $currency;
}
endif;

if( ! function_exists( 'travel_agency_pro_get_template_part' ) ) :
/**
 * Get template from plus, companion or theme.
 *
 * @param string $template Name of the section.
 */
function travel_agency_pro_get_template_part( $template ){

	if( locate_template( $template . '.php' ) ){
		get_template_part( $template );
	}else{
		if( defined( 'TRAVEL_AGENCY_COMPANION_PATH' ) ){
			 if( file_exists( TRAVEL_AGENCY_COMPANION_PATH . 'public/sections/' . $template . '.php' ) ){
				require_once( TRAVEL_AGENCY_COMPANION_PATH . 'public/sections/' . $template . '.php' );
			}
		}		
	}
}
endif;

if( ! function_exists( 'travel_agency_pro_primary_menu_fallback' ) ) :
/**
 * Fallback for primary menu
*/
function travel_agency_pro_primary_menu_fallback(){
    if( current_user_can( 'manage_options' ) ){
        echo '<ul class="table-row">';
        echo '<li class="dropdown"><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '">' . esc_html__( 'Click here to add a menu', 'travel-agency-pro' ) . '</a></li>';
        echo '</ul>';
    }
}
endif;

if( ! function_exists( 'travel_agency_pro_get_homepage_section' ) ) :
/**
 * Return homepage sections
*/
function travel_agency_pro_get_homepage_section(){
    $enabled_sections = get_theme_mod( 'home_sort', array( 'about', 'activities', 'popular', 'whyus', 'feature', 'stat', 'deal', 'testimonial', 'cta', 'blog', 'client' ) );
    $section = array(
        'about'       => 'about',
        'activities'  => 'activities',
        'popular'     => 'popular',
        'whyus'       => 'our-feature',
        'feature'     => 'featured-trip',
        'stat'        => 'stats',
        'deal'        => 'deals',
        'testimonial' => 'sections/home/testimonials',
        'cta'         => 'cta',
        'blog'        => 'sections/home/blog',
        'client'      => 'sections/home/clients'
    );
    
    $ed_banner_section = get_theme_mod( 'ed_banner_section' );
    $ed_search_bar     = get_theme_mod( 'ed_search_bar' );
    
    $sections = array();

    if ( $ed_banner_section !== 'no_banner' ) {
        array_push( $sections, 'sections/home/banner' );
    }
    if ( $ed_search_bar === true ) {
        array_push( $sections, 'sections/home/search' );
    }
    
    foreach( $enabled_sections as $s ){
        if( array_key_exists( $s, $section ) ) array_push( $sections, $section[$s] );
    }
    return apply_filters( 'tap_homepage_sections', $sections );
}
endif;

if( ! function_exists( 'travel_agency_pro_get_header_search' ) ) :
/**
 * Display search button in header
*/
function travel_agency_pro_get_header_search(){ 
    $ed_search = get_theme_mod( 'ed_search', true );
    if( $ed_search ){ ?>
<div class="col-xs-12 col-sm-4 col-md-4">
                    <div class="top_search">
                    <form role="search" method="get" id="searchform" class="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                    <input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="Search here..."/>
                    <button  type="submit" id="searchsubmit" class="email-btn"><i class="fa fa-search"></i></button>
            </form>
                </div>
                </div>

        <?php
    }
}
endif;

if( ! function_exists( 'travel_agency_pro_social_links' ) ) :
/**
 * Prints social links in header
*/
function travel_agency_pro_social_links(){
    $defaults = array(
        array(
            'font' => 'fa fa-facebook',
            'link' => 'https://www.facebook.com/',                        
        ),
        array(
            'font' => 'fa fa-twitter',
            'link' => 'https://twitter.com/',
        ),
        array(
            'font' => 'fa fa-youtube-play',
            'link' => 'https://www.youtube.com/',
        ),
        array(
            'font' => 'fa fa-instagram',
            'link' => 'https://www.instagram.com/',
        ),
        array(
            'font' => 'fa fa-google-plus-circle',
            'link' => 'https://plus.google.com',
        ),
        array(
            'font' => 'fa fa-odnoklassniki',
            'link' => 'https://ok.ru/',
        ),
        array(
            'font' => 'fa fa-vk',
            'link' => 'https://vk.com/',
        ),
        array(
            'font' => 'fa fa-xing',
            'link' => 'https://www.xing.com/',
        )
    );
    $social_links = get_theme_mod( 'social_links', $defaults );
    $ed_social    = get_theme_mod( 'ed_social_links', true ); 
    
    if( $ed_social && $social_links ){
        echo '<div class="call-section">';
    	foreach( $social_links as $link ){
            if( $link['link'] && $link['font'] ) echo '<span><a href="' . esc_url( $link['link'] ) . '" target="_blank" rel="nofollow"><i class="' . esc_attr( $link['font'] ) . '"></i></a></span>';    	   
    	}
	   echo '</div>';    
    }
}
endif;

if( ! function_exists( 'travel_agency_pro_primary_nav' ) ) :
/**
 * Primary Navigation
*/
function travel_agency_pro_primary_nav( $header = false ){
    /*if( $header == 'five' ) echo '<div class="nav-holder"><div class="container">'; ?>    
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link"><i class="fa fa-home"></i></a>
    <div id="primary-toggle-button"><?php esc_html_e( 'MENU', 'travel-agency-pro' );?><i class="fa fa-bars"></i></div>
    <?php if( $header == 'five' ) echo '</div></div>';*/ ?>    
    <nav class="nav-main">
    <ul class="table-row">
		<?php
			wp_nav_menu( array(
				'theme_location' => 'primary',
                'items_wrap'    => '%3$s',
                'container'      => '',
                'walker' => new Nav_Walker(),
                //'fallback_cb'    => 'travel_agency_pro_primary_menu_fallback',
			) );
		?>
        </ul>
	</nav><!-- #site-navigation -->
    <?php
}
endif;

if( ! function_exists( 'travel_agency_pro_mobile_nav' ) ) :
/**
 * Primary Navigation
*/
function travel_agency_pro_mobile_nav( $header = false ){
    /*if( $header == 'five' ) echo '<div class="nav-holder"><div class="container">'; ?>    
    <a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="home-link"><i class="fa fa-home"></i></a>
    <div id="primary-toggle-button"><?php esc_html_e( 'MENU', 'travel-agency-pro' );?><i class="fa fa-bars"></i></div>
    <?php if( $header == 'five' ) echo '</div></div>';*/ ?>    
    <ul>
        <?php
            wp_nav_menu( array(
                'theme_location' => 'mobile',
                'items_wrap'    => '%3$s',
                'container'      => '',
                //'fallback_cb'    => 'travel_agency_pro_primary_menu_fallback',
            ) );
        ?>
        </ul>
    <?php
}
endif;


//menu customization
class Nav_Walker extends Walker_Nav_Menu
{

    function start_lvl(&$output, $depth = 0, $args = array())
    {
        $output .= "\n<ul class=\"dropdown-menu\">\n";
    }

    function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0)
    {
        $item_html = '';
        parent::start_el($item_html, $item, $depth, $args);

//        if ($item->is_dropdown && $depth === 0) {
//            $item_html = str_replace('<a', '<a class="dropdown-toggle" data-toggle="dropdown"', $item_html);
//            $item_html = str_replace('</a>', ' <b class="caret"></b></a>', $item_html);
//        }

        $output .= $item_html;
    }

    function display_element($element, &$children_elements, $max_depth, $depth = 0, $args, &$output)
    {
        if ($element->current)
            $element->classes[] = 'active';

        $element->is_dropdown = !empty($children_elements[$element->ID]);

        if ($element->is_dropdown) {
            if ($depth === 0) {
                $element->classes[] = 'dropdown';
            } else {
                // Extra level of dropdown menu,
                // as seen in http://twitter.github.com/bootstrap/components.html#dropdowns
                $element->classes[] = 'dropdown';
            }
        }

        parent::display_element($element, $children_elements, $max_depth, $depth, $args, $output);
    }
}

if( ! function_exists( 'travel_agency_pro_site_branding' ) ) :
/**
 * Site Branding
*/
function travel_agency_pro_site_branding(){
    ?>
                        <div class="site-logo">
                        <span><?php 
            if( function_exists( 'has_custom_logo' ) && has_custom_logo() ){
                the_custom_logo();
            } 
        ?></span>
                        <span>
                            <strong><?php bloginfo( 'name' ); ?></strong>
                            <?php
                            $description = get_bloginfo( 'description', 'display' );
                            if ( $description || is_customize_preview() ) : ?>
                            <?php echo esc_html( $description );  ?>
                            <?php
                            endif; ?>
                        </span>
                        </div>
   
    <?php
}
endif;

if( ! function_exists( 'travel_agency_pro_header_phone' ) ) :
/**
 * Header Phone
*/
function travel_agency_pro_header_phone( $fifth = false ){
    $phone       = get_theme_mod( 'phone', __( '(888) 123-45678', 'travel-agency-pro' ) );
    $phone_label = get_theme_mod( 'phone_label', __( 'Call us, we are open 24/7', 'travel-agency-pro' ) );
    
    if( $fifth && $phone ){
        echo '<a href="' . esc_url( 'tel:' . preg_replace( '/\D/', '', $phone ) ) . '" class="tel-link"><i class="fa fa-phone"></i><span class="phone">' . esc_html( travel_agency_pro_get_header_phone() ) . '</span></a>';
    }elseif( !$fifth && ( $phone_label || $phone ) ){ 
        if( $phone ) echo '<span>' . esc_html( travel_agency_pro_get_header_phone() ) . '</span>';
    } 
}
endif;

if( ! function_exists( 'travel_agency_pro_header_time' ) ) :
/**
 * Header Time
*/
function travel_agency_pro_header_time(){
    $time = get_theme_mod( 'time', __( 'Mon - Fri 10:00-18:00', 'travel-agency-pro' ) );
    if( $time ) echo '<div class="opening-time"><i class="fa fa-clock-o"></i><span class="time">' . esc_html( travel_agency_pro_get_time() ) . '</span></div>';
}
endif;

if( ! function_exists( 'travel_agency_pro_header_email' ) ) :
/**
 * Header Email
*/
function travel_agency_pro_header_email(){
    //$email = get_theme_mod( 'email', __( 'gurungdhanee@gmail.com', 'travel-agency-pro' ) );
    //esc_html( travel_agency_pro_get_email() )
    $email = 'gurungdhanee@gmail.com';
    if( $email ) echo '<span><a href="' . esc_url( 'mailto:' . sanitize_email( $email ) ) . '">gurungdhanee@gmail.com</a></span>';
}
endif;

if( ! function_exists( 'travel_agency_pro_get_dynamnic_sidebar' ) ) :
/**
 * Function to list dynamic sidebar
*/
function travel_agency_pro_get_dynamnic_sidebar( $nosidebar = false, $sidebar = false, $default = false ){
    $sidebar_arr = array();
    $sidebars = get_theme_mod( 'sidebar' );
    
    if( $default ) $sidebar_arr['default-sidebar'] = __( 'Default Sidebar', 'travel-agency-pro' );
    if( $sidebar ) $sidebar_arr['sidebar'] = __( 'Sidebar', 'travel-agency-pro' );
    
    if( $sidebars ){        
        foreach( $sidebars as $sidebar ){            
            $id = $sidebar['name'] ? sanitize_title( $sidebar['name'] ) : 'rara-sidebar-one';
            $sidebar_arr[$id] = $sidebar['name'];
        }
    }
    
    if( $nosidebar ) $sidebar_arr['no-sidebar'] = __( 'No Sidebar', 'travel-agency-pro' );
    
    return $sidebar_arr;
}
endif;

if( ! function_exists( 'travel_agency_pro_get_patterns' ) ) :
/**
 * Function to list Custom Pattern
*/
function travel_agency_pro_get_patterns(){
    $patterns = array();
    $patterns['nobg'] = get_template_directory_uri() . '/images/patterns_thumb/' . 'nobg.png';
    for( $i=0; $i<38; $i++ ){
        $patterns['pattern'.$i] = get_template_directory_uri() . '/images/patterns_thumb/' . 'pattern' . $i .'.png';
    }
    for( $j=1; $j<26; $j++ ){
        $patterns['hbg'.$j] = get_template_directory_uri() . '/images/patterns_thumb/' . 'hbg' . $j . '.png';
    }
    return $patterns;
}
endif;

if( ! function_exists( 'travel_agency_pro_sidebar' ) ) :
/**
 * Function to retrive page specific sidebar and corresponding body class
 * 
 * @param boolean $sidebar
 * @param boolean $class
 * 
 * @return string dynamic sidebar id / classname
*/
function travel_agency_pro_sidebar( $sidebar = false, $class = false ){
    
    global $post;
    $return = false;
    $layout = get_theme_mod( 'layout_style', 'right-sidebar' ); //Default Layout Style for Styling Settings
    
    if( ( is_front_page() && is_home() ) || is_home() ){
        //blog/home page 
        $blog_sidebar = get_theme_mod( 'blog_page_sidebar', 'sidebar' );
        
        if( is_active_sidebar( $blog_sidebar ) ){            
            if( $sidebar ) $return = $blog_sidebar; //With Sidebar
            if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; 
            if( $class && $layout == 'left-sidebar' )  $return = 'leftsidebar';
        }else{
            if( $sidebar ) $return = false; //Fullwidth
            if( $class ) $return = 'full-width';
        }        
    }
    
    if( is_archive() ){
        //archive page
        $archive_sidebar = get_theme_mod( 'archive_page_sidebar', 'sidebar' );
        $cat_sidebar     = get_theme_mod( 'cat_archive_page_sidebar', 'default-sidebar' );
        $tag_sidebar     = get_theme_mod( 'tag_archive_page_sidebar', 'default-sidebar' );
        $date_sidebar    = get_theme_mod( 'date_archive_page_sidebar', 'default-sidebar' );
        $author_sidebar  = get_theme_mod( 'author_archive_page_sidebar', 'default-sidebar' );        
        
        if( is_category() ){
            
            if( $cat_sidebar == 'no-sidebar' || ( $cat_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( $cat_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ){
                if( $sidebar ) $return = $archive_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $cat_sidebar ) ){
                if( $sidebar ) $return = $cat_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }
                
        }elseif( is_tag() ){
            
            if( $tag_sidebar == 'no-sidebar' || ( $tag_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( ( $tag_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $sidebar ) $return = $archive_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $tag_sidebar ) ){
                if( $sidebar ) $return = $tag_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';              
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }
            
        }elseif( is_author() ){
            
            if( $author_sidebar == 'no-sidebar' || ( $author_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( ( $author_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $sidebar ) $return = $archive_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $author_sidebar ) ){
                if( $sidebar ) $return = $author_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }
            
        }elseif( is_date() ){
            
            if( $date_sidebar == 'no-sidebar' || ( $date_sidebar == 'default-sidebar' && $archive_sidebar == 'no-sidebar' ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( ( $date_sidebar == 'default-sidebar' && $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ) ){
                if( $sidebar ) $return = $archive_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $date_sidebar ) ){
                if( $sidebar ) $return = $date_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }                         
            
        }elseif( is_woocommerce_activated() && ( is_shop() || is_product_category() || is_product_tag() ) ){ //For Woocommerce
            
            if( is_active_sidebar( 'shop-sidebar' ) ){
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                if( $class ) $return = 'full-width';
            }            
                    
        }else{
            if( $archive_sidebar != 'no-sidebar' && is_active_sidebar( $archive_sidebar ) ){
                if( $sidebar ) $return = $archive_sidebar;
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }                      
        }
        
    }
    
    if( is_singular() ){
        $post_sidebar = get_theme_mod( 'single_post_sidebar', 'sidebar' );
        $page_sidebar = get_theme_mod( 'single_page_sidebar', 'sidebar' );
        
        if( get_post_meta( $post->ID, '_tap_sidebar', true ) ){
            $single_sidebar = get_post_meta( $post->ID, '_tap_sidebar', true );
        }else{
            $single_sidebar = 'default-sidebar';
        }

        if( get_post_meta( $post->ID, '_tap_sidebar_layout', true ) ){
            $sidebar_layout = get_post_meta( $post->ID, '_tap_sidebar_layout', true );
        }else{
            $sidebar_layout = 'default-sidebar';
        }
        
        if( is_page() ){
            
            if( ( $single_sidebar == 'no-sidebar' ) || ( ( $single_sidebar == 'default-sidebar' ) && ( $page_sidebar == 'no-sidebar' ) ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( $single_sidebar == 'default-sidebar' && $page_sidebar != 'no-sidebar' && is_active_sidebar( $page_sidebar ) ){
                if( $sidebar ) $return = $page_sidebar;
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) ) $return = 'rightsidebar';
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $single_sidebar ) ){
                if( $sidebar ) $return = $single_sidebar;
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) ) $return = 'rightsidebar';
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }
            
        }elseif( is_single() ){
            if( is_woocommerce_activated() && 'product' === get_post_type() ){
                if( is_active_sidebar( 'shop-sidebar' ) ){
                    if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                    if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
                }else{
                    if( $class ) $return = 'full-width';
                }
            }elseif( travel_agency_is_wpte_activated() && get_post_type() === 'trip' ){
                if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
                if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
            }elseif( ( $single_sidebar == 'no-sidebar' ) || ( ( $single_sidebar == 'default-sidebar' ) && ( $post_sidebar == 'no-sidebar' ) ) ){
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }elseif( $single_sidebar == 'default-sidebar' && $post_sidebar != 'no-sidebar' && is_active_sidebar( $post_sidebar ) ){
                if( $sidebar ) $return = $post_sidebar;
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) ) $return = 'rightsidebar';
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) ) $return = 'leftsidebar';
            }elseif( is_active_sidebar( $single_sidebar ) ){
                if( $sidebar ) $return = $single_sidebar;
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'right-sidebar' ) || ( $sidebar_layout == 'right-sidebar' ) ) ) $return = 'rightsidebar';
                if( $class && ( ( $sidebar_layout == 'default-sidebar' && $layout == 'left-sidebar' ) || ( $sidebar_layout == 'left-sidebar' ) ) ) $return = 'leftsidebar';
            }else{
                if( $sidebar ) $return = false; //Fullwidth
                if( $class ) $return = 'full-width';
            }
        }
    }
    
    if( is_search() ){
        $search_sidebar = get_theme_mod( 'search_page_sidebar', 'sidebar' );
                
        if( $search_sidebar != 'no-sidebar' && is_active_sidebar( $search_sidebar ) ){
            if( $sidebar ) $return = $search_sidebar;
            if( $class && $layout == 'right-sidebar' ) $return = 'rightsidebar'; //With Sidebar
            if( $class && $layout == 'left-sidebar' ) $return = 'leftsidebar';
        }else{
            if( $sidebar ) $return = false; //Fullwidth
            if( $class ) $return = 'full-width';
        }
        
    }
    
    return $return;        
}
endif;

if( ! function_exists( 'travel_agency_pro_get_posts' ) ) :
/**
 * Fuction to list Custom Post Type
*/
function travel_agency_pro_get_posts( $post_type = 'post', $slug = false ){
    
    $args = array(
    	'posts_per_page'   => -1,
    	'post_type'        => $post_type,
    	'post_status'      => 'publish',
    	'suppress_filters' => true 
    );
    $posts_array = get_posts( $args );
    
    // Initate an empty array
    $post_options = array();
    $post_options[''] = __( ' -- Choose -- ', 'travel-agency-pro' );
    if ( ! empty( $posts_array ) ) {
        foreach ( $posts_array as $posts ) {
            if( $slug ){
                $post_options[ $posts->post_title ] = $posts->post_title;
            }else{
                $post_options[ $posts->ID ] = $posts->post_title;    
            }
        }
    }
    return $post_options;
    wp_reset_postdata();
}
endif;

if( ! function_exists( 'travel_agency_pro_get_categories' ) ) :
/**
 * Function to list post categories in customizer options
*/
function travel_agency_pro_get_categories( $select = true, $taxonomy = 'category', $slug = false ){
    
    /* Option list of all categories */
    $categories = array();
    
    $args = array( 
        'hide_empty' => false,
        'taxonomy'   => $taxonomy 
    );
    
    $catlists = get_terms( $args );
    if( $select ) $categories[''] = __( 'Choose Category', 'travel-agency-pro' );
    foreach( $catlists as $category ){
        if( $slug ){
            $categories[$category->slug] = $category->name;
        }else{
            $categories[$category->term_id] = $category->name;    
        }        
    }
    
    return $categories;
}
endif;

if( ! function_exists( 'travel_agency_pro_like_count' ) ) :
/**
 * Prints like count of post
*/
function travel_agency_pro_like_count(){
    global $post;
    echo '<span class="like" id="like-' . esc_attr( $post->ID ) . '"><i class="fa fa-heart-o"></i>' . travel_agency_pro_get_like_count( $post->ID ) . '</span>';
}
endif;

if( ! function_exists( 'travel_agency_pro_get_like_count' ) ) :
/**
 * Return post like count
*/
function travel_agency_pro_get_like_count( $post_id ){
    $count = get_post_meta( $post_id, '_tap_post_like', true );
    if( $count ){
        return $count;
    }else{
        return 0;
    }   
} 

endif;

if( ! function_exists( 'travel_agency_pro_get_social_share' ) ) :
/**
 * Get list of social sharing icons
 * http://www.sharelinkgenerator.com/
 * 
*/
function travel_agency_pro_get_social_share( $share ){
    global $post;
    
    switch( $share ){
        case 'facebook':
        echo '<li><a href="' . esc_url( 'https://www.facebook.com/sharer/sharer.php?u=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'twitter':
        echo '<li><a href="' . esc_url( 'https://twitter.com/home?status=' . get_the_title( $post->ID ) ) . '&nbsp;' . get_the_permalink( $post->ID ) . '" rel="nofollow" target="_blank"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'linkedin':
        echo '<li><a href="' . esc_url( 'https://www.linkedin.com/shareArticle?mini=true&url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-linkedin" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'pinterest':
        echo '<li><a href="' . esc_url( 'https://pinterest.com/pin/create/button/?url=' . get_the_permalink( $post->ID ) . '&description=' . get_the_title( $post->ID )  ) . '" rel="nofollow" target="_blank"><i class="fa fa-pinterest" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'email':
        echo '<li><a href="' . esc_url( 'mailto:?Subject=' . get_the_title( $post->ID ) . '&Body=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-envelope" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'gplus':
        echo '<li><a href="' . esc_url( 'https://plus.google.com/share?url=' . get_the_permalink( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'stumble':
        echo '<li><a href="' . esc_url( 'http://www.stumbleupon.com/submit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-stumbleupon" aria-hidden="true"></i></a></li>';
        
        break;
        
        case 'reddit':
        echo '<li><a href="' . esc_url( 'http://www.reddit.com/submit?url=' . get_the_permalink( $post->ID ) . '&title=' . get_the_title( $post->ID ) ) . '" rel="nofollow" target="_blank"><i class="fa fa-reddit" aria-hidden="true"></i></a></li>';
        
        break;                
    }
}
endif;

if( ! function_exists( 'travel_agency_pro_get_customizer_defaults' ) ) :
/**
 * Returns customizer defaults
*/
function travel_agency_pro_get_customizer_defaults( $case ){
    $return = array();
    switch( $case ){
        case 'team':
        $return = array(
             array(
                'image' => get_template_directory_uri() . '/images/fallback/logo1.png',
                'link'  => '#'
            ),
            array(
                'image' => get_template_directory_uri() . '/images/fallback/logo2.png',
                'link'  => ''
            ),
            array(
                'image' => get_template_directory_uri() . '/images/fallback/logo3.png',
                'link'  => ''
            ),
            array(
                'image' => get_template_directory_uri() . '/images/fallback/logo4.png',
                'link'  => ''
            ),
            array(
                'image' => get_template_directory_uri() . '/images/fallback/logo5.png',
                'link'  => ''
            ),
            array(
                'image' => get_template_directory_uri() . '/images/fallback/logo1.png',
                'link'  => ''
            )
        );
        break;
        case 'testimonial':
        $return = array(
             array(
                'image'   => get_template_directory_uri() . '/images/fallback/img25.jpg',
                'visited' => 'Everest Base Camp Trek',
                'date'    => 'Visited January 24',
                'content' => 'Coffee nerd. Pop culture aficionado. Incurable travel evangelist. Lifelong alcohol fanatic. Food junkie. Hipster-friendly web ninja. Hardcore social media fanatic. Amateur alcohol fanatic. Proud twitter specialist. Music aficionado. Internet guru. Twitter',
                'title'   => 'Jucy Martin'
            ),            
            array(
                'image'   => get_template_directory_uri() . '/images/fallback/img25.jpg',
                'visited' => 'Everest Base Camp Trek',
                'date'    => 'Visited January 24',
                'content' => 'Coffee nerd. Pop culture aficionado. Incurable travel evangelist. Lifelong alcohol fanatic. Food junkie. Hipster-friendly web ninja. Hardcore social media fanatic. Amateur alcohol fanatic. Proud twitter specialist. Music aficionado. Internet guru. Twitter',
                'title'   => 'Jucy Martin'
            ),
            array(
                'image'   => get_template_directory_uri() . '/images/fallback/img25.jpg',
                'visited' => 'Everest Base Camp Trek',
                'date'    => 'Visited January 24',
                'content' => 'Coffee nerd. Pop culture aficionado. Incurable travel evangelist. Lifelong alcohol fanatic. Food junkie. Hipster-friendly web ninja. Hardcore social media fanatic. Amateur alcohol fanatic. Proud twitter specialist. Music aficionado. Internet guru. Twitter',
                'title'   => 'Jucy Martin'
            ),               
            array(
                'image'   => get_template_directory_uri() . '/images/fallback/img25.jpg',
                'visited' => 'Everest Base Camp Trek',
                'date'    => 'Visited January 24',
                'content' => 'Coffee nerd. Pop culture aficionado. Incurable travel evangelist. Lifelong alcohol fanatic. Food junkie. Hipster-friendly web ninja. Hardcore social media fanatic. Amateur alcohol fanatic. Proud twitter specialist. Music aficionado. Internet guru. Twitter',
                'title'   => 'Jucy Martin'
            ),   
        );
        break;
        case 'whyus':
        $return = array(
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( 'TripAdvisor Multiple Award winning company', 'travel-agency-pro' ),
                'description' => __( 'We\'ve received Certificate of Excellence award from TripAdvisor, the world\'s largest travel website.', 'travel-agency-pro' ),
                'url'         => ''
            ),
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( '100% Customizable', 'travel-agency-pro' ),
                'description' => __( 'Tell us about your trip requirement. We\'ll work together to customize your trip to meet your exact requirement so that you have a memorable trip.', 'travel-agency-pro' ),
                'url'         => ''
            ),
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( 'Local Experts. Middle-man Free Pricing', 'travel-agency-pro' ),
                'description' => __( 'We\'re a local travel agency. When you book with us, you get best possible price, which is middle-man free.', 'travel-agency-pro' ),
                'url'         => ''
            ),
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( 'No Hidden Charges', 'travel-agency-pro' ),
                'description' => __( 'We don\'t add hidden extras cost. All trips include travel permit, lodging and fooding. There are no surprises with hidden costs.', 'travel-agency-pro' ),
                'url'         => ''
            ),
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( 'TripAdvisor Multiple Award winning company', 'travel-agency-pro' ),
                'description' => __( 'We\'ve received Certificate of Excellence award from TripAdvisor, the world\'s largest travel website.', 'travel-agency-pro' ),
                'url'         => ''
            ),
            array(
                'whyus-icon'  => 'fa fa-check',
                'title'       => __( '100% Customizable', 'travel-agency-pro' ),
                'description' => __( 'Tell us about your trip requirement. We\'ll work together to customize your trip to meet your exact requirement so that you have a memorable trip.', 'travel-agency-pro' ),
                'url'         => ''
            )
        );    
        break;
        case 'services':
        $return = array(
            array(
                'title'   => 'Best Selection of Trips',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon1.png'
            ),
            array(
                'title'   => 'Best Price Guarantee',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon2.png'
            ),
            array(
                'title'   => 'Expert Assitance',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon3.png'
            ),
            array(
                'title'   => 'Guaranteed Departures',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon4.png'
            ),
            array(
                'title'   => 'Eco Friendly Tours',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon5.png'
            ),
            array(
                'title'   => '100+ Trips to Choice',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon6.png'
            ),
            array(
                'title'   => 'Financial Security',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon7.png'
            ),
            array(
                'title'   => 'Best Equipments',
                'content' => 'It is also translation ready. So you can translate your website in any language. We need to change the image of TripAdvisor as this is taken',
                'image'   => get_template_directory_uri() . '/images/fallback/service-icon8.png'
            )
        );
        break;
        case 'stats':
        $return = array(
            array(
                'icon'   => 'fa fa-group',
                'title'  => __( 'Number of Customers', 'travel-agency-pro' ),
                'number' => __( '859', 'travel-agency-pro' ),
            ),
            array(
                'icon'   => 'fa fa-globe',
                'title'  => __( 'Number of Trips', 'travel-agency-pro' ),
                'number' => __( '1021', 'travel-agency-pro' ),
            ),
            array(
                'icon'   => 'fa fa-plane',
                'title'  => __( 'Trips Types', 'travel-agency-pro' ),
                'number' => __( '225', 'travel-agency-pro' ),
            ),
            array(
                'icon'   => 'fa fa-bus',
                'title'  => __( 'Travel with Bus', 'travel-agency-pro' ),
                'number' => __( '1020', 'travel-agency-pro' ),
            ),
        );
        break;
    }
    return $return;
}
endif;

if( ! function_exists( 'travel_agency_pro_get_contact_info' ) ) :
/**
 * Function returning contact information
*/
function travel_agency_pro_get_contact_info( $type ){
    $p_label = get_theme_mod( 'contact_phone_label', __( 'Phone', 'travel-agency-pro' ) );
    $phone   = get_theme_mod( 'contact_phone', __( '(888) 123-456789', 'travel-agency-pro' ) );
    $e_label = get_theme_mod( 'email_label', __( 'Email', 'travel-agency-pro' ) );
    $email   = get_theme_mod( 'contact_email', __( 'info@testing.com, info@gmail.com, support@test.com', 'travel-agency-pro' ) );
    $a_label = get_theme_mod( 'location_label', __( 'Location', 'travel-agency-pro' ) );
    $address = get_theme_mod( 'contact_address', __( 'Travel Agency. PO Box 19604, Thamel Kathmandu, Nepal', 'travel-agency-pro' ) );
    $w_label = get_theme_mod( 'whatsapp_label', __( 'WhatsApp', 'travel-agency-pro' ) );
    $whatsap = get_theme_mod( 'contact_whatsapp', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
    $s_label = get_theme_mod( 'skype_label', __( 'Skype', 'travel-agency-pro' ) );
    $skype   = get_theme_mod( 'contact_skype', __( 'skype@company.com', 'travel-agency-pro' ) );
    $v_label = get_theme_mod( 'viber_label', __( 'Viber', 'travel-agency-pro' ) );
    $viber   = get_theme_mod( 'contact_viber', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
    
    switch( $type ){
        case 'phone':        
        if( $p_label || $phone ) echo '<div id="phone" class="item"><div class="icon-holder"><i class="fa fa-phone"></i></div>';
		if( $p_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_phone_label() ) . '</h2>';
		if( $phone ) echo '<div id="' . esc_attr( $type ) . '-content">' . wp_kses_post( travel_agency_pro_contact_phone() ) . '</div>';
        if( $p_label || $phone ) echo '</div>';         
        break;
        case 'email':
        if( $e_label || $email ) echo '<div id="email" class="item"><div class="icon-holder"><i class="fa fa-envelope"></i></div>';
		if( $e_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_email_label() ) . '</h2>';
		if( $email ) echo '<div id="' . esc_attr( $type ) . '-content">' . wp_kses_post( travel_agency_pro_contact_email() ) . '</div>';
        if( $e_label || $email ) echo '</div>';
        break;
        case 'location':
        if( $a_label || $address ) echo '<div id="location" class="item"><div class="icon-holder"><i class="fa fa-map-marker"></i></div>';
		if( $a_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_location_label() ) . '</h2>';
		if( $address ) echo '<div class="address"><address>' . wp_kses_post( travel_agency_pro_contact_address() ) . '</address></div>';
        if( $a_label || $address ) echo '</div>';
        break;
        case 'whatsap':
        if( $w_label || $whatsap ) echo '<div id="whatsap" class="item"><div class="icon-holder"><i class="fa fa-whatsapp"></i></div>';
		if( $w_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_whatsapp_label() ) . '</h2>';
		if( $whatsap ) echo '<div id="' . esc_attr( $type ) . '-content">' . wp_kses_post( travel_agency_pro_contact_whatsapp() ) . '</div>';
        if( $w_label || $whatsap ) echo '</div>';
        break;
        case 'skype':
        if( $s_label || $skype ) echo '<div id="skype" class="item"><div class="icon-holder"><i class="fa fa-skype"></i></div>';
		if( $s_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_skype_label() ) . '</h2>';
		if( $skype ) echo '<div id="' . esc_attr( $type ) . '-content">' . wp_kses_post( travel_agency_pro_contact_skype() ) . '</div>';
        if( $s_label || $skype ) echo '</div>';
        break;
        case 'viber':
        if( $v_label || $viber ) echo '<div id="viber" class="item"><div class="icon-holder"><img src="' . get_template_directory_uri() . '/images/viber.png" alt="viber" /></div>';
		if( $v_label ) echo '<h2 class="title">' . esc_html( travel_agency_pro_viber_label() ) . '</h2>';
		if( $viber ) echo '<div id="' . esc_attr( $type ) . '-content">' . wp_kses_post( travel_agency_pro_contact_viber() ) . '</div>';
        if( $v_label || $viber ) echo '</div>';
        break;
    }        
}
endif;

if( ! function_exists( 'travel_agency_pro_get_all_fonts' ) ) :
/**
 * Return Web safe font and google font
*/
function travel_agency_pro_get_all_fonts(){
    $google = array();        
    $standard = array(
		'georgia-serif'       => __( 'Georgia', 'travel-agency-pro' ),
        'palatino-serif'      => __( 'Palatino Linotype, Book Antiqua, Palatino', 'travel-agency-pro' ),
        'times-serif'         => __( 'Times New Roman, Times', 'travel-agency-pro' ),
        'arial-helvetica'     => __( 'Arial, Helvetica', 'travel-agency-pro' ),
        'arial-gadget'        => __( 'Arial Black, Gadget', 'travel-agency-pro' ),
		'comic-cursive'       => __( 'Comic Sans MS, cursive', 'travel-agency-pro' ),
		'impact-charcoal'     => __( 'Impact, Charcoal', 'travel-agency-pro' ),
        'lucida'              => __( 'Lucida Sans Unicode, Lucida Grande', 'travel-agency-pro' ),
        'tahoma-geneva'       => __( 'Tahoma, Geneva', 'travel-agency-pro' ),
		'trebuchet-helvetica' => __( 'Trebuchet MS, Helvetica', 'travel-agency-pro' ),
		'verdana-geneva'      => __( 'Verdana, Geneva', 'travel-agency-pro' ),
        'courier'             => __( 'Courier New, Courier', 'travel-agency-pro' ),
        'lucida-monaco'       => __( 'Lucida Console, Monaco', 'travel-agency-pro' ),
	);
    
    $fonts = include wp_normalize_path( get_template_directory() . '/inc/custom-controls/typography/webfonts.php' );
    
    foreach( $fonts['items'] as $font ){
        $google[$font['family']] = $font['family'];
    }
    $all_fonts = array_merge( $standard, $google );
    return $all_fonts; 
}
endif;

if( ! function_exists( 'travel_agency_pro_create_post' ) ) :
/**
 * A function used to programmatically create a post and assign a page template in WordPress. 
 *
 * @link https://tommcfarlin.com/programmatically-create-a-post-in-wordpress/
 * @link https://tommcfarlin.com/programmatically-set-a-wordpress-template/
 */
function travel_agency_pro_create_post( $title, $slug, $template ) {

	// Setup the author, page
	$author_id = 1;
    
    // Look for the page by the specified title. Set the ID to -1 if it doesn't exist.
    // Otherwise, set it to the page's ID.
    $page = get_page_by_title( $title, OBJECT, 'page' );
    $page_id = ( null == $page ) ? -1 : $page->ID;
    
	// If the page doesn't already exist, then create it
	if( $page_id == -1 ) {

		// Set the post ID so that we know the post was created successfully
		$post_id = wp_insert_post(
			array(
				'comment_status' =>	'closed',
				'ping_status'	 =>	'closed',
				'post_author'	 =>	$author_id,
				'post_name'		 =>	$slug,
				'post_title'	 =>	$title,
				'post_status'	 =>	'publish',
				'post_type'		 =>	'page'
			)
		);
        
        if( $post_id ) update_post_meta( $post_id, '_wp_page_template', $template );

	// Otherwise, we'll stop
	}else{
	   update_post_meta( $page_id, '_wp_page_template', $template );
	} // end if

} // end programmatically_create_post
endif;

if( ! function_exists( 'travel_agency_pro_get_page_id_by_template' ) ) :
/**
 * Returns Page ID by Page Template
*/
function travel_agency_pro_get_page_id_by_template( $template_name ){
    $args = array(
        'post_type'  => 'page',
        'fields'     => 'ids',
        'nopaging'   => true,
        'meta_key'   => '_wp_page_template',
        'meta_value' => $template_name
    );
    return $pages = get_posts( $args );    
}
endif;

if( ! function_exists( 'travel_agency_pro_truncate' ) ):  
/**
 * Return Striptags from the content.
 */
function travel_agency_pro_truncate( $content, $letter_count ) {
	
    $striped_content = strip_shortcodes( $content );
    $striped_content = strip_tags( $striped_content );
    $excerpt         = mb_substr( $striped_content, 0, $letter_count );
    
    if( $striped_content > $excerpt ){
        $excerpt .= '...';
    }
    
    return $excerpt;

}
endif; // End function_exists

if ( ! function_exists( 'travel_agency_pro_apply_theme_shortcode' ) ) :
/**
 * Footer Shortcode
*/
function travel_agency_pro_apply_theme_shortcode( $string ) {
    if ( empty( $string ) ) {
        return $string;
    }
    $search = array( '[the-year]', '[the-site-link]' );
    $replace = array(
        date_i18n( esc_html__( 'Y', 'travel-agency-pro' ) ),
        '<a href="'. esc_url( home_url( '/' ) ) .'">'. esc_html( get_bloginfo( 'name', 'display' ) ) . '</a>',
    );
    $string = str_replace( $search, $replace, $string );
    return $string;
}
endif;

/**
 * Check if Wp Travel Engine Plugin is installed
*/
function travel_agency_is_wpte_activated(){
    return class_exists( 'Wp_Travel_Engine' ) ? true : false;
}

/**
 * Check if Contact Form 7 Plugin is installed
*/
function is_cf7_activated(){
    return class_exists( 'WPCF7' ) ? true : false;
}

/**
 * Query Jetpack activation
*/
function is_jetpack_activated( $gallery = false ){
	if( $gallery ){
        return ( class_exists( 'jetpack' ) && Jetpack::is_module_active( 'tiled-gallery' ) ) ? true : false;
	}else{
        return class_exists( 'jetpack' ) ? true : false;
    }           
}

/**
 * Query WooCommerce activation
 */
function is_woocommerce_activated() {
	return class_exists( 'woocommerce' ) ? true : false;
}

/**
 * Check if Polylang is active
*/
function is_polylang_active(){
    return class_exists( 'Polylang' ) ? true : false;
}

/**
 * Check if WTE Advance Search is active
*/
function is_wte_advanced_search_active(){
    return class_exists( 'Wte_Advanced_Search' ) ? true : false;
}