<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$ubi = $_POST["ubicacion"];

$alm = 'Herramientas ODS '.$ods. ' ' . $ubi;

$sql = "SELECT * FROM traslados Where origen = '$alm' Order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'ods'=>$obj->ods,
        'ubicacion'=>$obj->ubicacion
    );
}

echo json_encode($datos);