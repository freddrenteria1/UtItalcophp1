<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$ods = $_POST["ods"];
$especialidad = $_POST["especialidad"];
$marca_a = $_POST["marca_a"];
$referencia_a = $_POST["referencia_a"];
$serie_a = $_POST["serie_a"];
$fecha_a = $_POST["fecha_a"];
$lote_a = $_POST["lote_a"];
$estado_a = $_POST["estado_a"];
$marca_e = $_POST["marca_e"];
$referencia_e = $_POST["referencia_e"];
$serie_e = $_POST["serie_e"];
$fecha_e = $_POST["fecha_e"];
$lote_e = $_POST["lote_e"];
$estado_e = $_POST["estado_e"];

$notas = $_POST["notas"];


$query = "INSERT INTO hvarnes VALUES('', '$fecha', '$nombres', '$doc', '$especialidad', '$marca_a', '$referencia_a', '$serie_a', '$fecha_a', '$lote_a', '$estado_a', '$marca_e', '$referencia_e', '$serie_e', '$fecha_e', '$lote_e', '$estado_e', '$notas', '', '$ods')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}

$msn = 'Realizado...';


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);