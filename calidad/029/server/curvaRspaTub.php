<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM curvarspaing WHERE fecha <= '$fecha' order by fecha";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvaing[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$sql="SELECT * FROM curvarspalazos WHERE fecha <= '$fecha'  order by fecha";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvalazos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$datos = array(
    'curvaing'=>$curvaing,
    'curvalazos'=>$curvalazos
);

echo json_encode($datos);