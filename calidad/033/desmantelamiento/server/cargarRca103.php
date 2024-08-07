<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os103 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tipo'=>$obj->tipo,
        'tag'=>$obj->tag,
        'material'=>$obj->material,
        'servicio'=>$obj->servicio,
        'permiso'=>$obj->permiso,
        'limp_zona1'=>$obj->limp_zona1,
        'limp_zona2'=>$obj->limp_zona2,
        'limp_zona3'=>$obj->limp_zona3,
        'eje_zona1'=>$obj->eje_zona1,
        'eje_zona2'=>$obj->eje_zona2,
        'eje_zona3'=>$obj->eje_zona3,
        'liberacion'=>$obj->liberacion,
        'prueba_comp'=>$obj->prueba_comp,
        'prueba_zona1'=>$obj->prueba_zona1,
        'prueba_zona2'=>$obj->prueba_zona2,
        'prueba_zona3'=>$obj->prueba_zona3,
        'prueba_zona4'=>$obj->prueba_zona4,
        'prueba_zona5'=>$obj->prueba_zona5,
        'prueba_zona6'=>$obj->prueba_zona6,
        'cierre'=>$obj->cierre,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);