<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$tipodoc = $_POST["tipodoc"];
$doc = $_POST["doc"];
$email = $_POST["email"];
$clave = $_POST["cont1"];
$nombres = $_POST["nombres"];
$fnac = $_POST["fnac"];
$tel = $_POST["tel"];

$cons = "SELECT * FROM registro WHERE doc = '$doc'";
$ejec = mysqli_query($conexion, $cons);

$enc = mysqli_num_rows($ejec);

if($enc == 0){

    $query = "INSERT INTO registro VALUES('', '$fecha', '$tipodoc', '$doc', '$email', '$clave', '$nombres', '$fnac', '$tel')";
    $eje = mysqli_query($conexion, $query);
    
    if(!$eje){
        $ok = false;
    }else{
        $ok = true;
    }
    
    $sql = "INSERT INTO infobasica VALUES('', '$tipodoc', '$doc', '$email', '', '', '', '', '', '', '', '')";
    $exito = mysqli_query($conexion, $sql);

    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = $email;

    // Asunto
    $titulo = 'Registro Hoja de Vida UT Italco';

    // Cuerpo o mensaje
    $mensaje = '
    <html>
    <head>
    <title>Registro Hoja de Vida UT Italco</title>
    </head>
    <body>
    <img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
    <p>Se ha creado su registro en el Sistema de Información Perfil Laboral UT Italco. Debe actualizar los datos de su hoja de vida y adjuntar los documentos requeridos ingresando desde el siguiente link:</p>
    <a href="https://utitalco.com/hv/">https://utitalco.com/hv</a>  <br><br>
    
        Su contraseña de ingreso es: ' .$clave . '
    
        <br><br>
        Recursos Humanos UT Italco


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
    $cabeceras .= 'From: Registro hoja de vida <hojadevida@utitalco.com>' . "\r\n";
    $cabeceras .= 'Reply-To: rhbarranca@vcfauditores.com ';


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);


} else {

}


$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);