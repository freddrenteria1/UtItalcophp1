<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os119 WHERE ods='$ods' AND tag  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'datos'=>$obj->datos,
        'datosinspeccion'=>$obj->datosinspeccion,
        'fotoinicial'=>$obj->fotoinicial,
        'fotofinal'=>$obj->fotofinal,
        'observaciones'=>$obj->observaciones,
        'firmas'=>$obj->firmas,
        'doc'=>$obj->doc
    );


echo json_encode($datos);