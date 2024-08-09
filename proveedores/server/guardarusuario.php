<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d H:i:s");
$fecha=date("Y-m-d");

$nombre = $_POST["nombre"];
$tipoe = $_POST["tipoe"];
$email = $_POST["email"];
$clave = $_POST["clave"];

//GUARDA LA ENTRADA
$msn = 'Ok';

$sql = "INSERT INTO usuariosprov VALUES('','$fecha','$email','$clave','$nombre','$tipoe','Activo')";
$guardar = mysqli_query($conexion, $sql);

if(!$guardar){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);