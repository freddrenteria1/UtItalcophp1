<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$id = $_POST["id"];
$user = $_POST["user"];
$nombre = $_POST["nombre"];

$ip = $_SERVER['REMOTE_ADDR'];

$sql="UPDATE sig SET descargas=descargas+1 WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$query = "INSERT INTO sigdescargas VALUES('', '$fecha', '$user', '$ip', '$nombre')";
$eje = mysqli_query($conexion, $query);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);