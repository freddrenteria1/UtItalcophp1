<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$planta = $_POST["planta"];

$sql="INSERT INTO plantascalidad VALUES('', '$planta', '$ods')";
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