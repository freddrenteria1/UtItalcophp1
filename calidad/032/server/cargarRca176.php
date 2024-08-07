<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os176 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'familia'=>$obj->familia,
        'tag'=>$obj->tag,
        'fecha'=>$obj->fecha,
        'serie'=>$obj->serie,
        'info'=>$obj->info,
        'inspeccion'=>$obj->inspeccion,
        'firmasinsp'=>$obj->firmasinsp,
        'hallazgos'=>$obj->hallazgos,
        'informe'=>$obj->informe,
        'firmasinf'=>$obj->firmasinf,
        'entrega'=>$obj->entrega
    );


echo json_encode($datos);