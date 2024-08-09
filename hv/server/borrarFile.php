<?php

header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["iddoc"];


$sql="DELETE FROM documentos WHERE id=$id";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $ok = false;
}else{
    $ok = true;
}

$datos = array(
    'ok'=>$ok

);

echo json_encode($datos);