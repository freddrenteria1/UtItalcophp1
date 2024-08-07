<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

// $ip = $_SERVER['REMOTE_ADDR'];

$sql="SELECT * FROM sigdescargas order by usuario";
$exito=mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($exito);

if($cont > 0 ){

    while($obj = mysqli_fetch_object($exito)){

        $datos[] = array(
            'id'=>$obj->id,
            'fecha'=>$obj->fecha,
            'user'=>$obj->usuario,
            'ip'=>$obj->ip,
            'archivo'=>$obj->archivo,
        );

    }

    $msn = 'OK';

}

echo json_encode($datos);