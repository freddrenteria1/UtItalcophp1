<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM cclazos";
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
            'lazo'=>$obj->lazo,
            'sk'=>$obj->sk,
            'isometrico'=>$obj->isometrico,
            'item'=>$obj->item,
            'alcance'=>$obj->alcance,
            'cml'=>$obj->cml,
            'clase'=>$obj->clase,
            'actividad'=>$obj->actividad,
            'materiales'=>$obj->materiales,
            'inspcie'=>$obj->inspcie,
            'ejecucion'=>$obj->ejecucion,
            'soporteria'=>$obj->soporteria,
            'plp'=>$obj->plp,
            'rx'=>$obj->rx,
            'phwt'=>$obj->phwt,
            'durezas'=>$obj->durezas,
            'rxphwt'=>$obj->rxphwt,
            'ph'=>$obj->ph,
            'verificacion'=>$obj->verificacion,
            'torque'=>$obj->torque,
            'pintura'=>$obj->pintura,
            'aislamiento'=>$obj->aislamiento,
            'vobo'=>$obj->vobo,
            'paquete'=>$obj->paquete,
            'rca'=>$obj->rca,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);