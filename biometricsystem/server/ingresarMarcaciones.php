<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$query1="SELECT * FROM trabajadores Where Estado = 'Activo'";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){
    $ced = $obj->cedula;
    $nombres = $obj->nombres . $obj->apellidos;
    $id = $obj->id;
   
    $query = "INSERT INTO marcaciones VALUES('', '$id', '$nombres', '2022-01-24', '06:50:00', 'Entrada', 'BIOMETRICO1')";
    $exito = mysqli_query($conexion, $query);

    if(!$exito){
        echo 'Error ' . mysqli_error($conexion);
    }

}

echo 'Realizado';