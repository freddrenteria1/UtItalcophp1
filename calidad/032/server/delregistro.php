<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$id = $_POST["id"];

$msn = 'Ok';

$sql="DELETE FROM users WHERE id = $id";
$exito=mysqli_query($conexion, $sql);



echo 'Ok';