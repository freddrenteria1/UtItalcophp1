<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p12a = $_POST["p12a"];
$p12b =  $_POST["p12b"];
$p13a = $_POST["p13a"];
$p13b = $_POST["p13b"];
$p13c = $_POST["p13c"];
$p14a = $_POST["p14a"];
$p14b = $_POST["p14b"];
$p14c = $_POST["p14c"];
$p14d = $_POST["p14d"];

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p12a', $p12a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p12b', $p12b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p13a', $p13a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p13b', $p13b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p13c', $p13c)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p14a', $p14a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p14b', $p14b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p14c', $p14c)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p14d', $p14d)";
$exito=mysqli_query($conexion, $sql);

//busca todas las calificaciones con este codigo

$query = "SELECT SUM(cal) as total FROM calevalsup Where cod='$cod'";
$eje = mysqli_query($conexion, $query);

$row = mysqli_fetch_object($eje);

$sum = $row->total;
$prom = $sum/40;


$datos = array(
    'msn' => 'Ok',
    'prom'=> $prom
);

echo json_encode($datos);