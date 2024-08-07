<?php
//header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

//$fecha = $_POST["fecha"];

$fecha = date("d/m/Y", strtotime($fecha));


$buscar="SELECT  * FROM datoswp WHERE fecha != '' GROUP BY estw1";   
$ejeb = mysqli_query($conexion, $buscar);

while( $row = mysqli_fetch_object($exito)){

    echo $row->estw1 . '<br>';

}




//     $datos = array(
//         'prog'=>$prog,
//         'cantsold'=>$cantsold,
//         'rend'=>$rend,
//         'rendimiento'=>$rendimiento
//     );





// echo json_encode($datos);

