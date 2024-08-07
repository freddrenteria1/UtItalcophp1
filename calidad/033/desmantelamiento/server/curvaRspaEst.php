<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM curvarspaest WHERE fecha <= '$fecha'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvaest[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$sql="SELECT * FROM curvarspatorres WHERE fecha <= '$fecha'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvatorres[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$sql="SELECT * FROM curvarspavalv WHERE fecha <= '$fecha'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvavalv[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$sql="SELECT * FROM curvarspalg WHERE fecha <= '$fecha'";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $curvalg[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->acum),
        'eje'=>intval($obj->eje)
    );

}

$datos = array(
    'curvaest'=>$curvaest,
    'curvatorres'=>$curvatorres,
    'curvavalv'=>$curvavalv,
    'curvalg'=>$curvalg,
);

echo json_encode($datos);