<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM horas";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$horas = array(
    'id'=>$obj->id,
    'progp'=>$obj->progp,
    'proga'=>$obj->proga,
    'ejecp'=>$obj->ejecp,
    'ejeca'=>$obj->ejeca,
    'difp'=>$obj->difp,
    'difa'=>$obj->difa         
);


$sql="SELECT * FROM turnos ";
$exito=mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$turnos = array(
    'id'=>$obj->id,
    'turnoa'=>intval($obj->turnoa),
    'turnob'=>intval($obj->turnob),
    'turnoc'=>intval($obj->turnoc),
    'turnoe'=>intval($obj->turnoe),
    'turnof'=>intval($obj->turnof),
    'desca'=>intval($obj->desca),
    'total'=>intval($obj->total),
);

$sql="SELECT * FROM histograma ";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    $histo[] = array(
        'id'=>$obj->id,
        'dia'=>intval($obj->dia),
        'fecha'=>$obj->fecha,
        'prog'=>intval($obj->prog),
        'eje'=>intval($obj->eje)
    );

}


$datos = array(
    'horas'=>$horas,
    'turnos'=>$turnos,
    'histo'=>$histo
);

echo json_encode($datos);