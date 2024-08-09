<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql="SELECT * FROM ccdesmantelamiento order by fecha DESC";
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
            'actividades'=>$obj->actividades,
            'planeado'=>$obj->planeado,
            'ejecutado'=>$obj->ejecutado,
            'acumulado'=>$obj->acumulado,
            'pendiente'=>$obj->pendiente,
            'fecha'=>$obj->fecha,
            'observaciones'=>$obj->observaciones
        );
    }

    $msn = 'Ok';
  
     
}

echo json_encode($datos);