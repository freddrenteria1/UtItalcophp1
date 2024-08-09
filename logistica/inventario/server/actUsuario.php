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

$id = $_POST["id"];

//GUARDAR EL USUARIO
$msn = 'Ok';

$sql = "UPDATE usuarioslogistica SET nombres='$nombres', email='$email', clave='$clave', permiso='$permiso', almacenes='$almacen', user='$email' Where id=$id";
$gent = mysqli_query($conexion, $sql);

if(!$gent){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);