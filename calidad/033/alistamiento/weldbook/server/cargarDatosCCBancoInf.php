<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$fecha = $_POST["fecha"];

$sql="SELECT * FROM ccbanco WHERE fechacargue = '$fecha'";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $banco[] = array(
            'id'=>$obj->id,
            'item'=>$obj->item,
            'actividad'=>$obj->actividad,
            'totplan'=>$obj->totplan,
            'ejete'=>$obj->ejete,
            'ejetf'=>$obj->ejetf,
            'toteje'=>$obj->toteje,
            'acumeje'=>$obj->acumeje,
            'avance'=>$obj->avance,
            'fecha'=>$obj->fecha,
            'pendiente'=>$obj->pendiente,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';

    $sql="SELECT * FROM imgbanco WHERE fecha = '$fecha'";
    $eje=mysqli_query($conexion, $sql);

    $fila = mysqli_fetch_object($eje);

    $fotos = array(
        'imgLodos'=>$fila->lodos,
        'imgVapor'=>$fila->vapor,
        'imgOrificios'=>$fila->orificios,
    );
     
}

$datos = array(
    'banco'=>$banco,
    'fotos'=>$fotos
);

echo json_encode($datos);