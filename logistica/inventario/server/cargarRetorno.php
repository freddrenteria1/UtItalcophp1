<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql = "SELECT * FROM traslados Where id=$id";
$exito = mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$user = $obj->user;

$query = "SELECT * FROM usuarioslogistica Where user='$user'";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_num_rows($eje);

if($enc != 0){
    $row = mysqli_fetch_object($eje);
    $nombres = $row->nombres;
}else{
    $nombres = '';
}

$origen = $obj->origen;

$arrayods = explode(" ", $origen);
$odsorigen = $arrayods[2];

if($arrayods[0] == 'Herramientas'){
    $ubiorigen = substr($origen, 21, strlen($origen));
}else{
    $ubiorigen = substr($origen, 20, strlen($origen));
}

$datos = array(
    'id'=>$obj->id,
    'fecha'=>$obj->fecha,
    'ods'=>$obj->ods,
    'ubicacion'=>$obj->ubicacion,
    'items'=>$obj->items,
    'observaciones'=>$obj->observaciones,
    'archivo'=>$obj->archivo,
    'odsorigen'=>$odsorigen,
    'ubiorigen'=>$ubiorigen,
    'realizado'=>$nombres
);


echo json_encode($datos);