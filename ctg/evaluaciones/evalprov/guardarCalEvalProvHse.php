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

$obp3a = $_POST["obp3a"];
$obp3b = $_POST["obp3b"];
$obp3c = $_POST["obp3c"];
$obp3d = $_POST["obp3d"];
$obp3e = $_POST["obp3e"];

$p3a = $_POST["p3a"];
$p3b = $_POST["p3b"];
$p3c = $_POST["p3c"];
$p3d = $_POST["p3d"];
$p3e = $_POST["p3e"];

$evaluador = $_POST["evaluador"];

$preg3a = 'Cumplimiento de aspectos HSE';
$preg3b = 'Compromiso y liderazgo visible por parte de la línea de mando';
$preg3c = 'Reporte de observación de comportamientos/Hallazgos (¿Han presentado reportes de OB y/o Hallazgos?).';
$preg3d = 'Gestión oportuna de hallazgos.';
$preg3e = 'Estrategias preventivas encaminadas a la prevención de riesgos laborales.';

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p3a', '$preg3a', $p3a, '$obp3a', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p3b', '$preg3b', $p3b, '$obp3b', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p3c', '$preg3c', $p3c, '$obp3c', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p3d', '$preg3d', $p3d, '$obp3d', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p3e', '$preg3e', $p3e, '$obp3e', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);