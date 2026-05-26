<?php
/**
 * Testimonial Section
 * 
 * @package Travel_Agency_Pro
 */

$title              = get_theme_mod( 'testimonial_section_title', __( 'Testimonials', 'travel-agency-pro' ) );
$content            = get_theme_mod( 'testimonial_section_subtitle', __( 'Show your testimonial here. You can modify this section from Appearance > Customize > Home Page Settings > Testimonial Section.', 'travel-agency-pro' ) );
$post_order         = get_theme_mod( 'testimonial_post_order', 'date' );
$ed_demo            = get_theme_mod( 'ed_testimonial_demo', true );
$no_of_testimonials = 3;
$demos              = travel_agency_pro_get_customizer_defaults( 'testimonial' );
$args = array(
    'post_type'      => 'tap_testimonial',
    'post_status'    => 'publish',
    'posts_per_page' => $no_of_testimonials,
);

if( $post_order == 'menu_order' ){
    $args['order']   = 'ASC';
    $args['orderby'] = 'menu_order';
}

$qry = new WP_Query( $args );

if( $title || $content || $qry->have_posts() ){ ?>
 <div class="col-xs-12 col-sm-4 col-md-4" id="testimonial_section">
                        <div class="why-us">
                        <?php if( $title || $content ) { ?>
                            <h2><i class="fa fa-comments" aria-hidden="true"></i> <?php echo esc_html( travel_agency_pro_get_testimonial_title() ); ?></h2>
                            <?php } ?>
                            <div class="wh-body">
                                <?php if( $qry->have_posts() ){ ?>
                                <?php 
                                while( $qry->have_posts() ){ 
                                $qry->the_post();
                                $visited_trip = get_post_meta( get_the_ID(), '_tap_testimonail_visited_trip', true );
                                $trip_date    = get_post_meta( get_the_ID(), '_tap_testimonail_trip_date', true );
                                $trip_rating  = get_post_meta( get_the_ID(), '_tap_testimonail_trip_rating', true );
                                $name  = get_post_meta( get_the_ID(), 'txt_review_name', true );
                                ?>
                                <div class="hm-review">
                                    <div class="review-title">
                                        <?php the_title(); ?>
                                        </div>
                                        <p><?php echo wp_trim_words( get_the_content(), 12, '...' ); ?></p>
                                    <div class="review-header">
                                        <?php echo !empty($name) ? $name : ''; ?>
                                        <?php if( $trip_rating ){ 
                                            echo '<div class="review-rating">';
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
                                    </div>
                                </div>
                                <?php } ?>
                                <?php } ?>
                                Write a review : <a href="http://www.routard.com/forum_message/2178642/agence_nepal_alsace_trek_expedition.htm" target="_blank" class="review-link">http://www.routard.com/</a>
                            </div>
                        </div>
                    </div>
<?php
}