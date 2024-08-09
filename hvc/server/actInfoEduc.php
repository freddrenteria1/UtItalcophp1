<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$doc = $_POST["doc"];

$arrayDataNivelEdu = $_POST["arrayDatosNivelEdu"];

$sql = "UPDATE infobasica SET niveleducativo = '$arrayDataNivelEdu' WHERE doc = '$doc'";
$exito = mysqli_query($conexion, $sql);

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);