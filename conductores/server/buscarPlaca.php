<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$placa = $_POST["placa"];

$sql="SELECT * FROM vehiculos WHERE placa='$placa'";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $datos = array(
        'id'=>$obj->id,
        'placa'=>$obj->placa,
        'tipo'=>$obj->tipo,
        'modelo'=>$obj->modelo,
        'marca'=>$obj->marca,
        'capacidad'=>$obj->capacidad,
        'ultmant'=>$obj->ultmant,
        'kiloultmant'=>$obj->kiloultmant,
        'proxmant'=>$obj->proxmant,
        'soatexp'=>$obj->soatexp,
        'soatvence'=>$obj->soatvence,
        'tecnoexp'=>$obj->tecnoexp,
        'tecnovence'=>$obj->tecnovence
    );


echo json_encode($datos);