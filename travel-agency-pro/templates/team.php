<?php
/**
 * Template Name: Testimonial Page
 * 
 * @package Travel_Agency_Pro
 */

get_header(); 
 global $wp_query;
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1; // for pagination
$args = array(
    'post_type'      => 'tap_team',
    'post_status'    => 'publish',
    'paged' => $paged,
    'posts_per_page' => get_option('posts_per_page')
    

);
if( $post_order == 'menu_order' ){
    $args['order']   = 'ASC';
    $args['orderby'] = 'menu_order';
}
query_posts($args);
$qry = new WP_Query( $args );
?>

	<?php /* ?><div id="primary" class="content-area">
		<main id="main" class="site-main">
			<?php            
                while ( have_posts() ) : the_post();    
    				get_template_part( 'template-parts/content', 'page' );    
    			endwhile; // End of the loop.
			?>
		</main>
	</div>
	<?php */ ?>

<div class="body-contentContainer">
<div class="container main-content" data-sticky-sidebar-container>
	<div class="bg-white">
    	<div class="row">
            <div class="col-xs-12 col-sm-8 col-md-8">
            <?php if( $qry->have_posts() ){ ?>
                    <?php 
                    while( $qry->have_posts() ){ 
                    $qry->the_post();
                    $name  = get_the_title(get_the_ID());
                    $permalink  = get_permalink(get_the_ID());
                    $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'thumbnail', false);
                    $image_url = $thumb_url_array[0];
                    $image_size = array('width' =>150 , 'height' => 150);
                    $alt= gia(get_post_thumbnail_id(get_the_ID()));
                    ?>
                	<div class="home-package-single testimonail-single">
                	   <div class="tmnl-cell tmnl-thumb">
                        <?php if($image_url) : ?>
                        <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" class="img-responsive">

                        <?php else: 
                        echo '<img src="' . esc_url( get_template_directory_uri() . '/images/fallback/fallback-img-150-150.jpg' ) . '" class="img-responsive" alt="' . esc_attr( get_the_title() ) . '">';
                        endif; ?>
                        <div class="tmnl-header">
                        	<?php echo !empty($name) ? '<div class="tmnl-author"><a href="'.$permalink.'">'.$name.'</a></div>' : ''; ?>
                        </div>
                    </div>
                    <div class="tmnl-cell">
                    	<div class="tmnl-content">
                        <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php } ?>
                <?php } ?>
                <?php 
                if (function_exists("pagination")) {
                echo  "<ul class=\"pagination\">";
                pagination($args->max_num_pages);
                echo "</ul>
                ";
                } 
                wp_reset_query();
                ?>
        </div>
        
         <div class="col-xs-12 col-sm-4 col-md-4">
                  <?php get_sidebar(); ?>              
            </div>
    </div>
</div>
</div>
</div>
</div>
<?php
get_footer();