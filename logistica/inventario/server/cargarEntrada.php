<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];

$sql = "SELECT * FROM ordenentrada Where id=$id";
$exito = mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

    $user = $obj->user;

    $query = "SELECT * FROM usuarioslogistica Where user='$user'";
    $eje = mysqli_query($conexion, $query);

    $enc = mysqli_num_rows($eje);

    if($enc != 0){
        $row = mysqli_fetch_object($eje);
        $nombres = $row->nombres;
    }else{
        $nombres = '';
    }

    $datos = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'proveedor'=>$obj->proveedor,
        'remision'=>$obj->remision,
        'ordencompra'=>$obj->ordencompra,
        'ods'=>$obj->ods,
        'items'=>$obj->items,
        'observaciones'=>$obj->observaciones,
        'archivo'=>$obj->archivo,
        'realizado'=>$nombres
    );

echo json_encode($datos);