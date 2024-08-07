<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2209 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tipo'=>$obj->tipo,
        'tag'=>$obj->tag,
        'etipo'=>$obj->etipo,
        'servicio'=>$obj->servicio,
        'num_tubos'=>$obj->num_tubos,
        'permiso'=>$obj->permiso,
        'limpieza'=>$obj->limpieza,
        'ejecucion'=>$obj->ejecucion,
        'liberacion'=>$obj->liberacion,
        'cierre'=>$obj->cierre,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);