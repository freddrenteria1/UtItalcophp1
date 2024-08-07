<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$item = $_POST["item"];
$codigo = $_POST["codigo"];
$entregable = $_POST["entregable"];
$elabora = $_POST["elabora"];
$start = $_POST["start"];
$finish = $_POST["finish"];

$sql = "UPDATE hitoshse SET item = item + 1 WHERE item >= $item";
$ejec = mysqli_query($conexion, $sql);

$query = "INSERT INTO hitoshse VALUES('', $item, '$codigo', '$entregable', '$elabora', 'Programado', '$start', '$finish', '', '')";
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