<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccpuntos";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'lazo'=>$obj->lazo,
            'isometrico'=>$obj->isometrico,
            'cml'=>$obj->cml,
            'accesorio'=>$obj->accesorio,
            'armandamio'=>$obj->armandamio,
            'retaislamiento'=>$obj->retaislamiento,
            'limpieza'=>$obj->limpieza,
            'insputesp'=>$obj->insputesp,
            'rtpostinsp'=>$obj->rtpostinsp,
            'ejert'=>$obj->ejert,
            'vobocie'=>$obj->vobocie,
            'pintura'=>$obj->pintura,
            'aislamiento'=>$obj->aislamiento,
            'desarmandamio'=>$obj->desarmandamio,
            'regcontrol'=>$obj->regcontrol,
            'avance'=>$obj->avance,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);