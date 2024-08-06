<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$frente = $_POST["frente"];
$liderecp = $_POST["liderecp"];
$id = $_POST["id"];
$ods = $_POST["ods"];

$query = "UPDATE frentestrab SET frentetrab = '$frente', liderecp='$liderecp' Where id = $id";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);