<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os160 WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'contrato'=>$obj->contrato,
        'unidad'=>$obj->unidad,
        'planta'=>$obj->planta,
        'ods'=>$obj->ods,
        'familia'=>$obj->familia,
        'tag'=>$obj->tag,
        'info'=>$obj->info,
        'datoscampo'=>$obj->datoscampo,
        'datosprueba'=>$obj->datosprueba,
        'firmadatos'=>$obj->firmadatos,
        'estadoinicial'=>$obj->estadoinicial,
        'estadofinal'=>$obj->estadofinal,
        'observaciones'=>$obj->observaciones,
        'doc'=>$obj->doc
    );


echo json_encode($datos);