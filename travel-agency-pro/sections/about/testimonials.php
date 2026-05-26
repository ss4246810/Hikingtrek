<?php
/**
 * About Testimonial Section
 * 
 * @package Travel_Agency_Pro
 */

$title      = get_theme_mod( 'about_testimonial_section_title', __( 'Testimonials', 'travel-agency-pro' ) );
$content    = get_theme_mod( 'about_testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > About Page Settings > Testimonial Section.', 'travel-agency-pro' ) );
$post_order = get_theme_mod( 'about_testimonial_post_order', 'date' );

$args = array(
    'post_type'      => 'tap_testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => -1
);

if( $post_order == 'menu_order' ){
    $args['order']   = 'ASC';
    $args['orderby'] = 'menu_order';
}

$qry = new WP_Query( $args );

if( $title || $content || $qry->have_posts() ){ ?>
<section id="about_testimonial" class="testimoinal">
	<?php 
        if( $title || $content ){             
            echo '<div class="container"><header class="section-header">';
            if( $title ) echo '<h2 class="section-title">' . esc_html( travel_agency_pro_about_testimonial_title() ) . '</h2>';
            if( $content ) echo '<div class="section-content">' . wp_kses_post( travel_agency_pro_about_testimonial_sub_title() ) . '</div>';
            echo '</header></div>';                
        } 
    
        if( $qry->have_posts() ){ ?>    
            <div class="testimonial-holder">
        		<div id="testimonial-carousel" class="owl-carousel">
        			<?php 
                        while( $qry->have_posts() ){ 
                            $qry->the_post();
                            $visited_trip = get_post_meta( get_the_ID(), '_tap_testimonail_visited_trip', true );
                            $trip_date    = get_post_meta( get_the_ID(), '_tap_testimonail_trip_date', true );
                            $trip_rating  = get_post_meta( get_the_ID(), '_tap_testimonail_trip_rating', true );
                            ?>
                            <div class="item">                				
                                <div class="holder">
                					<div class="img-holder">
                                    <?php 
                                        if( has_post_thumbnail() ){
                                            the_post_thumbnail( 'full' );                					   
                                        }else{
   					                        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-150-150.jpg' ) . '" alt="' . esc_attr( get_the_title() ) . '">';
   					                    }
                                    ?>
                                    </div>
                					
                                    <?php 
                                        if( $visited_trip ) echo '<h3 class="title">' . esc_html( $visited_trip ) . '</h3>';
                                        if( $trip_date ) printf( esc_html__( '%1$sVisited %2$s%3$s', 'travel-agency-pro' ), '<span class="visited-on">', esc_html( $trip_date ), '</span>' );
                                        if( $trip_rating ){ 
                                            echo '<div class="star-holder">';
                                            echo '<span id="rating-' . get_the_ID() . '"></span>';
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
                				</div><!-- .holder -->
                				<?php the_title( '<span class="name">', '</span>' ); ?>
                			</div>			
                            <?php 
                        }
                        wp_reset_postdata(); 
                    ?>
        		</div>
        	</div>
        <?php   
        }
    ?>
</section>
<?php
}