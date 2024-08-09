<?php
// header('Content-type: application/json; charset=utf8');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];
$lazo = $_POST["lazo"];

$id = $_POST["id"];

$item = $_POST["item"];
$valor = $_POST["valor"];

$msn = 'Ok';

if($item == 'item1'){
    $sql = "UPDATE osLazos SET item1 = '$valor' WHERE ods='$ods' AND isometrico = '$tag' AND lazo = '$lazo' AND id=$id";
    $exito=mysqli_query($conexion, $sql);
}

if($item == 'item2'){
    $sql = "UPDATE osLazos SET item2 = '$valor' WHERE ods='$ods' AND isometrico = '$tag' AND lazo = '$lazo' AND id=$id";
    $exito=mysqli_query($conexion, $sql);
}

if($item == 'item3'){
    $sql = "UPDATE osLazos SET item3 = '$valor' WHERE ods='$ods' AND isometrico = '$tag' AND lazo = '$lazo' AND id=$id";
    $exito=mysqli_query($conexion, $sql);
}


if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);