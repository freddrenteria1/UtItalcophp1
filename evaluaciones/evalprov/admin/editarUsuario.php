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
$idUser = $_POST["idUser"];

$sql="UPDATE userseval SET nombres='$nombre', email='$email', cargo='$cargo', ods='$ods', clave='$clave'  Where id=$idUser";
$exito=mysqli_query($conexion, $sql);

$datos = array(
    'msn'=>'Ok'
);


echo json_encode($datos);