<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$sql = "SELECT * FROM bitacoracchornos order by ID DESC limit 1";
$ejec = mysqli_query($conexion, $sql);

$cont = mysqli_num_rows($ejec);

if($cont > 0){

    $obj=mysqli_fetch_object($ejec);
    
    $datos = array(
        'user'=>$obj->user,
        'fecha'=>$obj->fecha,
        'archivo'=>$obj->archivo
    );

}else{
    $datos = array(
        'user'=>'',
        'fecha'=>'',
        'archivo'=>''
    );
}





echo json_encode($datos);