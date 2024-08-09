<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM infdef";
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
            'end'=>$obj->end,
            'empresa'=>$obj->empresa,
            'numinforme'=>$obj->numinforme,
            'fecha'=>$obj->fecha,
            'isometrico'=>$obj->isometrico,
            'planta'=>$obj->planta,
            'material'=>$obj->material,
            'tiposoldadura'=>$obj->tiposoldadura,
            'welder'=>$obj->welder,
            'numjunta'=>$obj->numjunta,
            'tipojunta'=>$obj->tipojunta,
            'pulgadas'=>$obj->pulgadas,
            'ab'=>$obj->ab,
            'abnv1'=>$obj->abnv1,
            'abnv2'=>$obj->abnv2,
            'abnv3'=>$obj->abnv3,
            'bc'=>$obj->bc,
            'bcnv1'=>$obj->bcnv1,
            'bcnv2'=>$obj->bcnv2,
            'bcnv3'=>$obj->bcnv3,
            'ca'=>$obj->ca,
            'canv1'=>$obj->canv1,
            'canv2'=>$obj->canv2,
            'canv3'=>$obj->canv3,
            'da'=>$obj->da,
            'danv1'=>$obj->danv1,
            'danv2'=>$obj->danv2,
            'danv3'=>$obj->danv3,
            'ea'=>$obj->ea,
            'eanv1'=>$obj->eanv1,
            'eanv2'=>$obj->eanv2,
            'eanv3'=>$obj->eanv3,
            'juntasoldador'=>$obj->juntasoldador
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);