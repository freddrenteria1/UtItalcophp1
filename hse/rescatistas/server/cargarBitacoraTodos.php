<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$fecha_actual = date("Y-m-d");
//resto 1 día
$fecha = date("Y-m-d",strtotime($fecha_actual."- 1 days")); 


$query = "SELECT * FROM bitacorares order by fecha desc ";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'fecha' => $obj->fecha,
            'nombres' => $obj->nombres,
            'doc' => $obj->doc,
            'turno' => $obj->turno,
            'pdir' => $obj->pdir,
            'pindir'=> $obj->pindir,
            'equipos' => $obj->equipos,
            'aspectos' => $obj->aspectos,
            'novedades'=>$obj->novedades
        );
    }
}

echo json_encode($datos);