<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$email = $_POST["email"];
$clave = $_POST["clave"];
$numods = $_POST["numods"];
$ods = $_POST["ods"];
$voboitalco = $_POST["voboitalco"];
$voboecp = $_POST["voboecp"];

$query = "INSERT INTO userbio VALUES('', '$nombres','$email','$clave','$numods','$ods','Admin','$voboitalco','$voboecp')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);