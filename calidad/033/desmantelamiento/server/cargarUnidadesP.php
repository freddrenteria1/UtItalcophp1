<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$idPlanta = $_POST["idPlanta"];

$sql="SELECT * FROM unidadescalidad WHERE ods='$ods' AND idplanta=$idPlanta";
$exito=mysqli_query($conexion, $sql);


while($obj = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$obj->id,
        'planta'=>$obj->planta,
        'unidad'=>$obj->unidad
    );
}

echo json_encode($datos);