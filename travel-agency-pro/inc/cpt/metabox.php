<?php 
/**
* Metabox for Sidebar Layout
*
* @package Travel_Agency_Pro
*
*/ 

function travel_agency_pro_add_sidebar_layout_box(){
    $screens = array( 'post', 'page' );
    foreach( $screens as $screen ){
        add_meta_box( 
            'travel_agency_pro_sidebar_layout',
            __( 'Sidebar Layout', 'travel-agency-pro' ),
            'travel_agency_pro_sidebar_layout_callback', 
            $screen,
            'normal',
            'high'
        );
    }
    
    //Trip details
    add_meta_box(
		'travel_agency_pro_team_details',
		__( 'Team Details', 'travel-agency-pro' ),
		'travel_agency_pro_team_metabox_callback',
		'tap_team',
		'side',
		'high'
	);
    
    //Trip Gallery
    add_meta_box(
		'travel_agency_pro_team_gallery',
		__( 'Team Gallery', 'travel-agency-pro' ),
		'travel_agency_pro_team_gallery_callback',
		'tap_team',
		'normal',
		'high'
	);
    
    //Testimonial Details
    add_meta_box(
		'travel_agency_pro_testimonial_details',
		__( 'Testimonial Details', 'travel-agency-pro' ),
		'travel_agency_pro_testimonial_detail_callback',
		'tap_testimonial',
		'side',
		'high'
	);

    //Trip Rating
    add_meta_box(
        'travel_agency_pro_trip_details',
        __( 'Trip Rating', 'travel-agency-pro' ),
        'travel_agency_pro_trip_detail_callback',
        'trip',
        'side',
        'high'
    );

    
    
}
add_action( 'add_meta_boxes', 'travel_agency_pro_add_sidebar_layout_box' );

$travel_agency_pro_sidebar_layout = array(
    'default-sidebar' => array(
        'value'     => 'default-sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/default-sidebar.png'
    ),
    'left-sidebar' => array(
        'value'     => 'left-sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/left-sidebar.png'
    ),
    'right-sidebar' => array(
        'value'     => 'right-sidebar',
        'thumbnail' => get_template_directory_uri() . '/images/right-sidebar.png'
    )
);

function travel_agency_pro_sidebar_layout_callback(){
    global $post , $travel_agency_pro_sidebar_layout;
    wp_nonce_field( basename( __FILE__ ), 'travel_agency_pro_sidebar_nonce' );
    
    $sidebars = travel_agency_pro_get_dynamnic_sidebar( true, true, true );
    $sidebar  = get_post_meta( $post->ID, '_tap_sidebar', true );
?>
 
<table class="form-table">
    <tr>
        <td colspan="4"><em class="f13"><?php esc_html_e( 'Choose Sidebar Template', 'travel-agency-pro' ); ?></em></td>
    </tr>

    <tr>
        <td>
        <?php  
            foreach( $travel_agency_pro_sidebar_layout as $field ){  
                $layout = get_post_meta( $post->ID, '_tap_sidebar_layout', true ); ?>

            <div class="hide-radio radio-image-wrapper" style="float:left; margin-right:30px;">
                <input id="<?php echo esc_attr( $field['value'] ); ?>" type="radio" name="sidebar_layout" value="<?php echo esc_attr( $field['value'] ); ?>" <?php checked( $field['value'], $layout ); if( empty( $layout ) ){ checked( $field['value'], 'default-sidebar' ); }?>/>
                <label class="description" for="<?php echo esc_attr( $field['value'] ); ?>">
                    <img src="<?php echo esc_url( $field['thumbnail'] ); ?>" alt="<?php echo esc_attr( $field['value'] ); ?>" />
                </label>
            </div>
            <?php } // end foreach 
            ?>
            <div class="clear"></div>
        </td>
    </tr>
    
    <tr>
        <td colspan="3"><em class="f13"><?php esc_html_e( 'Choose Sidebar', 'travel-agency-pro' ); ?></em></td>
    </tr>
    
    <tr>
        <td>
            <select name="tap_sidebar">
            <?php 
                foreach( $sidebars as $k => $v ){ ?>
                    <option value="<?php echo esc_attr( $k ); ?>" <?php selected( $sidebar, $k ); if( empty( $sidebar ) && $k == 'default-sidebar' ){ echo "selected='selected'";}?> ><?php echo esc_html( $v ); ?></option>
                <?php }
            ?>
            </select>
        </td>    
    </tr>
    
    <tr>
        <td><em class="f13"><?php printf( esc_html__( 'You can set up the sidebar content from %s', 'travel-agency-pro' ), '<a href="'. esc_url( admin_url( 'widgets.php' ) ) .'">here</a>' ); ?></em></td>
    </tr>
</table>
 
<?php 
}

function travel_agency_pro_save_sidebar_layout( $post_id ){
      global $travel_agency_pro_sidebar_layout , $post;

       // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'travel_agency_pro_sidebar_nonce' ] ) || !wp_verify_nonce( $_POST[ 'travel_agency_pro_sidebar_nonce' ], basename( __FILE__ ) ) )
        return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE)  
        return;

    if( 'page' == $_POST['post_type'] ){  
        if( !current_user_can( 'edit_page', $post_id ) ) return $post_id;  
    }elseif( !current_user_can( 'edit_post', $post_id ) ){  
        return $post_id;  
    }
    
    // Make sure that it is set.
	if ( !isset( $_POST['tap_sidebar'] ) ) {
		return;
	}
    
    foreach( $travel_agency_pro_sidebar_layout as $field ){  
        //Execute this saving function
        $old = get_post_meta( $post_id, '_tap_sidebar_layout', true ); 
        $new = sanitize_text_field( $_POST['sidebar_layout'] );
        if( $new && $new != $old ) {  
            update_post_meta( $post_id, '_tap_sidebar_layout', $new );  
        }elseif( '' == $new && $old ) {  
            delete_post_meta( $post_id, '_tap_sidebar_layout', $old );  
        } 
     } // end foreach    
     
    // Sanitize user input.
	$sidebar = sanitize_text_field( $_POST['tap_sidebar'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_tap_sidebar', $sidebar );
     
}
add_action( 'save_post', 'travel_agency_pro_save_sidebar_layout' ); 

/**
 * Social Icons for Team
*/
function travel_agency_pro_team_social(){
    global $post;
    $social = get_post_meta( $post->ID, '_tap_team_social', true );
    
    $defaults = array( 
        'facebook'     => '', 
        'twitter'      => '',
        'instagram'    => '',
        'snapchat'     => '',
        'pinterest'    => '',
        'google-plus'  => '',
        'youtube'      => ''
    );
    $social_icons = apply_filters( 'tap_social_icons', $defaults );
    
    if( $social ){
        return $social;
    }else{
        return $social_icons;
    }
}
/**
 * Callback for Team Details
*/
function travel_agency_pro_team_metabox_callback(){
    
    global $post;
    wp_nonce_field( basename( __FILE__ ), 'tap_team_detail_nonce' );
    
    $position = get_post_meta( $post->ID, '_tap_team_position', true );
    $socials  = travel_agency_pro_team_social();
    ?>
    <div class="team-info">
        <label for="position"><?php esc_html_e( 'Position : ', 'travel-agency-pro' ); ?></label>
        <input type="text" name="tap_team_position" id="position" value="<?php echo $position ? $position : ''; ?>" />
    </div>
    
    <div class="team-social">
        <em><?php esc_html_e( 'Social Links', 'travel-agency-pro' ); ?></em>
        <ul class="tap-team-sortable-icons">
        	<?php foreach( $socials as $k => $v ){ ?>
            <li class="social-icons">
                <label for="<?php echo esc_attr( $k ); ?>"><?php printf( esc_html__( '%s :', 'travel-agency-pro' ), ucfirst( $k ) ); ?></label>
                <input id="<?php echo esc_attr( $k ); ?>" name="tap_team_social[<?php echo esc_attr( $k ); ?>]" type="text" value="<?php echo isset( $v ) ? esc_attr( $v ) : ''; ?>" />
            </li>
            <?php } ?>            
        </ul>
    </div>
    <?php
}

/**
 * Saving Team Details
*/
function travel_agency_pro_save_team_details( $post_id ){
    global $post;
    $socials = array();
    // Verify the nonce before proceeding.
    if( !isset( $_POST[ 'tap_team_detail_nonce' ] ) || !wp_verify_nonce( $_POST[ 'tap_team_detail_nonce' ], basename( __FILE__ ) ) ) return;
    
    // Stop WP from clearing custom fields on autosave
    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
	if( isset( $_POST['tap_team_position'] ) ){
		$position = sanitize_text_field( $_POST['tap_team_position'] );
        update_post_meta( $post_id, '_tap_team_position', $position );
	}
    
    if( isset( $_POST['tap_team_social'] ) ){
        foreach( $_POST['tap_team_social'] as $key => $links ){
            $socials[$key] = esc_url_raw( $links );
        }
        update_post_meta( $post_id, '_tap_team_social', $socials );
    }    
}
add_action( 'save_post', 'travel_agency_pro_save_team_details' );

/**
 * Team Gallery Meta Box
*/
function travel_agency_pro_team_gallery_callback( $post ){
    wp_nonce_field( basename(__FILE__), 'tap_team_gallery_nonce' );
    $ids   = get_post_meta( $post->ID, '_tap_team_gallery_ids', true );
    $title = get_post_meta( $post->ID, '_tap_team_gallery_title', true );
    ?>
    <table class='form-table'>
        <tr>
            <td>
                <label for="gallery-title"><?php esc_html_e( 'Gallery Title: ', 'travel-agency-pro' ); ?></label>
                <input type="text" name="tap_team_gallery_title" id="gallery-title" value="<?php echo esc_attr( $title ? $title : '' ); ?>" />
            </td>
        </tr>
        <tr>
            <td>
                <a class='img-gallery-add button' href='javascript:void(0);' data-uploader-title='<?php esc_attr_e( 'Add image(s) to gallery', 'travel-agency-pro' );?>' data-uploader-button-text='<?php esc_attr_e( 'Add image(s)', 'travel-agency-pro' ); ?>'><?php esc_html_e( 'Add image(s)', 'travel-agency-pro' ); ?></a>
                <ul id='img-gallery-metabox-list'>
                <?php
                if( $ids ){ 
                    foreach( $ids as $key => $value ){ 
                        $image = wp_get_attachment_image_src( $value ); ?>
                        <li>
                            <input type='hidden' name='tap_team_gallery_ids[<?php echo esc_attr( $key ); ?>]' value='<?php echo esc_attr( $value ); ?>'>
                            <img class='image-preview' src='<?php echo $image[0]; ?>'>
                            <a class='change-image button button-small' href='javascript:void(0);' data-uploader-title='<?php esc_attr_e( 'Change image', 'travel-agency-pro' ); ?>' data-uploader-button-text='<?php esc_attr_e( 'Change image', 'travel-agency-pro' ); ?>'><?php esc_html_e( 'Change image', 'travel-agency-pro' ); ?></a><br>
                            <small><a class='remove-image' href='javascript:void(0);'><?php esc_html_e( 'Remove image', 'travel-agency-pro' ); ?></a></small>
                        </li>
                    <?php 
                    }
                } 
                ?>
                </ul>
            </td>
        </tr>
    </table>
    <?php 
}

/**
 * Save Gallery post meta
*/
function travel_agency_pro_save_team_gallery( $post_id ){
    if( !isset( $_POST['tap_team_gallery_nonce'] ) || !wp_verify_nonce( $_POST['tap_team_gallery_nonce'], basename(__FILE__) ) ) return;

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;

    if( isset( $_POST['tap_team_gallery_ids'] ) ){
        update_post_meta( $post_id, '_tap_team_gallery_ids', $_POST['tap_team_gallery_ids'] );
    }else{
        delete_post_meta( $post_id, '_tap_team_gallery_ids' );
    }
    
    if( isset( $_POST['tap_team_gallery_title']) ){
        $title = sanitize_text_field( $_POST['tap_team_gallery_title'] );
        update_post_meta( $post_id, '_tap_team_gallery_title', $_POST['tap_team_gallery_title'] );
    }
} 
add_action( 'save_post', 'travel_agency_pro_save_team_gallery' );

/**
 * Callback for Testimonial Details
*/
function travel_agency_pro_testimonial_detail_callback( $post ){
    wp_nonce_field( basename( __FILE__ ), 'tap_testimonial_detail_nonce' );
        
    $visited_trip = get_post_meta( $post->ID, '_tap_testimonail_visited_trip', true );
    $trip_date    = get_post_meta( $post->ID, '_tap_testimonail_trip_date', true );
    $trip_rating  = get_post_meta( $post->ID, '_tap_testimonail_trip_rating', true );
    ?>
    <div class="testimonial-visited-trip">
        <label for="visited-trip"><?php esc_html_e( 'Visited Trip : ', 'travel-agency-pro' ); ?></label>
        <input type="text" name="tap_testimonail_visited_trip" id="visited-trip" value="<?php echo esc_attr( $visited_trip ? $visited_trip : '' ); ?>" />
    </div>
    <div class="testimonial-trip-date">
        <label for="trip-date"><?php esc_html_e( 'Trip Date: ', 'travel-agency-pro' ); ?></label>
        <input type="text" name="tap_testimonail_trip_date" id="trip-date" value="<?php echo esc_attr( $trip_date ? $trip_date : '' ); ?>" />
    </div>
    <div class="testimonial-rating">
        <label for="trip-rating"><?php esc_html_e( 'Rating: ', 'travel-agency-pro' ); ?></label>
        <div id="rate-<?php echo esc_attr( $post->ID ); ?>"></div>
        <input type="hidden" name="tap_testimonail_trip_rating" id="trip-rating" value="<?php echo esc_attr( $trip_rating ? $trip_rating : '' ); ?>" />
    </div>
    <?php
}

/**
 * Save Testimonial Details
*/
function travel_agency_pro_save_testimonial_details( $post_id ){
    if( !isset( $_POST['tap_testimonial_detail_nonce'] )  || !wp_verify_nonce( $_POST['tap_testimonial_detail_nonce'], basename(__FILE__) )) return;

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if( isset( $_POST['tap_testimonail_visited_trip'] ) ){
        $visited_trip = sanitize_text_field( $_POST['tap_testimonail_visited_trip'] );
        update_post_meta( $post_id, '_tap_testimonail_visited_trip', $visited_trip );
    }
    
    if( isset( $_POST['tap_testimonail_trip_date'] ) ){
        $trip_date = sanitize_text_field( $_POST['tap_testimonail_trip_date'] );
        update_post_meta( $post_id, '_tap_testimonail_trip_date', $trip_date );
    }
    
    if( isset( $_POST['tap_testimonail_trip_rating'] ) ){
        $trip_rating = sanitize_text_field( $_POST['tap_testimonail_trip_rating'] );
        update_post_meta( $post_id, '_tap_testimonail_trip_rating', $trip_rating );
    }

  
}
add_action( 'save_post', 'travel_agency_pro_save_testimonial_details' );

/**
 * Callback for Trip Rating
*/
function travel_agency_pro_trip_detail_callback( $post ){
    wp_nonce_field( basename( __FILE__ ), 'trip_detail_nonce' );
    $trip_rating  = get_post_meta( $post->ID, 'trip_rating', true );
    ?>
   
    <div class="trip-rating">
        <label for="trip-rating"><?php esc_html_e( 'Package Rating: ', 'travel-agency-pro' ); ?></label>
         <select name="trip_rating">
        <?php   if (isset($trip_rating) && $trip_rating!='') {
        echo "<OPTION value='".$trip_rating."' selected='selected'>".$trip_rating."</OPTION>";
        }
        echo "<OPTION value='5'>--Select Package Rating--</OPTION>";
        for ($i=1; $i <=5 ; $i++) { 
        echo "<OPTION value='".$i."'>".$i."</OPTION>";
        }
        ?>
   </select>
    </div>
    <?php
}
/**
 * Save Trip Rating
*/
function travel_agency_pro_save_trip_detail( $post_id ){
    if( !isset( $_POST['trip_detail_nonce'] ) || !wp_verify_nonce( $_POST['trip_detail_nonce'], basename(__FILE__) )) return;

    if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) return;
    
    if( isset( $_POST['trip_rating'] ) ){
        $trip_rating = sanitize_text_field( $_POST['trip_rating'] );
        update_post_meta( $post_id, 'trip_rating', $trip_rating );
    }
}
add_action( 'save_post', 'travel_agency_pro_save_trip_detail' );



/**
 * User Profile Extra Fields 
 */
function travel_agency_pro_user_fields( $user ) { 
    
    wp_nonce_field( basename( __FILE__ ), 'tap_user_fields_nonce' ); 
    
    if( is_string( $user ) === true ){
        $user = new stdClass();//create a new
        $id = -9999;
        unset( $user );
    }else{
        $id = $user->ID;
    }
     
    $facebook  = get_user_meta( $id, '_tap_facebook', true );
    $twitter   = get_user_meta( $id, '_tap_twitter', true );
    $instagram = get_user_meta( $id, '_tap_instagram', true );
    $snapchat  = get_user_meta( $id, '_tap_snapchat', true );
    $pinterest = get_user_meta( $id, '_tap_pinterest', true );
    $linkedin  = get_user_meta( $id, '_tap_linkedin', true );
    $gplus     = get_user_meta( $id, '_tap_gplus', true );
    ?>
    
    <h3><?php esc_html_e( 'User Social Link', 'travel-agency-pro' ); ?></h3>
    
    <table class="form-table">    
        <tr>
            <th><label for="facebook"><?php esc_html_e( 'Facebook Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="facebook" id="facebook" value="<?php echo esc_attr( $facebook ? $facebook : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Facebook Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="twitter"><?php esc_html_e( 'Twitter Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="twitter" id="twitter" value="<?php echo esc_attr( $twitter ? $twitter : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Twitter Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="instagram"><?php esc_html_e( 'Instagram Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="instagram" id="instagram" value="<?php echo esc_attr( $instagram ? $instagram : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Instagram Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="snapchat"><?php esc_html_e( 'Snapchat Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="snapchat" id="snapchat" value="<?php echo esc_attr( $snapchat ? $snapchat : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Snapchat Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>  
        <tr>
            <th><label for="pinterest"><?php esc_html_e( 'Pinterest Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="pinterest" id="pinterest" value="<?php echo esc_attr( $pinterest ? $pinterest : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Pinterest Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>
        <tr>
            <th><label for="linkedin"><?php esc_html_e( 'LinkedIn Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="linkedin" id="linkedin" value="<?php echo esc_attr( $linkedin ? $linkedin : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your LinkedIn Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>      
        <tr>
            <th><label for="gplus"><?php esc_html_e( 'Google Plus Url', 'travel-agency-pro' ); ?></label></th>
            <td>
                <input type="text" name="gplus" id="gplus" value="<?php echo esc_attr( $gplus ? $gplus : '' ); ?>" class="regular-text" /><br />
                <span class="description"><?php esc_html_e( "Please enter your Google Plus Url.", 'travel-agency-pro' ); ?></span>
            </td>
        </tr>          
    </table>
<?php 
}
/** Hooks to add extra field in profile */
add_action( 'show_user_profile', 'travel_agency_pro_user_fields' ); // editing your own profile
add_action( 'edit_user_profile', 'travel_agency_pro_user_fields' ); // editing another user
add_action( 'user_new_form', 'travel_agency_pro_user_fields' ); // creating a new user

/**
 * Saving Extra User Profile Information
*/ 
function travel_agency_pro_save_user_fields( $user_id ) {

    // Check if our nonce is set.
	if ( ! isset( $_POST['tap_user_fields_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['tap_user_fields_nonce'], basename( __FILE__ ) ) ) {
		return;
	}

    if ( !current_user_can( 'edit_user', $user_id ) ) return false;

    if( isset( $_POST['facebook'] ) ){
        $facebook = esc_url_raw( $_POST['facebook'] );
        update_user_meta( $user_id, '_tap_facebook', $facebook );
    }
    
    if( isset( $_POST['twitter'] ) ){
        $twitter = esc_url_raw( $_POST['twitter'] );
        update_user_meta( $user_id, '_tap_twitter', $twitter );
    }
    
    if( isset( $_POST['instagram'] ) ){
        $instagram = esc_url_raw( $_POST['instagram'] );
        update_user_meta( $user_id, '_tap_instagram', $instagram );
    }
    
    if( isset( $_POST['snapchat'] ) ){
        $snapchat = esc_url_raw( $_POST['snapchat'] );
        update_user_meta( $user_id, '_tap_snapchat', $snapchat );
    }
    
    if( isset( $_POST['pinterest'] ) ){
        $pinterest = esc_url_raw( $_POST['pinterest'] );
        update_user_meta( $user_id, '_tap_pinterest', $pinterest );
    }
    
    if( isset( $_POST['linkedin'] ) ){
        $linkedin = esc_url_raw( $_POST['linkedin'] );
        update_user_meta( $user_id, '_tap_linkedin', $linkedin );
    }
    
    if( isset( $_POST['gplus'] ) ){
        $gplus = esc_url_raw( $_POST['gplus'] );
        update_user_meta( $user_id, '_tap_gplus', $gplus );
    }
    
}
/** Hook to Save Extra User Fields */
add_action( 'personal_options_update', 'travel_agency_pro_save_user_fields' );
add_action( 'edit_user_profile_update', 'travel_agency_pro_save_user_fields' );
add_action( 'user_register', 'travel_agency_pro_save_user_fields' );