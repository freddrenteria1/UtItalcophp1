<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$codcargo = $_POST["codsub"];
$empresasub = $_POST["empresasub"];

$query = "INSERT INTO subcontratistas VALUES('', '$codcargo', '$empresasub')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);