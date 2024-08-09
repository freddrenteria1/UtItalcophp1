<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os127 WHERE ods='$ods' AND tag  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'ods'=>$obj->ods,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'datosantesmtto'=>$obj->datosantesmtto,
        'equipos'=>$obj->equipos,
        'datosdespuesmtto'=>$obj->datosdespuesmtto,
        'fotos'=>$obj->fotos,
        'firmas'=>$obj->firmas,
        'doc'=>$obj->doc
    );


echo json_encode($datos);