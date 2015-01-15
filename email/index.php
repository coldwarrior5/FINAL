<?php
$user = 'opp_user@outlook.com';
$pass = 'dummy12!';
$host = 'pop-mail.outlook.com';

// Connect to the pop3 email inbox belonging to $user
// If you need SSL remove the novalidate-cert section
$con = imap_open('{pop-mail.outlook.com:995/pop3/ssl/novalidate-cert}INBOX', $user, $pass);


$MC = imap_check($con); 

// Get the number of emails in inbox
$range = "1:".$MC->Nmsgs; 

// Retrieve the email details of all emails from inbox
$response = imap_fetch_overview($con,$range); 

// displays basic email info such as from, to, date, subject etc...
foreach ($response as $msg) {

        echo '<pre>';
        var_dump($msg);
        echo '</pre><br>-----------------------------------------------------<br>';
}
?>