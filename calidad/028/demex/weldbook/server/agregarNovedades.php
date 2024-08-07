<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = '2023-03-27';

setlocale(LC_ALL,"es_ES");

$query1="SELECT * FROM cedula";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){
    $ced = $obj->cedula;

    $sql = "SELECT * FROM trabajadores Where cedula ='$ced'";
    $exito = mysqli_query($conexion, $sql);

    $fila = mysqli_fetch_object($exito);
    
    $codigo = $fila->contrato;
    $doc = $fila->cedula;
    $nombres = $fila->nombres . ' ' . $fila->apellidos;
    $grupo = $fila->frente;
    $cargo = $fila->cargo;

    $query = "INSERT INTO novepersonal VALUES('', '$fecha', '$codigo', '$doc', '$nombres', '$cargo', '$grupo', 'Descanso', '025')";
    $eje = mysqli_query($conexion, $query);

}

echo 'Realizado';