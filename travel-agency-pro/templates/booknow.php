<?php
/**
 * Template Name: Book Now
 * 
 * @package Travel_Agency_Pro
 */
 if (!session_id()) {
    session_start();
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;
require_once(\ABSPATH . \WPINC . "/PHPMailer/PHPMailer.php");
require_once(\ABSPATH . \WPINC . "/PHPMailer/Exception.php");       
require_once(\ABSPATH . \WPINC . "/PHPMailer/SMTP.php");
if(isset($_POST['submit'])){
   function smtpmailer($to, $from, $from_name, $subject, $body)
    {
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true; 
        $mail->SMTPSecure = 'none'; 
        $mail->Host = 'mail.hikingtrek.com';
        $mail->Port = 25;  
        $mail->Username = 'info@hikingtrek.com';
        $mail->Password = 'gurung2022dai';   
   
        $mail->IsHTML(true);
        $mail->From="info@hikingtrek.com";
        $mail->FromName=$from_name;
        $mail->Sender=$from;
        $mail->AddReplyTo($_POST['email'], $from_name);
        $mail->Subject = $subject;
        $mail->Body = $body;
        $mail->AddAddress($to);
         if(!$mail->Send())
        {
            $error ="Unable to submit form. Try Again.";
            return $error; 
        }
        else 
        {
            $error = "Your message has been sent, Successfully !<br>
Thank you so much for your kind E-mail inquiry of this trip, we will back to you with all details as soon as possible, if you do not receive any reply within 24 hour, there might be some technical problem. Please Email us at gurungdhanee@gmail.com. See you soon in your dream land NEPAL ALSACE TREKS & EXPEDITION Your Holiday Partner";  
            return $error;
        }
    }
    
    $to   = "gurungdhanee@gmail.com";
    //$to = "gurungdhanee@hotmail.com";
    //$from = $_POST['email'];
    $from = $mail->From;
    $name = $_POST['firstName'];
    $subj = 'Trip Booking Form';
    $msg="Trip Name:  ".$_POST['trip_name']."<br>";
    $msg.="Email :  ".$_POST['email']."<br>";
    $msg.="Message : ".$_POST['message'];

    $error=smtpmailer($to,$from, $name ,$subj, $msg);
}
/**
 * SET RESPONSE VARIABLE WITH SESSION RESPONSE AND UNSET THE SESSION RESPONSE
 */
if (isset($error)) {
    $c_response = $error;
} else {
    $c_response = '';
}


get_header(); 

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
                <div class="container">
                    <div class="row">
                        <div class="booking-form-container">
                        <?php if(isset($_REQUEST['tripid'])) { 
                  $postid=encrypt_decrypt('decrypt',$_REQUEST['tripid']); 
                  $triptitle=get_the_title($postid);
                    } else {
                       $triptitle=''; 
                    }
                  ?>
                            <h2>Book form for <?php echo $triptitle; ?></h2>
                                <p>Please fill the form below :</p>
                            <div class="col-xs-12 col-md-8 col-xs-push-2">
                                        <?php echo $c_response; ?>

                                <div class="process-box">

                               <!-- <form action="<?php echo get_admin_url(). 'admin-post.php' ?>" method="post" id="contact-form">-->
                               <form action="" method="post" id="contact-form">
                                     <input type='hidden' name='action' value='booking_submit' />
                                       <div class="row-fluid-form row">
                                            <div class="col-xs-12 col-md-4">
                                                <label>Trip Name :</label>
                                            </div>
                                            <div class="col-xs-12 col-md-8">
                                            <input type="text" name="trip_name" value="<?php echo $triptitle; ?>" placeholder="Your Name" readonly />
                                               
                                            </div>
                                        </div>
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
                                                <input name="email" type="email" id="email" required="" placeholder="Email">
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
                                            <!--<div class="row-fluid-form row">
                                        <div class="col-xs-12 col-md-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                            <img src="<?php bloginfo('template_url');?>/captcha/captcha.php" id="captchaimage2" />
                                             <input type="text" name="security_captcha" id="security_captcha" class="frmElements" value="" required placeholder="Enter Security Captcha">
                                               <div class="g-recaptcha" data-sitekey="6Ld9W18UAAAAAJoWu1u2pTbJwtVyIdvFIqnopnJZ" data-callback="enableBtn"></div>
                                        </div>
                                    </div>-->   
                                    <div class="row-fluid-form row">
                                        <div class="col-xs-12 col-md-4">
                                            &nbsp;
                                        </div>
                                        <div class="col-xs-12 col-md-8">
                                        <button type="submit" name="submit" class="btn-enquiry">Send</button>
                                        </div>
                                    </div>  
                                     </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
        </section>
    </main>
<?php
get_footer();