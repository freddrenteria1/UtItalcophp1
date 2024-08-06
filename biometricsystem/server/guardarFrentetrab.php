<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$frentetrab = $_POST["frentetrab"];
$liderecp = $_POST["liderecp"];
$ods = $_POST["ods"];

$query = "INSERT INTO frentestrab VALUES('', '$frentetrab','$ods','$liderecp')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);