<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

$permitted_chars = '0123456789ECO';
function generate_string($input, $strength = 16) {
    $input_length = strlen($input);
    $random_string = '';
    for($i = 0; $i < $strength; $i++) {
        $random_character = $input[mt_rand(0, $input_length - 1)];
        $random_string .= $random_character;
    }
    return $random_string;
}
// Output: iNCHNGzByPjhApvn7XBD 
$codigogen =  generate_string($permitted_chars, 5);

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$user = $_POST["user"];
$clave = $_POST["clave"];

$sql="SELECT * FROM users Where email like '%$user%' And clave = '$clave'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    $obj = mysqli_fetch_object($exito);
    $msn = 'Ok';
    $tipo = $obj->tipo;
    $emaildest = $obj->email;

    $info = array(
        'nombres'=>$obj->nombres,
        'email'=>$obj->email,
        'tipo'=>$obj->tipo,
        'estado'=>$obj->estado,
        'documento'=>$obj->documento,
        'firma'=>$obj->firma,
        'codigo'=>$codigogen
    );


    if($tipo == 'ecopetrol'){
        
        
    ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = $emaildest;

    // Asunto
    $titulo = 'Ingreso Plataforma QAQC ODS 030 - UT Italco';

    // Cuerpo o mensaje
    $mensaje = '
    <html>
    <head>
    <title>Ingreso Plataforma QAQC UT Italco</title>
    </head>
    <body>
    <img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
     <p>Código generado para ingreso a plataforma de calidad de UT Italco: <br><br>
    
     ' .$codigogen . '<br>
        <br><br>
 
    
       
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
    // Cabeceras adicionales
    $cabeceras .= 'From: Ingreso Plataforma QAQC UT Italco <soporte@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);
    
    }

    

}

$datos = array(
    'msn'=>$msn,
    'info'=>$info
);

echo json_encode($datos);