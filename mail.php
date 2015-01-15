<?php
header('Content-Type: application/javascript');
$callback=filter_input(INPUT_GET, 'callback');
$email=filter_input(INPUT_GET, 'email');
$name=filter_input(INPUT_GET, 'name');
$message=filter_input(INPUT_GET, 'message');
$response = filter_input(INPUT_GET, 'response');
$secret_key = '6LcjUQATAAAAAA12Wd1eQcY6OQXmRc28zZyhmKF4';
if(isset($email)) {
    // CHANGE THE TWO LINES BELOW
    $email_to = "opp_user@outlook.com";
     
    $email_subject = "Client communication";
     
    function died($err) {
        // your error code can go here
        global $callback;
        echo $callback."({ status : \"".$err."\" })";
        die();
    }
     
    // validation expected data exists
    if(!isset($name) || !isset($email) || !isset($message)) {
        died("Svi podatci nisu ispunjeni");    
    }
    
    if(!isset($response)){
        died("Niste ispunili captcha");
    }
    
    $return=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secret_key."&response=".$response);
    $answers = json_decode($return, true);
    
      if (trim($answers ['success']) == false){
        die("Niste ispravno unjeli captcha");
    }
    
    $error_message = "";
    $email_exp = '/^[A-Za-z0-9._%-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,4}$/';
    if(!preg_match($email_exp,$email)) {
        $error_message .= 'Email adresa nije ispravna.';
    }
    $string_exp = "/^[A-Za-z .'-]+$/";
    if(!preg_match($string_exp,$name)) {
        $error_message .= 'Ime nije ispravno.';
    }
    if(strlen($error_message) > 0) {
        died($error_message);
    }
    $email_message = "Form details below.\n\n";
     
    function clean_string($string) {
        $bad = array("content-type","bcc:","to:","cc:","href");
        return str_replace($bad,"",$string);
    }
     
    $email_message .= "Name: ".clean_string($name)."\n";
    $email_message .= "Email: ".clean_string($email)."\n";
    $email_message .= "Message: ".clean_string($message)."\n";
    $message_to_send = wordwrap($email_message, 70);
     
    // create email headers
    $headers = 'From: '.$email."\r\n".
    'Reply-To: '.$email."\r\n" .
    'X-Mailer: PHP/' . phpversion();
    mail($email_to, $email_subject, $message_to_send, $headers);
    echo $callback."({ status : \"OK\" })";
}
die();