<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os92 WHERE ods='$ods' AND tag = '$tag'";
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
        'serie'=>$obj->serie,
        'equipo'=>$obj->equipo,
        'marca'=>$obj->marca,
        'serie_numero'=>$obj->serie_numero,
        'tension_aplicada'=>$obj->tension_aplicada,
        'fecha_calibracion'=>$obj->fecha_calibracion,
        'tiempo_prueba'=>$obj->tiempo_prueba,
        'tipo_cable'=>$obj->tipo_cable,
        'potencia'=>$obj->potencia,
        'control'=>$obj->controlp,
        'datosprueba'=>$obj->datosprueba,
        'observaciones'=>$obj->observaciones,
        'firmas'=>$obj->firmas
    );


echo json_encode($datos);