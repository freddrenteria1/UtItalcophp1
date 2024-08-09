<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$evaluador = $_POST["evaluador"];
$cargoeval = $_POST["cargoeval"];
$codigo = $_POST["codigo"];

$pinicial = $_POST["pinicial"];
$pfinal = $_POST["pfinal"];
$observaciones = $_POST["observaciones"];
$planes = $_POST["planes"];
$compromisos = $_POST["compromisos"];
$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$cargo = $_POST["cargo"];

$prom = $_POST["prom"];

$sql="INSERT INTO evaluacionsup VALUES('', '$codigo', '$fecha', '$evaluador', '$cargoeval', '$nombres', '$doc', '$cargo', '$ods', '$pinicial', '$pfinal', $prom, '$observaciones', '$compromisos', '$planes')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);

echo json_encode($datos);