<?php
// header('Content-type: application/json; charset=utf8');
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$ods = $_POST["ods"];
$tag = $_POST["tag"];
$tipo = $_POST["tipo"];
$rating = $_POST["rating"];

$msn = 'Ok';

$sql = "UPDATE os07 SET tipo = '$tipo', rating = '$rating' WHERE ods='$ods' AND tag = '$tag'";
$exito=mysqli_query($conexion, $sql);


if(!$exito){
    $msn = mysqli_error($conexion);
}

$datos = array(
    'msn'=>$msn
);


echo json_encode($datos);