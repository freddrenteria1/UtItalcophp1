<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$id = $_POST["id"];
$ods = $_POST["ods"];
$ubicacion = $_POST["ubicacion"];

//SE VERIFICA QUE EL ID NO ESTÉ REGISTRADO EN LAS ENTRADAS

$query = "SELECT * FROM entradaconsumibles WHERE remision = '$id'";
$eje = mysqli_query($conexion, $query);
$cont = mysqli_num_rows($eje);

if($cont == 0){

    $sql = "SELECT * FROM ordensalidaconsu Where id=$id";
    $exito = mysqli_query($conexion, $sql);

    $obj = mysqli_fetch_object($exito);

    $odsalm = $obj->ods;
    $almacen = $obj->almacen;
    $ubicacionalm = $obj->ubicacion;

    if($almacen == 'Consumibles' && $odsalm == $ods && $ubicacion == $ubicacionalm){

        $datos = array(
            'id'=>$obj->id,
            'fecha'=>$obj->fecha,
            'almacen'=>$obj->almacen,
            'ods'=>$obj->ods,
            'ubicacion'=>$obj->ubicacion,
            'items'=>$obj->items,
            'observaciones'=>$obj->observaciones,
            'msn'=>'Ok'
        );
    }else{
        $datos = array(
            'msn'=>'Remisión no asignada a este almacén...'
        );
    }
}else{
    $datos = array(
        'msn'=>'Remisión de Alm Principal ya está registrada...'
    );
}


echo json_encode($datos);