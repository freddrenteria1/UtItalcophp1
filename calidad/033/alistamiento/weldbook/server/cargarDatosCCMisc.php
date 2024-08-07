<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccmisc";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'iditem'=>$obj->iditem,
            'equipo'=>$obj->equipo,
            'sk'=>$obj->sk,
            'miscelaneo'=>$obj->miscelaneo,
            'alcance'=>$obj->alcance,
            'cml'=>$obj->cml,
            'especialidad'=>$obj->especialidad,
            'ejecutado'=>$obj->ejecutado,
            'soporteria'=>$obj->soporteria,
            'inspcie'=>$obj->inspcie,
            'plp'=>$obj->plp,
            'rx'=>$obj->rx,
            'phwt'=>$obj->phwt,
            'dureza'=>$obj->dureza,
            'rxphwt'=>$obj->rxphwt,
            'ph'=>$obj->ph,
            'torque'=>$obj->torque,
            'pintura'=>$obj->pintura,
            'aislamiento'=>$obj->aislamiento,
            'inspgestor'=>$obj->inspgestor,
            'firma'=>$obj->firma,
            'paquete'=>$obj->paquete,
            'obs'=>$obj->obs,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);