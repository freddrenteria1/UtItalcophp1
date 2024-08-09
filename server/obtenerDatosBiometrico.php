<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

$finicio = $_POST["finicio"];

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM biometrico WHERE fecha='$finicio' AND modo='Inicio' AND cedula!=''";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    
    $datos[] = array(
        'id' => $row->id,
        'fecha'=>$row->fecha,
        'hora'=>$row->hora,
        'cedula'=>$row->cedula,
        'trabajador'=>$row->trabajador,
        'modo'=>$row->modo
    );

}  

echo json_encode($datos);