<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$dias = $_POST["dias"];
$finicio = $_POST["finicio"];

$sql="UPDATE info SET dias = $dias, finicio='$finicio' ";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);