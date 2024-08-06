<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");



$query = "SELECT * FROM trabajadores order by frente";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){
    $id = $row->id;
    $doc = $row->cedula;
    $nombres = $row->nombres . ' ' . $row->apellidos;
    $cargo = $row->cargo;

    $sql = "UPDATE marcaciones SET doc = '$id' Where doc='$doc'";
    $exito = mysqli_query($conexion, $sql);

    
}



echo json_encode($datos);