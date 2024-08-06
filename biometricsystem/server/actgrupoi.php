<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$grupo = $_POST["grupo"];
$id = $_POST["id"];
$user = $_POST["user"];

$ip = $_SERVER['REMOTE_ADDR'];


$query = "UPDATE trabajadores SET frente = '$grupo' Where id=$id";
$eje = mysqli_query($conexion, $query);

$sql = "INSERT INTO bitacorabio VALUES('', '$fecha', '$user', '$id', '', '', '', '', '', '$ip')";
$exito = mysqli_query($conexion, $sql);


if(!$eje){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn,
);

echo json_encode($datos);