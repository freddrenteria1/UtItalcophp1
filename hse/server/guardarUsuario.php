<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$nombres = $_POST["nombres"];
$email = $_POST["email"];
$clave = $_POST["clave"];
$ods = $_POST["ods"];
$almacen = $_POST["almacen"];

$ip = $_SERVER['REMOTE_ADDR'];

$user = $_POST["user"];

$sql="INSERT INTO usuarioslogistica VALUES('','$fecha','$nombres','$email','$clave','','$ip','$almacen','$ods','Activo','$user')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);

echo json_encode($datos);