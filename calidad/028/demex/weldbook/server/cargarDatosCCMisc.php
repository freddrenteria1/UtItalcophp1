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
            'item'=>$obj->item,
            'equipo'=>$obj->equipo,
            'actividad'=>$obj->actividad,
            'miscelaneo'=>$obj->miscelaneo,
            'cvalvbplan'=>intval($obj->cvalvbplan),
            'cvalvbeje'=>intval($obj->cvalvbeje),
            'cvalvbpor'=>intval($obj->cvalvbpor),
            'cvalvcplan'=>intval($obj->cvalvcplan),
            'cvalvceje'=>intval($obj->cvalvceje),
            'cvalvcpor'=>intval($obj->cvalvcpor),
            'cvalviplan'=>intval($obj->cvalviplan),
            'cvalvieje'=>intval($obj->cvalvieje),
            'cvalvipor'=>intval($obj->cvalvipor),
            'mttovalvoplan'=>intval($obj->mttovalvoplan),
            'mttovalvoeje'=>intval($obj->mttovalvoeje),
            'mttovalvopor'=>intval($obj->mttovalvopor),
            'mttocambvalvplan'=>intval($obj->mttocambvalvplan),
            'mttocambvalveje'=>intval($obj->mttocambvalveje),
            'mttocambvalvpor'=>intval($obj->mttocambvalvpor),
            'totprog'=>intval($obj->totprog),
            'toteje'=>intval($obj->toteje),
            'totpor'=>intval($obj->totpor)
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);