<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$om = $_POST["om"];
$frente = $_POST["frente"];
$semana = $_POST["semana"];


$query = "INSERT INTO ordenmant  VALUES('', '$frente', '$semana', '$om')";
$eje=mysqli_query($conexion, $query);

if(!$eje){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}


$datos = array(
    'msn' => $msn
);
 
echo json_encode($datos);