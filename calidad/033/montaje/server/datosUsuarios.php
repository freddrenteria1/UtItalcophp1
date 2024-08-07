<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql="SELECT * FROM users order  by email";
$exito=mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){
    

    $datos[] = array(
        'id'=>$obj->id,
        'empresa'=>$obj->empresa,
        'nombres'=>$obj->nombres,
        'email'=>$obj->email,
        'clave'=>$obj->clave,
        'tipo'=>$obj->tipo,
        'estado'=>$obj->estado
    );

}



echo json_encode($datos);