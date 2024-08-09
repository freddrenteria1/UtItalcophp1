<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

include("conectar.php"); 
$conexion=conectar();

$sql="SELECT * FROM bdmateriales order by item";
$exito=mysqli_query($conexion, $sql);

while($row = mysqli_fetch_object($exito)){
    $datos[] = array(
        'id'=>$row->id,
        'item'=>$row->item,
        'reserva'=>$row->reserva,
        'posres'=>$row->posres,
        'cm'=>$row->cm,
        'descripcion'=>$row->descripcion,
        'unidad'=>$row->unidad,
        'cantreq'=>$row->cantreq,
        'impacto'=>$row->impacto,
        'ods'=>$row->ods,
        'ordenmtto'=>$row->ordenmtto,
        'equipo'=>$row->equipo,
        'sistema'=>$row->sistema,
        'isometrico'=>$row->isometrico,
        'ingenieria'=>$row->ingenieria,
        'obsadicional'=>$row->obsadicional,
        'alcance'=>$row->alcance,
        'ubicatec'=>$row->ubicatec,
        'planeado'=>$row->planeado,
        'etapa'=>$row->etapa,
        'especialidad'=>$row->especialidad,
        'sk'=>$row->sk,
        'numcolada'=>$row->numcolada,
        'certificado'=>$row->certificado

    );
}

// $data = array(
//     'data'=>$datos
// );

echo json_encode($datos);