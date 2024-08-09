<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os84 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'unidad'=>$obj->unidad,
        'tag'=>$obj->tag,
        'datosprueba'=>$obj->datosprueba,
        'observaciones'=>$obj->observaciones,
        'firmasverificacion'=>$obj->firmasverificacion,
        'doc'=>$obj->doc
    );


echo json_encode($datos);