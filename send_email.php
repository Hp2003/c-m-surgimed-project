<?php
require_once 'PHPMailer/src/PHPMailer.php';
require_once 'PHPMailer/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;


$mail = new PHPMailer;
// Server configuring 

$mail->isSMTP();
$mail->Host = 'smtp.gmail.com';
$mail->SMTPAuth = true;
$mail->Username = 'hirenpanchal499@gmail.com';
$mail->Password = 'volsmrrhkjounhdt';
$mail->SMTPSecure = 'tls';
$mail->Port = 587;

// Recipent

$mail->setFrom('hirenpanchal499@gmail.com', 'Mailer');
$mail->addAddress('panchalhirenm123@gmail.com', 'user');

// Content part

$mail->isHTML(true);
$mail->Subject = 'Test Email ';
$mail->Body = 'Test Email for <h1>Application</h1>';
$mail->AltBody = 'This is alt body';

$mail->send();

echo 'email has been sent';

?>