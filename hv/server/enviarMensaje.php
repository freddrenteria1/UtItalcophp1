<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$email = $_POST["email"];
$nombres = $_POST["nombres"];
$mensaje = $_POST["mensaje"];

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = 'jairo.italco@gmail.com';

    // Asunto
    $titulo = 'Ayuda plataforma Hoja de Vida UT Italco';

    // Cuerpo o mensaje
    $mensaje = '
    <html>
    <head>
    <title>Ayuda Plataforma Hoja de Vida UT Italco</title>
    </head>
    <body>
    <img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
     <p>' . $mensaje  . ' <br><br>
    
        Usuario: ' .$nombres . '<br>
        Email: ' .$email . '
    
        <br><br>
        Recursos Humanos UT Italco
        </p>

        <br><br><br><br>

        <p style="font-size: 9px;">

        ******************** AVISO LEGAL **************************   <br><br>

    Este mensaje es solamente para la persona a la que va dirigido. Puede contener información  confidencial  o  legalmente  protegida.  No  hay  renuncia  a la confidencialidad o privilegio por cualquier transmisión mala/errónea. Si usted ha recibido este mensaje por error,  le rogamos que borre de su sistema inmediatamente el mensaje así como todas sus copias, destruya todas las copias del mismo de su disco duro y notifique al remitente.  No debe,  directa o indirectamente, usar, revelar, distribuir, imprimir o copiar ninguna de las partes de este mensaje si no es usted el destinatario. Nótese que el correo electrónico vía Internet no permite asegurar ni la confidencialidad de los mensajes que se transmiten ni la correcta recepción de los mismos. En el caso de que el destinatario de este mensaje no consintiera la utilización del correo electrónico vía Internet, rogamos lo ponga en nuestro conocimiento de manera inmediata al correo electrónico: rhbarranca@vcfauditores.com

    </p>

    </body>
    </html>
    ';

    // Cabecera que especifica que es un HMTL
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    // Cabeceras adicionales
    $cabeceras .= 'From: Ayuda Plataforma hoja de vida <hojadevida@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);




$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);