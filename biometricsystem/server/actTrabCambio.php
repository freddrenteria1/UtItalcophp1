<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$finicio = $_POST["fingreso"];
$estado = $_POST["estado"];
$ods = $_POST["ods"];

$id = $_POST["id"];

$ip = $_SERVER['REMOTE_ADDR'];

$user = $_POST["user"];


$query = "UPDATE trabajadores SET  fingreso='$finicio', ods='$ods', estado='$estado' where id=$id";
$eje = mysqli_query($conexion, $query);

$nomb = $nombres . ' ' . $apellidos;

$sql = "INSERT INTO bitacorabio VALUES('', '$fecha', '$user', '$id', '', '', '', '$estado', '$ods', '$ip')";
$exito = mysqli_query($conexion, $sql);


$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);