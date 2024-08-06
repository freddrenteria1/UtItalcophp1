<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$id = $_POST["id"];
$vbitalco = $_POST["vbitalco"];
$vbecop = $_POST["vbecop"];

$query = "UPDATE userbio SET voboitalco = '$vbitalco', voboecp = '$vbecop' WHERE id=$id";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);