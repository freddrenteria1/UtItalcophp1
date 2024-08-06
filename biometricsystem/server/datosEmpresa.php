<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$query = "SELECT * FROM perfilempresa";
$eje = mysqli_query($conexion, $query);

$obj = mysqli_fetch_object($eje);

$datos = array(
    'nit'=>$obj->nit,
    'razon'=>$obj->razon,
    'domicilio'=>$obj->domicilio,
    'tel'=>$obj->telefono,
    'doc'=>$obj->doc,
    'rep'=>$obj->representante,
    'email'=>$obj->email
);

echo json_encode($datos);