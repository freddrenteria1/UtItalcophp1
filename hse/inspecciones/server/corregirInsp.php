<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM insp";
$exito=mysqli_query($conexion, $sql);


// $componentes = json_decode($_POST["componentes"]);
// $criterios = json_decode($_POST["criterios"]);

while($obj = mysqli_fetch_object($exito)){

    $componentes = $obj->componentes;
    $criterios = $obj->criterios;

    $componentes = '[' . $componentes . ']';
    $criterios = '[' . $criterios . ']';

    $id = $obj->id;

    $query = "UPDATE insp SET componentes = '$componentes', criterios = '$criterios' Where id=$id";
    $eje = mysqli_query($conexion, $query);
}

echo json_encode($datos);