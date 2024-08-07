<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql="SELECT * FROM proveedores Where id=$id";
$exito=mysqli_query($conexion, $sql);


$obj = mysqli_fetch_object($exito);

$datos = array(
    'id'=>$obj->id,
    'empresa'=>$obj->empresa,
    'domicilio'=>$obj->domicilio,
    'telefono'=>$obj->telefono,
    'contacto'=>$obj->contacto,
    'servicios'=>$obj->servicios,
    'detalles'=>$obj->detalles
);

echo json_encode($datos);