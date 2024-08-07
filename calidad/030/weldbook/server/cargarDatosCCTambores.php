<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM cctambores";
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
            'alcance'=>$obj->alcance,
            'instsas'=>$obj->instsas,
            'abrirm'=>$obj->abrirm,
            'instfacint'=>$obj->instfacint,
            'retint'=>$obj->retint,
            'limpint'=>$obj->limpint,
            'retaislamiento'=>$obj->retaislamiento,
            'limpext'=>$obj->limpext,
            'inspvisual'=>$obj->inspvisual,
            'tomaesp'=>$obj->tomaesp,
            'areasello'=>$obj->areasello,
            'inspinternos'=>$obj->inspinternos,
            'instint'=>$obj->instint,
            'cierrem'=>$obj->cierrem,
            'torque'=>$obj->torque,
            'limpypintura'=>$obj->limpypintura,
            'pinturaext'=>$obj->pinturaext,
            'instaislamiento'=>$obj->instaislamiento,
            'retsas'=>$obj->retsas,
            'rca'=>$obj->rca,
            'obs'=>$obj->obs,
            
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);