<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();


date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

    $sql="SELECT * FROM codturnos";
    $exito=mysqli_query($conexion, $sql);

    while ($row = mysqli_fetch_object($exito)){

        $entrada = date("g:i a", strtotime($row->entrada));
        $salida = date("g:i a", strtotime($row->salida));

        $datos[] = array(
            'id' => $row->id,
            'turno'=>$row->turno,
            'entrada'=>$entrada,
            'salida'=>$salida
        );

    }  

echo json_encode($datos);