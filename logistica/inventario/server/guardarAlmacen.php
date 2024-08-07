<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$almacen = $_POST["almacen"];
$ubicacion = $_POST["ubicacion"];

//GUARDAR EL USUARIO
$msn = 'Ok';

$sql = "INSERT INTO almacenes VALUES('','$almacen','$ubicacion','$ods')";
$gent = mysqli_query($conexion, $sql);

if(!$gent){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);