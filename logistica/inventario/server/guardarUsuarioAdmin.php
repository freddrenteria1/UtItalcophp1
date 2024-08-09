<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$nombres = $_POST["nombres"];
$clave = $_POST["clave"];
$nivel = $_POST["nivel"];

//GUARDAR EL USUARIO
$msn = 'Ok';

$sql = "INSERT INTO adminlog VALUES('','$fecha','$nombres','$clave','$nivel')";
$gent = mysqli_query($conexion, $sql);

if(!$gent){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);