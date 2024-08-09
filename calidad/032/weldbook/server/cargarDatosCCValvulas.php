<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccvalvulas";
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
            'tag'=>$obj->tag,
            'retiro'=>$obj->retiro,
            'instbridas'=>$obj->instbridas,
            'trastaller'=>$obj->trastaller,
            'retvalvulataller'=>$obj->retvalvulataller,
            'instvalvula'=>$obj->instvalvula,
            'etiqueta'=>$obj->etiqueta,
            'rca'=>$obj->rca,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);