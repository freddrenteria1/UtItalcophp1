<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM hitoshse order by item ASC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[] = array(
        'item'=>$obj->item,
        'id'=>$obj->id,
        'codigo'=>$obj->codigo,
        'entregable'=>$obj->entregable,
        'elabora'=>$obj->elabora,
        'estado'=>$obj->estado,
        'start'=>$obj->start,
        'finish'=>$obj->finish,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc,
        'ok'=>true
    );

}

echo json_encode($datos);