<?php
header('Access-Control-Allow-Origin: *');
        
ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$para  = 'jairocruzprogramador@gmail.com';

// Asunto
$titulo = 'Plataforma QAQC ODS 030 - UT Italco';

// Cuerpo o mensaje
$mensaje = '
<html>
<head>
<title>Plataforma QAQC UT Italco</title>
</head>
<body>
<img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
    
    <br><br><br><br>

    <p style="font-size: 9px;">

    ******************** AVISO LEGAL **************************   <br><br>

Este mensaje es solamente para la persona a la que va dirigido. Puede contener información  confidencial  o  legalmente  protegida.  No  hay  renuncia  a la confidencialidad o privilegio por cualquier transmisión mala/errónea. Si usted ha recibido este mensaje por error,  le rogamos que borre de su sistema inmediatamente el mensaje así como todas sus copias, destruya todas las copias del mismo de su disco duro y notifique al remitente.  No debe,  directa o indirectamente, usar, revelar, distribuir, imprimir o copiar ninguna de las partes de este mensaje si no es usted el destinatario. Nótese que el correo electrónico vía Internet no permite asegurar ni la confidencialidad de los mensajes que se transmiten ni la correcta recepción de los mismos. 

</p>

</body>
</html>
    ';

    // Cabecera que especifica que es un HMTL
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
    // Cabeceras adicionales
    $cabeceras .= 'Bcc: jairocruzprogramador@gmail.com' . "\r\n";
    $cabeceras .= 'From: Plataforma QAQC UT Italco <soporte@utitalcobarranca.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);

echo 'Ok';


    
