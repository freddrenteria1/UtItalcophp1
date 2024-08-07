<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql = "SELECT * FROM devprov Where id=$id";
$exito = mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$datos = array(
    'id'=>$obj->id,
    'fecha'=>$obj->fecha,
    'proveedor'=>$obj->proveedor,
    'ciudad'=>$obj->ciudad,
    'ods'=>$obj->ods,
    'items'=>$obj->items,
    'archivo'=>$obj->archivo,
    'observaciones'=>$obj->observaciones
);

echo json_encode($datos);