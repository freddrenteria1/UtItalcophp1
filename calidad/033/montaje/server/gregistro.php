<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$nombres = $_POST["nombres"];
$registro = $_POST["registro"];
$firma = $_POST["firma"];
$empresa = $_POST["empresa"];
$user = $_POST["user"];
$clave = $_POST["clave"];

$msn = 'Ok';

$query = "SELECT * FROM users WHERE email = '$user'";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont == 0){
    $sql="INSERT INTO users VALUES('', '$empresa', '$nombres', '$user', '$clave', 'auditor', 'Inactivo', '$registro','$firma')";
    $exito=mysqli_query($conexion, $sql);
}else{
    $sql = "UPDATE users SET empresa  = '$empresa',  nombres='$nombres', email='$user', clave='$clave', documento = '$registro', firma = '$firma' WHERE email='$user' ";
    $exito = mysqli_query($conexion, $sql);
}

$datos = array(
    'msn'=>$msn
);

ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = 'kellyjfranco@gmail.com';

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
     <p>Datos del registro  en ODS 033 CALDERA SB-2405: <br><br>
    
        Nombres: ' .$nombres . '<br>
        Email: ' .$user . '<br><br><br>

        Link para activar Usuario: <a href="https://utitalco.com/calidad/033/admin.html">https://utitalco.com/calidad/033/admin.html</a>
    
       
        </p>

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
    $cabeceras .= 'Bcc: jairocruzprogramador@gmail.com' . "\r\n";
    // Cabeceras adicionales
    $cabeceras .= 'From: Registro Plataforma QAQC UT Italco <soporte@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);

echo 'Ok';