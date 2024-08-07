<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$turno = $_POST["turno"];
$fecha = $_POST["fecha"];
$pdir = $_POST["pdir"];
$pindir = $_POST["pindir"];
$permiso = $_POST["permiso"];
$equipos = $_POST["equipos"];
$aspectos = $_POST["aspectos"];
$novedades = $_POST["novedades"];

$msn = '0k';

$sql = "SELECT * FROM bitacora WHERE doc = $doc AND fecha='$fecha' AND ods = '$ods'";
$exito = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc == 0){
    $query = "INSERT INTO bitacora VALUES('', '$fecha', '$nombres', $doc, '$turno', $pdir, $pindir,'$permiso', '$equipos', '$aspectos', '$novedades', '$ods')";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "UPDATE bitacora SET turno = '$turno', pdir = $pdir, pindir = $pindir, permiso = '$permiso', equipos = '$equipos', aspectos = '$aspectos', novedades = '$novedades' WHERE fecha = '$fecha' AND doc = $doc AND ods = '$ods'";
    $eje = mysqli_query($conexion, $query);
}



if(!$eje){
    $msn = mysqli_error($conexion);
}

$texto = 'Registro de Bitacora por ' . $nombres . ' con los siguientes datos: <br><br>';

$texto .= 'Datos del registro: <br><br>';
$texto .= 'Fecha: ' . $fecha . '<br>';
$texto .= 'Turno: ' . $turno . '<br>';
$texto .= 'Personal Directo: ' . $pdir . '<br>';
$texto .= 'Personal Indirecto: ' . $pindir . '<br>';
$texto .= 'Permiso #: ' . $permiso . '<br>';
$texto .= 'Equipos: ' . $equipos . '<br>';
$texto .= 'Aspectos relevantes: ' . $aspectos . '<br>';
$texto .= 'Novedades del turno: ' . $novedades . '<br>';


ini_set( 'display_errors', 1 );
    error_reporting( E_ALL );

    $para  = 'hseomcj@gmail.com';

    // Asunto
    $titulo = 'Registro en bitacora HSE UT Italco';

    // Cuerpo o mensaje
    $mensaje = '
    <html>
    <head>
    <title>Registro en bitacora HSE UT Italco</title>
    </head>
    <body>
    <img src="https://utitalco.com/hv/img/logo_m.png" width="200px">
     <p>' . $texto  . ' <br><br>
    
       

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
    $cabeceras .= 'From: Soporte UT Italco <soporte@utitalco.com>' . "\r\n";


    // enviamos el correo!
    mail($para, $titulo, $mensaje, $cabeceras);


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);