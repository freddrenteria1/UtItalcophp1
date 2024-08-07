<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql = "SELECT * FROM ordensalida Where id=$id";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'almacen'=>$obj->almacen,
        'ods'=>$obj->ods,
        'ubicacion'=>$obj->ubicacion,
        'items'=>$obj->items,
        'observaciones'=>$obj->observaciones
    );
}

echo json_encode($datos);