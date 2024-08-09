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
$turno = $_POST["turno"];
$equipos = $_POST["equipos"];

$notas = $_POST["notas"];


$query = "INSERT INTO vigias VALUES('', '$fecha', '$nombres', '$doc', '$turno', '$equipos',  '$notas', '$ods')";
$eje = mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}

$msn = 'Realizado...';


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);