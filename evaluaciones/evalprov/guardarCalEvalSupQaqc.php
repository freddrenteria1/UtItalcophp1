<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p20a = $_POST["p20a"];
$p20b =  $_POST["p20b"];
$p20c = $_POST["p20c"];
$p20d = $_POST["p20d"];
$p20e = $_POST["p20e"];
$p21 = $_POST["p21"];

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p20a', $p20a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p20b', $p20b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p20c', $p20c)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p20d', $p20d)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p20e', $p20e)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p21', $p21)";
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