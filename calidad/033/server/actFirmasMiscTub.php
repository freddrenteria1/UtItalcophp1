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

$datos = $_POST["datos"];
$msn = 'Ok';

$sql = "UPDATE osMiscTub SET firmas = '$datos' WHERE ods='$ods'  AND id=$id";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);