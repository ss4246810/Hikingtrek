<?php
/**
 * Travel Agency Pro functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Travel_Agency_Pro
 */

//define theme version
if ( ! defined( 'TAP_THEME_VERSION' ) ) {
	$theme_data = wp_get_theme();	
	define ( 'TAP_THEME_VERSION', $theme_data->get( 'Version' ) );
}

/**
 * Custom Post Type
 */
require get_template_directory() . '/inc/cpt/cpt.php';

/**
 * Metabox
 */
require get_template_directory() . '/inc/cpt/metabox.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Custom functions for selective refresh.
 */
require get_template_directory() . '/inc/partials.php';

/**
 * Custom Functions
 */
require get_template_directory() . '/inc/custom-functions.php';

/**
 * Template Functions
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Custom Controls 
*/
require get_template_directory() . '/inc/custom-controls/custom-control.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer/customizer.php';

/**
 * Widgets
 */
require get_template_directory() . '/inc/widgets.php';

/**
 * Plugin Recommendation
*/
require get_template_directory() . '/inc/tgmpa/recommended-plugins.php';

/**
 * Typography Functions
 */
require get_template_directory() . '/inc/typography-functions.php';

/**
 * Dynamic Styles
 */
//require get_template_directory() . '/css/style.php';     

/**
 * Add theme compatibility function for woocommerce if active
*/
if( is_woocommerce_activated() )
require get_template_directory() . '/inc/woocommerce-functions.php';

/**
 * Demo Import
*/
require get_template_directory() . '/inc/demo/import-hooks.php';

/**
 * Theme Updater
*/
require get_template_directory() . '/updater/theme-updater.php';

/**
 * Image Resizer
 */
require get_template_directory() . '/inc/BFI_Thumb.php';

/**
 * Enqueue scripts and styles.
 */
function hikingteam_scripts() {
/* 
<link href="https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800" rel="stylesheet">*/
    // Add other stylesheets Header.
    wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/assets/css/bootstrap.css' );
    wp_enqueue_style( 'main', get_template_directory_uri() . '/assets/css/main.css' );
    wp_enqueue_style( 'animate', get_template_directory_uri() . '/assets/css/animate.css' );
    wp_enqueue_style( 'sresize', get_template_directory_uri() . '/assets/css/resize.css' );
    wp_enqueue_style( 'royalslider', get_template_directory_uri() . '/assets/css/royalslider.css' );
    wp_enqueue_style( 'owl.carousel.min', get_template_directory_uri() . '/assets/css/owl.carousel.min.css' );
    wp_enqueue_style( 'font-awesome.min', get_template_directory_uri() . '/assets/css/font-awesome.min.css' );
    wp_enqueue_style( 'jquery.mmenu.all', get_template_directory_uri() . '/assets/css/jquery.mmenu.all.css' );
    wp_enqueue_style( 'wpb-google-fonts', 'https://fonts.googleapis.com/css?family=Raleway:400,500,600,700,800', false ); 
    wp_enqueue_script( 'modernizr', get_template_directory_uri() . '/assets/js/vendor/modernizr-2.8.3.min.js' );
    // end

    // Add other javascript Footer.
    wp_enqueue_script( 'vendor-jquery-1.12.0', get_template_directory_uri() . '/assets/js/vendor/jquery-1.12.0.min.js', '', '', true  );
    wp_enqueue_script( 'plugins', get_template_directory_uri() . '/assets/js/plugins.js', '', '', true  );
    wp_enqueue_script( 'main-js', get_template_directory_uri() . '/assets/js/main.js', '', '', true  );
    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
        wp_enqueue_script( 'comment-reply' );
    }
    // end
}
add_action( 'wp_enqueue_scripts', 'hikingteam_scripts' );


// remove update notice for forked plugins
function remove_update_notifications( $value ) {

    if ( isset( $value ) && is_object( $value ) ) {
        unset( $value->response[ 'wp-travel-engine/wp-travel-engine.php' ] );
    }

    return $value;
}
add_filter( 'site_transient_update_plugins', 'remove_update_notifications' );

/* Display image title, caption, alt, description */
function gia( $attachment_id ) {

 $attachment = get_post( $attachment_id );
 $data =  array(
   'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
   'caption' => $attachment->post_excerpt,
   'description' => $attachment->post_content,
   'title' => $attachment->post_title
 );

 if ($data['alt']):
  
  $alt = $data['alt'];
 elseif($data['caption']):
  $alt = $data['caption'];
 elseif($data['description']):
  $alt = $data['description'];
 elseif($data['title']):
  $alt = $data['title'];
 else:
  $alt = '';
 endif;

 return $data;

}

/** get grade.
  *@since 1.0.0
  *
  */
  function get_grade($grade){
      if($grade==1){
          $result='Easy Trek';
      } elseif($grade==2){
          $result='Moderate';
      } elseif($grade==3){
          $result='Strenuous';
      } elseif($grade==4){
          $result='Fairly strenuous';
      } elseif($grade==5){
          $result='Challenging';
      } else{
          $result='Strenuous';
      } 
      return $result;

  }


//////////////////////////////// Testimonial Meta /////////////////////////////////
add_action("admin_init", "admin_init");
function admin_init(){
add_meta_box("txt_general_review_meta", "General Client Info", "build_txt_general_review_meta", "tap_testimonial", "advanced", "default");
}


function my_admin_scripts() {    
    wp_enqueue_script('media-upload');
    wp_enqueue_script('thickbox');
    wp_register_script('my-upload', get_template_directory_uri().'/assets/js/scripts-upload.js', array('jquery','media-upload','thickbox'));
    wp_enqueue_script('my-upload');
}
function my_admin_styles() {

    wp_enqueue_style('thickbox');
}
add_action('admin_print_scripts', 'my_admin_scripts');
add_action('admin_print_styles', 'my_admin_styles');


function build_txt_general_review_meta(){
  global $post;
  $custom         = get_post_custom($post->ID);
  $txt_review_name    = $custom["txt_review_name"][0];
  $txt_review_email   = $custom["txt_review_email"][0];
  $txt_review_phone   = $custom["txt_review_phone"][0];
  $txt_review_travelyear = $custom["txt_review_travelyear"][0];
  $txt_country = $custom["txt_country"][0];
  $txt_package = $custom["txt_package"][0];

  ?>
  <label>Name:</label>
  <input name="txt_review_name" class = "widefat" value="<?php echo $txt_review_name; ?>" /><br />
   <label>Email:</label>
  <input name="txt_review_email" class = "widefat" value="<?php echo $txt_review_email; ?>" /><br />
   <label>Phone:</label>
  <input name="txt_review_phone" class = "widefat" value="<?php echo $txt_review_phone; ?>" /><br />
   <label>Country:</label>
  <input name="txt_country" class = "widefat" value="<?php echo $txt_country; ?>" /><br />
  <label>Trip Name</label>
  <select name="txt_package" class = "widefat">
  <?php 
    $args=array( 'post_type' =>array('trip'),'numberposts' => -1 );
    $packages = get_posts( $args );
  ?>
    <OPTION value=''>--Select Tour--</OPTION>
    <?php
    foreach($packages as $pac){
    $post_name =$pac->post_title ;
    $post_id =$pac->ID ;
  ?>
    <option  value="<?php echo $post_id; ?>" <?php if($txt_package==$post_id){ ?> selected="selected" <?php } ?>><?php echo $post_name;?></option>
      <?php } ?>
  </select>
  <?php $args = array('order'=>'ASC', 'post_type'=>'attachment', 'post_parent'=>$post->ID, 'post_mime_type'=>'image', 'post_status'=>null,'exclude'     => get_post_thumbnail_id()); 
     $attachments = get_posts($args); 
     if(count($attachments)>0):
     ?>
  <label> Images </label>
          <ul>
          <?php if ( $attachments ) {
            foreach ( $attachments as $attachment ) {
                $class = "post-attachment mime-" . sanitize_title( $attachment->post_mime_type );
                $thumbimg = wp_get_attachment_link( $attachment->ID, 'medium', true );
                $edit=admin_url( 'post.php?post='.$attachment->ID.'&action=edit', 'http' );;
                echo '<li class="' . $class . ' data-design-thumbnail">' . $thumbimg .'<a href="'.$edit.'"> Edit </a>'. '</li>';
            }
             
        }
         ?>
         </ul>
  <?php
  endif;
}
add_action('save_post', 'save_general_review_details');
function save_general_review_details() {
  global $post;
  update_post_meta($post->ID, "txt_review_name", $_POST["txt_review_name"]);
  update_post_meta($post->ID, "txt_review_email", $_POST["txt_review_email"]);
  update_post_meta($post->ID, "txt_review_phone", $_POST["txt_review_phone"]);
  update_post_meta($post->ID, "txt_country", $_POST["txt_country"]);
  update_post_meta($post->ID, "txt_package", $_POST["txt_package"]);

}

/* Hook into the 'init' action so that the function
* Containing our post type registration is not
* unnecessarily executed.
*/
add_action("manage_posts_custom_column",  "tap_testimonial_columns");
add_filter("manage_edit-tap_testimonial_columns", "tap_testimonial_edit_columns");
function tap_testimonial_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Title",
    "trip" => "Trip Name",
    "description" => "Description",
  "thumbnail"=>"Featured Image",
  "status"=>"Status",
   "date"=>"Date"
   );
  return $columns;
}
function tap_testimonial_columns($column){
  global $post;
  $custom = get_post_custom($post->ID);
  $txt_package = $custom["txt_package"][0];
  switch ($column) {
       case "trip":
           if($txt_package!="") {
                 $trip_name = '<a href="'.get_the_permalink($txt_package).'" target="_blank">'.get_the_title($txt_package).'</a>';
            } else {
                $trip_name = "";
            }
            echo $trip_name;
            break; 
        case "description":
            echo wp_trim_words(get_the_content(), 30);
            break; 
    case "thumbnail":
            echo the_post_thumbnail('thumbnail'); 
            break;
    case "status":
            echo get_post_status();
            break;
    case "date":
      echo get_post_time( 'l, F j, Y', false,$post->ID );
      break;
  }
}
////////////////// end //////////////////

//////// Review Rating ////////
function show_stars($value,$id){
  if($value>0) {
  ?>
        <div class="review-rating">
        <span id="rating-<?php echo $id; ?>"></span>
        </div>
        <script>
        jQuery(document).ready(function($){
        $("#rating-<?php echo $id; ?>").rateYo({
        rating: <?php echo !empty($value) ? $value: '';?>,
        starWidth: "13px",
        readOnly: true
        });
        });
        </script>
  <?php
  }
}
//////// End ///////////

//////// Review Rating Average////////
function show_stars_avg($value,$id){
  if($value>0) {
  ?>
        <span class="star-rating" id="rating-<?php echo $id; ?>"></span>
        <script>
        jQuery(document).ready(function($){
        $("#rating-<?php echo $id; ?>").rateYo({
        rating: <?php echo !empty($value) ? $value: '';?>,
        starWidth: "13px",
        readOnly: true
        });
        });
        </script>
  <?php
  }
}
//////// End ///////////

//////// Normal Rating ////////
function show_star_rating($value,$id){
  if($value>0) {
  ?>
        <div class="ratting" id="rating-<?php echo $id; ?>"></div>
        <script>
        jQuery(document).ready(function($){
        $("#rating-<?php echo $id; ?>").rateYo({
        rating: <?php echo !empty($value) ? $value: '';?>,
        starWidth: "13px",
        readOnly: true
        });
        });
        </script>
  <?php
  }
}
//////// End ///////////

/**
 * Display Average Rating
 */
function average_rating_by_review($ID)
{
    $review_args = array( 'post_type' => 'tap_testimonial', 'numberposts' => -1,'meta_query' => array(
            array(
            'key' => 'txt_package', // name of custom field
            'value' => $ID,
            'compare' => 'LIKE'
            )
            ) );
    $reviews = get_posts( $review_args );
    $rating_count = array();
    foreach( $reviews as $post ) :  setup_postdata($post);  
    $trip_rating  = get_post_meta($post->ID, '_tap_testimonail_trip_rating', true );
    if(!empty($trip_rating)){
    $rating_count[] = $trip_rating;
    }
    endforeach; 
    $count = count($rating_count);
    $sum = array_sum($rating_count);
    if($count != 0){
    $avg = $sum/$count; 
    }else{
    $avg = 5;
    }
    wp_reset_postdata();
    return $avg;
}
/**
 * Display Average Rating
 */
function total_review($ID)
{
  $review_args = array( 'post_type' => 'tap_testimonial', 'numberposts' => -1,'meta_query' => array(
            array(
            'key' => 'txt_package', // name of custom field
            'value' => $ID,
            'compare' => 'LIKE'
            )
            ) );
  $reviews = get_posts( $review_args );
  if(count($reviews)>1) 
  $total_review = count($reviews).' reviews';
  else
  $total_review = count($reviews).' review';
  return $total_review;
}

add_post_type_support( 'page', 'excerpt' );

/************** Start Custom Post Type - Travel Info *********************/
add_action('init', 'information_register');
function information_register() {
  $labels = array(
    'name' => _x('Travel Info', 'post type general name'),
    'singular_name' => _x('Travel Info', 'post type singular name'),
    'add_new' => _x('Add New', 'travel Info item'),
    'add_new_item' => __('Name'),
    'edit_item' => __('Edit Info Guide'),
    'new_item' => __('New Travel Info'),
    'view_item' => __('View Travel Info'),
    'search_items' => __('Search Travel Info'),
    'not_found' =>  __('Nothing found'),
    'not_found_in_trash' => __('Nothing found in Trash'),
    'parent_item_colon' => ''
  );
  $args = array(
    'labels' => $labels,
    'public' => true,
    'publicly_queryable' => true,
    'show_ui' => true,
    'query_var' => true,
    'menu_icon' => 'dashicons-format-aside',
    'rewrite' => true,
    'capability_type' => 'post',
    'hierarchical' => false,
    'menu_position' => null,
    'supports' => array('title','editor','thumbnail'),
    'taxonomies'          => array( 'destination' )
    ); 
  register_post_type( 'information' , $args );

}

add_action("manage_posts_custom_column",  "information_columns");
add_filter("manage_edit-information_columns", "information_edit_columns");
function information_edit_columns($columns){
  $columns = array(
    "cb" => "<input type=\"checkbox\" />",
    "title" => "Travel Info",
  "categoryguide"=>"Destination"
   );
  return $columns;
}

function information_columns($column){
  global $post;
  switch ($column) {
    case "categoryguide":
      echo get_the_term_list($post->ID, 'destination', '', ', ','');
      break;
  }
}
/*************** End Custom Post Type - Travel Guide **********************/

/* Add custom title Destination */
function wcr_destination_fields($term) {
    // we check the name of the action because we need to have different output
    // if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
    if (current_filter() == 'destination_edit_form_fields') {
        $sub_title = get_term_meta($term->term_id, 'sub_title', true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label></th>
            <td>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="<?php echo esc_textarea($sub_title); ?>">
            </td>
        </tr>
    <?php } elseif (current_filter() == 'destination_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="">
        </div>
    <?php
    }
}

// Add the fields, using our callback function  
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
add_action('destination_add_form_fields', 'wcr_destination_fields', 10, 2);
add_action('destination_edit_form_fields', 'wcr_destination_fields', 10, 2);

function wcr_save_destination_fields($term_id) {
    if (!isset($_POST['term_fields'])) {
        return;
    }

    foreach ($_POST['term_fields'] as $key => $value) {
        update_term_meta($term_id, $key, sanitize_text_field($value));
    }
}

// Save the fields values, using our callback function
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: edited_book, create_book
add_action('edited_destination', 'wcr_save_destination_fields', 10, 2);
add_action('create_destination', 'wcr_save_destination_fields', 10, 2);

/* Add custom title Activities*/
function wcr_activities_fields($term) {
    // we check the name of the action because we need to have different output
    // if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
    if (current_filter() == 'activities_edit_form_fields') {
        $sub_title = get_term_meta($term->term_id, 'sub_title', true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label></th>
            <td>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="<?php echo esc_textarea($sub_title); ?>">
            </td>
        </tr>
    <?php } elseif (current_filter() == 'activities_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="">
        </div>
    <?php
    }
}

// Add the fields, using our callback function  
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
add_action('activities_add_form_fields', 'wcr_activities_fields', 10, 2);
add_action('activities_edit_form_fields', 'wcr_activities_fields', 10, 2);

function wcr_save_activities_fields($term_id) {
    if (!isset($_POST['term_fields'])) {
        return;
    }

    foreach ($_POST['term_fields'] as $key => $value) {
        update_term_meta($term_id, $key, sanitize_text_field($value));
    }
}

// Save the fields values, using our callback function
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: edited_book, create_book
add_action('edited_activities', 'wcr_save_activities_fields', 10, 2);
add_action('create_activities', 'wcr_save_activities_fields', 10, 2);

/* Add custom title Trip Types*/
function wcr_trip_types_fields($term) {
    // we check the name of the action because we need to have different output
    // if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
    if (current_filter() == 'trip_types_edit_form_fields') {
        $sub_title = get_term_meta($term->term_id, 'sub_title', true);
        ?>
        <tr class="form-field">
            <th valign="top" scope="row"><label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label></th>
            <td>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="<?php echo esc_textarea($sub_title); ?>">
            </td>
        </tr>
    <?php } elseif (current_filter() == 'trip_types_add_form_fields') {
        ?>
        <div class="form-field">
            <label for="term_fields[sub_title]"><?php _e('Sub Title'); ?></label>
            <input type="text" id="term_fields[sub_title]" name="term_fields[sub_title]" value="">
        </div>
    <?php
    }
}

// Add the fields, using our callback function  
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: book_add_form_fields, book_edit_form_fields
add_action('trip_types_add_form_fields', 'wcr_trip_types_fields', 10, 2);
add_action('trip_types_edit_form_fields', 'wcr_trip_types_fields', 10, 2);

function wcr_save_trip_types_fields($term_id) {
    if (!isset($_POST['term_fields'])) {
        return;
    }

    foreach ($_POST['term_fields'] as $key => $value) {
        update_term_meta($term_id, $key, sanitize_text_field($value));
    }
}

//encrypt decrypt
function encrypt_decrypt($action, $string) {
    $output = false;
    
    $encrypt_method = "AES-256-CBC";
    $secret_key = 'hhsapplog';
    $secret_iv = 'hhsapplog';
  
    // hash
    $key = hash('sha256', $secret_key);
    
    // iv - encrypt method AES-256-CBC expects 16 bytes - else you will get a warning
    $iv = substr(hash('sha256', $secret_iv), 0, 16);
  
    if( $action == 'encrypt' ) {
      $output = openssl_encrypt($string, $encrypt_method, $key, 0, $iv);
      $output = base64_encode($output);
    }
    else if( $action == 'decrypt' ){
      $output = openssl_decrypt(base64_decode($string), $encrypt_method, $key, 0, $iv);
    }
  
    return $output;
  }
//end

// Save the fields values, using our callback function
// if you have other taxonomy name, replace category with the name of your taxonomy. ex: edited_book, create_book
add_action('edited_trip_types', 'wcr_save_trip_types_fields', 10, 2);
add_action('create_trip_types', 'wcr_save_trip_types_fields', 10, 2);

/**
 * HANDLE THE PACKAGE BOOKING FORM SUBMIT
 */
add_action('admin_post_booking_submit', 'hb_handle_booking_submit_action'); // If the user is logged in
add_action('admin_post_nopriv_booking_submit', 'hb_handle_booking_submit_action'); // If the user in not logged in
function hb_handle_booking_submit_action(){
    require get_template_directory() . '/inc/process_form.php';
}

/**
 * HANDLE THE PACKAGE CONTACT FORM SUBMIT
 */
add_action('admin_post_contact_submit', 'hb_handle_contact_submit_action'); // If the user is logged in
add_action('admin_post_nopriv_contact_submit', 'hb_handle_contact_submit_action'); // If the user in not logged in
function hb_handle_contact_submit_action(){
    require get_template_directory() . '/inc/process_form.php';
}

function pagination($pages = '', $range = 4)
{  
     global $paged;
   $currentpage=get_query_var('paged');
     if(empty($paged)) $paged = 1;
     if($pages == '')
     {
         global $wp_query;
         $pages = $wp_query->max_num_pages;
         if(!$pages)
         {
             $pages = 1;
         }
     }   
     if(1 != $pages)
     {
        if($paged = 1) echo "<li><a href='".get_pagenum_link($paged - 1)."'>«</a></li>";
        for ($i=1; $i <= $pages; $i++)
        {
          if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
          {
          if($currentpage==$i)
            $active="class='active'";
            else
            $active="";
          if($currentpage=="" || $currentpage==1)
             $activefirst="class='active'";
             else
             $activefirst=""; 
            echo ($paged == $i)? "<li $activefirst><a href='".get_pagenum_link()."'>".$i."</a></li>":"<li $active><a href='".get_pagenum_link($i)."'>".$i."</a></li>";
          }
        }
        if ($paged < $pages) echo "<li><a href='".get_pagenum_link($pages)."'>»</a></li>";
     }

}
function wpb_widgets_init() {
 
    
 
    register_sidebar( array(
        'name' =>__( 'Front Page About', 'wpb'),
        'id' => 'sidebar-2',
        'description' => __( 'Appears on the static front page template', 'wpb' ),
        'before_widget' => '<aside id="%1$s" class="widget %2$s">',
        'after_widget' => '</aside>',
        'before_title' => '<h3 class="widget-title">',
        'after_title' => '</h3>',
    ) );
    }
 
add_action( 'widgets_init', 'wpb_widgets_init' );
