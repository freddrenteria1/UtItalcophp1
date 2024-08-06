<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$query = "SELECT * FROM lugar";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){
    $datos[] = array(
        'id'=>$obj->id,
        'lugar'=>$obj->lugar
    );
}

echo json_encode($datos);