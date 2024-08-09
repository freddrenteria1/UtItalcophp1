<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM cchornos";
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
            'instsas'=>$obj->instsas,
            'aperturamanhol'=>$obj->aperturamanhol,
            'instfacilidades'=>$obj->instfacilidades,
            'armarandamiosint'=>$obj->armarandamiosint,
            'cortenorteplan'=>$obj->cortenorteplan,
            'cortenorteeje'=>$obj->cortenorteeje,
            'cortesurplan'=>$obj->cortesurplan,
            'cortesureje'=>$obj->cortesureje,
            'demnorteplan'=>$obj->demnorteplan,
            'demnorteeje'=>$obj->demnorteeje,
            'demsurplan'=>$obj->demsurplan,
            'demsureje'=>$obj->demsureje,
            'limpinterna'=>$obj->limpinterna,
            'limpexterna'=>$obj->limpexterna,
            'inspinterna'=>$obj->inspinterna,
            'inspexterna'=>$obj->inspexterna,
            'recompostint'=>$obj->recompostint,
            'recompostexterna'=>$obj->recompostexterna,
            'ejerecompostint'=>$obj->ejerecompostint,
            'ejerecompostext'=>$obj->ejerecompostext,
            'ctsoldplan'=>$obj->ctsoldplan,
            'ctsoldeje'=>$obj->ctsoldeje,
            'ctrxpreplan'=>$obj->ctrxpreplan,
            'ctrxpreeje'=>$obj->ctrxpreeje,
            'ctpwhtplan'=>$obj->ctpwhtplan,
            'ctpwhteje'=>$obj->ctpwhteje,
            'ctrxpostplan'=>$obj->ctrxpostplan,
            'ctrxposteje'=>$obj->ctrxposteje,
            'instmodnorteplan'=>$obj->instmodnorteplan,
            'instmodnorteeje'=>$obj->instmodnorteeje,
            'instmodsurplan'=>$obj->instmodsurplan,
            'instmodsureje'=>$obj->instmodsureje,
            'instcasnorteplan'=>$obj->instcasnorteplan,
            'instcasnorteeje'=>$obj->etiquetabridas,

            'instcassurplan'=>$obj->instcassurplan,
            'instcassureje'=>$obj->instcassureje,
            'phserpen'=>$obj->phserpen,
            'instinternos'=>$obj->instinternos,
            'retfacilidades'=>$obj->retfacilidades,
            'desandamiosinter'=>$obj->desandamiosinter,
            'cierremanhol'=>$obj->cierremanhol,
            'pintura'=>$obj->pintura,
            'retirosas'=>$obj->retirosas,
            'limpiezapintura'=>$obj->limpiezapintura,
            'eriquetabridas'=>$obj->eriquetabridas,

            'rca'=>$obj->rca,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);