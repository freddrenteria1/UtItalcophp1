<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$idprov = $_POST["idprov"];
$proveedor = $_POST["proveedor"];
$ods = $_POST["ods"];

$aspecto = $_POST["aspecto"];
$obp1a = $_POST["obp1a"];
$obp1b = $_POST["obp1b"];
$obp1c = $_POST["obp1c"];

$p1a = $_POST["p1a"];
$p1b = $_POST["p1b"];
$p1c = $_POST["p1c"];

$evaluador = $_POST["evaluador"];

$preg1a = 'Cumplimiento de características del servicio o producto.';
$preg1b = 'Tiempo de entrega/Ejecución.';
$preg1c = 'Conformidad en la ejecución de actividades.';

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p1a', '$preg1a', $p1a, '$obp1a', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p1b', '$preg1b', $p1b, '$obp1b', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p1c', '$preg1c', $p1c, '$obp1c', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);