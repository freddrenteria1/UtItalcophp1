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

$obp4a = $_POST["obp4a"];
$obp4b = $_POST["obp4b"];
$obp4c = $_POST["obp4c"];

$p4a = $_POST["p4a"];
$p4b = $_POST["p4b"];
$p4c = $_POST["p4c"];

$evaluador = $_POST["evaluador"];

$preg4a = 'Cumplimiento aspectos administrativos (Cumplimiento perfil de cargos, Trámite y gestión solicitud tarjeta magnética, Entrega pruebas psicotécnicas).';
$preg4b = 'Entrega oportuna de información correspondiente a facturación (Soporte de cantidades de ejecución).';
$preg4c = 'Aspectos laborales (Pago oportuno de salarios/Liquidaciones/Transporte)';

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p4a', '$preg4a', $p4a, '$obp4a', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p4b', '$preg4b', $p4b, '$obp4b', '$evaluador')";
$exito=mysqli_query($conexion, $sql);

$sql="INSERT INTO evalprov VALUES('', '$fecha', $idprov, '$proveedor', '$ods', '$aspecto', 'p4c', '$preg4c', $p4c, '$obp4c', '$evaluador')";
$exito=mysqli_query($conexion, $sql);



$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);