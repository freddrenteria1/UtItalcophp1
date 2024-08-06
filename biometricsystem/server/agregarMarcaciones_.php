<?php
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = '2023-05-21';

setlocale(LC_ALL,"es_ES");

$query1="SELECT * FROM cedula";
$exito1=mysqli_query($conexion, $query1);

while ($obj = mysqli_fetch_object($exito1)){
    $ced = $obj->cedula;
    

    $sql = "SELECT * FROM trabajadores Where cedula =  '$ced'";
    $eje = mysqli_query($conexion, $sql);

    $row = mysqli_fetch_object($eje);

    $nombres = $row->nombres . ' ' . $row->apellidos;
    $contrato = $row->contrato;
    $cargo = $row->cargo;
    $grupo = $row->frente;
    $id = $row->id;
     
    $query = "INSERT INTO marcaciones VALUES('', '$id', '$nombres', '$fecha', '07:00:00', 'Entrada', 'Manual', 'E1', '029')";
    $exito = mysqli_query($conexion, $query);

    $query = "INSERT INTO marcaciones VALUES('', '$id', '$nombres', '$fecha', '15:00:00', 'Salida', 'Manual', 'E1', '029')";
    $exito = mysqli_query($conexion, $query);

    if(!$exito){
        echo 'Error ' . mysqli_error($conexion);
    }

    echo '<br>';
    echo $nombres;

}

echo 'Realizado';