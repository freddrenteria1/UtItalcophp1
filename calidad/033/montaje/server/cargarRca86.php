<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os86 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'familia'=>$obj->familia,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'entcustodia'=>$obj->entcustodia,
        'items'=>$obj->items,
        'obscustodia'=>$obj->obscustodia,
        'estadoinicial'=>$obj->estadoinicial,
        'estadofinal'=>$obj->estadofinal,
        'doccustodia'=>$obj->doccustodia,
        'infocal'=>$obj->infocal,
        'datoscal'=>$obj->datoscal,
        'itemscal'=>$obj->itemscal,
        'datosprueba'=>$obj->datosprueba,
        'itemsprueba'=>$obj->itemsprueba,
        'equipos'=>$obj->equipos,
        'obscal'=>$obj->obscal,
        'doccal'=>$obj->doccal
    );


echo json_encode($datos);