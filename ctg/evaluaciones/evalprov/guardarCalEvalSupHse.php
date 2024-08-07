<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p15a = $_POST["p15a"];
$p15b =  $_POST["p15b"];
$p15c = $_POST["p15c"];
$p16a = $_POST["p16a"];
$p16b = $_POST["p16b"];
$p17a = $_POST["p17a"];
$p17b = $_POST["p17b"];
$p17c = $_POST["p17c"];
$p18a = $_POST["p18a"];
$p18b = $_POST["p18b"];

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p15a', $p15a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p15b', $p15b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p15c', $p15c)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p16a', $p16a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p16b', $p16b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p17a', $p17a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p17b', $p17b)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p17c', $p17c)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p18a', $p18a)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p18b', $p18b)";
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