<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ip = $_SERVER['REMOTE_ADDR'];
 
$id = $_POST["id"];

$sql="SELECT * FROM compras Where id = $id";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'proveedor'=>$obj->proveedor,
        'lugarentrega'=>$obj->lugarentrega,
        'lugarobra'=>$obj->lugarobra,
        'destino'=>$obj->destino,
        'lugartransporte'=>$obj->lugartransporte,
        'terminospago'=>$obj->terminospago,
        'observacion'=>$obj->observacion,
        'elaborado'=>$obj->elaborado,
        'items'=>$obj->items,
        'adjunto'=>$obj->adjunto,
        'estado'=>$obj->estado
    );
}

echo json_encode($datos);