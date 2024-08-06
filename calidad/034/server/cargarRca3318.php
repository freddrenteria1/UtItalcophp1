<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $ods = $_POST["ods"];
// $tag = $_POST["tag"];

$sql="SELECT * FROM os3318";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'tag'=>$obj->tag,
        'material'=>$obj->material,
        'planta'=>$obj->planta,
        'orientacion'=>$obj->orientacion,
        'ods'=>$obj->ods,
        'equipo'=>$obj->equipo,
        'servicio'=>$obj->servicio,
        'ejecucion'=>$obj->ejecucion,
        'prueba'=>$obj->prueba,
        'prueba2'=>$obj->prueba2,
        'cierre'=>$obj->cierre,
        'ajustes'=>$obj->ajustes,
        'terminacion'=>$obj->terminacion,
        'arranque'=>$obj->arranque,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);