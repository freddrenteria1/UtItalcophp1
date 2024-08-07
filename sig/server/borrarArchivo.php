<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$id = $_POST["id"];

$sql="DELETE FROM sig WHERE id=$id";
$exito=mysqli_query($conexion, $sql);

if(!$exito){
    echo mysqli_error($conexion);
}