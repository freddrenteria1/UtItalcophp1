<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os96 WHERE ods='$ods' AND tag  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'especialidad'=>$obj->especialidad,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'datospreliminares'=>$obj->datospreliminares,
        'datosrevision'=>$obj->datosrevision,
        'fotoinicial'=>$obj->fotoinicial,
        'fotofinal'=>$obj->fotofinal,
        'datocriterio'=>$obj->datocriterio,
        'observaciones'=>$obj->observaciones,
        'firmas'=>$obj->firmas,
        'doc'=>$obj->doc
    );


echo json_encode($datos);