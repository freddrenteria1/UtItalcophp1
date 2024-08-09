<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$id = $_POST["id"];

$sql="SELECT * FROM devoluciones WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$row = mysqli_fetch_object($exito);


    $query = "SELECT * FROM detallesdev WHERE numdev = $id";
    $eje = mysqli_query($conexion, $query);

    while($obj = mysqli_fetch_object($eje)){
        $items[] = array(
            'item'=>$obj->item,
            'descripcion'=>$obj->descripcion,
            'codigo'=>$obj->codigo,
            'solicitud'=>$obj->solicitud,
            'pos'=>$obj->pos,
            'numdoc'=>$obj->documento,
            'loca'=>$obj->loca,
            'unidad'=>$obj->unidad,
            'cant'=>$obj->cant,
        );
    }

    $datos = array(
        'id'=>$row->id,
        'fecha'=>$row->fecha,
        'ods'=>$row->ods,
        'almacen'=>$row->almacen,
        'observaciones'=>$row->observaciones,
        'realizado'=>$row->realizado,
        'ccr'=>$row->ccr,
        'firmarr'=>$row->firmarr,
        'cargor'=>$row->cargor,
        'recibido'=>$row->recibido,
        'rega'=>$row->rega,
        'firmaa'=>$row->firmaa,
        'cargoa'=>$row->cargoa,
        'items'=>$items
    );



echo json_encode($datos);