<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$query1="SELECT * FROM asistencias";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){
    $ced = $obj->doc;

    $query = "SELECT * FROM trabajadores Where cedula ='$ced'";
    $exito = mysqli_query($conexion, $query);
    $row = mysqli_fetch_object($exito);

    $tiponomina = $row->tiponomina;
    $sistemaprecio = $row->sistemaprecio;


    $sql = "UPDATE asistencias SET tiponomina = '$tiponomina', sistemaprecio = '$sistemaprecio' Where doc =  '$ced'";
    $eje = mysqli_query($conexion, $sql);
}

echo 'Realizado';