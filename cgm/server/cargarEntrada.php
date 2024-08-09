<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$id = $_POST["id"];

$sql="SELECT * FROM entradas WHERE id = $id";
$exito=mysqli_query($conexion, $sql);

$row = mysqli_fetch_object($exito);


    $query = "SELECT * FROM detallesent WHERE nument = $id";
    $eje = mysqli_query($conexion, $query);

    while($obj = mysqli_fetch_object($eje)){
        $items[] = array(
            'item'=>$obj->item,
            'descripcion'=>$obj->descripcion,
            'codigo'=>$obj->codigo,
            'solicitud'=>$obj->solicitud,
            'pos'=>$obj->pos,
            'ot'=>$obj->ot,
            'numdoc'=>$obj->documento,
            'equipo'=>$obj->equipo,
            'cantreq'=>$obj->cantreq,
            'cantrec'=>$obj->cantrec,
            'saldo'=>$obj->saldo,
            'unidad'=>$obj->unidad,
            'observacion'=>$obj->observacion,
            'fechareserva'=>$obj->fechareserva,
        );
    }



    $datos = array(
        'id'=>$row->id,
        'fecha'=>$row->fecha,
        'documento'=>$row->documento,
        'inspeccion'=>$row->inspeccion,
        'estado'=>$row->estado,
        'acciones'=>$row->acciones,
        'almacenamiento'=>$row->almacenamiento,
        'observaciones'=>$row->observaciones,
        'realizado'=>$row->realizado,
        'ccr'=>$row->ccr,
        'firmarr'=>$row->firmarr,
        'cargor'=>$row->cargor,
        'aprobado'=>$row->aprobado,
        'rega'=>$row->rega,
        'firmaa'=>$row->firmaa,
        'cargoa'=>$row->cargoa,
        'items'=>$items
    );


// $data = array(
//     'data'=>$datos
// );

echo json_encode($datos);