<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
// $fecha=date("Y-m-d");

setlocale(LC_ALL,"es_ES");

$id = $_POST["id"];
$nombres = $_POST["nombres"];
$fecha = $_POST["fecha"];
$msn = 'Ok';

//busca el turno
$sql = "SELECT * FROM trabajadores Where id=$id";
$ejec = mysqli_query($conexion, $sql);

$row = mysqli_fetch_object($ejec);

$turno = $row->turno;
$ods = $row->ods;

$sql2 = "SELECT * FROM codturnos Where turno='$turno'";
$eje2 = mysqli_query($conexion, $sql2);
$fila = mysqli_fetch_object($eje2);

$hora = $fila->entrada;
   
$query = "INSERT INTO marcaciones VALUES('', '$id', '$nombres', '$fecha', '$hora', 'Entrada', 'Manual', '$turno', '$ods')";
$exito = mysqli_query($conexion, $query);

if(!$exito){
    $msn = 'Error ' . mysqli_error($conexion);
}

$datos = array(
    'msn' => $msn
);

echo json_encode($datos);