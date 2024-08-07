<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

// $sql="SELECT * FROM rda Where estado = 'Elaborado'";
// $exito=mysqli_query($conexion, $sql);
// $cantAp = mysqli_num_rows($exito);

// $sql2="SELECT * FROM rda Where estado = 'Revisado'";
// $exito2=mysqli_query($conexion, $sql2);
// $cantRev = mysqli_num_rows($exito2);

$sql="SELECT * FROM compras";
$exito=mysqli_query($conexion, $sql);
$cantOC = mysqli_num_rows($exito);

$sql3="SELECT * FROM rda Where estado = 'Aprobado'";
$exito3=mysqli_query($conexion, $sql3);
$cantOk = mysqli_num_rows($exito3);

$sql4="SELECT * FROM items";
$exito4=mysqli_query($conexion, $sql4);
$cantItems = mysqli_num_rows($exito4);

$datos = array(
    'cantOk'=>$cantOk,
    'cantOC'=>$cantOC,
    'cantItems'=>$cantItems
);

echo json_encode($datos);