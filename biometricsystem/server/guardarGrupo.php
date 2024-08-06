<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$frentetrab = $_POST["frente"];
$grupo = $_POST["grupo"];
$supgrupo = $_POST["supgrupo"];
$docsup = $_POST["docsup"];
$ods = $_POST["ods"];

$query = "INSERT INTO grupos VALUES('', '$frentetrab', '$grupo', '$supgrupo','$docsup','$ods')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);