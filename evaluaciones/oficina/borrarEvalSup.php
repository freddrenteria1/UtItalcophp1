<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$id = $_POST["id"];

$sql="DELETE FROM evaluacionsup Where id=$id";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);


echo json_encode($datos);