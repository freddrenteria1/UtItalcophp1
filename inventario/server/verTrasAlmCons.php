<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sum=0;

$ubicacion = $_POST["ubicacion"];

$sql = "SELECT * FROM traslados Where ubicacion = '$ubicacion' AND estado = 'Pendiente' AND origen LIKE '%Consumible%'";
$exito = mysqli_query($conexion, $sql);

$sum = mysqli_num_rows($exito);

$datos = array(
    'cant'=>$sum,
    'msn'=>'Ok'
);


echo json_encode($datos);