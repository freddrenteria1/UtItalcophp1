<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$planta = $_POST["planta"];
$id = $_POST["id"];

$sql="UPDATE plantascalidad SET planta = '$planta' WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$cons = "UPDATE unidadescalidad SET planta = '$planta' WHERE idplanta = $id";
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