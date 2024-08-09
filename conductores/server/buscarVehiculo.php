<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM vehiculos";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'placa'=>$obj->placa,
        'tipo'=>$obj->tipo,
        'marca'=>$obj->marca,
        'modelo'=>$obj->modelo,
        'capacidad'=>$obj->capacidad,
        'ultmant'=>$obj->ultmant,
        'kiloultmant'=>$obj->kiloultmant,
        'proxmant'=>$obj->proxmant,
        'soatexp'=>$obj->soatexp,
        'soatvence'=>$obj->soatvence,
        'tecnoexp'=>$obj->tecnoexp,
        'tecnovence'=>$obj->tecnovence,
    );

}



echo json_encode($datos);