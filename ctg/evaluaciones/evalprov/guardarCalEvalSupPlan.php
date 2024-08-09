<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p1a = $_POST["p1a"];
$p1b =  $_POST["p1b"];
$p1c = $_POST["p1c"];


$sql="INSERT INTO calevalprov VALUES('', '$cod', 'p1a', $p1a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalprov VALUES('', '$cod', 'p1b', $p1b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalprov VALUES('', '$cod', 'p1c', $p1c)";
$exito=mysqli_query($conexion, $sql);


//busca todas las calificaciones con este codigo

$query = "SELECT SUM(cal) as total FROM calevalprov Where cod='$cod'";
$eje = mysqli_query($conexion, $query);

$row = mysqli_fetch_object($eje);

$sum = $row->total;
$prom = $sum/40;


$datos = array(
    'msn' => 'Ok',
    'prom'=> $prom
);

echo json_encode($datos);