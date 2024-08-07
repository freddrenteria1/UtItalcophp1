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
$cuerpos = $_POST["cuerpos"];

$msn = 'Ok';

$sql = "UPDATE os21 SET servicio='$servicio', cuerpos = '$cuerpos' WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);