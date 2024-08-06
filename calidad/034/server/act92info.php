<?php
// header('Content-type: application/json; charset=utf8');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$serie = $_POST["serie"];
$equipo = $_POST["equipo"];
$marca = $_POST["marca"];
$serie_numero = $_POST["serie_numero"];
$tension_aplicada = $_POST["tension_aplicada"];
$fecha_calibracion = $_POST["fecha_calibracion"];

$msn = 'Ok';

$sql = "UPDATE os92 SET serie='$serie', equipo='$equipo', marca='$marca', serie_numero='$serie_numero', tension_aplicada='$tension_aplicada', fecha_calibracion='$fecha_calibracion' WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);


if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);