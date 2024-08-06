<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$nit = $_POST["nit"];
$razon = $_POST["razon"];
$dir = $_POST["dir"];
$tel = $_POST["tel"];
$ced = $_POST["ced"];
$rep = $_POST["rep"];
$email = $_POST["email"];


$query = "UPDATE perfilempresa SET nit='$nit', razon='$razon', domicilio='$dir', telefono='$tel' ";
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