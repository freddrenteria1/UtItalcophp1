<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM inspecciones";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id'=>$obj->id,
        'placa'=>$obj->placa,
        'fecha'=>$obj->fecha,
        'doccond'=>$obj->doccond,
        'conductor'=>$obj->conductor,
        'ods'=>$obj->ods,
        'planta'=>$obj->planta,
        'kilo'=>$obj->kilo,
        'items'=>$obj->items,
        'firma'=>$obj->firma,
        'fotoPD'=>$obj->fotoPD,
        'fotoPP'=>$obj->fotoPP,
        'fotoLD'=>$obj->fotoLD,
        'fotoLI'=>$obj->fotoLI,
        'observaciones'=>$obj->observaciones,
    );

}



echo json_encode($datos);