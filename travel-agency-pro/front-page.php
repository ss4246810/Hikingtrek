<?php
/**
 * Front Page Template
 * 
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package Travel_Agency_Pro
 */

get_header(); 
?>
    <main class="contentSection">
    <?php include_once( 'sections/home/banner.php' ); ?>
    	
        <section class="content-container">
        	<div class="welcome-section">
            	<div class="container">
                <?php include_once( 'sections/home/search.php' ); ?>
                	<div class="col-xs-12 col-sm-6 col-md-4">
    	                <?php include_once( 'sections/home/about.php' ); ?>
                    </div>
                    <div class="col-xs-12 col-sm-6 col-md-4">
                    	 <?php include_once( 'sections/home/our-feature.php' ); ?>
                    </div>
                    <div class="desktop-only">
                    <?php include_once( 'sections/home/about-testimonials.php' ); ?>
                    </div>
                   
                </div>
            </div>
            <div class="nat-packageContainer">
            <?php include_once( 'sections/home/featured-trip.php' ); ?>
            </div>
            <div class="travellers-info">
            	<div class="container">
                    <div class="row">
                    	 <?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
                            <div id="secondary" class="widget-area" role="complementary">
                            <?php dynamic_sidebar( 'sidebar-2' ); ?>
                            </div>
                        <?php endif; ?>


                    </div>
                </div>
            </div>
            <?php include_once( 'sections/home/activities.php' ); ?>
            <?php include_once( 'sections/home/popular.php' ); ?>
            <div class="nat-packageContainer">
            	<div class="container">
                	<div class="row">
                        <?php include_once( 'sections/home/testimonials.php' ); ?>
                        <?php include_once( 'sections/home/blog.php' ); ?>
                    </div>	
                </div>
            </div>
        </section>
    </main>
<?php
get_footer();