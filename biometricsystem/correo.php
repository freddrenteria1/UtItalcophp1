<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer(TRUE);

$mail->isSMTP();
$mail->SMTPAuth = true;
// Datos personales

$mail->Host = "mail.utitalco.com";
$mail->Port = "465";
$mail->Username = "jairo.cruz@utitalco.com";
$mail->Password = "@Aa3043489485";
$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;

// Remitente
$mail->setFrom('jairo.cruz@utitalco.com', 'Soporte UT Italco');
// Destinatario, opcionalmente también se puede especificar el nombre
$mail->addAddress(' jairocruzprogramador@gmail.com ', 'Jairo Cruz');
// Copia
//$mail->addCC('info@example.com');
// Copia oculta
//$mail->addBCC('info@example.com', 'name');


$mail->isHTML(true);
// Asunto
$mail->Subject = 'Ayuda plataforma Hoja de Vida UT Italco';
// Contenido HTML
$mail->Body = 'Usuario: Jairo Enrique Cruz Feria <br>
Email: jairocruzprogramador@gmail.com <br>
Contraseña: 91514108 <br> <br>';

$mail->CharSet = 'UTF-8';
$mail->Encoding = 'base64';


if($mail->send()){
    $msn = 'Ok';
    echo 'Ok;'
}else{
    $msn = 'Error';
    echo 'Error';
}

echo $msn;
