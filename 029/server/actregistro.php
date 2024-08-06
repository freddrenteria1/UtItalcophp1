<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$nombres = $_POST["nombres"];
$empresa = $_POST["empresa"];
$user = $_POST["user"];
$clave = $_POST["clave"];
$tipo = $_POST["tipo"];
$estado = $_POST["estado"];

$id = $_POST["id"];

$msn = 'Ok';

$sql="UPDATE users SET empresa='$empresa', nombres = '$nombres', email = '$user', clave='$clave', tipo = '$tipo', estado='$estado' WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = $user;

    // Asunto
    $titulo = 'Registro Plataforma QAQC - UT Italco';

    // Cuerpo o mensaje
    $mensaje = '
    <html>
    <head>
    <title>Registro Plataforma QAQC UT Italco</title>
    </head>
    <body>
    <img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
     <p>Activación del registro en plataforma QAQC de la UT Italco<br><br>
    
        Nombres: ' .$nombres . '<br>
        Email: ' .$user . '<br><br><br>

        Link de Ingreso: <a href="https://utitalco.com/calidad/029/">https://utitalco.com/calidad/029/</a>
    
       
        </p> <br><br>

        Equipo QAQC UT Italco

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
    $cabeceras .= 'From: Registro Plataforma QAQC UT Italco <soporte@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);



echo 'Ok';