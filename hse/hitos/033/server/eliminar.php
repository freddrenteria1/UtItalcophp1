<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$query = "DELETE FROM hitoshse WHERE id=$id";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $ok = false;
}else{
    $ok = true;
}

$query = "UPDATE hitoshse SET id = id-1 WHERE id > $id";
$eje = mysqli_query($conexion, $query);

$datos = array(
    'ok'=>$ok
);

echo json_encode($datos);