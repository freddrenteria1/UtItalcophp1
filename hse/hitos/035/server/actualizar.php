<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];
$codigo = $_POST["codigo"];
$entregable = $_POST["entregable"];
$elabora = $_POST["elabora"];
$start = $_POST["start"];
$finish = $_POST["finish"];
$estado = $_POST["estado"];

$query = "UPDATE hitoshse SET codigo = '$codigo', entregable='$entregable', elabora='$elabora', estado = '$estado', start='$start', finish='$finish' WHERE id=$id";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);