<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$doc = $_POST["doc"];
$turno = $_POST["turno"];
$fecha = $_POST["fecha"];
$frente = $_POST["frente"];
$respOP = $_POST["respOP"];

$respuestas = $_POST["respuestas"];
$galeria = $_POST["galeria"];

$msn = '0k';

$query = "INSERT INTO bitacorasup VALUES('', '$fecha', '$nombres', '$doc', '031', '$frente', '$turno', '$respuestas', '$respOP', '$galeria')";
$eje = mysqli_query($conexion, $query);


if(!$eje){
    $msn = mysqli_error($conexion);
}



$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);