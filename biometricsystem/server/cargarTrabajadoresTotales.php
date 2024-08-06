<?php
header('Content-type: application/json');
header('Access-Control-Allow-Origin: *');

include("conectar.php"); 
$conexion=conectar();

date_default_timezone_set("America/Bogota");
$fecha=date("Y-m-d");

$query = "SELECT * FROM trabajadores Where estado = 'Activo' Or estado = 'Nuevo' order by nombres";
$eje = mysqli_query($conexion, $query);

while($obj = mysqli_fetch_object($eje)){

    $cedula = $obj->cedula;
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

    if($obj->fingreso == $fecha){
        $est = 'Nuevo';
    }else{
        $est = 'Activo';
    }


    $datos[] = array(
        'id'=>$obj->id,
        'contrato'=>$obj->contrato,
        'cedula'=>$obj->cedula,
        'nombres'=>$obj->nombres,
        'apellidos'=>$obj->apellidos,
        'domicilio'=>$obj->domicilio,
        'telefono'=>$obj->telefono,
        'cargo'=>$obj->cargo,
        'lugartrab'=>$obj->lugartrab,
        'empresa'=>$obj->empresa,
        'turno'=>$obj->turno,
        'fingreso'=>$obj->fingreso,
        'fsalida'=>$obj->fsalida,
        'acargo'=>$obj->acargo,
        'sistemaprecio'=>$obj->sistemaprecio,
        'tiponomina'=>$obj->tiponomina,
        'detpago'=>$obj->detpago,
        'frente'=>$obj->frente,
        'frentetrab'=>$obj->frentetrab,
        'supervisor'=>$obj->supervisor,
        'ods'=>$obj->ods,
        'estado'=>$obj->estado,
        'firma'=>$firma,
        'est'=>$est
    );
}

echo json_encode($datos);