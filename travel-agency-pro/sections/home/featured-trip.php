<?php
/**
 * Featured Trip Section
 * 
 * @package Travel_Agency
 */

$defaults    = new Travel_Agency_Companion_Dummy_Array;
$obj         = new Travel_Agency_Companion_Functions;
$ed_demo     = get_theme_mod( 'ed_featured_demo', true );
$title       = get_theme_mod( 'feature_title', __( 'Featured Trip', 'travel-agency-companion' ) );
$content     = get_theme_mod( 'feature_desc', __( 'This is the best place to show your other travel packages. You can modify this section from Appearance > Customize > Home Page Settings > Featured Section.', 'travel-agency-companion' ) );
$trip_type   = get_theme_mod( 'trip_type', 'select_cat' ); 
$trip_cat    = get_theme_mod( 'featured_cat' );
$no_of_trip  = (int) get_theme_mod( 'no_of_trips', '6' );
$view_detail = get_theme_mod( 'featured_readmore', __( 'View Detail', 'travel-agency-companion' ) );
$view_all    = get_theme_mod( 'featured_view_all', __( 'View All Trip', 'travel-agency-companion' ) );
$view_all_link    = get_theme_mod( 'featured_view_all_link', '#' );
for( $i=1; $i<= $no_of_trip; $i++ ){
    $trip_posts[]  = get_theme_mod( 'choose_trip_'.$i );
}

if( $trip_type == 'select_cat' ) {
    $args = array( 
        'post_type'       => 'trip',
        'trip_types'      => $trip_cat,
        'post_status'     => 'publish',
        'posts_per_page'  => $no_of_trip  
    );
    $qry = new WP_Query( $args );
}else{
    $args = array( 
        'post_type'       => 'trip',
        'post__in'        => $trip_posts,
        'post_status'     => 'publish',
        'posts_per_page'  => count( $trip_posts ) 
    );
    $qry = new WP_Query( $args );
}


if( $title || $content || ( travel_agency_is_wpte_activated() && $qry->have_posts() ) ){ ?>
<div class="container">
                    <div class="section-heading">
                    <?php 
                if( $title ) echo '<h1>' . esc_html( travel_agency_companion_get_featured_title() ) . '</h1>';
                if( $content ) echo '<span>' . wp_kses_post( travel_agency_companion_get_featured_content() ) . '</span>'; 
            ?>
                    </div>
                    <div class="row">
                    <?php 
        if( travel_agency_is_wpte_activated() && $qry->have_posts() ){ 
            $currency = $obj->get_trip_currency();
            $new_obj  = new Wp_Travel_Engine_Functions(); ?>
            <?php 
                    while( $qry->have_posts() ){ 
                        $qry->the_post(); 
                        $custom = get_post_custom($post->ID);
                        $trip_rating = $custom["trip_rating"][0];
                        $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large', false);
                        $image_url = $thumb_url_array[0];
                        $image_size = array('width' =>540 , 'height' => 400);
                        $alt= gia(get_post_thumbnail_id(get_the_ID()));
                        $meta = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
                        ?> 
                        <div class="col-xs-12 col-sm-3 col-md-3 package-single">
                            <div class="pckg-single">
                             <?php if($image_url) : ?>
                                <div class="pckg-thumb">
                                    <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" />
                                    <?php
                                    $meta     = get_post_meta( get_the_ID(), 'wp_travel_engine_setting', true ); 
                                    $currency = travel_agency_pro_get_trip_currency();
                                    ?>
                                    <?php
                                    if( isset( $meta['sale'] ) && $meta['sale'] && isset( $meta['trip_price'] ) && ! empty( $meta['trip_price'] ) ){
                                    $price = $meta['trip_price'];
                                    }elseif( isset( $meta['trip_prev_price'] ) && ! empty( $meta['trip_prev_price'] )){
                                    $price = $meta['trip_prev_price'];
                                    }else{
                                    $price = false;
                                    }
                                    if( $price ) echo '<span class="price-holder"><span>' . esc_html( $currency . $price ) . '</span></span>';
                                    ?>
                                </div>
                            <?php endif; ?>
                                <div class="pckg-content">
                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                       <?php 
                                        if( isset( $meta['trip_facts']['5']['5']) ){ 
                                            echo ' <div class="pckg-duration">'; 
                                            echo $meta['trip_facts']['5']['5']; 
                                            echo '</div>';                                       
                                        } 
                                    ?>              
                                    <p><?php echo wp_trim_words( get_the_content(), 12, '...' ); ?></p>
                                    
                                </div>
                                <div class="pckg-rt-vm">
                                        <div class="read_more">
                                        <?php show_star_rating($trip_rating,$post->ID); ?>
                                        <a href="<?php the_permalink(); ?>" class="read_more_button">View More
                                            <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                    </div>
                            </div>
                        </div>
                        <?php } 
                         wp_reset_postdata();
                        ?>
                    <?php } elseif( $ed_demo ){
            //Default
            $featured = $defaults->default_trip_featured_posts();?>
                <?php foreach( $featured as $v ){ ?>
                <div class="col-xs-12 col-sm-3 col-md-3 home-package-single">
                            <div class="pckg-single">
                                <div class="pckg-thumb">
                                    <img src="<?php echo esc_url( $v['img'] ); ?>" alt="<?php echo esc_attr( $v['title'] ); ?>" class="img-responsive"  />
                                </div>
                                <div class="pckg-content">
                                    <h3><a href="#"><?php echo esc_html( $v['title'] ); ?></a></h3>
                                       <?php echo esc_html( $v['days'] ); ?>
                                    <p>Annapurna region is mostly visited trekking area in Nepal . The diverse terrain and variety of cultures of the region north of Pokhara make each day's walk...</p>
                                </div>
                                <div class="pckg-rt-vm">
                                        <div class="read_more">
                                        <div class="item_rating">
                                            <i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i><i class="fa fa-star"></i>
                                        </div>
                                        <a href="#" class="read_more_button">View More
                                            <i class="fa fa-long-arrow-right"></i></a>
                                    </div>
                                    </div>
                            </div>
                        </div>

                <?php } ?>
            <?php
        } 
                    ?>
                    </div>
                </div>

<?php 
}