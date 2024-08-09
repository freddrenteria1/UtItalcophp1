<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2211 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tag'=>$obj->tag,
        'permiso'=>$obj->permiso,
        'manhole1'=>$obj->manhole1,
        'manhole2'=>$obj->manhole2,
        'manhole3'=>$obj->manhole3,
        'manhole4'=>$obj->manhole4,
        'faccomp1'=>$obj->faccomp1,
        'faccomp2'=>$obj->faccomp2,
        'faccomp3'=>$obj->faccomp3,
        'faccomp4'=>$obj->faccomp4,
        'faccomp5'=>$obj->faccomp5,
        'faccomp6'=>$obj->faccomp6,
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