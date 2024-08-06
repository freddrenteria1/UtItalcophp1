<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$doc = $_POST["doc"];
$fecha = $_POST["fecha"];
$novedad = $_POST["novedad"];
$ods = $_POST["ods"];

//busca los datos del trabajador

$sql = "SELECT * FROM trabajadores Where cedula='$doc' and ods ='$ods'";
$exito = mysqli_query($conexion, $sql);

$fila = mysqli_fetch_object($exito);

$codigo = $fila->contrato;
$nombres = $fila->nombres . ' ' . $fila->apellidos;
$grupo = $fila->frente;
$cargo = $fila->cargo;

$query = "INSERT INTO novepersonal VALUES('', '$fecha', '$codigo', '$doc', '$nombres', '$cargo', '$grupo', '$novedad', '$ods')";
$eje = mysqli_query($conexion, $query);

$datos[] = array(
    'msn'=>'Ok',
);

echo json_encode($datos);