<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Travel_Agency_Pro
 */

if( ! function_exists( 'travel_agency_pro_doctype' ) ) :
/**
 * Doctype Declaration
*/
function travel_agency_pro_doctype(){
    ?>
    <!DOCTYPE html>
    <html <?php language_attributes(); ?>>
    <?php
}
endif;
add_action( 'travel_agency_pro_doctype', 'travel_agency_pro_doctype' );

if( ! function_exists( 'travel_agency_pro_head' ) ) :
/**
 * Before wp_head 
*/
function travel_agency_pro_head(){
    ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1.0, user-scalable=0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
}
endif;
add_action( 'travel_agency_pro_before_wp_head', 'travel_agency_pro_head' );

if( ! function_exists( 'travel_agency_pro_page_start' ) ) :
/**
 * Page Start
*/
function travel_agency_pro_page_start(){
    ?>
    <div id="page" class="site">
    <?php
}
endif;
add_action( 'travel_agency_pro_before_header', 'travel_agency_pro_page_start', 20 );

if( ! function_exists( 'travel_agency_pro_header' ) ) :
/**
 * Header Start
*/
function travel_agency_pro_header(){     
    $header_array = array( 'one', 'two', 'three', 'four', 'five' );
    $header = get_theme_mod( 'header_layout', 'one' );
    if( in_array( $header, $header_array ) ){            
        get_template_part( 'headers/' . $header );
    }    
}
endif;
add_action( 'travel_agency_pro_header', 'travel_agency_pro_header', 20 );

if( ! function_exists( 'travel_agency_pro_polylang_language_switcher' ) ) :
/**
 * Template for Polylang Language Switcher
*/
function travel_agency_pro_polylang_language_switcher(){
    if( is_polylang_active() ){ ?>
        <nav class="language-dropdown">
    		<?php
    			wp_nav_menu( array(
    				'theme_location' => 'language',
    				'menu_class'     => 'languages',
                    'fallback_cb'    => false,
    			) );
    		?>
    	</nav><!-- #site-navigation -->
        <?php        
    }
}
endif;
add_action( 'travel_agency_pro_language_switcher', 'travel_agency_pro_polylang_language_switcher' );

if( ! function_exists( 'travel_agency_pro_breadcrumb' ) ) :
/**
 * Page Header for inner pages
*/
function travel_agency_pro_breadcrumb(){    
    
    global $post;
    $post_page  = get_option( 'page_for_posts' ); //The ID of the page that displays posts.
    $show_front = get_option( 'show_on_front' ); //What to show on the front page    
    $home       = get_theme_mod( 'breadcrumb_home_text', __( 'Home', 'travel-agency-pro' ) ); // text for the 'Home' link
    $delimiter  = get_theme_mod( 'breadcrumb_separator', __( '>', 'travel-agency-pro' ) ); // delimiter between crumbs
    $before     = '<span class="current">'; // tag before the current crumb
    $after      = '</span>'; // tag after the current crumb
    
    if( get_theme_mod( 'ed_breadcrumb', true ) && ! is_front_page() ){
        
        echo '<div class="top-bar"><div class="container"><div id="crumbs"><a href="' . esc_url( home_url() ) . '">' . esc_html( $home ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
        
        if( is_home() ){
            
            echo $before . esc_html( single_post_title( '', false ) ) . $after;
            
        }elseif( is_category() ){
            
            $thisCat = get_category( get_query_var( 'cat' ), false );
            
            if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                $p = get_post( $post_page );
                echo ' <a href="' . esc_url( get_permalink( $post_page ) ) . '">' . esc_html( $p->post_title ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';  
            }
            
            if( $thisCat->parent != 0 ) echo get_category_parents( $thisCat->parent, TRUE, ' <span class="separator">' . $delimiter . '</span> ' );
            echo $before .  esc_html( single_cat_title( '', false ) ) . $after;
        
        }elseif( is_woocommerce_activated() && ( is_product_category() || is_product_tag() ) ){ //For Woocommerce archive page
        
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            
            if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
    			$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                if ( ! $_name ) {
        			$product_post_type = get_post_type_object( 'product' );
        			$_name = $product_post_type->labels->singular_name;
        		}
                echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html( $_name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
    		}

            if( is_product_category() ){
                $ancestors = get_ancestors( $current_term->term_id, 'product_cat' );
                $ancestors = array_reverse( $ancestors );
        		foreach ( $ancestors as $ancestor ) {
        			$ancestor = get_term( $ancestor, 'product_cat' );    
        			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
        				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
        			}
        		}
            }           
            echo $before . esc_html( $current_term->name ) . $after;
            
        }elseif( is_woocommerce_activated() && is_shop() ){ //Shop Archive page
            if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
    			return;
    		}
    		$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
    
    		if ( ! $_name ) {
    			$product_post_type = get_post_type_object( 'product' );
    			$_name = $product_post_type->labels->singular_name;
    		}
            echo $before . esc_html( $_name ) . $after;
            
        }elseif( travel_agency_is_wpte_activated() && is_tax( array( 'activities', 'destination', 'trip_types' ) ) ){ //Trip Taxonomy pages
            $current_term = $GLOBALS['wp_query']->get_queried_object();
            $tax = array(
                'activities'  => 'templates/template-activities.php',
                'destination' => 'templates/template-destination.php',
                'trip_types'  => 'templates/template-trip_types.php'
            );
            
            foreach( $tax as $k => $v ){
                if( is_tax( $k ) ){
                    $p_id = travel_agency_pro_get_page_id_by_template( $v );
                    if( $p_id ){
                        echo ' <a href="' . esc_url( get_permalink( $p_id[0] ) ) . '">' . esc_html( get_the_title( $p_id[0] ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                    }else{
                        $post_type = get_post_type_object( 'trip' );
                        if( $post_type->has_archive == true ){// For CPT Archive Link
                           
                           // Add support for a non-standard label of 'archive_title' (special use case).
                           $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                           printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                           echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
            
                        }
                        
                    }
                    //For trip taxonomy hierarchy
                    $ancestors = get_ancestors( $current_term->term_id, $k );
                    $ancestors = array_reverse( $ancestors );
            		foreach ( $ancestors as $ancestor ) {
            			$ancestor = get_term( $ancestor, $k );    
            			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
            				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            			}
            		}
                }
            }
            
            echo $before . esc_html( $current_term->name ) . $after;
        }elseif( is_tag() ){
            
            echo $before . esc_html( single_tag_title( '', false ) ) . $after;
     
        }elseif( is_author() ){
            
            global $author;
            $userdata = get_userdata( $author );
            echo $before . esc_html( $userdata->display_name ) . $after;
     
        }elseif( is_search() ){
            
            echo $before . esc_html__( 'Search Results for "', 'travel-agency-pro' ) . esc_html( get_search_query() ) . esc_html__( '"', 'travel-agency-pro' ) . $after;
        
        }elseif( is_day() ){
            
            echo '<a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-agency-pro' ) ) ) ) . '">' . esc_html( get_the_time( __( 'Y', 'travel-agency-pro' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo '<a href="' . esc_url( get_month_link( get_the_time( __( 'Y', 'travel-agency-pro' ) ), get_the_time( __( 'm', 'travel-agency-pro' ) ) ) ) . '">' . esc_html( get_the_time( __( 'F', 'travel-agency-pro' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( __( 'd', 'travel-agency-pro' ) ) ) . $after;
        
        }elseif( is_month() ){
            
            echo '<a href="' . esc_url( get_year_link( get_the_time( __( 'Y', 'travel-agency-pro' ) ) ) ) . '">' . esc_html( get_the_time( __( 'Y', 'travel-agency-pro' ) ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            echo $before . esc_html( get_the_time( __( 'F', 'travel-agency-pro' ) ) ) . $after;
        
        }elseif( is_year() ){
            
            echo $before . esc_html( get_the_time( __( 'Y', 'travel-agency-pro' ) ) ) . $after;
    
        }elseif( is_single() && !is_attachment() ){
            
            if( is_woocommerce_activated() && 'product' === get_post_type() ){ //For Woocommerce single product
        		
        		if ( wc_get_page_id( 'shop' ) ) { //Displaying Shop link in woocommerce archive page
	    			$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
	                if ( ! $_name ) {
	        			$product_post_type = get_post_type_object( 'product' );
	        			$_name = $product_post_type->labels->singular_name;
	        		}
	                echo ' <a href="' . esc_url( get_permalink( wc_get_page_id( 'shop' ) ) ) . '">' . esc_html( $_name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
	    		}
    		
                if ( $terms = wc_get_product_terms( $post->ID, 'product_cat', array( 'orderby' => 'parent', 'order' => 'DESC' ) ) ) {
        			$main_term = apply_filters( 'woocommerce_breadcrumb_main_term', $terms[0], $terms );
        			$ancestors = get_ancestors( $main_term->term_id, 'product_cat' );
                    $ancestors = array_reverse( $ancestors );
            		foreach ( $ancestors as $ancestor ) {
            			$ancestor = get_term( $ancestor, 'product_cat' );    
            			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
            				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            			}
            		}
        			echo ' <a href="' . esc_url( get_term_link( $main_term ) ) . '">' . esc_html( $main_term->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
        		}
                
                echo $before . esc_html( get_the_title() ) . $after;
                
            }elseif( travel_agency_is_wpte_activated() && get_post_type() === 'trip' ){ //For Single Trip 
                // Check for Destination page templage
                $destination = travel_agency_pro_get_page_id_by_template( 'templates/template-destination.php' );
                if( $destination ){
                    echo ' <a href="' . esc_url( get_permalink( $destination[0] ) ) . '">' . esc_html( get_the_title( $destination[0] ) ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';                                        
                }else{
                    $post_type = get_post_type_object( 'trip' );
                    if( $post_type->has_archive == true ){// For CPT Archive Link
                       
                       // Add support for a non-standard label of 'archive_title' (special use case).
                       $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                       printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                       echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
        
                    }                    
                }
                // Check for destination taxonomy hierarchy
                $terms = wp_get_post_terms( $post->ID, 'destination', array( 'orderby' => 'parent', 'order' => 'DESC' ) );                
                if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) { //Parents terms
                    $ancestors = get_ancestors( $terms[0]->term_id, 'destination' );
                    $ancestors = array_reverse( $ancestors );
                    foreach ( $ancestors as $ancestor ) {
            			$ancestor = get_term( $ancestor, 'destination' );    
            			if ( ! is_wp_error( $ancestor ) && $ancestor ) {
            				echo ' <a href="' . esc_url( get_term_link( $ancestor ) ) . '">' . esc_html( $ancestor->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            			}
            		}                    
                    // Last child term
                    echo ' <a href="' . esc_url( get_term_link( $terms[0] ) ) . '">' . esc_html( $terms[0]->name ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';
                }
                                
                echo $before . esc_html( get_the_title() ) . $after;
                
            }elseif ( get_post_type() != 'post' ){
                
                $post_type = get_post_type_object( get_post_type() );
                
                if( $post_type->has_archive == true ){// For CPT Archive Link
                   
                   // Add support for a non-standard label of 'archive_title' (special use case).
                   $label = !empty( $post_type->labels->archive_title ) ? $post_type->labels->archive_title : $post_type->labels->name;
                   printf( '<a href="%1$s">%2$s</a>', esc_url( get_post_type_archive_link( get_post_type() ) ), $label );
                   echo '<span class="separator">' . esc_html( $delimiter ) . '</span> ';
    
                }
                echo $before . esc_html( get_the_title() ) . $after;
                
            }else{ //For Post
                
                $cat_object       = get_the_category();
                $potential_parent = 0;
                
                if( $show_front === 'page' && $post_page ){ //If static blog post page is set
                    $p = get_post( $post_page );
                    echo ' <a href="' . esc_url( get_permalink( $post_page ) ) . '">' . esc_html( $p->post_title ) . '</a> <span class="separator">' . esc_html( $delimiter ) . '</span> ';  
                }
                
                if( is_array( $cat_object ) ){ //Getting category hierarchy if any
        
        			//Now try to find the deepest term of those that we know of
        			$use_term = key( $cat_object );
        			foreach( $cat_object as $key => $object )
        			{
        				//Can't use the next($cat_object) trick since order is unknown
        				if( $object->parent > 0  && ( $potential_parent === 0 || $object->parent === $potential_parent ) ){
        					$use_term = $key;
        					$potential_parent = $object->term_id;
        				}
        			}
                    
        			$cat = $cat_object[$use_term];
              
                    $cats = get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' );
                    $cats = preg_replace( "#^(.+)\s$delimiter\s$#", "$1", $cats ); //NEED TO CHECK THIS
                    echo $cats;
                }
    
                echo $before . esc_html( get_the_title() ) . $after;
                
            }
        
        }elseif( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ){
            
            $post_type = get_post_type_object(get_post_type());
            if( get_query_var('paged') ){
                echo '<a href="' . esc_url( get_post_type_archive_link( $post_type->name ) ) . '">' . esc_html( $post_type->label ) . '</a>';
                echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . sprintf( __('Page %s', 'travel-agency-pro'), get_query_var('paged') ) . $after;
            }else{
                echo $before . esc_html( $post_type->label ) . $after;
            }
    
        }elseif( is_attachment() ){
            
            $parent = get_post( $post->post_parent );
            $cat = get_the_category( $parent->ID ); 
            if( $cat ){
                $cat = $cat[0];
                echo get_category_parents( $cat, TRUE, ' <span class="separator">' . esc_html( $delimiter ) . '</span> ');
                echo '<a href="' . esc_url( get_permalink( $parent ) ) . '">' . esc_html( $parent->post_title ) . '</a>' . ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            echo  $before . esc_html( get_the_title() ) . $after;
        
        }elseif( is_page() && !$post->post_parent ){
            
            echo $before . esc_html( get_the_title() ) . $after;
    
        }elseif( is_page() && $post->post_parent ){
            
            $parent_id  = $post->post_parent;
            $breadcrumbs = array();
            
            while( $parent_id ){
                $page = get_post( $parent_id );
                $breadcrumbs[] = '<a href="' . esc_url( get_permalink( $page->ID ) ) . '">' . esc_html( get_the_title( $page->ID ) ) . '</a>';
                $parent_id  = $page->post_parent;
            }
            $breadcrumbs = array_reverse( $breadcrumbs );
            for ( $i = 0; $i < count( $breadcrumbs) ; $i++ ){
                echo $breadcrumbs[$i];
                if ( $i != count( $breadcrumbs ) - 1 ) echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ';
            }
            echo ' <span class="separator">' . esc_html( $delimiter ) . '</span> ' . $before . esc_html( get_the_title() ) . $after;
        
        }elseif( is_404() ){
            echo $before . esc_html__( '404 Error - Page Not Found', 'travel-agency-pro' ) . $after;
        }
        
        if( get_query_var('paged') ) echo __( ' (Page', 'travel-agency-pro' ) . ' ' . get_query_var('paged') . __( ')', 'travel-agency-pro' );
        
        echo '</div></div></div>';
        
    }
}
endif;
add_action( 'travel_agency_pro_after_header', 'travel_agency_pro_breadcrumb', 20 );

if( ! function_exists( 'travel_agency_pro_content_start' ) ) :
/**
 * Content Start
*/
function travel_agency_pro_content_start(){
    
    $home_sections = travel_agency_pro_get_homepage_section();
    
    $class = is_404() ? 'error-holder' : 'row' ;
    
    if( !( is_front_page() && ! is_home() && $home_sections ) && ! is_page_template( 'templates/about.php' ) ){ ?>
    <div id="content" class="site-content<?php if( is_post_type_archive( 'trip' ) ) echo ' trip-content-area';?>">
        <?php if( ! is_page_template( 'templates/contact.php' ) ) { ?>
        <div class="container">
            <?php 
            /**
             * Page Header
             * 
             * @hooked travel_agency_pro_team_slider - 15
             * @hooked travel_agency_pro_page_header - 20
            */
            do_action( 'travel_agency_pro_page_header' );
            ?>
            <div class="<?php echo esc_attr( $class ); ?>">
        <?php
        }
    }
}
endif;
add_action( 'travel_agency_pro_content', 'travel_agency_pro_content_start' );

if( ! function_exists( 'travel_agency_pro_team_slider' ) ) :
/**
 * Team Slider
*/
function travel_agency_pro_team_slider(){    
    if( is_page_template( 'templates/team.php' ) ){
        $feat_type   = get_theme_mod( 'team_page_image', 'featured_image' );
        $team_slides = get_theme_mod( 'team_page_slider' );
        
        if( $feat_type == 'featured_slider' && $team_slides ){ ?>
        <div id="team-slider" class="owl-carousel">
    		<?php foreach( $team_slides as $slide ){?>
            <div class="item"><img src="<?php echo esc_url( wp_get_attachment_image_url( $slide, 'travel-agency-full' ) ); ?>" /></div>
    		<?php } ?>
    	</div>
        <?php
        }elseif( ( $feat_type == 'featured_image' ) && has_post_thumbnail() ){
            echo '<div class="post-thumbnail">';
            the_post_thumbnail( 'travel-agency-full' );
            echo '</div>';
        }
    }
}
endif;
add_action( 'travel_agency_pro_page_header', 'travel_agency_pro_team_slider', 15 );

if( ! function_exists( 'travel_agency_pro_page_header' ) ) :
/**
 * Page Header
*/
function travel_agency_pro_page_header(){
    if( ! is_page_template( array( 'templates/team.php', 'templates/about.php', 'templates/contact.php', 'templates/destination.php', 'templates/testimonial.php' ) ) ){ ?>    
        <header class="page-header">
        <?php
            if( is_woocommerce_activated() && ( is_product_category() || is_product_tag() || is_shop() ) ){
                if( is_shop() ){
                    if ( get_option( 'page_on_front' ) == wc_get_page_id( 'shop' ) ) {
                		return;
                	}
                	$_name = wc_get_page_id( 'shop' ) ? get_the_title( wc_get_page_id( 'shop' ) ) : '';
                
                	if ( ! $_name ) {
                		$product_post_type = get_post_type_object( 'product' );
                		$_name = $product_post_type->labels->singular_name;
                	}
                    echo '<h1 class="page-title">' . esc_html( $_name ) . '</h1>';
                }elseif( is_product_category() || is_product_tag() ){
                    $current_term = $GLOBALS['wp_query']->get_queried_object();
                    echo '<h1 class="page-title">' . esc_html( $current_term->name ) . '</h1>';
                }
            }else{            
                if( is_archive() ){
        			if( ! is_tax( array( 'destination', 'activities', 'trip_types' ) ) ){
                        the_archive_title( '<h1 class="page-title">', '</h1>' );
                        if( get_post_type() == 'post' ) the_archive_description( '<div class="archive-description">', '</div>' );
                    }
                }
            }
        
            if( is_search() ){ ?>            
    			<h1 class="page-title"><?php
    				/* translators: %s: search query. */
    				printf( esc_html__( 'Search Results for: %s', 'travel-agency-pro' ), '<span>' . get_search_query() . '</span>' );
    			?></h1>    		
            <?php
            }
        
            if( is_page() ){ 
                the_title( '<h1 class="page-title">', '</h1>' ); 
            }
            
            if( is_404() ) echo '<h1 class="page-title">' . esc_html__( '404', 'travel-agency-pro' ) . '</h1>'; //For 404
            ?>
        </header><!-- .page-header -->
    <?php
    }
}
endif;
add_action( 'travel_agency_pro_page_header', 'travel_agency_pro_page_header', 20 );

if( ! function_exists( 'travel_agency_pro_entry_header' ) ) :
/**
 * Post Entry Header
*/
function travel_agency_pro_entry_header(){ 
    if( ! is_page() ){ ?>    
    <header class="entry-header">		
		<div class="entry-meta">
			<?php 
                travel_agency_pro_categories();                
                travel_agency_pro_posted_on();                
            ?>            
		</div>
        <?php 
            if( is_single() ){
                the_title( '<h2 class="entry-title">', '</h2>' );    
            }else{
                the_title( '<h2 class="entry-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h2>' ); 
            }
        ?>
	</header>
    <?php  
    }
}
endif;
add_action( 'travel_agency_pro_before_entry_content', 'travel_agency_pro_entry_header', 15 );

if( ! function_exists( 'travel_agency_pro_entry_template_header' ) ) :
/**
 * Post Entry Header
*/
function travel_agency_pro_entry_template_header(){ 
    if( is_page_template( array( 'templates/team.php', 'templates/destination.php', 'templates/testimonial.php' ) ) ){ 
        the_title( '<header class="page-header"><h1 class="page-title">', '</h1></header>' ); 
    }
}
endif;
add_action( 'travel_agency_pro_before_entry_content', 'travel_agency_pro_entry_template_header', 15 );

if( ! function_exists( 'travel_agency_pro_post_thumbnail' ) ) :
/**
 * Post Thumbnail
*/
function travel_agency_pro_post_thumbnail(){
    $ed_featured_image = get_theme_mod( 'ed_featured_image', true );
    if( has_post_thumbnail() && ! is_page_template( 'templates/team.php' ) ){
        if( is_singular() && $ed_featured_image ){
            echo '<div class="post-thumbnail">';
            the_post_thumbnail( 'travel-agency-full' );
            echo '</div>';
        }elseif( ! is_singular() ){
            echo '<a href="' . esc_url( get_permalink() ) . '" class="post-thumbnail">';
            the_post_thumbnail( 'travel-agency-full' );
            echo '</a>';
        }        
    }
}
endif;
add_action( 'travel_agency_pro_before_entry_content', 'travel_agency_pro_post_thumbnail', 20 );

if( ! function_exists( 'travel_agency_pro_entry_content' ) ) :
/**
 * Entry Content
*/
function travel_agency_pro_entry_content(){ ?>
    <div class="entry-content">
		<?php			
            if( ! is_singular() && false === get_post_format() ){
                the_excerpt();
            }else{
                the_content( sprintf(
    				wp_kses(
    					/* translators: %s: Name of current post. Only visible to screen readers */
    					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'travel-agency-pro' ),
    					array(
    						'span' => array(
    							'class' => array(),
    						),
    					)
    				),
    				get_the_title()
    			) );
    
    			wp_link_pages( array(
    				'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'travel-agency-pro' ),
    				'after'  => '</div>',
    			) );
            }
            
		?>
	</div><!-- .entry-content -->
    <?php
}
endif;
add_action( 'travel_agency_pro_entry_content', 'travel_agency_pro_entry_content', 20 );
add_action( 'travel_agency_pro_page_entry_content', 'travel_agency_pro_entry_content', 15 );

if( ! function_exists( 'travel_agency_pro_teams' ) ) :
/**
 * Prints teams in team page template
*/
function travel_agency_pro_teams(){
    if( is_page_template( 'templates/team.php' ) ){
        $post_order = get_theme_mod( 'team_post_order', 'date' );
        
        $args = array(
            'post_type'      => 'tap_team',
            'post_status'    => 'publish',
            'posts_per_page' => -1,
        );
        if( $post_order == 'menu_order' ){
            $args['order']   = 'ASC';
            $args['orderby'] = 'menu_order';
        }
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){ ?>
            <div class="team-holder">
        	<?php 
                while( $qry->have_posts() ){ 
                    $qry->the_post(); 
                    $designation = get_post_meta( get_the_ID(), '_tap_team_position', true ); ?>	
                    <div class="item">
                        <?php 
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( 'travel-agency-team' );    
                			}else{
                                //fallback
                                echo '<img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-280-350.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
                			}
                        ?>                        
            			<div class="text">
            				<?php
                                the_title( '<h2 class="name">', '</h2>' );
                                if( $designation ) echo '<span class="designation">' . esc_html( $designation ) . '</span>';
                            ?>
            			</div>
            			<div class="text-holder">
            				<div class="holder"><?php the_excerpt(); ?></div>
                            <a href="<?php the_permalink(); ?>" class="btn-more">&rarr;</a>
            			</div>
            		</div>
            	   <?php 
                }
                wp_reset_postdata();
            ?>
        	</div><!-- .team-holder -->    
            <?php
        }
    }
}
endif;
add_action( 'travel_agency_pro_page_entry_content', 'travel_agency_pro_teams', 16 );

if( ! function_exists( 'travel_agency_pro_google_map' ) ) :
/**
 * Google Map
*/
function travel_agency_pro_google_map(){
    $ed_map = get_theme_mod( 'ed_google_map', false );
    if( $ed_map ){
        echo '<div id="map-canvas" class="map-holder"></div>';
    }elseif( has_post_thumbnail() ){
        echo '<div id="contact-featured-img">';
        the_post_thumbnail( 'full' );
        echo '</div>';
    }
}
endif;
add_action( 'travel_agency_pro_contact_page', 'travel_agency_pro_google_map', 15 );

if( ! function_exists( 'travel_agency_pro_contact_info' ) ) :
/**
 * Contact Info
*/
function travel_agency_pro_contact_info(){ 
    $arrays = array( 'phone', 'email', 'location', 'whatsap', 'skype', 'viber' ); ?>
    <?php /* ?><div id="contact_info_section" class="contact-info">
		<div class="container">
			<div class="grid">
				<?php
                foreach( $arrays as $a ){
                    travel_agency_pro_get_contact_info( $a );
                }
                ?>
			</div>
		</div>
	</div>
    <?php */ ?>
    <?php
}
endif;
add_action( 'travel_agency_pro_contact_page', 'travel_agency_pro_contact_info', 20 );

if( ! function_exists( 'travel_agency_pro_contact_form' ) ) :
/**
 * Contact Form
*/
function travel_agency_pro_contact_form(){
    $title   = get_theme_mod( 'contact_info_title', __( 'Leave Us Your Info', 'travel-agency-pro' ) );
    $content = get_theme_mod( 'contact_info_content', __( 'The contact page is just for demonstration purpose. Please DON\'T contact us via the contact form. For any questions or support, contact us on our support forum.', 'travel-agency-pro' ) );
    $form = get_theme_mod( 'contact_form' );
    if(isset($_POST['submitted']) == "Submit") {
   session_start();
   if(isset($_POST['g-recaptcha-response']))
          $captcha=$_POST['g-recaptcha-response'];
        $response=json_decode(file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=6LdtIY4UAAAAAOqn4a88d5iVd7Jwa6Ww5_MybfxW&response=".$captcha."&remoteip=".$_SERVER['REMOTE_ADDR']), true);
        if($response['success'] == true)
        {
              $name = trim($_POST['fullName']);
              $phone = trim($_POST['phone']);
              $country = trim($_POST['country']);
              $email = trim($_POST['email']);
              $html="<strong>NEPAL ALSACE TREKS & EXPEDITION Contact form!<br><br></strong>";
              $html.="Name : ".$name."<br>";
              $html.="Phone:  ".$phone."<br>";
              $html.="Country:  ".$country."<br>";
              $html.="E-mail:  ".$email."<br>";
              $html.="Comments :".trim($_POST['comments'])."<br>";
              $b=$html;
              $to=''.get_option( 'admin_email' ).',gurungdhanee@hotmail.com';
              $sub="NEPAL ALSACE TREKS & EXPEDITION contact from Contact form!";
              $header='';
              $header.='MIME-Version: 1.0' . "\n";
              $header.='Date: ' . date('D, d M Y H:i:s O') . "\n";
              $header.='From: ' .  $name .  '<' . $email . '>' . "\n";
              $header.='Reply-To: ' .  $name .  '<' . $email . '>' . "\n";
              $header.= "Cc: ".get_option( 'admin_email' )."\n";
              $header.='Return-Path: ' .$email . "\n";
              $header.='X-Mailer: PHP/' . phpversion() . "\n";
              $header.="Content-Type: text/html; charset=iso-8859-1\r\n";
              if(mail($to, $sub, $b, $header))
              {
              $emailSent = true;
              }
              else
              {
              $hasError = true;
              }
    }
    else
        {
        $message="You are spammer. Please, try again.";
        }
}
    $countries=array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia And Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo - The Democratic Republic Of The", "Cook Islands", "Costa Rica", "Cote D'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island And Mcdonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran - Islamic Republic Of", "Iraq", "Ireland", "Isle Of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea - Democratic People'S Republic Of", "Korea - Republic Of", "Kuwait", "Kyrgyzstan", "Lao People'S Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia - The Former Yugoslav Republic Of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia - Federated States Of", "Moldova - Republic Of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory - Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts And Nevis", "Saint Lucia", "Saint Pierre And Miquelon", "Saint Vincent And The Grenadines", "Samoa", "San Marino", "Sao Tome And Principe", "Saudi Arabia", "Senegal", "Serbia And Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia And The South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard And Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Province Of China", "Tajikistan", "Tanzania - United Republic Of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad And Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks And Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands - British", "Virgin Islands - U.S.", "Wallis And Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");

    if( $title || $content || $form ){    
    ?>
    <div class="body-contentContainer">
                <div class="container main-content" data-sticky-sidebar-container>
                    <div class="bg-white">
                            <div class="row">
                            <div class="col-xs-12 col-sm-8 col-md-8">
                                <div class="contact-form">
                                    <?php if( $title || $content ){
                                    if( $title ) echo '<h2>' . esc_html( travel_agency_pro_contact_form_title() ) . '</h2>';
                                    if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_pro_contact_form_sub_title() ) . '</div>';
                                    }

                                    /*if( $form ){
                                        echo do_shortcode( $form );
                                    } */
                                    ?>
                                    <div class="form-property">
                                    <p style="margin-bottom:20px;"><span class="sm-note">Note:</span>You can reach to us using the form below.</p>
                                    <?php //echo do_shortcode( '[contact-form-7 id="873" title="Contact form 1"]' ); ?>
                                    <?php if(isset($emailSent) && $emailSent == true) { ?>
                                    <ul class="list-group">
                                    <li class="list-group-item list-group-item-success">
                                    <strong>Thanks! <?php echo $name;?></strong>&nbsp;&nbsp;Your message have been submitted Sucessfully.</li></ul>
                                    <?php } ?>
                                    <?php if(isset($hasError) && $hasError == true) { ?>
                                    <ul class="list-group"><li class="list-group-item list-group-item-danger">
                                    <strong>Error!</strong> Your submission was unsuccessful, please try again.</li></ul>
                                    <?php } elseif(isset($message)) { ?>
                                    <ul class="list-group"><li class="list-group-item list-group-item-danger"><strong>Warning!</strong> <?php echo $message; ?></li></ul>
                                    <?php } ?>
                                    <form action="" method="post" role="form">
                                    <div class="row row-single">
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <label>Full Name:  <strong>*</strong></label>
                                    <input type="text" name="fullName" class="form-control" value="<?php if(isset($_POST['fullName']) && !isset($emailSent))  echo $_POST['fullName'];?>" required placeholder="Enter Full Name">
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <label>Your Phone:  <strong>*</strong></label>
                                    <input type="text" name="phone" class="form-control" value="<?php if(isset($_POST['phone']) && !isset($emailSent)) echo $_POST['phone'];?>" required placeholder="Enter Phone Number">
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row row-single">
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <label>Country (According to your passport): <strong>*</strong></label>
                                    <select name="country" id="country" class="form-control" required>
                                    <option value="">-- Select Country --</option>
                                    <?php
                                    for($i=0; $i<count($countries); $i++) {
                                    if(isset($_POST['country'])==$countries[$i]) {
                                    echo '<option value="'.$countries[$i].'" selected="selected">'.$countries[$i].'</option>';
                                    }else{
                                    echo '<option value="'.$countries[$i].'">'.$countries[$i].'</option>';
                                    }
                                    }
                                    ?>
                                    </select>        
                                    </div>
                                    </div>
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <label>Email:  <strong>*</strong></label>
                                    <input type="email" name="email" class="form-control" value="<?php if(isset($_POST['email']) && !isset($emailSent))  echo $_POST['email'];?>" required placeholder="Enter Email Address">

                                    </div>
                                    </div>
                                    </div>
                                    <div class="row row-single">
                                    <div class="col-xs-12 col-sm-12 col-md-12"> 
                                    <div class="form-element">
                                    <label>Comments/Questions</label>
                                    <textarea name="comments" placeholder="Enter Enter Message if any" class="form-control" style="width:100%;"><?php if(isset($_POST['comments']) && !isset($emailSent)) echo $_POST['comments']; ?></textarea>
                                    </div></div></div>
                                    <div class="row row-single">
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <div class="g-recaptcha" data-sitekey="6LdtIY4UAAAAAED6u-qp8ExvJnl42Q9iLB2jt0Fd" data-callback="enableBtn"></div>
                                    </div>
                                    </div>
                                    </div>
                                    <div class="row row-single">
                                    <div class="col-xs-12 col-sm-6 col-md-6"> 
                                    <div class="form-element">
                                    <input type="submit" value="Submit" name="submitted" class="wpcf7-form-control wpcf7-submit btn-submit" id="btn-send-dis123" >
                                    </div>
                                    </div>
                                    </div>
                                    
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-sm-4 col-md-4">
                                <div class="contact-form">
                                    <h2>Our Address</h2>
                                    <?php
                                    $phone   = get_theme_mod( 'contact_phone', __( '(888) 123-456789', 'travel-agency-pro' ) );
                                    $email   = get_theme_mod( 'contact_email', __( 'info@testing.com, info@gmail.com, support@test.com', 'travel-agency-pro' ) );
                                    $address = get_theme_mod( 'contact_address', __( 'Travel Agency. PO Box 19604, Thamel Kathmandu, Nepal', 'travel-agency-pro' ) );
                                    $whatsap = get_theme_mod( 'contact_whatsapp', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
                                    $skype   = get_theme_mod( 'contact_skype', __( 'skype@company.com', 'travel-agency-pro' ) );
                                    $viber   = get_theme_mod( 'contact_viber', __( '+977- 9876543210(Kathy), +977- 9877665544(Suji)', 'travel-agency-pro' ) );
                                    ?>
                                    <?php if( $address ) { ?>
                                    <?php echo $address; ?>
                                    <?php } ?><br><br>
                                    <?php if( $phone ) { ?>
                                    <?php echo $phone; ?>
                                    <?php } ?>
                                    <?php if( $email ) { ?>
                                    <?php echo $email; ?>
                                    <?php } ?><br><br>
                                    <?php if( $skype ) { ?>
                                    <?php echo $skype; ?>
                                    <?php } ?>

                                </div>
                            </div>
                        </div>  
                    </div>
                </div>
            </div>
    <?php
    }
}
endif;
add_action( 'travel_agency_pro_contact_page', 'travel_agency_pro_contact_form', 25 );

if( ! function_exists( 'travel_agency_pro_testimonials' ) ) :
/**
 * Prints Testimonials in testimonial page templates
*/ 
function travel_agency_pro_testimonials(){
    if( is_page_template( 'templates/testimonial.php' ) ){
        $pagination = get_theme_mod( 'pagination_type', 'numbered' );
        $paged = ( get_query_var( 'paged' ) ) ? absint( get_query_var( 'paged' ) ) : 1;
        $posts_per_page = get_option( 'posts_per_page' );
        $args = array(
            'post_type'      => 'tap_testimonial',
            'post_status'    => 'publish',
            'posts_per_page' => $posts_per_page,
            'paged'          => $paged,
        );
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){
            echo '<div class="testimonial-holder">';
            while( $qry->have_posts() ){
                $qry->the_post();
                $visited_trip = get_post_meta( get_the_ID(), '_tap_testimonail_visited_trip', true );
                $trip_date    = get_post_meta( get_the_ID(), '_tap_testimonail_trip_date', true );
                $trip_rating  = get_post_meta( get_the_ID(), '_tap_testimonail_trip_rating', true );
                ?>
                <div class="item">                				
                    
					<div class="img-holder">
                    <?php 
                        if( has_post_thumbnail() ){
                            the_post_thumbnail( 'thumbnail' );                					   
                        }else{
	                       //fallback
                            echo '<img src="' . esc_url( get_template_directory_uri() . 'images/fallback/fallback-img-150-150.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
	                    }
                        
                        the_title( '<span class="name">', '</span>' );
                    ?>
                    </div>
                    
    				<div class="text-holder">	
                        <?php 
                            if( $visited_trip ) echo '<h3 class="title">' . esc_html( $visited_trip ) . '</h3>';
                            if( $trip_date ) printf( esc_html__( '%1$sVisited %2$s%3$s', 'travel-agency-pro' ), '<span class="visited-on">', esc_html( $trip_date ), '</span>' );
                            if( $trip_rating ){ 
                                echo '<div class="star-holder">';
                                echo '<span id="rating-' . esc_attr( get_the_ID() ) . '" data-rating="' . esc_attr( $trip_rating ) . '"></span>';
            					echo '</div>';
                                echo '<script>
                                    jQuery(document).ready(function($){                                        
                                        $("#rating-' . get_the_ID() . '").rateYo({
                                            rating: ' . $trip_rating . ',
                                            starWidth: "13px",
                                            readOnly: true
                                        });
                                    });
                                    </script>';        
                            }
                        ?>
                        <div class="testimonial-content">
    						<?php the_content(); ?>
    					</div>                                   
    				</div>     				
    			</div>			
                <?php
            }            
            echo '</div>';
            //echo $qry->max_num_pages;
            /** Pagination */
            switch( $pagination ){
                case 'default': // Default Pagination
                    echo '<nav class="navigation posts-navigation" role="navigation"><div class="nav-links">';
                    echo '<div class="nav-previous">' . get_next_posts_link( __( 'Older Testimonials', 'travel-agency-pro' ), $qry->max_num_pages ) . '</div>';
                    echo '<div class="nav-next">' . get_previous_posts_link( __( 'Newer Testimonials', 'travel-agency-pro') ) . '</div>';               
                    echo '</div></nav>';
                break;
                
                case 'numbered': // Numbered Pagination
                    $big = 999999999; // need an unlikely integer
                    echo '<nav class="navigation pagination" role="navigation"><div class="nav-links">';
                    echo paginate_links( array(
                        'base'      => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
                        'format'    => '?paged=%#%',
                        'current'   => max( 1, get_query_var('paged') ),
                        'total'     => $qry->max_num_pages,
                        'prev_text' => __( 'Previous', 'travel-agency-pro' ),
                        'next_text' => __( 'Next', 'travel-agency-pro' ), 
                    ) );
                    echo '</div></nav>';
            
                break;
                
                case 'load_more': // Load More Button
                case 'infinite_scroll': // Auto Infinite Scroll
                
                echo '<div class="pagination"></div>';
                
                break;
            }
            
            wp_reset_postdata();
            
        }else{
            get_template_part( 'template-parts/content', 'none' );
        }            
    }    
}
endif;
add_action( 'travel_agency_pro_page_entry_content', 'travel_agency_pro_testimonials', 16 );

if( ! function_exists( 'travel_agency_pro_entry_footer' ) ) :
/**
 * Entry Footer
*/
function travel_agency_pro_entry_footer(){ ?>
	<footer class="entry-footer">
		<?php
         /*
        $readmore = get_theme_mod( 'readmore', __( 'Read More', 'travel-agency-pro' ) );
        $ed_share = get_theme_mod( 'ed_social_sharing', true );
        $shares   = get_theme_mod( 'social_share', array( 'facebook', 'twitter', 'linkedin', 'gplus', 'pinterest' ) );
        
        if( ! is_page() ){
            if( is_single() ){
                travel_agency_pro_tags();
            }else{
                if( $readmore ) echo '<div class="btn-holder"><a href="' . esc_url( get_the_permalink() ) . '" class="btn-more">' . esc_html( travel_agency_pro_get_readmore_btn() ) . '</a></div>';
            } 
        }
        ?>        
		<div class="meta-holder">
			<div class="meta-info">
				<?php
                    if( ! is_page() ) travel_agency_pro_posted_by();
                    travel_agency_pro_comment_count();
                    if( ! is_page() ) travel_agency_pro_like_count();
                ?>                
			</div>
            <?php
                if( ! is_page() && $ed_share ){
                    echo '<ul class="social-networks">';
                    foreach( $shares as $share ){
                        travel_agency_pro_get_social_share( $share );
                    }
                    echo '</ul>';
                }               
            ?>			
		</div>
        <?php
        if ( get_edit_post_link() ){
			edit_post_link(
				sprintf(
					wp_kses(
						/* translators: %s: Name of current post. Only visible to screen readers 
						__( 'Edit <span class="screen-reader-text">%s</span>', 'travel-agency-pro' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				),
				'<span class="edit-link">',
				'</span>'
			);
        }
		*/ ?> 
	</footer><!-- .entry-footer -->
	<?php            
}
endif;
add_action( 'travel_agency_pro_entry_content', 'travel_agency_pro_entry_footer', 25 );
add_action( 'travel_agency_pro_page_entry_content', 'travel_agency_pro_entry_footer', 20 );

if( ! function_exists( 'travel_agency_pro_author' ) ) :
/**
 * Author Bio
*/
function travel_agency_pro_author(){ 
    $ed_author = get_theme_mod( 'ed_bio', true );
    if( $ed_author && get_the_author_meta( 'description' ) ){ 
        $facebook  = get_user_meta( get_the_author_meta( 'ID' ), '_tap_facebook', true );
        $twitter   = get_user_meta( get_the_author_meta( 'ID' ), '_tap_twitter', true );
        $instagram = get_user_meta( get_the_author_meta( 'ID' ), '_tap_instagram', true );
        $snapchat  = get_user_meta( get_the_author_meta( 'ID' ), '_tap_snapchat', true );
        $pinterest = get_user_meta( get_the_author_meta( 'ID' ), '_tap_pinterest', true );
        $linkedin  = get_user_meta( get_the_author_meta( 'ID' ), '_tap_linkedin', true );
        $gplus     = get_user_meta( get_the_author_meta( 'ID' ), '_tap_gplus', true );    
        ?>
        <div class="author-section">
    		<div class="img-holder"><?php echo get_avatar( get_the_author_meta( 'ID' ), 150 ); ?></div>
    		<div class="text-holder">
    			<h3 class="title"><?php esc_html_e( 'About Author', 'travel-agency-pro' ); ?></h3>			
    			<?php 
                    echo wpautop( wp_kses_post( get_the_author_meta( 'description' ) ) ); 
                    
                    if( $facebook || $twitter || $instagram || $snapchat || $pinterest || $linkedin || $gplus ){
                        echo '<ul class="social-networks">';
                        if( $facebook ){
                            echo '<li><a href="' . esc_url( $facebook ) . '" class="fa fa-facebook"></a></li>';
                        }
                        if( $twitter ){
                            echo '<li><a href="' . esc_url( $twitter ) . '" class="fa fa-twitter"></a></li>';
                        }
                        if( $instagram ){
                            echo '<li><a href="' . esc_url( $instagram ) . '" class="fa fa-instagram"></a></li>';
                        }
                        if( $snapchat ){
                            echo '<li><a href="' . esc_url( $snapchat ) . '" class="fa fa-snapchat"></a></li>';
                        }
                        if( $pinterest ){
                            echo '<li><a href="' . esc_url( $pinterest ) . '" class="fa fa-pinterest"></a></li>';
                        }
                        if( $linkedin ){
                            echo '<li><a href="' . esc_url( $linkedin ) . '" class="fa fa-linkedin"></a></li>';
                        }
                        if( $gplus ){
                            echo '<li><a href="' . esc_url( $gplus ) . '" class="fa fa-google-plus"></a></li>';
                        }
                        echo '</ul>';
                    }
                ?>            
    		</div>
    	</div>
        <?php
    }
}
endif;
add_action( 'travel_agency_pro_after_post_content', 'travel_agency_pro_author', 15 );

if( ! function_exists( 'travel_agency_pro_pagination' ) ) :
/**
 * Pagination
*/
function travel_agency_pro_pagination(){    
    if( is_single() ){
        $previous = get_previous_post_link(
    		'<div class="nav-previous nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Prev Post', 'travel-agency-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
    
    	$next = get_next_post_link(
    		'<div class="nav-next nav-holder">%link</div>',
    		'<span class="meta-nav">' . esc_html__( 'Next Post', 'travel-agency-pro' ) . '</span><span class="post-title">%title</span>',
    		false,
    		'',
    		'category'
    	);
        
        if( $previous || $next ){?>            
            <nav class="navigation post-navigation" role="navigation">
    			<h2 class="screen-reader-text"><?php esc_html_e( 'Post Navigation', 'travel-agency-pro' ); ?></h2>
    			<div class="nav-links">
    				<?php
                        if( $previous ) echo $previous;
                        if( $next ) echo $next;
                    ?>
    			</div>
    		</nav>        
            <?php
        }        
    }else{
        $pagination = get_theme_mod( 'pagination_type', 'numbered' );
        
        switch( $pagination ){
            case 'default': // Default Pagination
            
            the_posts_navigation();
            
            break;
            
            case 'numbered': // Numbered Pagination
            
            the_posts_pagination( array(
                'prev_text'          => __( 'Previous', 'travel-agency-pro' ),
                'next_text'          => __( 'Next', 'travel-agency-pro' ),
                'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'travel-agency-pro' ) . ' </span>',
            ) );
        
            break;
            
            case 'load_more': // Load More Button
            case 'infinite_scroll': // Auto Infinite Scroll
            
            echo '<div class="pagination"></div>';
            
            break;
            
            default:
            
            the_posts_navigation();
            
            break;
        }
        
    }    
}
endif;
add_action( 'travel_agency_pro_after_post_content', 'travel_agency_pro_pagination', 20 );
add_action( 'travel_agency_pro_after_content', 'travel_agency_pro_pagination' );

if( ! function_exists( 'travel_agency_pro_related_posts' ) ) :
/**
 * Related Posts
*/
function travel_agency_pro_related_posts(){
    global $post;
    $related_title    = get_theme_mod( 'related_title', __( 'You may also like...', 'travel-agency-pro' ) );
    $ed_related       = get_theme_mod( 'ed_related', true );
    $related_post_tax = get_theme_mod( 'related_taxonomy', 'cat' );
    
    if( $ed_related ){
        $args = array(
            'post_type'             => 'post',
            'post_status'           => 'publish',
            'posts_per_page'        => 3,
            'ignore_sticky_posts'   => true,
            'post__not_in'          => array( $post->ID ),
            'orderby'               => 'rand'
        );
        
        if( $related_post_tax == 'cat' ){
            $cats = get_the_category( $post->ID );
            if( $cats ){
                $c = array();
                foreach( $cats as $cat ){
                    $c[] = $cat->term_id; 
                }
                $args['category__in'] = $c;
            }
        }elseif( $related_post_tax == 'tag' ){
            $tags = get_the_tags( $post->ID );
            if( $tags ){
                $t = array();
                foreach( $tags as $tag ){
                    $t[] = $tag->term_id;
                }
                $args['tag__in'] = $t;
            }
        }
        
        $qry = new WP_Query( $args );
        
        if( $qry->have_posts() ){
        ?>
        <section class="related-post">
    		<?php if( $related_title ) echo '<h2 class="title">' . esc_html( travel_agency_pro_get_related_title() ) . '</h2>'; ?>
    		<div class="grid">
    			<?php while( $qry->have_posts() ){ $qry->the_post(); ?>
                <div class="col">
    				<div class="img-holder">
    					<a href="<?php the_permalink(); ?>" class="post-thumbnail">
                        <?php 
                            if( has_post_thumbnail() ){
                                the_post_thumbnail( 'travel-agency-related' );    
                            }else{ ?>
                                <img src="<?php echo esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-280-170.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />
                            <?php  
                            }
                        ?>                        
                        </a>
    					<?php travel_agency_pro_categories(); ?>
    				</div>
    				<div class="text-holder">
    					<?php 
                            travel_agency_pro_posted_on();
                            the_title( '<h3 class="post-title"><a href="' . esc_url( get_the_permalink() ) . '">', '</a></h3>' );
                        ?>
    				</div>
    			</div>
    			<?php }
                wp_reset_postdata(); ?>
    		</div>
    	</section>
        <?php
        }
    }
}
endif;
add_action( 'travel_agency_pro_after_post_content', 'travel_agency_pro_related_posts', 25 );

if( ! function_exists( 'travel_agency_pro_comment' ) ) :
/**
 * Page Header
*/
function travel_agency_pro_comment(){
    $ed_comment = get_theme_mod( 'ed_comments', true );
    // If comments are open or we have at least one comment, load up the comment template.
	if ( $ed_comment && ( comments_open() || get_comments_number() ) ) :
		comments_template();
	endif;
}
endif;
add_action( 'travel_agency_pro_after_post_content', 'travel_agency_pro_comment', 30 );
add_action( 'travel_agency_pro_after_page_content', 'travel_agency_pro_comment' );

if( ! function_exists( 'travel_agency_pro_content_end' ) ) :
/**
 * Content End
*/
function travel_agency_pro_content_end(){
    $home_sections = travel_agency_pro_get_homepage_section();
    
    if( !( is_front_page() && ! is_home() && $home_sections ) && ! is_page_template( 'templates/about.php' ) ){
        if( ! is_page_template( 'templates/contact.php' ) ) { ?>
            </div><!-- .row/not-found -->
        </div><!-- .container -->
        <?php } ?>
    </div><!-- #content -->
    <?php
    }
}
endif;
add_action( 'travel_agency_pro_before_footer', 'travel_agency_pro_content_end', 20 );

/*if( ! function_exists( 'travel_agency_pro_related_trips' ) ) :*/
/**
 * Related Trips
*/
/*function travel_agency_pro_related_trips(){
    if( is_singular( 'trip' ) ){ 
        global $post;
        $related_title = get_theme_mod( 'related_trip_title', __( 'Related Trips', 'travel-agency-pro' ) );
        $related_tax   = 'destination';
        $label         = get_theme_mod( 'related_trip_readmore', __( 'View Details', 'travel-agency-pro' ) );
        
        $terms = get_the_terms( $post->ID, $related_tax );
        
        $args = array( 
            'post_type'      => 'trip',
            'post_status'    => 'publish',
            'posts_per_page' => 6,
            'post__not_in'   => array( $post->ID ),
            'orderby'        => 'rand'
        );
        
        if( $terms ){
            $t = array();
            foreach( $terms as $term ){
                $t[] = $term->term_id; 
            }
            $args['tax_query'] = array(
        		array(
        			'taxonomy' => $related_tax,        			
        			'terms'    => $t,
        		),
        	);            
        }
            
        $qry = new WP_Query( $args );
        $currency = travel_agency_pro_get_trip_currency();
        
        if( $related_title || $qry->have_posts() ){ ?>
        <section class="related-trips">
    		<div class="container">
    			<?php if( $related_title ){ ?>
                <header class="section-header">
    				<h2 class="section-title"><?php echo esc_html( travel_agency_pro_related_trip_title() ); ?></h2>    				
    			</header>
    			<?php } ?>
                
                <?php if( $qry->have_posts() ){ ?>
                <div class="grid">
    				<?php 
                    while( $qry->have_posts() ){
    				    $qry->the_post();
                        $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); ?>
                        <div class="col">
            				<div class="img-holder">
            					<a href="<?php the_permalink(); ?>">
                                <?php 
                                    if( has_post_thumbnail() ){
                                        the_post_thumbnail( 'travel-agency-blog' );
                                    }else{ ?>
                                        <img src="<?php echo esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-410-250.jpg' ); ?>" alt="<?php the_title_attribute(); ?>" />        
                                    <?php }
                                ?>                        
                                </a>
            					<?php 
                                    if( ( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] ) || ( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) ){
                                        echo '<span class="price-holder"><span>';
                                        if( isset( $meta['trip_prev_price'] ) ){
                                            if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo '<strike>';
                                            if( isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] )echo esc_html( $currency . $meta['trip_prev_price'] );
                                            if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo '</strike> ';    
                                        } 
                                        if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ) echo esc_html( $currency . $meta['trip_price'] );
                                        echo '</span></span>';
                                    
                                        if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_prev_price'] ) && $meta['trip_prev_price'] && isset( $meta['trip_price'] ) && $meta['trip_price'] ){
                                            $diff = (int)( $meta['trip_prev_price'] - $meta['trip_price'] );
                                            $perc = (float)( ( $diff / $meta['trip_prev_price'] ) * 100 );                                    
                                            printf( __( '<span class="discount-holder"><span>%1$s&percnt; Off</span></span>', 'travel-agency-pro' ), round( $perc ) );
                                        }
                                    }
                                ?>
            				</div>
            				<div class="text-holder">
            					<h3 class="title"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
            					<div class="meta-info">
            						<?php 
                                        if( isset( $meta['trip_duration'] ) || isset( $meta['trip_duration_nights'] ) ){ 
                                            echo '<span class="time"><i class="fa fa-clock-o"></i>'; 
                                            if( $meta['trip_duration'] ) printf( esc_html__( '%s Days', 'travel-agency-pro' ), absint( $meta['trip_duration'] ) ); 
                                            if( $meta['trip_duration_nights'] ) printf( esc_html__( ' - %s Nights', 'travel-agency-pro' ), absint( $meta['trip_duration_nights'] ) ); ;
                                            echo '</span>';                                       
                                        }
                                    ?>
            					</div>
                                <?php if( $label ){ ?>
                                    <div class="btn-holder">
                						<a href="<?php the_permalink(); ?>" class="btn-more"><?php echo esc_html( travel_agency_pro_related_trip_readmore() ); ?></a>
                					</div>
                                <?php } ?>
            				</div>
            			</div>
                        <?php
                    }
                    wp_reset_postdata();
                    ?>
    			</div>
                <?php } ?>    			
    		</div>
    	</section>    
        <?php
        }
    }
}
endif;
add_action( 'travel_agency_pro_before_footer', 'travel_agency_pro_related_trips', 25 );*/

if( ! function_exists( 'travel_agency_pro_footer_start' ) ) :
/**
 * Footer Start
*/
function travel_agency_pro_footer_start(){
    ?>
    <footer id="colophon" class="site-footer">
        <div class="container">
    <?php
}
endif;
add_action( 'travel_agency_pro_footer', 'travel_agency_pro_footer_start', 20 );

if( ! function_exists( 'travel_agency_pro_footer_top' ) ) :
/**
 * Footer Top
*/
function travel_agency_pro_footer_top(){    
    if( is_active_sidebar( 'footer-one' ) || is_active_sidebar( 'footer-two' ) || is_active_sidebar( 'footer-three' ) || is_active_sidebar( 'footer-four' ) ){
    ?>
    <div class="footer-t">
		<div class="row">
			<?php if( is_active_sidebar( 'footer-one' ) ){ ?>
				<div class="column">
				   <?php dynamic_sidebar( 'footer-one' ); ?>	
				</div>
            <?php } ?>
			
            <?php if( is_active_sidebar( 'footer-two' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-two' ); ?>	
				</div>
            <?php } ?>
            
            <?php if( is_active_sidebar( 'footer-three' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-three' ); ?>	
				</div>
            <?php } ?>
            
            <?php if( is_active_sidebar( 'footer-four' ) ){ ?>
                <div class="column">
				   <?php dynamic_sidebar( 'footer-four' ); ?>	
				</div>
            <?php } ?>
		</div>
	</div>
    <?php 
    }   
}
endif;
add_action( 'travel_agency_pro_footer', 'travel_agency_pro_footer_top', 30 );

if( ! function_exists( 'travel_agency_pro_footer_bottom' ) ) :
/**
 * Footer Bottom
*/
function travel_agency_pro_footer_bottom(){ ?>
    <div class="footer-b">
		<div class="site-info">
			<?php
                travel_agency_pro_get_footer_copyright();
                travel_agency_pro_ed_author_link();
                travel_agency_pro_ed_wp_link(); 
            ?>                              
		</div>
        
        <nav class="footer-navigation">
			<?php
				wp_nav_menu( array(
					'theme_location' => 'footer',
					'menu_id'        => 'footer-menu',
                    'fallback_cb'    => false,
				) );
			?>
		</nav><!-- .footer-navigation -->
	</div>
    <?php
}
endif;
add_action( 'travel_agency_pro_footer', 'travel_agency_pro_footer_bottom', 40 );

if( ! function_exists( 'travel_agency_pro_footer_end' ) ) :
/**
 * Footer End 
*/
function travel_agency_pro_footer_end(){
    ?>
        </div><!-- .container -->
    </footer><!-- #colophon -->
    <?php
}
endif;
add_action( 'travel_agency_pro_footer', 'travel_agency_pro_footer_end', 50 );

if( ! function_exists( 'travel_agency_pro_back_to_top' ) ) :
/**
 * Back to Top
*/
function travel_agency_pro_back_to_top(){
    ?>
    <div id="rara-top"><i class="fa fa-angle-up"></i></div>
    <?php
}
endif;
add_action( 'travel_agency_pro_after_footer', 'travel_agency_pro_back_to_top', 15 );

if( ! function_exists( 'travel_agency_pro_page_end' ) ) :
/**
 * Page End
*/
function travel_agency_pro_page_end(){
    ?>
    </div><!-- #page -->
    <?php
}
endif;
add_action( 'travel_agency_pro_after_footer', 'travel_agency_pro_page_end', 20 );