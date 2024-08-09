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
$almacen = $_POST["almacen"];
$items = $_POST["items"];
$permiso = $_POST["permiso"];


//GUARDAR EL USUARIO
$msn = 'Ok';

$sql = "INSERT INTO usuarioslogistica VALUES('','$fecha','$nombres','$email','$clave','','','Activo', $permiso,'$almacen','$email')";
$gent = mysqli_query($conexion, $sql);

if(!$gent){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);