<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ip = $_SERVER['REMOTE_ADDR'];
 
$id = $_POST["id"];
$items = $_POST["items"];

$sql="UPDATE rda SET items='$items' Where id = $id";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);