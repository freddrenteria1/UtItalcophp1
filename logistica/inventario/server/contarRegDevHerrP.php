<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM devherramientasp";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

$datos = array(
    'num'=>$cant
);

echo json_encode($datos);