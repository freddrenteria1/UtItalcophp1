<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os2804 WHERE ods='$ods' AND tag = '$tag'";
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
        'instalacion'=>$obj->instalacion,
        'ejecucion'=>$obj->ejecucion,
        'liberacion'=>$obj->liberacion,
        'limpieza_cabezal'=>$obj->limpieza_cabezal,
        'limp_cond_cabezal'=>$obj->limp_cond_cabezal,
        'limp_tapones'=>$obj->limp_tapones,
        'instalacion_tapones'=>$obj->instalacion_tapones,
        'torque'=>$obj->torque,
        'items_prueba'=>$obj->items_prueba,
        'prueba_serpentin1'=>$obj->prueba_serpentin1,
        'prueba_serpentin2'=>$obj->prueba_serpentin2,
        'cierre_int'=>$obj->cierre_int,
        'cierre_tapas'=>$obj->cierre_tapas,
        'terminacion'=>$obj->terminacion,
        'pintura'=>$obj->pintura,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);