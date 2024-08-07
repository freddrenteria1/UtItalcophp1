<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$id = $_POST["id"];

$sql="DELETE FROM unidadescalidad WHERE id = $id";
$exito=mysqli_query($conexion, $sql);


if(!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);