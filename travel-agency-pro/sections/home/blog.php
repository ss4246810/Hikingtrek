<?php
/**
 * Blog Section
 * 
 * @package Travel_Agency_Pro
 */

$title     = get_theme_mod( 'blog_section_title', __( 'Latest Articles', 'travel-agency-pro' ) );
$sub_title = get_theme_mod( 'blog_section_subtitle', __( 'Show your latest blog posts here. You can modify this section from Appearance > Customize > Home Page Settings > Blog Section.', 'travel-agency-pro' ) );
$readmore  = get_theme_mod( 'blog_readmore', __( 'Read More', 'travel-agency-pro' ) );
$blog      = get_option( 'page_for_posts' );
$label     = get_theme_mod( 'blog_view_all', __( 'View All Posts', 'travel-agency-pro' ) );
    
$args = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 1
);

$qry = new WP_Query( $args );
$args1 = array(
    'post_type'      => 'post',
    'post_status'    => 'publish',
    'posts_per_page' => 3,
    'offset' =>1
);

$qry1 = new WP_Query( $args1 );

 ?>
 <div class="col-xs-12 col-sm-12 col-md-8">
                            <div class="section-blog">
                                <?php if( $title || $sub_title ){ ?>
                                <div class="section-heading">   
                                <?php 
                                if( $title ) echo '<h1>' . esc_html( travel_agency_pro_get_blog_section_title() ) . '</h1>';
                                if( $sub_title ) echo '<span>' . wp_kses_post( travel_agency_pro_get_blog_section_sub_title() ) . '</span>'; 
                                ?>
                                </div>
                                <?php } ?>
        
                              
                                <div class="blog-wrapper clearfix">
                                <div class="row">  
                                        <?php if( $qry->have_posts() ){ ?>
                                        <div class="col-xs-12 col-sm-5 col-md-5">
                                            <?php 
                                            while( $qry->have_posts() ){
                                            $qry->the_post(); 
                                            $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium', false);
                                            $image_url = $thumb_url_array[0];
                                            $image_size = array('width' =>283 , 'height' => 188);
                                            $alt= gia(get_post_thumbnail_id(get_the_ID()));
                                            ?>
                                            <div class="blog-singleLarge">
                                                <?php if($image_url) : ?>
                                                <div class="blog-thumb">
                                                <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-responsive">
                                                </div>
                                                <?php else: 
                                                echo '<div class="blog-thumb"><img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-150-150.jpg' ) . '" class="img-responsive" alt="' . esc_attr( get_the_title() ) . '"></div>';
                                                endif; ?>
                                               
                                                <div class="blog-content">
                                                    <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                    <div class="pckg-duration">
                                                        <?php echo get_the_date( 'F jS, Y', get_the_ID() ); ?>
                                                    </div>
                                                    <p><?php echo wp_trim_words( get_the_content(), 40, '...' ); ?></p>
                                                </div>
                                            </div>
                                            <?php } 
                                         wp_reset_postdata();
                                            ?>
                                        </div>
                                        <?php } ?>
                                         <?php if( $qry1->have_posts() ){ ?>
                                            <div class="col-xs-12 col-sm-7 col-md-7 pad-left-0">
                                                <?php 
                                                while( $qry1->have_posts() ){
                                                $qry1->the_post(); 
                                                $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'medium', false);
                                                $image_url = $thumb_url_array[0];
                                                $image_size = array('width' =>135 , 'height' => 135);
                                                $alt= gia(get_post_thumbnail_id(get_the_ID()));
                                                ?>
                                                <div class="rcm-item">
                                                    <!-- rcm Image -->
                                                    <div class="rcm-image">
                                                        <a href="<?php the_permalink(); ?>">
                                                        <?php if($image_url) : ?>
                                                    <div class="img">
                                                    <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-responsive">
                                                    </div>
                                                    <?php else: 
                                                    echo '<div class="img"><img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-150-150.jpg' ) . '" class="img-responsive" alt="' . esc_attr( get_the_title() ) . '"></div>';
                                                    endif; ?>
                                                           
                                                        </a>
                                                    </div>
                                                    <!-- rcm body -->
                                                    <div class="rcm-body">
                                                        <div class="pckg-duration">
                                                            <?php echo get_the_date( 'F jS, Y', get_the_ID() ); ?>
                                                        </div>
                                                       <h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
                                                        <!-- Text Intro -->
                                                        <p><?php echo wp_trim_words( get_the_content(), 15, '...' ); ?></p>
                                                    </div>
                                                </div>
                                                <?php } 
                                                 wp_reset_postdata();
                                                ?>
                                            </div>
                                            <?php } ?>

                                        </div>
                                        
                                </div>
                                </div>
                                
                            </div>
                        </div>

