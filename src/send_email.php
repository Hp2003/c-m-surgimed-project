<?php
require_once './lib/PHPMailer/src/PHPMailer.php';
require_once './lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;


// Sending email to user
function send_email($reciver , $Content){
    $mail = new PHPMailer;

    
    $mail->SMTPKeepAlive = false;
// Server configuring 

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'panchalhirenproj@gmail.com'; // Sender's email
$mail->Password = 'adkvhlhffcdgvfgq';          
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Recipent

$mail->setFrom('hirenpanchal499@gmail.com', 'Mailer');  // sender's email   
$mail->addAddress("$reciver", 'user'); // Reciver's email

// Content part

$mail->isHTML(true);
$mail->Subject = 'Test Email ';
$mail->Body = " $Content";
$mail->AltBody = 'This is alt body';

try{
    $mail->send();
    return 1;
}catch(Exception $e){
    return 0;
}
}



?>