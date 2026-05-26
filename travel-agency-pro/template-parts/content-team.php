<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Agency_Pro
 */

$designation = get_post_meta( get_the_ID(), '_tap_team_position', true );
$sociallinks = get_post_meta( get_the_ID(), '_tap_team_social', true );
$galleries   = get_post_meta( get_the_ID(), '_tap_team_gallery_ids', true );
$gal_title   = get_post_meta( get_the_ID(), '_tap_team_gallery_title', true );
?>
 
            <div class="body-contentContainer">
                <div class="container main-content" data-sticky-sidebar-container>
                    <div class="bg-white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="pckg-body">
                                <div class="pckg-header">
                                    <h2><?php the_title(); ?></h2>
                                    <?php if( $sociallinks ){ ?>
                        			<ul class="social-networks">
                        				<?php 
                                            foreach( $sociallinks as $key => $link ){
                                                $add = ( $key == 'youtube' ) ? '-play' : '';
                                                if( $link ) echo '<li><a href="' . esc_url( $link ) . '" class="fa fa-' . esc_attr( $key.$add ) . '"></a></li>';               					   
                                            }
                                        ?>
                        			</ul>
                                    <?php } ?>
                                </div>
                                <div class="pckg-overview">
                                    <?php the_content(); ?>
                                    <?php if( $galleries ){ ?>
                            <div class="gallery">
                        		<?php if( $gal_title ) echo '<h2 class="title">' . esc_html( $gal_title ) . '</h2>';?>
                        		<div class="grid">
                        			<?php foreach( $galleries as $id ){ ?> 
                        			<div class="item">
                                        <a href="<?php echo esc_url( wp_get_attachment_image_url( $id, 'full' ) ); ?>" rel="team-gallery">
                                            <img src="<?php echo esc_url( wp_get_attachment_image_url( $id, 'travel-agency-team-gallery' ) ); ?>" />
                                        </a>
                                    </div>  
                        			<?php } ?>
                        		</div><!-- .grid -->
                        	</div><!-- .gallery -->    
                            <?php } ?>
                                </div>
                              
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 sidebarDesktop-only">
                        <?php get_sidebar(); ?>
                        </div>
                    </div>
                </div>
            </div>
