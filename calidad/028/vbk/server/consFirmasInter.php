<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();


$cons = "SELECT * FROM hitosinterfirm  order by fecha";
$ejec = mysqli_query($conexion, $cons);

while($obj = mysqli_fetch_object($ejec)){

    $hitos[] = array(
        'fecha'=>$obj->fecha,
        'hitos'=>$obj->hitos
    );

}

echo json_encode($hitos);
