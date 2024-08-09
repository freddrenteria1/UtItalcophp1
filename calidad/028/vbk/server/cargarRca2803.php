<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2803 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tipo'=>$obj->tipo,
        'tag'=>$obj->tag,
        'servicio'=>$obj->servicio,
        'material'=>$obj->material,
        'permiso'=>$obj->permiso,
        'limpieza_exterior'=>$obj->limpieza_exterior,
        'limpieza_interior'=>$obj->limpieza_interior,
        'ejecucion_exterior'=>$obj->ejecucion_exterior,
        'ejecucion_interior'=>$obj->ejecucion_interior,
        'liberacion_interior'=>$obj->liberacion_interior,
        'mantenimiento'=>$obj->mantenimiento,
        'liberacion_partes'=>$obj->liberacion_partes,
        'prueba_pesa'=>$obj->prueba_pesa,
        'cierre_manhol1'=>$obj->cierre_manhol1,
        'cierre_manhol2'=>$obj->cierre_manhol2,
        'torque'=>$obj->torque,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);