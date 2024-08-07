<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//SE BUSCAN AGRUPAN LOS ALCANCES DEL HITO

$ods = $_POST["ods"];

$sql="SELECT * FROM consalturasfases WHERE ods='$ods' order by nombre";
$exito=mysqli_query($conexion, $sql);

while ($row = mysqli_fetch_object($exito)){

    $datos[] = array(
        'cedula' => $row->cedula,
        'nombre'=>$row->nombre,
        'cargo'=>$row->cargo,
        'alturas'=>$row->alturas,
        'falturas'=>$row->falturas,
        'regmintrabalt'=>$row->altplatmintrab,
        'fvigalturas'=>$row->vigalturas,
        'espconfinados'=>$row->espconfinados,
        'fentranteesp'=>$row->fespentrante,
        'fvigiaesp'=>$row->fespvigia,
        'fsuperesp'=>$row->fespsup,
        'fadminesp'=>$row->fespadmin,
        'regmintrabesp'=>$row->espplatmintrab,
        'observaciones'=>$row->observaciones
    );

}  

echo json_encode($datos);