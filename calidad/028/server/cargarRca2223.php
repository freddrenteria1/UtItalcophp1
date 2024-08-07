<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2223 WHERE ods='$ods' AND tag = '$tag'";
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
        'limpieza_zona1'=>$obj->limpieza_zona1,
        'limpieza_zona2'=>$obj->limpieza_zona2,
        'limpieza_zona3'=>$obj->limpieza_zona3,
        'ejecucion_exterior'=>$obj->ejecucion_exterior,
        'ejecucion_zona1'=>$obj->ejecucion_zona1,
        'ejecucion_zona2'=>$obj->ejecucion_zona2,
        'ejecucion_zona3'=>$obj->ejecucion_zona3,
        'liberacion_zona1_int'=>$obj->liberacion_zona1_int,
        'liberacion_zona1_ext'=>$obj->liberacion_zona1_ext,
        'liberacion_zona2_int'=>$obj->liberacion_zona2_int,
        'liberacion_zona2_ext'=>$obj->liberacion_zona2_ext,
        'liberacion_zona3_int'=>$obj->liberacion_zona3_int,
        'liberacion_zona3_ext'=>$obj->liberacion_zona3_ext,
        'prueba_goteo'=>$obj->prueba_goteo,
        'armado'=>$obj->armado,
        'cierre'=>$obj->cierre,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);