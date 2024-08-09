<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$unidad = $_POST["unidad"];
$id = $_POST["id"];

$cons = "UPDATE unidadescalidad SET unidad = '$unidad' WHERE id = $id";
$eje = mysqli_query($conexion, $cons);

if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);