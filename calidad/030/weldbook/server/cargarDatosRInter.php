<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM resinter";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'actividad'=>$obj->actividad,
            'haztotal'=>intval($obj->haztotal),
            'hazeje'=>intval($obj->hazeje),
            'canaltotal'=>intval($obj->canaltotal),
            'canaleje'=>intval($obj->canaleje),
            'tpcanaltotal'=>intval($obj->tpcanaltotal),
            'tpcanaleje'=>intval($obj->tpcanaleje),
            'tpftotal'=>intval($obj->tpftotal),
            'tpfeje'=>intval($obj->tpfeje),
            'anitotal'=>intval($obj->anitotal),
            'anieje'=>intval($obj->anieje),
            'cascototal'=>intval($obj->cascototal),
            'cascoeje'=>intval($obj->cascoeje),
            'tpcascototal'=>intval($obj->tpcascototal),
            'tpcascoeje'=>intval($obj->tpcascoeje)       
            
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);