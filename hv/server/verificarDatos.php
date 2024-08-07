<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");





// Datos personales


$doc = $_POST["doc"];

$sql="SELECT * FROM registro Where doc = '$doc'";
$exito=mysqli_query($conexion, $sql);
$enc = mysqli_num_rows($exito);

if($enc != 0){
    $obj = mysqli_fetch_object($exito);
 
    $clave = $obj->clave;
    $email = $obj->email;
    $nombres = $obj->nombres;


  
    $para  = $email;
   

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
     <br><br>
    
        Usuario: ' .$nombres . '<br>
        Email: ' .$email  . '<br>
        Contraseña: ' .$clave  . ' 
    
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
    $cabeceras .= 'From: soporte UT Italco <soporte@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);
  

    $msn = 'Ok;';
}else{
    $msn = 'Error';
    $info = null;
}


$datos = array(
    'msn'=>$msn
);
 

echo json_encode($datos);