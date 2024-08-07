<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$ods = $_POST["ods"];

$query = "SELECT * FROM vigias Where ods='$ods' order by fecha desc ";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'fecha' => $obj->fecha,
            'nombres' => $obj->nombres,
            'doc' => $obj->doc,
            'turno' => $obj->turno,
            'equipos' => $obj->equipos,
            'notas'=>$obj->notas
        );
    }
}

echo json_encode($datos);