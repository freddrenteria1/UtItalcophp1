<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM cclg";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'equipo'=>$obj->equipo,
            'alcance'=>$obj->alcance,
            'intervencion'=>$obj->intervencion,
            'desarmado'=>$obj->desarmado,
            'limpieza'=>$obj->limpieza,
            'instvalvulas'=>$obj->instvalvulas,
            'soldadurasello'=>$obj->soldadurasello,
            'ph'=>$obj->ph,
            'montaje'=>$obj->montaje,
            'torque'=>$obj->torque,
            'rca'=>$obj->rca,
            'obs'=>$obj->obs,
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);