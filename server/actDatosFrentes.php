<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$frente = $_POST["frente"];
$ods = $_POST["ods"];
$supervisor = $_POST["supervisor"];
$cedula=$_POST["cedula"];
$id = $_POST["id"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO
$sql="UPDATE frentes SET frente = '$frente',  super = '$supervisor', cedula='$cedula' Where id=$id";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn' => 'Ok'
);
 
echo json_encode($datos);