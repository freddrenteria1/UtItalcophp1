<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$servicio = $_POST["servicio"];
$material = $_POST["material"];

$msn = 'Ok';

$sql = "UPDATE os2228 SET servicio='$servicio', material = '$material' WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);