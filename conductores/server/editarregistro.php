<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');


include("conectar.php"); 
$conexion=conectar();


date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$id = $_POST['id'];
$placa = $_POST["placa"];
$tipo = $_POST["tipo"];
$marca = $_POST["marca"];
$modelo = $_POST["modelo"];
$capacidad = $_POST["capacidad"];
$ultmant = $_POST["ultmant"];
$kiloultmant = $_POST["kiloultmant"];
$proxmant = $_POST["proxmant"];
$soatexp = $_POST["soatexp"];
$soatvence = $_POST["soatvence"];
$tecnoexp = $_POST["tecnoexp"];
$tecnovence = $_POST["tecnovence"];

$sql_update = mysqli_query($conexion, "UPDATE vehiculos SET placa = '$placa', tipo='$tipo', marca='$marca', modelo='$modelo', capacidad='$capacidad', ultmant='$ultmant', kiloultmant='$kiloultmant', proxmant='$proxmant', soatexp='$soatexp', soatvence='$soatvence', tecnoexp='$tecnoexp', tecnovence='$tecnovence'
WHERE id= $id");

if (!$exito){
    $msn = mysqli_error($conexion);
}else{
    $msn = 'Ok';
}

$datos = array(
    'msn'=>$msn
);

echo json_encode($datos);

