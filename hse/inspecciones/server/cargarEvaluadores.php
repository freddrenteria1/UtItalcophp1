<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");


$sql="SELECT * FROM evalinsp order by nombre";
$exito=mysqli_query($conexion, $sql);


    while($obj = mysqli_fetch_object($exito)){
        $datos[] = array(
            'id'=>$obj->id,
            'nombres'=>$obj->nombre
        );
    }
     

echo json_encode($datos);