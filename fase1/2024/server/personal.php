<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$query = "SELECT * FROM certificadofase12024 order by nombres";
$eje = mysqli_query($conexion, $query);

$cont = mysqli_num_rows($eje);

if($cont != 0){
    
    while($obj = mysqli_fetch_object($eje)){

        $puntaje = intval($obj->puntaje);
    
        if($puntaje >= 80){
            $estado='SI';
            $fecha = $obj->fecha;
        }else{
            $estado='NO';
            $puntaje = '';
            $fecha = '';
        }
    
        
        $datos[] = array(
            'cedula'=>$obj->documento,
            'nombres'=>$obj->nombres,
            'estado'=>$estado,
            'puntaje'=>$puntaje,
            'fecha'=>$fecha,
            'msn'=>'Ok'
        );

    }

}else{
    $datos = array(
        'msn'=>'Error'
    );
}

echo json_encode($datos);