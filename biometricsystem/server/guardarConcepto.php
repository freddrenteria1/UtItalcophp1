<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$codconcepto = $_POST["codconcepto"];
$detconcepto = $_POST["detconcepto"];

$query = "INSERT INTO conceptos VALUES('', '$codconcepto', '$detconcepto')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);