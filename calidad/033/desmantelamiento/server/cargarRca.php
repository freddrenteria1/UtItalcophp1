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
        'serie'=>$obj->serie,
        'fecha'=>$obj->fecha,
        'marca'=>$obj->marca,
        'modelo'=>$obj->modelo,
        'servicio'=>$obj->servicio,
        'pmedicion'=>$obj->pmedicion,
        'rango'=>$obj->rango,
        'eprimario'=>$obj->eprimario,
        'cualelepri'=>$obj->cualelepri,
        'undinge'=>$obj->undinge,
        'sistcal'=>$obj->sistcal,
        'manifold'=>$obj->manifold,
        'tipotrans'=>$obj->tipotrans,
        'tipoelepri'=>$obj->tipoelepri,
        'conexionproc'=>$obj->conexionproc,
        'tiporificio'=>$obj->tiporificio,
        'entcustodia'=>$obj->entcustodia,
        'fechaentcustodia'=>$obj->fechaentcustodia,
        'items'=>$obj->items,
        'revitems'=>$obj->revitems,
        'observaciones'=>$obj->observaciones,
        'revestinicial'=>$obj->revestinicial,
        'revestfinal'=>$obj->revestfinal
    );


echo json_encode($datos);