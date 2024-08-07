<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];

$sql = "SELECT * FROM salidaherramientas Where ods = '$ods' AND ubicacion = '$ubicacion' Order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'ced'=>$obj->ced,
        'nombres'=>$obj->nombres
    );
}

echo json_encode($datos);