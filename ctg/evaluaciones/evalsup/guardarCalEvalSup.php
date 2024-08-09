<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$cod = $_POST["codigo"];

$p1 = $_POST["p1"];
$p2 =  $_POST["p2"];
$p3 = $_POST["p3"];
$p4 = $_POST["p4"];
$p5 = $_POST["p5"];
$p6 = $_POST["p6"];
$p7 = $_POST["p7"];
$p8 = $_POST["p8"];
$p9 = $_POST["p9"];
$p10 = $_POST["p10"];
$p11 = $_POST["p11"];

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p1', $p1)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p2', $p2)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p3', $p3)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p4', $p4)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p5', $p5)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p6', $p6)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p7', $p7)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p8', $p8)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p9', $p9)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p10', $p10)";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO calevalsup VALUES('', '$cod', 'p11', $p11)";
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