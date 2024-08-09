<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM masterbridas";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'planta'=>$obj->planta,
            'especialidad'=>$obj->especialidad,
            'linea'=>$obj->linea,
            'tag'=>$obj->tag,
            'descripcion'=>$obj->descripcion,
            'numjunta'=>$obj->numjunta,
            'pulgadas'=>$obj->pulgadas,
            'material'=>$obj->material,
            'metal'=>$obj->metal,
            'rating'=>$obj->rating,
            'tipo'=>$obj->tipo,
            'descripcion_2'=>$obj->descripcion_2,
            'tipo_2'=>$obj->tipo_2,
            'material_2'=>$obj->material_2,
            'diametro'=>$obj->diametro,
            'diametrodec'=>$obj->diametrodec,
            'longitud'=>$obj->longitud,
            'cantidad'=>$obj->cantidad,
            'material_3'=>$obj->material_3,
            'cantidad_2'=>$obj->cantidad_2,
            'lubricante'=>$obj->lubricante,
            'torquereq'=>$obj->torquereq,
            'instsas'=>$obj->instsas,
            'retsas'=>$obj->retsas,
            'ajustetorque'=>$obj->ajustetorque,
            'tarjetatorque'=>$obj->tarjetatorque,
            'ensamblador'=>$obj->ensamblador,
            'supervisor'=>$obj->supervisor,
            'qaqc'=>$obj->qaqc,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);