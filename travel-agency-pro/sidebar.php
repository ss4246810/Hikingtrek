<?php
/**
 * The sidebar containing the main widget area
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Travel_Agency_Pro
 */

$sidebar = travel_agency_pro_sidebar( true );

if ( ! $sidebar ) {
	return;
}
global $post;
$singlecat=single_cat_title('',false);
$term_list = wp_get_post_terms($post->ID, 'destination', array("fields" => "all"));
if($term_list) {
    $term_id=$term_list[0]->term_id;
} else {
    $term = get_term_by('name', $singlecat, 'destination');
    $term_id =$term->term_id;
}
?>
<div class="sidebar" data-sticky-sidebar data-top-spacing="15">
<div class="sidebar">
                            <div class="sidebar__inner">
                            <?php if($term_id) { ?>
                                <div class="nepal-information">
                                    <div class="sidebar-head">
                                        <?php echo $singlecat; ?> Travelers Information
                                    </div>
                                        <ul>
                                        <?php 
                                        $args = array('post_type' => 'information','posts_per_page' =>20,'tax_query' => array( array( 'taxonomy'  => 'destination','field'     => 'id', 'terms' =>$term_id,'include_children' => false) ), 'orderby' => 'date', 'order' => 'DESC');
                                        $myposts = get_posts( $args );
                                        foreach( $myposts as $post ) : setup_postdata($post);
                                        ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endforeach; 
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                </div>
                                <?php } else { ?>
                                <div class="sidebar-info">
                                    <div class="nepal-information">
                                    <div class="sidebar-head">
                                        Travelers Information
                                    </div>
                                        <ul>
                                        <?php 
                                        $args = array('post_type' => 'information','posts_per_page' =>20,'tax_query' => array( array( 'taxonomy'  => 'destination','field'     => 'id', 'terms' =>'39','include_children' => false) ), 'orderby' => 'date', 'order' => 'DESC');
                                        $myposts = get_posts( $args );
                                        foreach( $myposts as $post ) : setup_postdata($post);
                                        ?>
                                        <li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
                                        <?php endforeach; 
                                        wp_reset_postdata();
                                        ?>
                                        </ul>
                                    </div>
                                </div>
                                <?php } ?>
                                <div class="help-box">
                                    <div class="tripAct-listWise">
                                    <a href="https://www.tripadvisor.com/Attraction_Review-g293890-d12572646-Reviews-Nepal_Alsace_Treks_Expedition-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Re.html">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/recommended-tripadvisor.png" alt="Nepal Alsace Treks & Expedition">
                                    <p>Nepal Alsace Treks & Expedition</p>
                                    </a>
                                    <div class="trp-foot">
                                    <a href="https://www.tripadvisor.com/Attraction_Review-g293890-d12572646-Reviews-Nepal_Alsace_Treks_Expedition-Kathmandu_Kathmandu_Valley_Bagmati_Zone_Central_Re.html">Find More Clients Feedback At Tripadvisor</a>
                                    </div>
                                    </div>
                                </div>
                                <div class="help-box">
                                    <div class="help-icon">
                                        <img src="<?php echo get_template_directory_uri(); ?>/assets/img/icons/help-icon.png" class="img-responsive" alt="Need Help?">
                                    </div>
                                    <div class="help-text">
                                        <strong>Need Help?</strong>
                                        <span class="phone-block">
                                            <?php echo travel_agency_pro_header_phone(); ?>
                                        </span>
                                        <span class="email-block">
                                            <a href="mailto:gurungdhanee@gmail.com">gurungdhanee@gmail.com</a>
                                            <?php //echo travel_agency_pro_header_email(); ?>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            </div>
                            </div>

