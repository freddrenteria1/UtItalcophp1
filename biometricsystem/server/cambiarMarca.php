<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$id = $_POST["id"];
$nombres = $_POST["nombres"];
$fecha = $_POST["fecha"];
$tipo = $_POST["tipo"];
$msn = 'Ok';

   
$query = "UPDATE marcaciones SET tipo='$tipo', terminal='Manual' WHERE id=$id";
$exito = mysqli_query($conexion, $query);

if(!$exito){
    $msn = 'Error ' . mysqli_error($conexion);
}

$datos = array(
    'msn' => $msn
);

echo json_encode($datos);