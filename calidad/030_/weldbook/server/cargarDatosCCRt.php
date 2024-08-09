<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccrt";
$exito=mysqli_query($conexion, $sql);

$cant = mysqli_num_rows($exito);

if($cant == 0){
    $msn = 'Error';
    $tipo = '';
}else{
    
   
    while( $obj = mysqli_fetch_object($exito)){
        
        $datos[] = array(
            'id'=>$obj->id,
            'cons'=>$obj->cons,
            'num'=>$obj->num,
            'estadort'=>$obj->estadort,
            'especialidad'=>$obj->especialidad,
            'espdiagnostico'=>$obj->espdiagnostico,
            'equipo'=>$obj->equipo,
            'componente'=>$obj->componente,
            'etapa'=>$obj->etapa,
            'descripcion'=>$obj->descripcion,
            'sk'=>$obj->sk,
            'diagnostico'=>$obj->diagnostico,
            'planeada'=>$obj->planeada,
            'costeada'=>$obj->costeada,
            'finicio'=>$obj->finicio,
            'ffin'=>$obj->ffin,
            'estadodiag'=>$obj->estadodiag,
            'porceje'=>$obj->porceje,
            'plp'=>$obj->plp,
            'rx'=>$obj->rx,
            'pwht'=>$obj->pwht,
            'dureza'=>$obj->dureza,
            'rxpostpwht'=>$obj->rxpostpwht,
            'rca'=>$obj->rca,
            'entcostos'=>$obj->entcostos,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);