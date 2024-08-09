<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$hito = $_POST["hito"];
$nombre = $_POST["nombre"];
$email = $_POST["email"];
$cargo = $_POST["cargo"];
$ods = $_POST["ods"];
$clave = $_POST["clave"];

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$sql="INSERT INTO userseval VALUES('','$nombre','$email','$cargo','$ods','$clave')";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);


echo json_encode($datos);