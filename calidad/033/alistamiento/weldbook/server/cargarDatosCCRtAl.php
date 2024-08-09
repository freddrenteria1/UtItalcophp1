<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccrtal";
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
            'esp'=>$obj->esp,
            'comp'=>$obj->comp,
            'etapa'=>$obj->etapa,
            'detalle'=>$obj->detalle,
            'estado'=>$obj->estado,
            'obs'=>$obj->obs
        );
    }

    $msn = 'Ok';
     
}


echo json_encode($datos);