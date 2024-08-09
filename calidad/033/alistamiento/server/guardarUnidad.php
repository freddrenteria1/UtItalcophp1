<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$planta = $_POST["planta"];
$unidad = $_POST["unidad"];

$cons = "SELECT * FROM plantascalidad Where planta = '$planta'";
$eje = mysqli_query($conexion, $cons);

$row = mysqli_fetch_object($eje);

$idplanta = $row->id;

$sql="INSERT INTO unidadescalidad VALUES('', '$planta', $idplanta, '$unidad', '$ods')";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);