<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p19a = $_POST["p19a"];
$p19b =  $_POST["p19b"];

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p19a', $p19a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p19b', $p19b)";
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