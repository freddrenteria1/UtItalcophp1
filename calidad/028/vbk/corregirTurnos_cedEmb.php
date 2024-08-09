<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

//turno = $_GET["turno"];

$query1="SELECT * FROM cedcor";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){

    $ced = $obj->cedula;

    $turno = $obj->turno;    

    $sql = "UPDATE trabajadores SET turno = '$turno' Where cedula =  '$ced'";
    $eje = mysqli_query($conexion, $sql);

}

echo 'Realizado';