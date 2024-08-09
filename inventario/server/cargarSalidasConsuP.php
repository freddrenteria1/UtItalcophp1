<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");


$sql = "SELECT * FROM ordensalidaconsu Order by fecha DESC";
$exito = mysqli_query($conexion, $sql);

while($obj = mysqli_fetch_object($exito)){

    //busca si está registrada la entrada
    $numid = $obj->id;

    $cons = "SELECT * FROM entradaconsumibles WHERE remision = '$numid'";
    $ejec = mysqli_query($conexion, $cons);

    $tot = mysqli_num_rows($ejec);

    if($tot == 0){
        $est = 'No';
    }else{
        $est = 'Si';
    }

    $datos[] = array(
        'id'=>$obj->id,
        'fecha'=>$obj->fecha,
        'almacen'=>$obj->almacen,
        'ods'=>$obj->ods,
        'ubicacion'=>$obj->ubicacion,
        'est'=>$est
    );
}

echo json_encode($datos);