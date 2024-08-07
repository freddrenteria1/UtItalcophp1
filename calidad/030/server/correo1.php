<?php
header('Access-Control-Allow-Origin: *');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->SMTPDebug = 2;
$mail->Host = 'mail.utitalco.com';
$mail->Port = 465;
$mail->SMTPAuth = true;
$mail->Username = 'soporte@utitalco.com';
$mail->Password = '@Aa3043489485';
$mail->setFrom('soporte@utitalco.com', 'Soporte UT Italco');
$mail->addReplyTo('soporte@utitalco.com', 'Soporte UT Italco');
$mail->addAddress('jairocruzprogramador@gmail.com', 'Jairo Cruz');
$mail->Subject = 'Checking if PHPMailer works';

$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';
$mail->isHTML(true);


$mail->Body = 'El texto de tu correo en HTML. Los elementos en <b>negrita</b> también están permitidos.';

$mail->Body = 'This is just a plain text message body';
//$mail->addAttachment('attachment.txt');

if (!$mail->send()) {
    echo 'Mailer Error: ' . $mail->ErrorInfo;
} else {
    echo 'The email message was sent.';
}