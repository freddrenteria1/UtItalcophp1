<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$sql="SELECT * FROM os126 WHERE ods='$ods' AND num  like '%$tag%'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'ods'=>$obj->ods,
        'unidad'=>$obj->unidad,
        'num'=>$obj->num,
        'info'=>$obj->info,
        'datoscircuito'=>$obj->datoscircuito,
        'datosmedidas'=>$obj->datosmedidas,
        'datoscambio'=>$obj->datoscambio,
        'datoslista'=>$obj->datoslista,
        'observaciones'=>$obj->observaciones,
        'firmas'=>$obj->firmas,
        'doc'=>$obj->doc
    );


echo json_encode($datos);