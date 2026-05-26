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
$no_of_testimonials = get_theme_mod( 'no_of_testimonial' );
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
<div class="col-xs-12 col-sm-12 col-md-4">
                            <?php if( $title || $content ){ ?>
                            <div class="section-heading">
                                <?php if($title) { ?>
                                <h1><?php echo esc_html( travel_agency_pro_get_testimonial_title() ); ?></h1>
                                <?php } ?>
                                 <?php if($content) { ?>
                                <span><?php echo travel_agency_pro_get_testimonial_sub_title(); ?></span>
                                <?php } ?>
                            </div>
                            <?php } ?>
                            <div class="section-review-slider">
                            <?php  if( $qry->have_posts() ){ ?>
                                <div id="review-carousel" class="owl-carousel">
                                    <?php 
                                    while( $qry->have_posts() ){ 
                                    $qry->the_post();
                                    $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false);
                                    $image_url = $thumb_url_array[0];
                                    $image_size = array('width' =>150 , 'height' => 150);
                                    $alt= gia(get_post_thumbnail_id(get_the_ID()));
                                    $visited_trip = get_post_meta( get_the_ID(), '_tap_testimonail_visited_trip', true );
                                    $trip_date    = get_post_meta( get_the_ID(), '_tap_testimonail_trip_date', true );
                                    $trip_rating  = get_post_meta( get_the_ID(), '_tap_testimonail_trip_rating', true );
                                    ?>
                                    <div class="item">
                                    <?php if($image_url) : ?>
                                    <div class="rev-thumb">
                                    <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-circle">
                                    </div>
                                    <?php else: 
                                     echo '<div class="rev-thumb"><img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-150-150.jpg' ) . '" class="img-circle" alt="' . esc_attr( get_the_title() ) . '"></div>';
                                     endif; ?>
                                      <div class="rev-content">
                                        <div class="auth-name"><?php the_title(); ?></div>
                                        <?php if( $trip_rating ){ 
                                            echo '<div class="ratting">';
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
                                        <p><?php echo wp_trim_words( get_the_content(), 50, '...' ); ?></p>
                                      </div>
                                    </div>
                                    <?php } ?>
                              </div>
                              <?php } ?>
                              <div class="more-rev-box">
                                <span>
                                    <a href="https://www.tripadvisor.com/Attraction_Review-g293890-d12572646-Reviews-Nepal_Alsace_Treks_Expedition-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Re.html" target="_blank">
                                    Read More Reviews On
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/tripadvisor-icon.png" class="img-responsive" alt="Trip Advisor">
                                    </a>
                                </span>
                              </div>
                            </div>
                        </div>
<?php
}