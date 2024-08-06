<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$codigoturno = $_POST["codigoturno"];
$hinicial = $_POST["hinicial"];
$hfinal = $_POST["hfinal"];

$query = "INSERT INTO codturnos VALUES('', '$codigoturno', '$hinicial', '$hfinal')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);