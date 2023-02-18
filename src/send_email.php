<?php
require_once './lib/PHPMailer/src/PHPMailer.php';
require_once './lib/PHPMailer/src/SMTP.php';

use PHPMailer\PHPMailer\PHPMailer;



// Sending email to user
function send_email($reciver , $Content){
    $mail = new PHPMailer;
// Server configuring 

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hirenpanchal499@gmail.com'; // Sender's email
$mail->Password = 'volsmrrhkjounhdt';          
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Recipent

$mail->setFrom('hirenpanchal499@gmail.com', 'Mailer');  // sender's email   
$mail->addAddress("$reciver", 'user'); // Reciver's email

// Content part

$mail->isHTML(true);
$mail->Subject = 'Test Email ';
$mail->Body = "Test Email for <h1>$Content</h1>";
$mail->AltBody = 'This is alt body';

try{
    // $mail->send();
    return 1;
}catch(Exception $e){
    echo "Message could not sent because of {$mail->ErrorInfo}";
}
}



?>