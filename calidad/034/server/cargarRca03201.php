<?php

header('Content-type: application/json');

header('Access-Control-Allow-Origin: *');



include("conectar.php"); 

$conexion=conectar();



date_default_timezone_set("America/Bogota");

$fecha=date("Y-m-d");



$ods = $_POST["ods"];

$tag = $_POST["tag"];



$sql="SELECT * FROM os03201 WHERE ods='$ods' AND tag = '$tag'";

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

        'limpieza_int'=>$obj->limpieza_int,

        'limpieza_ext'=>$obj->limpieza_ext,

        'inspeccion_int'=>$obj->inspeccion_int,

        'inspeccion_ext'=>$obj->inspeccion_ext,

        'liberacion'=>$obj->liberacion,

        'liberacion_int'=>$obj->liberacion_int,

        'liberacion_ext'=>$obj->liberacion_ext,

        'cierrem1'=>$obj->cierrem1,

        'cierrem2'=>$obj->cierrem2,

        'terminacion'=>$obj->terminacion,

        'pintura'=>$obj->pintura,

        'entrega'=>$obj->entrega,

        'observaciones'=>$obj->observaciones,

        'doc'=>$obj->doc

    );





echo json_encode($datos);