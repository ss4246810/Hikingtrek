<?php
/**
 * START SESSION IF NOT ALREADY STARTED
 */
if (!session_id()) {
    session_start();
}
/**
 * RESPONSE GENERATION FUNCTION
 */
$response = "";

//response messages
$missing_content = "Please supply all the required information.";
$submitted_msg = "Thanks! The form has been submitted and is under review.";
$not_submitted_msg = "Unable to submit form. Try Again.";

//function to generate response
function ht_form_generate_response($type, $message)
{
    global $response;

    if ($type == "success") {
        $response = "<div class='success'>{$message}</div>";
    } else {
        $response = "<div class='error'>{$message}</div>";
    }

}

/**
 * PROCESSING ENQUIRY FORM
 */
if (isset($_POST['action']) && $_POST['action'] == 'booking_submit') {
    session_start();
    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
   
    //response messages
    $missing_content = "Please supply all information.";
    $email_invalid = "Email Address Invalid.";
    $message_unsent = "Message was not sent. Try Again.";
    //$message_captcha = "The security code you typed does not match. Please, try again.";
    $message_sent ="Your message has been sent, Successfully !<br>
Thank you so much for your kind E-mail inquiry of this trip, we will back to you with all details as soon as possible, if you do not receive any reply within 24 hour, there might be some technical problem. Please Email us at gurungdhanee@gmail.com. See you soon in your dream land NEPAL ALSACE TREKS & EXPEDITION Your Holiday Partner";
    //if(isset($_POST["security_captcha"]) && $_POST["security_captcha"]!="" && $_SESSION["security_code"]==$_POST["security_captcha"]){
    //user posted variables
    $trip_name = wp_strip_all_tags($_POST['trip_name']);
    $fname = wp_strip_all_tags($_POST['firstName']);
    $email = wp_strip_all_tags($_POST['email']);
    //$country = wp_strip_all_tags($_POST['fcountry']);
    //$npax = wp_strip_all_tags($_POST['npax']);
    //$available_date = wp_strip_all_tags($_POST['available_date']);
    //$departure_date = wp_strip_all_tags($_POST['departure_date']);
    $message = wp_strip_all_tags($_POST['message']);
    $subject = "Booking Form";
    $body = "Trip Name: $trip_name \n\nName: $fname \n\nEmail: $email \n\nMessage: $message";
   //php mailer variables
    $to = 'gurungdhanee@hotmail.com,gurungdhanee@gmail.com';
    $subject = "Someone sent a message from " . get_bloginfo('name');
    $headers = 'From: '.$fname. '<'.$email.'>' . "\r\n" .
        'Reply-To: ' . $email . "\r\n";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        ht_form_generate_response("error", $email_invalid);
    } elseif (empty($fname) || empty($email) || empty($subject) || empty($message)) {
        ht_form_generate_response("error", $missing_content);
    } else {
        //validate presence of name and message
        $sent = wp_mail($to, $subject, $body, $headers);
        if ($mail->Send()) ht_form_generate_response("success", $message_sent); //message sent!
        else ht_form_generate_response("error", $message_unsent); //message wasn't sent
    }  
    /*} else {
         ht_form_generate_response("error", $message_captcha);
    }*/
    global $response;
    $_SESSION['c_response'] = $response;
}


/**
 * PROCESSING CONTACT FORM
 */
if (isset($_POST['action']) && $_POST['action'] == 'contact_submit') {
    session_start();
    //response messages
    $missing_content = "Please supply all information.";
    $email_invalid = "Email Address Invalid.";
    $message_unsent = "Message was not sent. Try Again.";
    $message_sent ="Your message has been sent, Successfully !<br>
Thank you so much for your kind E-mail, we will back to you with all details as soon as possible, if you do not receive any reply within 24 hour, there might be some technical problem. Please Email us at gurungdhanee@gmail.com. See you soon in your dream land NEPAL ALSACE TREKS & EXPEDITION Your Holiday Partner";
    $fname = wp_strip_all_tags($_POST['firstName']);
    $email = wp_strip_all_tags($_POST['email']);
    $message = wp_strip_all_tags($_POST['message']);
    $subject = "Contact Form";
    $body = "Name: $fname \n\nEmail: $email \n\nMessage: $message";
    $to = 'gurungdhanee@hotmail.com,gurungdhanee@gmail.com';
    $headers = 'From: '.$fname. '<'.$email.'>' . "\r\n" .
        'Reply-To: ' . $email . "\r\n";
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        ht_form_generate_response("error", $email_invalid);
    } elseif (empty($fname) || empty($email) || empty($subject) || empty($message)) {
        ht_form_generate_response("error", $missing_content);
    } else {
        $sent = wp_mail($to, $subject, $body, $headers);
        if ($sent) ht_form_generate_response("success", $message_sent); //message sent!
        else ht_form_generate_response("error", $message_unsent); //message wasn't sent
    }  
    global $response;
    $_SESSION['c_response'] = $response;
}

/**
 * REDIRECT BACK TO WHERE THE REQUEST CAME FROM AFTER PROCESSING THE FORM
 */
if (isset($_SERVER['HTTP_REFERER'])) {
    header('Location: ' . $_SERVER['HTTP_REFERER']);
} else {
    header('Location: ' . home_url());
}