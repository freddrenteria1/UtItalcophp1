<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql="SELECT * FROM usuarioslogistica Where id=$id";
$exito=mysqli_query($conexion, $sql);

$row = mysqli_fetch_object($exito);

$datos = array(
    'id'=>$row->id,
    'nombres'=>$row->nombres,
    'email'=>$row->email,
    'clave'=>$row->clave,
    'ultimo_ingreso'=>$row->ultimo_ingreso,
    'ip'=>$row->ip,
    'estado'=>$row->estado,
    'permiso'=>$row->permiso,
    'almacenes'=>$row->almacenes
);


echo json_encode($datos);