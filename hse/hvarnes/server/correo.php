<?php
header('Access-Control-Allow-Origin: *');

require 'PHPMailer/PHPMailerAutoload.php';

$mail = new PHPMailer;
$mail->isSMTP();
$mail->Host='smtp.gmail.com';
$mail->Port=587;
$mail->SMTPAuth=true;
$mail->SMTPSecure='tls';
$mail->Username='jairocruzprogramador@gmail.com';
$mail->Password='@3142141645';

$mail->setFrom('bitacoras@utitalco.tk','Sistema Bitacoras');
$mail->addAddress('jairocruzprogramador@gmail.com');
$mail->addBCC('jairocruzprogramador@gmail.com');

$mail->CharSet = 'UTF-8';

$mail->isHTML(true);
$mail->Subject='Reporte Bitacora HSE UT Italco';
$mail->Body='Prueba de correo';

if(!$mail->send()){
    $msn = 'Email de confirmación no fue enviado...' .  $mail->ErrorInfo;;
}else{
    $msn = 'Ok';
}

echo $msn;