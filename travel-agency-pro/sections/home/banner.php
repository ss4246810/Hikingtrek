<?php
/**
 * Banner Section
 * 
 * @package Travel_Agency_Pro
 */

$ed_banner         = get_theme_mod( 'ed_banner_section', 'static_banner' );
$title             = get_theme_mod( 'banner_title', __( 'Find Your Best Holiday', 'travel-agency-pro' ) );
$sub_title         = get_theme_mod( 'banner_subtitle', __( 'Find great adventure holidays and activities around the planet.', 'travel-agency-pro' ) );
$ed_search         = get_theme_mod( 'ed_banner_search', true );
$slider_caption    = get_theme_mod( 'slider_caption', true );
$slider_type       = get_theme_mod( 'slider_type', 'post' ); 
$slider_post_one   = get_theme_mod( 'slider_post_one' );
$slider_post_two   = get_theme_mod( 'slider_post_two' );
$slider_post_three = get_theme_mod( 'slider_post_three' );
$slider_post_four  = get_theme_mod( 'slider_post_four' );
$slider_post_five  = get_theme_mod( 'slider_post_five' );
$slider_cat        = get_theme_mod( 'slider_cat' );
$slider_slides     = get_theme_mod( 'slider_custom' );
$slider_readmore   = get_theme_mod( 'slider_readmore', __( 'Read More', 'travel-agency-pro' ) );
$slider_full_img   = get_theme_mod( 'slider_full_image' );
$slider_posts      = array( $slider_post_one, $slider_post_two, $slider_post_three, $slider_post_four, $slider_post_five );
$slider_posts      = array_diff( array_unique( $slider_posts ), array('') );

if( $slider_full_img ){
    $img_size = 'full';
}else{
    $img_size = 'travel-agency-slider';
}

if( $ed_banner == 'static_banner' && has_custom_header() ){ ?>  
<div class="banner<?php if( has_header_video() ) echo ' video-banner'; ?>" id="banner_section">
	<?php 
        the_custom_header_markup(); 
        
        if( $ed_search || $title || $sub_title ){ ?>	
        <div class="form-holder">
    		<?php 
                if( $title || $sub_title ){
                    echo '<div class="text wow fadeInUp" data-wow-duration="1s" data-wow-delay="0.1s">';
                    if( $title ) echo '<h1>' . esc_html( travel_agency_pro_get_banner_title() ) . '</h1>';
                    if( $sub_title ) echo '<div class="banner-content">' . wp_kses_post( travel_agency_pro_get_banner_sub_title() ) . '</div>';
            		echo '</div>';
                }
                
                if( $ed_search ){
                    echo '<div class="banner-form">';
                    travel_agency_pro_get_banner_search(); 
                    echo '</div>';
                }                
            ?>
    	</div>            
        <?php 
        }
    ?>
</div> <!-- banner ends -->
<?php
}elseif( $ed_banner == 'slider_banner' ){
    if( $slider_type == 'post' || $slider_type == 'cat' ){            
        $args = array(
            'post_status'         => 'publish',
            'posts_per_page'      => -1,       
            'orderby'             => 'post__in',
            'ignore_sticky_posts' => true
        );
        
        if( $slider_type == 'post' ){
            $args['post_type'] = array( 'post', 'page' );
            $args['post__in']  = $slider_posts;
            $args['orderby']   = 'post__in';
        }elseif( $slider_type == 'cat' ){
            $args['post_type'] = 'post';
            $args['cat']       = $slider_cat;
        }
        
        $qry = new WP_Query( $args );
        
        if( ( ( $slider_posts && $slider_type == 'post' ) || ( $slider_cat && $slider_type == 'cat' ) ) && $qry->have_posts() ){ ?>
            <section id="banner_section" class="banner bslider">
                <div id="banner-carousel" class="banner-slider owl-carousel">
                <?php    
                while( $qry->have_posts() ){
                    $qry->the_post();
                    if( has_post_thumbnail() ){ 
                    $image = wp_get_attachment_image_url( get_post_thumbnail_id(), $img_size );     
                    ?>
                    <div>
        				<img class="owl-lazy" data-src="<?php echo esc_url( $image )?>" alt="<?php the_title_attribute(); ?>" />
                        <?php if( $slider_caption && ( get_the_title() || get_the_content() || $slider_readmore ) ){ ?>
        				<div class="banner-text">
                            <?php 
                                the_title( '<strong class="title">', '</strong>' );
                                if( $slider_readmore ) echo '<a href="' . esc_url( get_the_permalink() ) . '" class="btn">' . esc_html( $slider_readmore ) .'</a>';
                            ?>
        				</div>
                        <?php } ?>
        			</div>
                    <?php
                    }
                }
                ?>
                </div>
        	</section>
            <?php
        }
        
    }elseif( $slider_type == 'custom' && $slider_slides ){ ?>
    <section class="main-slider">
            <div class="royalSlider rsDefault">
            <?php 
                foreach( $slider_slides as $slide ){
                    if( $slide['thumbnail'] ){
                    $images = wp_get_attachment_image_url( $slide['thumbnail'], $img_size );
                    $alt=gia($slide['thumbnail']);
                    ?>
            <div class="rsContent" style="background-image: url('<?php echo esc_url( $images ); ?>');">
                <div class="rs-overlay"></div>
                <?php if( $slider_caption && ( $slide['title'] || ( $slide['link'] && $slider_readmore ) ) ){ ?>
                <div class="caption-overlay">
                    <?php if( $slide['title'] ) { ?><div class="bns-one"><?php echo esc_html( $slide['title'] ); ?></div><?php } ?>
                     <?php if( $alt['caption'] ) { ?>
                    <div class="bns-two"><?php echo esc_attr( $alt['caption'] ); ?></div>
                    <?php } ?>
                <?php if( $slide['link'] && $slider_readmore ) { ?> <a href="<?php echo esc_url( $slide['link'] ); ?>" class="pink-color-btn"><?php echo esc_html( $slider_readmore ); ?></a><?php } ?>
                </div>
                <?php } ?>
            </div>
            <?php 
                    }
                }
                ?>
            </div>
            <?php include_once( 'search.php' ); ?>
            
        </section>
        
    <?php
    }  
}            