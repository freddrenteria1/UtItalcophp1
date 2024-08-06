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
            'areasello'=>$obj->areasello,
            'inspcascoext'=>$obj->inspcascoext,
            'inspcascoint'=>$obj->inspcascoint,
            'inspcascout'=>$obj->inspcascout,
            'inspcascoboq'=>$obj->inspcascoboq,
            'inspcascoend'=>$obj->inspcascoend,
            'inspcascoana'=>$obj->inspcascoana,
            'inspcapsext'=>$obj->inspcapsext,
            'inspcapsint'=>$obj->inspcapsint,
            'inspcapsut'=>$obj->inspcapsut,
            'inspcapsboq'=>$obj->inspcapsboq,
            'inspcapsana'=>$obj->inspcapsana,
            'emrtint'=>$obj->emrtint,
            'emrtext'=>$obj->emrtext,
            'ejerteint'=>$obj->ejerteint,
            'ejertext'=>$obj->ejertext,
            'recubint'=>$obj->recubint,
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