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

$obp2a = $_POST["obp2a"];
$obp2b = $_POST["obp2b"];
$obp2c = $_POST["obp2c"];
$obp2d = $_POST["obp2d"];
$obp2e = $_POST["obp2e"];

$p2a = $_POST["p2a"];
$p2b = $_POST["p2b"];
$p2c = $_POST["p2c"];
$p2d = $_POST["p2d"];
$p2e = $_POST["p2e"];

$evaluador = $_POST["evaluador"];

$preg2a = 'Entrega oportuna de la información (Documentos). (Antes/Durante y fianlización de la ejecución).';
$preg2b = 'Reprocesos/ No confomidades Identificados (¿Se han presentado Reprocesos/NC?)';
$preg2c = 'Gestión oportuna de Hallazgos.';
$preg2d = 'Calidad y certificación de los materiales utilizados.';
$preg2e = 'Recibido a Satisfaccción del cliente (Ecopetrol).';

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p2a', '$preg2a', $p2a, '$obp2a', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p2b', '$preg2b', $p2b, '$obp2b', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p2c', '$preg2c', $p2c, '$obp2c', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p2d', '$preg2d', $p2d, '$obp2d', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p2e', '$preg2e', $p2e, '$obp2e', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);