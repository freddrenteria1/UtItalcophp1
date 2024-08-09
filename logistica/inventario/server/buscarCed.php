<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ced = $_POST["ced"];

$sql = "SELECT * FROM trabajadores Where cedula='$ced'";
$exito = mysqli_query($conexion, $sql);

$obj = mysqli_fetch_object($exito);

$query = "SELECT * FROM invactivos Where ced = '$ced' And cant > 0";
$eje = mysqli_query($conexion, $query);

while($row = mysqli_fetch_object($eje)){
    $cod = $row->codigo;

    $cons = "SELECT * FROM items Where codigo='$cod'";
    $ejec = mysqli_query($conexion, $cons);
    $fila = mysqli_fetch_object($ejec);

    $unidad = $fila->unidad;

    $porciones = explode("-", $row->articulo);

    $items[] = array(
        'cant'=>$row->cant,
        'cod'=>$row->codigo,
        'unidad'=>$unidad,
        'item'=>$porciones[0],
        'detalles'=>$porciones[1] . ' - ODS ' . $row->ods,
        'ods'=>$row->ods
    );
}

$contrato = substr($obj->contrato, -4);

$datos = array(
    'id'=>$obj->id,
    'nombres'=>$obj->nombres . ' ' . $obj->apellidos,
    'cargo'=>$obj->cargo,
    'ods'=>$obj->ods,
    'contrato'=>$contrato,
    'items'=>$items
);


echo json_encode($datos);