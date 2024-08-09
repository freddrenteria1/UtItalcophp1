<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];
$tag = $_POST["tag"];

$servicio = $_POST["servicio"];
$material = $_POST["material"];

$msn = 'Ok';

$query = "SELECT * FROM osLazos1 where item>159";
$ejeq = mysqli_query($conexion, $query);

$item = 160;

while ($obj = mysqli_fetch_object($ejeq)){

    $item++;

    $id = $obj->id;

    $sql = "UPDATE osLazos1 SET item=$item WHERE id=$id";
    $exito=mysqli_query($conexion, $sql);

}

echo 'Hecho';