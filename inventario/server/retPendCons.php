<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sum=0;

$ubicacion = $_POST["ubicacion"];

$sql = "SELECT * FROM traslados Where ubicacion = '$ubicacion' AND estado = 'Pendiente' AND origen LIKE '%Consumible%' order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'origen'=>$obj->origen
    );
}


echo json_encode($datos);