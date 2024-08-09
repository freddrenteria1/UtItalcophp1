<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccbanco order by fecha DESC";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
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

   
     
}


echo json_encode($datos);