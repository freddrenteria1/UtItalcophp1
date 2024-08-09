<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM cctorres";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'tag'=>$obj->tag,
            'zona'=>$obj->zona,
            'retaislamiento'=>$obj->retaislamiento,
            'instsas'=>$obj->instsas,
            'apertmanholes'=>$obj->apertmanholes,
            'instfacilidades'=>$obj->instfacilidades,
            'retirointernos'=>$obj->retirointernos,
            'armarandamios'=>$obj->armarandamios,
            'retirolgs'=>$obj->retirolgs,
            'limpinterna'=>$obj->limpinterna,
            'limpexterna'=>$obj->limpexterna,
            'inspinterna'=>$obj->inspinterna,
            'inspexterna'=>$obj->inspexterna,
            'insptomaesp'=>$obj->insptomaesp,
            'inspareasello'=>$obj->inspareasello,
            'inspend'=>$obj->inspend,
            'recpostinterna'=>$obj->recpostinterna,
            'recpostexterna'=>$obj->recpostexterna,
            'ejerecinterna'=>$obj->ejerecinterna,
            'ejerecexterna'=>$obj->ejerecexterna,
            'instlining'=>$obj->instlining,
            'plining'=>$obj->plining,
            'instinternos'=>$obj->instinternos,
            'mttolgs'=>$obj->mttolgs,
            'instlgs'=>$obj->instlgs,
            'pruebadistri'=>$obj->pruebadistri,
            'pruebarociado'=>$obj->pruebarociado,
            'pruebagoteo'=>$obj->pruebagoteo,
            'retirarfac'=>$obj->retirarfac,
            'desarmandamios'=>$obj->desarmandamios,
            'cierremanholes'=>$obj->cierremanholes,
            'pintura'=>$obj->pintura,
            'retirosas'=>$obj->retirosas,
            'limpbases'=>$obj->limpbases,
            'etiquetabridas'=>$obj->etiquetabridas,
            'rca'=>$obj->rca,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);