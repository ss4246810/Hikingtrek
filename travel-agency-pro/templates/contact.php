<?php
/**
 * Template Name: Contact Page
 * 
 * @package Travel_Agency_Pro
 */
if (!session_id()) {
    session_start();
}
/**
 * SET RESPONSE VARIABLE WITH SESSION RESPONSE AND UNSET THE SESSION RESPONSE
 */
if (isset($_SESSION['c_response'])) {
    $c_response = $_SESSION['c_response'];
    unset($_SESSION['c_response']);
} else {
    $c_response = '';
}

$countries=array("Afghanistan", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua And Barbuda", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia And Herzegovina", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Territory", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo - The Democratic Republic Of The", "Cook Islands", "Costa Rica", "Cote D'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard Island And Mcdonald Islands", "Holy See (Vatican City State)", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran - Islamic Republic Of", "Iraq", "Ireland", "Isle Of Man", "Israel", "Italy", "Jamaica", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea - Democratic People'S Republic Of", "Korea - Republic Of", "Kuwait", "Kyrgyzstan", "Lao People'S Democratic Republic", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia - The Former Yugoslav Republic Of", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "Mexico", "Micronesia - Federated States Of", "Moldova - Republic Of", "Monaco", "Mongolia", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory - Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Helena", "Saint Kitts And Nevis", "Saint Lucia", "Saint Pierre And Miquelon", "Saint Vincent And The Grenadines", "Samoa", "San Marino", "Sao Tome And Principe", "Saudi Arabia", "Senegal", "Serbia And Montenegro", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia And The South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard And Jan Mayen", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Province Of China", "Tajikistan", "Tanzania - United Republic Of", "Thailand", "Timor-Leste", "Togo", "Tokelau", "Tonga", "Trinidad And Tobago", "Tunisia", "Turkey", "Turkmenistan", "Turks And Caicos Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "United States Minor Outlying Islands", "Uruguay", "Uzbekistan", "Vanuatu", "Venezuela", "Viet Nam", "Virgin Islands - British", "Virgin Islands - U.S.", "Wallis And Futuna", "Western Sahara", "Yemen", "Zambia", "Zimbabwe");

get_header(); 

    /**
     * Contact Page Hook
     * 
     * @hooked travel_agency_pro_google_map   - 15
     * @hooked travel_agency_pro_contact_info - 20
     * @hooked travel_agency_pro_contact_form - 25
    */
    
    ?>
    <main class="contentSection">
        <section class="content-container">
            <div class="page-breadcrumb">
                    <?php /*if (simple_fields_fieldgroup('breadcrumb_image')){ 
                    $detailbannerimg=wp_get_attachment_image_url(simple_fields_fieldgroup('breadcrumb_image'), 'full');
                    } else { */
                    $detailbannerimg = get_template_directory_uri().'/assets/img/breadcrumb-banner.jpg';
                   // } ?>
                    <div class="breadcrumb-container" style="background-image: url(<?php echo $detailbannerimg; ?>);">
                    <div class="bg-overlay"></div>
                    <div class="container">
                    <div class="table-row">
                        <div class="table-cell">
                        <div class="text-center page-heading-label">
                            <h1><?php the_title(); ?></h1>
                            <?php if ( has_excerpt( $post->ID ) ) { ?>
                            <p><?php the_excerpt(); ?></p>
                            <?php } ?>
                        </div>
                        </div>
                    </div>
                    </div>
                    </div>
                </div>
            <div class="body-contentContainer">
                <div class="container main-content" data-sticky-sidebar-container>
                    <div class="bg-white">
                    <div class="row">
                        <div class="col-xs-12 col-sm-8 col-md-8">
                            <div class="pckg-body">
                                <?php echo $c_response; ?>
                                <div class="pckg-header">
                                    <h2><?php the_title(); ?></h2>
                                </div>
                                <div class="pckg-overview">
                                    <?php
                                    $thumb_url_array = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'large', false);
                                    $image_url = $thumb_url_array[0];
                                    $image_size = array('width' =>729 , 'height' => 500);
                                    $alt= gia(get_post_thumbnail_id(get_the_ID()));
                                    ?>
                                    <?php if($image_url) : ?>
                                    <img src="<?=bfi_thumb($image_url,$image_size); ?>" title="<?php echo $alt['title']; ?>" alt="<?php echo $alt['alt']; ?>" />
                                    <?php endif; ?>
                                    <?php the_content(); ?>
                                </div>
                                <!--<div class="booking-form-container">
                                <p>Please fill the form below :</p>
                            <div class="col-xs-12 col-md-8 col-xs-push-2">

                                <div class="process-box">

                                <form action="<?php echo get_admin_url(). 'admin-post.php' ?>" method="post" id="contact-form">
                                     <input type='hidden' name='action' value='contact_submit' />
                                      
                                        <div class="row-fluid-form row">
                                            <div class="col-xs-12 col-md-4">
                                                <label>Full Name :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                 <input name="firstName" type="text" id="firstName" required="" placeholder="First Name">
                                            </div>
                                        </div>
                                        <div class="row-fluid-form row">
                                            <div class="col-xs-12 col-md-4">
                                                <label>Your Email :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                                <input name="email" type="text" id="email" required="" placeholder="Email">
                                            </div>
                                        </div>

                                              
                                            <div class="row-fluid-form row">
                                        <div class="col-xs-12 col-md-4">
                                            <label>Any Question? :</label>
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                              <textarea class="frm-msg" name="message" id="frm-msg" placeholder="Enter Your Message"></textarea>
                                        </div>
                                    </div>   
                                           
                                    <div class="row-fluid-form row">
                                        <div class="col-xs-12 col-md-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                        <button type="submit" class="btn-enquiry">Send</button>
                                        </div>
                                    </div>  
                                     </form>

                                </div>
                            </div>
                            </div>-->
                            </div>
                        </div>
                        <div class="col-xs-12 col-sm-4 col-md-4 sidebarDesktop-only">
                        <?php get_sidebar(); ?>
                        </div>
                    </div>
                    </div>
                </div>
            </div>
             
        </section>
    </main>
    
  <!--  <script>
document.getElementById("btn-send-dis123").disabled = true;
function enableBtn(){
  document.getElementById("btn-send-dis123").disabled = false;
}
</script>-->
<?php
get_footer();