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


$query = "SELECT * FROM soldadores WHERE hora != ''";
$eje = mysqli_query($conexion, $query);

$enc = mysqli_query($conexion, $query);

if($enc != 0){
    while($obj = mysqli_fetch_object($eje)){
        $datos[] = array(
            'nombres' => $obj->nombres,
            'doc' => $obj->documento,
            'celular' => $obj->celular,
            'estampe' => $obj->estampe,
            'proceso1'=> $obj->proceso1,
            'proceso2'=> $obj->proceso2,
            'metalurgia'=> $obj->metalurgia,
            'fecha' => $obj->fecha,
            'hora' => $obj->hora
        );
    }
}

echo json_encode($datos);