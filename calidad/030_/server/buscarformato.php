<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$esp = $_POST["esp"];
$equipo = $_POST["equipo"];
$tipos = $_POST["tipos"];
$alcance = $_POST["alcance"];

$sql="SELECT * FROM formatoscalidad WHERE especialidad='$esp' AND equipo='$equipo' AND tipos='$tipos' ";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

$obj = mysqli_fetch_object($exito);

$datos = array(
    'id'=>$obj->id,
    'codigo'=>$obj->codigo
);

echo json_encode($datos);