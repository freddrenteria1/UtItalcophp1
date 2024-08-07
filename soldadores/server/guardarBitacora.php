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

$sql = "SELECT * FROM bitacora WHERE $doc = $doc AND fecha='$fecha' AND ods = '$ods'";
$exito = mysqli_query($conexion, $sql);

$enc = mysqli_num_rows($exito);

if($enc == 0){
    $query = "INSERT INTO bitacora VALUES('', '$fecha', '$nombres', $doc, '$turno', $pdir, $pindir,'$permiso', '$equipos', '$aspectos', '$novedades', '$ods')";
    $eje = mysqli_query($conexion, $query);
}else{
    $query = "UPDATE bitacora SET turno = '$turno', pdir = $pdir, pindir = $pindir, permiso = '$permiso', equipos = '$equipos', aspectos = '$aspectos', novedades = '$novedades' WHERE $fecha = '$fecha' AND $doc = $doc AND ods = '$ods'";
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


// if(!$mail->send()){
//     $msn = 'Email de confirmación no fue enviado...';
// }else{
//     $msn = 'Ok';
// }

$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);