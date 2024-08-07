<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];

$sql="SELECT * FROM ccdesmantelamiento WHERE fechacargue = '$fecha'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $desmante[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividades'=>$obj->actividades,
            'planeado'=>$obj->planeado,
            'ejecutado'=>$obj->ejecutado,
            'acumulado'=>$obj->acumulado,
            'pendiente'=>$obj->pendiente,
            'fecha'=>$obj->fecha,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';

    $sql="SELECT * FROM imgdesmante WHERE fecha = '$fecha'";
    $eje=mysqli_query($conexion, $sql);

    $fila = mysqli_fetch_object($eje);

    $fotos = array(
        'imgtub'=>$fila->tuberias,
        'imglam'=>$fila->laminas
    );
     
}

$datos = array(
    'desmante'=>$desmante,
    'fotos'=>$fotos
);

echo json_encode($datos);