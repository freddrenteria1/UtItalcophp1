<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d H:i:s");

$query = "SELECT * FROM programados Where estado='Programado' order by nombres";
$eje = mysqli_query($conexion, $query);


while($obj = mysqli_fetch_object($eje)){

    $cedula = $obj->doc;
    $firma =  '';

    $filefirma = '../firmas/'  . $cedula . '.jpg';

    $filefirmapng = '../firmas/'  . $cedula . '.png';
    $filefirmajpg = '../firmas/'  . $cedula . '.jpg';

    if(file_exists($filefirmajpg)){
        $firma = 'https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.jpg';
    }

    if(file_exists($filefirmapng)){
        $firma = 'https://utitalco.com/biometricsystem/firmas/'  . $cedula . '.png';
    }

    if (!file_exists($filefirmajpg) && !file_exists($filefirmapng)) {
        $firma = '';
    }


    $datos[] = array(
        'id'=>$obj->id,
        'cedula'=>$obj->doc,
        'nombres'=>$obj->nombres,
        'cargo'=>$obj->cargo,
        'frentetrab'=>$obj->frente,
        'lugartrab'=>$obj->lugartrab,
        'turno'=>$obj->turno,
        'fingreso'=>$obj->fingreso,
        'ods'=>$obj->ods,
        'estado'=>$obj->estado,
        'firma'=>$firma
    );
}

echo json_encode($datos);