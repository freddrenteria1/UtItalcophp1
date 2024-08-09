<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql="SELECT * FROM inspecciones WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$placa = $obj->placa;

$insp = array(
    'id'=>$obj->id,
    'placa'=>$obj->placa,
    'fecha'=>$obj->fecha,
    'doccond'=>$obj->doccond,
    'conductor'=>$obj->conductor,
    'ods'=>$obj->ods,
    'planta'=>$obj->planta,
    'kilo'=>$obj->kilo,
    'items'=>$obj->items,
    'firma'=>$obj->firma,
    'fotoPD'=>$obj->fotoPD,
    'fotoPP'=>$obj->fotoPP,
    'fotoLD'=>$obj->fotoLD,
    'fotoLI'=>$obj->fotoLI,
    'observaciones'=>$obj->observaciones,
);

$query="SELECT * FROM vehiculos WHERE placa='$placa'";
$eje=mysqli_query($conexion, $query);

$row = mysqli_fetch_object($eje);

$veh = array(
    'id'=>$row->id,
    'placa'=>$row->placa,
    'tipo'=>$row->tipo,
    'modelo'=>$row->modelo,
    'marca'=>$row->marca,
    'capacidad'=>$row->capacidad,
    'ultmant'=>$row->ultmant,
    'kiloultmant'=>$row->kiloultmant,
    'proxmant'=>$row->proxmant,
    'soatexp'=>$row->soatexp,
    'soatvence'=>$row->soatvence,
    'tecnoexp'=>$row->tecnoexp,
    'tecnovence'=>$row->tecnovence
);

$datos = array(
    'insp'=>$insp,
    'veh'=>$veh
);

echo json_encode($datos);