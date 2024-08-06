<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM filesdiarios order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $filesdiarios[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'semana'=>$obj->semana,
        'archivo'=>$obj->archivo
    );

}

$sql="SELECT * FROM filessemanales order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $filessemana[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'semana'=>$obj->semana,
        'archivo'=>$obj->archivo
    );

}


$sql="SELECT * FROM filesmes order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $filesmes[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'mes'=>$obj->mes,
        'archivo'=>$obj->archivo
    );

}

$datos = array(
    'filesdiarios'=>$filesdiarios,
    'filessemana'=>$filessemana,
    'filesmes'=>$filesmes
);

echo json_encode($datos);