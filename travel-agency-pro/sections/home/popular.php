<?php
/**
 * Popular Destination Section
 * 
 * @package Travel_Agency
 */

$defaults   = new Travel_Agency_Companion_Dummy_Array;
$obj        = new Travel_Agency_Companion_Functions;
$ed_demo    = get_theme_mod( 'ed_popular_demo', true );
$title      = get_theme_mod( 'popular_title', __( 'Our Best Sellers Packages', 'travel-agency-companion' ) );
$content    = get_theme_mod( 'popular_desc', __( 'This is the best place to show your most sold and popular travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Best Sellers Packages.', 'travel-agency-companion' ) );
$trip_cat   = get_theme_mod( 'popular_cat' );
$trip_one   = get_theme_mod( 'popular_post_one' );
$trip_two   = get_theme_mod( 'popular_post_two' );
$trip_three = get_theme_mod( 'popular_post_three' );
$trip_four  = get_theme_mod( 'popular_post_four' );
$view_all   = get_theme_mod( 'popular_view_all_label', __( 'View All Packages', 'travel-agency-companion' ) );
$view_url   = get_theme_mod( 'popular_view_all_url', '#' );

$trips = array( $trip_one, $trip_two, $trip_three, $trip_four );
$trips = array_diff( array_unique( $trips ), array('') );

if( $title || $content || ( travel_agency_is_wpte_activated() && $trip_cat && $trips ) ){ ?>

 <div class="recommended-trips">
        <div class="container">
        <?php if( $title || $content ){ ?>
                <div class="section-heading">
                <?php 
                if( $title ) echo '<h1>' . esc_html( travel_agency_companion_get_popular_title() ) . '</h1>';
                if( $content ) echo '<span>' . wp_kses_post( travel_agency_companion_get_popular_content() ) . '</span>'; 
                ?>
                </div>
        <?php } ?>
        
        <?php 
            if( travel_agency_is_wpte_activated() || $trip_cat || $trips ){                 
                
                $currency = $obj->get_trip_currency();
                $new_obj  = new Wp_Travel_Engine_Functions();
                            
                $args = array( 
                    'post_type'       => 'trip',
                    'trip_types'      => $trip_cat,
                    'post_status'     => 'publish',
                    'posts_per_page'  => 6 
                );
                $qry = new WP_Query( $args );
                $slider_qry = new WP_Query( $args );
                ?>
                   <?php if( $slider_qry->have_posts() ){ ?>
                    <div class="row">
                    <?php while( $slider_qry->have_posts() ){
                            $slider_qry->the_post(); 
                            $custom = get_post_custom($post->ID);
                            $trip_rating = $custom["trip_rating"][0];
                            $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large', false);
                            $image_url = $thumb_url_array[0];
                            $image_size = array('width' =>400 , 'height' => 400);
                            $alt= gia(get_post_thumbnail_id(get_the_ID()));
                            $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
                            ?>       
                                <div class="col-xs-12 col-sm-6 col-md-6">
                                    <div class="rcm-item">
                                     <?php if($image_url) : ?>
                                        <!-- rcm Image -->
                                        <div class="rcm-image">
                                            <a href="<?php the_permalink(); ?>">
                                                <div class="img"><img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-responsive"></div>
                                            </a>
                                        </div>
                                    <?php endif; ?>
                                        <!-- rcm body -->
                                        <div class="rcm-body">
                                            <!-- title -->
                                            <h3><?php the_title(); ?></h3>
                                            <?php //show_star_rating($trip_rating,$post->ID); ?>
                                           <?php 
                                                if( isset( $meta['trip_facts']['5']['5']) && $meta['trip_facts']['5']['5']!="" ){ 
                                                    echo ' <div class="pckg-duration">'; 
                                                    echo $meta['trip_facts']['5']['5']; 
                                                    echo '</div>';                                       
                                                } 
                                            ?>       
                                            <!-- Text Intro -->
                                            <p><?php echo wp_trim_words( get_the_content(), 24, '...' ); ?></p>
                                            <a href="<?php the_permalink(); ?>" class="btn-more">Read More</a>
                                        </div>
                                    </div>
                                </div>
                        <?php 
                        }
                        wp_reset_postdata();
                    ?>
                    </div>
                    <?php } ?>
            <?php 
        }elseif( $ed_demo ){
            //Default 
            $populars = $defaults->default_trip_popular_posts( false ); ?>
            <?php foreach( $populars as $v ){ ?>
             <div class="col-xs-12 col-sm-6 col-md-6">
                            <div class="rcm-item">
                             <?php if($image_url) : ?>
                                <!-- rcm Image -->
                                <div class="rcm-image">
                                    <a href="#">
                                        <div class="img"><img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ); ?>" class="img-responsive"></div>
                                    </a>
                                </div>
                            <?php endif; ?>
                                <!-- rcm body -->
                                <div class="rcm-body">
                                    <div class="ratting">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star-half-o"></i>
                                        <i class="fa fa-star-o"></i>
                                    </div>
                                    <!-- title -->
                                    <h3><?php echo esc_attr( $v['title'] ); ?></h3>
                                   <?php echo esc_html( $v['days'] ); ?>
                                    <!-- Text Intro -->
                                    <p>Etiam maximus molestie accumsan. Sed metus sapien, fermentum nec lorem ac.</p>
                                    <a href="#" class="btn-more">Read More</a>
                                </div>
                            </div>
                        </div>
				<?php } ?>
            <?php
        } 

        ?>
	</div><!-- .container-large -->    
</div>
<?php
}