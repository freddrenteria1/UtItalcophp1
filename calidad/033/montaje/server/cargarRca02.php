<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os02 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);
    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'ods'=>$obj->ods,
        'equipo'=>$obj->equipo,
        'tag'=>$obj->tag,
        'set'=>$obj->set,
        'descarga'=>$obj->descarga,
        'permiso'=>$obj->permiso,
        'mantenimiento'=>$obj->mantenimiento,
        'retiro'=>$obj->retiro,
        'terminacion'=>$obj->terminacion,
        'entrega'=>$obj->entrega,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);