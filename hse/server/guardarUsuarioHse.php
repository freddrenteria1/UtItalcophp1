<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nombres = $_POST["nombres"];
$cargo = $_POST["cargo"];
$email = $_POST["email"];
$clave = $_POST["clave"];
$numods = $_POST["numods"];
$ods = $_POST["ods"];
$fase = $_POST["fase"];
$odsant = $_POST["odsant"];

$sql="INSERT INTO users VALUES('','$fecha','$email','$clave','$nombres','$cargo','1','$email','Activo','$numods','$ods','$fase','$odsant','')";

$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);