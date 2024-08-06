<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM filesp order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $filesp[] = array(
        'id'=>$obj->id,
        'archivo'=>$obj->archivo,
        'fecha'=>$obj->fecha
    );

}

$sql="SELECT * FROM filesinfo order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $filesi[] = array(
        'id'=>$obj->id,
        'archivo'=>$obj->archivo,
        'fecha'=>$obj->fecha
    );

}

$datos = array(
    'filesp'=>$filesp,
    'filesi'=>$filesi
);

echo json_encode($datos);